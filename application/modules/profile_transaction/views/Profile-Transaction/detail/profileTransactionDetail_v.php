<style>
	.img-profile{
		width: 10%;
		height: 10%;
		border-radius: 50%;
		border-color: #009245;
	}
	.circle {
		border-radius: 25px;
	}
	.icon-sack {
		width: 20px;
		height: 20px;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_responsive.css">
<body>
		<div class="col-sm-9" style="margin-top:30px;">
			<div class="row d-flex" style="margin-left:10px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-exchange-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle">
					<h3>Daftar Transaksi</h3>
				</div>
			</div>
			<?php if($trans=='NA'){ ?>
				<div class="card p-4 ml-4 mr-4 mb-5" style="width: 100%">
					<div class="card-body">
						<center>
							<img src="<?php echo base_url();?>assets/images/icon-img/transactions-not-available.png" width="200px">
							<h5>Transaksi tidak ditemukan.</h5>
						</center>
					</div>
				</div>
			<?php }else{ ?>
			<div class="row mt-3">
				<div class="col-md-8">
					<div class="card" style="margin-bottom:20px">
						<div class="card-header" style="background-color:#009245;color:white">
							<div class="row">
								<div class="col-6">
									Detail Transaksi
								</div>
							</div>
						</div>
						<div class="card-body">
							<?php foreach($trans['d_trans'] as $d_trans){ ?>
							<div class="row">
								<div class="col-3">
									<font style="color:gray;font-size:12px;">Nama Toko</font><br>
									<a style="cursor:pointer;color:#009245" href="<?php echo base_url();?>s/<?php echo $d_trans['username'];?>" target="_blank"><?php echo $d_trans['store_name'];?></a>
								</div>
								<div class="col-9">
									<?php foreach($d_trans['courier'] as $cour){ ?>
										<div class="row">
											<div class="col-6">
												<font style="color:gray;font-size:12px;">Nomor Transaksi</font><br>
												<?php echo $cour['id_trans'];?>
											</div>
											<div class="col-6">
												<font style="color:gray;font-size:12px;">Logistik</font><br>
												<?php echo $cour['service_name'];?>
												<small>
													<div><?php echo $this->currencyModel->integerSeparation('.',0,ceil($cour['total_weight']/1000));?>kg (<?php echo $this->currencyModel->integerToCurrency('rupiah',$cour['price']);?>)</div>
													<div><a onClick="getDetailWeight('<?php echo $cour['id'];?>');" style="cursor:pointer;color:#009245">Detail Berat</a></div>
												</small>
											</div>

										</div>
										<br>
									<div class="row">
										<div class="col-12">
											<font style="color:gray;font-size:12px;">Daftar Produk</font><br>
											<?php foreach($cour['product'] as $product){ ?>
												<a style="color:#009245" href="<?php echo base_url();?>history/transaction/<?php echo $cour['id_trans']; ?>/p/<?php echo $product['product_id']; ?>" target="_blank"><?php echo $product['product_name']; ?></a>
												<small><small>x</small><?php echo $product['quantity'];?>
												(<?php echo $this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarangTerjual($product['product_id'],$product['quantity'])*$product['quantity']));?>)</small>
												<br>

											<?php } ?>
										</div>

									</div>

										<br>
										<div class="row">
											<div class="col-12">
													<font style="color:gray;font-size:12px;">Status Pesanan</font><br>
													<?php echo $this->statusModel->status_process_user($trans,$cour)['status_pengiriman'];?>
													<?php echo $this->statusModel->status_process_user($trans,$cour)['buttonAction1'];?>
											</div>


										</div>

									<hr>
									<?php } ?>
								</div>
							</div>
							<font style="color:gray;font-size:12px;">Catatan Untuk Penjual</font>
							<br>
							<?php if($d_trans['notes']==''){echo "Tidak ada catatan untuk penjual ini.";}else{echo $d_trans['notes'];}?>
							<hr>
							<?php } ?>
							<div class="row">
								<div class="col-12">

								</div>
							</div>
						</div>
					</div>


				</div>
				<div class="col-md-4">
					<div class="card" style="margin-bottom:20px">
						<div class="card-header" style="background-color:#009245;color:white">
							<div class="row">
								<div class="col-12">
									Ringkasan Transaksi
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Nomor Invoice</font>
										<br>
											<?php echo $trans['invoice'];?>
										</div>
									</div>

									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Tanggal Transaksi</font>
										<br>
											<?php echo $this->timeModel->get_TanggalIndo($trans['lup']).' '.$this->timeModel->get_JamIndo($trans['lup']);?>
										</div>
									</div>

									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Nama Penerima</font>
										<br>
											<?php echo $trans['d_trans'][0]['user_name'];?>
										</div>
									</div>

									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Nomor Telepon</font>
											<br>
											<?php echo $trans['d_trans'][0]['user_phone'];?>
										</div>
									</div>

									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Alamat Lengkap</font>
										<br>
											<?php echo $trans['d_trans'][0]['location_user_address'];?>
										</div>
									</div>
								<hr style="border 1px solid gray">
									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Total Pembayaran</font>
										<br>
										<?php
										   echo $this->currencyModel->integerToCurrency('rupiah',$this->transactionModel->getAmountPerInvoice($trans['invoice']));
											 if($trans['payment_method']=='bank_transfer'){
												 $unique_amount=$this->transactionModel->getUniqueTransferAmount($trans['invoice']);
												 echo " <sub>+ ".$this->currencyModel->integerToCurrency('rupiah',$unique_amount)." (kode unik)</sub>";
											 }
										 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Channel Pembayaran</font>
										<br>
											<?php echo $this->statusModel->status_metode_pembayaran($trans)['text'];?>
										</div>
									</div>
									<div class="row">
										<div class="col-12" style="margin-bottom:5px;">
											<font style="color:gray;font-size:12px;">Status Pembayaran</font>
										<br>
											<?php echo $this->statusModel->status_payment($trans)['text'];?>
										</div>

									</div>
									<br>
									<?php echo $this->statusModel->status_payment($trans)['button'];?>
								</div>
							</div>
						</div>
					</div>


				</div>


				<!-- Detail Weight Modal -->
		    <div class="modal fade" id="detailWeightModal" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" style="margin-top:100px">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content" id="detailWeightModalContent">

		            </div>
		        </div>
		    </div>

				<!-- Accept Transaction Modal -->
		    <div class="modal fade" id="acceptTransactionModal" role="dialog" aria-hidden="true">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content" id="acceptTransactionModalContent">

		            </div>
		        </div>
		    </div>

			</div>
			<?php } ?>
		</div>
	</div>
</body>
