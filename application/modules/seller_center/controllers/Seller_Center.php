<?php
	class Seller_Center extends CI_Controller{
		public function index() {
			$this->load->view('appinfo');
			$this->load->view('main/seller_center_main_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('main/seller_center_main_v');
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

		public function courierShippingSchedule() {
			$this->load->view('appinfo');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_v');
			$this->load->view('footer');
			$this->load->view('shipping/seller_center_courier_shipping-schedule_x');			
		}

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
			$this->load->view('appinfo');
			$this->load->view('store/main/seller_center_store_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('store/main/seller_center_store_v');
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
