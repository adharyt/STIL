<?php
class API_courier extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function success($id_trans){


		$cek_trans=$this->db->query("SELECT s.id_user,sdc.id as id_sdc FROM  sales_detail_courier as sdc
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE sdc.status in(2) AND sdc.id_trans='$id_trans'");



		if($cek_trans->num_rows()>0){
			$this->db->query("UPDATE sales_detail_courier set status=4, time_expired_user_feedback=ADDTIME(now(), '48:00:00') WHERE status=2 AND id_trans='$id_trans'");
			$data=$cek_trans->result_array()[0];
			$id_user=$data['id_user'];

			$this->notificationModel->pushNotificationUser($id_user,'7',$id_trans);
			echo "$id_trans DELIVERED";
		}



	}








}
