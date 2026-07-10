<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_rekening extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('locationModel');
			$this->load->model('profileRekeningModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}

		public function profileRekening(){
			$this->load->model('optionModel');
			$data['memberRekening']=$this->profileRekeningModel->getRekening($this->session->userdata('user_id'));
			$data['listBank']=$this->optionModel->get_bank();
			$this->load->view('appinfo');
			$this->load->view('profile-rekening/profile_rekening_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('profile-rekening/profile_rekening_v',$data);
			$this->load->view('footer');
			$this->load->view('profile-rekening/profile_rekening_x');
		}

		//ADDRESS
		public function rekeningAdd(){
			$nama_bank=$this->input->post('nama_bank');
			$cabang_bank=$this->input->post('cabang_bank');
			$nomor_rekening=$this->input->post('nomor_rekening');
			$nama_pemilik_rekening=$this->input->post('nama_pemilik_rekening');
			$id_user=$this->session->userdata('user_id');


			$data = array(
				'id_user' => $id_user,
				'rekening' => $nomor_rekening,
				'atas_nama' => $nama_pemilik_rekening,
				'id_bank' 		=> $nama_bank,
				'cabang' 		=> $cabang_bank,
				'lup'		=> date('Y-m-d H:i:s')
			);

			$response=$this->profileRekeningModel->rekeningAdd($data);
			echo $response;
		}

		public function getMemberRekening(){
			$rekeningID=$_POST['id'];

			$cek=$this->profileRekeningModel->getRekeningByID($this->session->userdata('user_id'),$rekeningID)->num_rows();
			if($cek>0){
				$this->load->model('optionModel');
				$data['listBank']=$this->optionModel->get_bank();
				$data['memberRekening']=$this->profileRekeningModel->getRekeningByID($this->session->userdata('user_id'),$rekeningID)->result_array()[0];
				$this->load->view('profile-rekening/editModal',$data);
			}else{
				echo "";
			}
		}

		public function rekeningEdit(){
			$id=$this->input->post('id');
			$edit_nama_bank=$this->input->post('edit_nama_bank');
			$edit_cabang_bank=$this->input->post('edit_cabang_bank');
			$edit_nomor_rekening=$this->input->post('edit_nomor_rekening');
			$edit_nama_pemilik_rekening=$this->input->post('edit_nama_pemilik_rekening');
			$id_user=$this->session->userdata('user_id');

			$data = array(
				'id_user' => $id_user,
				'rekening' => $edit_nomor_rekening,
				'atas_nama' => $edit_nama_pemilik_rekening,
				'id_bank' 		=> $edit_nama_bank,
				'cabang' 		=> $edit_cabang_bank,
				'id'		=>$id,
				'lup'		=> date('Y-m-d H:i:s')
			);

			$response=$this->profileRekeningModel->rekeningEdit($data);
			echo $response;
		}

		public function getMemberRekeningDelete(){
			$rekeningID=$_POST['id'];

			$cek=$this->profileRekeningModel->getRekeningByID($this->session->userdata('user_id'),$rekeningID)->num_rows();
			if($cek>0){
				$data['memberRekening']=$this->profileRekeningModel->getRekeningByID($this->session->userdata('user_id'),$rekeningID)->result_array()[0];
				$this->load->view('profile-rekening/deleteModal',$data);
			}else{
				echo "";
			}
		}

		public function rekeningDelete(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');

			$delete=$this->db->query("UPDATE user_client_rekening set is_deleted=1,is_default=0 where id='$id' and id_user='$id_user'");
			if($delete){
				$cekdata=$this->db->query("SELECT * FROM user_client_rekening where is_deleted=0 and id_user='$id_user'")->num_rows();
				$cek=$this->db->query("SELECT * FROM user_client_rekening where is_deleted=0 and id_user='$id_user' and is_default=1")->num_rows();
				if($cekdata>0 && $cek>0){
					$response="OK";
				}else if($cekdata>0 && $cek<=0){
					$theDefault=$this->db->query("SELECT id FROM user_client_rekening where is_deleted=0 and id_user='$id_user' ORDER BY lup desc limit 1")->result_array()[0]['id'];
					$setDefault=$this->db->query("UPDATE user_client_rekening set is_default=1 where id='$theDefault' and id_user='$id_user'");
					$response="OK";
				}else{
					$response="OK";
				}
			}else{
				$response="FAILED";
			}
			echo $response;
		}


		public function rekeningSetDefault(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');

			$alldefault=$this->db->query("UPDATE user_client_rekening set is_default=0 where id_user='$id_user'");
			if($alldefault){
				$setdefault=$this->db->query("UPDATE user_client_rekening set is_default=1 where id_user='$id_user' and id='$id'");
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
