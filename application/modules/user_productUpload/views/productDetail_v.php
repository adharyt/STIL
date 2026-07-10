
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
							<li data-image="<?php echo base_url()."assets/images/product/".$productImg['img_url']; ?>"><img src="<?php echo base_url()."assets/images/product/".$productImg['img_url']; ?>" alt=""></li>
						<?php } ?>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-3 order-lg-2 order-1">
					<div class="image_selected"><img src="<?php echo base_url()."assets/images/product/".$dataProductImg[0]['img_url'];?>" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-8 order-3">
					<div class="product_description">
						<div class="product_category">Laptops</div>
						<div class="product_name"><?php echo $dataProduct['pr_name'];  ?></div>
						<div style="color:#fbd600">
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<small style="color:#999">5.0 (3 ulasan)</small>
						</div>
						<hr style="margin-bottom:10px">
						<div class="product_price" style="margin-top:0px;margin-bottom:-10px;font-size:20px;vertical-align:bottom;color:red"><strike><?php echo $this->currencyModel->integerToCurrency('rupiah',20000000); ?></strike></div><br>
						<div class="product_price" style="margin-top:0px"><?php echo $this->currencyModel->integerToCurrency('rupiah',$dataProduct['price']); ?></div>
						<div class="product_quantity_text_before"><p>Hanya tersisa <font color="red">1 stok</font> barang lagi!</p></div>
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div class="clearfix" style="z-index: 1000;">
									<!-- Product Quantity -->
									<div class="product_quantity clearfix">
										<span>Jumlah: </span>
										<input id="quantity_input" type="text" pattern="[0-9]*" value="1">
										<div class="quantity_buttons">
											<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>
								</div>
								<div class="product_quantity_text_after" style="margin-bottom:0px;"><p style="line-height:1.2"><small>Jumlah minimum pembelian barang adalah 1</small></p></div>
								<div class="product_quantity_text_after" style="margin-top:0px"><p style="line-height:1"><small>Jumlah maksimum pembelian barang adalah 1</small></p></div>



								<div class="button_container">
									<button type="button" class="button cart_button">Tambahkan ke Keranjang</button>
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
              >Feedback (2)</a
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
              >Ulasan (3)</a
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
									<td>Baru</td>
								</tr>
								<tr>
									<td width="100px"><i class="fas fa-shopping-cart"></i> Terjual</td>
									<td width="10px">:</td>
									<td>4681</td>
								</tr>
								<tr>
									<td width="100px"><i class="fas fa-eye"></i> Dilihat</td>
									<td width="10px">:</td>
									<td>14880</td>
								</tr>
							</table>
						</div>
						<div class="col-lg-6">
							<table style="font-size:12px">
								<tr>
									<td width="130px"><i class="fas fa-clock"></i> Waktu Proses</td>
									<td width="10px">:</td>
									<td>2 hari</td>
								</tr>
								<tr>
									<td width="130px"><i class="fas fa-heart"></i> Wishlist</td>
									<td width="10px">:</td>
									<td>324</td>
								</tr>
								<tr>
									<td width="130px"><i class="fas fa-edit"></i> Diperbarui</td>
									<td width="10px">:</td>
									<td>Hari ini, pukul 17:13</td>
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
									<td>Kayu</td>
								</tr>
								<tr>
									<td width="100px">Berat</td>
									<td width="10px">:</td>
									<td>20 kilogram</td>
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
              Beryl Cook is one of Britain’s most talented and amusing artists
              .Beryl’s pictures feature women of all shapes and sizes enjoying
              themselves .Born between the two world wars, Beryl Cook eventually
              left Kendrick School in Reading at the age of 15, where she went
              to secretarial school and then into an insurance office. After
              moving to London and then Hampton, she eventually married her next
              door neighbour from Reading, John Cook. He was an officer in the
              Merchant Navy and after he left the sea in 1956, they bought a pub
              for a year before John took a job in Southern Rhodesia with a
              motor company. Beryl bought their young son a box of watercolours,
              and when showing him how to use it, she decided that she herself
              quite enjoyed painting. John subsequently bought her a child’s
              painting set for her birthday and it was with this that she
              produced her first significant work, a half-length portrait of a
              dark-skinned lady with a vacant expression and large drooping
              breasts. It was aptly named ‘Hangover’ by Beryl’s husband and
            </p>
            <p>
              It is often frustrating to attempt to plan meals that are designed
              for one. Despite this fact, we are seeing more and more recipe
              books and Internet websites that are dedicated to the act of
              cooking for one. Divorce and the death of spouses or grown
              children leaving for college are all reasons that someone
              accustomed to cooking for more than one would suddenly need to
              learn how to adjust all the cooking practices utilized before into
              a streamlined plan of cooking that is more efficient for one
              person creating less
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
                        <h4>Blake Ruiz <i class="fas fa-thumbs-up" style="color:green"></i></h4>
                        <h5>12th Feb, 2017 at 05:56 pm</h5>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>


                </div>
              </div>

            </div>
						<hr>
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
                        <h4>Blake Ruiz <i class="fas fa-thumbs-down" style="color:red"></i></h4>
                        <h5>12th Feb, 2017 at 05:56 pm</h5>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>


                </div>
              </div>

            </div>


          </div>
          <div
            class="tab-pane fade"
            id="review"
            role="tabpanel"
            aria-labelledby="review-tab"
          >
            <div class="row">
              <div class="col-lg-12">
                <div class="row total_rate">
                  <div class="col-6">
                    <div class="box_total">
                      <h5>Rata-rata</h5>
                      <h4>4.0</h4>
                      <h6>(3 ulasan)</h6>
                    </div>
                  </div>
									<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                  <div class="col-6">
                    <div class="rating_list">
                      <h3>Penilaian Produk</h3>
                      <ul class="list">
                        <li>
                          <a href="javascript:void(0);"
                            ><font style="margin-right:3px">5</font> <i class="fa fa-star"></i></a
                          >
													<div class="w3-light-grey w3-round-xlarge" style="vertical-align:middle;display:inline-block;width:80%">
												    <div class="w3-container w3-blue w3-round-xlarge" style="width:100%;height:5px;background-color:#fbd600 !important;">&nbsp;</div>
													</div>
													<small style="color:#999">3</small>
                        </li>
												<li>
                          <a href="javascript:void(0);"
                            ><font style="margin-right:3px">4</font> <i class="fa fa-star"></i></a
                          >
													<div class="w3-light-grey w3-round-xlarge" style="vertical-align:middle;display:inline-block;width:80%">
												    <div class="w3-container w3-blue w3-round-xlarge" style="width:0%;height:5px;background-color:#fbd600 !important;">&nbsp;</div>
													</div>
													<small style="color:#999">0</small>
                        </li>
												<li>
                          <a href="javascript:void(0);"
                            ><font style="margin-right:3px">3</font> <i class="fa fa-star"></i></a
                          >
													<div class="w3-light-grey w3-round-xlarge" style="vertical-align:middle;display:inline-block;width:80%">
												    <div class="w3-container w3-blue w3-round-xlarge" style="width:0%;height:5px;background-color:#fbd600 !important;">&nbsp;</div>
													</div>
													<small style="color:#999">0</small>
                        </li>
												<li>
                          <a href="javascript:void(0);"
                            ><font style="margin-right:3px">2</font> <i class="fa fa-star"></i></a
                          >
													<div class="w3-light-grey w3-round-xlarge" style="vertical-align:middle;display:inline-block;width:80%">
												    <div class="w3-container w3-blue w3-round-xlarge" style="width:0%;height:5px;background-color:#fbd600 !important;">&nbsp;</div>
													</div>
													<small style="color:#999">0</small>
                        </li>
												<li>
                          <a href="javascript:void(0);"
                            ><font style="margin-right:4px">1</font> <i class="fa fa-star"></i></a
                          >
													<div class="w3-light-grey w3-round-xlarge" style="vertical-align:middle;display:inline-block;width:80%">
												    <div class="w3-container w3-blue w3-round-xlarge" style="width:0%;height:5px;background-color:#fbd600 !important;">&nbsp;</div>
													</div>
													<small style="color:#999">0</small>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
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
                        <h4>Blake Ruiz, <small style="color:#999">12th Feb, 2017 at 05:56 pm</small></h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
									<hr>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="http://localhost/cultivathings/assets/img/user_admin-img/drmp.jpg"
                          alt="" class="img-profile"
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz, <small style="color:#999">12th Feb, 2017 at 05:56 pm</small></h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
									<hr>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="http://localhost/cultivathings/assets/img/user_admin-img/drmp.jpg"
                          alt="" class="img-profile"
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz, <small style="color:#999">12th Feb, 2017 at 05:56 pm</small></h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                </div>
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
							<img src="http://localhost/cultivathings/assets/img/user_admin-img/drmp.jpg" class="img-profile" alt="User-Profile-Image">
					</div>
				<div class="col-9">
				<?php echo $dataProduct['store_name']; ?><br>
				<font style="font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;">0% (0 feedback)</font><br>
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
