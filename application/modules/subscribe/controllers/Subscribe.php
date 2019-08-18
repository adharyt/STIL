<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Subscribe extends CI_Controller{
		public function index(){

			$email=$this->input->post('email');
			$kode=stilUniq(20);

			$cekquery="SELECT status FROM crm_subscribe where email=".$this->db->escape($email);

			$cekdata=$this->db->query($cekquery)->num_rows();


			if($cekdata==0){
				$this->db->query("INSERT INTO crm_subscribe (email,code,status,date_reg) VALUES (".$this->db->escape($email).",'$kode','0',now())");
				//kirim email
				echo "SUB";
			}else{
				$cekstatus=$this->db->query($cekquery)->result_array();
				$status=$cekstatus[0]['status'];
				switch($status){
					case '0':
						$res="SUB";
						//kirim email
						break;
					case '1':
						$res="REG";
						break;
					case '2':
						$res="SUB";
						$this->db->query("INSERT INTO crm_subscribe (email,code,status,date_reg) VALUES (".$this->db->escape($email).",'$kode','0',now())");
						//kirim email
						break;
				}
				echo "$res";
			}
		}




		}
