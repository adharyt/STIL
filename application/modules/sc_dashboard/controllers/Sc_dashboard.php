<?php
	class Sc_dashboard extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');
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

		public function index(){
			$id_seller=$this->session->userdata('user_id');

			$this->load->model('transactionModel');
			$this->load->model('salesModel');
			$data['count']['transPending']=$this->transactionModel->countTransactionSeller($id_seller,'pending');
			$data['count']['transProcess']=$this->transactionModel->countTransactionSeller($id_seller,'process');
			$data['count']['transSend']=$this->transactionModel->countTransactionSeller($id_seller,'send');

			$data['count']['amountProductSold']=$this->salesModel->storeSales($id_seller,'amountProductSold');
			$data['count']['countProductSold']=$this->salesModel->storeSales($id_seller,'countProductSold');

			$data_chart['start_date']=date('Y-m-d 00:00:00', strtotime('-7 days'));
			$data_chart['end_date']=date('Y-m-d 00:00:00', strtotime('-1 days'));
			$data_chart['sales7day']=$this->salesModel->getSalesByDaterange($id_seller,$data_chart['start_date'],$data_chart['end_date']);



			$data['storeFollowersCount']=$this->storeModel->getFollowers($id_seller);
			$data['storeFeedbackCountPositive']=$this->storeModel->getFeedback($id_seller,'positivesum')->result_array()[0]['summarize'];
			$data['storeFeedbackCountPositive']>0?$data['storeFeedbackCountPositive']=$data['storeFeedbackCountPositive']:$data['storeFeedbackCountPositive']=0;
			$data['storeFeedbackCountNegative']=$this->storeModel->getFeedback($id_seller,'negativesum')->result_array()[0]['summarize'];
			$data['storeFeedbackCountNegative']>0?$data['storeFeedbackCountNegative']=$data['storeFeedbackCountNegative']:$data['storeFeedbackCountNegative']=0;
			$data['storeFeedbackCount']=$data['storeFeedbackCountPositive']+$data['storeFeedbackCountNegative'];
			$data['storeAverageSentTime']=$this->storeModel->getAverageSentTime($id_seller);

			$this->load->view('appinfo');
			$this->load->view('main/seller_center_dashboard_main_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('main/seller_center_dashboard_main_v',$data);
			$this->load->view('footer');
			$this->load->view('main/seller_center_dashboard_main_x',$data_chart);

		}

	}
