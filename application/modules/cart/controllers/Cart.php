<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Cart extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('cartModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
		}


		public function index(){
			$id_user=$this->session->userdata('user_id');
			$data['cartPerStore']=$this->cartModel->cartPerStore($id_user);

			$this->load->view('appinfo');
			$this->load->view('cartpage/cart_s');
			$this->load->view('header');
			$this->load->view('cartpage/cart_v',$data);
			$this->load->view('footer');
			$this->load->view('cartpage/cart_x');
		}

		public function addToCart(){
			$id_product=$_POST['idProduk'];
			$quantity=$_POST['quantity'];
			$src=$_POST['src'];
			$now=date('Y-m-d h:i:s');
			$user_id=$this->session->userdata('user_id');

			$detailProduct=$this->cartModel->getParameter($id_product);

			$is_discount=$this->productModel->checkDiscountByParam($detailProduct['discount_start'],$detailProduct['discount_end'],$detailProduct['discount_value']);
			$is_grosir=$this->productModel->checkWholesaleByParam($detailProduct['is_wholesale'],$is_discount,$detailProduct['is_discount_grosir'],$detailProduct['stock_type']);

			if($is_discount==1){
				$price=$this->productModel->cekHargaBarang($id_product,1);
			}else{
				$price=$this->productModel->cekHargaBarang($id_product,1,FALSE);
			}
			$id_store=$detailProduct['product_store'];


			$cekCart=$this->cartModel->checkProductInCart($id_product,$user_id);
			if($cekCart>0){ //start update
				$update=$this->db->query("UPDATE cart set quantity=quantity+$quantity,price_cart='$price',lup='$now',src='$src' where id_user='$user_id' and id_product='$id_product' and id_store='$id_store' and is_deleted=0");
				if($update){
					$cekcartcount=$this->db->query("SELECT SUM(quantity) as jml FROM cart where id_user='$user_id'  and is_deleted=0")->result_array()[0];
					if($cekcartcount['jml']!=NULL){
						$jumlahcart=$cekcartcount['jml'];
					}else{
						$jumlahcart=0;
					}
					echo $jumlahcart;
				}else{
					echo "FALSE";
				}
				//end update
			}else{ //start add
					$data = array(
						'id_user' => $user_id,
						'id_store' => $id_store,
						'id_product' 		=> $id_product,
						'price_cart' 		=> $price,
						'quantity' => $quantity,
						'src' => $src,
						'lup' => $now
						);

						$insert=$this->cartModel->addItem($data);
						if($insert=="OK"){
							$cekcartcount=$this->db->query("SELECT SUM(quantity) as jml FROM cart where id_user='$user_id'  and is_deleted=0")->result_array()[0];
							if($cekcartcount['jml']!=NULL){
								$jumlahcart=$cekcartcount['jml'];
							}else{
								$jumlahcart=0;
							}
							echo $jumlahcart;
						}else{
							echo "FALSE";
						}
			}//end add
		}

		public function buy($store_id,$slug){

			//CEK KETERSEDIAAN
			$cek=$this->productModel->getProductDetail($store_id,$slug)->num_rows();
			if($cek>=1){
				//PRODUCT
				$dataProduct=$this->productModel->getProductDetail($store_id,$slug)->result_array()[0];
				$idProduk=$dataProduct['product_id'];
				$quantity=1;
				$src='BUY NOW';
				$now=date('Y-m-d h:i:s');
				$user_id=$this->session->userdata('user_id');

				$detailProduct=$this->cartModel->getParameter($idProduk);
				if($detailProduct['product_discount']==1){
					$price=($detailProduct['product_price']*(100-$detailProduct['product_discount_value']))/100;
				}else{
					$price=$detailProduct['product_price'];
				}
				$id_store=$detailProduct['product_store'];
				$id_product=$detailProduct['product_id'];

				$cekCart=$this->cartModel->checkProductInCart($id_product,$user_id);
				if($cekCart>0){ //start update
					$update=$this->db->query("UPDATE cart set quantity=quantity+$quantity,price_cart='$price',lup='$now',src='$src' where id_user='$user_id' and id_product='$id_product' and id_store='$id_store' and is_deleted=0");
					if($update){
						$cekcartcount=$this->db->query("SELECT SUM(quantity) as jml FROM cart where id_user='$user_id' and is_deleted=0")->result_array()[0];
						if($cekcartcount['jml']!=NULL){
							$jumlahcart=$cekcartcount['jml'];
						}else{
							$jumlahcart=0;
						}
						redirect('cart');
						//echo $jumlahcart;
					}else{
						echo "FALSE";
					}
					//end update
				}else{ //start add
						$data = array(
							'id_user' => $user_id,
							'id_store' => $id_store,
							'id_product' 		=> $id_product,
							'price_cart' 		=> $price,
							'quantity' => $quantity,
							'src' => $src,
							'lup' => $now
							);

							$insert=$this->cartModel->addItem($data);
							if($insert=="OK"){
								redirect('cart');
							}else{
								redirect(base_url());
							}
				}//end add

			}else{
				redirect(base_url());
			}


		}

		public function mQuantity(){
			$id=$_POST['id'];
			$value=$_POST['value'];

			$this->cartModel->editQuantity($id,$value);

		}

		public function itemDelete(){
			$id=$_POST['id'];
			$id_user=$this->session->userdata('user_id');


			$delete=$this->db->query("UPDATE cart set is_deleted=9 where id='$id' and id_user='$id_user'");
			if($delete){
				echo "OK";
			}else{
				echo "FAILED";
			}

		}


}
