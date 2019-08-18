<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Contact extends CI_Controller{
		public function index(){
			$this->load->view('appinfo');
			$this->load->view('contact_s');
			$this->load->view('header');
			$this->load->view('contact_v');
			$this->load->view('template/subscribe_panel');
			$this->load->view('footer');
			$this->load->view('contact_x');
		}

		public function send(){
			$name=$this->input->post('name');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$message=$this->input->post('message');

			$insert=$this->db->query("INSERT INTO crm_message(
				`name`,
				`email`,
				`phone`,
				`message`,
				`status`,
				`lup`
			)
			values
			(
				".$this->db->escape($name).",
				".$this->db->escape($email).",
				".$this->db->escape($phone).",
				".$this->db->escape($message).",
				0,
				now()
			)");

			if($insert){
				echo "OK";
			}else{
				echo "ERROR";
			}

		}
	}
