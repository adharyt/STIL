<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Checkout extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('checkoutModel');
			$this->load->model('cartModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
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
			$this->load->model('transactionModel');
			$id_user=$this->session->userdata('user_id');
			$id_user_address=$this->input->post('id_address');
			$invoice='INV'.date('ymdHis').'M'.$id_user;
			$dataJSON=$this->input->post('data');
			$datas=json_decode($dataJSON);
			$time_now=$this->config->item('current_time');
			$time_expired = date("Y-m-d H:i:s", strtotime('+10 hours'));
			//INSERT KE TABEL SALES START
				$insertToSales=$this->db->query("INSERT INTO sales (invoice,id_user,status,lup,payment_expired) VALUES('$invoice','$id_user',0,now(),'$time_expired')");
				if($insertToSales){
					//INSERT KE TABEL SALES DETAIL TRANS START
					foreach($datas as $data){
						$id_seller=$data->id_store;
						$dataPenjual=$this->db->query("SELECT store_subcity,store_address,store_postalcode,store_phone,store_name,store_notes FROM store where id_user='$id_seller'")->result_array()[0];
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
																													store_notes,
																													notes,
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
																													'$dataPenjual[store_notes]',
																													'$data->notes',
																													now()
																											 )
																												");
						if($insertToSalesDetailTrans){
							$idSalesDetailTrans=$this->db->insert_id();
							$this->db->trans_complete();



									$inserted_product_id=array();
									foreach($data->products as $product){
										$id_product=$product->id_product;
										$id_courier_service=$product->id_courier_service;
										$id_product_cartemp=$product->id_cart_temp;

										$this->db->trans_start();
										$detailProduct=$this->db->query("SELECT
																											p.id as pr_id,
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
																											p.discount_start,
																											p.discount_end,
																											p.is_discount_grosir,
																											p.discount_value,
																											p.is_discount_stil,
																											p.is_processtime_set,
																											p.processtime_id,
																											p.processtime_instan,
																											p.processtime_preorder,
																											p.is_freedelivery,
																											p.is_asuransi,
																											p.markup_type,
																											p.markup
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


										if($this->productModel->checkAvailability($detailProduct['pr_id'])==1){
											$detailProduct['status']=1;
										}else{
											$detailProduct['status']=0;
										}

										$this->db->insert('sales_detail_product',$detailProduct);

										$lastinserted_product_id=$this->db->insert_id();
										$this->db->trans_complete();
										//Hapus item dari cart
										$this->db->query("UPDATE cart set is_deleted=1 where id_product='$id_product' and id_user='$id_user'");
										$this->db->query("UPDATE cart_tempcheckout set status=1 where id_product='$id_product' and id_user='$id_user'");
										$weight=$detailProduct['weight']*$detailProduct['quantity'];



										//KURIR
										$queryCekKurir="SELECT * FROM sales_detail_courier WHERE id_sales_detail_trans='$idSalesDetailTrans' AND id_service='$id_courier_service'";
										$cekKurir=$this->db->query($queryCekKurir)->num_rows();

										//API KURIR
										$price_weight='10000';

										if($cekKurir>0){
											$dataKurir=$this->db->query($queryCekKurir)->result_array()[0];
											$temp_weight=$this->db->query("SELECT SUM(total_weight) as temp_weight FROM sales_detail_courier where id='$dataKurir[id]'")->result_array()[0]['temp_weight'];
											$this->db->query("INSERT INTO sales_detail_courier_by_product (id_sales_detail_product,id_sales_detail_courier,lup)
																				VALUES('$lastinserted_product_id','$dataKurir[id]',now())");
											$new_weight=$temp_weight+$weight;

											//AMBIL SENDIRI
											if($id_courier_service==1){
												$new_price_cour=4000;
											}else{
												$new_price_cour=$price_weight*ceil($new_weight/1000);
											}

											$this->db->query("UPDATE sales_detail_courier SET total_weight='$new_weight', price='$new_price_cour' WHERE id='$dataKurir[id]'");
										}else{
											//AMBIL SENDIRI
											if($id_courier_service==1){
												$price_cour=4000;
											}else{
												$price_cour=$price_weight*ceil($weight/1000);
											}

											$idTransCour='M'.$id_user.'S'.$id_seller.'C'.$id_courier_service.'T'.time();
											$this->db->trans_start();
											$this->db->query("INSERT INTO sales_detail_courier (id_trans,id_sales_detail_trans,id_service,total_weight,price,lup)
																				VALUES ('$idTransCour','$idSalesDetailTrans','$id_courier_service','$weight','$price_cour',now())");
											$lastinserted_transcour_id=$this->db->insert_id();
											$this->db->trans_complete();
											$this->db->query("INSERT INTO sales_detail_courier_by_product (id_sales_detail_product,id_sales_detail_courier,lup)
																				VALUES('$lastinserted_product_id','$lastinserted_transcour_id',now())");
										}


									}

									$amount=$this->transactionModel->getAmountPerInvoice($invoice);



						//SET AMOUNT
						$setAmount=$this->db->query("UPDATE sales set amount='$amount' WHERE invoice='$invoice'");

						//DECREASE QUANTITY
						$quantity_decrease_cek=$this->db->query("SELECT invoice FROM stil_marketplace.sales
																		WHERE is_decrease_quantity=0 AND invoice='$invoice'
																		ORDER BY lup asc
																		LIMIT 1");


						if($quantity_decrease_cek->num_rows()>0){
							$quantity_update=$this->db->query("UPDATE sales_detail_product as sdp
																								INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
																								INNER JOIN sales_detail_courier as sdc ON sdcbp.id_sales_detail_courier=sdc.id
				                                        INNER JOIN sales_detail_trans as sdt ON sdt.id=sdc.id_sales_detail_trans
				                                        INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																								INNER JOIN product as p ON sdp.pr_id=p.id
																								SET p.stock=p.stock-sdp.quantity
																								WHERE s.invoice='$invoice'
																								AND (p.stock_type=1 OR p.stock_type=2)
																								AND sdp.status!=0
																								");
							if($quantity_update){
								//UPDATE STATUS
								$this->db->query("UPDATE stil_marketplace.sales SET is_decrease_quantity=1 where invoice='$invoice'");

							}

						}

						//PUSH NOTIFICATION
						$this->notificationModel->pushNotificationUser($id_user,'2',$invoice);


						//call payment gateway
						$response=$invoice;

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
			echo $response;

		}

		public function test(){
			$this->load->model('transactionModel');
			echo $this->transactionModel->getAmountPerInvoice('INV200408230817M4');
		}

}
