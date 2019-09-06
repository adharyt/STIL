<?php
	class Profile extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('profileModel');
		}

		public function index(){
			$this->load->view('appinfo');
			$this->load->view('editProfile_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-summary/profileSummary_v');
			$this->load->view('footer');
			$this->load->view('contact_x');
		}

		public function profileEdit(){
			$this->load->model('optionModel');

			$data['lastEdu']=$this->optionModel->get_lastEdu();
			$data['profile']=$this->profileModel->getProfile($this->session->userdata('user_id'));

			$this->load->view('appinfo');
			$this->load->view('editProfile_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-edit/profileEdit_v',$data);
			$this->load->view('footer');
			$this->load->view('editProfile_x');
		}

		public function profileWishlist(){
			$this->load->model('productModel');
			if(isset($_GET['page'])){
				$page=$_GET['page'];
			}else{
				$page='1';
			}

			if(isset($_GET['sort'])){
				$sorting=$this->input->get('sort');
			}else{
				$sorting="newest";
			}
			$data_search = array(
				'keyword' => "",
				'price_min' => "",
				'price_max' => "",
				'is_wholesale' => "0,1",
				'is_discount' => "0,1",
				'is_condition_new' => "1",
				'is_condition_second' => "1",
				'location_p'	=> "",
				'location_c'	=> "",
				'category'	=> "",
				'sorting'	=> "$sorting"
				);

			$content_per_page=5;
			$start=($page>1)?($page*$content_per_page)-$content_per_page:0;


			$data['searchVariable']="?grid=true";
			$data['dataProduct']=$this->productModel->getWishlist($data_search,$start,$content_per_page,'1')->result_array();
			$data['dataProductCount']=$this->productModel->getWishlist($data_search,'','','')->num_rows();
			$data['data_search']=$data_search;
			$data['lastLink']=0;
			$data['page']=$page;
			$data['pages']=ceil($data['dataProductCount']/$content_per_page);
			$data['content_per_page']=$content_per_page;

			$this->load->view('appinfo');
			$this->load->view('profile-wishlist/profileWishlist_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-wishlist/profileWishlist_v',$data);
			$this->load->view('footer');
			$this->load->view('profile-wishlist/profileWishlist_x');
		}

		public function profileSummary(){
			$this->load->view('appinfo');
			$this->load->view('editProfile_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-summary/profileSummary_v');
			$this->load->view('footer');
			$this->load->view('editProfile_x');
		}

		public function profileAddress(){
			$this->load->model('locationModel');
			$data['memberAddress']=$this->profileModel->getAddress($this->session->userdata('user_id'));

			$this->load->view('appinfo');
			$this->load->view('profile-address/profile_address_s');
			$this->load->view('header');
			$this->load->view('profile-sidebar');
			$this->load->view('profile-address/profile_address_v',$data);
			$this->load->view('footer');
			$this->load->view('profile-address/profile_address_x');
		}

		public function editSave(){
			$nama=$this->input->post('nama');
			$birthdate=$this->input->post('birthdate');
			$gender=$this->input->post('gender');
			$education=$this->input->post('education');
			$ktp_no=$this->input->post('ktp_no');
			$phone=$this->input->post('phone');

			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'name' => $nama,
				'birthdate' => $birthdate,
				'gender' 		=> $gender,
				'last_education' 		=> $education,
				'ktp_no' => $ktp_no,
				'phone' => $phone,
			);

			$response=$this->profileModel->editProfile($data);
			echo $response;
		}


		//ADDRESS

		public function addressAdd(){
			$name=$this->input->post('name');
			$penerima=$this->input->post('penerima');
			$telepon=$this->input->post('telepon');
			$kecamatan=$this->input->post('kecamatan');
			$kodepos=$this->input->post('kodepos');
			$alamat=$this->input->post('alamat');

			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'alias' => $name,
				'receiver' => $penerima,
				'phone' 		=> $telepon,
				'subcity' 		=> $kecamatan,
				'postalcode' => $kodepos,
				'address' => $alamat,
				'lup'		=> date('Y-m-d H:i:s')
			);

			$response=$this->profileModel->addressAdd($data);
			echo $response;
		}

		public function getMemberAddress(){
			$addressID=$_POST['id'];

			$cek=$this->profileModel->getAddressByID($this->session->userdata('user_id'),$addressID)->num_rows();
			if($cek>0){
				$data['memberAddress']=$this->profileModel->getAddressByID($this->session->userdata('user_id'),$addressID)->result_array()[0];
				$this->load->view('profile-address/editModal',$data);
			}else{
				echo "";
			}
		}

		public function addressEdit(){
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$penerima=$this->input->post('penerima');
			$telepon=$this->input->post('telepon');
			$kecamatan=$this->input->post('kecamatan');
			$kodepos=$this->input->post('kodepos');
			$alamat=$this->input->post('alamat');

			$data = array(
				'id_user' => $this->session->userdata('user_id'),
				'id' => $id,
				'alias' => $name,
				'receiver' => $penerima,
				'phone' 		=> $telepon,
				'subcity' 		=> $kecamatan,
				'postalcode' => $kodepos,
				'address' => $alamat,
				'lup'		=> date('Y-m-d H:i:s')
			);

			$response=$this->profileModel->addressEdit($data);
			echo $response;
		}

		public function getMemberAddressDelete(){
			$addressID=$_POST['id'];

			$cek=$this->profileModel->getAddressByID($this->session->userdata('user_id'),$addressID)->num_rows();
			if($cek>0){
				$data['memberAddress']=$this->profileModel->getAddressByID($this->session->userdata('user_id'),$addressID)->result_array()[0];
				$this->load->view('profile-address/deleteModal',$data);
			}else{
				echo "";
			}
		}

		public function addressDelete(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');

			$delete=$this->db->query("UPDATE user_client_address set is_deleted=1,is_default=0 where id='$id' and id_user='$id_user'");
			if($delete){
				$cekdata=$this->db->query("SELECT * FROM user_client_address where is_deleted=0 and id_user='$id_user'")->num_rows();
				$cek=$this->db->query("SELECT * FROM user_client_address where is_deleted=0 and id_user='$id_user' and is_default=1")->num_rows();
				if($cekdata>0 && $cek>0){
					$response="OK";
				}else if($cekdata>0 && $cek<=0){
					$theDefault=$this->db->query("SELECT id FROM user_client_address where is_deleted=0 and id_user='$id_user' ORDER BY lup desc limit 1")->result_array()[0]['id'];
					$setDefault=$this->db->query("UPDATE user_client_address set is_default=1 where id='$theDefault' and id_user='$id_user'");
					$response="OK";
				}else{
					$response="OK";
				}
			}else{
				$response="FAILED";
			}
			echo $response;
		}


		public function addressSetDefault(){
			$id=$this->input->post('id');
			$id_user=$this->session->userdata('user_id');

			$alldefault=$this->db->query("UPDATE user_client_address set is_default=0 where id_user='$id_user'");
			if($alldefault){
				$setdefault=$this->db->query("UPDATE user_client_address set is_default=1 where id_user='$id_user' and id='$id'");
				if($setdefault){
					$response="OK";
				}else{
					$response="FAILED";
				}
			}else{
				$response="FAILED";
			}


			echo $response;
		}

		public function photo_upload(){
			if(isset($_POST["image"])){
				 $data = $_POST["image"];
				 $username=$this->session->userdata('username');
				 $user_id=$this->session->userdata('user_id');



				if(exif_imagetype($data)) {
					// Generate new random name.
				 $name = sha1(microtime()) . ".png";
				 $path="$_SERVER[DOCUMENT_ROOT]/stil/document_upload/".$username."/my-data/profilepicture";
				 if (!file_exists($path)) {
					 mkdir($path, 0777, true);
				 }
				 $image_array_1 = explode(";", $data);

				 $image_array_2 = explode(",", $image_array_1[1]);

				 $data = base64_decode($image_array_2[1]);

				 if(file_put_contents($path."/".$name, $data)){
					 $update=$this->db->query("UPDATE user_client set photo='$name' where id='$user_id'");
					 if($update){
						 $this->session->set_userdata('photo',$name);
						 $response=$this->userModel->getPhoto($username,$name,$this->session->userdata('gender'));
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
