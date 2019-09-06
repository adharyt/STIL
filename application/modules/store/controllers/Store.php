<?php
	class Store extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('storeModel');
			$this->load->model('productModel');
		}

		public function index($unameStoreOwner,$storefront_id=''){
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
				$price_min=$this->input->get('search_price_min');
				if($price_min<=0 || !is_numeric($price_min)){
					$price_min="";
				}
			}else{
				$price_min="";
			}

			if(isset($_GET['search_price_max'])){
				$price_max=$this->input->get('search_price_max');
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


			$data['searchVariable']="?search_keyword=$search_keyword&search_province=$location_p&search_city=$location_c&search_price_min=$price_min&search_price_max=$price_max&search_is_wholesale=$is_wholesale&search_is_discount=$is_discount&search_is_condition_new=$is_condition_new&search_is_condition_second=$is_condition_second&sort=$sorting";
			$data_search = array(
				'keyword' => "$search_keyword",
				'price_min' => "$price_min",
				'price_max' => "$price_max",
				'is_wholesale' => "$is_wholesale",
				'is_discount' => "$is_discount",
				'is_condition_new' => "$is_condition_new",
				'is_condition_second' => "$is_condition_second",
				'location_p'	=> "$location_p",
				'location_c'	=> "$location_c",
				'category'	=> "",
				'sorting'	=> "$sorting"
				);

			$content_per_page=20;
			$start=($page>1)?($page*$content_per_page)-$content_per_page:0;


			$data['dataProduct']=$this->productModel->getProductsPerStorefront($unameStoreOwner,$storefront_id,$data_search,$start,$content_per_page,'1')->result_array();
			$data['dataProductCount']=$this->productModel->getProductsPerStorefront($unameStoreOwner,$storefront_id,$data_search,'','','')->num_rows();
			$data['data_search']=$data_search;
			$data['lastLink']=0;
			$data['page']=$page;
			$data['pages']=ceil($data['dataProductCount']/$content_per_page);
			$data['content_per_page']=$content_per_page;

			$data['etalasePenjual']=$this->storeModel->getStoreFrontList($unameStoreOwner);
			$data['profilPenjual']=$this->storeModel->getStoreProfile($unameStoreOwner);
			$data['activeEtalase']=$storefront_id;

			$this->load->view('appinfo');
			$this->load->view('dashboard_penjual_s');
			$this->load->view('header');
			$this->load->view('dashboard_penjual_v',$data);
			$this->load->view('footer');
			$this->load->view('dashboard_penjual_x');
		}


		public function store_header_upload(){
			if(isset($_POST["image"])){
				 $data = $_POST["image"];
				 $username=$this->session->userdata('username');
				 $user_id=$this->session->userdata('user_id');



				if(exif_imagetype($data)) {
					// Generate new random name.
				 $name = sha1(microtime()) . ".png";
				 $path="$_SERVER[DOCUMENT_ROOT]/stil/document_upload/".$username."/my-data/storeheader";
				 if (!file_exists($path)) {
					 mkdir($path, 0777, true);
				 }
				 $image_array_1 = explode(";", $data);

				 $image_array_2 = explode(",", $image_array_1[1]);

				 $data = base64_decode($image_array_2[1]);

				 if(file_put_contents($path."/".$name, $data)){
					 $update=$this->db->query("UPDATE store set store_header='$name' where id_user='$user_id'");
					 if($update){
						 $response=$this->userModel->getHeaderPhoto($username,$name);
					 }else{
						 $response="FAILED";
					 }
				 }else{
					 $response="FAILED";
				 }
				}else{
					$response="FAILED";
				}
			}else{
				$response="FAILED";
			}
			echo $response;
		}



	}
