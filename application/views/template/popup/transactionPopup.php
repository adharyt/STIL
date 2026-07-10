<?php if(count($popTrans['invoiceAct'])>0 || count($popTrans['transAct'])>0 || count($popTrans['lastTrans'])>0 ){ ?>
<div class="notification-overflow">
     <?php if(count($popTrans['invoiceAct'])>0 || count($popTrans['transAct'])>0){ ?>
     <div style="margin-left:6px;">
       <h5>
         Butuh Tindakan
       </h5>
     </div>
     <?php foreach($popTrans['invoiceAct'] as $invoiceItem){ ?>
       <?php if($invoiceItem['payment_method']!=''){ ?>
           <div class="card mt-1" style="background-color:#09924547;cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>checkout-payment/<?php echo $invoiceItem['invoice'];?>/confirmation'">
             <div class="notification-container">
               <div class="notification-bar-small-title-text">Bayar Pesanan</div>
               <div class="notification-bar-small-content-text">Pesanan <?php echo $invoiceItem['invoice'];?> belum dibayar, yuk bayar!</div>
             </div>
           </div>
       <?php }else{ ?>
         <div class="card mt-1" style="background-color:#09924547;cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>checkout-payment/<?php echo $invoiceItem['invoice'];?>'">
           <div class="notification-container">
             <div class="notification-bar-small-title-text">Anda belum memilih metode pembayaran</div>
             <div class="notification-bar-small-content-text">Pesanan <?php echo $invoiceItem['invoice'];?> belum dibayar, yuk pilih!</div>
           </div>
         </div>
       <?php } ?>
     <?php } ?>
     <?php foreach($popTrans['transAct'] as $transItem){ ?>
     <div class="card mt-1"  style="background-color:#09924547;cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>my-account/transaction/<?php echo $transItem['invoice'];?>'">
       <div class="notification-container">
         <div class="notification-bar-small-title-text">Konfirmasi Pesanan</div>
         <div class="notification-bar-small-content-text">Pesanan kamu <?php echo $transItem['id_trans'];?> telah sampai ditujuan. Yuk konfirmasi barang telah diterima dan berikan ulasan</div>
       </div>
     </div>
     <?php } ?>
     <br>
     <?php } ?>
     <?php if(count($popTrans['lastTrans'])>0){ ?>
       <div style="margin-left:6px;">
         <h5>
           Transaksi Terakhir
         </h5>
       </div>
       <?php foreach($popTrans['lastTrans'] as $transItem){ ?>
         <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>my-account/transaction/<?php echo $transItem['invoice'];?>'">
           <div class="notification-container">
             <div class="notification-bar-small-title-text">Transaksi Selesai</div>
             <div class="notification-bar-small-content-text">Transaksi <?php echo $transItem['id_trans'];?> telah sampai ditujuan.</div>
           </div>
         </div>
       <?php } ?>
     <?php } ?>
   </div>
<div id="showAllTransaction" style="display:none;" class="notification-bar-small-showall-text" onclick="window.location.href = '<?php echo base_url();?>my-account/transaction'">Lihat Semua Transaksi</div>
<?php }else{ ?>
  <div class="notification-overflow" style="padding:25px;">
    <center>
      <img src="<?php echo base_url();?>assets/images/icon-img/trans-empty.png" width="175px"><br>
      Belum ada transaksi
    </center>
  </div>
<?php } ?>
