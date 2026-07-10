<?php
	class Sc_Notification extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('notificationModel');
			$this->load->model('seller_centerModel');
			if($this->session->userdata('is_login')!='y'){
				redirect($this->config->item('landing_url_login'));
			}

		}

		public function countNotification(){
			if($this->session->userdata('is_login')!='y'){
				$data['res_is_login']='n';
			}else{
				$id_member=$this->session->userdata('user_id');

				$data['res_is_login']='y';
				$data['res_value']=$this->notificationModel->countNotificationStore($id_member);
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
			$data['popNotif']['general']=$this->notificationModel->get_NotificationStore($this->session->userdata('user_id'),$filter,$start,$content_per_page,'1')->result_array();
			$data['dataProductCount']=$this->notificationModel->get_NotificationStore($this->session->userdata('user_id'),$filter,'','','')->num_rows();

			$data['lastLink']=0;
			$data['page']=$page;
			$data['pages']=ceil($data['dataProductCount']/$content_per_page);
			$data['content_per_page']=$content_per_page;


			$this->load->view('appinfo');
			$this->load->view('Sc_notification/main/store_notification_main_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('Sc_notification/main/store_notification_main_v',$data);
			$this->load->view('footer');
			$this->load->view('Sc_notification/main/store_notification_main_x');
    }

		public function getTransNotification(){
			$data['popTrans']=$this->notificationModel->get_PopUpTransactionStore($this->session->userdata('user_id'));
			$this->load->view('template/popup/transactionPopupStore',$data);
		}

		public function getNotification(){
			if($this->session->userdata('is_login')!='y'){
				echo "EXPIRED_SESSION";
			}else{
				$data['popNotif']=$this->notificationModel->get_PopUpNotificationStore($this->session->userdata('user_id'),10);
				$this->load->view('template/popup/notificationPopupStore',$data);
			}
		}

		public function readNotification($id){
			$user_id=$this->session->userdata('user_id');
			$this->load->model('transactionModel');
			$cekNotif=$this->db->query("SELECT * FROM store_notification_general where id='$id' and id_user='$user_id'");
			if($cekNotif->num_rows()>0){
				$notif=$cekNotif->result_array()[0];
				if($notif['lup_clicked']==''){
					$this->db->query("UPDATE store_notification_general set lup_clicked=now() where id='$id'");
				}
				switch($notif['tipe']){
					  //reminder cart
						case '9':
							redirect(base_url().'my-store/credit');
						break;
						default:
							redirect(base_url().'my-store/transaction?reference='.$notif['node']);
						break;

				}
			}else{
				redirect(base_url());
			}
		}

	}
