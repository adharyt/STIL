<?php
 class chatModel extends CI_Model {

   function __construct(){
     $this->load->database();
     $profileName = "-";
   }

   public function getChatCountUnread($id_member){
     $unread_message_user=$this->db->query("SELECT * FROM chat_room as cr
   		 																INNER JOIN chat as c ON c.room_id=cr.id
   																		WHERE cr.user_id='$id_member' AND c.is_read='0' AND type=2")->num_rows();

    $user_have_store=$this->storeModel->checkIsHaveStore($id_member);
  	if($user_have_store){
  		$id_store=$this->storeModel->getStoreIdByUserId($id_member);
  		$unread_message_store=$this->db->query("SELECT * FROM chat_room as cr
  																			INNER JOIN chat as c ON c.room_id=cr.id
  																			WHERE cr.store_id='$id_store' AND c.is_read='0' AND type=1")->num_rows();
  	}else{
  		$unread_message_store=0;
  	}

   	$unread_message=$unread_message_user+$unread_message_store;

    return $unread_message;
   }

   public function getProfileName() {
     return $profileName;
   }

   public function getStoreId($userId) {
     $getStoreIdQuery = "SELECT * FROM store WHERE id_user = $userId";
     $getStoreIdResult = $this->db->query($getStoreIdQuery)->result();
     $storeId = "";
     foreach ($getStoreIdResult as $data) {
       $storeId = $data->id;
     }
     return $storeId;
   }

   public function getChatRoomByUserId($userId) {
     $getChatRoomByUserIdQuery = "SELECT  cr.id as id_room,s.id as id, s.store_name as name,
                                  s.store_photo as photo, DATE_FORMAT(max(c.lup), \"%d %b '%y, %h:%i %p\" ) as last_chat,
                                  c.type as sender_type, c.message, uc.username,
                                  (SELECT SUM(IF(is_read=0 AND type=2, 1, 0)) FROM `chat` WHERE room_id=id_room) as total_unread
                                  FROM
                                  chat as c
                                  inner JOIN
                                  chat_room as cr
                                  ON c.room_id=cr.id
                                  inner JOIN store as s
                                  ON cr.store_id = s.id
                                  inner JOIN stil.user_client as uc
                                  ON s.id_user=uc.id
                                  WHERE cr.user_id = '$userId' and c.id in
                                    (SELECT max(sc.id) FROM chat as sc
                                     inner join chat_room as scr on sc.room_id=scr.id
                                     where scr.user_id='$userId' group by scr.id)
                                  group by s.id
								                  ORDER BY c.lup desc
                                  ";
     $getChatRoomResult = $this->db->query($getChatRoomByUserIdQuery)->result();

     $getProfile = "SELECT uc.username, uc.gender, uc.photo as photoUser
                    FROM stil.user_client as uc
                    WHERE id = $userId";
     $getProfileResult = $this->db->query($getProfile)->result();

     $is_have_store=$this->storeModel->checkIsHaveStore($userId);
     if($is_have_store>0){
       $data_store=$this->db->query("SELECT * FROM store where id_user='$userId'")->result_array()[0];
       $photoStoreRes=$data_store['store_photo'];
       $getName=$data_store['store_name'];
     }else{
       $photoStoreRes="";
       $getName="";
     }

     foreach ($getProfileResult as $key) {
       $photoUserRes = $key->photoUser;
       $photoStoreRes = $photoStoreRes;
       $username = $key->username;
       $getName = $getName;
       $gender = $key->gender;
     }
     $photoProfileStore = $this->storeModel->getStorePhoto($username,$photoStoreRes);
     $photoProfileUser = $this->userModel->getPhoto($username, $photoUserRes, $gender);


     if($getChatRoomResult) {
       $photo = array();
       foreach ($getChatRoomResult as $row){
         $photoStore = $this->storeModel->getStorePhoto($row->username,'');
         array_push($photo, $photoStore);
       }

       $storeId=$this->chatModel->getStoreId($userId);
       if($storeId!=''){
          $unread_store=$this->db->query("SELECT * FROM `chat_room` as cr inner join chat as c on cr.id=c.room_id where cr.store_id='$storeId' and c.type=1 and c.is_read=0")->num_rows();
       }else{
         $unread_store=0;
       }


       $response = array(
        'response' => 'SUCCESS',
        'data' => $getChatRoomResult,
        'photo' => $photo,
        'name' => $getName,
        'photoProfileStore' => $photoProfileStore,
        'photoProfileUser' => $photoProfileUser,
        'unread_notif_other'=>$unread_store
       );
     } else {
       $response = array(
        'response' => 'EMPTY ROOM'
       );
     }

     return json_encode($response);
   }

   public function getChatRoomByStoreId($storeId,$userId) {
     $getChatRoomByStoreIdQuery = "SELECT cr.id as id_room,cr.user_id, uc.photo, uc.gender, uc.id,
                                   uc.name, uc.username, c.message, c.type as sender_type,
                                   DATE_FORMAT(max(c.lup), \"%d %b '%y, %h:%i %p\" ) as last_chat,
                                   (SELECT SUM(IF(is_read=0 AND type=1, 1, 0)) FROM `chat` WHERE room_id=id_room) as total_unread
                                   FROM chat_room as cr
                                   INNER JOIN stil.user_client as uc
                                   ON cr.user_id=uc.id
                                   LEFT JOIN chat as c
                                   ON c.room_id=cr.id
                                   WHERE store_id = $storeId and c.id in
                                     (SELECT max(sc.id) FROM chat as sc
                                      inner join chat_room as scr on sc.room_id=scr.id
                                      where scr.store_id='$storeId' group by scr.id)
                                   GROUP BY uc.id
                                   ORDER BY c.lup desc
                                  ";

     $getChatRoomResult = $this->db->query($getChatRoomByStoreIdQuery)->result();

     $unread_user=$this->db->query("SELECT * FROM `chat_room` as cr inner join chat as c on cr.id=c.room_id where cr.user_id='$userId' and c.type=2 and c.is_read=0")->num_rows();

     $getProfile = "SELECT s.store_name as name, uc.username, uc.gender,
                    s.store_photo as photoStore, uc.photo as photoUser
                    FROM store as s
                    INNER JOIN stil.user_client as uc
                    ON s.id_user=uc.id
                    WHERE id_user = $userId";
     $getProfileResult = $this->db->query($getProfile)->result();

     foreach ($getProfileResult as $key) {
       $photoUserRes = $key->photoUser;
       $photoStoreRes = $key->photoStore;
       $username = $key->username;
       $getName = $key->name;
       $gender = $key->gender;
     }
     $photoProfileStore = $this->storeModel->getStorePhoto($username,$photoStoreRes);
     $photoProfileUser = $this->userModel->getPhoto($username, $photoUserRes, $gender);

     if($getChatRoomResult) {
       $photo = array();
       foreach ($getChatRoomResult as $row){
         $photoUser = $this->userModel->getPhoto($row->username, $row->photo, $row->gender);
         array_push($photo, $photoUser);
       }

       $response = array(
        'response' => 'SUCCESS',
        'data' => $getChatRoomResult,
        'photo' => $photo,
        'name' => $getName,
        'photoProfileStore' => $photoProfileStore,
        'photoProfileUser' => $photoProfileUser,
        'unread_notif_other'=>$unread_user
       );
     } else {
       $response = array(
        'response' => 'EMPTY ROOM',
        'name' => $getName,
        'photoProfile' => $photoProfile
       );
     }

     return json_encode($response);
   }

   public function insertNewMessage($payload) {
     $userId = $payload['userId'];
     $storeId = $payload['storeId'];
     $message = $payload['message'];
     $type = $payload['type'];
     $lup = $payload['lup'];

     $checkDuplicateQuery = "SELECT * FROM chat_room WHERE user_id = '$userId'
                             AND store_id = '$storeId'";
     $checkDuplicate = $this->db->query($checkDuplicateQuery)->num_rows();

     // Create room if not duplicate
     if($checkDuplicate == 0 && $userId!=0 && $storeId!=0) {
       $insertChatRoomQuery = "INSERT INTO chat_room (user_id, store_id, lup)
                               VALUES ('$userId', '$storeId', '$lup')";
       $insertChatRoomResult = $this->db->query($insertChatRoomQuery);
       if($insertChatRoomResult) {
         $response = "SUCCESS";
       } else {
         $response = "FAILED";
       }
     }

     // Check if there's a room or successfully created a new room
     if($checkDuplicate > 0 || $response == "SUCCESS") {
       // Check room id
       $checkRoomIdQuery = "SELECT id FROM chat_room WHERE user_id = '$userId' AND store_id = '$storeId'";
       $chatRoomId = $this->db->query($checkRoomIdQuery)->result();
       if($chatRoomId) {
         foreach ($chatRoomId as $row){
           $id = $row->id;
         }
         // Insert chat
         $insertChatQuery = "INSERT INTO chat (room_id, message, type, lup) VALUES ('$id', '$message', '$type', '$lup')";
         $insertChatResult = $this->db->query($insertChatQuery);
         if($insertChatResult) {
           $response = "$id";
         } else {
           $response = "FAILED"; //insert chat
         }
       } else {
         $response = "FAILED"; //get chat room id
       }
     }

     return $response;
   }

   public function getMessageAsUser($payload) {
     $userId = $payload['userId'];
     $storeId = $payload['storeId'];
     $lup = $payload['lup'];



     // Check room id
     $checkRoomIdQuery = "SELECT cr.id, s.store_name as name,
                          s.store_photo as photo, uc.username
                          FROM chat_room as cr
                          INNER JOIN store as s
                          ON cr.store_id=s.id
                          INNER JOIN stil.user_client as uc
                          ON s.id_user=uc.id
                          WHERE user_id = '$userId'
                          AND store_id = '$storeId'";
     $chatRoomProfile = $this->db->query($checkRoomIdQuery)->result();

     if($chatRoomProfile) {
       foreach ($chatRoomProfile as $row){
         $id = $row->id;
         $photoStore = $this->storeModel->getStorePhoto($row->username,$row->photo);
       }
       // Get chat by room id

       $getChatQuery = "SELECT *,DATE_FORMAT(lup, \"%d %b '%y, %h:%i %p\" ) as lups FROM chat WHERE room_id = '$id' ORDER BY lup desc";
       $read_notification=$this->db->query("UPDATE chat set is_read=1 WHERE room_id='$id' AND type=2");
       $getChatResult = $this->db->query($getChatQuery)->result();
       if($getChatResult) {
         $response = array(
          'response' => 'SUCCESS',
          'chatResult' => $getChatResult,
          'profileResult' => $chatRoomProfile,
          'photo' => $photoStore
         );
       } else {
         $response = array(
          'response' => 'EMPTY CHAT',
          'profileResult' => $chatRoomProfile,
          'photo' => $photoStore
         );
       }
     } else {
       $response = "FAILED GET CHAT ROOM ID";
     }
     return json_encode($response);
   }

  public function getMessageAsStore($payload) {
   $userId = $payload['userId'];
   $storeId = $payload['storeId'];
   $lup = $payload['lup'];

   // Check room id
   $checkRoomIdQuery = "SELECT cr.id, uc.name, uc.photo, uc.username, uc.gender
                        FROM chat_room as cr
                        INNER JOIN stil.user_client as uc
                        ON cr.user_id=uc.id
                        WHERE cr.user_id = '$userId'
                        AND cr.store_id = '$storeId'";
   $chatRoomProfile = $this->db->query($checkRoomIdQuery)->result();

   if($chatRoomProfile) {
     foreach ($chatRoomProfile as $row){
       $id = $row->id;
       $photoUser = $this->userModel->getPhoto($row->username, $row->photo, $row->gender);
     }
     // Get chat by room id

     $getChatQuery = "SELECT *,DATE_FORMAT(lup, \"%d %b '%y, %h:%i %p\" ) as lups FROM chat WHERE room_id = '$id' ORDER BY lup desc";
     $read_notification=$this->db->query("UPDATE chat set is_read=1 WHERE room_id='$id' AND type=1");
     $getChatResult = $this->db->query($getChatQuery)->result();
     if($getChatResult) {
       $response = array(
        'response' => 'SUCCESS',
        'chatResult' => $getChatResult,
        'profileResult' => $chatRoomProfile,
        'photo' => $photoUser
       );
     } else {
       $response = array(
        'response' => 'EMPTY CHAT',
        'profileResult' => $chatRoomProfile,
        'photo' => $photoUser
       );
     }
   } else {
     $response = "FAILED GET CHAT ROOM ID";
   }
   return json_encode($response);
  }
}

?>
