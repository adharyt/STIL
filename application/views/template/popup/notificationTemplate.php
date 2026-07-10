<?php foreach($popNotif['general'] as $notification){ ?>
  <?php switch($notification['tipe']){
      case '1': ?>
      <?php
          $namaProduk=$this->db->query("SELECT p.pr_name FROM product as p inner join cart as c on c.id_product=p.id where c.id='$notification[node]'")->result_array()[0]['pr_name'];
       ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Beli barang ini</div>
            <div class="notification-bar-small-content-text"><?php echo $namaProduk;?> hampir jadi milikmu</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '2': ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Bayar Pesanan Kamu</div>
            <div class="notification-bar-small-content-text">Yuk Bayar invoice <?php echo $notification['node'];?></div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '3':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Selesaikan Pembayaran Kamu</div>
            <div class="notification-bar-small-content-text">Yuk Bayar invoice <?php echo $notification['node'];?> agar pesanan tidak dibatalkan</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '4':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pembayaran Berhasil</div>
            <div class="notification-bar-small-content-text">Invoice <?php echo $notification['node'];?> sudah kamu bayar, tunggu pesanan diproses ya.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '5':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan diproses</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> sedang diproses penjual</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '6':
      ?>
      <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
        <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
          <div class="notification-bar-small-title-text">Pesanan diproses</div>
          <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> sedang dikirim penjual</div>
          <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
        </div>
      </div>
      <?php
      break;
      case '7':
      ?>

        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan sudah sampai</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> sudah sampai tujuan ya</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '8':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan ditolak</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> ditolak, dana dikembalikan ke Saldo STIL.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '9':
      ?>
        <?php
            $amount=$this->db->query("SELECT amount FROM user_withdraw
                                       WHERE id='$notification[node]'")->result_array()[0]['amount'];
        ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pencairan dana berhasil</div>
            <div class="notification-bar-small-content-text">Dana sebesar <?php echo $this->currencyModel->integerToCurrency('rupiah',$amount);?> dari Tiket <?php echo $notification['node'];?> telah dikirim ke rekening kamu!</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '10':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Tagihan kadaluarsa</div>
            <div class="notification-bar-small-content-text">Invoice <?php echo $notification['node'];?> kadaluarsa, pesanan tidak dapat dilanjutkan.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '11':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;"  onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pengembalian kode transfer</div>
            <div class="notification-bar-small-content-text">Pengembalian kode transfer.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '12':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan selesai</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> sudah kamu terima, jangan lupa review</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '21':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan dibatalkan</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> dibatalkan karena penjual tidak memproses pesanan, dana dikembalikan ke Saldo STIL.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '22':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan dibatalkan</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> dibatalkan karena penjual tidak mengirim pesanan, dana dikembalikan ke Saldo STIL.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '23':
      ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan dibatalkan</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $notification['node'];?> dibatalkan karena penjual tidak input resi valid pesanan, dana dikembalikan ke Saldo STIL.</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '51':
      ?>
        <?php
            $data_notification=$this->db->query("SELECT id_invoice,sdc.id_trans FROM sales_detail_trans as sdt
                                       INNER join sales_detail_courier as sdc
                                       ON sdc.id_sales_detail_trans=sdt.id
                                       WHERE sdc.id='$notification[node]'")->result_array()[0];
        ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Pesanan siap</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $data_notification['id_trans'];?> sudah siap diambil</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '52':
      ?>
        <?php
            $data_notification=$this->db->query("SELECT id_invoice,sdc.id_trans FROM sales_detail_trans as sdt
                                       INNER join sales_detail_courier as sdc
                                       ON sdc.id_sales_detail_trans=sdt.id
                                       WHERE sdc.id='$notification[node]'")->result_array()[0];
        ?>
        <div class="card mt-1"  style="cursor:pointer;border:0px solid white;" onclick="window.location.href='<?php echo base_url();?>read-notification/<?php echo $notification['id'];?>'">
          <div class="notification-container" <?php if($notification['lup_clicked']==''){ echo "style='background-color:#09924547'";}?>>
            <div class="notification-bar-small-title-text">Transaksi selesai</div>
            <div class="notification-bar-small-content-text">Transaksi <?php echo $data_notification['id_trans'];?> sudah kamu ambil, review yuk</div>
            <div class="notification-bar-small-timestamp-text"><?php echo $this->timeModel->get_waktuIndo($notification['lup']);?></div>
          </div>
        </div>
      <?php
      break;
      case '7':
      ?>


  <?php } ?>
<?php } ?>
