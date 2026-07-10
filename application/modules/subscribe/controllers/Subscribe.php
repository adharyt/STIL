<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Subscribe extends CI_Controller{
		public function index(){

			$email=$this->input->post('email');
			$kode=stilUniq(20);

			$cekquery="SELECT * FROM crm_subscribe where email=".$this->db->escape($email);

			$cekdata=$this->db->query($cekquery)->num_rows();


			if($cekdata==0){
				$this->db->query("INSERT INTO crm_subscribe (email,code,status,date_reg) VALUES (".$this->db->escape($email).",'$kode','0',now())");
				//kirim email
				$this->load->model('emailModel');
				$mail_template=base_url().'application/views/template/email/subscribe_verification.html';
				$verification_link=base_url()."subscribe/activation?email=$email&code=$kode";

				$mailContent=file_get_contents($mail_template, true);
				$mailContent = str_replace('{{link}}', $verification_link, $mailContent);

				$mailDestination=$email;
				$mailSubject='[STIL]Verifikasi Email Newsletter!';
				$this->emailModel->sysMail($mailDestination,$mailSubject,$mailContent);
				$res="SUB";
			}else{
				$cekstatus=$this->db->query($cekquery)->result_array();
				$status=$cekstatus[0]['status'];
				switch($status){
					case '0':
						$res="SUB";
						//kirim email
						$kode=$cekstatus[0]['code'];
						$this->load->model('emailModel');
						$mail_template=base_url().'application/views/template/email/subscribe_verification.html';
						$verification_link=base_url()."subscribe/activation?email=$email&code=$kode";

						$mailContent=file_get_contents($mail_template, true);
						$mailContent = str_replace('{{link}}', $verification_link, $mailContent);

						$mailDestination=$email;
						$mailSubject='Verifikasi Email Newsletter STIL.id!';
						$this->emailModel->sysMail($mailDestination,$mailSubject,$mailContent);
						break;
					case '1':
						$res="REG";
						break;
					case '2':
						$res="SUB";
						$this->db->query("INSERT INTO crm_subscribe (email,code,status,date_reg) VALUES (".$this->db->escape($email).",'$kode','0',now())");
						//kirim email
						$this->load->model('emailModel');
						$mail_template=base_url().'application/views/template/email/subscribe_verification.html';
						$verification_link=base_url()."subscribe/activation?email=$email&code=$kode";

						$mailContent=file_get_contents($mail_template, true);
						$mailContent = str_replace('{{link}}', $verification_link, $mailContent);

						$mailDestination=$email;
						$mailSubject='Verifikasi Email Newsletter STIL.id!';
						$this->emailModel->sysMail($mailDestination,$mailSubject,$mailContent);
						break;
				}

			}
			echo "$res";
		}

		public function fromPanel(){
			$prop=$this->input->post('prop');
			$email=$this->session->userdata('email');
			$kode=stilUniq(20);

			if($prop==1){
				$this->db->query("INSERT INTO crm_subscribe (email,code,status,date_reg,date_act) VALUES (".$this->db->escape($email).",'$kode','1',now(),now())");
				$res="Berhasil berlangganan!";
			}else{
				$this->db->query("UPDATE crm_subscribe set status=2,date_uns=now() where email='$email' and status=1");
				$res="Berhasil berhenti berlangganan!";
			}

			echo $res;

		}

		public function activation(){
			$email=$this->input->get('email');
			$code=$this->input->get('code');

			$confir=$this->db->query("SELECT * FROM crm_subscribe WHERE email='$email' and code='$code' and status=0")->num_rows();
			if($confir>0){
				$update=$this->db->query("UPDATE crm_subscribe set status=1,date_act=now() WHERE email='$email' and code='$code' and status=0");

				$this->load->model('emailModel');
				$mail_template=base_url().'application/views/template/email/subscribe_verification_success.html';

				$unregisterlink=base_url()."subscribe/unregister?email=$email&code=$kode";

				$mailContent=file_get_contents($mail_template, true);
				$mailContent = str_replace('{{name}}', $name, $mailContent);
				$mailContent = str_replace('{{link}}', $unregisterlink, $mailContent);

				$mailDestination=$email;
				$mailSubject='[STIL]Berhasil berlangganan Newsletter!';
				$this->emailModel->sysMail($mailDestination,$mailSubject,$mailContent);

				$this->session->set_flashdata('swalert','register_newsletter_success');
				redirect(base_url());

			}else{
				$this->load->view('template/alert/link_not_found');
				//redirect(base_url());
			}
		}

		public function unregister(){
			$email=$this->input->get('email');
			$code=$this->input->get('code');

			$confir=$this->db->query("SELECT * FROM crm_subscribe WHERE email='$email' and code='$code' and status=1")->num_rows();
			if($confir>0){
				$update=$this->db->query("UPDATE crm_subscribe set status=2,date_uns=now() WHERE email='$email' and code='$code' and status=1");

				$this->load->model('emailModel');
				$mail_template=base_url().'application/views/template/email/subscribe_unregister_success.html';


				$mailContent=file_get_contents($mail_template, true);
				$mailContent = str_replace('{{name}}', $name, $mailContent);

				$mailDestination=$email;
				$mailSubject='[STIL]Berhasil berhenti berlangganan Newsletter!';
				$this->emailModel->sysMail($mailDestination,$mailSubject,$mailContent);

				$this->session->set_flashdata('swalert','unregister_newsletter_success');
				redirect(base_url());

			}else{
				$this->load->view('template/alert/link_not_found');
				//redirect(base_url());
			}
		}




		}
