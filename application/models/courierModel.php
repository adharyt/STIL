<?php

class courierModel extends CI_Model{


  function getCourierListStore($id){
      $temp_data=$this->db->query("SELECT c.logo,cs.id as id, cs.service_name as text
        FROM store_default_courier as sdc
        inner join  courier_service as cs on sdc.id_courier_service=cs.id
        inner join courier as c on cs.id_courier=c.id
        where sdc.id_store=$id and cs.service_name like '%$_GET[search]%'
        order by c.urutan asc,cs.urutan asc")->result_array();
      $fixdata=array();
      foreach($temp_data as $data){
        $data['cost']='10000';
        $data['time']='1 day';
        array_push($fixdata,$data);
      }
      return $fixdata;
  }


  function getCourierListProduct($id){
      $cek=$this->db->query("SELECT is_specialdelivery,id_user FROM product where id='$id'")->result_array()[0];

      $id_store=$cek['id_user'];
      if($cek['is_specialdelivery']==0){
        $query="SELECT c.logo,cs.id as id, cs.service_name as text
          FROM store_default_courier as sdc
          inner join  courier_service as cs on sdc.id_courier_service=cs.id
          inner join courier as c on cs.id_courier=c.id
          where sdc.id_store='$id_store' and cs.service_name like '%$_GET[search]%'
          order by c.urutan asc,cs.urutan asc";
      }


      return $this->db->query($query)->result_array();
  }



}
