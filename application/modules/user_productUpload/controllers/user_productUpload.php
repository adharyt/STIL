<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class user_productUpload extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('timeModel');
			$this->load->model('productModel');
		}

		public function index(){
			echo "test";
		}

		public function detail($store_id,$product_id){
			$data['dataProduct']=$this->productModel->getProductDetail($store_id,$product_id)->result_array()[0];
			$data['dataProductImg']=$this->productModel->getProductImage($product_id);

			$this->load->view('appinfo');
			$this->load->view('productDetail_s');
			$this->load->view('header');
			$this->load->view('productDetail_v',$data);
			$this->load->view('footer');
			$this->load->view('productDetail_x');


		}

}
