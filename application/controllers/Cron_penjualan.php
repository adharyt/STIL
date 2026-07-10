<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_penjualan extends CI_Controller {

	public function __construct(){
				parent::__construct();
				$this->load->model('transactionModel');
			}

	public function checkout(){
		//DECREASE QUANTITY
		$cek1=$this->db->query("SELECT invoice FROM stil_marketplace.sales
														WHERE is_decrease_quantity=0
														ORDER BY lup asc
														LIMIT 1");


		if($cek1->num_rows()>0){
			$datas=$cek1->result_array();
			foreach($datas as $data){
				$id_invoice=$data['invoice'];

				$product_update=$this->db->query("UPDATE sales_detail_product as sdp
																					INNER JOIN sales_detail_courier_by_product as sdcbp ON sdp.id=sdcbp.id_sales_detail_product
																					INNER JOIN sales_detail_courier as sdc ON sdcbp.id_sales_detail_courier=sdc.id
	                                        INNER JOIN sales_detail_trans as sdt ON sdt.id=sdc.id_sales_detail_trans
	                                        INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																					INNER JOIN product as p ON sdp.pr_id=p.id
																					SET p.stock=p.stock-sdp.quantity,sdp.status=1
																					WHERE s.invoice='$id_invoice'
																					AND (p.stock_type=1 OR p.stock_type=2)
																					AMD sdp.status!=0
																					");


				if($product_update){
					//UPDATE STATUS
					$this->db->query("UPDATE stil_marketplace.sales SET is_decrease_quantity=1 where invoice='$id_invoice'");
					echo "SUCCESSFULLY DECREASE PRODUCT QUANTITY FOR TRANSACTION $id_invoice<br>";
				}
			}
		}
	}

	public function penjualan_sukses(){
		//STATUS PENJUALAN
		$update_status_penjualan=$this->db->query("UPDATE stil_marketplace.cron_penjualan as cp
																							 INNER JOIN stil_marketplace.sales as s
																							 ON cp.id_invoice=s.invoice
																							 INNER JOIN stil_marketplace.sales_detail_trans as sdt
																							 ON s.invoice=sdt.id_invoice
																							 INNER JOIN sales_detail_courier as sdc
																							 ON sdt.id=sdc.id_sales_detail_trans
																							 SET cp.is_updated_status=1,s.status=1,s.payment_success=now(),sdc.time_expired=now() + INTERVAL 1 DAY
																							 WHERE cp.is_updated_status=0");

		echo "UPDATED STATUS PENJUALAN at ".date('Y-m-d H:i:s')."<br>";



		//UPDATE NOTIFICATION USER
		$query_notif_user=$this->db->query("SELECT id,id_invoice FROM stil_marketplace.cron_penjualan
																				WHERE is_updated_status=1  AND is_notif_user=0
																				ORDER BY lup asc
																				LIMIT 1;
																			");
	  if($query_notif_user->num_rows()>0){
			$data=$query_notif_user->result_array()[0];
			$invoice=$data['id_invoice'];
			$id=$data['id'];
			$push=$this->transactionModel->user_notif_pembayaran_push($invoice);
			if($push=="SUCCESS"){
				$this->db->query("UPDATE stil_marketplace.cron_penjualan set is_notif_user=1 WHERE id='$id' AND is_updated_status=1 ");
				echo "SUCCESSFULLY INSERT PAYMENT NOTIF INVOICE $invoice FOR USER at ".date('Y-m-d H:i:s')."<br>";
			}else{
				$this->db->query("UPDATE stil_marketplace.cron_penjualan set is_notif_user=9 WHERE id='$id' AND is_updated_status=1 ");
				echo "FAILED INSERT PAYMENT NOTIF INVOICE $invoice FOR USER at ".date('Y-m-d H:i:s')."<br>";
			}
		}




		//UPDATE NOTIFICATION SELLER
		$query_notif_seller=$this->db->query("SELECT id,id_invoice FROM stil_marketplace.cron_penjualan
																				WHERE is_updated_status=1  AND is_notif_user=1 AND is_notif_seller=0
																				ORDER BY lup asc
																				LIMIT 1;
																			");
	  if($query_notif_seller->num_rows()>0){
			$data=$query_notif_seller->result_array()[0];
			$invoice=$data['id_invoice'];
			$id=$data['id'];
			$push=$this->transactionModel->seller_notif_pesanan_baru_push($invoice);
			if($push=="SUCCESS"){
				$this->db->query("UPDATE stil_marketplace.cron_penjualan set is_notif_seller=1 WHERE id='$id' AND is_updated_status=1 AND is_notif_user=1 ");
				echo "SUCCESSFULLY INSERT PAYMENT NOTIF INVOICE $invoice FOR SELLER at ".date('Y-m-d H:i:s')."<br>";
			}else{
				$this->db->query("UPDATE stil_marketplace.cron_penjualan set is_notif_seller=9 WHERE id='$id' AND is_updated_status=1 AND is_notif_user=1 ");
				echo "FAILED INSERT PAYMENT NOTIF INVOICE $invoice FOR SELLER at ".date('Y-m-d H:i:s')."<br>";
			}
		}


	}

	public function penjualan_bank_transfer(){
		//REFUND AMOUNT UNIQUE

		//cek yg belum direfund
		$dataBelumRefund=$this->db->query("SELECT s.id_user,s.invoice,pbt.id as id_pbt,pbtv.id as id_pbtv,pbtv.admin_value_redeem FROM stil_marketplace.payment_bank_transfer_validation  as pbtv
																			 INNER JOIN stil_marketplace.payment_bank_transfer as pbt ON pbt.id=pbtv.id_payment_bank_transfer
																			 INNER JOIN stil_marketplace.sales as s ON s.id=pbt.id_sales
																			 where s.status=1 AND pbt.status=1 AND pbtv.is_refund=0 AND pbtv.is_notif_push=0 order by pbtv.created_at asc limit 1");

		if($dataBelumRefund->num_rows()>0){
			$data=$dataBelumRefund->result_array()[0];
			$admin_amount_redeem=$data['admin_value_redeem'];
			$invoice=$data['invoice'];
			$id_user=$data['id_user'];
			$id_pbt=$data['id_pbt'];
			$id_pbtv=$data['id_pbtv'];


			//get_data_log_money
			$user_data=$this->db->query("SELECT id_user,stil_money FROM stil_marketplace.sales as s
																	inner join stil.user_client as uc ON s.id_user=uc.id
																	WHERE invoice='$invoice' limit 1");

		 if($user_data->num_rows()>0){
					$data_user=$user_data->result_array()[0];
					$current_money=$data_user['stil_money'];
					//INPUT KODE UNIK AMOUNT KE DOMPET STIL
					$refund=$this->db->query("UPDATE stil.user_client as uc INNER JOIN stil_marketplace.sales as s
																		ON uc.id=s.id_user
																		SET uc.stil_money=uc.stil_money+$admin_amount_redeem
																		WHERE s.invoice='$invoice' AND uc.id='$id_user'
																		AND uc.stil_money='$current_money'
																		");

					 if($refund){
							//INPUT LOG REFUND
				 			$this->db->query("INSERT INTO stil_marketplace.log_stil_money(id_user,node,tipe,lup,amount_transfer,amount_before,amount_after)
				 											VALUES('$id_user','$id_pbt',11,now(),'$admin_amount_redeem','$current_money',$current_money+$admin_amount_redeem)
				 										");
							//FLAG REFUND
							$this->db->query("UPDATE stil_marketplace.payment_bank_transfer_validation SET is_refund=1 where id='$id_pbtv'");
							echo "SUCCESSFULLY REFUND TRANSFER CODE FOR TRANSACTION $invoice<br>";
					 }
				 }

		}

		//cek yg belum direfund
		$dataBelumNotif=$this->db->query("SELECT s.id_user,s.invoice,pbt.id as id_pbt,pbtv.id as id_pbtv,pbtv.admin_value_redeem FROM stil_marketplace.payment_bank_transfer_validation  as pbtv
																			 INNER JOIN stil_marketplace.payment_bank_transfer as pbt ON pbt.id=pbtv.id_payment_bank_transfer
																			 INNER JOIN stil_marketplace.sales as s ON s.id=pbt.id_sales
																			 where s.status=1 AND pbt.status=1 AND pbtv.is_refund=1 AND pbtv.is_notif_push=0 order by pbtv.created_at asc limit 1");


		if($dataBelumNotif->num_rows()>0){
			$data=$dataBelumNotif->result_array()[0];
			$id_user=$data['id_user'];
			$id_pbt=$data['id_pbt'];
			$id_pbtv=$data['id_pbtv'];
			$invoice=$data['admin_value_redeem'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationUser($id_user,'11',$id_pbt);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.payment_bank_transfer_validation SET is_notif_push=1 where id='$id_pbtv' and is_refund=1");
				echo "SUCCESSFULLY SEND NOTIFICATION REFUND TRANSFER CODE FOR TRANSACTION $invoice<br>";
			}
		}
	}

	public function transaction_decline(){

		//RETURN QUANTITY
		$cek1=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_decline_transaction_process as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE cet.is_return_stock=0
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
				$this->db->query("UPDATE stil_marketplace.cron_decline_transaction_process SET is_return_stock=1 where id='$id_cet'");
				echo "SUCCESSFULLY SEND NOTIFICATION USER FOR TRANSACTION $id_transaksi<br>";
			}

		}

		//refund
		$cek_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_decline_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=9 AND cet.is_return_stock=1 AND cet.is_refund=0 order by cet.lup asc limit 1");

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
						 											VALUES('$id_user','$id_transaksi',2,now(),'$refund_amount','$current_money',$current_money+$refund_amount)
						 										");
									//FLAG REFUND
									$this->db->query("UPDATE stil_marketplace.cron_decline_transaction_process SET is_refund=1 where id='$id_cet' AND is_return_stock=1 ");
									echo "SUCCESSFULLY REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
							 }
						 }

				}

		//notif user
		$cek_notif_refund=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_decline_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=9 AND cet.is_refund=1 AND cet.is_notif_user=0 AND cet.is_return_stock=1 order by cet.lup asc limit 1");
		if($cek_notif_refund->num_rows()>0){
			$data=$cek_notif_refund->result_array()[0];
			$id_user=$data['id_user'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationUser($id_user,'8',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_decline_transaction_process SET is_notif_user=1 where id='$id_cet' AND is_refund=1 AND is_return_stock=1 ");
				echo "SUCCESSFULLY SEND NOTIFICATION REFUND TRANSFER CODE FOR TRANSACTION $id_transaksi<br>";
			}
		}

		//feedback seller
		$cek_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_decline_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=9 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=0 AND cet.is_return_stock=1 order by cet.lup asc limit 1");

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
																				('$id_sdc','','','0','$id_seller','0','3','menolak pesanan $id_transaksi',now(),1)
																				");

			if($input_feedback){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_decline_transaction_process SET is_feedback_input=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1 AND is_return_stock=1 ");
				echo "SUCCESSFULLY INPUT FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}

   	}
		//notif seller
		$cek_notif_feedback=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_decline_transaction_process as cet
																  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																	INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																	INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																  WHERE sdc.status=9 AND cet.is_refund=1 AND cet.is_notif_user=1 AND cet.is_feedback_input=1 AND cet.is_notif_seller=0 AND cet.is_return_stock=1  order by cet.lup asc limit 1");
		if($cek_notif_feedback->num_rows()>0){
			$data=$cek_notif_feedback->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_cet=$data['id'];

			//INPUT NOTIF
			$input_notif=$this->notificationModel->pushNotificationSeller($id_seller,'8',$id_transaksi);

			if($input_notif=="SUCCESS"){
				//FLAG REFUND
				$this->db->query("UPDATE stil_marketplace.cron_decline_transaction_process SET is_notif_seller=1 where id='$id_cet' AND is_refund=1 AND is_notif_user=1 AND is_feedback_input=1 AND is_return_stock=1 ");
				echo "SUCCESSFULLY SEND NOTIFICATION FEEDBACK FOR TRANSACTION $id_transaksi<br>";
			}
		}



	}

	public function transaction_process(){
		$status=$this->statusModel->getStatusInfo('TRANS_PROCESS');

		//NOTIF USER
		$cek_notif_user=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_transaction_process as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE sdc.status in($status) AND cet.is_notif_user=0 order by cet.lup asc limit 1");


		if($cek_notif_user->num_rows()>0){
			$data=$cek_notif_user->result_array()[0];
			$id_user=$data['id_user'];
			$id_cet=$data['id'];
			$id_transaksi=$data['id_transaksi'];

			$this->notificationModel->pushNotificationUser($id_user,'5',$id_transaksi);
			//UPDATE STATUS
			$this->db->query("UPDATE stil_marketplace.cron_transaction_process SET is_notif_user=1 where id='$id_cet'");
			echo "SUCCESSFULLY SEND NOTIFICATION USER FOR TRANSACTION $id_transaksi<br>";
		}


	}

	public function transaction_receive(){
		$status=$this->statusModel->getStatusInfo('TRANS_SUCCESS');
		//NOTIF USER
		$cek_notif_user=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_transaction_receive as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE sdc.status in($status) AND cet.is_notif_user=0 order by cet.lup asc limit 1");


		if($cek_notif_user->num_rows()>0){
			$data=$cek_notif_user->result_array()[0];
			$id_user=$data['id_user'];
			$id_cet=$data['id'];
			$id_transaksi=$data['id_transaksi'];

			$this->notificationModel->pushNotificationUser($id_user,'7',$id_transaksi);
			//UPDATE STATUS
			$this->db->query("UPDATE stil_marketplace.cron_transaction_receive SET is_notif_user=1 where id='$id_cet'");
			echo "SUCCESSFULLY SEND NOTIFICATION USER FOR TRANSACTION $id_transaksi<br>";
		}

		//FEEDBACK
		$cek_fback_user=$this->db->query("SELECT s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_transaction_receive as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE sdc.status in($status) AND cet.is_notif_user=1 AND cet.is_feedback_input=0 order by cet.lup asc limit 1");


		if($cek_fback_user->num_rows()>0){
			$data=$cek_fback_user->result_array()[0];
			$id_user=$data['id_user'];
			$id_transaksi=$data['id_transaksi'];
			$id_sdc=$data['id_sdc'];
			$id_cet=$data['id'];

			$data_trans=$this->db->query("SELECT s.id_user,s.invoice,sdt.id_seller,sdc.id as id_sdc
																		FROM sales_detail_courier as sdc
																		inner join sales_detail_trans as sdt
																		ON sdc.id_sales_detail_trans=sdt.id
																		inner join sales as s
																		ON s.invoice=sdt.id_invoice
																		where sdc.id='$id_sdc' and s.id_user='$id_user'");


			if($data_trans->num_rows()>=1){
				$data_fetch=$data_trans->result_array()[0];
				$id_store=$data_fetch['id_seller'];
				$id_cet=$data['id'];
				$id_sdc=$data['id_sdc'];
				$id_user=$data['id_user'];

				$cek=$this->db->query("SELECT * FROM response_storefeedback WHERE id_sales_detail_courier='$id_sdc' AND id_store='$id_store' AND id_user='$id_user'")->num_rows();
				if($cek==0){
					$insert=$this->db->query("INSERT INTO response_storefeedback
														(id_sales_detail_courier,cour_feedback_ontime,cour_feedback_protection,id_user,id_store,response,response_quantity,response_detail,lup,is_visibility)
														VALUES
														('$id_sdc','0','0','$id_user','$id_store','1','1','',now(),1)
														");
					if($insert){
						//UPDATE STATUS
						$this->db->query("UPDATE stil_marketplace.cron_transaction_receive SET is_feedback_input=1 where id='$id_cet' AND is_notif_user=1");
						echo "SUCCESSFULLY SEND FEEDBACK USER FOR TRANSACTION $id_transaksi<br>";
					}else{
						//$status="FAILED";
					}
				}else{
					//$status="FAILED";
				}
			}else{
				//$status="FAILED";
			}
		}


		//MONEY SELLER
		$cek_money_seller=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id as id_cet,cet.id_transaksi FROM cron_transaction_receive as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE sdc.status in($status) AND cet.is_notif_user=1 AND cet.is_feedback_input=1 AND cet.is_money_sent=0 order by cet.lup asc limit 1");


		if($cek_money_seller->num_rows()>0){
			$this->load->model('salesModel');

			$data=$cek_money_seller->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_sdc=$data['id_sdc'];
			$id_cet=$data['id_cet'];

			$transAmount=$this->salesModel->getSalesAmountByTransactionID($id_sdc);

			$current_credit=$this->db->query("SELECT store_credit FROM
																	stil_marketplace.store WHERE id_user='$id_seller' limit 1")->result_array()[0]['store_credit'];

			$this->db->query("UPDATE stil_marketplace.store SET store_credit=store_credit+$transAmount WHERE id_user='$id_seller'");

			//UPDATE STATUS
			$money_sent=$this->db->query("UPDATE stil_marketplace.cron_transaction_receive SET is_money_sent=1 where id='$id_cet'");
			if($money_sent){
				//INPUT LOG INPUT
				$this->db->query("INSERT INTO stil_marketplace.log_stil_money_store(id_user,node,tipe,lup,amount_transfer,amount_before,amount_after)
												VALUES('$id_seller','$id_transaksi',2,now(),'$transAmount','$current_credit',$current_credit+$transAmount)
											");
				echo "SUCCESSFULLY SEND NOTIFICATION SELLER FOR TRANSACTION $id_transaksi<br>";
			}

		}





		//NOTIF SELLER
		$cek_notif_seller=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id,cet.id_transaksi FROM cron_transaction_receive as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE sdc.status in($status) AND cet.is_notif_user=1 AND cet.is_feedback_input=1 AND is_money_sent=1 AND cet.is_notif_seller=0 order by cet.lup asc limit 1");


		if($cek_notif_seller->num_rows()>0){
			$data=$cek_notif_seller->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];

			$this->notificationModel->pushNotificationSeller($id_seller,'7',$id_transaksi);
			//UPDATE STATUS
			$this->db->query("UPDATE stil_marketplace.cron_transaction_receive SET is_notif_seller=1 where id='$id_cet'");
			echo "SUCCESSFULLY SEND NOTIFICATION SELLER FOR TRANSACTION $id_transaksi<br>";
		}

		//MONEY STIL
		$cek_money_stil=$this->db->query("SELECT sdt.id_seller,s.id_user,sdc.id as id_sdc,cet.id as id_cet,cet.id_transaksi FROM cron_transaction_receive as cet
																		  INNER JOIN sales_detail_courier as sdc ON sdc.id_trans=cet.id_transaksi
																			INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
																			INNER JOIN sales as s ON s.invoice=sdt.id_invoice
																		  WHERE sdc.status in($status) AND cet.is_notif_user=1 AND cet.is_feedback_input=1 AND is_money_sent=1 AND cet.is_notif_seller=1 AND cet.is_money_sent_stil=0 order by cet.lup asc limit 1");


		if($cek_money_stil->num_rows()>0){
			$this->load->model('salesModel');
			$data=$cek_money_stil->result_array()[0];
			$id_seller=$data['id_seller'];
			$id_transaksi=$data['id_transaksi'];
			$id_sdc=$data['id_sdc'];
			$id_cet=$data['id_cet'];

			$transAmount=$this->salesModel->getSalesAmountByTransactionID($id_sdc,TRUE);

			$current_credit=$this->db->query("SELECT store_credit FROM
																	stil_marketplace.store WHERE id_user=0 limit 1")->result_array()[0]['store_credit'];

			$this->db->query("UPDATE stil_marketplace.store SET store_credit=store_credit+$transAmount WHERE id_user=0");

			//UPDATE STATUS
			$money_sent=$this->db->query("UPDATE stil_marketplace.cron_transaction_receive SET is_money_sent_stil=1 where id='$id_cet'");
			if($money_sent){
				//INPUT LOG INPUT
				$this->db->query("INSERT INTO stil_marketplace.log_stil_money_store(id_user,node,tipe,lup,amount_transfer,amount_before,amount_after)
												VALUES(0,'$id_transaksi',9,now(),'$transAmount','$current_credit',$current_credit+$transAmount)
											");
				echo "SUCCESSFULLY SEND NOTIFICATION SELLER FOR TRANSACTION $id_transaksi<br>";
			}


			echo "SUCCESSFULLY SEND NOTIFICATION SELLER FOR TRANSACTION $id_transaksi<br>";
		}


	}






}
