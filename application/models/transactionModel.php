<?php
class transactionModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }


  public function getTransactionsInfoByInvoice($invoice){
    $query=$this->db->query("SELECT s.id_user as id_buyer,sdt.id_seller,sdc.id_trans
                                    FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                    inner join sales as s ON sdt.id_invoice=s.invoice
                                    inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                    where s.invoice='$invoice'");

    if($query->num_rows()>0){
      $data['info']=$query->result_array();
      $data['id_buyer']=$data['info'][0]['id_buyer'];
      $data['status']="SUCCESS";
    }else{
      $data['status']="FAILED";
    }

    return $data;
  }

  public function countTransactionUser($id_user,$node){
    switch($node){
      default:
        $count=0;
        break;
      case 'unpaid':
        $count=$this->db->query("SELECT * FROM sales WHERE id_user='$id_user' and status=0")->num_rows();
        break;
      case 'paid':
        $count=$this->db->query("SELECT * FROM sales WHERE id_user='$id_user' and status=1")->num_rows();
        break;
      case 'expired':
        $count=$this->db->query("SELECT * FROM sales WHERE id_user='$id_user' and status=9")->num_rows();
        break;
      case 'pending':
        $count=$this->db->query("SELECT distinct sdc.id FROM sales as s
                                 INNER JOIN sales_detail_trans as sdt on sdt.id_invoice=s.invoice
                                 INNER JOIN sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                 WHERE id_user='$id_user' and sdc.status=0 and s.status=1")->num_rows();
        break;
      case 'process':
        $count=$this->db->query("SELECT distinct sdc.id FROM sales as s
                                 INNER JOIN sales_detail_trans as sdt on sdt.id_invoice=s.invoice
                                 INNER JOIN sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                 WHERE id_user='$id_user' and sdc.status=1 and s.status=1")->num_rows();
        break;
      case 'send':
        $count=$this->db->query("SELECT distinct sdc.id FROM sales as s
                                 INNER JOIN sales_detail_trans as sdt on sdt.id_invoice=s.invoice
                                 INNER JOIN sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                 WHERE id_user='$id_user' and sdc.status=2 and s.status=1")->num_rows();
        break;
      case 'delivered':
        $count=$this->db->query("SELECT distinct sdc.id FROM sales as s
                                 INNER JOIN sales_detail_trans as sdt on sdt.id_invoice=s.invoice
                                 INNER JOIN sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                 WHERE id_user='$id_user' and sdc.status=4 and s.status=1")->num_rows();
        break;
      case 'ongoing':
        $status_info=$this->statusModel->getStatusInfo('TRANS_ONGOING');
        $count=$this->db->query("SELECT distinct sdc.id FROM sales as s
                                 INNER JOIN sales_detail_trans as sdt on sdt.id_invoice=s.invoice
                                 INNER JOIN sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                 WHERE id_user='$id_user' and sdc.status in($status_info) and s.status=1")->num_rows();
        break;
      case 'success':
        $status_info=$this->statusModel->getStatusInfo('TRANS_SUCCESS');
        $count=$this->db->query("SELECT distinct sdc.id FROM sales as s
                                 INNER JOIN sales_detail_trans as sdt on sdt.id_invoice=s.invoice
                                 INNER JOIN sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                 WHERE id_user='$id_user' and sdc.status in($status_info) and s.status=1")->num_rows();
        break;
      case 'decline':
        $status_info=$this->statusModel->getStatusInfo('TRANS_FAILED');
        $count=$this->db->query("SELECT distinct sdc.id FROM sales as s
                                 INNER JOIN sales_detail_trans as sdt on sdt.id_invoice=s.invoice
                                 INNER JOIN sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                 WHERE id_user='$id_user' and sdc.status in($status_info) and s.status=1")->num_rows();
        break;
    }
    return $count;
  }


  public function getTransactions($id_user,$limit,$lastID='',$filter='',$sort='',$count=false){
    if($count!=true){
      if($lastID==''){
        if($sort=='' || $sort=='TIME_DESC'){
          $query_sort="order by id DESC";
        }else{
          $query_sort="order by id ASC";
        }
        $query="SELECT *,s.status as payment_status FROM sales as s where id_user='$id_user' $filter $query_sort LIMIT $limit";
      }else{
        if($sort=='' || $sort=='TIME_DESC'){
          $query_sort="and id<'$lastID'  ORDER BY id DESC";
        }else{
          $query_sort="and id>'$lastID'  ORDER BY id ASC";
        }
        $query="SELECT *,s.status as payment_status FROM sales as s where id_user='$id_user' $filter $query_sort LIMIT $limit";
      }

      $transactions=$this->db->query($query)->result_array();
      for($i=0;$i<count($transactions);$i++){
        $id_invoice=$transactions[$i]['invoice'];
        $transactions[$i]['d_trans']=$this->db->query("SELECT sdt.*,u.username FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id where id_invoice='$id_invoice'")->result_array();
        for($j=0;$j<count($transactions[$i]['d_trans']);$j++){
          $id_trans=$transactions[$i]['d_trans'][$j]['id'];
          $transactions[$i]['d_trans'][$j]['courier']=$this->db->query("SELECT sdc.id as id,sdc.id_trans,cs.id as cour_id,cs.service_name,sdc.status as trans_status,sdc.seller_notes,sdc.resi,sdc.total_weight,sdc.price FROM sales_detail_courier as sdc INNER JOIN courier_service as cs on sdc.id_service=cs.id where sdc.id_sales_detail_trans='$id_trans'")->result_array();
          for($k=0;$k<count($transactions[$i]['d_trans'][$j]['courier']);$k++){
            $id_sdc=$transactions[$i]['d_trans'][$j]['courier'][$k]['id'];
            $transactions[$i]['d_trans'][$j]['courier'][$k]['product']=$this->db->query("SELECT sdcbp.id as id,sdp.id as product_id,sdp.pr_name as product_name,sdp.quantity as quantity FROM sales_detail_courier_by_product as sdcbp INNER JOIN sales_detail_product as sdp on sdcbp.id_sales_detail_product=sdp.id where sdcbp.id_sales_detail_courier='$id_sdc' AND sdp.status!=0")->result_array();
          }
        }
      }

      return $transactions;
    }else{
      $query="SELECT distinct sdc.id
              FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
              inner join sales as s ON sdt.id_invoice=s.invoice
              inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
              INNER JOIN stil.user_client as uc ON uc.id=s.id_user
              where s.id_user='$id_user'
              $filter";

       return $this->db->query($query)->num_rows();
    }

  }

  public function getTransactionsSingle($id_user,$limit,$lastID='',$filter='',$sort=''){
    if($lastID==''){
      if($sort=='' || $sort=='TIME_DESC'){
        $query_sort="order by sdc.id DESC";
      }else{
        $query_sort="order by sdc.id ASC";
      }
      $query="SELECT s.payment_method,s.amount,s.payment_node,s.invoice,s.lup as invoice_date,
              sdt.user_name,sdt.user_phone,sdt.location_user_address,sdt.notes as buyer_notes,
              sdc.id,sdc.id_trans as id_sdc,sdc.total_weight,sdc.price,sdc.status as trans_status,
              cs.id as cour_id,cs.service_name,s.status as payment_status,sdc.seller_notes,sdc.resi,u.username,st.store_name
              FROM sales_detail_courier as sdc
              INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
              INNER JOIN sales as s on s.invoice=sdt.id_invoice
              INNER JOIN store as st ON st.id_user=sdt.id_seller
              INNER JOIN stil.user_client as u on st.id_user=u.id
              INNER JOIN courier_service as cs ON sdc.id_service=cs.id
              where s.id_user='$id_user' and s.status=1 $filter $query_sort LIMIT $limit";
    }else{
      if($sort=='' || $sort=='TIME_DESC'){
        $query_sort="and sdc.id<'$lastID'  ORDER BY sdc.id DESC";
      }else{
        $query_sort="and sdc.id>'$lastID'  ORDER BY sdc.id ASC";
      }
      $query="SELECT s.payment_method,s.amount,s.payment_node,s.invoice,s.lup as invoice_date,
              sdt.user_name,sdt.user_phone,sdt.location_user_address,sdt.notes as buyer_notes,
              sdc.id,sdc.id_trans as id_sdc,sdc.total_weight,sdc.price,sdc.status as trans_status,
              cs.id as cour_id,cs.service_name,s.status as payment_status,sdc.seller_notes,sdc.resi,u.username,st.store_name
              FROM sales_detail_courier as sdc
              INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
              INNER JOIN sales as s on s.invoice=sdt.id_invoice
              INNER JOIN store as st ON st.id_user=sdt.id_seller
              INNER JOIN stil.user_client as u on st.id_user=u.id
              INNER JOIN courier_service as cs ON sdc.id_service=cs.id
              where s.id_user='$id_user' and s.status=1 $filter $query_sort LIMIT $limit";
    }

    $transactions=$this->db->query($query)->result_array();
    for($i=0;$i<count($transactions);$i++){
      $trans_sdc_id=$transactions[$i]['id'];
      $transactions[$i]['product']=$this->db->query("SELECT sdcbp.id as id,sdp.id as product_id,sdp.pr_name as product_name,sdp.quantity as quantity FROM sales_detail_courier_by_product as sdcbp INNER JOIN sales_detail_product as sdp on sdcbp.id_sales_detail_product=sdp.id where sdcbp.id_sales_detail_courier='$trans_sdc_id'  AND sdp.status!=0")->result_array();
    }

    return $transactions;

  }


  public function getTransactionDetail($id_user,$invoice){
    $query="SELECT *,status as payment_status FROM sales where id_user='$id_user' and invoice='$invoice' order by lup desc";
    $transactions=$this->db->query($query)->result_array();
    for($i=0;$i<count($transactions);$i++){
      $id_invoice=$transactions[$i]['invoice'];
      $transactions[$i]['d_trans']=$this->db->query("SELECT sdt.*,u.username FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id where id_invoice='$id_invoice'")->result_array();
      for($j=0;$j<count($transactions[$i]['d_trans']);$j++){
        $id_trans=$transactions[$i]['d_trans'][$j]['id'];
        $transactions[$i]['d_trans'][$j]['courier']=$this->db->query("SELECT sdc.id,sdc.id_trans,cs.id as cour_id,cs.service_name,sdc.total_weight,sdc.price,sdc.status as trans_status,sdc.seller_notes,sdc.resi FROM sales_detail_courier as sdc INNER JOIN courier_service as cs on sdc.id_service=cs.id where sdc.id_sales_detail_trans='$id_trans'")->result_array();
        for($k=0;$k<count($transactions[$i]['d_trans'][$j]['courier']);$k++){
          $id_sdc=$transactions[$i]['d_trans'][$j]['courier'][$k]['id'];
          $transactions[$i]['d_trans'][$j]['courier'][$k]['product']=$this->db->query("SELECT sdcbp.id as id,sdp.id as product_id,sdp.pr_name as product_name,sdp.quantity as quantity FROM sales_detail_courier_by_product as sdcbp INNER JOIN sales_detail_product as sdp on sdcbp.id_sales_detail_product=sdp.id where sdcbp.id_sales_detail_courier='$id_sdc'  AND sdp.status!=0")->result_array();
        }
      }
    }

    if($this->db->query($query)->num_rows()>0){
      return $transactions[0];
    }else{
      return 'NA';
    }

  }

  public function getTransactionSummary($invoice){
    $user_id=$this->session->userdata('user_id');

    $harga_product=0;
    $transaction['total_amount']=$this->db->query("SELECT amount FROM sales where id_user='$user_id' and invoice='$invoice'")->result_array()[0]['amount'];

    $products=$this->db->query("SELECT sdp.id,quantity FROM sales_detail_product as sdp INNER JOIN sales_detail_trans as sdt ON sdp.id_sales_detail_trans=sdt.id
                               INNER JOIN sales as s ON sdt.id_invoice=s.invoice WHERE s.id_user='$user_id' and s.invoice='$invoice'  AND sdp.status!=0")->result_array();

    $harga_kurir=$this->db->query("SELECT sum(price) as tot_cour FROM sales_detail_courier as sdc INNER JOIN sales_detail_trans as sdt ON sdc.id_sales_detail_trans=sdt.id
                               INNER JOIN sales as s ON sdt.id_invoice=s.invoice WHERE s.id_user='$user_id' and s.invoice='$invoice'")->result_array()[0]['tot_cour'];

    foreach($products as $product){
      $harga_product+=$this->productModel->cekHargaBarangTerjual($product['id'],$product['quantity'])*$product['quantity'];
    }

    $transaction['product_amount']=$harga_product;
    $transaction['delivery_amount']=$harga_kurir;

    $payment_method=$this->db->query("SELECT payment_method FROM sales where id_user='$user_id' and invoice='$invoice'")->result_array()[0]['payment_method'];
    switch($payment_method){
      case 'bank_transfer':
        $transaction['summary']=$this->db->query("SELECT s.id as sales_id,pbt.id as pbt_id,s.status as payment_status,pbt.status as pbt_status,s.*,pbt.*
                                                  FROM sales as s INNER JOIN payment_bank_transfer as pbt
                                                  ON s.id=pbt.id_sales
                                                  WHERE id_user='$user_id' and invoice='$invoice' and pbt.status!=2")->result_array()[0];
        break;
      default:
        $transaction['summary']=$this->db->query("SELECT s.id as sales_id,s.status as payment_status,s.*
                                                  FROM sales as s WHERE id_user='$user_id' and invoice='$invoice'")->result_array()[0];
        break;
    }


    return $transaction;

  }

  public function getTransactionsSeller($id_user,$limit,$lastID='',$filter_query='',$sort='',$count=false){
      if($count!=true){
        if($lastID==''){
          if($sort=='' || $sort=='TIME_DESC'){
            $query_sort="order by s.lup DESC,s.id DESC, sdt.id DESC";
          }else{
            $query_sort="order by s.lup ASC,s.id ASC, sdt.id ASC";
          }
          $query="SELECT distinct uc.name,uc.phone,s.id_user,sdc.status as trans_status,s.status as payment_status,sdt.id,s.invoice,s.lup as invoice_date,sdt.*,u.username
                                          FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                          inner join sales as s ON sdt.id_invoice=s.invoice
                                          inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                          INNER JOIN stil.user_client as uc ON uc.id=s.id_user
                                          where id_seller='$id_user' and s.status='1'
                                          $filter_query
                                          $query_sort LIMIT $limit";
        }else{
          if($sort=='' || $sort=='TIME_DESC'){
            $query_sort="and sdt.id<'$lastID'  ORDER BY s.lup DESC,s.id DESC,sdt.id DESC";
          }else{
            $query_sort="and sdt.id>'$lastID'  ORDER BY s.lup ASC,s.id ASC,sdt.id ASC";
          }
          $query="SELECT distinct uc.name,uc.phone,s.id_user,sdc.status as trans_status,s.status as payment_status,sdt.id,s.invoice,s.lup as invoice_date,sdt.*,u.username
                                          FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                          inner join sales as s ON sdt.id_invoice=s.invoice
                                          inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                          INNER JOIN stil.user_client as uc ON uc.id=s.id_user
                                          where id_seller='$id_user' and s.status='1'
                                          $filter_query $query_sort LIMIT $limit";
        }

        $transactions=$this->db->query($query)->result_array();
        for($j=0;$j<count($transactions);$j++){
          $id_trans=$transactions[$j]['id'];
          $transactions[$j]['courier']=$this->db->query("SELECT cs.id as cour_id,sdc.id,sdc.id_trans,sdc.total_weight,sdc.price,cs.service_name,sdc.status as trans_status,sdc.seller_notes,sdc.resi
                                                         FROM sales_detail_courier as sdc
                                                         INNER JOIN courier_service as cs on sdc.id_service=cs.id
                                                         where sdc.id_sales_detail_trans='$id_trans'
                                                         $filter_query
                                                         ")->result_array();
          for($k=0;$k<count($transactions[$j]['courier']);$k++){
            $id_sdc=$transactions[$j]['courier'][$k]['id'];
            $transactions[$j]['courier'][$k]['product']=$this->db->query("SELECT sdcbp.id as id,sdp.id as product_id,sdp.pr_name as product_name,sdp.quantity as quantity FROM sales_detail_courier_by_product as sdcbp INNER JOIN sales_detail_product as sdp on sdcbp.id_sales_detail_product=sdp.id where sdcbp.id_sales_detail_courier='$id_sdc'  AND sdp.status!=0")->result_array();
          }
        }
        return $transactions;
      }else{
        $query="SELECT distinct sdc.id
                FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                inner join sales as s ON sdt.id_invoice=s.invoice
                inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                INNER JOIN stil.user_client as uc ON uc.id=s.id_user
                where id_seller='$id_user' and s.status='1'
                $filter_query";

         return $this->db->query($query)->num_rows();
      }

  }

  public function countTransactionSeller($id_user,$node){
    switch($node){
      default:
        $count=0;
        break;
      case 'all':
        $count=$this->db->query("SELECT distinct sdc.id
                                        FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                        inner join sales as s ON sdt.id_invoice=s.invoice
                                        inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                        where id_seller='$id_user' and s.status='1'")->num_rows();
        break;
      case 'pending':
        $count=$this->db->query("SELECT distinct sdc.id
                                        FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                        inner join sales as s ON sdt.id_invoice=s.invoice
                                        inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                        where id_seller='$id_user' and s.status='1'
                                        AND sdc.status in(0)")->num_rows();
        break;
      case 'process':
        $count=$this->db->query("SELECT distinct sdc.id
                                        FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                        inner join sales as s ON sdt.id_invoice=s.invoice
                                        inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                        where id_seller='$id_user' and s.status='1'
                                        AND sdc.status in(1)")->num_rows();
        break;
      case 'send':
        $count=$this->db->query("SELECT distinct sdc.id
                                        FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                        inner join sales as s ON sdt.id_invoice=s.invoice
                                        inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                        where id_seller='$id_user' and s.status='1'
                                        AND sdc.status in(2,4)")->num_rows();
        break;
      case 'success':
        $count=$this->db->query("SELECT distinct sdc.id
                                        FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                        inner join sales as s ON sdt.id_invoice=s.invoice
                                        inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                        where id_seller='$id_user' and s.status='1'
                                        AND sdc.status in(3,52)")->num_rows();
        break;
      case 'decline':
        $count=$this->db->query("SELECT distinct sdc.id
                                        FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
                                        inner join sales as s ON sdt.id_invoice=s.invoice
                                        inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                                        where id_seller='$id_user' and s.status='1'
                                        AND sdc.status in(9,11,12,13)")->num_rows();
        break;
    }
    return $count;
  }

  public function getAmountPerCourier($id_sdc){
      //PRICE COURIER
      $price_courier=$this->db->query("SELECT sdc.price FROM sales_detail_courier as sdc where sdc.id='$id_sdc'")->result_array()[0]['price'];

      //PRICE PRODUCTS
      $price_products=0;
      $products=$this->db->query("SELECT id,quantity FROM sales_detail_product
                                  WHERE id IN (SELECT id_sales_detail_product as pr_id
                                                FROM sales_detail_courier_by_product
                                                where id_sales_detail_courier='$id_sdc')
                                  AND status!=0")->result_array();
      foreach($products as $product){
        $price_products+=$this->productModel->cekHargaBarangTerjual($product['id'],$product['quantity'])*$product['quantity'];
      }

      return $price_courier+$price_products;

  }

  public function getAmountPerInvoice($invoice){
      $amount=0;
      $sdc=$this->db->query("SELECT sdc.id FROM sales_detail_courier as sdc
                            INNER JOIN sales_detail_trans as sdt on sdt.id=sdc.id_sales_detail_trans
                            INNER JOIN sales as s on sdt.id_invoice=s.invoice WHERE s.invoice='$invoice'
                            ")->result_array();

      foreach($sdc as $transPerCourier){
        $amount+=$this->transactionModel->getAmountPerCourier($transPerCourier['id']);
      }

      return $amount;

  }

  public function user_notif_pembayaran_push($invoice){
		$cek=$this->transactionModel->getTransactionsInfoByInvoice($invoice);
		if($cek['status']=="SUCCESS"){
			$id_buyer=$cek['id_buyer'];

      $this->notificationModel->pushNotificationUser($id_buyer,'4',$invoice);
			return "SUCCESS";
		}else{
			return "FAILED";
		}

	}

  public function seller_notif_pesanan_baru_push($invoice){
		$cek=$this->transactionModel->getTransactionsInfoByInvoice($invoice);
		if($cek['status']=="SUCCESS"){
			foreach($cek['info'] as $data_trans){
				$id_trans=$data_trans['id_trans'];
				$id_seller=$data_trans['id_seller'];
        $this->notificationModel->pushNotificationSeller($id_seller,'1',$id_trans);
			}
			return "SUCCESS";
		}else{
			return "FAILED";
		}
	}

  public function getUniqueTransferAmount($invoice){
    $cek=$this->db->query("SELECT pbt.unique_amount
											     FROM stil_marketplace.`payment_bank_transfer` as pbt inner join stil_marketplace.`sales` as s on s.id=pbt.id_sales
											     INNER JOIN stil.user_client as uc ON uc.id=s.id_user
											     where pbt.status!=2 and s.invoice='$invoice'");

    if($cek->num_rows()==1){
      return $cek->result_array()[0]['unique_amount'];
    }else{
      return '0';
    }
  }

  public function getIDTransBySDCID($id){
    $data=$this->db->query("SELECT id_trans stil_marketplace.sales_detail_courier as sdc
                            WHERE sdc.id_trans='$id'
                          ")->result_array()[0];

    return $data;
  }

  public function getInvoiceByTrans($id_trans){
    $data=$this->db->query("SELECT s.invoice FROM stil_marketplace.sales as s
                            INNER JOIN stil_marketplace.sales_detail_trans as sdt
                            ON sdt.id_invoice=s.invoice
                            INNER JOIN stil_marketplace.sales_detail_courier as sdc
                            ON sdc.id_sales_detail_trans=sdt.id
                            WHERE sdc.id_trans='$id_trans'
                          ")->result_array()[0];

    return $data;
  }

  public function getWaktuProsesPesanan($id_sdc){
    $id_seller=$this->session->userdata('user_id');
    $now=date('Y-m-d H:i:s');
    $expired_process_final=date('Y-m-d H:i:s');

    $info_store=$this->storeModel->getStoreProfile($id_seller,'true');
    switch($info_store['store_processtime_id']){
      case '1':
         $val=$info_store['store_processtime_instan'];
         $store_process_expired=date('Y-m-d H:i:s',strtotime("+$val hours",date('Y-m-d')));
         break;
      case '2':
         $store_process_expired='regular';
         break;
      case '3':
         $val=$info_store['store_processtime_preorder'];
         $store_process_expired=date('Y-m-d H:i:s',strtotime("+$val days",date('Y-m-d')));
         break;
    }

    $prods=$this->db->query("SELECT sdp.*,cs.jenis_pengiriman FROM sales as s
                             INNER JOIN sales_detail_trans as sdt
                             ON s.invoice=sdt.id_invoice
                             INNER JOIN sales_detail_courier as sdc
                             ON sdt.id=sdc.id_sales_detail_trans
                             INNER JOIN sales_detail_courier_by_product as sdcbp
                             ON sdc.id=sdcbp.id_sales_detail_courier
                             INNER JOIN sales_detail_product as sdp
                             ON sdp.id=sdcbp.id_sales_detail_product
                             INNER JOIN courier_service as cs
                             ON sdc.id_service=cs.id
                             WHERE sdc.id='$id_sdc'
                             and sdt.id_seller='$id_seller'
                            ")->result_array();

    foreach($prods as $product){

        //cek dulu apakah pengiriman khusus
        if($product['is_processtime_set']==1){
          switch($product['processtime_id']){
            case '1':
               $val=$product['processtime_instan'];
               $product_process_expired=date('Y-m-d H:i:s',strtotime("+$val hours",strtotime($now)));
               break;
            case '2':
               $product_process_expired='regular';
            case '3':
               $val=$product['store_processtime_preorder'];
               $product_process_expired=date('Y-m-d H:i:s',strtotime("+$val days",strtotime($now)));
               break;
          }

        //kalau bukan pengiriman khusus
        }else{
          $product_process_expired=$store_process_expired;
        }

        //cek berdasarkan jenis pengiriman
        switch($product['jenis_pengiriman']){
            case 'same_day':
              $expired_process=date('Y-m-d H:i:s',strtotime("+1 days",strtotime($now)));
              break;
            case 'regular':
              if($product_process_expired!='regular'){
                $expired_process=$product_process_expired;
              }else{
                $expired_process=$this->timeModel->getTanggalSkipHariKerja($now,2);
              }
              break;
            case 'next_day':
              if($product_process_expired!='regular'){
                $expired_process=$product_process_expired;
              }else{
                $expired_process=date('Y-m-d H:i:s',strtotime("+2 days",strtotime($now)));
              }
              break;
            default:
              $expired_process=$now;
              break;
        }

        if($expired_process>$expired_process_final){
          $expired_process_final=$expired_process;
        }

    }

    return $expired_process_final;

  }



}

?>
