<?php
	class Sc_credit extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');
			$this->load->model('sc_storeRekeningModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
			$user_id=$this->session->userdata('user_id');
			$this->load->model('storeModel');
			if($this->storeModel->checkIsHaveStore($user_id)!=1){
				redirect('my-store/register');
			}
		}
		public function index() {
			$user_id=$this->session->userdata('user_id');
			$data['storeMoney']=$this->storeModel->getStoreMoney($user_id);
			$data['moneyHistory']=$this->storeModel->getStoreMoneyHistory($user_id);
			$data['memberRekening']=$this->sc_storeRekeningModel->getRekening($user_id);
			$data['pendingWD']=$this->storeModel->getStorePendingWD($user_id);
			$data['historyWD']=$this->storeModel->getStoreHistoryWD($user_id);
			$this->load->view('appinfo');
			$this->load->view('seller_center_credit_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('seller_center_credit_v',$data);
			$this->load->view('footer');
			$this->load->view('seller_center_credit_x');
		}

		public function requestWD(){
			$user_id=$this->session->userdata('user_id');
			$user_bank_id=$this->input->post('wd_user_bank_id');
			$amount=$this->numberingModel->integerDeseparation(',',$this->input->post('wd_amount'));

			$availableAmount=$this->storeModel->getStoreMoney($user_id);

			if($availableAmount['current']-$availableAmount['requested']>=$amount && $amount>=30000){
				$userRekeningData=$this->sc_storeRekeningModel->getRekeningByID($user_id,$user_bank_id)->result_array()[0];

				$tiket='SWM'.$user_id.time();
				//INSERT
				$log=$this->db->query("INSERT INTO store_withdraw
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
