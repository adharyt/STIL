<?php
class productsModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  //wewe

  public function getProductQuickview($product_id,$store_id){
    $sql = "SELECT
    p.*,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.is_deleted as product_availability,
    s.id as store_id,
    s.store_name,
    s.store_notes,
    s.store_city,
    s.store_lup_active,
    u.username as store_link,
    u.photo
    FROM user_client as u
    LEFT JOIN product as p on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user
    where u.username='$store_id'
    and p.id='$product_id'
    and s.is_store_active='1'
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
