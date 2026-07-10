<?php
	class Sc_register extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
			$user_id=$this->session->userdata('user_id');
			$this->load->model('storeModel');
			if($this->storeModel->checkIsHaveStore($user_id)>0){
				redirect('my-store');
			}
		}

		public function index(){

			$this->load->view('appinfo');
			$this->load->view('streg_index');
		}

		public function register_submit(){
				$id_user=$this->session->userdata('user_id');
				$nama_toko=$_POST['nama_toko'];
				$nomor_telepon=$_POST['nomor_telepon'];
				$deskripsi_toko=$_POST['deskripsi_toko'];
				$subcity=$_POST['kota_toko'];
				$alamat_toko=$_POST['alamat_toko'];


				$name_check=$this->db->query("SELECT * from store where store_name='$nama_toko'")->num_rows();
				$name_check+0;



				if($name_check>0){
					echo "FAILED DUPLICATE NAME";
				}else{
					$this->load->model('locationModel');
					$kota_toko=$this->locationModel->getParentID($subcity)['id_parent'];

					$this->db->query("INSERT INTO store (
						id_user,
						store_name,
						store_description,
						store_notes,
						store_city,
						store_subcity,
						store_address,
						store_phone,
						store_lastdelivery,
						store_processtime_id,
						store_processtime_instan,
						store_processtime_preorder,
						store_open_sunday,
						store_open_monday,
						store_open_tuesday,
						store_open_wednesday,
						store_open_thursday,
						store_open_friday,
						store_open_saturday,
						store_lup_active,
						is_store_active
					)
					values (
						'$id_user',
						'$nama_toko',
						'$deskripsi_toko',
						'',
						'$kota_toko',
						'$subcity',
						'$alamat_toko',
						'$nomor_telepon',
						'17:00',
						'2',
						'8',
						'3',
						'1',
						'1',
						'1',
						'1',
						'1',
						'1',
						'1',
						now(),
						'1'
					)"
				);
				$this->db->query("INSERT into store_default_courier (id_store,id_courier_service,lup) VALUES ('$id_user','3',now())");
				$this->db->query("INSERT into store_default_courier (id_store,id_courier_service,lup) VALUES ('$id_user','4',now())");
				echo "SUCCESS";

				}

		}

	}
