<?php
	class Seller_Center extends CI_Controller{
		public function index() {
			$this->load->view('appinfo');
			$this->load->view('dashboard/seller_center_dashboard_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('dashboard/seller_center_dashboard_v');
			$this->load->view('footer');
			$this->load->view('dashboard/seller_center_dashboard_x');
		}

		public function dashboard() {
			$this->load->view('appinfo');
			$this->load->view('dashboard/seller_center_dashboard_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('dashboard/seller_center_dashboard_v');
			$this->load->view('footer');
			$this->load->view('dashboard/seller_center_dashboard_x');
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
			$this->load->view('rekening/seller_center_rekening_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('rekening/seller_center_rekening_v');
			$this->load->view('footer');
			$this->load->view('rekening/seller_center_rekening_x');			
		}


	}
