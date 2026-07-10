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
<body>
		<div class="col-sm-9" style="margin-top:30px;">
			<div class="row d-flex" style="padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-wallet"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle">
					<h3>STIL Money</h3>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-md-12">
					<div class="row">
						<div class="col-12" style="margin-bottom:10px">
							<div class="card">
								<div class="card-header" style="background-color:#009245;color:white">
									<h4>Uang Digital</h4>
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<p><img src="<?php echo base_url();?>assets/images/icon-img/money.png" alt="Icon Cash" class="mr-2 icon-sack">Kredit STIL<br><?php echo $this->currencyModel->integerToCurrency('rupiah',$userMoney);?></p>
										<p onClick="cairkanUang();">Cairkan Uang</p>
									</div>
									<table id="moneyHistory" class="table table-hover table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>Tanggal</th>
												<th>Aksi</th>
												<th>Uang Sebelumnya</th>
												<th>Jumlah</th>
												<th>Uang Sekarang</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($moneyHistory as $history){
													switch($history['tipe']){
														case '1':
															$keterangan="Pencairan dana dari tiket $history[node]";
															$amount_symbol='-';
															break;
														case '2':
															$keterangan="Refund transaksi $history[node]";
															$amount_symbol='+';
															break;
													}
												?>
											<tr>
												<td>
													<?php echo $history['lup'];?>
												</td>
												<td>
													<?php echo $keterangan;?>
												</td>
												<td>
													<?php echo $history['amount_before'];?>
												</td>
												<td>
													<?php echo $amount_symbol.$history['amount_transfer'];?>
												</td>
												<td>
													<?php echo $history['amount_after'];?>
												</td>
											</tr>
											<?php } ?>
										</tbody>

						    </table>
								<br>
								<table id="pendingWD" class="table table-hover table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Amount</th>
											<th>Rekening</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($pendingWD as $history){ ?>
										<tr>
											<td>
												<?php echo $history['lup'];?>
											</td>
											<td>
												<?php echo $history['amount'];?>
											</td>
											<td>
												<?php echo $history['user_bank'].' '.$history['user_rekening'].' a.n. '.$history['user_pemilik_rekening'];?>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="pencairanModal"  role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header new-address-header">
						<h5 class="modal-title new-address-title" id="newRekeningLabel">Pencairan STIL Wallet</h5>
						<button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
						<span aria-hidden="true" class="fas fa-times-circle"></span>
						</button>
				</div>
				<div class="modal-body p-2 new-address-body">
					<div class="row">
							<fieldset class="form-group col-md-12">
									<label for="addressName-label">Jumlah Pencairan</label>
									<input type="text" class="form-control text-dark i-address-name" id="wd_amount" >
							</fieldset>
					</div>
						<div class="row">
								<fieldset class="form-group col-md-12">
										<label for="addressName-label">Nama Bank</label>
										<select name="search_rekening" id="wd_user_bank_id" class="form-control dropdown-select-style" style="margin-left:0px">
											<?php foreach($memberRekening as $rekening){ ?>
												<option <?php if($rekening['is_default']==1){echo "selected";}?> value="<?php echo $rekening['id'];?>"><?php echo $rekening['nama_bank'].' '.$rekening['rekening'].' a.n. '.$rekening['atas_nama'];?></option>
											<?php } ?>

										</select>
								</fieldset>
						</div>



				</div>
				<div class="modal-footer">
						<button type="button" class="btn btn-primary" onClick="requestWD();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Withdraw</button>
				</div>
				</div>
		</div>
		</div>
	</div>
</body>
