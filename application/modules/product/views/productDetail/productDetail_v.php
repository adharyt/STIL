
<div class="row">
	<div class="col-lg-9">
<!-- Single Product -->
	<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<div class="col-lg-1 order-lg-1 order-2">
					<ul class="image_list">
						<?php foreach($dataProductImg as $productImg){ ?>
							<li data-image="<?php echo $productImg['img_url']; ?>"><img src="<?php echo $productImg['img_url']; ?>" alt=""></li>
						<?php } ?>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-3 order-lg-2 order-1">
					<div class="image_selected"><img src="<?php echo $dataProductImg[0]['img_url'];?>" alt=""></div>
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

							        <div class="pr-front-stars" style="width:<?php echo (($productReviewAverage/5)*100)/2; ?>%;">
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

						<div class="product_price" style="margin-top:0px"><?php echo $this->currencyModel->integerToCurrency('rupiah',$dataProduct['price']); ?></div>
						<div class="product_price" style="margin-bottom:3px;font-size:20px;vertical-align:bottom;color:red"><strike><?php echo $this->currencyModel->integerToCurrency('rupiah',20000000); ?></strike></div>
						<?php
							if($dataProduct["is_wholesale"]==1){

							$grosir_html_header="
							<table width='100%' style='text-align:center'>
								<tr>
									<th>
										<u>Unit</u>
									</th>
									<th>
										<u>Harga</u>
									</th>
								</tr>";
							$grosir_html_content='';
							for($i=1;$i<=5;$i++){
								if($dataProduct["wh_unit$i"]!=0 && $dataProduct["wh_unit$i"]!='' && $dataProduct["wh_price$i"]!=0 && $dataProduct["wh_price$i"]!=''){
									$grosir_html_content.=
										"	<tr>
												<td>
													≥".$dataProduct["wh_unit$i"]."
												</td>
												<td>
													".$this->currencyModel->integerToCurrency('rupiah',$dataProduct["wh_price$i"])."
												</td>
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
										echo "<p style='color:black;'>Barang unik hanya ada <font color='red'>satu stock</font>!</p>";
										break;
									case '2':
										if($dataProduct['stock']>1000){
												echo "<p style='color:black;'>Tersisa lebih dari <font color='#009245'>1000 stok</font> barang!</p>";
										}else if($dataProduct['stock']>100){
												echo "<p style='color:black;'>Tersisa lebih dari <font color='#009245'>100 stok</font> barang!</p>";
										}else if($dataProduct['stock']>10){
												echo "<p style='color:black;'>Tersisa $dataProduct[stock] stok barang lagi!</p>";
										}else{
												echo "<p style='color:black;'>Hanya tersisa <font color='red'>$dataProduct[stock] stok</font> barang lagi!</p>";
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
									<div class="product_quantity clearfix" style="width:220px;">
										<span  style="color:black">Jumlah: </span>
										<?php if($dataProduct['stock_type']==2){$maxbeli="$dataProduct[stock]";}else{$maxbeli="9999999";}?>
										<input onChange="validation_quantity();" style="color:black;width:100px" id="quantity_input" type="text" pattern="[0-9]*" min="<?php echo $dataProduct['buy_minimum']; ?>" max="<?php echo $maxbeli;?>" value="<?php echo $dataProduct['buy_minimum']; ?>">
										<div class="quantity_buttons">
											<div id="quantity_inc_buttona" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_buttona" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>
								</div>
								<div class="product_quantity_text_after" style="margin-bottom:0px;<?php if($dataProduct['stock_type']==1){echo 'display:none';} ?>"><p style="line-height:1.2"><small>Jumlah minimum pembelian barang adalah <?php echo $dataProduct['buy_minimum']; ?> unit</small></p></div>



								<div class="button_container">
									<button type="button" class="button cart_button" onClick="addToCart('<?php echo $dataProduct['product_id']; ?>');">Tambahkan ke Keranjang</button>
									<div class="product_fav" title="Tambahkan ke Wishlist"><i class="fas fa-heart"></i></div>
								</div>
								Jaminan 100% Aman<br>
								<small>
									<font color="#999">Uang pasti kembali. Sistem pembayaran bebas penipuan.</font> <font color="#009245">Selengkapnya.</font><br>
									<font color="#999">Barang tidak sesuai pesanan? Ikuti langkah retur barang di <font color="#009245">sini</font>.</font></small>

							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
					&nbsp;&nbsp;
          <li class="nav-item">
            <a
              class="nav-link active"
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
									<td>[NOT SET]</td>
								</tr>
								<tr>
									<td width="100px"><i class="fas fa-eye"></i> Dilihat</td>
									<td width="10px">:</td>
									<td>
										<?php echo "$dataProduct[hits]"; ?>
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
												if($dataProduct['is_processtime_set']==1){
													switch($dataProduct['processtime_id']){
														case '1':
															$waktuProses=$dataProduct['processtime_instan'].' jam';
															break;
														case '2':
															$waktuProses='2 hari';
															break;
														case '3':
															$waktuProses=$dataProduct['processtime_preorder'].' hari';
															break;
														default:
															$waktuProses='2 hari';
															break;
													}
												}else{
													switch($dataProduct['store_processtime_id']){
														case '1':
															$waktuProses=$dataProduct['store_processtime_instan'].' jam';
															break;
														case '2':
															$waktuProses='2 hari';
															break;
														case '3':
															$waktuProses=$dataProduct['store_processtime_preorder'].' hari';
															break;
														default:
															$waktuProses='2 hari';
															break;
													}
												}

												echo $waktuProses;
										 ?>

									</td>
								</tr>
								<tr>
									<td width="130px"><i class="fas fa-heart"></i> Wishlist</td>
									<td width="10px">:</td>
									<td>[NOT SET]</td>
								</tr>
								<tr>
									<td width="130px"><i class="fas fa-edit"></i> Diperbarui</td>
									<td width="10px">:</td>
									<td><?php echo $this->timeModel->get_TanggalIndo($dataProduct['product_lastupdated']); ?></td>
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
            <?php echo $dataProduct['store_notes']; ?><br>
						<small style="color:#999">Catatan Penjual terakhir kali diubah pada tanggal 25 Juli 2019, pukul 12.48 WIB</small>
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
						if(count($storeFeedback)>0){
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
                          src="http://localhost/cultivathings/assets/img/user_admin-img/drmp.jpg"
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
																echo '<i class="fas fa-thumbs-down" style="color:red"></i>';
																break;
														}

													?>
												</h4>
                        <h5><?php echo $this->timeModel->get_waktuIndo($feedback['lup']); ?></h5>
                      </div>
                    </div>
                    <p>
                      <?php echo $feedback['response_detail']; ?>
                    </p>
                  </div>


                </div>
              </div>

            </div>
						<!-- feedback end -->
						<?php }
					}//feedback >0
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
								<?php 	if(count($productReview)>0){ ?>
                <div class="row total_rate">
                  <div class="col-6">
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
                  <div class="col-6">
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
                           src="http://localhost/cultivathings/assets/img/user_admin-img/drmp.jpg"
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
 									<?php }
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
							<img src="<?php echo $this->userModel->getPhoto($dataProduct['store_link'],$dataProduct['photo'],$dataProduct['gender']); ?>" class="img-profile" alt="User-Profile-Image">
					</div>
					<div class="col-9">
						<?php echo $dataProduct['store_name']; ?><br>
						<font style="font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;">
							<?php $storeFeedbackCount==0?$feedbackDiv=1:$feedbackDiv=$storeFeedbackCount; echo number_format(($storeFeedbackCountPositive/$feedbackDiv)*100,0,'.',','); ?>% (<?php echo $storeFeedbackCount; ?> feedback)
						</font><br>
							<font style="font-size:12px;color:#7f5994"><i class="fas fa-map-marker-alt"></i> <?php echo $dataProduct['store_city']; ?></font><br>
					 </div>
				</div>
				<hr>



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
	<div style="font-size:11px">
				<div class="row">
					<div class="col-6">Waktu Kirim</div>
					<div class="col-6">± 1 hari</div>
				</div>
				<div class="row">
					<div class="col-6">Pelanggan</div>
					<div class="col-6">0 orang</div>
				</div>
				<div class="row">
					<div class="col-6">Pesanan Diterima</div>
					<div class="col-6">Menerima 0 dari 0 pesanan (0%)</div>
				</div>
				<div class="row">
					<div class="col-6">Tanggal Bergabung</div>
					<div class="col-6"><?php echo $this->timeModel->get_TanggalIndo($dataProduct['store_lup_active']); ?></div>
				</div>
			</div>
			</div>
			</div>


	</div>
</div>
</div>

	</div>

    <!--================End Product Description Area =================-->

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Recently Viewed</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">

						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_1.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Beoplay H7</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_2.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_3.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225</div>
										<div class="viewed_name"><a href="#">Samsung J730F...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_4.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_5.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>



							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_6.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$375</div>
										<div class="viewed_name"><a href="#">Speedlink...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">

						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">

							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_1.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_2.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_3.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_4.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_5.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_6.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_7.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_8.jpg" alt=""></div></div>

						</div>

						<!-- Brands Slider Navigation -->
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>
