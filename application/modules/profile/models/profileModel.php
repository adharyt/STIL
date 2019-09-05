<?php
class profileModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getProfile($id_user){
    $sql = "SELECT
    u.username,
    u.name,
    u.gender,
    u.birthdate,
    u.marital,
    u.last_education,
    u.email,
    u.email_status,
    u.phone,
    u.phone_status,
    u.ktp_no,
    u.ktp_status,
    u.lup
    FROM user_client as u
    where u.id='$id_user'
    limit 1";

    return $this->db->query($sql)->result_array()[0];
  }

  public function editProfile($data){

    $id_user=$data['id_user'];
    $name=$data['name'];
    $birthdate=$data['birthdate'];
    $gender=$data['gender'];
    $education=$data['last_education'];
    $ktp_no=$data['ktp_no'];
    $phone=$data['phone'];

    $update = "UPDATE user_client SET
    name='$name',
    birthdate='$birthdate',
    gender='$gender',
    last_education='$education',
    ktp_no='$ktp_no',
    phone='$phone'
    where id='$id_user'";

    if($this->db->query($update)==TRUE){
      $this->session->set_userdata('name',$name);
      $this->session->set_userdata('gender',$gender);
      $this->session->set_userdata('phone',$phone);
      $response="OK";
    }else{
      $response="FAILED";
    }

    return $response;
  }


  public function getAddress($id_user){
    $sql = "SELECT
    * FROM user_client_address as ua
    where ua.id_user='$id_user' and ua.is_deleted=0";

    return $this->db->query($sql)->result_array();
  }

  public function getAddressByID($id_user,$idAddress){
    $sql = "SELECT
    ua.*,z.nama FROM user_client_address as ua inner join zone_id as z on z.kode_wilayah=ua.subcity
    where ua.id_user='$id_user' and ua.id='$idAddress' and ua.is_deleted=0";

    return $this->db->query($sql);
  }

  public function addressAdd($data){

    $id_user=$data['id_user'];
    $alias=$data['alias'];


    $cekDuplicate=$this->db->query("SELECT * FROM user_client_address where id_user='$id_user' and is_deleted=0 and alias='$alias'")->num_rows();

    if($cekDuplicate>0){
      $response="DUPLICATE";
    }else{
        $cek=$this->db->query("SELECT * FROM user_client_address where id_user='$id_user' and is_deleted=0 and is_default=1")->num_rows();
        if($cek>0){
          $data['is_default']=0;
        }else{
          $data['is_default']=1;
        }

        $insert =$this->db->insert('user_client_address', $data);

        if($insert==TRUE){
          $response="OK";
        }else{
          $response="FAILED";
        }
    }

    return $response;
  }

  public function addressEdit($data){

    extract($data);


    $cekDuplicate=$this->db->query("SELECT * FROM user_client_address where id_user='$id_user' and is_deleted=0 and alias='$alias' and id!='$id'")->num_rows();

    if($cekDuplicate>0){
      $response="DUPLICATE";
    }else{
        $update =$this->db->query("UPDATE user_client_address set alias='$alias',address='$address',postalcode='$postalcode',subcity='$subcity',phone='$phone',receiver='$receiver' where id='$id' and id_user='$id_user'");

        if($update==TRUE){
          $response="OK";
        }else{
          $response="FAILED";
        }
    }

    return $response;
  }


}

?>
