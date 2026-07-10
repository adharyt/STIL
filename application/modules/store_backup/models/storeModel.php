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


}

?>
