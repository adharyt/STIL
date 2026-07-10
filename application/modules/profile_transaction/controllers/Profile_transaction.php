<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile_transaction extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('locationModel');
			$this->load->model('profileModel');
			$this->load->model('transactionModel');
			$this->load->model('courierModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item("landing_url_login"));
			}
		}


public function profileTransactionInvoice($load_mode=''){
	$date_from=$this->input->get('from');
	$date_to=$this->input->get('to');
	$showPaid=$this->input->get('showPaid');
	$showUnpaid=$this->input->get('showUnpaid');
	$showExpired=$this->input->get('showExpired');
	$payment_method=$this->input->get('pm');
	$reference=$this->input->get('reference');
	$sort=$this->input->get('sort');


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
	$query_date_range=" and (s.lup BETWEEN '$date_from 00:00:00' AND '$date_to 23:59:59') ";


	//STATUS PEMBAYARAN
	$statusFilter=array();
	if($showPaid=='true'){
		$statusFilter_paid="true";
		$data['filter']['transPaid']=1;
		array_push($statusFilter,'1');
	}else{
		$statusFilter_paid="false";
		$data['filter']['transPaid']=0;
	}
	if($showUnpaid=='true'){
		$statusFilter_unpaid="true";
		$data['filter']['transUnpaid']=1;
		array_push($statusFilter,'0');
	}else{
		$statusFilter_unpaid="false";
		$data['filter']['transUnpaid']=0;
	}
	if($showExpired=='true'){
		$statusFilter_expired="true";
		$data['filter']['transExpired']=1;
		array_push($statusFilter,'2');
	}else{
		$statusFilter_expired="false";
		$data['filter']['transExpired']=0;
	}

	if($showPaid!='true' && $showUnpaid!='true' && $showExpired!='true'){
		$statusFilter=array();

		$statusFilter_paid="true";
		$data['filter']['transPaid']=1;
		array_push($statusFilter,'1');

		$statusFilter_unpaid="true";
		$data['filter']['transUnpaid']=1;
		array_push($statusFilter,'0');

		$statusFilter_expired="true";
		$data['filter']['transExpired']=1;
		array_push($statusFilter,'2');
	}

	//METODE PEMBAYARAN
	if($payment_method!=''){
		$pm=implode("','",$payment_method);
		$pm=str_replace("NULL","",$pm);
		$pm_query=" AND payment_method in('$pm') ";
		$pm_filter="";
		foreach($payment_method as $pm_item){
			$pm_filter.="&pm[]=$pm_item";
		}
		$data['filter']['payment_method']=$payment_method;
	}else{
		$pm_query="";
		$pm_filter="";
		$data['filter']['payment_method']=array();
	}



	//NOMOR INVOICE
	if($reference!=''){
		$filterReference="&reference=$reference";
		$data['filter']['reference']=$reference;
		$queryReference="and invoice like '%$reference%'";
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
	$data['filter_add_bar']="?to=$date_to&from=$date_from&showPaid=$statusFilter_paid&showUnpaid=$statusFilter_unpaid&showExpired=$statusFilter_expired".$pm_filter.$filterReference;

	$data_x['filter']="?to=$date_to&from=$date_from&sort=$sort_models&showPaid=$statusFilter_paid&showUnpaid=$statusFilter_unpaid&showExpired=$statusFilter_expired".$pm_filter.$filterReference;

	if(count($statusFilter)>0){
		$statusFilter=implode(',',$statusFilter);
		$queryFilterModels="AND s.status IN($statusFilter) $queryReference $query_date_range $pm_query";
	}else{
		$queryFilterModels="$queryReference $query_date_range $pm_query";
	}


	$user_id=$this->session->userdata('user_id');
	if($load_mode!='append'){
		//LOAD
	  $data['totalRowCount'] = $this->db->query("SELECT * FROM sales as s where id_user='$user_id' $queryFilterModels")->num_rows();
	  if($data['totalRowCount']>0){
	    $data['lastData']=$this->db->query("SELECT id FROM sales as s where id_user='$user_id' $queryFilterModels $query_sort limit 1")->result_array()[0]['id'];
	  }
		$data['totalTransaction']=$this->transactionModel->getTransactions($user_id,'','',$queryFilterModels,$sort_models,true);


	  $data['data']['showLimit']=10;
	  $data['transactions']=$this->transactionModel->getTransactions($user_id,$data['data']['showLimit'],'',$queryFilterModels,$sort_models);
	  $this->load->view('appinfo');
	  $this->load->view('profile-transaction/invoice/profileTransaction_s');
	  $this->load->view('header');
	  $this->load->view('up_sidebar');
	  $this->load->view('profile-transaction/invoice/profileTransaction_v',$data);
	  $this->load->view('footer');
	  $this->load->view('profile-transaction/invoice/profileTransaction_x',$data_x);
		$this->load->view('header_javascript');
	}else{
		//APPEND
		$id=$_POST['id'];

		$user_id=$this->session->userdata('user_id');

		$lastIDInTable=$this->db->query("SELECT id FROM sales as s where id_user='$user_id' and id='$id' $queryFilterModels ")->result_array()[0]['id'];

		$data['showLimit']=10;

		$data['lastData']=$this->db->query("SELECT id FROM sales as s where id_user='$user_id' $queryFilterModels $query_sort")->result_array()[0]['id'];
		$data['totalRowCount'] = $this->db->query("SELECT * FROM sales as s where id_user='$user_id' $queryFilterModels")->num_rows();
		$data['nowData']=0;
		// Get records from the database
		$transactions=$this->transactionModel->getTransactions($user_id,$data['showLimit'],$lastIDInTable,$queryFilterModels,$sort_models);
		  foreach($transactions as $data['trans']){
		    $data['nowData']++;
		    $data['lastPostID']=$data['trans']['id'];
		    $this->load->view('profile-transaction/invoice/profileTransactionTemplate_v',$data);
		  }
	}

}

public function profileTransactionSingle($load_mode=''){
	$date_from=$this->input->get('from');
	$date_to=$this->input->get('to');
	$logistic_method=$this->input->get('lc_method');
	$showPending=$this->input->get('showPending'); //0
	$showProcess=$this->input->get('showProcess'); //1
	$showSent=$this->input->get('showSent'); //2
	$showDelivered=$this->input->get('showDelivered'); //4,51
	$showSuccess=$this->input->get('showSuccess'); //3,52
	$showDecline=$this->input->get('showDecline'); //9,11,12,13
	$reference=$this->input->get('reference');
	$sort=$this->input->get('sort');

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
	$query_date_range=" and (s.lup BETWEEN '$date_from 00:00:00' AND '$date_to 23:59:59') ";

	//STATUS TRANSAKSI
	$statusFilter=array();
	if($showPending=='true'){
		$statusFilter_pending="true";
		$data['filter']['transPending']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_PENDING"));
	}else{
		$statusFilter_pending="false";
		$data['filter']['transPending']=0;
	}
	if($showProcess=='true'){
		$statusFilter_process="true";
		$data['filter']['transProcess']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_PROCESS"));
	}else{
		$statusFilter_process="false";
		$data['filter']['transProcess']=0;
	}
	if($showSent=='true'){
		$statusFilter_sent="true";
		$data['filter']['transSent']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_SENT"));
	}else{
		$statusFilter_sent="false";
		$data['filter']['transSent']=0;
	}
	if($showDelivered=='true'){
		$statusFilter_delivered="true";
		$data['filter']['transDelivered']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_READY_PICK"));
	}else{
		$statusFilter_delivered="false";
		$data['filter']['transDelivered']=0;
	}
	if($showSuccess=='true'){
		$statusFilter_success="true";
		$data['filter']['transSuccess']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_SUCCESS"));
	}else{
		$statusFilter_success="false";
		$data['filter']['transSuccess']=0;
	}
	if($showDecline=='true'){
		$statusFilter_decline="true";
		$data['filter']['transDecline']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_FAILED"));
	}else{
		$statusFilter_decline="false";
		$data['filter']['transDecline']=0;
	}

	if($showPending!='true' && $showProcess!='true' && $showSent!='true' && $showDelivered!='true' && $showSuccess!='true' && $showDecline!='true'){
		$statusFilter=array();

		$statusFilter_pending="true";
		$data['filter']['transPending']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_PENDING"));
		$statusFilter_process="true";
		$data['filter']['transProcess']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_PROCESS"));
		$statusFilter_sent="true";
		$data['filter']['transSent']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_SENT"));
		$statusFilter_delivered="true";
		$data['filter']['transDelivered']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_READY_PICK"));
		$statusFilter_success="true";
		$data['filter']['transSuccess']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_SUCCESS"));
		$statusFilter_decline="true";
		$data['filter']['transDecline']=1;
		array_push($statusFilter,$this->statusModel->getStatusInfo("TRANS_FAILED"));
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


 //REFERENCE
	if($reference!=''){
		$filterReference="&reference=$reference";
		$data['filter']['reference']=$reference;
		$queryReference="and (invoice like '%$reference%' or sdc.id_trans like '%$reference%')";
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
	$data['filter_add_bar']="?to=$date_to&from=$date_from&showPending=$statusFilter_pending&showProcess=$statusFilter_process&showSent=$statusFilter_sent&showDelivered=$statusFilter_delivered&showSuccess=$statusFilter_success&showDecline=$statusFilter_decline&lc_method=$lm_filter".$filterReference;

	if(count($statusFilter)>0){
		$statusFilter=implode(',',$statusFilter);
		$queryFilterModels="AND sdc.status IN($statusFilter) $query_date_range $lm_query $queryReference";
	}else{
		$queryFilterModels="$query_date_range $lm_query $queryReference";
	}


  $user_id=$this->session->userdata('user_id');

  if($load_mode!='append'){
		$data['totalRowCount'] = $this->db->query("SELECT sdc.id
																							FROM sales_detail_courier as sdc
																							INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																							INNER JOIN sales as s on s.invoice=sdt.id_invoice
																							where s.id_user='$user_id'
																							AND s.status=1 $queryFilterModels
																							")->num_rows();
	  if($data['totalRowCount']>0){
	    $data['lastData']=$this->db->query("SELECT sdc.id
																					FROM sales_detail_courier as sdc
																					INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																					INNER JOIN sales as s on s.invoice=sdt.id_invoice
																					where s.id_user='$user_id'
																					AND s.status=1 $queryFilterModels
																					$query_sort LIMIT 1")->result_array()[0]['id'];
	  }

	  $data['data']['showLimit']=10;
		$data['couriers']=$this->courierModel->getCourierServiceList();
	  $data['transactions']=$this->transactionModel->getTransactionsSingle($user_id,$data['data']['showLimit'],'',$queryFilterModels,$sort_models);


		$data_x['filter']="?to=$date_to&from=$date_from&sort=$sort_models&showPending=$statusFilter_pending&showProcess=$statusFilter_process&showSent=$statusFilter_sent&showDelivered=$statusFilter_delivered&showSuccess=$statusFilter_success&showDecline=$statusFilter_decline&lc_method=$lm_filter".$filterReference;

	  $this->load->view('appinfo');
	  $this->load->view('profile-transaction/trans/profileTransaction_s');
	  $this->load->view('header');
	  $this->load->view('up_sidebar');
	  $this->load->view('profile-transaction/trans/profileTransaction_v',$data);
	  $this->load->view('footer');
	  $this->load->view('profile-transaction/trans/profileTransaction_x',$data_x);
		$this->load->view('header_javascript');
	}else{
		$id=$_POST['id'];
		$lastIDInTable=$this->db->query("SELECT sdc.id
																		FROM sales_detail_courier as sdc
																		INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																		INNER JOIN sales as s on s.invoice=sdt.id_invoice
																		where s.id_user='$user_id' and sdc.id='$id'")->result_array()[0]['id'];

		$data['showLimit']=10;

		$data['lastData']=$this->db->query("SELECT sdc.id
																							FROM sales_detail_courier as sdc
																							INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																							INNER JOIN sales as s on s.invoice=sdt.id_invoice
																							where s.id_user='$user_id'
																							AND s.status=1 $queryFilterModels $query_sort")->result_array()[0]['id'];
		$data['totalRowCount'] = $this->db->query("SELECT sdc.id
																							FROM sales_detail_courier as sdc
																							INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																							INNER JOIN sales as s on s.invoice=sdt.id_invoice
																							where s.id_user='$user_id'
																							AND s.status=1 $queryFilterModels")->num_rows();
		$data['nowData']=0;
		// Get records from the database
		$transactions=$this->transactionModel->getTransactionsSingle($user_id,$data['showLimit'],$lastIDInTable,$queryFilterModels,$sort_models);
		  foreach($transactions as $data['trans']){
		    $data['nowData']++;
		    $data['lastPostID']=$data['trans']['id'];
		    $this->load->view('profile-transaction/trans/profileTransactionTemplate_v',$data);
		  }
	}
}


//TRANSACTION DETAIL
public function profileTransactionDetail($invoice){

  $user_id=$this->session->userdata('user_id');
  $data['trans']=$this->transactionModel->getTransactionDetail($user_id,$invoice);

  $this->load->view('appinfo');
  $this->load->view('profile-transaction/detail/profileTransactionDetail_s');
  $this->load->view('header');
  $this->load->view('up_sidebar');
  $this->load->view('profile-transaction/detail/profileTransactionDetail_v',$data);
  $this->load->view('footer');
  $this->load->view('profile-transaction/detail/profileTransactionDetail_x');
}

public function profileDetailWeight(){
  $id=$this->input->post('id');
  $data['products']=$this->db->query("SELECT sdc.id_trans,s.invoice,sdp.id as product_id,sdp.pr_name,sdp.quantity,sdp.price,sdp.weight
                                      FROM sales_detail_product as sdp
                                      INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
                                      INNER JOIN sales_detail_trans as sdt ON sdt.id=sdp.id_sales_detail_trans
																			INNER JOIN sales_detail_courier as sdc ON sdt.id=sdc.id_sales_detail_trans
                                      INNER JOIN sales as s ON sdt.id_invoice=s.invoice
                                      WHERE sdcbp.id_sales_detail_courier='$id' AND sdp.status!=0 group by sdp.id")->result_array();
  $data['courier']=$this->db->query("SELECT sdc.id_trans,sdc.price,cs.service_name,c.logo,cs.id as cour_id
                                     FROM sales_detail_courier as sdc
                                     INNER JOIN courier_service as cs on cs.id=sdc.id_service
                                     INNER JOIN courier as c ON cs.id_courier=c.id
                                     WHERE sdc.id='$id'")->result_array()[0];

  $this->load->view('profile-transaction/detailWeightModal',$data);
}

public function profileDetailPrice(){
  $id=$this->input->post('id');
  $id_user=$this->session->userdata('user_id');
  $data['products']=$this->db->query("SELECT sdc.id_trans,s.invoice,sdp.pr_name,sdp.quantity,sdp.price, sdp.id as product_id
                                      FROM sales_detail_product as sdp
                                      INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
                                      INNER JOIN sales_detail_trans as sdt ON sdt.id=sdp.id_sales_detail_trans
																			INNER JOIN sales_detail_courier as sdc ON sdt.id=sdc.id_sales_detail_trans
                                      INNER JOIN sales as s ON sdt.id_invoice=s.invoice
                                      WHERE sdcbp.id_sales_detail_courier='$id' and s.id_user='$id_user' AND sdp.status=1
																			group by sdp.id")->result_array();


  $this->load->view('profile-transaction/detailPriceModal',$data);
}

public function modal_terimaBarang(){
	$sdc_id=$this->input->post('id');
	$user_id=$this->session->userdata('user_id');
	$dataTransCour=$this->db->query("SELECT u.username as store_link,st.id_user,st.store_name,sdc.id as id_trans,cs.service_name,st.store_city  FROM store as st
																	 inner join sales_detail_trans as sdt ON st.id_user=sdt.id_seller
																	 inner join sales_detail_courier as sdc ON sdt.id=sdc.id_sales_detail_trans
																	 inner join sales as s ON s.invoice=sdt.id_invoice
																	 inner join courier_service as cs ON cs.id=sdc.id_service
																	 inner join stil.user_client as u ON st.id_user=u.id
																	 where
																	 s.id_user='$user_id'
																	 AND sdc.id='$sdc_id'
																	 AND (sdc.status=2 or sdc.status=4)");

	$cekData=$dataTransCour->num_rows();
	$cek=$this->db->query("SELECT * FROM response_storefeedback WHERE id_sales_detail_courier='$sdc_id' and id_user='$user_id'")->num_rows();
	if($cek==0 && $cekData>0){
		$data['trans']=$dataTransCour->result_array()[0];
		$this->load->view('profile-transaction/acceptTransactionModal',$data);
	}else{
		echo "<img width='100%' src='".base_url()."assets/images/icon-img/pagenotfound.png'>";
	}

}


public function trans_terimaBarang(){
  $id=$this->input->post('id_trans');
	$response=$this->input->post('response');
	$response_detail=$this->input->post('response_detail');
	$rating_cour_ontime=$this->input->post('rating_cour_ontime');
	$rating_cour_protection=$this->input->post('rating_cour_protection');
  $user_id=$this->session->userdata('user_id');



  $exe=$this->db->query("UPDATE sales_detail_courier as sdc
		                     INNER JOIN sales_detail_trans as sdt on sdc.id_sales_detail_trans=sdt.id
												 INNER JOIN sales as s on s.invoice=sdt.id_invoice SET sdc.status=3,time_received=now()
												 WHERE sdc.id='$id' and s.id_user='$user_id' and (sdc.status=2 or sdc.status=4)");



	if($exe){
		$data=$this->db->query("SELECT sdt.id as sdt_id,sdc.id_trans,s.invoice,sdt.id_seller,sdc.id as sdc_id
														FROM sales_detail_courier as sdc
														inner join sales_detail_trans as sdt
														ON sdc.id_sales_detail_trans=sdt.id
														inner join sales as s
														ON s.invoice=sdt.id_invoice
														where sdc.id='$id' and s.id_user='$user_id'");
		if($data->num_rows()>=1){
			$data_fetch=$data->result_array()[0];
			$id_store=$data_fetch['id_seller'];
			$id_trans=$data_fetch['id_trans'];
			$sdt_id=$data_fetch['sdt_id'];
			$cek=$this->db->query("SELECT * FROM response_storefeedback WHERE id_sales_detail_courier='$id' AND id_store='$id_store' AND id_user='$user_id'")->num_rows();
			if($cek==0){
				$insert=$this->db->query("INSERT INTO response_storefeedback
													(id_sales_detail_courier,cour_feedback_ontime,cour_feedback_protection,id_user,id_store,response,response_quantity,response_detail,lup,is_visibility)
													VALUES
													('$id','$rating_cour_ontime','$rating_cour_protection','$user_id','$id_store','$response','1','$response_detail',now(),1)
													");
											if($insert){

													//INSERT KE CRON
													$this->db->query("INSERT INTO cron_transaction_receive
																					  (id_transaksi,is_notif_user,is_feedback_input,is_notif_seller,src,lup)
																						VALUES
																						('$id_trans','0','1','0','ACT',now())
																						");
												}
			   }
			 }

			 $status=$sdt_id;

  }else{
    $status="FAILED";
  }

	echo $status;
}

}
