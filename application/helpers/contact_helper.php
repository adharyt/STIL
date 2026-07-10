<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function contact($jenis)
{
    switch($jenis){
      case 'telepon':
        $data='+62 87884 044440';
        break;
      case 'email':
        $data='contact@stil.id';
        break;
      case 'alamat':
        $data='K.H. Mas Mansyur No.12 Kav 121 level 2, Karet Tengsin, Tanah Abang, Central of Jakarta 10220, Indonesia';
    }

    return $data;
}
?>
