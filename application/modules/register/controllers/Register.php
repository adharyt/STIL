<?php
	class Register extends CI_Controller{
		public function index(){
			$this->load->view('v_register');
		}


		public function register_submit(){
				$name=$_POST['name'];
				$date=$_POST['date'];
				$gender=$_POST['gender'];
				$phone=$_POST['phone'];
				$email=$_POST['email'];
				$password=$_POST['password'];
				$pin=$_POST['pin'];
				$password=md5($password);
				$password=password_hash($password,PASSWORD_DEFAULT);


				$email_check=$this->db->query("SELECT * from user_client where email='$email'")->num_rows();
				$email_check+0;

				$phone_check=$this->db->query("SELECT * from user_client where phone='$phone'")->num_rows();
				$phone_check+0;

				if($email_check>0){
					echo "FAILED DUPLICATE EMAIL";
				}else if($phone_check>0){
					echo "FAILED DUPLICATE PHONE";
				}else{
					$this->db->query("INSERT INTO user_client (
						name,
						gender,
						birthdate,
						email,
						phone,
						password,
						pin,
						status,
						lup,
						is_deleted
					)
					values (
						'$name',
						'$gender',
						'$date',
						'$email',
						'$phone',
						'$password',
						'$pin',
						0,
						now(),
						0
					)
					");

					$cek=$this->db->query("SELECT * from user_client where email='$email'")->num_rows();
					if($cek>0){
						echo "SUCCESS";
					}else{
						echo "FAILED INSERT";
					}

				}

		}
	}
