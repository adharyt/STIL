<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Sc_product_edit extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
			date_default_timezone_set('Asia/Jakarta');
		}



		//EDIT PRODUCT START
		public function editProduct($id_product){
			if($this->session->userdata('is_login')!='y'){
				$this->session->set_flashdata('redirect_link',current_url());
				redirect($this->config->item('landing_url_login'));
			}

			$this->load->model('seller_centerModel');
			$this->load->model('sc_storefrontModel');
			$store_id=$this->session->userdata('store_name');

			$cek=$this->productModel->getProductDetailEdit($this->session->userdata('username'),$id_product)->num_rows();
			if($cek>=1){
				$data['product']=$this->productModel->getProductDetailEdit($this->session->userdata('username'),$id_product)->result_array()[0];
				$data['product_image']=$this->productModel->getProductImage($id_product,'y');
				$data['couriers_stil']=$this->seller_centerModel->getCourierListSpecial($id_product,'STIL');
				$data['couriers_abke']=$this->seller_centerModel->getCourierListSpecial($id_product,'ABKE');
				$data['couriers_bade']=$this->seller_centerModel->getCourierListSpecial($id_product,'BADE');
				$data['couriers_checked']=$this->seller_centerModel->getCourierListSpecial($id_product,'count');
				$data['storeDefault']=$this->productModel->getStoreDefaultConf($this->session->userdata('username'))[0];
				$data['cekProduk']='y';
			}else{
				$data['cekProduk']='n';
			}
			$this->load->view('appinfo');
			$this->load->view('userProductEdit/userProductEdit_s');
			$this->load->view('sc_header');
			$this->load->view('sc_sidebar');
			$this->load->view('userProductEdit/userProductEdit_v',$data);
			$this->load->view('footer');
			$this->load->view('userProductEdit/userProductEdit_x');
			$this->load->view('userProductEdit/userProductEdit_z');
		}

		public function getProductImagesEdit($id_product){
			$result=$this->productModel->getProductImagesEdit($id_product);
			header('Content-Type: application/json');
			echo json_encode($result);
		}

		public function editProduct_refresh_image(){
				$id_product=$this->input->post('id_product');
				$data['product_image']=$this->productModel->getProductImage($id_product);
			 	$this->load->view('userProductEdit/template_image',$data);
		}

		public function editProduct_edit_cover(){
			$user_id=$this->session->userdata('user_id');
			$id_image=$this->input->post('id_img');

			$id_product=$this->db->query("SELECT i.id_product FROM `product_image` as i inner join product as p on p.id=i.id_product inner join stil.user_client as u on u.id=p.id_user where i.id='$id_image'")->result_array()[0]['id_product'];

			//UPDATE
			if($id_product){
				$this->db->query("UPDATE product_image set is_selected=0 WHERE id_product='$id_product'");
				$this->db->query("UPDATE product_image set is_selected=1 WHERE id='$id_image' and id_product='$id_product'");

				echo "SUCCESS";
			}


		}

		public function editProduct_delete(){
			$user_id=$this->session->userdata('user_id');
			$id_image=$this->input->post('id_img');

			$id_product=$this->db->query("SELECT i.id_product FROM `product_image` as i inner join product as p on p.id=i.id_product inner join stil.user_client as u on u.id=p.id_user where i.id='$id_image'")->result_array()[0]['id_product'];
			//UPDATE
			if($id_product){
				$this->db->query("UPDATE product_image set is_deleted=1 WHERE id='$id_image' and id_product='$id_product'");

				echo "SUCCESS";
			}


		}




		public function editProduct_addImg(){
			$user_id=$this->session->userdata('user_id');
			$id_image=$this->input->post('product_id');
			$username=$this->session->userdata('username');

			if(isset($_POST["image"])){
				 $data = $_POST["image"];

				if(exif_imagetype($data)) {
					// Generate new random name.
				 $name = sha1(microtime()) . ".png";
				 $path="$_SERVER[DOCUMENT_ROOT]/stil/document_upload/".$username."/product/$id_image";
				 if (!file_exists($path)) {
					 mkdir($path, 0777, true);
				 }
				 $image_array_1 = explode(";", $data);

				 $image_array_2 = explode(",", $image_array_1[1]);

				 $data = base64_decode($image_array_2[1]);

				 if(file_put_contents($path."/".$name, $data)){
					 $update=$this->db->query("INSERT INTO product_image (id_product,img_url,lup) values('$id_image','$name',now())");
					 if($update){
						 echo "SUCCESS";
					 }else{
						 echo "FAILED";
					 }
				 }else{
					 echo "FAILED";
				 }
				}else{
					echo "FAILED";
				}
			}else{
				echo "FAILED";
			}
		}

		public function editProduct_editImg(){
			$user_id=$this->session->userdata('user_id');
			$id_image=$this->input->post('product_id');
			$id_image_cg=$this->input->post('id_img');
			$username=$this->session->userdata('username');

			if(isset($_POST["image"])){
				 $data = $_POST["image"];

				if(exif_imagetype($data)) {
					// Generate new random name.
				 $name = sha1(microtime()) . ".png";
				 $path="$_SERVER[DOCUMENT_ROOT]/stil/document_upload/".$username."/product/$id_image";
				 if (!file_exists($path)) {
					 mkdir($path, 0777, true);
				 }
				 $image_array_1 = explode(";", $data);

				 $image_array_2 = explode(",", $image_array_1[1]);

				 $data = base64_decode($image_array_2[1]);

				 if(file_put_contents($path."/".$name, $data)){
					 $this->db->query("UPDATE product_image set is_deleted=1 WHERE id='$id_image_cg' and id_product='$id_image'");
					 $update=$this->db->query("INSERT INTO product_image (id_product,img_url,lup) values('$id_image','$name',now())");
					 if($update){
						 echo "SUCCESS";
					 }else{
						 echo "FAILED";
					 }
				 }else{
					 echo "FAILED";
				 }
				}else{
					echo "FAILED";
				}
			}else{
				echo "FAILED";
			}
		}


		public function editProduct_submit(){

			$now=date('Y-m-d h:i:s');
			$idProduk=$_POST['id_product'];
			$data_etalase=$_POST['produk_etalase'];
			//$pr_uniq=stilUniq(8);
			$pr_slug=slug($_POST['produk_nama']);

			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'is_visibility' => '1',
				'last_updated' 		=> $now,
				'pr_name' => $_POST['produk_nama'],
				'pr_slug' => $pr_slug,
				//'pr_uniq' => $pr_uniq,
				'pr_sku' => $_POST['produk_sku'],
				'id_category' => $_POST['produk_kategori'],
				'pr_description' => $_POST['produk_deskripsi'],
				'pr_source' => $_POST['produk_sumber'],
				'pr_condition' => $_POST['produk_kondisi'],
				'stock_type' => $_POST['produk_stockType'],
				'stock' => $_POST['produk_stockValue'],
				'buy_minimum' => $_POST['produk_unitMin'],
				'price' => $this->numberingModel->integerDeseparation(',',$_POST['produk_harga']),
				'weight' => $this->numberingModel->integerDeseparation(',',$_POST['produk_berat']),
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

				$this->db->where('id', $idProduk);
				$this->db->where('id_user', $this->session->userdata('user_id'));
				$updateProduct=$this->db->update('product', $data);
				if($updateProduct){
					$this->db->query("DELETE FROM product_special_courier WHERE id_product='$idProduk'");
					$this->db->query("DELETE FROM product_storefront_byitem WHERE id_product='$idProduk'");

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
					echo "FAILED";
				}
		}
		//EDIT PRODUCT END

		public function getCategoryBread(){
			$node=$_POST['node'];
			$node_ex=explode("-",$node);
			$cat=$node_ex[0];
			$id=$node_ex[1];

			echo $this->productModel->getCategoryName($cat,$id);
		}

		public function store_photo_upload(){
			if(isset($_POST["image"])){
				 $data = $_POST["image"];
				 $username=$this->session->userdata('username');
				 $user_id=$this->session->userdata('user_id');



				if(exif_imagetype($data)) {
					// Generate new random name.
				 $name = sha1(microtime()) . ".png";
				 $path="$_SERVER[DOCUMENT_ROOT]/stil/document_upload/".$username."/my-data/storepicture";
				 if (!file_exists($path)) {
					 mkdir($path, 0777, true);
				 }
				 $image_array_1 = explode(";", $data);

				 $image_array_2 = explode(",", $image_array_1[1]);

				 $data = base64_decode($image_array_2[1]);

				 if(file_put_contents($path."/".$name, $data)){
					 $update=$this->db->query("UPDATE store set store_photo='$name' where id_user='$user_id'");
					 if($update){
						 $response=$this->userModel->getStorePhoto($username,$name);
					 }else{
						 $response="FAILED";
					 }
				 }else{
					 $response="FAILED";
				 }
				}else{
					$response="FAILED";
				}
			}else{
				$response="FAILED";
			}
			echo $response;
		}



}
