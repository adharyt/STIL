<?php
class Script extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('authModel');
	}

	public function uploadimg(){
			// Allowed extentions.
	    $allowedExts = array("gif", "jpeg", "jpg", "png");

	    // Get filename.
	    $temp = explode(".", $_FILES["imgarticle"]["name"]);

	    // Get extension.
	    $extension = end($temp);

			if(in_array($extension, $allowedExts)){
	        // Generate new random name.
	        $name = sha1(microtime()) . "." . $extension;
					$folder="$_SERVER[DOCUMENT_ROOT]/excolandingv2/assets/img/upload-img/".$name;
					$folderup="http://localhost/excolandingv2/assets/img/upload-img/".$name;
	        // Save file in the uploads folder.
	        move_uploaded_file($_FILES["imgarticle"]["tmp_name"], $folder);
					//$this->db->query("update member set alamat='$folder' where id=1");
	        // Generate response.
	        $response = new StdClass;
	        $response->link = $folderup;
	        echo stripslashes(json_encode($response));
	    }
		}

		


	public function changeTheme(){
		$theme=$_POST['theme'];
		$id=$this->session->userdata('id');

		$query=$this->db->query("UPDATE user_client set theme='$theme' where id='$id'");
		if($query){
			$this->session->set_userdata('theme',$theme);
			echo "SUCCESS";
		}else{
			echo "FAILED";
		}
	}





}
