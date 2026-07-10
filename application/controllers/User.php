<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
				parent::__construct();
				$this->load->model('authModel');
			if($this->session->userdata('status') != "login"){
					redirect(base_url("login"));
				}
			}

	public function index()
	{

	}

	public function profile()
	{
		$email=$this->session->userdata('email');
		$datauser=$this->authModel->login_fetch($email);
		$data['user']=$datauser[0];

		$this->load->view('includes/title');
		$this->load->view('user/profile/head');
		$this->load->view('includes/header');
		$this->load->view('user/profile/content',$data);
		$this->load->view('includes/footer');
	}

	public function profileUpdate(){
			$date=$this->input->post('date');
			$phone=$this->input->post('phone');
			$address=$this->input->post('address');
			$job=$this->input->post('job');
			$bio=$this->input->post('bio');
			$company=$this->input->post('company');

			$id=$this->session->userdata('user_id');
			$email=$this->session->userdata('email');


				$query="UPDATE stil.user_client set birthdate='$date',role='$job',company='$company',phone='$phone',address='$address',bio='$bio' where id=".$this->db->escape($id)." and email=".$this->db->escape($email);

				$insert=$this->db->query($query);
				$insert_log=$this->db->query("INSERT INTO log_user_client_update VALUES('','$email',".$this->db->escape($query).",now() )" );

				if($insert && $insert_log){
					echo "SUCCESS";
				}else{
					echo "FAILED UPDATE";
				}
	}

	public function passwordUpdate(){
			$oldpassword=$this->input->post('oldpassword');
			$password=$this->input->post('password');
			$oldpassword=md5($oldpassword);
			$password= md5($password);
			$password=password_hash($password,PASSWORD_DEFAULT);

			$id=$this->session->userdata('user_id');
			$email=$this->session->userdata('email');


			$query=$this->db->query("SELECT password FROM stil.user_client where email=".$this->db->escape($email));
			$cek_email=$query->num_rows();
			if($cek_email>0){
				$cek_password=$query->result_array();
				$passworddb=$cek_password[0]['password'];

				if(password_verify($oldpassword,$passworddb)){
						$updatePassword=$this->db->query("UPDATE stil.user_client set password='$password' where email=".$this->db->escape($email));
						$updatePasswordLog=$this->db->query("INSERT into log_user_client_pwupdate values('','$email','$passworddb','$password',now())");
						if($updatePassword && $updatePasswordLog){
							echo "SUCCESS";
						}else{
							echo "FAILED UPDATE";
						}
				}else{
					echo "WRONG OLD PASSWORD";
				}

			}else{
				echo "FAILED UPDATE";
			}


	}

}
