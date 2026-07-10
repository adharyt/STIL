<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Product_sold extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
		}


		public function detail($invoice,$id_product_sold){
				//PRODUCT
			$cek=$this->productModel->getProductSoldDetail($invoice,$id_product_sold);
			if($cek->num_rows()>0){
				$data['dataProduct']=$cek->result_array()[0];
				$data['dataProductImg']=$this->productModel->getProductImage($data['dataProduct']['product_id']);

				//STOREFEEDBACK
				$data['storeFeedbackCountPositive']=$this->storeModel->getFeedback($data['dataProduct']['store_id'],'positivesum')->result_array()[0]['summarize'];
				$data['storeFeedbackCountNegative']=$this->storeModel->getFeedback($data['dataProduct']['store_id'],'negativesum')->result_array()[0]['summarize'];
				$data['storeFeedbackCount']=$data['storeFeedbackCountPositive']+$data['storeFeedbackCountNegative'];
				$data['storeFeedbackCountUniq']=$this->storeModel->getFeedback($data['dataProduct']['store_id'],'all')->num_rows();
				$data['storeFeedback']=$this->storeModel->getFeedback($data['dataProduct']['store_id'],'all','5')->result_array();

				if($this->session->userdata('user_id')==$data['dataProduct']['store_id']){
					$data['check_markup']=FALSE;
				}else{
					$data['check_markup']=TRUE;
				}

				$data['cek']='y';
			}else{
				$data['cek']='n';
			}

			$this->load->view('appinfo');
			$this->load->view('productDetail/productDetail_s');
			$this->load->view('header');
			$this->load->view('productDetail/productDetail_v',$data);
			$this->load->view('footer');
			$this->load->view('productDetail/productDetail_x');


		}



}
