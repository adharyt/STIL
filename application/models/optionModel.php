<?php

class optionModel extends CI_Model{


  function get_lastEdu(){
      $sql = "SELECT id,nama FROM option_lastedu where is_deleted=0 order by id asc";
      return $this->db->query($sql)->result_array();
    }

}
