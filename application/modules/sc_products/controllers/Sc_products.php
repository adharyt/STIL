<?php
	class Sc_products extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');
			$this->load->model('sc_productsModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
			$user_id=$this->session->userdata('user_id');
			$this->load->model('storeModel');
			if($this->storeModel->checkIsHaveStore($user_id)!=1){
				redirect('my-store/register');
			}
		}

		public function index(){
			$this->load->model('courierModel');
			$id_user=$this->session->userdata('user_id');
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


			$data['searchVariable']="?search_keyword=$search_keyword&search_province=$location_p&search_city=$location_c&search_price_min=$price_min&search_price_max=$price_max&search_is_wholesale=$is_wholesale&search_is_discount=$is_discount&search_is_condition_new=$is_condition_new&search_is_condition_second=$is_condition_second&sort=$sorting";
			$data_search = array(
				'keyword' => "$search_keyword",
				'price_min' => "$price_min",
				'price_max' => "$price_max",
				'is_wholesale' => "$is_wholesale",
				'is_discount' => "$is_discount",
				'is_condition_new' => "$is_condition_new",
				'is_condition_second' => "$is_condition_second",
				'search_minimum_rating'=>"$search_minimum_rating",
				'courier'	=> "$search_courier",
				'location_p'	=> "$location_p",
				'location_c'	=> "$location_c",
				'category'	=> "",
				'sorting'	=> "$sorting"
				);

			$content_per_page=5;
			$start=($page>1)?($page*$content_per_page)-$content_per_page:0;

			$data['products']=$this->productModel->getProductsPerStoreAdmin($id_user,$data_search,$start,$content_per_page,'1')->result_array();
			$data['dataProductCount']=$this->productModel->getProductsPerStoreAdmin($id_user,$data_search,'','','')->num_rows();
			$data['data_search']=$data_search;
			$data['lastLink']=0;
			$data['page']=$page;
			$data['pages']=ceil($data['dataProductCount']/$content_per_page);
			$data['content_per_page']=$content_per_page;

			$this->load->view('appinfo');
			$this->load->view('main/seller_center_product_main_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('main/seller_center_product_main_v',$data);
			$this->load->view('footer');
			$this->load->view('main/seller_center_product_main_x');
		}

		public function deleteProduct(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');
			$cek=$this->db->query("SELECT * from product where id_user='$id_user' and id='$id'")->num_rows();
			if($cek>=1){
				$delete=$this->db->query("UPDATE product set is_deleted=1,is_visibility=0 WHERE id_user='$id_user' and id='$id'");
				if($delete){
					echo "OK";
				}else{
					echo "FAILED";
				}
			}else{
				echo "FAILED";
			}

		}

		public function updateVisibility(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');
			$visibility=$this->input->post('visibility');
			$cek=$this->db->query("SELECT * from product where id_user='$id_user' and id='$id' and stock>0")->num_rows();
			if($cek>=1){
				$update=$this->db->query("UPDATE product set is_visibility='$visibility',last_updated=now() WHERE id_user='$id_user' and id='$id'");
				if($update){
					echo "OK";
				}else{
					echo "FAILED";
				}
			}else{
				echo "FAILED";
			}

		}

		public function getProductDiscount(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');
			$cek=$this->db->query("SELECT *,id as product_id from product where id_user='$id_user' and id='$id'");
			if($cek->num_rows()>=1){
				$data['product']=$cek->result_array()[0];
				$this->load->view('modal/discountModal',$data);
			}else{
				echo "FAILED";
			}

		}

		public function setProductDiscount(){
			$id_user=$this->session->userdata('user_id');
			$id=$this->input->post('id');
			$discount_start=$this->input->post('discount_start');
			$discount_end=$this->input->post('discount_end');
			$disc_value=$this->input->post('disc_value');
			$disc_is_grosir=$this->input->post('disc_is_grosir');

			$update=$this->db->query("UPDATE product set discount_start='$discount_start',
																									 discount_end='$discount_end',
																									 discount_value='$disc_value',
																									 is_discount_grosir='$disc_is_grosir'
															  WHERE id='$id' and id_user='$id_user'
															");


			if($update){
				$this->db->query("INSERT INTO log_product_discount
					                (id_product,discount_start,discount_end,discount_value,discount_grosir,is_assigned,lup)
													VALUES
													('$id','$discount_start','$discount_end','$disc_value','$disc_is_grosir',1,now())
												 ");
				echo "OK";
			}else{
				echo "FAILED";
			}


		}

	}
