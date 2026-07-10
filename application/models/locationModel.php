<?php

class locationModel extends CI_Model{


  function getProvince($STATE){
    if($STATE=='ID'){
      return $this->db->query("SELECT kode_wilayah as id,mst_kode_wilayah as id_parent,nama as text FROM zone_id where level=1 and nama like '%$_GET[search]%' ")->result_array();
    }
  }

  function getCity($STATE){
    if($STATE=='ID'){
      return $this->db->query("SELECT kode_wilayah as id,mst_kode_wilayah as id_parent,nama as text FROM zone_id where level=2 and mst_kode_wilayah='$_GET[parent]' and nama like '%$_GET[search]%' ")->result_array();
    }
  }

  function getCityIDInAll($STATE){
    if($STATE=='ID'){
      return $this->db->query("SELECT kode_wilayah as id_nya FROM zone_id where level=2 and nama like '%$_GET[search]%'")->result_array();
    }
  }

  function getCityBelowIDInAll($STATE){
    if($STATE=='ID'){
      return $this->db->query("SELECT mst_kode_wilayah as id_nya FROM zone_id where level=3 and nama like '%$_GET[search]%' ")->result_array();
    }
  }

  function getName($id){
      return $this->db->query("SELECT nama as text FROM zone_id where kode_wilayah='$id' ")->result_array()[0];

  }

  function getParentID($id){
      return $this->db->query("SELECT mst_kode_wilayah as id_parent FROM zone_id where kode_wilayah='$id' ")->result_array()[0];

  }

  function getCityToChild($parent){
      return $this->db->query("SELECT kode_wilayah as id,nama as text FROM zone_id where level=3 and mst_kode_wilayah='$parent' and (nama like '%$_GET[search]%' or mst_kode_wilayah in(select kode_wilayah FROM zone_id where nama like '%$_GET[search]%' and level=2) )")->result_array();
  }

  function printDetail($id){
      $ceklevel="SELECT level FROM zone_id where kode_wilayah='$id'";
      $level=$this->db->query($ceklevel)->result_array()[0]['level'];

      switch($level){
        default:
        case '1':
          $province=$this->db->query("SELECT nama FROM zone_id where kode_wilayah='$id'")->result_array()[0]['nama'];
          $fixAddress=$province;
          break;
        case '2':
          $city=$this->db->query("SELECT nama,mst_kode_wilayah as parent FROM zone_id where kode_wilayah='$id'")->result_array()[0];
          $province=$this->db->query("SELECT nama FROM zone_id where kode_wilayah='$city[parent]'")->result_array()[0]['nama'];
          $fixAddress=$province.', '.$city['nama'];
          break;
        case '3':
          $subcity=$this->db->query("SELECT nama,mst_kode_wilayah as parent FROM zone_id where kode_wilayah='$id'")->result_array()[0];
          $city=$this->db->query("SELECT nama,mst_kode_wilayah as parent FROM zone_id where kode_wilayah='$subcity[parent]'")->result_array()[0];
          $province=$this->db->query("SELECT nama FROM zone_id where kode_wilayah='$city[parent]'")->result_array()[0]['nama'];
          $fixAddress=$province.', '.$city['nama'].', '.$subcity['nama'];
          break;
      }
      return $fixAddress;

  }

  function printDetailReverse($id){
      $ceklevel="SELECT level FROM zone_id where kode_wilayah='$id'";
      $level=$this->db->query($ceklevel)->result_array()[0]['level'];

      switch($level){
        default:
        case '1':
          $province=$this->db->query("SELECT nama FROM zone_id where kode_wilayah='$id'")->result_array()[0]['nama'];
          $fixAddress=$province;
          break;
        case '2':
          $city=$this->db->query("SELECT nama,mst_kode_wilayah as parent FROM zone_id where kode_wilayah='$id'")->result_array()[0];
          $province=$this->db->query("SELECT nama FROM zone_id where kode_wilayah='$city[parent]'")->result_array()[0]['nama'];
          $fixAddress=$city['nama'].', '.$province;
          break;
        case '3':
          $subcity=$this->db->query("SELECT nama,mst_kode_wilayah as parent FROM zone_id where kode_wilayah='$id'")->result_array()[0];
          $city=$this->db->query("SELECT nama,mst_kode_wilayah as parent FROM zone_id where kode_wilayah='$subcity[parent]'")->result_array()[0];
          $province=$this->db->query("SELECT nama FROM zone_id where kode_wilayah='$city[parent]'")->result_array()[0]['nama'];
          $fixAddress=$subcity['nama'].', '.$city['nama'].', '.$province;
          break;
      }
      return $fixAddress;

  }


}
