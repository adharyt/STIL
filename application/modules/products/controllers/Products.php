<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Products extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
		}


		public function index(){
			isset($_GET['search'])?$search_keyword=$_GET['search']:$search_keyword="";

			//wew
			$data['dataProduct']=$this->productModel->getProducts()->result_array();
			$data['dataProductCount']=$this->productModel->getProducts()->num_rows();
			$this->load->view('appinfo');
			$this->load->view('allFilter/productsDetail_s');
			$this->load->view('header');
			$this->load->view('allFilter/productsDetail_v',$data);
			$this->load->view('footer');
			$this->load->view('allFilter/productsDetail_x');
		}

		public function getQuickview(){
			$produk=$_POST['id'];
			$store=$_POST['store'];

			//PRODUCT
			$data['productQV']=$this->productModel->getProductDetail($store,$produk)->result_array()[0];
			//IMAGE
			$data['dataProductImg']=$this->productModel->getProductImage($data['productQV']['product_id']);
			//CATEGORY
			$node=explode("-",$data['productQV']['id_category']);
			$data['productQV']['name_category']=$this->productModel->getCategoryNameSummary($node[0],$node[1]);
			//STOREFEEDBACK
			$data['storeFeedbackCountPositive']=$this->productModel->getFeedback($data['productQV']['store_id'],'positive')->num_rows();
			$data['storeFeedbackCount']=$this->productModel->getFeedback($data['productQV']['store_id'],'all')->num_rows();
			$data['storeFeedback']=$this->productModel->getFeedback($data['productQV']['store_id'],'all')->result_array();

			$this->load->view('allFilter/quickviewModal',$data);
		}
}
