<br>
<div class="container" style="max-width:90%">


      <!-- Product -->
			<div class="row">
				<div class="col-lg-7">
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header" style="color:white;background-color:#009245">
									Metode Pembayaran
								</div>
								<div class="card-body">
									<div class="panel-group" id="accordion">
								    <div class="panel panel-default">
								      <div class="panel-heading" style="padding:10px">
								        <h4 class="panel-title mb-0">
								            <label class="mb-0" for='r11' style='width: 350px;'>
								              <input checked type='radio' class="accordpayment" id='payment_transfer' name='payment_method' value='bank_transfer' required /> Transfer Bank
								              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
															<?php	foreach($list_bank_transfer as $list){ ?>
																&nbsp;<img src="<?php echo $this->config->item('stil_assets_url').'/images/payment-logo/'.$list['image'];?>" height="15px">
															<?php }	?>
								            </label>
								        </h4>
								      </div>
								      <div id="collapseOne" class="panel-collapse collapse in show">
								        <div class="panel-body" style="border:1px solid #aeaeae;padding:10px;margin-bottom:10px">
													<h6>Ketentuan pembayaran:</h6>
								          <ul>
														<li style="margin-left:30px;list-style-type: square;">
															Pembayaran dapat Anda lakukan dengan cara transfer bank ke rekening
															<?php
																$count_print=0;
																foreach($list_bank_transfer as $list){
																	if(count($list_bank_transfer)>1){
																		$count_print++;
																		if($count_print!=count($list_bank_transfer)){
																			echo 'Bank '.$list['bank_singkatan'].', ';
																		}else{
																			echo 'atau Bank '.$list['bank_singkatan'].'.';
																		}
																	}else{
																		echo 'Bank '.$list['bank_singkatan'].'.';
																	}
															  }
															 ?>
														</li>
														<li style="margin-left:30px;list-style-type: square;">
															Total tagihan Anda belum termasuk kode transfer (tidak akan lebih dari Rp 1.000) untuk keperluan proses verifikasi otomatis.
														</li>
														<li style="margin-left:30px;list-style-type: square;">
															Kode transfer akan langsung dikembalikan kepada Anda melalui saldo STIL ketika pembayaran sudah diverifikasi.
														</li>
													</ul>
								        </div>
								      </div>
								    </div>
								    <div class="panel panel-default">
								      <div class="panel-heading" style="padding:10px">
								        <h4 class="panel-title mb-0">
								            <label class="mb-0" for='r12' style='width: 350px;'>
								              <input type='radio' class="accordpayment" id='payment_virtual_account' name='payment_method' value='virtual_account' required /> Virtual Account
								              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"></a>
								            </label>
								        </h4>
								      </div>
								      <div id="collapseTwo" class="panel-collapse collapse">
								        <div class="panel-body" style="border:1px solid #aeaeae;padding:10px;margin-bottom:10px">
								          <p>Pilih Virtual Account</p>
													<select class="form-control" name="virtual_account" style="width:60%;-webkit-appearance: menulist;">
														<option value="vaBNICode">Bank Negara Indonesia</option>
														<option value="vaBCACode">Bank Central Asia</option>
													</select>
								        </div>
								      </div>
								    </div>
								  </div>
								</div>
							</div>
						</div>
					</div>
					<br>


			</div>
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
												<a href="javascript:void(0);" onClick="select_payment();"><div class="btn btn-md" style="color:white;background-color:#009245">Checkout</div></a>
											</div>
										</div>

								</div>
						</div>
					</div>
				</div>
			</div>
		</div>


    </div>
		<br>
