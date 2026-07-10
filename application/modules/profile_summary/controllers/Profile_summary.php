<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_summary extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('locationModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}

		public function profileSummary(){
			$this->load->model('transactionModel');
			$user_id=$this->session->userdata('user_id');
			$data['count']['wishlist']=$this->userModel->getWishlistCount($user_id);
			$data['is_subscribe']=$this->userModel->getSubscribeStatus($this->session->userdata('email'));
			$data['count']['favstore']=$this->userModel->getFavoriteStore($user_id)->num_rows();
			$data['favstore']=$this->userModel->getFavoriteStore($user_id)->result_array();
			$data['transUnpaid']=$this->transactionModel->countTransactionUser($user_id,'unpaid');
			$data['transProcess']=$this->transactionModel->countTransactionUser($user_id,'ongoing');
			$data['transSuccess']=$this->transactionModel->countTransactionUser($user_id,'success');
			$data['transFailed']=$this->transactionModel->countTransactionUser($user_id,'decline');

			$this->load->view('appinfo');
			$this->load->view('profileSummary_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('profileSummary_v',$data);
			$this->load->view('footer');
			$this->load->view('profileSummary_x');
		}



}
