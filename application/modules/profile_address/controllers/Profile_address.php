<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_address extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('locationModel');
			$this->load->model('profileAddressModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}

		public function profileAddress(){
			$data['memberAddress']=$this->profileAddressModel->getAddress($this->session->userdata('user_id'));

			$this->load->view('appinfo');
			$this->load->view('profile-address/profile_address_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('profile-address/profile_address_v',$data);
			$this->load->view('footer');
			$this->load->view('profile-address/profile_address_x');
		}

		//ADDRESS
		public function addressAdd(){
			$name=$this->input->post('name');
			$penerima=$this->input->post('penerima');
			$telepon=$this->input->post('telepon');
			$kecamatan=$this->input->post('kecamatan');
			$kodepos=$this->input->post('kodepos');
			$alamat=$this->input->post('alamat');

			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'alias' => $name,
				'receiver' => $penerima,
				'phone' 		=> $telepon,
				'subcity' 		=> $kecamatan,
				'postalcode' => $kodepos,
				'address' => $alamat,
				'lup'		=> date('Y-m-d H:i:s')
			);

			$response=$this->profileAddressModel->addressAdd($data);
			echo $response;
		}

		public function getMemberAddress(){
			$addressID=$_POST['id'];

			$cek=$this->profileAddressModel->getAddressByID($this->session->userdata('user_id'),$addressID)->num_rows();
			if($cek>0){
				$data['memberAddress']=$this->profileAddressModel->getAddressByID($this->session->userdata('user_id'),$addressID)->result_array()[0];
				$this->load->view('profile-address/editModal',$data);
			}else{
				echo "";
			}
		}

		public function addressEdit(){
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$penerima=$this->input->post('penerima');
			$telepon=$this->input->post('telepon');
			$kecamatan=$this->input->post('kecamatan');
			$kodepos=$this->input->post('kodepos');
			$alamat=$this->input->post('alamat');

			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'id' => $id,
				'alias' => $name,
				'receiver' => $penerima,
				'phone' 		=> $telepon,
				'subcity' 		=> $kecamatan,
				'postalcode' => $kodepos,
				'address' => $alamat,
				'lup'		=> date('Y-m-d H:i:s')
			);

			$response=$this->profileAddressModel->addressEdit($data);
			echo $response;
		}

		public function getMemberAddressDelete(){
			$addressID=$_POST['id'];

			$cek=$this->profileAddressModel->getAddressByID($this->session->userdata('user_id'),$addressID)->num_rows();
			if($cek>0){
				$data['memberAddress']=$this->profileAddressModel->getAddressByID($this->session->userdata('user_id'),$addressID)->result_array()[0];
				$this->load->view('profile-address/deleteModal',$data);
			}else{
				echo "";
			}
		}

		public function addressDelete(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');

			$delete=$this->db->query("UPDATE user_client_address set is_deleted=1,is_default=0 where id='$id' and id_user='$id_user'");
			if($delete){
				$cekdata=$this->db->query("SELECT * FROM user_client_address where is_deleted=0 and id_user='$id_user'")->num_rows();
				$cek=$this->db->query("SELECT * FROM user_client_address where is_deleted=0 and id_user='$id_user' and is_default=1")->num_rows();
				if($cekdata>0 && $cek>0){
					$response="OK";
				}else if($cekdata>0 && $cek<=0){
					$theDefault=$this->db->query("SELECT id FROM user_client_address where is_deleted=0 and id_user='$id_user' ORDER BY lup desc limit 1")->result_array()[0]['id'];
					$setDefault=$this->db->query("UPDATE user_client_address set is_default=1 where id='$theDefault' and id_user='$id_user'");
					$response="OK";
				}else{
					$response="OK";
				}
			}else{
				$response="FAILED";
			}
			echo $response;
		}


		public function addressSetDefault(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');

			$alldefault=$this->db->query("UPDATE user_client_address set is_default=0 where id_user='$id_user'");
			if($alldefault){
				$setdefault=$this->db->query("UPDATE user_client_address set is_default=1 where id_user='$id_user' and id='$id'");
				if($setdefault){
					$response="OK";
				}else{
					$response="FAILED";
				}
			}else{
				$response="FAILED";
			}


			echo $response;
		}


}
