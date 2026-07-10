<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_settings_password extends CI_Controller{
		public function __construct(){
			parent::__construct();
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}

		public function profileSettingsPassword(){
			$this->load->view('appinfo');
			$this->load->view('profile_settings_password_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('profile_settings_password_v');
			$this->load->view('footer');
			$this->load->view('profile_settings_password_x');
		}

		public function checkOldPassword(){
			$password=md5($this->input->post('password'));
			$user_id=$this->session->userdata('user_id');

			$passworddb=$this->db->query("SELECT password FROM stil.user_client where id='$user_id'")->result_array()[0]['password'];
			if(password_verify($password,$passworddb)){
				echo "OK";
			}else{
				echo "NOT OK";
			}
		}

		public function change(){
			$id=$this->session->userdata('user_id');
			$old_password=md5($this->input->post('old_password'));
			$password=md5($this->input->post('password'));

			$passworddb=$this->db->query("SELECT password FROM stil.user_client where id='$id'")->result_array()[0]['password'];

			if(password_verify($old_password,$passworddb)){
				$password=password_hash($password,PASSWORD_DEFAULT);
				$this->db->query("UPDATE stil.user_client set password='$password' WHERE id='$id'");
				$this->db->query("INSERT INTO log_change_password (id_user,old_password,new_password,lup) VALUES ('$id','$passworddb','$password',now()) ");
				echo "OK";
			}else{
				echo "NOT FOUND";
			}
		}

}
