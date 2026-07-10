
      <!-- Product -->
			<div class="row">
				<div class="col-lg-7">
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header" style="color:white;background-color:#009245">
									Pembayaran melalui <b>Bank Transfer</b>
								</div>
								<div class="card-body">
									<div class="row mb-4">
										<div class="col-12 text-center">
											<h5 style="font-weight:400">Status pembayaran:</h5>
                      <h4 style="margin-bottom:0px">Belum dibayar</h4>
                    </div>
									</div>
									<div class="row mb-4">
										<div class="col-12 text-center">
											<h5 style="font-weight:400">Batas waktu pembayaran:</h5>
                      <h4 style="margin-bottom:0px" id="bataswaktu"><?php echo $trans['summary']['payment_expired'];?></h4>
                      <small>Pembayaran Anda harus diselesaikan sebelum <?php echo $this->timeModel->get_waktuIndo($trans['summary']['payment_expired']);?> atau transaksi Anda akan dibatalkan.</small>
										</div>
									</div>
                  <div class="row mb-4">
										<div class="col-12 text-center">
                      <h5 style="font-weight:400">Jumlah tagihan:</h5>
                      <h4 style="margin-bottom:0px"><?php echo $this->currencyModel->integertoCurrency('rupiah',$trans['summary']['amount']+$trans['summary']['unique_amount']);?></h4>
											<p style="line-height:1.2!important;color:black">
												<small >
													Transfer tepat hingga 3 digit terakhir agar proses verifikasi dapat dilakukan dengan cepat.<br>
													Kode unik transfer sebesar <?php echo $this->currencyModel->integertoCurrency('rupiah',$trans['summary']['unique_amount']);?> akan dikembalikan ke saldo STIL kamu.
												</small>
											</p>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-12 text-center">
                      <h5 style="font-weight:400">Nomor invoice:</h5>
                      <h4><?php echo $trans['summary']['invoice'];?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
			</div>
