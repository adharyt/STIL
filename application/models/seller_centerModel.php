<?php
class seller_centerModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }



  public function getStoreProfile($unameStoreOwner){
      return $this->db->query("SELECT u.id as user_id,u.username as store_link, s.store_notes,s.store_name,s.store_photo,s.store_header,z.nama as store_location FROM stil.user_client as u
        inner join store as s on s.id_user=u.id
        inner join zone_id as z on z.kode_wilayah=s.store_city
        where u.username='$unameStoreOwner'")->result_array()[0];
  }

  public function getStoreDetail($unameStoreOwner){
        $store=$this->db->query("SELECT u.id as user_id,u.username as store_link, u.phone as user_phone,s.store_name,s.store_photo,s.store_header,s.store_lup_active,z.nama as store_location
          ,s.* FROM stil.user_client as u
        inner join store as s on s.id_user=u.id
        inner join zone_id as z on z.kode_wilayah=s.store_city
        where u.username='$unameStoreOwner'")->result_array()[0];

        if($store['store_notes']!=''){
          $cek=$this->db->query("SELECT * FROM log_store_notes where id_user='$store[user_id]' order by lup desc limit 1");
          if($cek->num_rows()>0){
            $lup_notes=$cek->row()->lup;
            $store['store_notes_lup']=$lup_notes;
          }else{
            $store['store_notes_lup']=$store['store_lup_active'];
          }
        }else{
          $store['store_notes_lup']=$store['store_lup_active'];
        }

        return $store;
  }

  public function getCourierList($unameStoreOwner='',$courType=''){
        if($courType!=''){
          $cour_clause=" AND type='$courType' ";
        }else{
          $cour_clause="";
        }
        $couriers=$this->db->query("SELECT id,logo,name FROM courier where is_active=1 $cour_clause ORDER BY urutan asc")->result_array();
        $fix_courier=array();

        foreach($couriers as $courier){
          $courier_services=$this->db->query("SELECT jenis_pengiriman,id,service_name,service_code FROM courier_service where is_active=1 and id_courier='$courier[id]' ORDER BY urutan asc")->result_array();
          $fix_courier_service=array();

          foreach($courier_services as $courier_service){
            if($unameStoreOwner!=''){
              $cek=$this->db->query("SELECT * FROM store_default_courier as sdc inner join store as s on sdc.id_store=s.id_user inner join stil.user_client as u on s.id_user=u.id WHERE sdc.id_courier_service='$courier_service[id]' and u.username='$unameStoreOwner'")->num_rows();
              if($cek>0){
                $courier_service['is_checked']=1;
              }else{
                $courier_service['is_checked']=0;
              }
            }

            array_push($fix_courier_service,$courier_service);
          }
          $courier['courier_services']=$fix_courier_service;
          array_push($fix_courier,$courier);
        }


        return $fix_courier;
  }

  public function getCourierListSpecial($product_id,$courType){
        if($courType!='count'){
          $cour_clause=" AND type='$courType' ";
        }else{
          $cour_clause="";
        }
        $couriers=$this->db->query("SELECT id,logo,name FROM courier where is_active=1 $cour_clause ORDER BY urutan asc")->result_array();
        $fix_courier=array();
        $count_checked=0;

        foreach($couriers as $courier){
          $courier_services=$this->db->query("SELECT jenis_pengiriman,id,service_name,service_code FROM courier_service where is_active=1 and id_courier='$courier[id]' ORDER BY urutan asc")->result_array();
          $fix_courier_service=array();

          foreach($courier_services as $courier_service){
              $cek=$this->db->query("SELECT * FROM product_special_courier as psc WHERE psc.id_courier_service='$courier_service[id]' and psc.id_product='$product_id'")->num_rows();
              if($cek>0){
                $courier_service['is_checked']=1;
                $count_checked++;
              }else{
                $courier_service['is_checked']=0;
              }


            array_push($fix_courier_service,$courier_service);
          }
          $courier['courier_services']=$fix_courier_service;

          array_push($fix_courier,$courier);
        }

        if($courType!='count'){
          return $fix_courier;
        }else{
          return $count_checked;
        }
  }


}

?>
