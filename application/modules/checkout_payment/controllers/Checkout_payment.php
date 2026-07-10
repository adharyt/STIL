<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Checkout_payment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('checkoutModel');
			$this->load->model('cartModel');
			$this->load->model('paymentModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
		}



		public function index($invoice){
			$is_payment=$this->db->query("SELECT * FROM sales where payment_method!='' and invoice='$invoice'")->num_rows();

			if($is_payment>0){
				redirect('checkout-payment/'.$invoice.'/confirmation');
			}

			$this->load->model('transactionModel');
			$user_id=$this->session->userdata('user_id');
			$data['trans']=$this->transactionModel->getTransactionSummary($invoice);
		  $data['trans_detail']=$this->transactionModel->getTransactionDetail($user_id,$invoice);
			$data['list_bank_transfer']=$this->paymentModel->getListBankTransfer('MARKETPLACE');
			$data_x['id_sales']=$data['trans']['summary']['id'];
			$data_x['invoice']=$invoice;

			$this->load->view('appinfo');
			$this->load->view('checkout/checkout_s');
			$this->load->view('header');
			$this->load->view('checkout/checkout_v',$data);
			$this->load->view('footer');
			$this->load->view('checkout/checkout_x',$data_x);
		}

		public function process(){
			$user_id=$this->session->userdata('user_id');
			$id_sales=$this->input->post('id_sales');
			$method=$this->input->post('method');
			$virtual_account=$this->input->post('virtual_account');


			switch($method){
				case 'bank_transfer':
					$uid_amount_check=FALSE;
					$s_amount=$this->db->query("SELECT amount FROM sales where id='$id_sales' LIMIT 1")->result_array()[0]['amount'];
					while($uid_amount_check!=TRUE){
						$uid_amount=rand(1,999);
						$temp_amount=$s_amount+$uid_amount;
						$check_amount=$this->db->query("SELECT s.id FROM sales as s
						                         INNER JOIN payment_bank_transfer as pbt ON s.id=pbt.id_sales
																		 WHERE s.amount+pbt.unique_amount='$temp_amount'
																		 AND s.payment_method='bank_transfer'
																		 AND s.status=0
																		 AND pbt.status=0
																		 AND pbt.deleted_at='' ")->num_rows();

						if($check_amount>0){
							$uid_amount_check=FALSE;
						}else{
							$uid_amount_check=TRUE;
						}
					}


		      $exe1=$this->db->query("UPDATE sales set payment_method='$method' WHERE id_user='$user_id' and id='$id_sales'");
					$exe2=$this->db->query("UPDATE payment_bank_transfer SET status=2 WHERE id_sales='$id_sales'");
					$exe3=$this->db->query("INSERT INTO payment_bank_transfer (id_sales,unique_amount,created_at) VALUES('$id_sales','$uid_amount',now())");

					if($exe1 && $exe2 && $exe3){
						$exe="OK";
					}else{
						$exe="NOT OK";
					}
					break;
		    default:
		      break;
			}

			if($exe=="OK"){
				echo "SUCCESS";
			}
		}

		public function confirmation($invoice){
			$is_payment=$this->db->query("SELECT * FROM sales where payment_method!='' and invoice='$invoice'")->num_rows();
			$is_not_unpaid=$this->db->query("SELECT * FROM sales where payment_method!='' and invoice='$invoice' and status!=0")->num_rows();

			if($is_not_unpaid>0){
				redirect('my-account/transaction/'.$invoice);
			}else if($is_payment==0){
				redirect('checkout-payment/'.$invoice);
			}

			$this->load->model('transactionModel');
			$user_id=$this->session->userdata('user_id');
			$data['trans']=$this->transactionModel->getTransactionSummary($invoice);
			$data['trans_detail']=$this->transactionModel->getTransactionDetail($user_id,$invoice);
			$data_x['invoice']=$invoice;

			$this->load->view('appinfo');
			$this->load->view('confirmation/checkout_s');
			$this->load->view('header');
			$this->load->view('confirmation/checkout_v',$data);
			$this->load->view('footer');
			$this->load->view('confirmation/checkout_x',$data_x);
		}

}
