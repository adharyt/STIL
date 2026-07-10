<?php
	class Sc_transaction extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');
			$this->load->model('sc_productsModel');
			$this->load->model('transactionModel');
			$this->load->model('locationModel');
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

		public function index($load_mode=''){
			$date_from=$this->input->get('from');
			$date_to=$this->input->get('to');
			$showPending=$this->input->get('showPending'); //0
			$showProcess=$this->input->get('showProcess'); //1
			$showSent=$this->input->get('showSent'); //2,4
			$showSuccess=$this->input->get('showSuccess'); //3
			$showDecline=$this->input->get('showDecline'); //9,11
			$reference=$this->input->get('reference');
			$sort=$this->input->get('sort');
			$logistic_method=$this->input->get('lc_method');
			$id_user=$this->session->userdata('user_id');
			$this->load->model('courierModel');

			//TANGGAL TRANSAKSI
			if($date_from!='' && $this->timeModel->validateDate($date_from)==true){
				$date_from=$date_from;
			}else{
				$date_from=$this->session->userdata('registered_date');
			}

			if($date_to!=''  && $this->timeModel->validateDate($date_to)==true){
				$date_to=$date_to;
			}else{
				$date_to=date('Y-m-d');
			}

			if($date_from>date('Y-m-d')){
				$date_from=date('Y-m-d');
			}

			if($date_from>$date_to){
				$date_to=$date_from;
			}
			$data['filter']['from']=$date_from;
			$data['filter']['to']=$date_to;
			$query_date_range=" and (sdc.lup BETWEEN '$date_from 00:00:00' AND '$date_to 23:59:59') ";

			//STATUS TRANSAKSI
			$statusFilter=array();
			if($showPending=='true'){
				$statusFilter_pending="true";
				$data['filter']['transPending']=1;
				array_push($statusFilter,'0');
			}else{
				$statusFilter_pending="false";
				$data['filter']['transPending']=0;
			}
			if($showProcess=='true'){
				$statusFilter_process="true";
				$data['filter']['transProcess']=1;
				array_push($statusFilter,'1');
			}else{
				$statusFilter_process="false";
				$data['filter']['transProcess']=0;
			}
			if($showSent=='true'){
				$statusFilter_sent="true";
				$data['filter']['transSent']=1;
				array_push($statusFilter,'2','4','51');
			}else{
				$statusFilter_sent="false";
				$data['filter']['transSent']=0;
			}
			if($showSuccess=='true'){
				$statusFilter_success="true";
				$data['filter']['transSuccess']=1;
				array_push($statusFilter,'3','52');
			}else{
				$statusFilter_success="false";
				$data['filter']['transSuccess']=0;
			}
			if($showDecline=='true'){
				$statusFilter_decline="true";
				$data['filter']['transDecline']=1;
				array_push($statusFilter,'9','11','12','13');
			}else{
				$statusFilter_decline="false";
				$data['filter']['transDecline']=0;
			}

			if($showPending!='true' && $showProcess!='true' && $showSent!='true' && $showSuccess!='true' && $showDecline!='true'){
				$statusFilter=array();

				$statusFilter_pending="true";
				$data['filter']['transPending']=1;
				array_push($statusFilter,'0');
				$statusFilter_process="true";
				$data['filter']['transProcess']=1;
				array_push($statusFilter,'1');
				$statusFilter_sent="true";
				$data['filter']['transSent']=1;
				array_push($statusFilter,'2','4','51');
				$statusFilter_success="true";
				$data['filter']['transSuccess']=1;
				array_push($statusFilter,'3','52');
				$statusFilter_decline="true";
				$data['filter']['transDecline']=1;
				array_push($statusFilter,'9','11','12','13');
			}

			//METODE LOGISTIK
			if($logistic_method!='' && $logistic_method!='all'){
				$logistic_array=array();
				$ex_logistic_method=explode(',',$logistic_method);
				foreach($ex_logistic_method as $lm_item){
					array_push($logistic_array,$lm_item);
				}
				$lm_query=" and sdc.id_service in($logistic_method) ";
				$lm_filter=$logistic_method;
				$data['filter']['logistic_method']=$logistic_array;
			}else{
				$lm_query="";
				$lm_filter="";
				$data['filter']['logistic_method']=array('all');
			}

			//REFERENSI
			if($reference!=''){
				$filterReference="&reference=$reference";
				$data['filter']['reference']=$reference;
				$queryReference="and sdc.id_trans like '%$reference%'";
			}else{
				$filterReference="";
				$queryReference="";
				$data['filter']['reference']="";
			}

			//SORT
			if($sort==''){
				$sort="TIME_DESC";
			}
			if($sort=='TIME_DESC'){
				$query_sort=" order by s.lup ASC ";
				$sort_models="TIME_DESC";
			}else if($sort=='TIME_ASC'){
				$query_sort=" order by s.lup DESC ";
				$sort_models="TIME_ASC";
			}else{
				$query_sort=" order by s.lup ASC ";
				$sort_models="TIME_DESC";
			}

			$data['filter']['sort']=$sort_models;
			$data['filter_add_bar']="?to=$date_to&from=$date_from&showPending=$statusFilter_pending&showProcess=$statusFilter_process&showSent=$statusFilter_sent&showSuccess=$statusFilter_success&showDecline=$statusFilter_decline&lc_method=$lm_filter".$filterReference;

			if(count($statusFilter)>0){
				$statusFilter=implode(',',$statusFilter);
				$queryStatusFilter="AND sdc.status IN($statusFilter) $query_date_range  $lm_query $queryReference ";
			}else{
				$queryStatusFilter=" $query_date_range $lm_query $queryReference ";
			}


			if($load_mode!='append'){
				$data['totalRowCount'] = $this->db->query("SELECT distinct sdt.id,s.invoice,s.lup as invoice_date,sdt.*,u.username
	                                      FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
	                                      inner join sales as s ON sdt.id_invoice=s.invoice
	                                      inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
	                                      where id_seller='$id_user' and s.status='1'
	                                      $queryStatusFilter")->num_rows();
				$data['totalTransaction']=$this->transactionModel->getTransactionsSeller($id_user,'','',$queryStatusFilter,$sort_models,true);
			  if($data['totalRowCount']>0){
			    $data['lastData']=$this->db->query("SELECT distinct sdt.id,s.invoice,s.lup as invoice_date,sdt.*,u.username
		                                      FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
		                                      inner join sales as s ON sdt.id_invoice=s.invoice
		                                      inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
		                                      where id_seller='$id_user' and s.status='1'
		                                      $queryStatusFilter $query_sort limit 1")->result_array()[0]['id'];
			  }

				$data['couriers']=$this->courierModel->getCourierServiceList();
			  $data['data']['showLimit']=10;
				$data['count']['transAll']=$this->transactionModel->countTransactionSeller($id_user,'all');
				$data['count']['transPending']=$this->transactionModel->countTransactionSeller($id_user,'pending');
				$data['count']['transProcess']=$this->transactionModel->countTransactionSeller($id_user,'process');
				$data['count']['transSend']=$this->transactionModel->countTransactionSeller($id_user,'send');
				$data['count']['transSuccess']=$this->transactionModel->countTransactionSeller($id_user,'success');
				$data['count']['transDecline']=$this->transactionModel->countTransactionSeller($id_user,'decline');

				$data_x['filter']="?to=$date_to&from=$date_from&showPending=$statusFilter_pending&showProcess=$statusFilter_process&showSent=$statusFilter_sent&showSuccess=$statusFilter_success&showDecline=$statusFilter_decline&sort=$sort_models&lc_method=$lm_filter".$filterReference;

				$data['transactions']=$this->transactionModel->getTransactionsSeller($id_user,$data['data']['showLimit'],'',$queryStatusFilter,$sort_models);

				$this->load->view('appinfo');
				$this->load->view('main/seller_center_transaction_main_s');
				$this->load->view('sc_header');
				$this->load->view('sc_sidebar');
				$this->load->view('main/seller_center_transaction_main_v',$data);
				$this->load->view('footer');
				$this->load->view('main/seller_center_transaction_main_x',$data_x);
			}else{
				$id=$this->input->post('id');
				$id_user=$this->session->userdata('user_id');


				$lastIDInTable=$this->db->query("SELECT distinct sdt.id as id_sdt,s.invoice,s.lup as invoice_date,sdt.*,u.username
																				FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
																				inner join sales as s ON sdt.id_invoice=s.invoice
																				inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
																				where id_seller='$id_user' and s.status='1'
																				$queryStatusFilter and sdt.id='$id' ")->result_array()[0]['id_sdt'];

				$data['showLimit']=10;

				$data['lastData']=$this->db->query("SELECT distinct sdt.id as id_sdt,s.invoice,s.lup as invoice_date,sdt.*,u.username
																				FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
																				inner join sales as s ON sdt.id_invoice=s.invoice
																				inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
																				where id_seller='$id_user' and s.status='1'
																				$queryStatusFilter $query_sort limit 1")->result_array()[0]['id_sdt'];

				$data['totalRowCount'] = $this->db->query("SELECT distinct sdt.id,s.invoice,s.lup as invoice_date,sdt.*,u.username
																				FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
																				inner join sales as s ON sdt.id_invoice=s.invoice
																				inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
																				where id_seller='$id_user' and s.status='1'
																				$queryStatusFilter")->num_rows();
				$data['nowData']=0;
				// Get records from the database
				$transactions=$this->transactionModel->getTransactionsSeller($id_user,$data['showLimit'],$lastIDInTable,$queryStatusFilter,$sort_models);
				  foreach($transactions as $data['transaction']){
				    $data['nowData']++;
				    $data['lastPostID']=$data['transaction']['id'];
				    $this->load->view('template/transList',$data);
				  }
			}
		}

		public function getDetailSummary(){
			$trans_id=$this->input->post('id');
			$id_seller=$this->session->userdata('user_id');

			$cek=$this->db->query("SELECT sdt.id,cs.service_name FROM sales_detail_courier as sdc inner join sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id INNER JOIN courier_service as cs ON cs.id=sdc.id_service WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller'");
			if($cek->num_rows()>0){
				$data=$cek->result_array()[0];
				echo $data['id'].'-'.$data['service_name'];
			}else{
				echo "FALSE";
			}


		}

		public function process_decline(){
			$id=$this->input->post('id');
			$id_seller=$this->session->userdata('user_id');
			$notes=$this->input->post('reason');

			$exe=$this->db->query("UPDATE sales_detail_courier as sdc
														 INNER JOIN sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id
														 INNER JOIN sales as s ON sdt.id_invoice=s.invoice
														 SET sdc.status=9,sdc.seller_notes='$notes'
														 WHERE sdc.id='$id' and sdt.id_seller='$id_seller' and sdc.status=0 and s.status=1");

			if($exe){
				$id_transaksi=$this->db->query("SELECT id_trans FROM sales_detail_courier where id='$id'")->result_array()[0]['id_trans'];
				$this->db->query("INSERT INTO stil_marketplace.cron_decline_transaction_process
														(id_transaksi,lup)
														VALUES
														('$id_transaksi',now())
												 ");
			  echo "SUCCESS";
			}else{
				echo "FAILED";
			}
		}

		public function process_accept(){
			$trans_id=$this->input->post('id');
			$id_seller=$this->session->userdata('user_id');

			$process_time_expired=$this->transactionModel->getWaktuProsesPesanan($trans_id);


			$exe=$this->db->query("UPDATE sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id SET sdc.status=1,sdc.time_process=now(),sdc.time_expired_process='$process_time_expired' WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller' and sdc.status=0");
			if($exe){
				//CRON
				$data=$this->db->query("SELECT s.id_user,sdc.id_trans FROM sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt
																	 ON sdc.id_sales_detail_trans=sdt.id
																	 inner join sales as s on s.invoice=sdt.id_invoice
																	 WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller'")->result_array()[0];

				$id_trans=$data['id_trans'];
				$id_user=$data['id_user'];

				$this->notificationModel->pushNotificationUser($id_user,'5',$id_trans);

				echo "SUCCESS";
			}else{
				echo "FALSE";
			}
		}

		public function process_kirim(){
			$trans_id=$this->input->post('id');
			$id_seller=$this->session->userdata('user_id');
			$resi=$this->input->post('resi');
			$now=date('Y-m-d H:i:s');

			$batas_input_resi=date('Y-m-d H:i:s',strtotime("+1 days",strtotime($now)));

			$exe=$this->db->query("UPDATE sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt
														 on sdc.id_sales_detail_trans=sdt.id
														 SET sdc.status=2,
														 sdc.resi='$resi',
														 sdc.time_sent=now(),
														 sdc.time_expired_input_resi='$batas_input_resi'
														 WHERE sdc.id='$trans_id'
														 and sdt.id_seller='$id_seller'
														 and sdc.status=1 and
														 sdc.id_service!=1");
			if($exe){
				//PUSH NOTIFICATION
				$data_sdc=$this->db->query("SELECT s.id_user,sdc.id_trans FROM sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt
																	 ON sdc.id_sales_detail_trans=sdt.id
																	 inner join sales as s on s.invoice=sdt.id_invoice
																	 WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller'")->result_array()[0];

				$id_user=$data_sdc['id_user'];
				$id_transaksi=$data_sdc['id_trans'];
				$this->notificationModel->pushNotificationUser($id_user,'6',$id_transaksi);
				echo "SUCCESS";
			}else{
				echo "FALSE";
			}
		}

		public function process_ready_ambil(){
			$trans_id=$this->input->post('id');
			$id_seller=$this->session->userdata('user_id');

			$kode_ambil=stilUniq(8);

			$exe=$this->db->query("UPDATE sales_detail_courier as sdc
														 INNER JOIN sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id
														 SET sdc.status=51,sdc.resi='$kode_ambil',sdc.time_sent=now()
														 WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller'
														 and sdc.status=1 and sdc.id_service=1");
			if($exe){
				//PUSH NOTIFICATION
				$id_user=$this->db->query("SELECT s.id_user FROM sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt
																	 ON sdc.id_sales_detail_trans=sdt.id
																	 inner join sales as s on s.invoice=sdt.id_invoice
																	 WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller'")->result_array()[0]['id_user'];

				$this->notificationModel->pushNotificationUser($id_user,'51',$trans_id);
				echo "SUCCESS";
			}else{
				echo "FALSE";
			}
		}

		public function process_pengambilan_barang(){
			$trans_id=$this->input->post('id');
			$id_seller=$this->session->userdata('user_id');
			$email=$this->input->post('email');
			$kode=$this->input->post('kode');
			$user_id="";

			$cek=$this->db->query("SELECT sdc.id FROM sales_detail_courier as sdc
														 INNER JOIN sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id
														 INNER JOIN sales as s on sdt.id_invoice=s.invoice
														 INNER JOIN stil.user_client as uc ON s.id_user=uc.id
														 WHERE sdc.id='$trans_id'
														 and sdt.id_seller='$id_seller'
														 and sdc.status=51
														 and sdc.id_service=1
														 and sdc.resi='$kode'
														 and uc.email='$email'")->num_rows();

			if($cek>0){
				$exe=$this->db->query("UPDATE sales_detail_courier as sdc
															 INNER JOIN sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id
															 INNER JOIN sales as s on sdt.id_invoice=s.invoice
															 INNER JOIN stil.user_client as uc ON s.id_user=uc.id
															 SET sdc.status=52,sdc.time_delivered=now(),sdc.time_received=now()
															 WHERE sdc.id='$trans_id'
															 and sdt.id_seller='$id_seller'
															 and sdc.status=51
															 and sdc.id_service=1
															 and sdc.resi='$kode'
															 and uc.email='$email'");
				if($exe){
					$id_user=$this->db->query("SELECT s.id_user FROM sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt
																		 ON sdc.id_sales_detail_trans=sdt.id
																		 inner join sales as s on s.invoice=sdt.id_invoice
																		 WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller'")->result_array()[0]['id_user'];

					$insert=$this->db->query("INSERT INTO response_storefeedback
														(id_sales_detail_courier,cour_feedback_ontime,cour_feedback_protection,id_user,id_store,response,response_quantity,response_detail,lup,is_visibility)
														VALUES
														('$trans_id','0','0','$id_user','$id_seller','1','1','',now(),1)
														");
					if($insert){

							$nomor_transaksi=$this->transactionModel->getIDTransBySDCID($trans_id);

							//INSERT KE CRON
							$this->db->query("INSERT INTO cron_transaction_receive
															  (id_transaksi,is_notif_user,is_feedback_input,is_notif_seller,src,lup)
																VALUES
																('$nomor_transaksi','0','1','0','ACT',now())
																");

						//PUSH NOTIFICATION
						$this->notificationModel->pushNotificationUser($id_user,'52',$trans_id);
						echo "SUCCESS";
						}



				}else{
					echo "FALSE";
				}
			}else{
				echo "NOT FOUND";
			}

		}



		public function process_updateResi(){
			$trans_id=$this->input->post('id');
			$id_seller=$this->session->userdata('user_id');
			$resi=$this->input->post('resi');

			$exe=$this->db->query("UPDATE sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id SET sdc.resi='$resi' WHERE sdc.id='$trans_id' and sdt.id_seller='$id_seller' and sdc.status=2 and sdc.id_service!=1");
			if($exe){
				echo "SUCCESS";
			}else{
				echo "FALSE";
			}
		}

		public function getBuyerInfoModal(){
	    if($this->session->userdata('is_login')=='y'){
	        $res_data['is_login']="TRUE";

	        $id_sdt=$this->input->post('id_sdt');
	        $id_user=$this->session->userdata('user_id');

	        $query=$this->db->query("SELECT distinct uc.name,uc.phone,s.id_user,sdc.status as trans_status,s.status as payment_status,sdt.id,s.invoice,s.lup as invoice_date,sdt.*,u.username
	                                        FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
	                                        inner join sales as s ON sdt.id_invoice=s.invoice
	                                        inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
	                                        INNER JOIN stil.user_client as uc ON uc.id=s.id_user
	                                        where id_seller='$id_user' and s.status='1'
	                                        AND sdt.id='$id_sdt' LIMIT 1");

	        if($query->num_rows()>0){
	          $res_data['res']="OK";
	          $data=$query->result_array()[0];
						$data['alamat_lengkap']=$data['location_user_address'].', '.$this->locationModel->printDetailReverse($data['location_user_subcity_id']).', '.$data['location_user_postal'];
	          $res_data['content_data']=$data;


	        }else{
	          $res_data['res']="NOT OK";
	        }
	    }else{
	      $res_data['is_login']="FALSE";
	    }

			echo json_encode($res_data);

	  }


	}
