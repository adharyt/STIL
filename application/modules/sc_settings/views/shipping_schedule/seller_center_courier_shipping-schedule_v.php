<style media="screen">
.input-group-append {
	margin-left: -2px;
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
		border-radius: 0rem;
}
</style>
<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text"><i class="fa fa-cogs m-0 mb-3"></i> Pengaturan Toko</div>
	<div class="card">
		<div class="card-header" style="background-color:white;border-bottom:0px solid white;padding-left:0px;padding-right:0px">
				<?php $this->load->view('template/header/seller_center_setting_tab');?>
		</div>
		<div class="card-body">
			<!--
			<div class="body-bold-text">Hari Kerja</div>
			<div class="default-text mt-1 ml-0">Pilih hari apa saja kamu dapat mengirimkan barang ke jasa pengiriman.</div>
			<div class="shipping-day-container default-text">
					<div class="containers mr-3">
						<label><input value="all" class="openday" type="checkbox"
							<?php if($infoToko['store_open_monday']==1
										&& $infoToko['store_open_tuesday']==1
										&& $infoToko['store_open_wednesday']==1
										&& $infoToko['store_open_thursday']==1
										&& $infoToko['store_open_friday']==1
										&& $infoToko['store_open_saturday']==1
										&& $infoToko['store_open_sunday']==1)
										{echo "checked='checked'";} ?>
							> Semua
                  <span class="checkmark"></span>
              </label>
         	</div>
					<div class="containers mr-3">
         	   <label style="margin-bottom:0px;"><input value="monday" class="openday" type="checkbox" <?php if($infoToko['store_open_monday']==1){echo "checked='checked'";} ?>> Senin
                  <span class="checkmark"></span>
              </label>
         	</div>
					<div class="containers mr-3">
         	   <label><input value="tuesday" class="openday" type="checkbox" <?php if($infoToko['store_open_tuesday']==1){echo "checked='checked'";} ?>> Selasa
                  <span class="checkmark"></span>
              </label>
         	</div>
					<div class="containers mr-3">
         	   <label><input value="wednesday" class="openday" type="checkbox" <?php if($infoToko['store_open_wednesday']==1){echo "checked='checked'";} ?>> Rabu
                  <span class="checkmark"></span>
              </label>
         	</div>
					<div class="containers mr-3">
         	   <label><input value="thursday" class="openday" type="checkbox" <?php if($infoToko['store_open_thursday']==1){echo "checked='checked'";} ?>> Kamis
                  <span class="checkmark"></span>
              </label>
         	</div>
					<div class="containers mr-3">
         	   <label><input value="friday" class="openday" type="checkbox" <?php if($infoToko['store_open_friday']==1){echo "checked='checked'";} ?>> Jumat
                  <span class="checkmark"></span>
              </label>
         	</div>
					<div class="containers mr-3">
         	   <label><input value="saturday" class="openday" type="checkbox" <?php if($infoToko['store_open_saturday']==1){echo "checked='checked'";} ?>> Sabtu
                  <span class="checkmark"></span>
              </label>
         	</div>
					<div class="containers mr-3">
         	   <label><input value="sunday"  class="openday" type="checkbox" <?php if($infoToko['store_open_sunday']==1){echo "checked='checked'";} ?>> Minggu
                  <span class="checkmark"></span>
              </label>
         	</div>
			</div>
			<div class="body-bold-text mt-5">Jam Pemesanan Terakhir</div>
			<div class="default-text mt-1 ml-0">Atur jam pemesanan terakhir di tokomu agar pembeli tau kapan perkiraan barang akan dikirim (berlaku untuk setiap hari pengiriman).</div>
			<div class="shipping-time-container ml-2">
					<select id="jam" class="selectpicker time-pick" title="Jam" data-size="5" data-container="body" data-dropup-auto="false">
						<option <?php if(substr($infoToko['store_lastdelivery'],0,2)==sprintf("%02d", 0)){echo "selected='selected'";} ?> value="<?php echo sprintf("%02d", 0);?>"><?php echo sprintf("%02d", 0);?></option>
							<?php
								for($i=1;$i<=23;$i++){ ?>
										<option <?php if(substr($infoToko['store_lastdelivery'],0,2)==sprintf("%02d", $i)){echo "selected='selected'";} ?> value="<?php echo sprintf("%02d", $i);?>"><?php echo sprintf("%02d", $i);?></option>
						<?php	}
							 ?>
					</select>
					<div class="body-bold-text ml-1 mr-1">:</div>
					<select id="menit" class="selectpicker time-pick" title="Menit" data-size="5" data-container="body" data-dropup-auto="false">
							<option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 0)){echo "selected='selected'";} ?> value="00">00</option>
							<option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 15)){echo "selected='selected'";} ?> value="15">15</option>
							<option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 30)){echo "selected='selected'";} ?> value="30">30</option>
							<option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 45)){echo "selected='selected'";} ?> value="45">45</option>
					</select>
					<div class="body-bold-text ml-2">WIB</div>
			</div>
			<div class="default-text ml-0 mt-3 mb-0">Preview informasi yang ditampilkan:</div>
			<div class="alert alert-warning ml-2 mt-1 col-4">
					<div class="default-text">Pesan sebelum</div>
					<div class="body-bold-text" style="margin-left: 10px;"><span id="lastdelivery"><?php echo $infoToko['store_lastdelivery'];?></span> WIB</div>
					<div class="default-text">Agar pesananmu dikirim hari ini</div>

			</div>
		-->
			<div style="margin-top:-10px">
					<div class="body-bold-text mt-2">Batas Waktu Memproses Pesanan</div>
					<div class="default-text mt-1 ml-0">Rentang waktu dari pesanan diterima sampai kamu memasukkan resi ke sistem STIL (berlaku untuk semua barang).</div>
					<div class="form-group row" id="processtime_custom" style="display:block">
							<label class="col-sm-3 "></label>
							<div class="col-sm-9" style="vertical-align:top;padding-left:30px">
								<div class="row" style="border:1px solid #ddd;">
									<div class="col-4">
										<div id="bul_instan" class="row" style="height:33.333%;padding:20px;<?php if($infoToko['store_processtime_id']==1){echo 'background-color:white';}else{echo 'background-color:#fafafa';} ?>">
											<div class="form-check" style="vertical-align:middle">
												<input style="margin-left:0px;" onChange="processtime_wg();validation_processtime();" class="form-check-input" type="radio" name="waktu_proses" id="wp_instan" value="1" <?php if($infoToko['store_processtime_id']==1){echo "checked='checked'";} ?>>
												<label class="form-check-label" style="font-weight:bold">
													Instan
												</label>
												<small class="form-text text-muted">Kurang dari 1 hari kerja</small>
											</div>
										</div>
										<div id="bul_reguler" class="row" style="height:33.333%;padding:20px;border-top:1px solid #ddd;border-bottom:1px solid #ddd;<?php if($infoToko['store_processtime_id']==2){echo 'background-color:white';}else{echo 'background-color:#fafafa';} ?>">
												<div class="form-check" style="vertical-align:middle">
													<input style="margin-left:0px;" onChange="processtime_wg();validation_processtime();" class="form-check-input" type="radio" name="waktu_proses" id="wp_reguler" value="2" <?php if($infoToko['store_processtime_id']==2){echo "checked='checked'";} ?>>
													<label class="form-check-label" style="font-weight:bold">
														Reguler
													</label>
													<small class="form-text text-muted">Maksimum 2 hari kerja</small>
												</div>
										</div>
										<div id="bul_preorder" class="row" style="height:33.333%;padding:20px;<?php if($infoToko['store_processtime_id']==3){echo 'background-color:white';}else{echo 'background-color:#fafafa';} ?>">
												<div class="form-check" style="vertical-align:middle">
													<input style="margin-left:0px;" onChange="processtime_wg();validation_processtime();" class="form-check-input" type="radio" name="waktu_proses" id="wp_preorder" value="3" <?php if($infoToko['store_processtime_id']==3){echo "checked='checked'";} ?>>
													<label class="form-check-label" style="font-weight:bold">
														Pre-order
													</label>
													<small class="form-text text-muted">Lebih dari 2 hari kerja</small>
												</div>
										</div>
									</div>
									<!-- item -->
									<div class="col-8" style="display:<?php if($infoToko['store_processtime_id']==1){echo 'block';}else{echo 'none';} ?>;padding:20px;padding-top:2%;" id="con_instan">
										Dikirim dalam
										<div class="input-group">
											<input onChange="processtime_wg();" type="number" value="<?php echo $infoToko['store_processtime_instan'];?>" min="1" max="8" class="form-control" id="processtime_instan"  name="processtime_instan" style="max-width:70px">
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">jam kerja</span>
											</div><span class="input-group-text" style="border:0px;background-color:white;font-size:12px;color:#aeaeae">Maksimum 8 jam kerja</span>
										</div>
										<br>
										<div class="card" style="padding:20px">
											<div class="row">
												<div class="col-3">
														<img width="100%" src="<?php echo base_url();?>assets/images/icon-img/processtime_instant.png"/>
												</div>
												<div class="col-9" style="font-size:12px">
														Batas waktu maksimum pengiriman pesanan:
														<ul style="list-style-type: circle;margin-left:20px">
															<li>Sameday service: 1x24 jam</li>
															<li>Next day: <span class="time_instan_text"><?php echo $infoToko['store_processtime_instan'];?></span> jam</li>
															<li>Reguler: <span class="time_instan_text"><?php echo $infoToko['store_processtime_instan'];?></span> jam</li>
														</ul>
												</div>
											</div>
										</div>
										<span style="font-size:12px">
											<i>Waktu kirim pesanan yang menggunakan Sameday service tetap 1x24 jam.</i>
										</span>
									</div>
									<!-- item -->
									<div class="col-8" style="display:<?php if($infoToko['store_processtime_id']==2){echo 'block';}else{echo 'none';} ?>;padding:20px;padding-top:6%;" id="con_reguler">
										Dikirim dalam <b>maksimum 2 hari kerja</b>
										<br><br>
										<div class="card" style="padding:20px">
											<div class="row">
												<div class="col-3">
														<img width="100%" src="<?php echo base_url();?>assets/images/icon-img/processtime_reguler.png"/>
												</div>
												<div class="col-9" style="font-size:12px">
														Batas waktu maksimum pengiriman pesanan:
														<ul style="list-style-type: circle;margin-left:20px">
															<li>Sameday service: 1x24 jam</li>
															<li>Next day: 2x24 jam</li>
															<li>Reguler: 2 hari kerja</li>
														</ul>
												</div>
											</div>
										</div>
									</div>
									<!-- item -->
									<div class="col-8" style="display:<?php if($infoToko['store_processtime_id']==3){echo 'block';}else{echo 'none';} ?>;padding:20px;padding-top:2%;" id="con_preorder">
										Dikirim dalam
										<div class="input-group">
											<input onChange="processtime_wg();" type="number" value="<?php echo $infoToko['store_processtime_preorder'];?>" min="1" max="30" class="form-control" id="processtime_preorder"  name="processtime_preorder" style="max-width:70px">
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">hari kerja</span>
											</div><span class="input-group-text" style="border:0px;background-color:white;font-size:12px;color:#aeaeae">Maksimum 30 hari kerja</span>
										</div>
										<br>
										<div class="card" style="padding:20px">
											<div class="row">
												<div class="col-3">
														<img width="100%" src="<?php echo base_url();?>assets/images/icon-img/processtime_preorder.png"/>
												</div>
												<div class="col-9" style="font-size:12px">
														Batas waktu maksimum pengiriman pesanan:
														<ul style="list-style-type: circle;margin-left:20px">
															<li>Sameday service: 1x24 jam</li>
															<li>Next day: <span class="time_preorder_text"><?php echo $infoToko['store_processtime_preorder'];?></span> hari</li>
															<li>Reguler: <span class="time_preorder_text"><?php echo $infoToko['store_processtime_preorder'];?></span> hari</li>
														</ul>
												</div>
											</div>
										</div>
										<span style="font-size:12px">
											<i>Waktu kirim pesanan yang menggunakan Sameday service tetap 1x24 jam.</i>
										</span>
									</div>

								</div>
							</div>
					</div>
			</div>
		</div>
	</div>


</div>
</div>
