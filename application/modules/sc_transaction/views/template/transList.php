<div class="card" style="margin-bottom:20px">
  <div class="card-header" style="background-color:#009245">
    <div class="row">
      <div class="col-6" style="color:white">
        Nomor Referensi:  <?php echo $transaction['invoice'].'-'.$transaction['id'];?>
      </div>
      <div class="col-6 text-right">
        <sup style="color:white"><?php echo $this->timeModel->get_waktuIndo($transaction['invoice_date']);?></sup>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-3">
        <font style="color:gray;font-size:12px;">Informasi Akun Pembeli</font><br>
        <?php echo $transaction['name'];?><br>
        <?php echo $transaction['phone'];?><br>
        <button onclick="javascript:startChatFromStore('<?php echo $transaction['id_user'];?>');" style="margin-top:10px;background-color:#FFFFFF;border:2px solid #009245;color:#009245;cursor:pointer;" class="btn btn-secondary btn-xs"><i class="fas fa-comment"></i> Chat Pembeli</button>
        <br>
        <button onclick="javascript:infoPembeli('<?php echo $transaction['id'];?>');" style="margin-top:5px;background-color:#FFFFFF;border:2px solid #009245;color:#009245;cursor:pointer;" class="btn btn-secondary btn-xs"><i class="fas fa-user"></i> Informasi Penerima Barang</button>

      </div>
      <div class="col-9">
        <?php
          $ict=0;
          foreach($transaction['courier'] as $cour){ $ict++; ?>
          <div>
            <div class="row">
              <div class="col-6">
                <font style="color:gray;font-size:12px;">Nomor Transaksi</font><br>
                <?php echo $cour['id_trans'];?>
              </div>
              <div class="col-6">
                <font style="color:gray;font-size:12px;">Kurir</font><br>
                <?php echo $cour['service_name'];?>
                <small>
                  <div><?php echo $this->currencyModel->integerSeparation('.',0,ceil($cour['total_weight']/1000));?>kg (<?php echo $this->currencyModel->integerToCurrency('rupiah',$cour['price']);?>)</div>
                  <div><a onClick="getDetailWeight('<?php echo $cour['id'];?>');" style="cursor:pointer;color:#009245">Detail Berat</a></div>
                </small>
              </div>
            </div>
          <br>
            <div  class="row" style="margin-top:10px">
              <div class="col-6">
                <font style="color:gray;font-size:12px;">Status Pesanan</font><br>
                <?php echo $this->statusModel->status_process_seller($cour,$cour)['status_pengiriman'];?>
                <?php echo $this->statusModel->status_process_seller($cour,$cour)['buttonAction1'];?>
              </div>
            <div class="col-6">
              <font style="color:gray;font-size:12px;">Daftar Barang</font><br>
              <?php foreach($cour['product'] as $product){ ?>
                <a style="color:#009245" href="<?php echo base_url();?>history/transaction/<?php echo $cour['id_trans'];?>/p/<?php echo $product['id'];?>" target="_blank"><?php echo $product['product_name']; ?></a>
                <small><small>x</small><?php echo $product['quantity'];?>
                (<?php echo $this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarangTerjual($product['product_id'],$product['quantity'],TRUE,FALSE)*$product['quantity']));?>)</small>
                <br>
              <?php } ?>
            </div>

            </div>
          </div>
        <?php if(count($transaction['courier'])!=$ict){echo "<hr style='background-color:#eaeaea'>";} ?>
        <?php } ?>
      </div>
    </div>
    <br>
  </div>
</div>

<?php
if($nowData>=$showLimit || $lastPostID==$lastData){
if($totalRowCount > $showLimit && $lastPostID!=$lastData){
?>
<div class="col-12 col-lg-12" id="show_more_main<?php echo $lastPostID;?>">
  <div class="col-12 text-center">
    <a href="javascript:void(0);" id="<?php echo $lastPostID;?>" class="btn btn-primary show_more" style="background-color:#009245;border-color:#009245">Load More</a>
  </div>
  <div class="col-12 text-center">
    <a href="javascript:void(0);" class="btn btn-primary loading" style="display:none;background-color:#009245;border-color:#009245">Loading...</a>
  </div>
</div>
<?php
}else{ ?>
<div class="col-12 col-lg-12">
  <div class="col-12 text-center">
    <p>You're reaching the first transaction.</p>
  </div>
</div>
<?php }
} ?>
