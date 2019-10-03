<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Checkout extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('checkoutModel');
			$this->load->model('cartModel');
		}


		public function index(){
			$id_user=$this->session->userdata('user_id');
			$data['addressList']=$this->checkoutModel->getAddressList($id_user);

			$data['products']=$this->checkoutModel->checkoutPerStore($id_user);


			$this->load->view('appinfo');
			$this->load->view('checkout_s');
			$this->load->view('header');
			$this->load->view('checkout_v',$data);
			$this->load->view('footer');
			$this->load->view('checkout_x');
		}

		public function process(){
			$jsonData=$_POST['data'];
			$datas=json_decode($jsonData, true);
			$id_user=$this->session->userdata('user_id');
			$insertToCart=$this->checkoutModel->inputCheckout($id_user,$datas);
			echo $insertToCart;
		}

		public function mQuantity(){
			$id=$_POST['id'];
			$value=$_POST['value'];

			$this->checkoutModel->editQuantity($id,$value);

		}

		public function selectAddress(){
			$id_user=$this->session->userdata('user_id');
			$id=$this->input->post('id');
			$data=$this->db->query("SELECT receiver,phone,address,postalcode FROM user_client_address where id='$id' and id_user='$id_user'")->result_array()[0];
			//header("Content-Type: application/json; charset=UTF-8");
			echo json_encode($data);
		}

		public function checkout_process(){
			$id_user=$this->session->userdata('user_id');
			$id_user_address=$this->input->post('id_address');
			$invoice=time();
			$dataJSON=$this->input->post('data');
			$datas=json_decode($dataJSON);
			$time_now=date('Y-m-d H:i:s');

			//INSERT KE TABEL SALES START
				$insertToSales=$this->db->query("INSERT INTO sales (invoice,id_user,status,lup) VALUES('$invoice','$id_user',0,now())");
				if($insertToSales){
					//INSERT KE TABEL SALES DETAIL TRANS START
					foreach($datas as $data){
						$id_seller=$data->id_store;
						$id_courier_service=$data->id_courier_service;
						$dataPenjual=$this->db->query("SELECT store_subcity,store_address,store_postalcode,store_phone,store_name FROM store where id_user='$id_seller'")->result_array()[0];
						$dataPembeli=$this->db->query("SELECT receiver,phone,subcity,address,postalcode FROM user_client_address where id='$id_user_address' and id_user='$id_user'")->result_array()[0];

						$this->db->trans_start();
						$insertToSalesDetailTrans=$this->db->query("INSERT INTO sales_detail_trans
																												(
																													id_invoice,
																													location_user_subcity_id,
																													location_user_postal,
																													location_user_address,
																													user_phone,
																													user_name,
																													id_seller,
																													location_seller_subcity_id,
																													location_seller_postal,
																													location_seller_address,
																													store_phone,
																													store_name,
																													lup
																												)
																							   VALUES(
																													'$invoice',
																													'$dataPembeli[subcity]',
																													'$dataPembeli[postalcode]',
																													'$dataPembeli[address]',
																													'$dataPembeli[phone]',
																													'$dataPembeli[receiver]',
																													'$id_seller',
																													'$dataPenjual[store_subcity]',
																													'$dataPenjual[store_postalcode]',
																													'$dataPenjual[store_address]',
																													'$dataPenjual[store_phone]',
																													'$dataPenjual[store_name]',
																													now()
																											 )
																												");
						if($insertToSalesDetailTrans){
							$idSalesDetailTrans=$this->db->insert_id();
							$this->db->trans_complete();

							if($id_courier_service!=0){
									$weight=0;
									$inserted_product_id=array();
									foreach($data->products as $product){
										$id_product=$product->id_product;
										$id_product_cartemp=$product->id_cart_temp;
										$this->db->trans_start();
										$detailProduct=$this->db->query("SELECT
																											p.pr_name,
																											p.pr_sku,
																											p.pr_description,
																											p.pr_condition,
																											p.pr_source,
																											p.weight,
																											p.price,
																											pc.quantity,
																											p.is_wholesale,
																											p.wh_unit1,
																											p.wh_price1,
																											p.wh_unit2,
																											p.wh_price2,
																											p.wh_unit3,
																											p.wh_price3,
																											p.wh_unit4,
																											p.wh_price4,
																											p.wh_unit5,
																											p.wh_price5,
																											p.is_discount,
																											p.discount_value,
																											p.is_discount_stil,
																											p.is_freedelivery,
																											p.is_asuransi
																											FROM product as p INNER JOIN cart_tempcheckout as pc
																											ON p.id=pc.id_product
																											AND p.id_user=pc.id_store
																											WHERE pc.id_store='$id_seller'
																											AND pc.id_user='$id_user'
																											AND pc.id_product='$id_product'
																											AND pc.id='$id_product_cartemp'
																											AND pc.status=0
																											")->result_array()[0];
										$detailProduct['id_sales_detail_trans']=$idSalesDetailTrans;
										$detailProduct['lup']=$time_now;
										$this->db->insert('sales_detail_product',$detailProduct);
										$weight=$weight+($detailProduct['weight']*$detailProduct['quantity']);
										$lastinserted_product_id=$this->db->insert_id();
										$this->db->trans_complete();
										array_push($inserted_product_id,$lastinserted_product_id);
									}
									//INSERT KE TABEL KURIR
									$this->db->trans_start();
									$this->db->query("INSERT INTO sales_detail_courier (id_sales_detail_trans,id_service,total_weight,price,lup)
																		VALUES ('$idSalesDetailTrans','$id_courier_service','$weight',0,now())");
									$lastinserted_detail_courier_id=$this->db->insert_id();
									$this->db->trans_complete();

									foreach($inserted_product_id as $id_inserted){
										$this->db->query("INSERT INTO sales_detail_courier_by_product (id_sales_detail_product,id_sales_detail_courier,lup)
																			VALUES('$id_inserted','$lastinserted_detail_courier_id',now())");
									}
								}else{
									//KURIR PER PRODUK
								}

						}else{
							$response="FAILED";
						}


					}
					//INSERT KE TABEL SALES DETAIL TRANS END

				}else{
					//GAGAL INSERT KE TABEL SALES
					$response="FAILED";
				}
			//INSERT KE TABEL SALES END


		}

}
