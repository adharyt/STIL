<?php
	class Store extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('storeModel');
		}

		public function index($unameStoreOwner){

			$data['etalasePenjual']=$this->storeModel->getStoreFrontList($unameStoreOwner);


			$this->load->view('appinfo');
			$this->load->view('dashboard_penjual_s');
			$this->load->view('header');
			$this->load->view('dashboard_penjual_v',$data);
			$this->load->view('footer');
			$this->load->view('dashboard_penjual_x');
		}



	}
