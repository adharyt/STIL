<?php
	class Sc_settings extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');
			$this->load->model('locationModel');
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

		public function index() {
			$dataInfo['profilPenjual']=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));

			$this->load->view('appinfo');
			$this->load->view('main/seller_center_main_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('main/seller_center_main_v');
			$this->load->view('footer');
			$this->load->view('main/seller_center_main_x');

		}

		// SHIPPING START //

		public function courierShipping() {
			$data['couriers_stil']=$this->seller_centerModel->getCourierList($this->session->userdata('username'),'STIL');
			$data['couriers_abke']=$this->seller_centerModel->getCourierList($this->session->userdata('username'),'ABKE');
			$data['couriers_bade']=$this->seller_centerModel->getCourierList($this->session->userdata('username'),'BADE');
			$data['infoToko']=$this->seller_centerModel->getStoreDetail($this->session->userdata('username'));
			$this->load->view('appinfo');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_v',$data);
			$this->load->view('footer');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_x');
		}

		public function courierShippingSchedule() {
			$data['couriers']=$this->seller_centerModel->getCourierList($this->session->userdata('username'));
			$data['infoToko']=$this->seller_centerModel->getStoreDetail($this->session->userdata('username'));
			$this->load->view('appinfo');
			$this->load->view('shipping_schedule/seller_center_courier_shipping-schedule_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('shipping_schedule/seller_center_courier_shipping-schedule_v',$data);
			$this->load->view('footer');
			$this->load->view('shipping_schedule/seller_center_courier_shipping-schedule_x');
		}

		public function shippingCourierUpdate() {
			$id=$this->input->post('id');
			$prop=$this->input->post('prop');
			$id_seller=$this->session->userdata('user_id');

			if($prop==1){
				$query="INSERT INTO store_default_courier (id_store,id_courier_service) VALUES('$id_seller','$id')";
			}else{
				$query="DELETE FROM store_default_courier WHERE id_store='$id_seller' and id_courier_service='$id'";
			}

			$exe=$this->db->query($query);
			if($exe){echo "SUCCESS";}
		}

		public function shippingDayUpdate() {
			$day=$this->input->post('id');
			$prop=$this->input->post('prop');
			$id_seller=$this->session->userdata('user_id');

			if($day=='all'){
				if($prop==1){
					$query="UPDATE store set store_open_sunday='1',
																	 store_open_monday='1',
																	 store_open_tuesday='1',
																	 store_open_wednesday='1',
																	 store_open_thursday='1',
																	 store_open_friday='1',
																	 store_open_saturday='1'
																	 WHERE id_user='$id_seller'";
				}else{
					$query="UPDATE store set store_open_sunday='0',
																	 store_open_monday='0',
																	 store_open_tuesday='0',
																	 store_open_wednesday='0',
																	 store_open_thursday='0',
																	 store_open_friday='0',
																	 store_open_saturday='0'
																	 WHERE id_user='$id_seller'";
				}
			}else{
				if($prop==1){
					$query="UPDATE store set store_open_$day='1' WHERE id_user='$id_seller'";
				}else{
					$query="UPDATE store set store_open_$day='0' WHERE id_user='$id_seller'";
				}
			}





			$exe=$this->db->query($query);
			if($exe){
				$cek=$this->db->query("SELECT * FROM store where store_open_sunday='1' and
																												 store_open_monday='1' and
																												 store_open_tuesday='1' and
																												 store_open_wednesday='1' and
																												 store_open_thursday='1' and
																												 store_open_friday='1' and
																												 store_open_saturday='1' and
																												 id_user='$id_seller'")->num_rows();
				if($cek>0){
					echo "SUCCESS-ALL";
				}else{
					echo "SUCCESS";
				}
			}else{
				echo "FAILED";
			}
		}

		public function shippingHourUpdate() {
			$time=$this->input->post('time');
			$id_seller=$this->session->userdata('user_id');
			$query="UPDATE store set store_lastdelivery='$time' where id_user='$id_seller'";
			$exe=$this->db->query($query);
			if($exe){echo "SUCCESS";}
		}

		public function shippingProcesstimeUpdate() {
			$process_type=$this->input->post('process_type');
			$processtime_instan=$this->input->post('processtime_instan');
			$processtime_preorder=$this->input->post('processtime_preorder');

			$id_seller=$this->session->userdata('user_id');
			$query="UPDATE store set store_processtime_id='$process_type',store_processtime_instan='$processtime_instan',store_processtime_preorder='$processtime_preorder' where id_user='$id_seller'";
			$exe=$this->db->query($query);
			if($exe){echo "SUCCESS";}
		}

		// SHIPPING END //

		// STORE START //
		public function store() {
			$data['infoToko']=$this->seller_centerModel->getStoreDetail($this->session->userdata('username'));
			$this->load->view('appinfo');
			$this->load->view('store/main/seller_center_store_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('store/main/seller_center_store_v',$data);
			$this->load->view('footer');
			$this->load->view('store/main/seller_center_store_x');

		}

		public function storeInfo() {
			$data['infoToko']=$this->seller_centerModel->getStoreDetail($this->session->userdata('username'));
			$this->load->view('appinfo');
			$this->load->view('store/store-info/seller_center_store_info_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('store/store-info/seller_center_store_info_v',$data);
			$this->load->view('footer');
			$this->load->view('store/store-info/seller_center_store_info_x');

		}

		public function editStoreInfo(){
			$this->load->model('locationModel');
			$id_user=$this->session->userdata('user_id');
			$description=$this->input->post('description');
			$notes=$this->input->post('notes');
			$telepon=$this->input->post('telepon');
			$kecamatan=$this->input->post('kecamatan');
			$kota=$this->locationModel->getParentID($kecamatan)['id_parent'];
			$kodepos=$this->input->post('kodepos');
			$alamat=$this->input->post('alamat');
			$this->db->query("UPDATE store set store_description='$description',store_notes='$notes',store_phone='$telepon',store_city='$kota',store_subcity='$kecamatan',store_postalcode='$kodepos',store_address='$alamat' WHERE id_user='$id_user'");
		}

		public function closeStore() {
			$this->load->view('appinfo');
			$this->load->view('store/close-store/seller_center_close_store_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('store/close-store/seller_center_close_store_v');
			$this->load->view('footer');
			$this->load->view('store/close-store/seller_center_close_store_x');

		}

		public function merchantNotes() {
			$this->load->view('appinfo');
			$this->load->view('store/merchant-notes/seller_center_merchant_notes_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('store/merchant-notes/seller_center_merchant_notes_v');
			$this->load->view('footer');
			$this->load->view('store/merchant-notes/seller_center_merchant_notes_x');

		}

		public function storeVerification() {
			$this->load->view('appinfo');
			$this->load->view('store/store-verification/seller_center_store_verification_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('store/store-verification/seller_center_store_verification_v');
			$this->load->view('footer');
			$this->load->view('store/store-verification/seller_center_store_verification_x');
		}

		public function editStoreAddress() {
			$this->load->view('appinfo');
			$this->load->view('store/address/seller_center_edit_store_address_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('store/address/seller_center_edit_store_address_v');
			$this->load->view('footer');
			$this->load->view('store/address/seller_center_edit_store_address_x');
		}
		// STORE END //


		// ADDRESS START //
		public function address() {
			$this->load->view('appinfo');
			$this->load->view('address/seller_center_address_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('address/seller_center_address_v');
			$this->load->view('footer');
			$this->load->view('address/seller_center_address_x');

		}
		// ADDRESS END //


	}
