<style media="screen">
  .notification-container{
    border-radius: 4px;
    padding: 16px;
    background-color: #09924508;
    border: 1px solid #09924547;
  }
</style>
<?php foreach($popNotif['general'] as $notification){ ?>
  <?php switch($notification['tipe']){
      case '1': ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Transaksi baru!</div>
            <div class="notification-bar-small-content-text">Ada pesanan baru nih.. <?php echo $notification['node'];?></div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '2': ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan dari pembeli sudah sampai di tujuan</div>
            <div class="notification-bar-small-content-text">Yuk ingatkan pembeli untuk konfirmasi pesanan <?php echo $notification['node'];?></div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '3': ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pembeli sudah menerima pesanan kamu</div>
            <div class="notification-bar-small-content-text">Pembeli sudah menerima pesanan <?php echo $notification['node'];?></div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '7': ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan sudah diterima</div>
            <div class="notification-bar-small-content-text">Pembeli sudah menerima pesanan</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
        <?php
        break;
        case '8': ?>
          <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
            <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
              <div class="notification-bar-small-title-text">Mendapatkan feedback negatif</div>
              <div class="notification-bar-small-content-text">Dapat 3 feedback negatif karna menolak</div>
              <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
            </div>
          </div>
        <?php
        break;
        case '9':
        ?>
        <?php
            $amount=$this->db->query("SELECT amount FROM store_withdraw
                                       WHERE id='$notification[node]'")->result_array()[0]['amount'];
        ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pencairan dana berhasil</div>
            <div class="notification-bar-small-content-text">Dana sebesar <?php echo $this->currencyModel->integerToCurrency('rupiah',$amount);?> dari Tiket <?php echo $notification['node'];?> telah dikirim ke rekening kamu!</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '21':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Mendapatkan Feedback Negatif</div>
            <div class="notification-bar-small-content-text">Mendapatkan 3 feedback negatif karna tidak memproses pesanan <?php echo $notification['node'];?>.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '22':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Mendapatkan Feedback Negatif</div>
            <div class="notification-bar-small-content-text">Mendapatkan 3 feedback negatif karna tidak mengirim pesanan <?php echo $notification['node'];?>.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '23':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification-store/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Mendapatkan Feedback Negatif</div>
            <div class="notification-bar-small-content-text">Mendapatkan 3 feedback negatif karna tidak input resi valid <?php echo $notification['node'];?>.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      ?>


  <?php } ?>
<?php } ?>
