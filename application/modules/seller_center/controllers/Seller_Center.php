<?php
	class Seller_Center extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');

		}


		public function index() {
			$dataInfo['profilPenjual']=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));

			$this->load->view('appinfo');
			$this->load->view('main/seller_center_main_s');
			$this->load->view('seller_center_header',$dataInfo);
			$this->load->view('seller_center_sidebar',$dataInfo);
			$this->load->view('main/seller_center_main_v',$dataInfo);
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






		public function rekening() {
			$this->load->view('appinfo');
			$this->load->view('rekening/seller_center_rekening_bank_s');
			$this->load->view('seller_center_header');
			$this->load->view('seller_center_sidebar');
			$this->load->view('rekening/seller_center_rekening_bank_v');
			$this->load->view('footer');
			$this->load->view('rekening/seller_center_rekening_bank_x');
		}



		




	}
