<?php
	class Seller_Center extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');

		}


		public function index() {
			$dataInfo['profilPenjual']=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));

			$this->load->view('appinfo');
			$this->load->view('dashboard/seller_center_dashboard_s');
			$this->load->view('seller_center_header',$dataInfo);
			$this->load->view('seller_center_sidebar',$dataInfo);
			$this->load->view('dashboard/seller_center_dashboard_v',$dataInfo);
			$this->load->view('footer');
			$this->load->view('main/seller_center_main_x');
		}

		public function mainDashboard() {
			$this->load->view('appinfo');
			$this->load->view('main/seller_center_main_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('main/seller_center_main_v');
			$this->load->view('footer');
			$this->load->view('main/seller_center_main_x');
		}

		// SHIPPING START //

		public function courierShippingSchedule() {

			$data['couriers']=$this->seller_centerModel->getCourierList($this->session->userdata('username'));
			$data['infoToko']=$this->seller_centerModel->getStoreDetail($this->session->userdata('username'));
			$this->load->view('appinfo');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_v',$data);
			$this->load->view('footer');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_x');
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
			if($exe){echo "SUCCESS";}
		}

		public function shippingHourUpdate() {
			$time=$this->input->post('time');
			$id_seller=$this->session->userdata('user_id');
			$query="UPDATE store set store_lastdelivery='$time' where id_user='$id_seller'";
			$exe=$this->db->query($query);
			if($exe){echo "SUCCESS";}
		}

		// SHIPPING END //


		public function address() {
			$this->load->view('appinfo');
			$this->load->view('address/seller_center_address_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('address/seller_center_address_v');
			$this->load->view('footer');
			$this->load->view('address/seller_center_address_x');
		}

		public function rekening() {
			$this->load->view('appinfo');
			$this->load->view('rekening/seller_center_rekening_bank_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('rekening/seller_center_rekening_bank_v');
			$this->load->view('footer');
			$this->load->view('rekening/seller_center_rekening_bank_x');
		}

		public function store() {
			$data['infoToko']=$this->seller_centerModel->getStoreDetail($this->session->userdata('username'));
			$this->load->view('appinfo');
			$this->load->view('store/main/seller_center_store_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('store/main/seller_center_store_v',$data);
			$this->load->view('footer');
			$this->load->view('store/main/seller_center_store_x');
		}

		public function storeInfo() {
			$this->load->view('appinfo');
			$this->load->view('store/store-info/seller_center_store_info_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('store/store-info/seller_center_store_info_v');
			$this->load->view('footer');
			$this->load->view('store/store-info/seller_center_store_info_x');
		}

		public function closeStore() {
			$this->load->view('appinfo');
			$this->load->view('store/close-store/seller_center_close_store_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('store/close-store/seller_center_close_store_v');
			$this->load->view('footer');
			$this->load->view('store/close-store/seller_center_close_store_x');
		}

		public function merchantNotes() {
			$this->load->view('appinfo');
			$this->load->view('store/merchant-notes/seller_center_merchant_notes_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
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

		public function storefront() {
			$this->load->view('appinfo');
			$this->load->view('storefront/seller_center_storefront_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('storefront/seller_center_storefront_v');
			$this->load->view('footer');
			$this->load->view('storefront/seller_center_storefront_x');			
		}

	}
