<?php
	class Profile extends CI_Controller{
		public function index(){
			$this->load->view('appinfo');
			$this->load->view('editProfile_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-summary/profileSummary_v');
			$this->load->view('footer');
			$this->load->view('contact_x');
		}

		public function profileEdit(){
			$this->load->view('appinfo');
			$this->load->view('editProfile_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-edit/profileEdit_v');
			$this->load->view('footer');
			$this->load->view('editProfile_x');
		}

		public function profileSummary(){
			$this->load->view('appinfo');
			$this->load->view('editProfile_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-summary/profileSummary_v');
			$this->load->view('footer');
			$this->load->view('editProfile_x');
		}

		public function profileAddress(){
			$this->load->view('appinfo');
			$this->load->view('profile-address/profile_address_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-address/profile_address_v');
			$this->load->view('footer');
			$this->load->view('profile-address/profile_address_x');
		}
	}
