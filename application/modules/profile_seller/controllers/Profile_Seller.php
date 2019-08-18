<?php
	class Profile_Seller extends CI_Controller{
		public function index(){
			$this->load->view('appinfo');
			$this->load->view('dashboard_penjual_s');
			$this->load->view('header');
			$this->load->view('dashboard_penjual_v');
			$this->load->view('footer');
			$this->load->view('dashboard_penjual_x');
		}

	}
