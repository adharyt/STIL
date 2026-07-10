<br>
<div class="container" style="max-width:90%">

			<?php if(count($cartPerStore)>0){ ?>

      <!-- Product -->
			<div class="row">
				<div class="col-lg-8">

					<?php foreach($cartPerStore as $cartData){ ?>
					<div class="row">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header" style="background-color:#009245;color:white;">
										<?php if($cartData['count_availability']>0){ ?>
										<div class="pretty p-svg p-curve" style="margin-right:5px;background-color:white">
												<input style="width:14px;height:14px;" type="checkbox" name="store" value="<?php echo $cartData['id_store'];?>" />
												<div class="state p-warning" style="width:15px;height:14px;">
														<!-- svg path -->
														<svg class="svg svg-icon" viewBox="0 0 20 20">
																<path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
														</svg>
														<label></label>
												</div>
										</div>
										<?php } ?>
										<?php echo $cartData['store_name'];?>

									</div>
									<div class="card-body">

										<?php
											$totalHargaBarang=0;
											foreach($cartData['id_product'] as $productData){
												$is_discount=$this->productModel->checkDiscountByParam($productData['discount_start'],$productData['discount_end'],$productData['discount_value']);
										    $is_grosir=$this->productModel->checkWholesaleByParam($productData['is_wholesale'],$is_discount,$productData['is_discount_grosir'],$productData['stock_type']);
											//STOCK
											switch($productData['stock_type']){
												case '1':
														$quantity=$this->productModel->cekStokBarang($productData['product_id'],$productData['quantity'])['value'];
														$max=1;
														$min=1;
														break;
												case '2':
														$quantity=$this->productModel->cekStokBarang($productData['product_id'],$productData['quantity'])['value'];
														$max=$productData['stock'];
														$min=$productData['buy_minimum'];
														break;
												case '3':
														$quantity=$this->productModel->cekStokBarang($productData['product_id'],$productData['quantity'])['value'];
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
											$availability=$this->productModel->checkAvailability($productData['product_id']);
											?>

							      <div class="item" id="cart<?php echo $productData['cart_id'];?>">
                      <div class="row" style="width:100%">
                        <div class="col-1"  >
													<div class="pretty p-svg p-curve">
											        <input type="checkbox" <?php if($availability==0){echo "disabled";}else{ ?> name="item" value="<?php echo $productData['cart_id'];?>" st_id="<?php echo $cartData['id_store'];?>"<?php } ?>/>
											        <div class="state p-warning">
											            <!-- svg path -->
											            <svg class="svg svg-icon" viewBox="0 0 20 20">
											                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
											            </svg>
											            <label></label>
											        </div>
											    </div>
                        </div>
                        <div class="col-11" >
                              <div class="row">
                                <div class="col-2" <?php if($availability==0){echo "style='opacity:0.5;'"; }?>>
																	<div style="border:1px solid #aeaeae;padding:10px;width:85px;height:85px;vertical-align:middle;display: inline-block;align-items: center; justify-content: center;display:flex" class="text-center">
														          <img src="<?php echo $this->productModel->getProductImage($productData['product_id'])[0]['img_url']; ?>"
														            style="max-height:100%;max-width:100%;">
														      </div>
                                </div>
                                <div class="col-6"  <?php if($availability==0){echo "style='opacity:0.5;'"; }?>>
                                  <div><a href="<?php echo base_url().'p/'.$productData['store_link'].'/'.$productData['product_slug'].'-'.$productData['product_uniq'];?>" target="_blank" style="color:#009245;font-size:16px"><?php echo $productData['product_name']; ?></a></div>
																	<span style="color:#f28f16;font-size:14px"><?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($productData['product_id'],1));?><small>/unit</small></span>
																		<?php if($is_discount==1){ ?>
																			<span class="product_price" style="color:#7a7a7a"><strike><?php echo $this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarang($productData['product_id'],1)*100)/(100-$productData['discount_value'])); ?></strike> <sup><small><?php echo '-'.$productData['discount_value'].'%'; ?></small></sup></span>
																		<?php } ?>
																		<!--(<?php if($productData['weight']>1000){echo $this->currencyModel->integerSeparation('.',2,$productData['weight']/1000).' kilogram';}else{ echo $this->currencyModel->integerSeparation('.',2,$productData['weight']).' gram';} ?>)-->
																	<?php
																		if($is_grosir==1){

																		$grosir_html_header="
																		<table width='100%' style='text-align:center'>
																			<tr>
																				<th style='text-align:left'>
																					<u>Unit</u>
																				</th>
																				<th style='padding-left:20px;text-align:left'>
																					<u>Harga</u>
																				</th>
																			</tr>";
																		$grosir_html_content='';
																		for($i=1;$i<=5;$i++){
																			if($productData["wh_unit$i"]!=0 && $productData["wh_unit$i"]!='' && $productData["wh_price$i"]!=0 && $productData["wh_price$i"]!=''){
																				if($is_discount==1){
																				 $discountGrosir='
																				 											<small><font color=gray><strike>'.$this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarang($productData["product_id"],$productData["wh_unit$i"])*100)/(100-$productData['discount_value'])).'</strike></font>
																															<sup>-'.$productData['discount_value'].'%</sup></small>';
																		 	 	}else{
																					$discountGrosir='';
																				}
																				$grosir_html_content.=
																					"	<tr>
																							<td style='text-align:left'>
																								≥".$productData["wh_unit$i"]."
																							</td>
																							<td style='padding-left:20px;text-align:left'>
																								".$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($productData["product_id"],$productData["wh_unit$i"])).' '.$discountGrosir

																							."</td>
																						</tr>";
																				}
																		}
																		$grosir_html_footer="
																		</table>
																		";
																		$grosir_html=$grosir_html_header.$grosir_html_content.$grosir_html_footer;
																	?>
																	<br>	<span style="color:#828282;font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;"><a style="color:#828282;" href="javascript:void(0);" title="<b>Daftar Harga Grosir</b>" data-html="true" data-toggle="popover" data-placement="bottom" data-content="<?php echo $grosir_html;?>">Beli banyak lebih murah</a></span>
																	<?php } //end wholeshale ?>
                                </div>
                                <div class="col-4 text-right" style="padding-right:0px;">
                                  <div class="row text-right">
                                    <div class="col-12 text-right" style="padding-right:0px">
																			<?php if($availability==1){ ?>
																			<table width="100%">
																				<tr>
																					<td align="left" width="22px">
																						<i class="fas fa-trash" style="color:#d4362a;cursor:pointer;" onClick="deleteItem('<?php echo $productData['cart_id'];?>');"></i>
																						<hr style="border-color:white">
																					</td>
																					<td align="center">
																						<div class="quantity">
			                												<button style="background-color:#f28f16" class="minus-btn" type="button" name="button">
			                							            <b style="font-size:16px;color:white">-</b>
			                							          </button>
			                							          <input  id='quan<?php echo $productData['cart_id'];?>' rp_id="<?php echo $productData['product_id'];?>" st_id="<?php echo $cartData['id_store'];?>" pr_id="<?php echo $productData['cart_id'];?>" class="quan" type="number" name="quantity" id="quantity" value="<?php echo $quantity;?>">
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
																						<span style="color:#f28f16" id='price<?php echo $productData['cart_id'];?>' class="pprice<?php echo $cartData['id_store'];?>"><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalharga); ?></span>
																					</td>
																				</tr>
																			</table>
																		<?php }else{ ?>
																			<i class="fas fa-trash" style="color:#d4362a;cursor:pointer;" onClick="deleteItem('<?php echo $productData['cart_id'];?>');"></i>
																			<span class="badge badge-pill badge-warning" style="margin-left:20px;background-color:#f28f16;color:white;font-size:80%;padding-left:.4em;padding-right:.4em;display:inline-block">
																				Stock tidak tersedia
																			</span>
																		<?php } ?>

                                    </div>
                                  </div>
                                </div>
                              </div>

                        </div>
                      </div>
							      </div>

										<hr <?php if(count($cartData['id_product'])>1){echo 'style="border-top:0px solid"';}?>>
										<?php } ?>


										<div class="row" id="subtotal<?php echo $cartData['id_store'];?>">
											<div class="col-12 text-right" style="padding-top:20px">
												Subtotal: <b id="subtotalval<?php echo $cartData['id_store'];?>"><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalHargaBarang);?></b><br>
												<small>Belum termasuk ongkos kirim</small>
											</div>
										</div>

								</div>
							</div>
						</div>
					</div>

					<br>
					<?php } ?>

			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-12">
							<div class="card">
								<div class="card-header" style="color:white;background-color:#009245">
									Ringkasan Belanja
								</div>
								<div class="card-body" id="summaryCart">
									<div class="row">
										<div class="col-6 text-left">
											Jumlah barang:
										</div>
										<div class="col-6 text-right">
											<span id="totalbarang">0</span> barang dari <span id="totalstore">0</span> penjual
										</div>
									</div>
									<div class="row">
										<div class="col-5 text-left">
											Total harga:
										</div>
										<div class="col-7 text-right">
											<b id="totalbayar">Rp 0</b><br>
											<small>Belum termasuk ongkos kirim</small>
										</div>
									</div>
										<hr>
										<div class="row">
											<div class="col-12 text-right">
												<a href="javascript:void(0);"><div class="btn btn-md" style="color:white;background-color:#009245" onClick="checkout();">Checkout</div></a>
											</div>
										</div>

								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br>
	<?php }else{ ?>
		<div class="row text-center">
			<div class="col-lg-12">
			<!-- Single Product -->
				<div class="single_product">
					<div class="container text-center">
						<div class="card" style="padding:50px">
							<center><img src="<?php echo base_url();?>assets/images/icon-img/cart-empty.png" width="200px"></center><br>
							<h4>Tidak ada barang didalam keranjang belanja. <a href="<?php echo base_url();?>products" style="color:#099245">Belanja sekarang!</a></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
	<?php } ?>




    </div>
