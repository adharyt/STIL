<?php
class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('authModel');



	}



		function login(){
			if($this->session->userdata('status') == "login"){
					redirect(base_url("dashboard"));
				}
			$this->load->view('auth/login');

		}

		function login_auth(){


	  		$email = strtolower($this->input->post('email'));
	  		$password = $this->input->post('password');

				$password= md5($password);

				$query=$this->db->query("SELECT email,password FROM user_client where email=".$this->db->escape($email));
				$cek_email=$query->num_rows();
				if($cek_email>0){
					$cek_password=$query->result_array();
					$passworddb=$cek_password[0]['password'];

					if(password_verify($password,$passworddb)){
						$data['session']=$this->authModel->login_fetch($email);

						switch($data['session'][0]['status']){

						case '0':
								echo "NOT VALIDATE";
								break;
						case '1':
		  			$data_session = array(
		  				'user_id' => $data['session'][0]['iduser'],
		  				'name' => $data['session'][0]['name'],
		  				'email' => $data['session'][0]['email'],
							'gender' => $data['session'][0]['gender'],
							'photo' => $data['session'][0]['photo'],
							'theme' => $data['session'][0]['theme'],
		        	'status' => "login"
		  				);


							$this->session->set_userdata($data_session);

						//SESSION LOG
						$agent = $_SERVER['HTTP_USER_AGENT'];
						// Detect Device/Operating System
						if(preg_match('/Linux/i',$agent)) $os = 'Linux';
						  elseif(preg_match('/Mac/i',$agent)) $os = 'Mac';
						  elseif(preg_match('/iPhone/i',$agent)) $os = 'iPhone';
						  elseif(preg_match('/iPad/i',$agent)) $os = 'iPad';
						  elseif(preg_match('/Droid/i',$agent)) $os = 'Droid';
						  elseif(preg_match('/Unix/i',$agent)) $os = 'Unix';
						  elseif(preg_match('/Windows/i',$agent)) $os = 'Windows';
						  else $os = 'Unknown';
						// Browser Detection
						if(preg_match('/Firefox/i',$agent)) $br = 'Firefox';
						  elseif(preg_match('/Mac/i',$agent)) $br = 'Mac';
						  elseif(preg_match('/Chrome/i',$agent)) $br = 'Chrome';
						  elseif(preg_match('/Opera/i',$agent)) $br = 'Opera';
						  elseif(preg_match('/MSIE/i',$agent)) $br = 'IE';
						  else $br = 'Unknown';
						// IP Address detection
							$ipaddress = '';
					    if (isset($_SERVER['HTTP_CLIENT_IP']))
					        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
					    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
					        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
					    else if(isset($_SERVER['HTTP_X_FORWARDED']))
					        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
					    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
					        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
					    else if(isset($_SERVER['HTTP_FORWARDED']))
					        $ipaddress = $_SERVER['HTTP_FORWARDED'];
					    else if(isset($_SERVER['REMOTE_ADDR']))
					        $ipaddress = $_SERVER['REMOTE_ADDR'];
					    else
					        $ipaddress = 'UNKNOWN';

								$this->db->query("INSERT INTO log_session_client values('','$email','$br','$os','$ipaddress',now())");
								echo "PASSWORD MATCH";
								break;

						case '2':
								echo "BLOCKED";
								break;
						default:
								echo "NETWORK ERROR";


					}


					}else{
						echo "WRONG PASSWORD";
					}
				}else{
					echo "EMAIL NOT REGISTERED";
				}



	 }

  	function logout(){
  		$this->session->sess_destroy();
  		redirect(base_url('login'));
  	}



}
