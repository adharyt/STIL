<style media="screen">
.notification-container {
  padding: 16px;
  border-radius: 4px;
  background-color: #09924508;
  border: 1px solid #09924547;
}
</style>
<?php if(count($popTrans['transNeedAction'])>0 || count($popTrans['lastTrans'])>0 ){ ?>
<div class="notification-overflow">
     <?php if(count($popTrans['transNeedAction'])>0){ ?>
     <div style="margin-left:6px;">
       <h5>
         Butuh Tindakan Segera
       </h5>
     </div>
     <?php foreach($popTrans['transNeedAction'] as $transItem){ ?>
       <?php switch($transItem['status']){
         case '0':
         ?>
         <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>my-account/transaction/<?php echo $transItem['id_trans'];?>'">
           <div class="notification-container">
             <div class="notification-bar-small-title-text">Segera proses pesanan!</div>
             <div class="notification-bar-small-content-text">Pesanan <?php echo $transItem['id_trans'];?> akan segera expired.</div>
           </div>
         </div>
         <?php
          break;
          case '1':
         ?>
         <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>my-account/transaction/<?php echo $transItem['id_trans'];?>'">
           <div class="notification-container">
             <div class="notification-bar-small-title-text">Segera kirim pesanan!</div>
             <div class="notification-bar-small-content-text">Pesanan <?php echo $transItem['id_trans'];?> akan segera expired.</div>
           </div>
         </div>
         <?php
          break;
          case '2':
         ?>
         <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>my-account/transaction/<?php echo $transItem['id_trans'];?>'">
           <div class="notification-container">
             <div class="notification-bar-small-title-text">Segera input resi pesanan yang valid!</div>
             <div class="notification-bar-small-content-text">Pesanan <?php echo $transItem['id_trans'];?> akan segera expired.</div>
           </div>
         </div>
         <?php
          break;
        }//end switch
         ?>
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
         <?php switch($transItem['status']){
           case '3':
           ?>
           <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>my-account/transaction/<?php echo $transItem['id_trans'];?>'">
             <div class="notification-container">
               <div class="notification-bar-small-title-text">Transaksi berhasil!</div>
               <div class="notification-bar-small-content-text">Pesanan <?php echo $transItem['id_trans'];?> sudah diterima pembeli.</div>
             </div>
           </div>
           <?php
            break;
            case '52':
           ?>
           <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>my-account/transaction/<?php echo $transItem['id_trans'];?>'">
             <div class="notification-container">
               <div class="notification-bar-small-title-text">Transaksi berhasil!</div>
               <div class="notification-bar-small-content-text">Pesanan <?php echo $transItem['id_trans'];?> sudah diambil pembeli.</div>
             </div>
           </div>
           <?php
            break;
          }//end switch
           ?>
       <?php } ?>
     <?php } ?>
   </div>
<div id="showAllTransactionStore" style="display:none;" class="notification-bar-small-showall-text" onclick="window.location.href = '<?php echo base_url();?>my-account/transaction'">Lihat Semua Transaksi</div>
<?php }else{ ?>
<div class="notification-overflow" style="padding:25px;">
  <center>
    <img src="<?php echo base_url();?>assets/images/icon-img/trans-empty.png" width="175px"><br>
    Belum ada transaksi
  </center>
</div>
<?php } ?>
