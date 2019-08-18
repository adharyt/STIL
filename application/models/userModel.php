<?php
class userModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getPhoto($username,$photo,$gender){
    if($photo==""){
      if($gender=="m"){
        $photo=base_url()."assets/images/image-user/default_user_m.png";
      }else{
        $photo=base_url()."assets/images/image-user/default_user_f.png";
      }
    }else{
      $photo="$photo";
    }

    return $photo;
  }


}

?>
