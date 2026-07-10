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

	.input-group {
	    position: relative;
	    display: -ms-flexbox;
	    display: flex;
	    -ms-flex-wrap: wrap;
	    flex-wrap: wrap;
	    -ms-flex-align: stretch;
	    align-items: stretch;
	    width: 100%;
	}

.input-group-prepend {
  margin-right: -1px;
	display: flex;
	display: -ms-flexbox;
}
.input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle), .input-group>.input-group-append:last-child>.input-group-text:not(:last-child), .input-group>.input-group-append:not(:last-child)>.btn, .input-group>.input-group-append:not(:last-child)>.input-group-text, .input-group>.input-group-prepend>.btn, .input-group>.input-group-prepend>.input-group-text {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
.input-group-text {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding: .375rem .75rem;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: .25rem;
}
</style>

<body>
		<div class="col-sm-9" style="margin-top:30px;">
			<div class="row d-flex" style="margin-left:10px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-wallet"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle">
					<h3>Saldo Transaksi STIL</h3>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-md-12">
					<div class="row">
						<div class="col-12" style="margin-bottom:10px">
							<div class="card">
								<div class="card-header" style="background-color:#009245;color:white">
									<h4>Cashflow & Log Pencairan Saldo</h4>
								</div>
								<div class="card-body">
									<div class="text-center">
										<div class="row" style="margin-top:30px;">
											<div class="col-12">
												<h1><font style="padding-left:5px;padding-right:5px;color: #796f6f;border: 2px solid #796f6f;border-radius: 10px;">Sisa Saldo: <?php echo $this->currencyModel->integerToCurrency('rupiah',$userMoney['current']-$userMoney['requested']);?></font></h1>
											</div>
										</div>
										<?php if(count($pendingWD)>0){ ?>
										<div class="row">
											<div class="col text-center">
												<small>Anda memiliki uang sebanyak <?php echo $this->currencyModel->integerToCurrency('rupiah',$userMoney['requested']);?> yang sedang dalam proses pencairan</small>
											</div>
										</div>
										<?php } ?>
										<button onClick="cairkanUang();" class="btn btn-success" style="margin-top:10px;cursor:pointer;background-color:#009245">Cairkan Uang</button>
									</div>
									<div class="col-lg-12">
										<ul class="nav nav-tabs md-tabs  b-none" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" data-toggle="tab" href="#historyTabs" role="tab">Cashflow</a>
												<div class="slide"></div>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#pendingTabs" role="tab">Pencairan (Pending)</a>
												<div class="slide"></div>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#wdHistoryTabs" role="tab">Pencairan (History)</a>
												<div class="slide"></div>
											</li>
										</ul>
										<div class="tab-content -content card-block" style="width:100%;padding-left:20px;padding-right:20px;;margin-top:10px">
											<div class="tab-pane active" id="historyTabs" role="tabpanel">
												<table id="moneyHistory" class="table table-hover table-bordered" style="width:100%">
													<thead>
														<tr style="display:none;">
															<th>#</th>
															<th>Keterangan</th>
															<th align="right">Saldo</th>
														</tr>
													</thead>
													<tbody>
														<?php
																$i=0;
																foreach($moneyHistory as $history){
																$i++;
																switch($history['tipe']){
																	case '1':
																		$keterangan="Pencairan dana dari tiket $history[node]";
																		$amount_symbol='<font color="#a8453e"><small><i class="fas fa-minus"></i></small> ';
																		break;
																	case '2':
																		$keterangan="Refund transaksi $history[node]";
																		$amount_symbol='<font color="green"><small><i class="fas fa-plus"></i></small> ';
																		break;
																	case '11':
																		$no_invoice=$this->db->query("SELECT s.invoice FROM stil_marketplace.sales as s
																																	INNER JOIN payment_bank_transfer as pbt
																																	ON s.id=pbt.id_sales
																																	WHERE pbt.id=$history[node]
																		                             ")->result_array()[0]['invoice'];
																		$keterangan="Pengembalian dana kode transfer invoice $no_invoice";
																		$amount_symbol='<font color="green"><small><i class="fas fa-plus"></i></small> ';
																		break;
																	case '21':
																		$keterangan="Refund transaksi $history[node]";
																		$amount_symbol='<font color="green"><small><i class="fas fa-plus"></i></small> ';
																		break;
																}
															?>
														<tr>
															<td style="display:none">
																<?php echo $i;?>
															</td>
															<td style="border-right:none">
																<?php echo $keterangan;?>
																<br>
																<small><?php echo $this->timeModel->get_waktuIndo($history['lup']);?></small>
															</td>
															<td align="right">
																<?php echo $amount_symbol.$this->currencyModel->integerToCurrency('rupiah',$history['amount_transfer']);?></font><br>
																<small <?php if($i==1){echo "style='color: #796f6f;border: 1px solid #796f6f;border-radius: 10px;padding:5px;'";}?>>Saldo akhir: <?php echo $this->currencyModel->integerToCurrency('rupiah',$history['amount_after']);?></small>
															</td>
														</tr>
														<?php } ?>
													</tbody>

									    </table>
											</div>
											<div class="tab-pane" id="pendingTabs" role="tabpanel">
												<table id="pendingWD" class="table table-hover table-bordered" style="width:100%">
													<thead>
														<tr>
															<th style="display:none">#</th>
															<th>ID Tiket</th>
															<th>Tanggal Permintaan</th>
															<th>Nominal Pencairan</th>
															<th>Rekening Tujuan</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$i=0;
															foreach($pendingWD as $history){
																$i++;
														?>
														<tr>
															<td style="display:none">
																<?php echo $i;?>
															</td>
															<td>
																<?php echo $history['id'];?>
															</td>
															<td>
																<?php echo $this->timeModel->get_waktuIndo($history['lup']);?>
															</td>
															<td>
																<?php echo $this->currencyModel->integerToCurrency('rupiah',$history['amount']);?>
															</td>
															<td>
																<table style="border:none">
																	<tr style="margin:0px;padding:0px;">
																		<td style="border:none;padding:0px;" valign="top">Nama Bank</td>
																		<td style="border:none;padding:0px;padding-left:3px;" valign="top">:</td>
																		<td style="border:none;padding:0px;padding-left:10px;" valign="top"><?php echo $history['user_bank'];?><br><?php echo $history['user_cabang_bank'];?></td>
																	</tr>
																	<tr style="margin:0px;padding:0px;">
																		<td style="border:none;padding:0px;">Nomor Rekening</td>
																		<td style="border:none;padding:0px;padding-left:3px;">:</td>
																		<td style="border:none;padding:0px;padding-left:10px;"><?php echo $history['user_rekening'];?></td>
																	</tr>
																	<tr style="margin:0px;padding:0px;">
																		<td style="border:none;padding:0px;">Nama Pemilik Rekening</td>
																		<td style="border:none;padding:0px;padding-left:3px;">:</td>
																		<td style="border:none;padding:0px;padding-left:10px;"><?php echo $history['user_pemilik_rekening'];?></td>
																	</tr>
																</table>
															</td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
											<div class="tab-pane" id="wdHistoryTabs" role="tabpanel">
												<table id="historyWD" class="table table-hover table-bordered" style="width:100%">
													<thead>
														<tr>
															<th style="display:none">#</th>
															<th>ID Tiket</th>
															<th>Tanggal Permintaan</th>
															<th>Nominal Pencairan</th>
															<th>Rekening Tujuan</th>
															<th>Waktu Transfer</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$i=0;
															foreach($historyWD as $history){
																$i++;
														?>
														<tr>
															<td style="display:none">
																<?php echo $i;?>
															</td>
															<td>
																<?php echo $history['id'];?>
															</td>
															<td>
																<?php echo $this->timeModel->get_waktuIndo($history['lup']);?>
															</td>
															<td>
																<?php echo $this->currencyModel->integerToCurrency('rupiah',$history['amount']);?>
															</td>
															<td>
																<table style="border:none">
																	<tr style="margin:0px;padding:0px;">
																		<td style="border:none;padding:0px;" valign="top">Nama Bank</td>
																		<td style="border:none;padding:0px;padding-left:3px;" valign="top">:</td>
																		<td style="border:none;padding:0px;padding-left:10px;" valign="top"><?php echo $history['user_bank'];?><br><?php echo $history['user_cabang_bank'];?></td>
																	</tr>
																	<tr style="margin:0px;padding:0px;">
																		<td style="border:none;padding:0px;">Nomor Rekening</td>
																		<td style="border:none;padding:0px;padding-left:3px;">:</td>
																		<td style="border:none;padding:0px;padding-left:10px;"><?php echo $history['user_rekening'];?></td>
																	</tr>
																	<tr style="margin:0px;padding:0px;">
																		<td style="border:none;padding:0px;">Nama Pemilik Rekening</td>
																		<td style="border:none;padding:0px;padding-left:3px;">:</td>
																		<td style="border:none;padding:0px;padding-left:10px;"><?php echo $history['user_pemilik_rekening'];?></td>
																	</tr>
																</table>
															</td>
															<td>
																<?php echo $this->timeModel->get_waktuIndo($history['admin_waktu_transfer']);?>
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
				</div>
			</div>
		</div>

		<div class="modal fade" id="pencairanModal"  role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true" style="margin-top:50px">
		<div class="modal-dialog modal-lg" role="document" style="width:1000px">
				<div class="modal-content">
				<div class="modal-header new-address-header" >
						<h5 class="modal-title new-address-title" id="newRekeningLabel">Pencairan Saldo STIL</h5>
						<button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
						<span aria-hidden="true" class="fas fa-times-circle"></span>
						</button>
				</div>
				<div class="modal-body p-2 new-address-body">
					<?php	if($this->userModel->checkIsHaveRekening($this->session->userdata('user_id'))>=1){ ?>
					<div class="row" style="padding-left:20px;padding-right:20px;margin-top:30px;">
							<fieldset class="form-group col-md-12">
									<label for="addressName-label">Jumlah Pencairan</label>
									<div class="input-group">
										<div class="input-group-prepend">
									    <span class="input-group-text" id="basic-addon1">Rp</span>
									  </div>
		  							<input onkeypress="return number_only(event);"onkeyup="this.value=ribuan_format_form(this.value);" type="text" class="form-control" id="wd_amount">
									</div>
							<p style="margin-top:5px;margin-bottom:0px">Saldo minimum yang dapat dicairkan adalah Rp 30.000<br>Sisa saldo Anda yang dapat dicairkan adalah <u id="mycurrentmoney"><?php echo $this->currencyModel->integerToCurrency('rupiah',$userMoney['current']-$userMoney['requested']);?></u></p>
							</fieldset>
					</div>
						<div class="row" style="padding-left:20px;padding-right:20px;">
								<fieldset class="form-group col-md-12">
										<label for="addressName-label">Rekening Tujuan</label>
										<select name="search_rekening" id="wd_user_bank_id" class="form-control dropdown-select-style" style="margin-left:0px">
											<?php foreach($memberRekening as $rekening){ ?>
												<option <?php if($rekening['is_default']==1){echo "selected";}?> value="<?php echo $rekening['id'];?>"><?php echo $rekening['nama_bank'].' '.$rekening['rekening'].' a.n. '.$rekening['atas_nama'];?></option>
											<?php } ?>

										</select>
								</fieldset>
						</div>


				</div>
				<div class="modal-footer" style="border:0px;padding:30px;padding-top:0px">
						<button type="button" class="btn btn-primary" onClick="requestWD();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Withdraw</button>
				</div>
				<?php }else{ ?>
					<div style="padding:20px">
					<center>
						<img src="<?php echo base_url();?>assets/images/icon-img/rekening-empty.png" width="270px"><br>
						<h5>Anda belum menambahkan informasi nomor rekening.</h5>
						<br>
						<a href="<?php echo base_url();?>my-account/saving-account">
						<button  class="btn btn-success" style="cursor:pointer;background-color:#f28f16;border:1px solid #f28f16;">Kelola Nomor Rekening</button>
						</a>
						<br>
					</center>
					</div>
				<?php } ?>
				</div>
		</div>
		</div>
	</div>
</body>
