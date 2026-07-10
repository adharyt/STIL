<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller{
		public function index(){


			$dataFlash=array('32','84');
			$data['dataProductFlash']['dataProduct']=$this->productModel->getProductsFeatured($dataFlash)->result_array();
			$dataFeatured=array('1','28','29','30','31','32','33','84','83');
			$data['dataProductFeatured']['dataProduct']=$this->productModel->getProductsFeatured($dataFeatured)->result_array();
			$dataSale=array('33','28','29','30','31','32','1');
			$data['dataProductSale']['dataProduct']=$this->productModel->getProductsFeatured($dataSale)->result_array();

			$this->load->view('appinfo');
			$this->load->view('home_s');
			$this->load->view('header');
			$this->load->view('home_v',$data);
			$this->load->view('template/subscribe_panel');
			$this->load->view('footer');
			$this->load->view('home_x');
			$this->load->view('header_javascript');
		}
	}
