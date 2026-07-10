<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Response_feedback extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
			date_default_timezone_set('Asia/Jakarta');
		}


		public function products($id_transaksi,$sdc_id){
			$user_id=$this->session->userdata('user_id');
			$data['trans']=$this->db->query("SELECT s.invoice,st.store_name,sdt.id as id_trans,sdc.id as id_trans_cour,sdc.id_trans as id_transaksi FROM store as st
																			 inner join sales_detail_trans as sdt ON st.id_user=sdt.id_seller
																			 inner join sales_detail_courier as sdc ON sdt.id=sdc.id_sales_detail_trans
																			 inner join sales as s ON s.invoice=sdt.id_invoice
																			 where sdt.id='$id_transaksi'
																			 AND sdc.id='$sdc_id'
																			 AND s.id_user='$user_id'
																			 ")->result_array()[0];

			$reviewed_product=$this->db->query("SELECT id_product FROM response_productreview WHERE id_sales_detail_courier='$sdc_id'")->result_array();
			$rev_array=array();
			foreach($reviewed_product as $r_p){array_push($rev_array,$r_p['id_product']);}
			$rev=implode($rev_array,',');
			if($rev!=''){$rev="and sdp.pr_id not in($rev)";}

			$dataTransCour=$this->db->query("SELECT sdc.id,sdc.id_trans,cs.service_name FROM sales_detail_courier as sdc
																			 inner join courier_service as cs ON sdc.id_service=cs.id
																			 inner join sales_detail_trans as sdt ON sdt.id=sdc.id_sales_detail_trans
																			 inner join sales as s on s.invoice=sdt.id_invoice
																			 WHERE sdc.status in(3,52)
																			 and sdc.id='$sdc_id'
																			 and sdt.id='$id_transaksi'
																			 and s.id_user='$user_id'")->result_array();

			$data['trans_cour']=array();
			for($i=0;$i<count($dataTransCour);$i++){
				$id_sdc=$dataTransCour[$i]['id'];
				$dataTransCour[$i]['products']=$this->db->query("SELECT sdp.* FROM sales_detail_courier_by_product as sdcp
																													INNER JOIN sales_detail_courier as sdc ON sdc.id=sdcp.id_sales_detail_courier
																													INNER JOIN sales_detail_product as sdp ON sdp.id=sdcp.id_sales_detail_product
																													WHERE sdcp.id_sales_detail_courier='$id_sdc' $rev")->result_array();
				if(count($dataTransCour[$i]['products'])>0){
					array_push($data['trans_cour'],$dataTransCour[$i]);
				}
			}

			$this->load->view('appinfo');
			$this->load->view('product_feedback/product_feedback_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('product_feedback/product_feedback_v',$data);
			$this->load->view('footer');
			$this->load->view('product_feedback/product_feedback_x');
		}

		public function product($id_transaksi){
			$user_id=$this->session->userdata('user_id');
			$data['trans']=$this->db->query("SELECT sdc.id_trans as id_transaksi,s.invoice,st.store_name,sdt.id as id_trans FROM store as st
																			 inner join sales_detail_trans as sdt ON st.id_user=sdt.id_seller
																			 inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
																			 inner join sales as s on s.invoice=sdt.id_invoice
																			 where sdc.id='$id_transaksi'
																			 and s.id_user='$user_id'
																			 ")->result_array()[0];

      $trans_id=$data['trans']['id_trans'];
			$reviewed_product=$this->db->query("SELECT id_product FROM response_productreview WHERE id_sales_detail_courier='$id_transaksi'")->result_array();
			$data['reviewed_product']=array();
			foreach($reviewed_product as $r_p){array_push($data['reviewed_product'],$r_p['id_product']);}


			$dataTransCour=$this->db->query("SELECT sdc.id,sdc.id_trans,cs.service_name FROM sales_detail_courier as sdc
																			 inner join courier_service as cs ON sdc.id_service=cs.id
																			 inner join sales_detail_trans as sdt ON sdt.id=sdc.id_sales_detail_trans
																			 inner join sales as s ON s.invoice=sdt.id_invoice
																			 where sdc.id='$id_transaksi'
																			 AND s.id_user='$user_id'
																			 ")->result_array();

			$data['trans_cour']=array();
			for($i=0;$i<count($dataTransCour);$i++){
				$id_sdc=$dataTransCour[$i]['id'];
				$dataTransCour[$i]['products']=$this->db->query("SELECT sdp.* FROM sales_detail_courier_by_product as sdcp
																													INNER JOIN sales_detail_courier as sdc ON sdc.id=sdcp.id_sales_detail_courier
																													INNER JOIN sales_detail_product as sdp ON sdp.id=sdcp.id_sales_detail_product
																													WHERE sdcp.id_sales_detail_courier='$id_sdc'")->result_array();
				if(count($dataTransCour[$i]['products'])>0){
					array_push($data['trans_cour'],$dataTransCour[$i]);
				}
			}

			$this->load->view('appinfo');
			$this->load->view('product_feedbackList/product_feedback_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('product_feedbackList/product_feedback_v',$data);
			$this->load->view('footer');
			$this->load->view('product_feedbackList/product_feedback_x');
		}

		public function productSingle($id_transaksi,$id_product){
			$user_id=$this->session->userdata('user_id');
			$data['trans']=$this->db->query("SELECT s.invoice,sdc.id_trans as id_transaksi,st.store_name,sdt.id as id_trans,sdc.id as id_trans_cour FROM store as st
																			 inner join sales_detail_trans as sdt ON st.id_user=sdt.id_seller
																			 inner join sales_detail_courier as sdc ON sdc.id_sales_detail_trans=sdt.id
																			 inner join sales as s on s.invoice=sdt.id_invoice
																			 where sdc.id='$id_transaksi'
																			 and s.id_user='$user_id'
																			 ")->result_array()[0];

			$trans_cour_id=$data['trans']['id_trans_cour'];

			$reviewed_product=$this->db->query("SELECT id_product FROM response_productreview WHERE id_sales_detail_courier='$trans_cour_id' and id_product='$id_product'")->result_array();
			$rev_array=array();
			foreach($reviewed_product as $r_p){array_push($rev_array,$r_p['id_product']);}
			$rev=implode($rev_array,',');
			if($rev!=''){$rev="and sdp.pr_id not in($rev)";}

			$dataTransCour=$this->db->query("SELECT s.invoice,sdc.id_trans as id_transaksi,sdc.id,sdc.id_trans,cs.service_name FROM sales_detail_courier as sdc
																			 inner join courier_service as cs ON sdc.id_service=cs.id
																			 inner join sales_detail_trans as sdt ON sdt.id=sdc.id_sales_detail_trans
																			 inner join sales as s on s.invoice=sdt.id_invoice
																			 WHERE sdc.status in(3,52)
																			 and sdc.id='$id_transaksi'
																			 and s.id_user='$user_id'")->result_array();

			$data['trans_cour']=array();
			for($i=0;$i<count($dataTransCour);$i++){
				$id_sdc=$dataTransCour[$i]['id'];
				$dataTransCour[$i]['products']=$this->db->query("SELECT sdp.* FROM sales_detail_courier_by_product as sdcp
																													INNER JOIN sales_detail_courier as sdc ON sdc.id=sdcp.id_sales_detail_courier
																													INNER JOIN sales_detail_product as sdp ON sdp.id=sdcp.id_sales_detail_product
																													WHERE sdcp.id_sales_detail_courier='$id_sdc' $rev
																													and sdp.pr_id='$id_product'
																													")->result_array();
				if(count($dataTransCour[$i]['products'])>0){
					array_push($data['trans_cour'],$dataTransCour[$i]);
				}
			}

			$this->load->view('appinfo');
			$this->load->view('product_feedback/product_feedback_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('product_feedback/product_feedback_v',$data);
			$this->load->view('footer');
			$this->load->view('product_feedback/product_feedback_x');
		}

		public function product_submit(){
			$user_id=$this->session->userdata('user_id');
			$id_sdc=$this->input->post('id_trans_cour');
			$review_data=$this->input->post('review_data');

			foreach($review_data as $review){
				print_r($review);
				$id_product=$review['product_id'];
				$rating=$review['rating'];
				$response=$review['response'];
				$cek=$this->db->query("SELECT * FROM response_productreview WHERE id_user='$user_id' and id_sales_detail_courier='$id_sdc' and id_product='$id_product'")->num_rows();
				if($cek==0){
				$this->db->query("INSERT INTO response_productreview
													(id_user,id_sales_detail_courier,id_product,rating,review,lup,is_visibility)
													VALUES
													('$user_id','$id_sdc','$id_product','$rating','$response',now(),1)
													");
				}

			}
		}

			public function productSingleEdit($id_transaksi,$id_product){
				$user_id=$this->session->userdata('user_id');
				$data['trans']=$this->db->query("SELECT s.invoice,sdc.id_trans as id_transaksi,st.store_name,sdt.id as id_trans,sdc.id as id_trans_cour FROM store as st
																				 inner join sales_detail_trans as sdt ON st.id_user=sdt.id_seller
																				 inner join sales_detail_courier as sdc ON sdc.id_sales_detail_trans=sdt.id
																				 inner join sales as s on s.invoice=sdt.id_invoice
																				 where sdc.id='$id_transaksi'
																				 and s.id_user='$user_id'
																				 ")->result_array()[0];


				$reviewed_product=$this->db->query("SELECT id_product FROM response_productreview WHERE id_sales_detail_courier='$id_transaksi' and id_product='$id_product'")->result_array();
				$rev_array=array();
				foreach($reviewed_product as $r_p){array_push($rev_array,$r_p['id_product']);}
				$rev=implode($rev_array,',');
				if($rev!=''){$rev=" and sdp.pr_id in($rev) ";}

				$dataTransCour=$this->db->query("SELECT s.invoice,sdc.id_trans as id_transaksi,sdc.id,sdc.id_trans,cs.service_name FROM sales_detail_courier as sdc
																				 inner join courier_service as cs ON sdc.id_service=cs.id
																				 inner join sales_detail_trans as sdt ON sdt.id=sdc.id_sales_detail_trans
																				 inner join sales as s on s.invoice=sdt.id_invoice
																				 WHERE sdc.status in(3,52)
																				 and sdc.id='$id_transaksi'
																				 and s.id_user='$user_id'")->result_array();

				$data['trans_cour']=array();
				for($i=0;$i<count($dataTransCour);$i++){
					$id_sdc=$dataTransCour[$i]['id'];
					$dataTransCour[$i]['products']=$this->db->query("SELECT sdp.*,rpr.review,rpr.rating FROM sales_detail_courier_by_product as sdcp
																														INNER JOIN sales_detail_courier as sdc ON sdc.id=sdcp.id_sales_detail_courier
																														INNER JOIN sales_detail_product as sdp ON sdp.id=sdcp.id_sales_detail_product
																														INNER JOIN response_productreview as rpr ON rpr.id_product=sdp.pr_id
																														WHERE sdcp.id_sales_detail_courier='$id_sdc'
																														and sdp.pr_id='$id_product'
																														and rpr.id_sales_detail_courier='$id_sdc' $rev
																														")->result_array();
					if(count($dataTransCour[$i]['products'])>0){
						array_push($data['trans_cour'],$dataTransCour[$i]);
					}
				}

				$this->load->view('appinfo');
				$this->load->view('product_feedback_edit/product_feedback_s');
				$this->load->view('header');
				$this->load->view('up_sidebar');
				$this->load->view('product_feedback_edit/product_feedback_v',$data);
				$this->load->view('footer');
				$this->load->view('product_feedback_edit/product_feedback_x');
			}

			public function product_submit_edit(){
				$user_id=$this->session->userdata('user_id');
				$id_sdc=$this->input->post('id_trans_cour');
				$review_data=$this->input->post('review_data');

				foreach($review_data as $review){
					print_r($review);
					$id_product=$review['product_id'];
					$rating=$review['rating'];
					$response=$review['response'];
					$cek=$this->db->query("SELECT * FROM response_productreview WHERE id_user='$user_id' and id_sales_detail_courier='$id_sdc' and id_product='$id_product'")->num_rows();
					if($cek>0){
					$this->db->query("UPDATE response_productreview
														SET rating='$rating',review='$response',edited_at=now()
														WHERE id_product='$id_product' AND id_user='$user_id' AND id_sales_detail_courier='$id_sdc'
														");
					}

				}
			}




}
