<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Chat extends CI_Controller {
    function __construct() {
      	parent::__construct();
    }




    public function countNotification(){
			if($this->session->userdata('is_login')!='y'){
				$data['res_is_login']='n';
			}else{
				$id_member=$this->session->userdata('user_id');
				$data['res_is_login']='y';
				$data['res_value']=$this->chatModel->getChatCountUnread($id_member);
			}

			echo json_encode($data);

		}

    public function insertNewMessage() {
      $userId; $storeId;
      $userType = $this->input->post('type');
      $message = $this->input->post('message');
      if($userType == 1) {
        $userId = $this->session->userdata('user_id');
        $storeId = $this->input->post('id');
        $data['receiver_id']=$this->storeModel->getUserIdByStoreId($storeId);
      } else {
        $userId = $this->input->post('id');
        $storeId = $this->chatModel->getStoreId($this->session->userdata('user_id'));
        $data['receiver_id']=$userId;
      }

      $payload = array (
        'userId' => $userId,
        'storeId' => $storeId,
        'message' => $message,
        'type' => $userType,
        'lup' => date('Y-m-d H:i:s')
      );


      $response = $this->chatModel->insertNewMessage($payload);


      if($response!="FAILED"){
        echo json_encode($data);
      }else{
        echo "FAILED";
      }

    }

    public function getMessage() {
      $userType = $this->input->post('type');
      $userId;
      $storeId;
      if($userType == 1) {
        $userId = $this->session->userdata('user_id');
        $storeId = $this->input->post('id');
      } else {
        $userId = $this->input->post('id');
        $storeId = $this->chatModel->getStoreId($this->session->userdata('user_id'));
      }

      $payload = array (
        'userId' => $userId,
        'storeId' => $storeId,
        'lup' => date('Y-m-d H:i:s')
      );

      if($userType == 1) { // If as User
        echo $this->chatModel->getMessageAsUser($payload);
      } else { // else as Store
        echo $this->chatModel->getMessageAsStore($payload);
      }
    }

    public function getChatRoom() {
      $type = $this->input->post('type');
      $id = $this->session->userdata('user_id');

      if($type == 1) { // If as User
        echo $this->chatModel->getChatRoomByUserId($id);
      } else { // else as Store
        $store_id=$this->chatModel->getStoreId($id);
        echo $this->chatModel->getChatRoomByStoreId($store_id,$id);
      }
    }

    public function getStoreId() {
      echo $this->chatModel->getStoreId($this->session->userdata('user_id'));
    }


  public function newChatRoomUser(){
    if($this->session->userdata('is_login')=='y'){
      $res_data['is_login']="true";

      $id_user=$this->session->userdata('user_id');
      $id_store=$this->input->post('id_store');

      $is_valid_store=$this->db->query("SELECT * FROM store WHERE id='$id_store' AND id_user!='$id_user' AND is_deleted=0")->num_rows();
      if($is_valid_store>0){
          $cek=$this->db->query("SELECT * FROM chat_room WHERE user_id='$id_user' AND store_id='$id_store'");

          if($cek->num_rows()>0){
            $id_room=$cek->result_array()[0]['id'];
            $cek2=$this->db->query("SELECT * FROM chat WHERE room_id='$id_room'")->num_rows();
            if($cek2>0){
              $res_data['res_chat']='true';
            }else{
              $res_data['res_chat']='false';
            }
            $res_data['res']="OK";
          }else{
            $this->db->query("INSERT INTO chat_room (user_id,store_id,lup) VALUES ('$id_user','$id_store',now())");
            $res_data['res_chat']='false';
            $res_data['res']="OK";
          }
        }else{
          $res_data['res']="NOT OK";
        }
      }else{
        $res_data['is_login']="false";
      }



    echo json_encode($res_data);

  }

  public function newChatRoomStore(){
    if($this->session->userdata('is_login')=='y'){
        $res_data['is_login']="true";

        $id_seller=$this->session->userdata('user_id');
        $id_store=$this->storeModel->getStoreIdByUserId($id_seller);

        $id_user=$this->input->post('id_user');

        $is_have_store=$this->storeModel->checkIsHaveStore($id_seller);

        if($is_have_store>0){
          //cek apakah user membeli di toko ini
          $is_user_trans=$this->db->query("SELECT * FROM sales as s
                                           INNER JOIN sales_detail_trans as sdt ON s.invoice=sdt.id_invoice
                                           WHERE s.id_user='$id_user' AND sdt.id_seller='$id_seller' AND s.status=1")->num_rows();


          if($is_user_trans>0 && $id_seller!=$id_user){
              $cek=$this->db->query("SELECT * FROM chat_room WHERE user_id='$id_user' AND store_id='$id_store'");

              if($cek->num_rows()>0){
                $id_room=$cek->result_array()[0]['id'];
                $cek2=$this->db->query("SELECT * FROM chat WHERE room_id='$id_room'")->num_rows();
                if($cek2>0){
                  $res_data['res_chat']='true';
                }else{
                  $res_data['res_chat']='false';
                }
                $res_data['res']="OK";
              }else{
                $this->db->query("INSERT INTO chat_room (user_id,store_id,lup) VALUES ('$id_user','$id_store',now())");
                $res_data['res_chat']='false';
                $res_data['res']="OK";
              }
            }else{
              $res_data['res']="NOT OK";
            }
        }else{
          $res_data['res']="NOT OK";
        }

      }else{
        $res_data['is_login']="false";
      }

    echo json_encode($res_data);

  }

}
?>
