<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Sc_product_new extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
			date_default_timezone_set('Asia/Jakarta');
		}


		//NEW PRODUCT START
		public function newProduct(){
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}

			$this->load->model('seller_centerModel');
			$store_id=$this->session->userdata('store_name');
			$data['couriers_stil']=$this->seller_centerModel->getCourierList($this->session->userdata('username'),'STIL');
			$data['couriers_abke']=$this->seller_centerModel->getCourierList($this->session->userdata('username'),'ABKE');
			$data['couriers_bade']=$this->seller_centerModel->getCourierList($this->session->userdata('username'),'BADE');
			$data['storeDefault']=$this->productModel->getStoreDefaultConf($this->session->userdata('username'))[0];
			$this->load->view('appinfo');
			$this->load->view('userProductNew/userProductNew_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('userProductNew/userProductNew_v',$data);
			$this->load->view('footer');
			$this->load->view('userProductNew/userProductNew_x');
			$this->load->view('userProductNew/userProductNew_z');
		}


		//INSERT
		public function newProduct_submit(){

			$now=date('Y-m-d h:i:s');
			$data_etalase=$_POST['produk_etalase'];
			$pr_uniq=stilUniq(8);
			$pr_slug=slug($_POST['produk_nama']);
			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'is_visibility' => '1',
				'lup' 		=> $now,
				'last_updated' 		=> '',
				'pr_name' => $_POST['produk_nama'],
				'pr_slug' => $pr_slug,
				'pr_uniq' => $pr_uniq,
				'pr_sku' => $_POST['produk_sku'],
				'id_category' => $_POST['produk_kategori'],
				'pr_description' => $_POST['produk_deskripsi'],
				'pr_source' => $_POST['produk_sumber'],
				'pr_condition' => $_POST['produk_kondisi'],
				'stock_type' => $_POST['produk_stockType'],
				'stock' => $_POST['produk_stockValue'],
				'buy_minimum' => $_POST['produk_unitMin'],
				'price' => $this->numberingModel->integerDeseparation(',',$_POST['produk_harga']),
				'weight' => str_replace(",",".",$_POST['produk_berat']),
				'is_asuransi' => $_POST['produk_asuransi'],
				'pr_video' => $_POST['produk_video'],
				'is_wholesale' => $_POST['grosir_is_active'],
				'wh_unit1' => $this->numberingModel->numeric_check($_POST['grosir_u1']),
				'wh_price1' => $this->numberingModel->numeric_check($this->numberingModel->integerDeseparation(',',$_POST['grosir_h1'])),
				'wh_unit2' => $this->numberingModel->numeric_check($_POST['grosir_u2']),
				'wh_price2' => $this->numberingModel->numeric_check($this->numberingModel->integerDeseparation(',',$_POST['grosir_h2'])),
				'wh_unit3' => $this->numberingModel->numeric_check($_POST['grosir_u3']),
				'wh_price3' => $this->numberingModel->numeric_check($this->numberingModel->integerDeseparation(',',$_POST['grosir_h3'])),
				'wh_unit4' => $this->numberingModel->numeric_check($_POST['grosir_u4']),
				'wh_price4' => $this->numberingModel->numeric_check($this->numberingModel->integerDeseparation(',',$_POST['grosir_h4'])),
				'wh_unit5' => $this->numberingModel->numeric_check($_POST['grosir_u5']),
				'wh_price5' => $this->numberingModel->numeric_check($this->numberingModel->integerDeseparation(',',$_POST['grosir_h5'])),
				'is_processtime_set' => $_POST['processtime_is_active'],
				'processtime_id' => $_POST['processtime_type'],
				'processtime_instan' => $_POST['processtime_instan'],
				'processtime_preorder' => $_POST['processtime_preorder'],
				'is_specialdelivery'	=> $_POST['is_specialcourier']
				);

				$this->db->trans_start();
				$insert_product=$this->productModel->newProduct_submit($data);
				if($insert_product){
					$idProduk=$this->db->insert_id();
					$this->db->trans_complete();

					if($_POST['is_specialcourier']==1){
						foreach($_POST['couriers'] as $cour){
							$this->db->query("INSERT INTO product_special_courier(id_product,id_courier_service,lup) VALUES ('$idProduk','$cour',now())");
						}
					}

					$nodeEtalase=explode(',',$data_etalase);
					foreach($nodeEtalase as $nodeEtalaseItem){
								//langsung insert
								$this->db->query("INSERT INTO product_storefront_byitem (id_storefront,id_product,lup) VALUES('$nodeEtalaseItem','$idProduk','$now') ");
					}
					$datares['idProduk']=$idProduk;
					$datares['link']=$pr_slug.'-'.$pr_uniq;
					echo json_encode($datares);
				}else{
					$this->db->trans_complete();
					echo "FAILED";
				}
		}

		//NEW PRODUCT END



}
