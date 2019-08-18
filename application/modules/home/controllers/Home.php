<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller{
		public function index(){
			$this->load->view('appinfo');
			$this->load->view('home_s');
			$this->load->view('header');
			$this->load->view('home_v');
			$this->load->view('template/subscribe_panel');
			$this->load->view('footer');
			$this->load->view('home_x');
		}
	}
