<br>
<div class="container" style="max-width:90%">


      <!-- Product -->
			<div class="row">
				<div class="col-lg-7">
					<div class="row">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header" style="background-color:#009245;color:white;">
										Detail Penerima dan Alamat Pengiriman
									</div>
									<div class="card-body">
										 <select  id="receiveraddress" style="font-size:16px;margin-left:0px;width:100%;color:green;-webkit-appearance: menulist;">
											 <?php
											 	foreach($addressList as $address){ ?>
													<option value="<?php echo $address['id'];?>"><?php echo '['.$address['alias'].'] '.$address['receiver'].' - '.$address['phone'];?></option >
											  <?php } ?>
										 </select>
										 <br><br>
										 <p align="justify" style="color:black">
										 <b>Penerima:</b><br>
										 <span id='addr_receiver'><?php echo $addressList[0]['receiver'];?></span><br><span id="addr_phone"><?php echo $addressList[0]['phone'];?></span><br>
										 <br>
										 <b>Alamat:</b><br>
										 <span id="addr_address"><?php echo $addressList[0]['address'];?></span><br>
										 <span id="addr_postal"><?php echo $addressList[0]['postalcode'];?></span><br>
										 <br>
									 	</p>



									</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header" style="background-color:#009245;color:white;">
										Detail Pembelian
									</div>
									<div class="card-body" style="padding-left:5px;padding-right:5px;padding-top:20px;">
									<?php foreach($products as $product){ ?>
									<div class="row seller" id="<?php echo $product['id_store'];?>">
										<div class="col-lg-12">
												<div class="card">
													<div class="card-header" style="background-color:white;color:black;border:0px">
														<b><?php echo $product['store_name'];?></b>
													</div>
													<div class="card-body">

														<?php
															$totalHargaBarang=0;
															foreach($product['id_product'] as $productData){
															//STOCK
															switch($productData['stock_type']){
																case '1':
																		$quantity=1;
																		$max=1;
																		$min=1;
																		break;
																case '2':
																		if($productData['stock']<$productData['quantity']){
																			$quantity=$productData['stock'];
																			$max=$productData['stock'];
																			$min=$productData['buy_minimum'];
																		}else{
																			$quantity=$productData['quantity'];
																			$max=$productData['stock'];
																			$min=$productData['buy_minimum'];
																		}
																		break;
																case '3':
																		$quantity=$productData['quantity'];
																		$min=$productData['buy_minimum'];
																		$max=999999;
																		break;
																default:
																		$quantity=1;
																		$max=1;
																		$min=1;
																		break;
															}

															//VISIBILITY
															if($productData['is_visibility']==0){
																$availability=0;
															}else	if($productData['stock_type']==2 && $min>$productData['stock']){
																$availability=0;
															}else{
																$availability=1;
															}
															?>

											      <div class="item items<?php echo $product['id_store'];?>" id="cart_temp<?php echo $productData['checkout_id'];?>" c_id="<?php echo $productData['checkout_id'];?>" p_id="<?php echo $productData['product_id'];?>">
				                      <div class="row" style="width:100%">
				                        <div class="col-12" >
				                              <div class="row">
				                                <div class="col-2">
				                                  <img style="border:1px solid #aeaeae" width="100%" src="<?php echo $this->productModel->getProductImage($productData['product_id'])[0]['img_url']; ?>" alt="" />
				                                </div>
				                                <div class="col-6" >
				                                  <?php echo $productData['product_name']; ?>
				                                </div>
				                                <div class="col-4 text-right" style="padding-right:0px;">
				                                  <div class="row text-right">
				                                    <div class="col-12 text-right" style="padding-right:0px">
																							<table width="100%">
																								<tr>
																									<td align="left" width="22px">
																										&nbsp;
																										<hr style="border-color:white">
																									</td>
																									<td align="center">
																										<div class="quantity">
							                												<button style="background-color:#f28f16" class="minus-btn" type="button" name="button">
							                							            <b style="font-size:16px;color:white">-</b>
							                							          </button>
							                							          <input  id='quan<?php echo $productData['checkout_id'];?>' st_id="<?php echo $product['id_store'];?>" pr_id="<?php echo $productData['checkout_id'];?>" class="quan" type="number" name="quantity" id="quantity" value="<?php echo $quantity;?>">
							                												<button style="background-color:#f28f16" class="plus-btn" type="button" name="button">
							                							            <b style="font-size:16px;color:white">+</b>
							                							          </button>
							                							        </div>
																										<hr width="75%">
																									</td>
																								</tr>
																								<tr>
																									<td></td>
																									<td align="center">
																										<?php $totalharga=$this->productModel->cekHargaBarang($productData['product_id'],$quantity)*$quantity; $totalHargaBarang+=$totalharga;?>
																										<span style="color:#f28f16" id='price<?php echo $productData['checkout_id'];?>' class="pprice<?php echo $product['id_store'];?> priceperunit"><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalharga); ?></span>
																									</td>
																								</tr>
																							</table>
																							<!--
																							<select class="js-source-states" style="display:block;width:100%" id="ship_product_<?php echo $productData['product_id'];?>" st_id="<?php echo $productData['product_id'];?>">

																							</select>
																						-->

				                                    </div>
				                                  </div>
				                                </div>
				                              </div>

				                        </div>
				                      </div>
											      </div>

														<hr <?php if(count($product['id_product'])>1){echo 'style="border-top:0px solid"';}?>>
														<?php } ?>


														<select class="js-source-states" style="display:block;width:100%" id="ship_store_<?php echo $product['id_store'];?>" sh_id="store_<?php echo $product['id_store'];?>" st_id="<?php echo $product['id_store'];?>">

														</select>

														<div class="row" id="subtotal<?php echo $product['id_store'];?>">
															<div class="col-12 text-right" style="padding-top:20px">
																Subtotal: <b class="subtotalval" id="subtotalval<?php echo $product['id_store'];?>"><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalHargaBarang);?></b><br>
																<small id="ship_store_<?php echo $product['id_store'];?>_ongkir">Belum termasuk ongkos kirim</small>
															</div>
														</div>

												</div>
											</div>
										</div>
									</div>

									<br>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

			</div>
			<div class="col-lg-5">
				<div class="row">
					<div class="col-lg-12">
							<div class="card">
								<div class="card-header" style="color:white;background-color:#009245">
									Ringkasan Belanja
								</div>
								<div class="card-body" id="summaryCart_temp">
									<div class="row">
										<div class="col-5 text-left">
											Total harga barang:
										</div>
										<div class="col-7 text-right">
											<b id="totalhargabarang">Rp 0</b><br>
										</div>
									</div>
									<div class="row">
										<div class="col-5 text-left">
											Total ongkos kirim:
										</div>
										<div class="col-7 text-right">
											<b id="totalongkir">Rp 0</b><br>
										</div>
									</div>
									<div class="row">
										<div class="col-5 text-left">
											Total bayar:
										</div>
										<div class="col-7 text-right">
											<b id="totalbayar">Rp 0</b><br>
										</div>
									</div>
										<hr>
										<div class="row">
											<div class="col-12 text-right">
												<a href="javascript:void(0);" onClick="checkout();"><div class="btn btn-md" style="color:white;background-color:#009245">Checkout</div></a>
											</div>
										</div>

								</div>
						</div>
					</div>
				</div>
			</div>
		</div>





    </div>
