<?php

class currencyModel extends CI_Model{


  function integerToCurrency($currency,$value){

      switch($currency){
        case 'rupiah':
          $value=number_format($value,0,',','.');
          return "Rp ".$value;
          break;
        default:
          return $value;
          break;

      }
    }

}
