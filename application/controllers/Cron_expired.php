<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_expired extends CI_Controller {

	public function __construct(){
				parent::__construct();
				$this->load->model('transactionModel');
			}


	public function pembayaran(){
		$cek=$this->db->query("SELECT s.id_user FROM cron_expired_pembayaran as cep
													 INNER JOIN sales as s ON s.invoice=cep.id_invoice
													 WHERE s.status=2 AND cep.is_notif_user=0");

		if($cek->num_rows()>0){
			$this->db->query("INSERT INTO user_notification_general (id_user,node,tipe,lup,lup_clicked,is_old)
												SELECT s.id_user,s.invoice,'10',now(),'','0'
												FROM cron_expired_pembayaran as cep
												INNER JOIN sales as s ON s.invoice=cep.id_invoice
												WHERE s.status=2 AND cep.is_notif_user=0
											 ");
			$this->db->query("UPDATE cron_expired_pembayaran as cep
												INNER JOIN user_notification_general as ung ON ung.node=cep.id_invoice
												SET cep.is_notif_user=1
												WHERE ung.tipe='10' AND cep.is_notif_user=0
											");

			$data_user=$cek->result_array();
			$channel='notification_user';
			foreach($data_user as $data){
				$data['need_reload']='false';
				$this->redisModel->publishSocketIO($channel,$data);
			}
			echo "SUCCESS<br>";
		}else{
			echo "NO DATA<br>";
		}


		//DECREASE QUANTITY
		$quantity_return_cek=$this->db->query("SELECT id_invoice FROM stil_marketplace.cron_expired_pembayaran
																					 WHERE is_notif_user=1 and is_return_stock=0
																					 ORDER BY lup asc
																					 LIMIT 1");


		if($quantity_return_cek->num_rows()>0){
			$quantity_update=$this->db->query("UPDATE sales_detail_product as sdp
																				 INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
																				 INNER JOIN sales_detail_courier as sdc ON sdcbp.id_sales_detail_courier=sdc.id
																				 INNER JOIN sales_detail_trans as sdt ON sdt.id=sdc.id_sales_detail_trans
																				 INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																				 INNER JOIN cron_expired_pembayaran as cep ON s.invoice=cep.id_invoice
																				 INNER JOIN product as p ON sdp.pr_id=p.id
																				 SET p.stock=p.stock+sdp.quantity,cep.is_return_stock=1
																				 WHERE cep.is_return_stock=0
																				 AND (p.stock_type=1 OR p.stock_type=2)
																				 AND sdp.status!=0
																				 ");
			if($quantity_update){
				//UPDATE STATUS
				echo "UPDATED QUANTITY";

			}
		}
	}

	public function proses_pesanan(){
		//refund
		$cek_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=11 AND cet.is_refund=0 order by cet.lup asc limit 1");

			if($cek_refund->num_rows()>0){
				$data=$cek_refund->result_array()[0];
				$refund_amount=$this->transactionModel->getAmountPerCourier($data['id_sdc']);
				$id_user=$data['id_user'];
				$id_transaksi=$data['id_transaksi'];
				$id_cet=$data['id'];

				//get_data_log_money
				$user_data=$this->db->query("SELECT stil_money FROM stil.user_client
																		 where
																		 id='$id_user' limit 1");

				 if($user_data->num_rows()>0){
							$data_user=$user_data->result_array()[0];
							$current_money=$data_user['stil_money'];

							//INPUT REFUND AMOUNT KE DOMPET STIL
							$refund=$this->db->query("UPDATE stil.user_client as uc
																				SET uc.stil_money=uc.stil_money+$refund_amount
																				WHERE uc.id='$id_user'
																				AND uc.stil_money='$current_money'
																				");

							 if($refund){
									//INPUT LOG REFUND
						 			$this->db->query("INSERT INTO stil_marketplace.log_stil_money(id_user,node,tipe,lup,amount_transfer,amount_before,amount_after)
						 											VALUES('$id_user','$id_transaksi',21,now(),'$refund_amount','$current_money',$current_money+$refund_amount)
						 										");
									//FLAG REFUND
									$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_process SET is_refund=1 where id='$id_cet'");
									echo "SUCCESSFULLY REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
							 }
						 }

				}
		//notif user
		$cek_notif_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=11 AND cet.is_refund=1 AND cet.is_notif_user=0 order by cet.lup asc limit 1");
		if($cek_notif_refund->num_rows()>0){
			$data=$cek_notif_refund->result_array()[0];
			$id_user=$data['id_user'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationUser($id_user,'21',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_process SET is_notif_user=1 where id='$id_cet' AND is_refund=1");
				echo "SUCCESSFULLY SEND NOTIFICATION REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
			}
		}

		//feedback seller
		$cek_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=11 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=0 order by cet.lup asc limit 1");

		if($cek_feedback->num_rows()>0){
			$data=$cek_feedback->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_sdc=$data['id_sdc'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT FEEDBACK
			$input_feedback=$this->db->query("INSERT INTO response_storefeedback
																				(id_sales_detail_courier,cour_feedback_ontime,cour_feedback_protection,id_user,id_store,response,response_quantity,response_detail,lup,is_visibility)
																				VALUES
																				('$id_sdc','','','0','$id_seller','0','3','mengabaikan pesanan $id_transaksi',now(),1)
																				");

			if($input_feedback){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_process SET is_feedback_input=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1");
				echo "SUCCESSFULLY INPUT FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}

   	}
		//notif seller
		$cek_notif_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=11 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=1 AND cet.is_notif_seller=0 order by cet.lup asc limit 1");
		if($cek_notif_feedback->num_rows()>0){
			$data=$cek_notif_feedback->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationSeller($id_seller,'21',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_process SET is_notif_seller=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1 AND is_feedback_input=1");
				echo "SUCCESSFULLY SEND NOTIFICATION FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}
		}

		//RETURN QUANTITY
		$cek1=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_process as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE cet.is_return_stock=0 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=1
																			AND s.status=1
																			order by cet.lup asc limit 1");


		if($cek1->num_rows()>0){
			$data=$cek1->result_array()[0];
			$id_cet=$data['id'];
			$id_sdc=$data['id_sdc'];
			$id_transaksi=$data['id_transaksi'];

			$product_update=$this->db->query("UPDATE sales_detail_product as sdp
																				INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
																				INNER JOIN sales_detail_courier as sdc ON sdcbp.id_sales_detail_courier=sdc.id
																				INNER JOIN product as p ON sdp.pr_id=p.id
																				SET p.stock=p.stock+sdp.quantity,sdp.status=2
																				WHERE sdc.id='$id_sdc'
																				AND (p.stock_type=1 OR p.stock_type=2)
																				");


			if($product_update){
				//UPDATE STATUS
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_process SET is_return_stock=1 where id='$id_cet'");
				echo "SUCCESSFULLY SEND NOTIFICATION USER FOR TRANSACTION $id_transaksi<br>";
			}

		}



	}


	public function kirim_pesanan(){
		//refund
		$cek_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=12 AND cet.is_refund=0 order by cet.lup asc limit 1");

			if($cek_refund->num_rows()>0){
				$data=$cek_refund->result_array()[0];
				$refund_amount=$this->transactionModel->getAmountPerCourier($data['id_sdc']);
				$id_user=$data['id_user'];
				$id_transaksi=$data['id_transaksi'];
				$id_cet=$data['id'];

				//get_data_log_money
				$user_data=$this->db->query("SELECT stil_money FROM stil.user_client
																		 where
																		 id='$id_user' limit 1");

				 if($user_data->num_rows()>0){
							$data_user=$user_data->result_array()[0];
							$current_money=$data_user['stil_money'];

							//INPUT REFUND AMOUNT KE DOMPET STIL
							$refund=$this->db->query("UPDATE stil.user_client as uc
																				SET uc.stil_money=uc.stil_money+$refund_amount
																				WHERE uc.id='$id_user'
																				AND uc.stil_money='$current_money'
																				");

							 if($refund){
									//INPUT LOG REFUND
						 			$this->db->query("INSERT INTO stil_marketplace.log_stil_money(id_user,node,tipe,lup,amount_transfer,amount_before,amount_after)
						 											VALUES('$id_user','$id_transaksi',22,now(),'$refund_amount','$current_money',$current_money+$refund_amount)
						 										");
									//FLAG REFUND
									$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send SET is_refund=1 where id='$id_cet'");
									echo "SUCCESSFULLY REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
							 }
						 }

				}
		//notif user
		$cek_notif_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=12 AND cet.is_refund=1 AND cet.is_notif_user=0 order by cet.lup asc limit 1");
		if($cek_notif_refund->num_rows()>0){
			$data=$cek_notif_refund->result_array()[0];
			$id_user=$data['id_user'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationUser($id_user,'22',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send SET is_notif_user=1 where id='$id_cet' AND is_refund=1");
				echo "SUCCESSFULLY SEND NOTIFICATION REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
			}
		}

		//feedback seller
		$cek_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=12 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=0 order by cet.lup asc limit 1");

		if($cek_feedback->num_rows()>0){
			$data=$cek_feedback->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_sdc=$data['id_sdc'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT FEEDBACK
			$input_feedback=$this->db->query("INSERT INTO response_storefeedback
																				(id_sales_detail_courier,cour_feedback_ontime,cour_feedback_protection,id_user,id_store,response,response_quantity,response_detail,lup,is_visibility)
																				VALUES
																				('$id_sdc','','','0','$id_seller','0','3','tidak mengirim pesanan $id_transaksi',now(),1)
																				");

			if($input_feedback){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send SET is_feedback_input=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1");
				echo "SUCCESSFULLY INPUT FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}

   	}
		//notif seller
		$cek_notif_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=12 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=1 AND cet.is_notif_seller=0 order by cet.lup asc limit 1");
		if($cek_notif_feedback->num_rows()>0){
			$data=$cek_notif_feedback->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationSeller($id_seller,'22',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send SET is_notif_seller=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1 AND is_feedback_input=1");
				echo "SUCCESSFULLY SEND NOTIFICATION FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}
		}

		//RETURN QUANTITY
		$cek1=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE cet.is_return_stock=0 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=1
																			AND s.status=1
																			order by cet.lup asc limit 1");


		if($cek1->num_rows()>0){
			$data=$cek1->result_array()[0];
			$id_cet=$data['id'];
			$id_sdc=$data['id_sdc'];
			$id_transaksi=$data['id_transaksi'];

			$product_update=$this->db->query("UPDATE sales_detail_product as sdp
																				INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
																				INNER JOIN sales_detail_courier as sdc ON sdcbp.id_sales_detail_courier=sdc.id
																				INNER JOIN product as p ON sdp.pr_id=p.id
																				SET p.stock=p.stock+sdp.quantity,sdp.status=2
																				WHERE sdc.id='$id_sdc'
																				AND (p.stock_type=1 OR p.stock_type=2)
																				");


			if($product_update){
				//UPDATE STATUS
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send SET is_return_stock=1 where id='$id_cet'");
				echo "SUCCESSFULLY SEND NOTIFICATION USER FOR TRANSACTION $id_transaksi<br>";
			}

		}



	}


	public function input_resi(){
		//refund
		$cek_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send_resi as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=13 AND cet.is_refund=0 order by cet.lup asc limit 1");

			if($cek_refund->num_rows()>0){
				$data=$cek_refund->result_array()[0];
				$refund_amount=$this->transactionModel->getAmountPerCourier($data['id_sdc']);
				$id_user=$data['id_user'];
				$id_transaksi=$data['id_transaksi'];
				$id_cet=$data['id'];

				//get_data_log_money
				$user_data=$this->db->query("SELECT stil_money FROM stil.user_client
																		 where
																		 id='$id_user' limit 1");

				 if($user_data->num_rows()>0){
							$data_user=$user_data->result_array()[0];
							$current_money=$data_user['stil_money'];

							//INPUT REFUND AMOUNT KE DOMPET STIL
							$refund=$this->db->query("UPDATE stil.user_client as uc
																				SET uc.stil_money=uc.stil_money+$refund_amount
																				WHERE uc.id='$id_user'
																				AND uc.stil_money='$current_money'
																				");

							 if($refund){
									//INPUT LOG REFUND
						 			$this->db->query("INSERT INTO stil_marketplace.log_stil_money(id_user,node,tipe,lup,amount_transfer,amount_before,amount_after)
						 											VALUES('$id_user','$id_transaksi',23,now(),'$refund_amount','$current_money',$current_money+$refund_amount)
						 										");
									//FLAG REFUND
									$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send_resi SET is_refund=1 where id='$id_cet'");
									echo "SUCCESSFULLY REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
							 }
						 }

				}
		//notif user
		$cek_notif_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send_resi as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=13 AND cet.is_refund=1 AND cet.is_notif_user=0 order by cet.lup asc limit 1");
		if($cek_notif_refund->num_rows()>0){
			$data=$cek_notif_refund->result_array()[0];
			$id_user=$data['id_user'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationUser($id_user,'23',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send_resi SET is_notif_user=1 where id='$id_cet' AND is_refund=1");
				echo "SUCCESSFULLY SEND NOTIFICATION REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
			}
		}

		//feedback seller
		$cek_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send_resi as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=13 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=0 order by cet.lup asc limit 1");

		if($cek_feedback->num_rows()>0){
			$data=$cek_feedback->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_sdc=$data['id_sdc'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT FEEDBACK
			$input_feedback=$this->db->query("INSERT INTO response_storefeedback
																				(id_sales_detail_courier,cour_feedback_ontime,cour_feedback_protection,id_user,id_store,response,response_quantity,response_detail,lup,is_visibility)
																				VALUES
																				('$id_sdc','','','0','$id_seller','0','3','tidak memasukan resi valid untuk pesanan $id_transaksi',now(),1)
																				");

			if($input_feedback){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send_resi SET is_feedback_input=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1");
				echo "SUCCESSFULLY INPUT FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}

   	}
		//notif seller
		$cek_notif_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send_resi as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=13 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=1 AND cet.is_notif_seller=0 order by cet.lup asc limit 1");
		if($cek_notif_feedback->num_rows()>0){
			$data=$cek_notif_feedback->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationSeller($id_seller,'23',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send_resi SET is_notif_seller=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1 AND is_feedback_input=1");
				echo "SUCCESSFULLY SEND NOTIFICATION FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}
		}

		//RETURN QUANTITY
		$cek1=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_expired_transaction_send_resi as cet
																			INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																			WHERE cet.is_return_stock=0 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=1
																			AND s.status=1
																			order by cet.lup asc limit 1");


		if($cek1->num_rows()>0){
			$data=$cek1->result_array()[0];
			$id_cet=$data['id'];
			$id_sdc=$data['id_sdc'];
			$id_transaksi=$data['id_transaksi'];

			$product_update=$this->db->query("UPDATE sales_detail_product as sdp
																				INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
																				INNER JOIN sales_detail_courier as sdc ON sdcbp.id_sales_detail_courier=sdc.id
																				INNER JOIN product as p ON sdp.pr_id=p.id
																				SET p.stock=p.stock+sdp.quantity,sdp.status=2
																				WHERE sdc.id='$id_sdc'
																				AND (p.stock_type=1 OR p.stock_type=2)
																				");


			if($product_update){
				//UPDATE STATUS
				$this->db->query("UPDATE stil_marketplace.cron_expired_transaction_send_resi SET is_return_stock=1 where id='$id_cet'");
				echo "SUCCESSFULLY SEND NOTIFICATION USER FOR TRANSACTION $id_transaksi<br>";
			}

		}

	}




}
