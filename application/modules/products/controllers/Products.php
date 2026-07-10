<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Products extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
		}


		public function index($categoryID=''){
			$this->load->model('courierModel');
			if(isset($_GET['page'])){
				$page=$_GET['page'];
			}else{
				$page='1';
			}

			if(isset($_GET['search_keyword'])){
				$search_keyword=$this->input->get('search_keyword');
			}else{
				$search_keyword="";
			}

			if(isset($_GET['sort'])){
				$sorting=$this->input->get('sort');
			}else{
				$sorting="newest";
			}

			if(isset($_GET['search_province'])){
				$location_p=$this->input->get('search_province');
			}else{
				$location_p="";
			}

			if(isset($_GET['search_city'])){
				$location_c=$this->input->get('search_city');
			}else{
				$location_c="";
			}

			if(isset($_GET['search_price_min'])){
				$price_min=$this->numberingModel->integerDeseparation(',',$this->input->get('search_price_min'));

				if($price_min<=0 || !is_numeric($price_min)){
					$price_min="";
				}
			}else{
				$price_min="";
			}

			if(isset($_GET['search_price_max'])){
				$price_max=$this->numberingModel->integerDeseparation(',',$this->input->get('search_price_max'));
				if($price_max<=0 || $price_max<$price_min || !is_numeric($price_max)){
					$price_max="";
				}
			}else{
				$price_max="";
			}

			if(isset($_GET['search_is_wholesale'])){
				$is_wholesale=$this->input->get('search_is_wholesale');
				if($is_wholesale=="1"){
					$is_wholesale="1";
				}else{
					$is_wholesale="0,1";
				}
			}else{
				$is_wholesale="0,1";
			}

			if(isset($_GET['search_is_discount'])){
				$is_discount=$this->input->get('search_is_discount');
				if($is_discount=="1"){
					$is_discount="1";
				}else{
					$is_discount="0,1";
				}
			}else{
				$is_discount="0,1";
			}

			if(isset($_GET['search_is_condition_new'])){
				$is_condition_new=$this->input->get('search_is_condition_new');
				if($is_condition_new==1){
					$is_condition_new=1;
				}else{
					$is_condition_new=0;
				}
			}else{
				$is_condition_new=1;
			}

			if(isset($_GET['search_is_condition_second'])){
				$is_condition_second=$this->input->get('search_is_condition_second');
				if($is_condition_second==1){
					$is_condition_second=1;
				}else{
					$is_condition_second=0;
				}
			}else{
				$is_condition_second=1;
			}
			if($is_condition_second==0 && $is_condition_new==0){
				$is_condition_second=1;
				$is_condition_new=1;
			}

			if(isset($_GET['search_minimum_rating'])){
				$search_minimum_rating=$this->input->get('search_minimum_rating');
				if($search_minimum_rating<0 || $search_minimum_rating>5){
					$search_minimum_rating=0;
				}
			}else{
				$search_minimum_rating=0;
			}

			if(isset($_GET['courier'])){
					$search_courier=$_GET['courier'];
			}else{
				$search_courier='all';
			}


			$data['searchVariable']="?search_keyword=$search_keyword&search_province=$location_p&search_city=$location_c&search_price_min=$price_min&search_price_max=$price_max&search_is_wholesale=$is_wholesale&search_is_discount=$is_discount&search_is_condition_new=$is_condition_new&search_is_condition_second=$is_condition_second&search_minimum_rating=$search_minimum_rating&sort=$sorting";
			$data_search = array(
				'keyword' => "$search_keyword",
				'price_min' => "$price_min",
				'price_max' => "$price_max",
				'is_wholesale' => "$is_wholesale",
				'is_discount' => "$is_discount",
				'is_condition_new' => "$is_condition_new",
				'is_condition_second' => "$is_condition_second",
				'search_minimum_rating'=>"$search_minimum_rating",
				'location_p'	=> "$location_p",
				'location_c'	=> "$location_c",
				'category'	=> "$categoryID",
				'sorting'	=> "$sorting",
				'courier'	=> "$search_courier",
				'activeMenu' => $this->productModel->getProductInCategoryMenuActive($categoryID)
				);

			$content_per_page=20;
			$start=($page>1)?($page*$content_per_page)-$content_per_page:0;


			$data['dataProduct']=$this->productModel->getProducts($data_search,$start,$content_per_page,'1')->result_array();
			$data['dataProductCount']=$this->productModel->getProducts($data_search,'','','')->num_rows();
			$data['couriers']=$this->courierModel->getCourierServiceList();

			$data['data_search']=$data_search;
			$data['lastLink']=0;
			$data['page']=$page;
			$data['pages']=ceil($data['dataProductCount']/$content_per_page);
			$data['content_per_page']=$content_per_page;


			$this->load->view('appinfo');
			$this->load->view('filter/filter_s');
			$this->load->view('header');
			$this->load->view('filter/filter_v',$data);
			$this->load->view('footer');
			$this->load->view('filter/filter_x');
		}


		public function getQuickview(){
			$produk=$_POST['id'];
			$store=$_POST['store'];
			$cek=$this->productModel->getProductDetail($store,$produk)->num_rows();

			if($cek>=1){
				//PRODUCT
				$data['product']=$this->productModel->getProductDetail($store,$produk)->result_array()[0];
				//IMAGE
				$data['dataProductImg']=$this->productModel->getProductImage($data['product']['product_id']);
				//CATEGORY
				$node=explode("-",$data['product']['id_category']);
				$data['product']['name_category']=$this->productModel->getCategoryNameSummary($node[0],$node[1]);
				//STOREFEEDBACK
				$data['storeFeedbackCountPositive']=$this->storeModel->getFeedback($data['product']['store_id'],'positivesum')->result_array()[0]['summarize'];
				$data['storeFeedbackCountNegative']=$this->storeModel->getFeedback($data['product']['store_id'],'negativesum')->result_array()[0]['summarize'];
				$data['storeFeedbackCount']=$data['storeFeedbackCountPositive']+$data['storeFeedbackCountNegative'];
				$data['cek']='y';
			}else{
				$data['cek']='n';
			}
			$this->load->view('template/product_quickviewModal',$data);
		}


}
