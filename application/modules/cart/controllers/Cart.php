<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Cart extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('cartModel');
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
			$idProduk=$_POST['idProduk'];
			$quantity=$_POST['quantity'];
			$src=$_POST['src'];
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
				$update=$this->db->query("UPDATE cart set quantity=quantity+$quantity,price_cart='$price',lup='$now',src='$src' where id_user='$user_id' and id_product='$id_product' and id_store='$id_store'");
				if($update){
					echo "OK";
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
							echo "OK";
						}else{
							echo "FALSE";
						}
			}//end add
		}

		public function mQuantity(){
			$id=$_POST['id'];
			$value=$_POST['value'];

			$this->cartModel->editQuantity($id,$value);

		}

		public function itemDelete(){
			$id=$_POST['id'];
			$id_user=$this->session->userdata('user_id');


			$delete=$this->db->query("DELETE FROM cart where id='$id' and id_user='$id_user'");
			if($delete){
				echo "OK";
			}else{
				echo "FAILED";
			}

		}


}
