<?php
class sc_storefrontModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getStorefront($user_id){
    $sql = "SELECT
    id as value,name as text,slug FROM product_storefront WHERE id_user='$user_id' order by position asc";

    return $this->db->query($sql);
  }

  public function getStorefrontByProduct($user_id,$product_id){
    $sql = "SELECT
    ps.id as value,name as text FROM product_storefront as ps INNER JOIN product_storefront_byitem as psb ON ps.id=psb.id_storefront WHERE ps.id_user='$user_id' and psb.id_product='$product_id' order by position asc";

    return json_encode($this->db->query($sql)->result_array());
  }

  public function getStorefrontByProductAoS($user_id,$product_id){
    $sql = "SELECT
    ps.id  FROM product_storefront as ps INNER JOIN product_storefront_byitem as psb ON ps.id=psb.id_storefront WHERE ps.id_user='$user_id' and psb.id_product='$product_id' order by position asc";

    $datafix=array();
    $datas=$this->db->query($sql)->result_array();
    foreach($datas as $data){
      array_push($datafix,$data['id']);
    }

    return implode(',',$datafix);
  }

}

?>
