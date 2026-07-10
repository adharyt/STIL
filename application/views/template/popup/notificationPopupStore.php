<?php if(count($popNotif['general'])>0){ ?>
<div class="notification-overflow">
  <div class="tab-content">
    <div id="notif_group_general" class="tab-pane fade in active show">
      <div style="margin-left:6px;">
        <h5>
          Notifikasi
        </h5>
      </div>
      <?php $this->load->view('template/popup/notificationTemplateStore');?>
    </div>
    <!--
    <div id="notif_group_promo" class="tab-pane fade">
      <div class="card mt-1"  style="cursor:pointer;border:0px solid white;">
        <div class="notification-container">
          <div class="notification-bar-small-title-text">Promo</div>
          <div class="notification-bar-small-content-text">Pesanan kamu telah sampai ditujuan. Yuk konfirmasi barang telah diterima dan berikan ulasan</div>
          <div class="notification-bar-small-timestamp-text">20 Oktober 2019 15:15 WIB</div>
        </div>
      </div>
    </div>
  -->
  </div>
</div>
<div class="notification-bar-small-showall-text" onclick="window.location.href = '<?php echo base_url();?>my-store/notification'">Lihat Semua Notifikasi</div>
<?php }else{ ?>
<div class="notification-overflow">
  Tidak ada transaksi
</div>
<?php } ?>
