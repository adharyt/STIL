<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Product extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
			date_default_timezone_set('Asia/Jakarta');
		}

		//PRODUCT DETAIL
		public function detail($store_id,$slug){
			$this->load->model('courierModel');
			$this->load->model('storeModel');

			//CEK KETERSEDIAAN
			$cek=$this->productModel->getProductDetail($store_id,$slug)->num_rows();
			if($cek>=1){
				//PRODUCT
				$data['dataProduct']=$this->productModel->getProductDetail($store_id,$slug)->result_array()[0];
				$product_id=$data['dataProduct']['product_id'];


				$data['dataProductImg']=$this->productModel->getProductImage($product_id);
				$node=explode("-",$data['dataProduct']['id_category']);
				$data['dataProduct']['name_category']=$this->productModel->getCategoryNameSummary($node[0],$node[1]);
				//STOREFEEDBACK
				$data['storeFeedbackCountPositive']=$this->storeModel->getFeedback($data['dataProduct']['store_id'],'positivesum')->result_array()[0]['summarize'];
				$data['storeFeedbackCountNegative']=$this->storeModel->getFeedback($data['dataProduct']['store_id'],'negativesum')->result_array()[0]['summarize'];
				$data['storeFeedbackCount']=$data['storeFeedbackCountPositive']+$data['storeFeedbackCountNegative'];
				$data['storeFeedback']=$this->storeModel->getFeedback($data['dataProduct']['store_id'],'all',0,5,1)->result_array();
				//STORE PELANGGAN
				$data['storeBuyersCount']=$this->storeModel->getBuyers($data['dataProduct']['store_id']);
				//STORE SENT TIME
				$data['storeAverageSentTime']=$this->storeModel->getAverageSentTime($data['dataProduct']['store_id']);
				//STOREACCEPTEDORDER
				$data['storeOrderAccepted']=$this->storeModel->getOrderCount($data['dataProduct']['store_id'],'accepted')->num_rows();
				$data['storeOrderTotal']=$this->storeModel->getOrderCount($data['dataProduct']['store_id'],'all')->num_rows();
				//PRODUCTREVIEW
				$data['productReviewAverage']=$this->productModel->getReview($product_id,'average');
				$data['productReviewCount']=$this->productModel->getReview($product_id,'count');
				$data['productReview']=$this->productModel->getReview($product_id,'data','5');
				$data['productRating']=$this->productModel->getReview($product_id,'rating');
				//PRODUCT VIEWERS
				  //cek apakah session_id ini sudah pernah lihat sebelumnya
					$session_id=session_id();
					$is_product_viewed=$this->productModel->getProductViewers($product_id,$session_id);
					if($is_product_viewed==0){
																		$this->db->query("INSERT INTO stil_marketplace.product_viewers
						                                          (session_id,product_id,lup)
																											VALUES
																											('$session_id','$product_id',now())
																						         ");
																		}
					//get total viewers untuk ditampilkan
					$data['productViewersCount']=$this->productModel->getProductViewers($product_id);

				//PRODUCT COURIER
				$data['couriers']=$this->courierModel->getCourierAvailableProduct($product_id);
				$data['cek']='y';
			}else{
				$data['cek']='n';
			}
			$this->load->view('appinfo');
			$this->load->view('productDetail/productDetail_s');
			$this->load->view('header');
			$this->load->view('productDetail/productDetail_v',$data);
			$this->load->view('footer');
			$this->load->view('productDetail/productDetail_x');


		}



		public function swishlist(){
			$produk=$_POST['id'];
			$store=$_POST['store'];
			$id_user=$this->session->userdata('user_id');

			$data=$this->productModel->getProductDetail($store,$produk)->result_array()[0];
			$id_product=$data['product_id'];

			$cek=$this->db->query("SELECT * FROM wishlist where id_user='$id_user' and id_product='$id_product'")->num_rows();
			if($cek>0){
				$this->db->query("DELETE FROM wishlist where id_user='$id_user' and id_product='$id_product'");
				$response="OKd";
			}else{
				$this->db->query("INSERT INTO wishlist values('','$id_user','$id_product',now())");
				$response="OKi";
			}
			echo $response;
		}

		public function getFeedbacks(){
			$this->load->model('storeModel');
			$store_id=$this->input->post('id');
			$data['storeFeedback']=$this->storeModel->getFeedback($store_id,'all')->result_array();
			$this->load->view('productDetail/template/feedbackModal',$data);
		}

		public function getReviews(){
			$product_id=$this->input->post('id');
			$data['productReview']=$this->productModel->getReview($product_id,'data','5');
			$this->load->view('productDetail/template/reviewModal',$data);
		}

}
