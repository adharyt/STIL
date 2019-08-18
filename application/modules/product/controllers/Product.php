<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Product extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('productModel');
		}


		public function detail($store_id,$slug){


			//PRODUCT
			$data['dataProduct']=$this->productModel->getProductDetail($store_id,$slug)->result_array()[0];
			$data['dataProductImg']=$this->productModel->getProductImage($data['dataProduct']['product_id']);
			$node=explode("-",$data['dataProduct']['id_category']);
			$data['dataProduct']['name_category']=$this->productModel->getCategoryNameSummary($node[0],$node[1]);
			//STOREFEEDBACK
			$data['storeFeedbackCountPositive']=$this->productModel->getFeedback($data['dataProduct']['store_id'],'positive')->num_rows();
			$data['storeFeedbackCount']=$this->productModel->getFeedback($data['dataProduct']['store_id'],'all')->num_rows();
			$data['storeFeedback']=$this->productModel->getFeedback($data['dataProduct']['store_id'],'all')->result_array();
			//PRODUCTREVIEW
			$data['productReviewAverage']=$this->productModel->getReview($data['dataProduct']['product_id'],'average');
			$data['productReviewCount']=$this->productModel->getReview($data['dataProduct']['product_id'],'count');
			$data['productReview']=$this->productModel->getReview($data['dataProduct']['product_id'],'data');
			$data['productRating']=$this->productModel->getReview($data['dataProduct']['product_id'],'rating');

			$this->load->view('appinfo');
			$this->load->view('productDetail/productDetail_s');
			$this->load->view('header');
			$this->load->view('productDetail/productDetail_v',$data);
			$this->load->view('footer');
			$this->load->view('productDetail/productDetail_x');


		}

		public function newProduct(){
			$store_id=$this->session->userdata('store_name');
			$data['storeDefault']=$this->productModel->getStoreDefaultConf('drmp')[0];
			$this->load->view('appinfo');
			$this->load->view('userProductNew/userProductNew_s');
			$this->load->view('header');
			$this->load->view('userProductNew/userProductNew_v',$data);
			$this->load->view('footer');
			$this->load->view('userProductNew/userProductNew_x');
			$this->load->view('userProductNew/userProductNew_z');
		}



		public function getStorefront(){
			header("Content-Type: application/json; charset=UTF-8");
			echo $this->productModel->getStorefront();
		}

		public function newStorefront(){
			$user_id=$this->session->userdata('user_id');
			$name=$_POST['name'];
			$slug=slug($name);
			$cekEtalase=$this->db->query("SELECT * FROM product_storefront where id_user='$user_id' and (name='$name' or slug='$slug')")->num_rows();
			if($cekEtalase==0){
				$this->db->trans_start();
				$this->db->query("INSERT INTO product_storefront (name,slug,id_user,lup) values('$name','$slug','$user_id',now())");
				$idEtalase=$this->db->insert_id();
				$this->db->trans_complete();
				echo "OK";
			}else{
				echo "DUPLICATE";
			}
		}

		public function getCategoryBread(){
			$node=$_POST['node'];
			$node_ex=explode("-",$node);
			$cat=$node_ex[0];
			$id=$node_ex[1];

			echo $this->productModel->getCategoryName($cat,$id);
		}


		//INSERT
		public function newProduct_submit(){

			$now=date('Y-m-d h:i:s');
			$data_etalase=$_POST['produk_etalase'];
			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'is_visibility' => '1',
				'lup' 		=> $now,
				'last_updated' 		=> $now,
				'pr_name' => $_POST['produk_nama'],
				'pr_slug' => slug($_POST['produk_nama']),
				'pr_uniq' => stilUniq(8),
				'pr_sku' => $_POST['produk_sku'],
				'id_category' => $_POST['produk_kategori'],
				'pr_description' => $_POST['produk_deskripsi'],
				'pr_source' => $_POST['produk_sumber'],
				'pr_condition' => $_POST['produk_kondisi'],
				'stock_type' => $_POST['produk_stockType'],
				'stock' => $_POST['produk_stockValue'],
				'buy_minimum' => $_POST['produk_unitMin'],
				'price' => $_POST['produk_harga'],
				'weight' => str_replace(",",".",$_POST['produk_berat']),
				'is_asuransi' => $_POST['produk_asuransi'],
				'pr_video' => $_POST['produk_video'],
				'is_wholesale' => $_POST['grosir_is_active'],
				'wh_unit1' => $_POST['grosir_u1'],
				'wh_price1' => $_POST['grosir_h1'],
				'wh_unit2' => $_POST['grosir_u2'],
				'wh_price2' => $_POST['grosir_h2'],
				'wh_unit3' => $_POST['grosir_u3'],
				'wh_price3' => $_POST['grosir_h3'],
				'wh_unit4' => $_POST['grosir_u4'],
				'wh_price4' => $_POST['grosir_h4'],
				'wh_unit5' => $_POST['grosir_u5'],
				'wh_price5' => $_POST['grosir_h5'],
				'is_processtime_set' => $_POST['processtime_is_active'],
				'processtime_id' => $_POST['processtime_type'],
				'processtime_instan' => $_POST['processtime_instan'],
				'processtime_preorder' => $_POST['processtime_preorder']
				);

				$this->db->trans_start();
				$insert_product=$this->productModel->newProduct_submit($data);
				if($insert_product){
					$idProduk=$this->db->insert_id();
					$this->db->trans_complete();

					$nodeEtalase=explode(',',$data_etalase);
					foreach($nodeEtalase as $nodeEtalaseItem){
								//langsung insert
								$this->db->query("INSERT INTO product_storefront_byitem (id_storefront,id_product,lup) VALUES('$nodeEtalaseItem','$idProduk','$now') ");
					}
					echo $idProduk;
				}else{
					$this->db->trans_complete();
					echo "FAILED";
				}
		}

		public function uploadimg(){
			$username=$this->session->userdata('username');
			$productId=$_POST['productId'];

			// Allowed extentions.
	    $allowedExts = array("gif", "jpeg", "jpg", "png");
	    // Get filename.
	    $temp = explode(".", $_FILES["file"]["name"]);
	    // Get extension.
	    $extension = end($temp);

			if(in_array(strtolower($extension), $allowedExts)){
	        // Generate new random name.
	        $name = sha1(microtime()) . "." . $extension;
					$path="$_SERVER[DOCUMENT_ROOT]/stil/document_upload/".$username."/product/".$productId;
					if (!file_exists($path)) {
			    	mkdir($path, 0777, true);
					}
					//$folderup="http://localhost/stil/document_upload/".$username."/product/"$productId."/".$name;
	        // Save file in the uploads folder.
	        move_uploaded_file($_FILES["file"]["tmp_name"], $path."/".$name);
	        // Generate response.
	        //$response = new StdClass;
	        //$response->link = $folderup;
	        //echo stripslashes(json_encode($response));

					//Save to DB
					if($_FILES["file"]["name"]==$_POST['thumbnail']){
						$is_selected=1;
					}else{
						$is_selected=0;
					}

					$data = array(
						'id_product' => $productId,
						'img_url' => $name,
						'is_selected' => $is_selected,
						'lup' => date('Y-m-d h:i:s')
					);
					$this->productModel->newProductImage_submit($data);
	    }else{
				//echo "forbidden";
			}

			echo "ok";
		}
}
