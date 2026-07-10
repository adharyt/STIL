<?php
	class User_Notification extends CI_Controller{
		public function __construct(){
			parent::__construct();
		}

		public function countNotification(){
			if($this->session->userdata('is_login')!='y'){
				$data['res_is_login']='n';
			}else{
				$id_member=$this->session->userdata('user_id');

				$data['res_is_login']='y';
				$data['res_value']=$this->notificationModel->countNotificationUser($id_member);
			}

			echo json_encode($data);

		}

		public function all_notification() {
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}

			if(isset($_GET['page'])){
				$page=$_GET['page'];
			}else{
				$page='1';
			}

			if(isset($_GET['show_unread_only'])){
				$filter['is_unread']=$_GET['show_unread_only'];
			}else{
				$filter['is_unread']='false';
			}



			$content_per_page=10;
			$start=($page>1)?($page*$content_per_page)-$content_per_page:0;

			$data['final_filter']="&show_unread_only=$filter[is_unread]";
			$data['popNotif']['general']=$this->notificationModel->get_Notification($this->session->userdata('user_id'),$filter,$start,$content_per_page,'1')->result_array();
			$data['dataProductCount']=$this->notificationModel->get_Notification($this->session->userdata('user_id'),$filter,'','','')->num_rows();

			$data['lastLink']=0;
			$data['page']=$page;
			$data['pages']=ceil($data['dataProductCount']/$content_per_page);
			$data['content_per_page']=$content_per_page;


			$this->load->view('appinfo');
			$this->load->view('user_notification/main/user_notification_main_s');
			$this->load->view('header');
			$this->load->view('up_sidebar');
			$this->load->view('user_notification/main/user_notification_main_v',$data);
			$this->load->view('footer');
			$this->load->view('user_notification/main/user_notification_main_x');
    }

		public function getTransNotification(){
			$data['popTrans']=$this->notificationModel->get_PopUpTransaction($this->session->userdata('user_id'));
			$this->load->view('template/popup/transactionPopup',$data);
		}

		public function getNotification(){
			if($this->session->userdata('is_login')!='y'){
				echo "EXPIRED_SESSION";
			}else{
				$data['popNotif']=$this->notificationModel->get_PopUpNotification($this->session->userdata('user_id'),10);
				$this->load->view('template/popup/notificationPopup',$data);
			}
		}

		public function readNotification($id){
			$user_id=$this->session->userdata('user_id');
			$this->load->model('transactionModel');
			$cekNotif=$this->db->query("SELECT * FROM user_notification_general where id='$id' and id_user='$user_id'");
			if($cekNotif->num_rows()>0){
				$notif=$cekNotif->result_array()[0];
				if($notif['lup_clicked']==''){
					$this->db->query("UPDATE user_notification_general set lup_clicked=now() where id='$id'");
				}
				switch($notif['tipe']){
					  //reminder cart
						case '1':
							redirect(base_url().'cart');
							break;
						//pembayaran
						case '2':
						case '3':
							redirect(base_url().'checkout-payment/'.$notif['node']);
							break;
						//invoice
						case '4':
						case '5':
						case '6':
						case '10':
						case '12':
							redirect(base_url().'my-account/transaction-split?reference='.$notif['node']);
							break;
						//pencairan dana
						case '9':
					  case '11':
							redirect(base_url().'my-account/wallet');
							break;
						case '7':
						case '21':
						case '22':
						case '23':
							$invoice=$this->transactionModel->getInvoiceByTrans($notif['node']);
							redirect(base_url().'my-account/transaction/'.$invoice['invoice']);
						  break;
						default:
						  redirect(base_url().'my-account/notification');
							break;
				}
			}else{
				redirect(base_url());
			}
		}

	}
