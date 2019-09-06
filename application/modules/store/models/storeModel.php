<?php
class storeModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }


  public function getStoreFrontList($unameStoreOwner){
      return $this->db->query("SELECT sf.name,sf.slug,sf.id FROM product_storefront as sf
        left join user_client as u on sf.id_user=u.id
        where u.username='$unameStoreOwner'")->result_array();
  }

  public function getStoreProfile($unameStoreOwner){
      return $this->db->query("SELECT u.id as user_id,u.username as store_link, s.store_name,s.store_photo,s.store_header,z.nama as store_location FROM user_client as u
        inner join store as s on s.id_user=u.id
        inner join zone_id as z on z.kode_wilayah=s.store_city
        where u.username='$unameStoreOwner'")->result_array()[0];
  }


}

?>
