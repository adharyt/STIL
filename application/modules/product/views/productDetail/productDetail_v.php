<?php if($cek=='y'){ ?>
	<?php
    $is_discount=$this->productModel->checkDiscountByParam($dataProduct['discount_start'],$dataProduct['discount_end'],$dataProduct['discount_value']);
    $is_grosir=$this->productModel->checkWholesaleByParam($dataProduct['is_wholesale'],$is_discount,$dataProduct['is_discount_grosir'],$dataProduct['stock_type']);
  ?>
<div class="row">
	<div class="col-lg-9">
<!-- Single Product -->
	<div class="single_product">
		<div class="container">
			<div class="row"  style="background-color:white!important;padding:10px;padding-top:50px;padding-bottom:50px;margin-left:10px;border:1px solid rgba(0,0,0,.125);">

				<div class="col-lg-4 order-lg-2 order-1">
					<!--Carousel Wrapper-->
					<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"data-ride="carousel">
						<!--Slides-->
						<div class="carousel-inner" role="listbox">
							<?php $i=0; foreach($dataProductImg as $productImg){ $i++;?>
								<div class="carousel-item <?php if($i==1){echo 'active';} ?>">
				          <div style="width:300px;height:300px;vertical-align:middle;display: inline-block;align-items: center; justify-content: center;display:flex" class="text-center">

				              <img src="<?php echo $productImg['img_url'];?>"
				                style="max-height:100%;max-width:100%;">

				          </div>
				        </div>
						<?php } ?>
						</div>
						<!--/.Slides-->
						<!--Controls-->
						<a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<!--/.Controls-->
						<ol class="carousel-indicators">
							<?php $i=0; foreach($dataProductImg as $productImg){ ?>
							<li data-target="#carousel-thumb" data-slide-to="<?php echo $i;?>" <?php if($i==0){echo 'class="active"';} ?>>
							<img src="<?php echo $dataProductImg[0]['img_url'];?>" width="60">
							</li>
							<?php $i++; } ?>
						</ol>
					</div>
					<!--/.Carousel Wrapper-->
				</div>

				<!-- Description -->
				<div class="col-lg-8 order-3">
					<div class="product_description">
						<div class="product_category"><?php echo $dataProduct['name_category']; ?></div>
						<div class="product_name"><?php echo $dataProduct['pr_name'];  ?></div>
							<div class="pr-star-rating" title="<?php echo (($productReviewAverage/5)*100); ?>%">
							    <div class="pr-back-stars">
							        <i class="fa fa-star" aria-hidden="true"></i>
							        <i class="fa fa-star" aria-hidden="true"></i>
							        <i class="fa fa-star" aria-hidden="true"></i>
							        <i class="fa fa-star" aria-hidden="true"></i>
							        <i class="fa fa-star" aria-hidden="true"></i>

							        <div class="pr-front-stars" style="width:<?php echo ((($productReviewAverage/5)*1.04)*100)/2; ?>%;">
							            <i class="fa fa-star" aria-hidden="true"></i>
							            <i class="fa fa-star" aria-hidden="true"></i>
							            <i class="fa fa-star" aria-hidden="true"></i>
							            <i class="fa fa-star" aria-hidden="true"></i>
							            <i class="fa fa-star" aria-hidden="true"></i>
							        </div>
											&nbsp;
											<small style="color:#999"><?php echo number_format($productReviewAverage,1,'.',',') ?> (<?php echo $productReviewCount;?> ulasan)</small>
							    </div>

						</div>

						<hr style="margin-bottom:10px">

						<div class="product_price" style="margin-top:0px"><?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($dataProduct['product_id'],1)); ?></div>
						<?php if($is_discount==1){?>
							<div class="product_price" style="margin-bottom:3px;font-size:20px;vertical-align:bottom;color:#7a7a7a"><strike><?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($dataProduct['product_id'],1,FALSE)); ?></strike> <sup><small><?php echo '-'.$dataProduct['discount_value'].'%'; ?></small></sup></div>
						<?php } ?>
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
								if($dataProduct["wh_unit$i"]!=0 && $dataProduct["wh_unit$i"]!='' && $dataProduct["wh_price$i"]!=0 && $dataProduct["wh_price$i"]!=''){
									if($is_discount==1){
									 $discountGrosir='
									 											<small><font color=gray><strike>'.$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($dataProduct["product_id"],$dataProduct["wh_unit$i"],FALSE)).'</strike></font>
																				<sup>-'.$dataProduct['discount_value'].'%</sup></small>';
							 	 	}else{
										$discountGrosir='';
									}
									$grosir_html_content.=
										"	<tr>
												<td style='text-align:left'>
													≥".$dataProduct["wh_unit$i"]."
												</td>
												<td style='padding-left:20px;text-align:left'>
													".$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($dataProduct["product_id"],$dataProduct["wh_unit$i"])).' '.$discountGrosir

												."</td>
											</tr>";
									}
							}
							$grosir_html_footer="
							</table>
							";
							$grosir_html=$grosir_html_header.$grosir_html_content.$grosir_html_footer;
						?>
						<br><span class="label-grosir">GROSIR</span> <span style="color:#828282;font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;"><a href="javascript:void(0);" title="<b>Daftar Harga Grosir</b>" data-html="true" data-toggle="popover" data-placement="bottom" data-content="<?php echo $grosir_html;?>">Beli banyak lebih murah</a></span>
						<?php } //end wholeshale ?>
						<!-- QUANTITY START -->
						<div class="product_quantity_text_before">
							<?php
								switch($dataProduct['stock_type']){
									case '1':
										echo "<p style='color:black;'>Barang unik hanya ada <font color='#d63a3a'>satu stock</font>!</p>";
										break;
									case '2':
										if($dataProduct['stock']>1000){
												echo "<p style='color:black;'>Tersisa lebih dari <font color='#009245'>1000 stok</font> barang!</p>";
										}else if($dataProduct['stock']>100){
												echo "<p style='color:black;'>Tersisa lebih dari <font color='#009245'>100 stok</font> barang!</p>";
										}else if($dataProduct['stock']>10){
												echo "<p style='color:black;'>Tersisa $dataProduct[stock] stok barang lagi!</p>";
										}else{
												echo "<p style='color:black;'>Hanya tersisa <font color='#d63a3a'>$dataProduct[stock] stok</font> barang lagi!</p>";
										}
										break;
									default:
										echo"<p style='color:black;'>Barang <font color='#009245'>selalu tersedia,</font> pesan sekarang!</p>";
										break;
								}
							?>
						</div>
						<!-- QUANTITY END -->
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div class="clearfix" style="z-index: 1000;<?php if($dataProduct['stock_type']==1){echo 'display:none';} ?>">
									<!-- Product Quantity -->
									<?php if($this->session->userdata('username')!=$dataProduct['store_link']){ ?>
									<div class="product_quantity clearfix" style="width:220px;">
										<span  style="color:black">Jumlah: </span>
										<?php if($dataProduct['stock_type']==2){$maxbeli="$dataProduct[stock]";}else{$maxbeli="9999999";}?>
										<input onChange="validation_quantity();" style="color:black;width:100px" id="quantity_input" type="text" pattern="[0-9]*" min="<?php echo $dataProduct['buy_minimum']; ?>" max="<?php echo $maxbeli;?>" value="<?php echo $dataProduct['buy_minimum']; ?>">
										<div class="quantity_buttons">
											<div id="quantity_inc_buttona" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_buttona" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>
									<?php } ?>
								</div>
								<div class="product_quantity_text_after" style="margin-bottom:0px;<?php if($dataProduct['stock_type']==1){echo 'display:none';} ?>"><p style="line-height:1.2"><small>Jumlah minimum pembelian barang adalah <?php echo $dataProduct['buy_minimum']; ?> unit</small></p></div>


								<?php if($this->session->userdata('username')!=$dataProduct['store_link']){ ?>

									<div class="row mt-5">
										<div class="col-4" style="padding-right:5px;">
							          <a href="<?php echo base_url().'buy/'.$dataProduct['store_link'].'/'.$dataProduct['pr_slug'].'-'.$dataProduct['pr_uniq'];?>" style="width:100%;background-color:#009245;border-color:#009245;cursor:pointer" class="btn btn-secondary">
													<?php if($dataProduct['processtime_id']!=3){
														echo "Beli Sekarang";
													}else{
														echo "Pre-order";
													}
													?>
												</a>
							      </div>

										<div class="col-6" style="padding-left:5px;">
							          <button onClick="addToCart('<?php echo $dataProduct['product_id']; ?>');" style="width:100%;background-color:#FFFFFF;border:2px solid #009245;color:#009245;cursor:pointer;" class="btn btn-secondary">Tambahkan ke Keranjang</button>
							      </div>

										<div class="col-2" style="padding-left:0px;">
											<?php if($this->session->userdata('is_login')=='y'){ ?>
												<div style="margin:0px" onClick="swishlist('<?php echo $dataProduct['pr_slug'].'-'.$dataProduct['pr_uniq'];?>','<?php echo $dataProduct['store_link'];?>');" class="product_fav <?php if($this->productModel->isWishlist($dataProduct['product_id'])>0){echo "active";} ?>" title="Tambahkan ke Wishlist"><i class="fas fa-heart"></i></div>
											<?php } ?>
							      </div>
							    </div>



								<small>
									<font color="#999">Pembayaran 100% aman, bebas penipuan dan jaminan uang kembali.</font> <font color="#009245">Info Selengkapnya.</font></small><br>
								<?php }else{ ?>
									<div class="button_container">
										<a href="<?php echo base_url();?>product/edit/<?php echo $dataProduct['product_id']; ?>"><button type="button" class="button cart_button">Edit Barang</button></a><br>
										<small>
											<font color="#999">Lihat semua barang milik tokomu</font> <a href="<?php echo base_url();?>my-store/products" target="_blank"><font color="#009245">disini</font></a></small>
									</div>
								<?php } ?>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!--================Product Description Area =================-->
    <section class="product_description_area" style="margin-left:10px">
      <div class="container"  style="background-color:white!important;padding:0px;">

        <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color:#fafafa;padding-bottom:0px;">
					&nbsp;&nbsp;
          <li class="nav-item">
            <a
              class="nav-link active"
							style="border:0px solid white;"
							id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Detail Barang</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
							style="border:0px solid white;"
							id="contact-tab"
              data-toggle="tab"
              href="#contact"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
              >Feedback (<?php echo $storeFeedbackCount;?>)</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
							style="border:0px solid white;"
							id="review-tab"
              data-toggle="tab"
              href="#review"
              role="tab"
              aria-controls="review"
              aria-selected="false"
              >Ulasan (<?php echo $productReviewCount;?>)</a
            >
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
					<div class="row">
						<div class="col-lg-2">
							Informasi
						</div>
						<div class="col-lg-4">
							<table style="font-size:12px">
								<tr>
									<td width="100px"><i class="fas fa-box"></i> Kondisi</td>
									<td width="10px">:</td>
									<td>
										<?php
										switch($dataProduct['pr_condition']){
											case '1':
												echo "Baru";
												break;
											default:
												echo "Bekas";
												break;
											}
										 ?>
									</td>
								</tr>
								<tr>
									<td width="100px"><i class="fas fa-shopping-cart"></i> Terjual</td>
									<td width="10px">:</td>
									<td><?php echo $this->productModel->cekTerjual($dataProduct['product_id']); ?></td>
								</tr>
								<tr>
									<td width="100px"><i class="fas fa-eye"></i> Dilihat</td>
									<td width="10px">:</td>
									<td>
										<?php echo "$productViewersCount"; ?>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-lg-6">
							<table style="font-size:12px">
								<tr>
									<td width="130px"><i class="fas fa-clock"></i> Waktu Proses</td>
									<td width="10px">:</td>
									<td>
										<?php
												echo $this->productModel->cekWaktuProses($dataProduct['product_id']);
										 ?>

									</td>
								</tr>
								<tr>
									<td width="130px"><i class="fas fa-heart"></i> Wishlist</td>
									<td width="10px">:</td>
									<td id="thisWishlist"><?php echo $this->productModel->cekWishlist($dataProduct['product_id']); ?></td>
								</tr>
								<tr>
									<td width="130px"><i class="fas fa-edit"></i> Diperbarui</td>
									<td width="10px">:</td>
									<td><?php if($dataProduct['product_lastupdated']==''){$lastUpdate=$dataProduct['lup'];}else{$lastUpdate=$dataProduct['product_lastupdated'];}echo $this->timeModel->get_TanggalIndo($lastUpdate); ?></td>
								</tr>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-2">
							Spesifikasi
						</div>
						<div class="col-lg-10">
							<table style="font-size:12px">
								<tr>
									<td width="100px">Kategori</td>
									<td width="10px">:</td>
									<td><?php echo $dataProduct['name_category']; ?></td>
								</tr>
								<tr>
									<td width="100px">Asal Barang</td>
									<td width="10px">:</td>
									<td><?php $dataProduct['pr_source']==1?$pr_source="Impor":$pr_source="Lokal";echo $pr_source; ?></td>
								</tr>
								<tr>
									<td width="100px">Berat</td>
									<td width="10px">:</td>
									<td>
										<?php
											if($dataProduct['weight']>=1000){
												echo number_format(($dataProduct['weight']/1000),2,'.',',')." kilogram";
											}else{
												echo $dataProduct['weight']." gram";
											}
										?>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-2">
							Deskripsi
						</div>
						<div class="col-lg-10">
            <p>
              <?php echo $dataProduct['pr_description']; ?>
            </p>
					</div>
          </div>
					<div class="row">
						<div class="col-lg-2">
							Catatan Penjual
						</div>
						<div class="col-lg-10">
            <?php if($dataProduct['store_notes']!=''){
							 				echo "<p>".$dataProduct['store_notes']."</p>";
											echo '<br>
				 							<small style="color:#999">Catatan Penjual terakhir kali diubah pada tanggal 25 Juli 2019, pukul 12.48 WIB</small>';
						 			}else{
										echo "<p><i>Belum ada catatan penjual di toko ini.</i></p>";
									}
						 ?>

					</div>
          </div>
				</div>
          <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >

						<!-- feedback start -->
						<?php
						if($storeFeedbackCount>0){
							$i=0;
							foreach($storeFeedback as $feedback){
							$i++;
							if($i>1){echo "<hr>";}
						?>
						<div class="row">
              <div class="col-lg-12">
                <div class="comment_list">
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="<?php echo $this->userModel->getUserPhoto($feedback['user_username']);?>"
                          alt="" class="img-profile"
                        />
                      </div>
                      <div class="media-body">
                        <h4>
													<?php echo $feedback['user_name']; ?>
													<?php
													 	switch($feedback['response']){
															case '1':
																echo '<i class="fas fa-thumbs-up" style="color:green"></i>';
																break;
															default:
																echo '<i class="fas fa-thumbs-down" style="color:#d63a3a"></i>';
																break;
														}

													?>
												</h4>
                        <h5><?php echo $this->timeModel->get_waktuIndo($feedback['lup']); ?></h5>
                      </div>
                    </div>
                    <p>
											<?php if($feedback['id_user']==1){
												if($feedback['response']==1){$resp=" Feedback Positif karena ";}else{$resp=" Feedback Negatif karena ";}
												echo "Mendapatkan ".$feedback['response_quantity'].$resp.$feedback['response_detail'];
											}else{
												 echo $feedback['response_detail'];
											 }
											?>
                    </p>
                  </div>


                </div>
              </div>

            </div>
						<!-- feedback end -->
						<?php } ?>
							<?php if($storeFeedbackCount>5){ ?>
							<br>
							<a style="color:#099245;cursor:pointer" target="_blank" href="<?php echo base_url().'s/'.$dataProduct['store_link'].'/feedback';?>">
									Lihat semua feedback
							</a>
							<?php } ?>
				<?php	}//feedback >0
					else{
							echo "<center style='color:#999'><img src='".base_url()."assets/images/product/no-feedback.png' width='25%'><br>Penjual ini belum memiliki feedback</center>";
					}?>


          </div>
          <div
            class="tab-pane fade"
            id="review"
            role="tabpanel"
            aria-labelledby="review-tab"
          >
            <div class="row">
              <div class="col-lg-12">
								<?php 	if($productReviewCount>0){ ?>
                <div class="row total_rate">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box_total">
                      <h5>Rata-rata</h5>
                      <h4><?php echo number_format($productReviewAverage,1,'.',',');?></h4>
											<div class="pr-star-rating" style="justify-content: center;" title="<?php echo (($productReviewAverage/5)*100); ?>%">
											    <div class="pr-back-stars text-center">
											        <i class="fa fa-star" aria-hidden="true"></i>
											        <i class="fa fa-star" aria-hidden="true"></i>
											        <i class="fa fa-star" aria-hidden="true"></i>
											        <i class="fa fa-star" aria-hidden="true"></i>
											        <i class="fa fa-star" aria-hidden="true"></i>

											        <div class="pr-front-stars  text-center" style="width:<?php echo (($productReviewAverage/5)*100); ?>%;">
											            <i class="fa fa-star" aria-hidden="true"></i>
											            <i class="fa fa-star" aria-hidden="true"></i>
											            <i class="fa fa-star" aria-hidden="true"></i>
											            <i class="fa fa-star" aria-hidden="true"></i>
											            <i class="fa fa-star" aria-hidden="true"></i>
											        </div>
												 	</div>
											</div>
                      <h6>(<?php echo $productReviewCount;?> ulasan)</h6>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="rating_list">
                      <h3>Penilaian Produk</h3>
                      <ul class="list">

												<?php
														if($productReviewCount==0){$productReviewCountAsDivider=1;}else{$productReviewCountAsDivider=$productReviewCount;}
														for($i=4;$i>=0;$i--){
															$rwidth=($productRating[$i]['count']/$productReviewCountAsDivider)*100;
												 ?>
                        <li>
                          <a href="javascript:void(0);"
                            ><font style="margin-right:3px"><?php echo $productRating[$i]['rating'];?></font> <i class="fa fa-star"></i></a
                          >
													<div class="w3-light-grey w3-round-xlarge" style="vertical-align:middle;display:inline-block;width:80%">
												    <div class="w3-container w3-blue w3-round-xlarge" style="width:<?php echo $rwidth;?>%;height:5px;background-color:#fbd600 !important;">&nbsp;</div>
													</div>
													<small style="color:#999"><?php echo $productRating[$i]['count'];?></small>
                        </li>
												<?php } ?>
                      </ul>
                    </div>
                  </div>

                </div>


							 </div>
							 <div class="col-lg-12">
								 <?php
								 		foreach($productReview as $review){
								  ?>
 								<!-- REVIEWSTART -->
 								<hr>
                 <div class="review_list">
                   <div class="review_item">
                     <div class="media">
                       <div class="d-flex">
                         <img
                           src="<?php echo $this->userModel->getUserPhoto($review['user_username']);?>"
                           alt="" class="img-profile"
                         />
                       </div>
                       <div class="media-body">
                         <h4><?php echo $review['user_name']; ?>, <small style="color:#999"><?php echo $this->timeModel->get_waktuIndo($review['lup']); ?></small></h4>
												 <?php
												 		$grayRate=5;
												 		for($i=0;$i<$review['rating'];$i++){
															$grayRate--;
															echo '<i class="fa fa-star"></i>';
														}
														for($i=0;$i<$grayRate;$i++){
															echo '<i class="fa fa-star" style="color:#ddd"></i>';
														}
												 ?>

                       </div>
                     </div>
                     <p>
                       <?php echo $review['review']; ?>
                     </p>
                   </div>
									</div>
 									<!-- REVIEWEND -->
								<?php } ?>
										<?php if($productReviewCount>5){ ?>
										<br>
										<a style="color:#099245;cursor:pointer" onClick="viewReview();">
												Lihat semua ulasan
										</a>
										<?php } ?>
										<?php
										}//review >0
										else{
												echo "<center style='color:#999'><img src='".base_url()."assets/images/product/no-review.png' width='25%'><br>Belum ada ulasan untuk produk ini</center>";
										}?>

              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

		</div>


		<div class="col-lg-3">
			<div class="single_product">
				<div class="container">
					<div class="card">
						<div class="card-header" style="background-color:#009245;color:white;">
							INFORMASI PENJUAL
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-3">
										<img src="<?php echo $this->storeModel->getStorePhoto($dataProduct['store_link'],$dataProduct['store_photo']); ?>" class="img-profile" alt="User-Profile-Image">
								</div>
								<div class="col-9">
									<a style="color:#099245" target="_blank" href="<?php echo base_url().'s/'.$dataProduct['store_link'];?>">
										<?php echo $dataProduct['store_name']; ?>
									</a>
									<br>
									<font style="font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;">
										<?php $storeFeedbackCount==0?$feedbackDiv=1:$feedbackDiv=$storeFeedbackCount; echo number_format(($storeFeedbackCountPositive/$feedbackDiv)*100,0,'.',','); ?>% (<?php echo $storeFeedbackCount; ?> feedback)
									</font><br>
										<font style="font-size:12px;color:#7f5994"><i class="fas fa-map-marker-alt"></i> <?php echo ucwords(strtolower($dataProduct['store_city'])); ?></font><br>
								 </div>
							</div>
							<hr>
							<?php
							$todayDate=date('Y-m-d');
							if(1<0 && $dataProduct['store_open_'.strtolower(date('l'))]==1 && strtotime(date('Y-m-d H:i:s',strtotime($todayDate.' '.$dataProduct['store_lastdelivery'])))>strtotime(date('Y-m-d H:i:s'))){ ?>
							<div class="card">
								<div class="card-body" style="background-color:#f28f16">
									<font style="color:#F0F0F0">
										PESAN SEBELUM
									</font><br>
									<font style="color:white;font-size:20px;font-weight:bold">
										<?php echo $dataProduct['store_lastdelivery']; ?> WIB<br>
									</font>
									<font style="color:white;font-size:13px">
										Agar barang dikirim hari ini
									</font>
								</div>
							</div>
							<br>
							<?php } ?>
							<div style="font-size:11px">
								<div class="row">
									<div class="col-6">Waktu Kirim</div>
									<div class="col-6"><?php echo $storeAverageSentTime;?></div>
								</div>
								<div class="row">
									<div class="col-6">Pelanggan</div>
									<div class="col-6"><?php echo $storeBuyersCount;?> orang</div>
								</div>
								<?php if($storeOrderTotal>0){ ?>
								<div class="row">
									<div class="col-6">Pesanan Diterima</div>
									<div class="col-6">Menerima <?php echo $storeOrderAccepted;?> dari <?php echo $storeOrderTotal;?> pesanan (<?php $storeOrderTotal==0?$orderCountDiv=1:$orderCountDiv=$storeOrderTotal; echo number_format(($storeOrderAccepted/$orderCountDiv)*100,0,'.',','); ?>%)</div>
								</div>
								<?php } ?>
								<div class="row">
									<div class="col-6">Tanggal Bergabung</div>
									<div class="col-6"><?php echo $this->timeModel->get_TanggalIndo($dataProduct['store_lup_active']); ?></div>
								</div>
							</div>
							<?php if($this->session->userdata('username')!=$dataProduct['store_link']){ ?>
								<br>
								<button onClick='<?php if($this->session->userdata("is_login")=="y"){ echo "startChatFromUser(`$dataProduct[store_real_id]`)";}else{ echo "login()";}?>' style="width:100%;background-color:#FFFFFF;border:2px solid #009245;color:#009245;cursor:pointer;" class="btn btn-secondary"><i class="fas fa-comment" style="transform: scale(1, 1);"></i> Chat Penjual</button>
							<?php } ?>
						</div>
					</div>
					<br>
					<div class="card">
						<div class="card-header" style="background-color:#009245;color:white;">
							INFORMASI PENGIRIMAN
						</div>
						<div class="card-body">
							<table>
							<?php

							foreach($couriers as $courier){ ?>
							<tr>
								<td valign="top" style="padding-bottom:10px;">
									<img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:20px;width:auto;margin-bottom:10px">
								</td>
								<td valign="top" style="padding-bottom:10px;">
									<p style="line-height:15px">
									<?php
										foreach($courier['courier_services'] as $courier_service){
											echo $courier_service['service_name'].'<br>';
								  } ?>
								</p>
								</td>
							</tr>
							<?php } ?>
							</table>


						</div>
					</div>


	</div>
</div>

</div>

	</div>
<?php }else{ ?>
<div class="row text-center">
	<div class="col-lg-6 offset-lg-3">
	<!-- Single Product -->
		<div class="single_product">
			<div class="container text-center">
				<div class="card" style="padding:50px">
					<center><img src="<?php echo base_url();?>assets/images/logoName.png" width="200px"></center><br>
					<h2>Maaf, produk yang Anda cari tidak ditemukan, silahkan lihat produk lainnya <a style="color:#099245" href="<?php echo base_url();?>products">disini</a>.</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
    <!--================End Product Description Area =================-->

		<!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" role="dialog" aria-labelledby="feedbackLabel" aria-hidden="true" style="margin-top:50px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header new-address-header">
                    <h5 class="modal-title new-address-title">Daftar Feedback</h5>
                    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                    <span aria-hidden="true" class="fas fa-times-circle"></span>
                    </button>
                </div>
								<input value="<?php echo $dataProduct['store_id'];?>" type="hidden" class="form-control text-dark i-address-name" id="store_id">
                <div class="modal-body" id="feedbackContent" style="padding-left:20px;padding-right:20px;width:100%;height:400px;overflow:scroll">

                </div>
            </div>
        </div>
    </div>

		<!-- Review Modal -->
    <div class="modal fade" id="reviewModal" role="dialog" aria-labelledby="reviewLabel" aria-hidden="true" style="margin-top:50px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header new-address-header">
                    <h5 class="modal-title new-address-title">Daftar Review</h5>
                    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                    <span aria-hidden="true" class="fas fa-times-circle"></span>
                    </button>
                </div>
								<input value="<?php echo $dataProduct['product_id'];?>" type="hidden" class="form-control text-dark i-address-name" id="product_id">
                <div class="modal-body" id="reviewContent" style="padding-left:20px;padding-right:20px;width:100%;height:400px;overflow:scroll">

                </div>
            </div>
        </div>
    </div>
