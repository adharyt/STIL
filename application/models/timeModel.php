<?php

class timeModel extends CI_Model{


  function get_TanggalIndo($date){
      $date_temp=strtotime($date);
      $date_month=date('m',$date_temp);

      switch($date_month){
        case '01':
          $date_month_id="Januari";
          break;
        case '02':
          $date_month_id="Februari";
          break;
        case '03':
          $date_month_id="Maret";
          break;
        case '04':
          $date_month_id="April";
          break;
        case '05':
          $date_month_id="Mei";
          break;
        case '06':
          $date_month_id="Juni";
          break;
        case '07':
          $date_month_id="Juli";
          break;
        case '08':
          $date_month_id="Agustus";
          break;
        case '09':
          $date_month_id="September";
          break;
        case '10':
          $date_month_id="Oktober";
          break;
        case '11':
          $date_month_id="November";
          break;
        case '12':
          $date_month_id="Desember";
          break;
      }

      return date('j',$date_temp).' '.$date_month_id.' '.date('Y',$date_temp);
    }

    function get_JamIndo($date){
        $date_temp=strtotime($date);
        $jam=date('H:i',$date_temp);
        return $jam.' WIB';
      }

      function get_waktuIndo($date){
        $tanggal=$this->get_TanggalIndo($date);
        $jam=$this->get_JamIndo($date);

        return $tanggal.' '.$jam;
      }

}
