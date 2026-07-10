<?php if(count($popNotif['general'])>0){ ?>
<div class="notification-overflow">
  <!--
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#notif_group_general">Umum</a></li>
    <li><a data-toggle="tab" href="#notif_group_promo">Promo</a></li>
  </ul>
-->

  <div class="tab-content">
    <div id="notif_group_general" class="tab-pane fade in active show">
      <div style="margin-left:6px;">
        <h5>
          Notifikasi
        </h5>
      </div>
        <?php $this->load->view('template/popup/notificationTemplate');?>
    </div>
  </div>
</div>
<div class="notification-bar-small-showall-text" onclick="window.location.href = '<?php echo base_url();?>my-account/notification'">Lihat Semua Notifikasi</div>
<?php }else{ ?>
<div class="notification-overflow">
  Belum ada notifikasi
</div>
<?php } ?>
