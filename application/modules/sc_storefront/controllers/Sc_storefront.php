<?php
	class Sc_storefront extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('seller_centerModel');
			$this->load->model('sc_storefrontModel');
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}
			$user_id=$this->session->userdata('user_id');
			$this->load->model('storeModel');
			if($this->storeModel->checkIsHaveStore($user_id)!=1){
				redirect('my-store/register');
			}
		}
		public function index() {
			$user_id=$this->session->userdata('user_id');
			$data['storefronts']=$this->sc_storefrontModel->getStorefront($user_id)->result_array();
			$this->load->view('appinfo');
			$this->load->view('seller_center_storefront_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('seller_center_storefront_v',$data);
			$this->load->view('footer');
			$this->load->view('seller_center_storefront_x');
		}

		public function position_edit(){
			$user_id=$this->session->userdata('user_id');
			$dataJSON=$this->input->post('data');
			$datas=json_decode($dataJSON);
			foreach($datas as $data){
				$this->db->query("UPDATE product_storefront set position='$data->pos' where id_user='$user_id' and id='$data->storefront_id'");
			}
		}

		public function getStorefrontJSON(){
			header("Content-Type: application/json; charset=UTF-8");
			$user_id=$this->session->userdata('user_id');
			echo json_encode($this->sc_storefrontModel->getStorefront($user_id)->result_array());
		}

		public function newStorefront(){
			$user_id=$this->session->userdata('user_id');
			$name=$_POST['name'];
			$slug=slug($name);
			$cekEtalase=$this->db->query("SELECT * FROM product_storefront where id_user='$user_id' and (name='$name' or slug='$slug')")->num_rows();
			if($cekEtalase==0){
				$cekLastPosition=$this->db->query("SELECT position FROM product_storefront where id_user='$user_id' order by position desc");
				if($cekLastPosition->num_rows()>=6){
					echo "MAX";
				}else{
					if($cekLastPosition->num_rows()>0){
						$numero=$cekLastPosition->result_array()[0]['position']+1;
					}else{
						$numero=1;
					}
					$this->db->trans_start();
					$this->db->query("INSERT INTO product_storefront (name,slug,id_user,lup,position) values('$name','$slug','$user_id',now(),'$numero')");
					$idEtalase=$this->db->insert_id();
					$this->db->trans_complete();
					echo "OK";
				}
			}else{
				echo "DUPLICATE";
			}
		}

		public function editConfirm(){
			$user_id=$this->session->userdata('user_id');
			$id=$this->input->post('id');
			$data['node']=$this->db->query("SELECT * FROM product_storefront where id='$id' and id_user='$user_id'")->result_array()[0];
			$this->load->view('template/editModal',$data);
		}

		public function editExe(){
			$user_id=$this->session->userdata('user_id');
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$slug=slug($name);
			$cekEtalase=$this->db->query("SELECT * FROM product_storefront where id_user='$user_id' and (name='$name' or slug='$slug') and id!='$id'")->num_rows();
			if($cekEtalase==0){
					$this->db->query("UPDATE product_storefront set name='$name',slug='$slug' WHERE id='$id' and id_user='$user_id'");
					echo "OK";
			}else{
				echo "DUPLICATE";
			}
		}

		public function deleteConfirm(){
			$user_id=$this->session->userdata('user_id');
			$id=$this->input->post('id');
			$data['node']=$this->db->query("SELECT * FROM product_storefront where id='$id' and id_user='$user_id'")->result_array()[0];
			$this->load->view('template/deleteModal',$data);
		}

		public function deleteExe(){
			$user_id=$this->session->userdata('user_id');
			$id=$this->input->post('id');
			$this->db->query("DELETE FROM product_storefront where id='$id' and id_user='$user_id'");
			$this->db->query("DELETE FROM product_storefront_byitem where id_storefront='$id'");
			echo "OK";
		}

	}
