<?php

class statusModel extends CI_Model{

  function getStatusInfo($var,$out_array=FALSE){

    switch($var){
      case 'TRANS_PENDING':
         if($out_array!=TRUE){
           $data="0";
         }else{
           $data=array('0');
         }
         break;
      case 'TRANS_PROCESS':
          if($out_array!=TRUE){
            $data="1";
          }else{
            $data=array('1');
          }
         break;
       case 'TRANS_SENT':
           if($out_array!=TRUE){
             $data="2";
           }else{
             $data=array('2');
           }
          break;
      case 'TRANS_READY_PICK':
          if($out_array!=TRUE){
            $data="4,51";
          }else{
            $data=array('4,51');
          }
         break;
      case 'TRANS_ONGOING':
          if($out_array!=TRUE){
            $data="0,1,2,4,51";
          }else{
            $data=array('0,1,2,4,51');
          }
         break;
      case 'TRANS_SUCCESS':
          if($out_array!=TRUE){
            $data="3,52";
          }else{
            $data=array('3,52');
          }
         break;
      case 'TRANS_FAILED':
          if($out_array!=TRUE){
            $data="9,11,12,13";
          }else{
            $data=array('9,11,12,13');
          }
         break;
      default:
          if($out_array!=TRUE){
            $data="";
          }else{
            $data=array('');
          }
         break;
    }

    return $data;
  }

  function status_metode_pembayaran($trans){
    if($trans['payment_method']!=''){
      switch($trans['payment_method']){
        case 'bank_transfer':
            $data['text']="Bank Transfer";
            break;
        case 'virtual_account':
            $data['text']="Virtual Account";
            break;
        default:
            $data['text']="Belum dipilih";
      }
    }else{
      $data['text']="Belum dipilih";
    }

    return $data;
  }

    function status_payment($trans){
      $button_pilih_metode="<a href='".base_url()."checkout-payment/$trans[invoice]'><div class='btn btn-success' style='background-color:#099245;border-color:#009245;cursor:pointer;'>Pilih Metode Pembayaran</div></a>";
      $button_cara_pembayaran="<a href='".base_url()."checkout-payment/$trans[invoice]/confirmation'><div class='btn btn-success' style='background-color:#099245;border-color:#009245;cursor:pointer;'>Lihat Cara Pembayaran</div></a>";
      $button_null="";

      if($trans['payment_method']!='' || $trans['payment_status']==2){
        switch($trans['payment_status']){
          case 0:
              $data['text']="Belum dibayar";
              $data['button']=$button_cara_pembayaran;
              break;
          case 1:
              $data['text']="Sudah dibayar";
              $data['button']=$button_null;
              break;
          case 2:
              $data['text']="Pembayaran kadaluarsa";
              $data['button']=$button_null;
              break;
          case 3:
              $data['text']="Direfund sebagian";
              $data['button']=$button_null;
          case 4:
              $data['text']="Expired";
              $data['button']=$button_null;
          default:
              $data['text']="Belum dibayar";
              $data['button']=$button_cara_pembayaran;
        }
      }else{
        $data['text']="Belum dibayar";
        $data['button']=$button_pilih_metode;
      }

      return $data;
    }

    function status_process_user($trans,$cour){
      $data['buttonAction1']='';
      if($trans['payment_method']!='' && $trans['payment_status']==1){
          switch($cour['trans_status']){
            default:
              $data['status_pengiriman']="";
              break;
            case '0':
              if($cour['cour_id']==1){
                $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
                $data['status_pengiriman'].="<br><small>Menunggu pesanan diproses oleh penjual</small>";
              }else{
                $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
                $data['status_pengiriman'].="<br><small>Menunggu pesanan diproses oleh penjual</small>";
              }
              break;
            case '1':
              if($cour['cour_id']==1){
                $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Sedang diproses'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
                $data['status_pengiriman'].="<br><small>Pesanan sedang diproses oleh penjual</small>";
              }else{
                $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Sedang diproses'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
                $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
                $data['status_pengiriman'].="<br><small>Pesanan sedang diproses oleh penjual</small>";
              }
              break;
            case '2':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-e.png' width='30' title='Sedang dikirim'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-d.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
              $data['status_pengiriman'].="<br><small>Pesanan sedang dikirim menggunakan kurir <b>".$cour['service_name']."</b></small> ";
              if($cour['resi']!=''){
                $data['status_pengiriman'].='<small>dengan <b>Nomor Resi: '.$cour['resi'].'</b></small>';
              }else{
                $data['status_pengiriman'].='<i><small>(nomor Resi belum diinput)</i></small>';
              }
              break;
            case '4':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-e.png' width='30' title='Dikirim'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-e.png' width='30' title='Diterima'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30' title='Selesai'>";
              $data['status_pengiriman'].="<br><small>Pesanan sudah sampai di tujuan</small> ";

              $data['buttonAction1']="<br><div onClick='terimaPesanan(".$cour['id'].")' class='btn btn-success' style='background-color:#099245;border-color:#009245;cursor:pointer;'>Terima Barang</div>";
              break;
            case '3':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-e.png' width='30' title='Dikirim'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-e.png' width='30' title='Diterima'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-e.png' width='30' title='Selesai'>";
              $data['status_pengiriman'].="<br><small>Pesanan diterima, transaksi selesai.</small> ";
              $data['buttonAction1']="<br><a href='".base_url()."my-account/transaction/feedback/$cour[id]/product'><div class='btn btn-success' style='background-color:#099245;border-color:#009245;cursor:pointer;'>Ulasan Produk</div></a>";
              break;
            case '9':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/09-e.png' width='30' title='Pesanan ditolak oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/11-e.png' width='30' title='Uang dikembalikan ke STIL Wallet'>";
              $data['status_pengiriman'].="<br><small>Pesanan ditolak oleh penjual dan uang kamu sudah dikembalikan ke STIL Wallet";
              if($cour['seller_notes']!=''){
                $data['status_pengiriman'].='. Alasan penolakan:<i>'.$cour['seller_notes'].'</i>';
              }
              $data['status_pengiriman'].="</small>";
              break;
            case '11':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/09-e.png' width='30' title='Pesanan idak diproses oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/11-e.png' width='30' title='Uang dikembalikan ke STIL Wallet'>";
              $data['status_pengiriman'].="<br><small>Pesanan tidak diproses oleh penjual</small> ";
              break;
            case '12':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/21-e.png' width='30' title='Pesanan tidak dikirim oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/11-e.png' width='30' title='Uang dikembalikan ke STIL Wallet'>";
              $data['status_pengiriman'].="<br><small>Pesanan tidak dikirim oleh penjual</small> ";
              break;
            case '13':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/21-e.png' width='30' title='Pesanan tidak dikirim oleh penjual'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/11-e.png' width='30' title='Uang dikembalikan ke STIL Wallet'>";
              $data['status_pengiriman'].="<br><small>Pesanan tidak dikirim oleh penjual (penjual tidak memasukan resi yang valid sampai batas waktu yang telah ditentukan)</small> ";
              break;
            case '51':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan sedang diproses'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-e.png' width='30' title='Pesanan siap diambil'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-d.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
              $data['status_pengiriman'].="<br><small>Pesanan siap diambil, beritahu alamat email kamu <b>".$this->session->userdata('email')."</b> dan kode pengambilan <b>".$cour['resi']."</b> kepada penjual saat pengambilan barang ya!</small> ";
              break;
            case '52':
              $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan sedang diproses'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-e.png' width='30' title='Pesanan siap diambil'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-e.png' width='30'  title='Pesanan sudah diambil'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
              $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-e.png' width='30'  title='Selesai'>";
              $data['status_pengiriman'].="<br><small>Pesanan sudah diambil, transaksi selesai.</small> ";
              
              $data['buttonAction1']="<br><a href='".base_url()."my-account/transaction/feedback/$cour[id]/product'><div class='btn btn-success' style='background-color:#099245;border-color:#009245;cursor:pointer;'>Ulasan Produk</div></a>";
              break;
            }
      }else if($trans['status']==2){
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/00-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/09-e.png' width='30'>";
          $data['status_pengiriman'].="<br><small>Pembayaran kadaluarsa</small>";
      }else{
        if($cour['cour_id']==1){
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-d.png' width='30' title='Menunggu pembayaran'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
          $data['status_pengiriman'].="<br><small>Menunggu pembayaran</small>";
        }else{
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-d.png' width='30' title='Menunggu pembayaran'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
          $data['status_pengiriman'].="<br><small>Menunggu pembayaran</small>";
        }
      }

      return $data;
    }

    function status_process_seller($trans,$cour){
      $data['buttonAction1']='';
      switch($cour['trans_status']){
        default:
          $data['status_pengiriman']="";
          break;
        case '0':
          if($cour['cour_id']==1){
            $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
            $data['status_pengiriman'].="<br><small>Pesanan menunggu diproses</small>";
          }else{
            $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
            $data['status_pengiriman'].="<br><small>Pesanan menunggu diproses</small>";
          }
          $data['buttonAction1']="<div class='row'>
                                    <div class='col-6 pr-1'>
                                      <button class='btn' style='width:100%;cursor:pointer;background-color:#969696;color:white' onClick='declineTransaction(`$cour[id]`);'>Tolak</button>
                                    </div>
                                    <div class='col-6 pl-1'>
                                      <button class='btn' style='width:100%;cursor:pointer;background-color:#009245;color:white' onClick='acceptTransaction(`$cour[id]`);'>Proses</button>
                                    </div>
                                  </div>";
          break;
        case '1':
          if($cour['cour_id']==1){
            $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Sedang diproses'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
            $data['status_pengiriman'].="<br><small>Pesanan sedang dalam proses</small>";

            $data['buttonAction1']="<div class='row'>
                                      <div class='col-6 pr-1'>
                                        <button class='btn' style='width:100%;cursor:pointer;background-color:#009245;color:white' onClick='readyAmbilSendiri(`$cour[id]`);'>Selesai Proses</button>
                                      </div>
                                      <div class='col-6 pl-1'>
                                        &nbsp;
                                      </div>
                                    </div>";
          }else{
            $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Sedang diproses'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
            $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
            $data['status_pengiriman'].="<br><small>Pesanan sedang dalam proses</small>";

            $data['buttonAction1']="<div class='row'>
                                      <div class='col-9 pr-1'>
                                        <button class='btn' style='width:100%;cursor:pointer;background-color:#009245;color:white' onClick='kirimTransaction(`$cour[id]`);'>Selesai proses & kirim Barang</button>
                                      </div>
                                      <div class='col-3 pl-1'>
                                        &nbsp;
                                      </div>
                                    </div>";
          }

          break;
        case '2':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-e.png' width='30' title='Sedang dikirim'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
          $data['status_pengiriman'].="<br><small>Pesanan sedang dikirim menggunakan kurir <b>".$cour['service_name']."</b></small> ";
          if($cour['resi']!=''){
            $data['status_pengiriman'].='<small>dengan <b>Nomor Resi: '.$cour['resi'].'</b></small>';
          }else{
            $data['status_pengiriman'].='<i><small>(nomor Resi belum diinput)</i></small>';
          }
          $data['buttonAction1']="<div class='row'>
                                    <div class='col-7 pr-1'>
                                      <button class='btn' style='width:100%;cursor:pointer;background-color:#009245;color:white' onClick='updateResi(`$cour[id]`);'>Update Nomor Resi</button>
                                    </div>
                                    <div class='col-5 pl-1'>
                                      &nbsp;
                                    </div>
                                  </div>";
          break;
        case '4':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-e.png' width='30' title='Dikirim'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-e.png' width='30' title='Diterima'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30' title='Selesai'>";
          $data['status_pengiriman'].="<br><small>Pesanan sudah sampai di tujuan</small> ";
          break;
        case '3':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/03-e.png' width='30' title='Dikirim'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/04-e.png' width='30' title='Diterima'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-e.png' width='30' title='Selesai'>";
          $data['status_pengiriman'].="<br><small>Pesanan sudah diterima pembeli, transaksi selesai.</small> ";
          break;
        case '9':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/09-e.png' width='30' title='Pesanan ditolak'>";
          $data['status_pengiriman'].="<br><small>Pesanan kamu tolak";
          if($cour['seller_notes']!=''){
            $data['status_pengiriman'].='. Alasan penolakan:<i>'.$cour['seller_notes'].'</i>';
          }
          $data['status_pengiriman'].="</small>";
          break;
        case '11':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/09-e.png' width='30' title='Pesanan tidak diproses'>";
          $data['status_pengiriman'].="<br><small>Pesanan dibatalkan karena kamu tidak memproses pesanan</small> ";
          break;
        case '12':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/21-e.png' width='30' title='Pesanan tidak dikirim'>";
          $data['status_pengiriman'].="<br><small>Pesanan dibatalkan karena kamu tidak mengirim pesanan</small> ";
          break;
        case '13':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan diproses'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/21-e.png' width='30' title='Pesanan tidak dikirim'>";
          $data['status_pengiriman'].="<br><small>Pesanan dibatalkan karena kamu tidak memasukan resi yang valid sampai batas waktu yang telah ditentukan</small> ";
          break;
        case '51':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan sedang diproses'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-e.png' width='30' title='Pesanan siap diambil'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-d.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-d.png' width='30'>";
          $data['status_pengiriman'].="<br><small>Pesanan dari pembeli siap diambil</small> ";
          $data['buttonAction1']="<div class='row'>
                                    <div class='col-7 pr-1'>
                                      <button class='btn' style='width:100%;cursor:pointer;background-color:#009245;color:white' onClick='pengambilanBarang(`$cour[id]`);'>Pengambilan Barang</button>
                                    </div>
                                    <div class='col-5 pl-1'>
                                      &nbsp;
                                    </div>
                                  </div>";
          break;
        case '52':
          $data['status_pengiriman']="<img src='".base_url()."assets/images/process-img/order_normal/01-e.png' width='30' title='Dibayar'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/02-e.png' width='30' title='Pesanan sedang diproses'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/06-e.png' width='30' title='Pesanan siap diambil'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/31-e.png' width='30'  title='Pesanan sudah diambil'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/arrow-e.png' width='30'>";
          $data['status_pengiriman'].="<img src='".base_url()."assets/images/process-img/order_normal/05-e.png' width='30'  title='Selesai'>";
          $data['status_pengiriman'].="<br><small>Pesanan pembeli sudah diambil, transaksi selesai.</small> ";
          break;
        break;
      }

      return $data;
    }

    function status_delivery($id){
      switch($id){
        case 0:
            $text="Belum dikirim";
            break;
        case 1:
            $text="Sedang dikirim";
            break;
        case 9:
            $text="Sudah sampai";
      }

      return $text;
    }

}
