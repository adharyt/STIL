<div class="card" style="margin-bottom:20px">
	<div class="card-header" style="background-color:#009245">
		<div class="row">
			<div class="col-6" style="color:white">
				Nomor Transaksi: <?php echo $trans['id_sdc'];?>
			</div>
			<div class="col-6 text-right">
				<sup style="color:white"><?php echo $this->timeModel->get_TanggalIndo($trans['invoice_date']).' '.$this->timeModel->get_JamIndo($trans['invoice_date']);?></sup>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-3">
				<font style="color:gray;font-size:12px;">Nama Toko</font><br>
				<a style="cursor:pointer;color:#009245" href="<?php echo base_url();?>s/<?php echo $trans['username'];?>" target="_blank"><?php echo $trans['store_name'];?></a>
			</div>
			<div class="col-9">
				<div class="row">
					<div class="col-6">
						<font style="color:gray;font-size:12px;">Nomor Tagihan</font><br>
						<?php echo $trans['invoice'];?>
					</div>
					<div class="col-6">
						<font style="color:gray;font-size:12px;">Logistik</font><br>
						<?php echo $trans['service_name'];?>
						<small>
							<div><?php echo $this->currencyModel->integerSeparation('.',0,ceil($trans['total_weight']/1000));?>kg (<?php echo $this->currencyModel->integerToCurrency('rupiah',$trans['price']);?>)</div>
							<div><a onClick="getDetailWeight('<?php echo $trans['id'];?>');" style="cursor:pointer;color:#009245">Detail Berat</a></div>
						</small>
					</div>

				</div>
				<div  class="row" style="margin-top:10px">
					<div class="col-6">
						<font style="color:gray;font-size:12px;">Status Pesanan</font><br>
						<?php echo $this->statusModel->status_process_user($trans,$trans)['status_pengiriman'];?>
						<?php echo $this->statusModel->status_process_user($trans,$trans)['buttonAction1'];?>
					</div>
					<div class="col-6">
						<font style="color:gray;font-size:12px;">Jumlah Pembelian</font><br>
						<?php
							$totalbarang=0;
							$totalharga=0;
							foreach($trans['product'] as $product){
								$harga_produk=$this->productModel->cekHargaBarangTerjual($product['product_id'],$product['quantity'])*$product['quantity'];
		            $totalharga+=$harga_produk;
								$totalbarang++;
							}
						?>
						<?php echo $totalbarang;?> barang<br>
						<small>
							<div><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalharga);?></div>
							<div><a onClick="getDetailPrice('<?php echo $trans['id'];?>');" style="cursor:pointer;color:#009245">Rincian Barang</a></div>
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-right">
				<a target="_blank" href="<?php echo base_url();?>my-account/transaction/<?php echo $trans['invoice'];?>">
					<div class="btn btn-success" style="background-color:white;border-color:#009245;color:#099245;cursor:pointer;">Lihat Detail Invoice</div>
				</a>

			</div>
		</div>
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
            <a href="javascript:void(0);" class="btn btn-primary loading" style="background-color:#009245;border-color:#009245">Loading...</a>
        </div>
    </div>
  <?php }else{ ?>
    <div class="col-12 col-lg-12">
        <div class="col-12 text-center">
            <p>You're reaching the first transaction.</p>
        </div>
    </div>
<?php
  }
}
?>
