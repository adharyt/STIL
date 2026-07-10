<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_settings extends CI_Controller{
		public function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}

		public function profileSettings(){
			$this->load->view('appinfo');
			$this->load->view('profile_settings_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('profile_settings_v');
			$this->load->view('footer');
			$this->load->view('profile_settings_x');
		}

}
