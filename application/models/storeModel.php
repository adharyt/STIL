<?php
class storeModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function checkIsHaveStore($user_id){
    return $this->db->query("SELECT store_name FROM store where id_user='$user_id'")->num_rows();
  }

  public function getStoreIdByUserId($user_id){
    return $this->db->query("SELECT id FROM store where id_user='$user_id'")->result_array()[0]['id'];
  }

  public function getUserIdByStoreId($store_id){
    return $this->db->query("SELECT id_user FROM store where id='$store_id'")->result_array()[0]['id_user'];
  }

  public function getStoreFrontList($unameStoreOwner){
      return $this->db->query("SELECT sf.name,sf.slug,sf.id FROM product_storefront as sf
        left join stil.user_client as u on sf.id_user=u.id
        where u.username='$unameStoreOwner'
        order by sf.position,sf.name asc
        ")->result_array();
  }

  public function getStoreProfile($var,$by_id='false'){
      if($by_id!='true'){
        $where_clause="u.username='$var'";
      }else{
        $where_clause="u.id='$var'";
      }

      return $this->db->query("SELECT s.id as store_id,u.id as user_id,u.username as store_link, s.store_name,s.store_photo,s.store_header,z.nama as store_location,s.store_processtime_id,s.store_processtime_instan,s.store_processtime_preorder FROM stil.user_client as u
        inner join store as s on s.id_user=u.id
        inner join zone_id as z on z.kode_wilayah=s.store_city
        where $where_clause")->result_array()[0];
  }

  public function isFavorite($id){
    $id_user=$this->session->userdata('user_id');

    $sql = "SELECT id_seller FROM store_favorite WHERE id_user='$id_user' and id_seller='$id'";
    return $this->db->query($sql)->num_rows();
  }

  public function getBuyers($store_id){
    $trans_success=$this->statusModel->getStatusInfo('TRANS_SUCCESS');
    return $this->db->query("SELECT distinct s.id_user
                             from sales as s
                             inner join sales_detail_trans as sdt on s.invoice=sdt.id_invoice
                             inner join sales_detail_courier as sdc on sdt.id=sdc.id_sales_detail_trans
                             where s.status=1 and sdt.id_seller='$store_id'
                             and sdc.id in($trans_success)
                             ")->num_rows();
  }

  public function getFollowers($store_id){
    return $this->db->query("SELECT * from store_favorite WHERE id_seller='$store_id'")->num_rows();
  }

  public function getFeedback($store_id,$vibes,$start='0',$end='0',$is_pagination='0'){
    if($is_pagination==1){
      $pagination=" limit $start,$end ";
    }else{
      $pagination="";
    }

    switch($vibes){
      case 'positive':
          $sql = "SELECT
                  f.*,
                  f.id as feedback_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  FROM response_storefeedback as f
                  INNER JOIN stil.user_client as u on f.id_user=u.id
                  where f.id_store='$store_id'
                  and u.status=1
                  and u.is_deleted=0
                  and f.is_visibility=1
                  and f.response=1
                  ORDER BY lup desc
                  $pagination";
          break;
      case 'positivesum':
          $sql = "SELECT
                  sum(response_quantity) as summarize
                  FROM response_storefeedback as f
                  where f.id_store='$store_id'
                  and f.is_visibility=1
                  and f.response=1
                  ORDER BY lup desc";
          break;
      case 'negative':
          $sql = "SELECT
                  f.*,
                  f.id as feedback_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  FROM response_storefeedback as f
                  INNER JOIN stil.user_client as u on f.id_user=u.id
                  where f.id_store='$store_id'
                  and u.status=1
                  and u.is_deleted=0
                  and f.is_visibility=1
                  and f.response=0
                  ORDER BY lup desc
                  $pagination";
          break;
      case 'negativesum':
          $sql = "SELECT
                  sum(response_quantity) as summarize
                  FROM response_storefeedback as f
                  where f.id_store='$store_id'
                  and f.is_visibility=1
                  and f.response=0
                  ORDER BY lup desc";
          break;
      default:
          $sql = "SELECT
                  f.*,
                  f.id as feedback_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  FROM response_storefeedback as f
                  INNER JOIN stil.user_client as u on f.id_user=u.id
                  where f.id_store='$store_id'
                  and u.status=1
                  and u.is_deleted=0
                  and f.is_visibility=1
                  ORDER BY lup desc
                  $pagination";
          break;
    }
    return $this->db->query($sql);
  }

  public function getOrderCount($store_id,$vibes){
    switch($vibes){
      case 'accepted':
          $sql = "SELECT
                  sdc.id
                  FROM sales_detail_courier as sdc
                  inner join sales_detail_trans as sdt
                  ON sdc.id_sales_detail_trans=sdt.id
                  WHERE sdt.id_seller='$store_id'
                  AND status in(1,2,3)";
          break;
      default:
          $sql = "SELECT
                  sdc.id
                  FROM sales_detail_courier as sdc
                  inner join sales_detail_trans as sdt
                  ON sdc.id_sales_detail_trans=sdt.id
                  WHERE sdt.id_seller='$store_id'
                  AND status in(1,2,3,4,8,9)";
          break;
    }
    return $this->db->query($sql);
  }

  public function getAverageSentTime($store_id){
    $total_waktu=$this->db->query("SELECT SUM(TIME_TO_SEC(timediff(time_sent,s.payment_success))) as total_detik
                                   from sales_detail_courier as sdc
                                   inner join sales_detail_trans as sdt
                                   on sdc.id_sales_detail_trans=sdt.id
                                   inner join sales as s
                                   on sdt.id_invoice=s.invoice
                                   where sdt.id_seller='$store_id'
                                   and s.payment_success!=''
                                   and s.payment_success!='00-00-00 00:00:00'
                                   and sdc.time_sent!=''
                                   and sdc.time_sent!='0000-00-00 00:00:00'
                                   ")->result_array()[0]['total_detik'];

                                   //tambahkan status sukses

    $total_data=$this->db->query("SELECT sdc.id
                                   from sales_detail_courier as sdc
                                   inner join sales_detail_trans as sdt
                                   on sdc.id_sales_detail_trans=sdt.id
                                   inner join sales as s
                                   on sdt.id_invoice=s.invoice
                                   where sdt.id_seller='$store_id'
                                   and s.payment_success!=''
                                   and s.payment_success!='00-00-00 00:00:00'
                                   and sdc.time_sent!=''
                                   and sdc.time_sent!='0000-00-00 00:00:00'
                                   ")->num_rows();

   if($total_data>0 && ($total_waktu!=NULL || $total_waktu!='')){
     $avg=($total_waktu/60/60)/$total_data;
     if($avg<1){
       $avg='1 jam';
     }else if($avg<24){
       $avg=round($avg).' jam';
     }else if($avg>=24 && $avg<48){
       $avg='1-2 hari';
     }else{
       $avg=$avg/24;
       $avg="±".number_format($avg,0)." hari";
     }
   }else{
     $avg='1-2 hari';
   }
   return $avg;
  }

  public function getStoreMoney($user_id){
    $wallet=$this->db->query("SELECT store_credit FROM store where id_user='$user_id'")->result_array()[0]['store_credit'];
    $requested=$this->db->query("SELECT sum(amount) as req FROM store_withdraw where id_user='$user_id' and status=0")->result_array()[0]['req'];

    $data['current']=$wallet;
    $data['requested']=$requested;
    return $data;
  }

  public function getStoreMoneyHistory($user_id){
    return $this->db->query("SELECT * FROM log_stil_money_store where id_user='$user_id' order by lup desc ")->result_array();
  }

  public function getStorePendingWD($user_id){
    return $this->db->query("SELECT * FROM store_withdraw where id_user='$user_id'  and status=0 order by lup desc")->result_array();
  }

  public function getStoreHistoryWD($user_id){
    return $this->db->query("SELECT * FROM store_withdraw where id_user='$user_id'  and status!=0 order by lup desc")->result_array();
  }

  public function getStorePhoto($username,$photo=''){

    $id_member=$this->db->query("SELECT id FROM stil.user_client WHERE username='$username'")->result_array()[0]['id'];
    if($this->storeModel->checkIsHaveStore($id_member)>0){
      $store=$this->db->query("SELECT u.username,s.store_photo FROM stil_marketplace.store as s INNER JOIN stil.user_client as u ON s.id_user=u.id WHERE u.username='$username'")->result_array()[0];

      if($store['store_photo']==""){
        $photo=base_url()."assets/images/image-default/default_store_photo.png";
      }else{
        $photo=base_url()."document_upload/".$username."/my-data/storepicture/$store[store_photo]";
      }
    }else{
      $photo=base_url()."assets/images/image-default/default_store_photo.png";
    }
    return $photo;
  }

  public function getHeaderPhoto($username,$photo){
    if($photo==""){
      $photo=base_url()."assets/images/image-default/default_store_header.png";
    }else{
      $photo=base_url()."document_upload/".$username."/my-data/storeheader/$photo";
    }

    return $photo;
  }

  public function getStorePhotoIdStore($id){
    $data=$this->db->query("SELECT u.username,s.store_photo FROM stil.user_client as u INNER JOIN store as s on u.id=s.id_user where s.id_user='$id'")->result_array()[0];
    $photo=$data['store_photo'];
    $username=$data['username'];

    if($photo==""){
      $photo=base_url()."assets/images/image-default/default_store_photo.png";
    }else{
      $photo=base_url()."document_upload/".$username."/my-data/storepicture/$photo";
    }

    return $photo;
  }


}

?>
