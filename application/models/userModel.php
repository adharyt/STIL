<?php
class userModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getPhoto($username,$photo,$gender){
    if($photo==""){
      if($gender=="m"){
        $photo=base_url()."assets/images/image-default/default_user_m.png";
      }else{
        $photo=base_url()."assets/images/image-default/default_user_f.png";
      }
    }else{
      $photo=base_url()."document_upload/".$username."/my-data/profilepicture/$photo";
    }

    return $photo;
  }

  public function getStorePhoto($username,$photo){
    if($photo==""){
      $photo=base_url()."assets/images/image-default/default_store_photo.png";
    }else{
      $photo=base_url()."document_upload/".$username."/my-data/storepicture/$photo";
    }

    return $photo;
  }

  public function getHeaderPhoto($username,$photo){
    if($photo==""){
      $photo=base_url()."assets/images/image-default/default_store_header.png";
    }else{
      $photo=base_url()."document_upload/".$username."/my-data/storeheader/$photo";
    }

    return $photo;
  }


}

?>
