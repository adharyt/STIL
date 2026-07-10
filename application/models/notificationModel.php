<?php

class notificationModel extends CI_Model{

  function countNotificationUser($id_member){
    $count=$this->db->query("SELECT * FROM user_notification_general WHERE id_user='$id_member' AND lup_clicked=''")->num_rows();
    return $count;
  }

  function countNotificationStore($id_member){
    $count=$this->db->query("SELECT * FROM store_notification_general WHERE id_user='$id_member' AND lup_clicked=''")->num_rows();
    return $count;
  }



  function pushNotificationUser($id_user,$type,$node){
    $channel='notification_user';

    $this->db->query("INSERT INTO stil_marketplace.user_notification_general
                      (id_user,tipe,node,lup)
                      VALUES('$id_user','$type','$node',now())");

    $data['id_user']=$id_user;
    $data['need_reload']='false';
    $this->redisModel->publishSocketIO($channel,$data);
    return "SUCCESS";
  }

  function pushNotificationSeller($id_seller,$type,$node){
    $channel='notification_store';

    $this->db->query("INSERT INTO stil_marketplace.store_notification_general
                      (id_user,tipe,node,lup)
                      VALUES('$id_seller','$type','$node',now())");

    $data['id_user']=$id_seller;
    $data['need_reload']='false';
    $this->redisModel->publishSocketIO($channel,$data);
    return "SUCCESS";
  }


  function get_PopUpTransaction($user_id,$count=''){
      //BUTUH TINDAKAN
      //GET SALES YG BELUM BAYAR
      $notPaid=$this->db->query("SELECT distinct s.invoice,s.lup,s.payment_method from sales as s
                                 inner join sales_detail_trans as sdt
                                 on s.invoice=sdt.id_invoice where s.id_user='$user_id' and s.status=0 order by s.lup desc")->result_array();

      if(count($notPaid)>0){
        $invoiceItemTemp=array();
        foreach($notPaid as $notPaidItem){
          array_push($invoiceItemTemp,"'".$notPaidItem['invoice']."'");
        }
        $invoiceItem=implode(',',$invoiceItemTemp);
        $queryLastInvoice="and sdt.id_invoice not in($invoiceItem)";
      }else{
        $queryLastInvoice="";
      }

      //GET BARANG YG BUTUH KONFIRMASI DITERIMA
      $sent=$this->db->query("SELECT s.invoice,s.lup,sdc.id,sdc.id_trans as id_trans FROM sales_detail_trans as sdt
                              inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                              inner join sales as s on s.invoice=sdt.id_invoice
                              where s.id_user='$user_id' and sdc.status=4 order by s.lup desc")->result_array();
      if(count($sent)>0){
        $transItemTemp=array();
        foreach($sent as $sentItem){
          array_push($transItemTemp,"'".$sentItem['id']."'");
        }
        $transItem=implode(',',$transItemTemp);
        $querySent="and sdc.id not in($transItem)";
      }else{
        $querySent="";
      }




      //LAST=YG ID SALES DAN ID DETAIL COUR GAADA DIATAS
      $lastTransaction=$this->db->query("SELECT s.invoice,s.lup,sdc.id_trans as id_trans FROM sales_detail_trans as sdt
                              inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
                              inner join sales as s on s.invoice=sdt.id_invoice
                              where s.id_user='$user_id' $queryLastInvoice $querySent and sdc.status!='9' and sdc.status!='0' and sdc.status!='1' order by s.lup desc limit 5")->result_array();

      $data['invoiceAct']=$notPaid;
      $data['transAct']=$sent;
      $data['lastTrans']=$lastTransaction;

      if($count=='y'){
        return count($notPaid)+count($sent);
      }else{
        return $data;
      }

    }


    function get_PopUpNotification($user_id,$limit=''){
      if($limit!=''){
        $data['general']=$this->db->query("SELECT * FROM user_notification_general WHERE id_user='$user_id' order by lup desc limit $limit")->result_array();
      }else{
        $data['general']=$this->db->query("SELECT * FROM user_notification_general WHERE id_user='$user_id' order by lup desc")->result_array();
      }

      return $data;
    }

    function get_Notification($user_id,$filter='',$start='',$end='',$is_pagination='0'){
      if($filter['is_unread']=='true'){
        $filter_is_unread="AND lup_clicked=''";
      }else{
        $filter_is_unread='';
      }

      if($is_pagination==1){
        $pagination="limit $start,$end";
      }else{
        $pagination="";
      }

      $data=$this->db->query("SELECT * FROM user_notification_general WHERE id_user='$user_id' $filter_is_unread order by lup desc $pagination");

      return $data;
    }

    //STORE

    function get_PopUpTransactionStore($user_id,$count=''){
        //BUTUH TINDAKAN

        //GET TRANS BARU
        $needAction=$this->db->query("SELECT sdc.id_trans,sdc.status
                                      FROM sales_detail_courier as sdc
                                      inner join sales_detail_trans as sdt
                                      on sdt.id=sdc.id_sales_detail_trans
                                      inner join sales as s
                                      on s.invoice=sdt.id_invoice
                                      WHERE sdt.id_seller='$user_id'
                                      AND
                                        (
                                             (SUBTIME(sdc.time_expired, '06:00:00')<=now() and sdc.status=0 and time_expired!='0000-00-00 00:00:00')
                                          OR (SUBTIME(sdc.time_expired_process, '06:00:00')<=now() and sdc.status=1 and sdc.time_expired_process!='0000-00-00 00:00:00')
                                          OR (SUBTIME(sdc.time_expired_input_resi, '06:00:00')<=now() and sdc.status=2 and sdc.time_expired_input_resi!='0000-00-00 00:00:00' and is_resi_valid!=1)
                                        )
                                      and s.status=1")->result_array();



        //LAST=TOP 10 TRANS SUKSES
        $success_trans=$this->statusModel->getStatusInfo('TRANS_SUCCESS');
        $lastTransaction=$this->db->query("SELECT sdc.id_trans,sdc.status,time_received
                                            FROM sales_detail_courier as sdc
                                            inner join sales_detail_trans as sdt
                                            on sdt.id=sdc.id_sales_detail_trans
                                            inner join sales as s
                                            on s.invoice=sdt.id_invoice
                                            WHERE sdt.id_seller='$user_id'
                                            AND sdc.status in($success_trans)
                                            and s.status=1")->result_array();

        $data['transNeedAction']=$needAction;
        $data['lastTrans']=$lastTransaction;

        if($count=='y'){
          return count($needAction);
        }else{
          return $data;
        }
      }


    function get_PopUpNotificationStore($user_id,$limit=''){
        //GENERAL
        if($limit!=''){
          $data['general']=$this->db->query("SELECT * FROM store_notification_general WHERE id_user='$user_id' order by lup desc limit $limit")->result_array();
        }else{
          $data['general']=$this->db->query("SELECT * FROM store_notification_general WHERE id_user='$user_id' order by lup desc")->result_array();
        }
        return $data;
    }

    function get_NotificationStore($user_id,$filter='',$start='',$end='',$is_pagination='0'){
      if($filter['is_unread']=='true'){
        $filter_is_unread="AND lup_clicked=''";
      }else{
        $filter_is_unread='';
      }

      if($is_pagination==1){
        $pagination="limit $start,$end";
      }else{
        $pagination="";
      }

      $data=$this->db->query("SELECT * FROM store_notification_general WHERE id_user='$user_id' $filter_is_unread order by lup desc $pagination");

      return $data;
    }

}
