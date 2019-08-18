<?php
class X_validate extends CI_Controller{

	function __construct(){
		parent::__construct();



	}


	function phone(){
		$phone = $this->input->post('phone');
		$cekdata=$this->db->query("SELECT phone FROM user_client where phone=".$this->db->escape($phone))->num_rows();
		if($cekdata>0){
			echo "DUPLICATE";
		}else{
			echo "OK";
		}
 	}

	function email(){
		$email = $this->input->post('email');
		$cekdata=$this->db->query("SELECT email FROM user_client where email=".$this->db->escape($email))->num_rows();
		if($cekdata>0){
			echo "DUPLICATE";
		}else{
			echo "OK";
		}
 	}



}
