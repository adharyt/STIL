<?php
class paymentModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }


  public function getListBankTransfer($app=''){
    if($app==''){
      $query_app='';
    }else{
      $query_app="and active_at like '%,$app,%'";
    }

    $sql = "SELECT
            id,bank,bank_singkatan,image,account_number,account_name,account_branch
            FROM stil.option_rekening
            WHERE visibility=1 and deleted_at='' $query_app
            order by urutan asc,id asc";

    return $this->db->query($sql)->result_array();
  }


}

?>
