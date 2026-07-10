<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_wishlist extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('locationModel');
			$this->load->model('profileModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}

		public function profileWishlist(){
			$this->load->model('courierModel');
			if(isset($_GET['page'])){
				$page=$_GET['page'];
			}else{
				$page='1';
			}

			if(isset($_GET['sort'])){
				$sorting=$this->input->get('sort');
			}else{
				$sorting="newest";
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

			$data_search = array(
				'keyword' => "",
				'price_min' => "",
				'price_max' => "",
				'is_wholesale' => "0,1",
				'is_discount' => "0,1",
				'is_condition_new' => "1",
				'is_condition_second' => "1",
				'location_p'	=> "",
				'location_c'	=> "",
				'category'	=> "",
				'courier'	=> "all",
				'search_minimum_rating'=>"0",
				'sorting'	=> "$sorting"
				);

			$content_per_page=5;
			$start=($page>1)?($page*$content_per_page)-$content_per_page:0;


			$data['searchVariable']="?grid=true";
			$data['dataProduct']=$this->productModel->getWishlist($data_search,$start,$content_per_page,'1')->result_array();
			$data['dataProductCount']=$this->productModel->getWishlist($data_search,'','','')->num_rows();
			$data['data_search']=$data_search;
			$data['lastLink']=0;
			$data['page']=$page;
			$data['pages']=ceil($data['dataProductCount']/$content_per_page);
			$data['content_per_page']=$content_per_page;

			$this->load->view('appinfo');
			$this->load->view('profile-wishlist/profileWishlist_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('profile-wishlist/profileWishlist_v',$data);
			$this->load->view('footer');
			$this->load->view('profile-wishlist/profileWishlist_x');
		}


}
