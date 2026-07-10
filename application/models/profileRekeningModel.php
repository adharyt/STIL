<?php
class profileRekeningModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getRekening($id_user){
    $sql = "SELECT
    ur.*,nb.nama_bank FROM user_client_rekening as ur
    inner join stil.option_bank as nb on ur.id_bank=nb.id
    where ur.id_user='$id_user' and ur.is_deleted=0";

    return $this->db->query($sql)->result_array();
  }

  public function getRekeningByID($id_user,$idRekening){
    $sql = "SELECT
    ur.*,nb.nama_bank FROM user_client_rekening as ur
    inner join stil.option_bank as nb on ur.id_bank=nb.id
    where ur.id_user='$id_user' and ur.is_deleted=0 and ur.id='$idRekening'";

    return $this->db->query($sql);
  }

  public function rekeningAdd($data){

    $id_user=$data['id_user'];
    $nomor_rekening=$data['rekening'];
    $nama_bank=$data['id_bank'];


    $cekDuplicate=$this->db->query("SELECT * FROM user_client_rekening WHERE id_user='$id_user' and is_deleted=0 and rekening='$nomor_rekening' and id_bank='$nama_bank'")->num_rows();

    if($cekDuplicate>0){
      $response="DUPLICATE";
    }else{
        $cek=$this->db->query("SELECT * FROM user_client_rekening WHERE id_user='$id_user' and is_deleted=0 and is_default=1")->num_rows();
        if($cek>0){
          $data['is_default']=0;
        }else{
          $data['is_default']=1;
        }

        $insert =$this->db->insert('user_client_rekening', $data);

        if($insert==TRUE){
          $response="OK";
        }else{
          $response="FAILED";
        }
    }

    return $response;
  }

  public function rekeningEdit($data){

    extract($data);


    $cekDuplicate=$this->db->query("SELECT * FROM user_client_rekening where id_user='$id_user' and is_deleted=0 and rekening='$rekening' and id_bank='$id_bank' and cabang='$cabang' and id!='$id'")->num_rows();

    if($cekDuplicate>0){
      $response="DUPLICATE";
    }else{
        $update =$this->db->query("UPDATE user_client_rekening set rekening='$rekening',id_bank='$id_bank',cabang='$cabang',atas_nama='$atas_nama' where id='$id' and id_user='$id_user'");

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
