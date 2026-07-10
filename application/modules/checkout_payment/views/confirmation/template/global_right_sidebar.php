<div class="col-lg-5">
  <div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-header" style="color:white;background-color:#009245">
            Ringkasan Belanja
          </div>
          <div class="card-body" id="summaryCart_temp">
              <?php foreach($trans_detail['d_trans'] as $d_trans){ ?>
                <div class="row">
                  <div class="col-12">
                    <a style="cursor:pointer;color:#009245" href="<?php echo base_url();?>s/<?php echo $d_trans['username'];?>" target="_blank"><h5><i class="fa fa-fw fa-store-alt"></i> <?php echo $d_trans['store_name'];?></h5></a>
                  </div>
                  <div class="col-12">
                    <?php foreach($d_trans['courier'] as $cour){ ?>
                      <div class="row">
                        <div class="col-6" style="padding-left:30px">
                          <sub><?php echo $cour['service_name'];?> <small>(<?php echo $this->currencyModel->integerSeparation('.',0,ceil($cour['total_weight']/1000));?>kg)</small></sub>
                        </div>
                        <div class="col-6 text-right">
                             <sub><?php echo $this->currencyModel->integerToCurrency('rupiah',$cour['price']);?></sub>
                        </div>
                      </div>
                        <?php foreach($cour['product'] as $product){ ?>
                          <div class="row">
                            <div class="col-6" style="padding-left:30px">
                              <a style="color:#009245" href="<?php echo base_url();?>history/transaction/<?php echo $cour['id_trans']; ?>/p/<?php echo $product['product_id']; ?>" target="_blank"><?php echo $product['product_name']; ?></a> <small>(x<?php echo $product['quantity'];?>)</small>
                            </div>
                            <div class="col-6 text-right">
                              <?php echo $this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarangTerjual($product['product_id'],$product['quantity'])*$product['quantity']));?>
                            </div>
                          </div>

                        <?php } ?>


                    <?php } ?>
                  </div>
                </div>
                <hr>
              <?php } ?>
            <div class="row">
              <div class="col-5 text-left">
                Total harga barang:
              </div>
              <div class="col-7 text-right">
                <span id="totalhargabarang"><?php echo $this->currencyModel->integerToCurrency('rupiah',$trans['product_amount']); ?></span><br>
              </div>
            </div>
            <div class="row">
              <div class="col-5 text-left">
                Total biaya logistik:
              </div>
              <div class="col-7 text-right">
                <span id="totalongkir"><?php echo $this->currencyModel->integerToCurrency('rupiah',$trans['delivery_amount']); ?></span><br>
              </div>
            </div>
            <?php if($trans['summary']['payment_method']=='bank_transfer'){
              // kalau method bank transfer maka ubah total harga (ditambah kode unik transfer)
              $trans['total_amount']+=$trans['summary']['unique_amount'];
            ?>
              <div class="row">
                <div class="col-5 text-left">
                  Kode unik transfer:
                </div>
                <div class="col-7 text-right">
                  <span id="kodeunik"><?php echo $this->currencyModel->integerToCurrency('rupiah',$trans['summary']['unique_amount']); ?></span><br>
                </div>
              </div>
            <?php } ?>
            <div class="row">
              <div class="col-5 text-left">
                Total tagihan:
              </div>
              <div class="col-7 text-right">
                <b id="totalbayar"><?php echo $this->currencyModel->integerToCurrency('rupiah',$trans['total_amount']); ?></b><br>
              </div>
            </div>
            <br>
              <div class="row">
                <div class="col-12 text-right">
                  <a href="javascript:void(0);" onClick="select_payment();"><div class="btn btn-md" style="color:white;background-color:#009245">Konfirmasi Pembayaran</div></a>
                </div>
              </div>

          </div>
      </div>
    </div>
  </div>
</div>
