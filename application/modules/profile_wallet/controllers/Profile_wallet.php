<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_wallet extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('profileModel');
			$this->load->model('profileRekeningModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}

		public function profileWallet(){
			$this->load->model('transactionModel');
			$user_id=$this->session->userdata('user_id');
			$data['userMoney']=$this->userModel->getUserMoney($user_id);
			$data['moneyHistory']=$this->userModel->getUserMoneyHistory($user_id);
			$data['memberRekening']=$this->profileRekeningModel->getRekening($user_id);
			$data['pendingWD']=$this->userModel->getUserPendingWD($user_id);
			$data['historyWD']=$this->userModel->getUserHistoryWD($user_id);

			$this->load->view('appinfo');
			$this->load->view('profileWallet_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('profileWallet_v',$data);
			$this->load->view('footer');
			$this->load->view('header_javascript');
			$this->load->view('profileWallet_x');
		}

		public function getMoneyHistory(){
			$user_id=$this->session->userdata('user_id');
			$data['moneyHistory']=$this->userModel->getUserMoneyHistory($user_id);
			$this->load->view('template/modalMoneyHistory',$data);
		}

		public function requestWD(){
			$user_id=$this->session->userdata('user_id');
			$user_bank_id=$this->input->post('wd_user_bank_id');
			$amount=$this->numberingModel->integerDeseparation(',',$this->input->post('wd_amount'));

			$availableAmount=$this->userModel->getUserMoney($user_id);

			if($availableAmount['current']-$availableAmount['requested']>=$amount && $amount>=30000){
				$userRekeningData=$this->profileRekeningModel->getRekeningByID($user_id,$user_bank_id)->result_array()[0];

				$tiket='CWM'.$user_id.time();
				//INSERT
				$log=$this->db->query("INSERT INTO user_withdraw
												  (id,id_user,amount,user_bank,user_rekening,user_pemilik_rekening,user_cabang_bank,lup,status)
													VALUES
													('$tiket','$user_id','$amount','$userRekeningData[nama_bank]','$userRekeningData[rekening]','$userRekeningData[atas_nama]','$userRekeningData[cabang]',now(),0)
													");


				$response="OK";

			}else if($amount>=30000){
				$response='MONEY INSUFFICIENT';
			}else{
				$response='MONEY TOLOW';
			}

			echo $response;

		}


}
