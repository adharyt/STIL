<br>
<div class="container" style="max-width:90%">


      <!-- Product -->
			<div class="row">
				<div class="col-lg-8">

					<?php foreach($cartPerStore as $cartData){ ?>
					<div class="row">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header" style="background-color:#009245;color:white;">
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
										<?php echo $cartData['store_name'];?>

									</div>
									<div class="card-body">

										<?php
											$totalHargaBarang=0;
											foreach($cartData['id_product'] as $productData){
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

							      <div class="item" id="cart<?php echo $productData['cart_id'];?>">
                      <div class="row" style="width:100%">
                        <div class="col-1"  >
													<div class="pretty p-svg p-curve">
											        <input type="checkbox" name="item" value="<?php echo $productData['cart_id'];?>" st_id="<?php echo $cartData['id_store'];?>"/>
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





    </div>
