<?php
class productModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getProductDetail($store_id,$product_id){
    $sql = "SELECT p.pr_name,p.price,u.store_name,u.store_notes,u.photo,u.store_notes,u.store_city,u.store_lastdelivery,u.store_lup_active
    FROM product as p inner join user_client as u on p.id_user=u.id
    where u.username='$store_id'
    and p.id='$product_id'
    and u.is_store_active='1'
    limit 1";
    return $this->db->query($sql);
  }

  public function getProductImage($product_id){
    $sql = "SELECT img_url,is_selected
    FROM product_image
    where id_product='$product_id'
    and is_deleted=0
    ORDER BY is_selected desc";

    $cek_img=$this->db->query($sql)->num_rows();
    if($cek_img>0){
      return $this->db->query($sql)->result_array();
    }else{
      //Jika gambar tidak ada
      $data_img=[
        ["img_url"=>"image-not-available.png","is_selected"=>1]
      ];
      return $data_img;
    }
  }


}

?>
