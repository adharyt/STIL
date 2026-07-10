<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testmail extends CI_Controller{

    function  __construct(){
        parent::__construct();
    }

    function index(){
      $asd=$this->db->query("SELECT a.username,a.stil_money,b.job from stil.user_client as a inner join cultivathings.stil.user_client as b on a.id=b.id where a.id=4")->result_array();

  		echo $asd[0]['stil_money'];
    }


    function send(){
        $this->load->model('emailModel');
        $msg="test";

        echo $this->emailModel->sysMail('drmp@stil.id','Dear Mr. Dwi (Director of STIL),',$msg);
    }

}
