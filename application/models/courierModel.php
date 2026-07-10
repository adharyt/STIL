<?php

class courierModel extends CI_Model{


  function getCourierListStore($user_id,$store_id){
      $from='';
      $to='';
      $weight=ceil($this->db->query("SELECT SUM(p.weight*ct.quantity) as tweight FROM product as p INNER JOIN cart_tempcheckout as ct ON p.id=ct.id_product WHERE ct.id_user='$user_id' and ct.id_store='$store_id' and ct.status=0")->result_array()[0]['tweight']/1000);
      $temp_data=$this->db->query("SELECT c.logo,cs.id as id, cs.service_name as text
        FROM store_default_courier as sdc
        inner join  courier_service as cs on sdc.id_courier_service=cs.id
        inner join courier as c on cs.id_courier=c.id
        where sdc.id_store=$store_id and cs.service_name like '%$_GET[search]%'
        order by c.urutan asc,cs.urutan asc")->result_array();
      $fixdata=array();
      $data['logo']='splitcourier.png';
      $data['id']=0;
      $data['text']="Pilih kurir yang berbeda untuk setiap produk.";
      $data['cost']=0;
      $data['time']='0';
      array_push($fixdata,$data);
      foreach($temp_data as $data){
        if($data['id']==1){
          $data['cost']=4000;
          $data['time']='Instant';
        }else{
          $data['cost']=10000*$weight;
          $data['time']='1 day';
        }

        array_push($fixdata,$data);
      }


      return $fixdata;
  }


  function getCourierListProduct($user_id,$id){
      $cek=$this->db->query("SELECT is_specialdelivery,id_user,id FROM product where id='$id'")->result_array()[0];
      $store_id=$cek['id_user'];
      $from='';
      $to='';

      $weight=ceil($this->db->query("SELECT SUM(p.weight*ct.quantity) as tweight FROM product as p INNER JOIN cart_tempcheckout as ct ON p.id=ct.id_product WHERE ct.id_user='$user_id' and ct.id_store='$store_id' and p.id='$id' and ct.status=0")->result_array()[0]['tweight']/1000);

      if($cek['is_specialdelivery']==1){
        $temp_data=$this->db->query("SELECT c.logo,cs.id as id, cs.service_name as text
          FROM product_special_courier as psc
          inner join  courier_service as cs on psc.id_courier_service=cs.id
          inner join courier as c on cs.id_courier=c.id
          where psc.id_product='$cek[id]' and cs.service_name like '%$_GET[search]%'
          order by c.urutan asc,cs.urutan asc")->result_array();
      }else{
        $temp_data=$this->db->query("SELECT c.logo,cs.id as id, cs.service_name as text
          FROM store_default_courier as sdc
          inner join  courier_service as cs on sdc.id_courier_service=cs.id
          inner join courier as c on cs.id_courier=c.id
          where sdc.id_store=$store_id and cs.service_name like '%$_GET[search]%'
          order by c.urutan asc,cs.urutan asc")->result_array();
      }
      $fixdata=array();

      foreach($temp_data as $data){
        if($data['id']==1){
          $data['cost']=4000;
          $data['time']='Instant';
        }else{
          $data['cost']=10000*$weight;
          $data['time']='1 day';
        }
        array_push($fixdata,$data);
      }


      return $fixdata;

  }

  public function getCourierAvailableProduct($product_id){
        $cek=$this->db->query("SELECT is_specialdelivery,id_user,id FROM product where id='$product_id'")->result_array()[0];
        $store_id=$cek['id_user'];

        $fixdata=array();

        if($cek['is_specialdelivery']==1){
          $cek_courier=$this->db->query("SELECT distinct c.id,c.logo,c.name
            FROM product_special_courier as psc
            inner join  courier_service as cs on psc.id_courier_service=cs.id
            inner join courier as c on cs.id_courier=c.id
            where psc.id_product='$cek[id]'
            and cs.is_active=1
            order by c.urutan asc,cs.urutan asc")->result_array();

            foreach($cek_courier as $cour_temp){
                $cour_temp['courier_services']=$this->db->query("SELECT cs.id as id, cs.service_name
                FROM product_special_courier as psc
                inner join  courier_service as cs on psc.id_courier_service=cs.id
                inner join courier as c on cs.id_courier=c.id
                where psc.id_product='$cek[id]' and c.id='$cour_temp[id]'
                and cs.is_active=1
                order by cs.urutan asc")->result_array();

                array_push($fixdata,$cour_temp);
            }


        }else{
          $cek_courier=$this->db->query("SELECT distinct c.id,c.logo,c.name
            FROM store_default_courier as sdc
            inner join  courier_service as cs on sdc.id_courier_service=cs.id
            inner join courier as c on cs.id_courier=c.id
            where sdc.id_store=$store_id
            and cs.is_active=1
            order by c.urutan asc,cs.urutan asc")->result_array();

            foreach($cek_courier as $cour_temp){
                $cour_temp['courier_services']=$this->db->query("SELECT cs.id as id, cs.service_name
                  FROM store_default_courier as sdc
                  inner join  courier_service as cs on sdc.id_courier_service=cs.id
                  inner join courier as c on cs.id_courier=c.id
                  where sdc.id_store=$store_id and c.id='$cour_temp[id]'
                  and cs.is_active=1
                  order by cs.urutan asc")->result_array();

                array_push($fixdata,$cour_temp);
            }
        }



        return $fixdata;
  }

  public function getCourierServiceList(){
          $courier_services=$this->db->query("SELECT cs.id,cs.service_name,cs.jenis_pengiriman
                                              FROM  courier_service as cs
                                              inner join courier as c on cs.id_courier=c.id
                                              where cs.is_active=1
                                              order by c.urutan asc,cs.urutan asc")->result_array();



        return $courier_services;
  }

  public function getCourierServiceName($id){
    $courier_services=$this->db->query("SELECT cs.service_name
                                        FROM  courier_service as cs
                                        where cs.id='$id'")->result_array()[0];

    return $courier_services['service_name'];
  }



}
