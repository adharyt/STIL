<?php
	class Profile extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model($this->config->item('landing_profileModel'));
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
		}


		public function profileEdit(){
			$this->load->model('optionModel');

			$data['lastEdu']=$this->optionModel->get_lastEdu();
			$data['profile']=$this->profileModel->getProfile($this->session->userdata('user_id'));

			$this->load->view('appinfo');
			$this->load->view('editProfile_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('editProfile_v',$data);
			$this->load->view('footer');
			$this->load->view('editProfile_x');
		}





		public function editSave(){
			$nama=$this->input->post('nama');
			$birthdate=$this->input->post('birthdate');
			$gender=$this->input->post('gender');
			$education=$this->input->post('education');
			$ktp_no=$this->input->post('ktp_no');
			$phone=$this->input->post('phone');

			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'name' => $nama,
				'birthdate' => $birthdate,
				'gender' 		=> $gender,
				'last_education' 		=> $education,
				'ktp_no' => $ktp_no,
				'phone' => $phone,
			);

			$response=$this->profileModel->editProfile($data);
			echo $response;
		}




		public function photo_upload(){
			if(isset($_POST["image"])){
				 $data = $_POST["image"];
				 $username=$this->session->userdata('username');
				 $user_id=$this->session->userdata('user_id');



				if(exif_imagetype($data)) {
					// Generate new random name.
				 $name = sha1(microtime()) . ".png";
				 $path="$_SERVER[DOCUMENT_ROOT]/stil/document_upload/".$username."/my-data/profilepicture";
				 if (!file_exists($path)) {
					 mkdir($path, 0777, true);
				 }
				 $image_array_1 = explode(";", $data);

				 $image_array_2 = explode(",", $image_array_1[1]);

				 $data = base64_decode($image_array_2[1]);

				 if(file_put_contents($path."/".$name, $data)){
					 $update=$this->db->query("UPDATE stil.user_client set photo='$name' where id='$user_id'");
					 if($update){
						 $this->session->set_userdata('photo',$name);
						 $response=$this->userModel->getPhoto($username,$name,$this->session->userdata('gender'));
					 }else{
						 $response="FAILED";
					 }
				 }else{
					 $response="FAILED";
				 }
				}else{
					$response="FAILED";
				}
			}else{
				$response="FAILED";
			}
			echo $response;
		}






	}
