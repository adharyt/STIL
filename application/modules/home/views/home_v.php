

	<!-- Banner -->

	<div class="banner" style="background-color:white !important">
		<div class="banner_background" style="background-image:url(<?php echo base_url();?>assets/images/bg-img/bg-01.jpg);"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="banner_product_image"><img src="<?php echo base_url();?>assets/images/logo.png" height="200px" alt=""></div>
				<div class="col-lg-9 fill_height" style="margin-left:0px">
					<div class="banner_content">
						<h1 class="banner_text" style="color:#099245">STIL Marketplace</h1>
						<div style="margin-top:10px;background-color:#099245;color:white;max-width:fit-content" class="banner_price">&nbsp;by PT STIL Hutanami Indonesia&nbsp;</div>
						<div class="button banner_button"><a href="<?php echo base_url();?>assets/#">Belanja Sekarang</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Deals of the week -->

	<div class="deals_featured" style="background-color:white !important">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

					<!-- Deals -->

					<div class="deals">
						<div class="deals_title">Flash Sale</div>
						<div class="deals_slider_container">

							<!-- Deals Slider -->
							<div class="owl-carousel owl-theme deals_slider">

								<?php foreach($dataProductFlash['dataProduct'] as $product){ ?>
									<?php
						        $is_discount=$this->productModel->checkDiscountByParam($product['discount_start'],$product['discount_end'],$product['discount_value']);
						        $is_grosir=$this->productModel->checkWholesaleByParam($product['is_wholesale'],$is_discount,$product['is_discount_grosir'],$product['stock_type']);
										$terjual=$this->productModel->cekTerjual($product['product_id']);
										$stock=$this->productModel->cekStokBarang($product['product_id'],1)['value'];
										$stock_bar=($stock/($stock+$terjual)*100);
									?>
								<!-- Deals Item -->
								<div class="owl-item deals_item">
									<div class="deals_image"><img src="<?php echo $this->productModel->getProductImage($product['product_id'])[0]['img_url']; ?>" alt=""></div>
									<div class="deals_content">
										<div class="deals_info_line justify-content-start">
											<div class="deals_item_name"><?php echo $product['pr_name'];?></div>
											<?php if($is_discount==1){ ?>
												<div class="deals_item_price_a ml-auto"><strike><?php echo $this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarang($product['product_id'],1,FALSE)));?></strike></div>
											<?php } ?>
											<div class="deals_item_price ml-auto"><?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product['product_id'],1));?></div>
											<?php if($is_grosir==1){
						            echo '<div class="label label-info label-xs">Grosir</div>';
						          }?>
										</div>
										<div class="available">
											<div class="available_line d-flex flex-row justify-content-start">
												<div class="available_title">Tersedia: <span><?php echo $stock;?></span></div>
												<div class="sold_title ml-auto">Terjual: <span><?php echo $terjual;?></span></div>
											</div>
											<div class="available_bar"><span style="width:<?php echo $stock_bar;?>%"></span></div>
										</div>
										<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
											<div class="deals_timer_title_container">
												<div class="deals_timer_title">Hurry Up</div>
												<div class="deals_timer_subtitle">Offer ends in:</div>
											</div>
											<div class="deals_timer_content ml-auto">
												<div class="deals_timer_box clearfix" data-target-time="2020-05-01 10:00:00">
													<div class="deals_timer_unit">
														<div id="deals_timer1_hr" class="deals_timer_hr"></div>
														<span>hours</span>
													</div>
													<div class="deals_timer_unit">
														<div id="deals_timer1_min" class="deals_timer_min"></div>
														<span>mins</span>
													</div>
													<div class="deals_timer_unit">
														<div id="deals_timer1_sec" class="deals_timer_sec"></div>
														<span>secs</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>



							</div>

						</div>

						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>

					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active sliderTab">Featured</li>
									<li class="sliderTab">On Sale</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">

									<?php
										$this->load->view('template/product_gridViewFeatured',$dataProductFeatured);
									 ?>


								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- Product Panel -->

							<div class="product_panel panel">
								<div class="featured_slider slider">
									<?php
										$this->load->view('template/product_gridViewFeatured',$dataProductSale);
									 ?>
								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>


						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Popular Categories -->

	<div class="popular_categories" style="background-color:white !important">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<div class="popular_categories_title">Kategori Terpopuler</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<div class="popular_categories_link"><a href="<?php echo base_url();?>assets/#">full catalog</a></div>
					</div>
				</div>

				<!-- Popular Categories Slider -->

				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<div class="owl-carousel owl-theme popular_categories_slider">

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/logs.png" alt=""></div>
									<div class="popular_category_text">Kayu Bulat</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/silk.png" alt=""></div>
									<div class="popular_category_text">Sutra</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/rice.png" alt=""></div>
									<div class="popular_category_text">Beras</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/corn.png" alt=""></div>
									<div class="popular_category_text">Jagung</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/coffee.png" alt=""></div>
									<div class="popular_category_text">Kopi</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/clove.png" alt=""></div>
									<div class="popular_category_text">Cengkeh</div>
								</div>
							</div>



							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/cow.png" alt=""></div>
									<div class="popular_category_text">Sapi</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo base_url();?>assets/images/category/hen.png" alt=""></div>
									<div class="popular_category_text">Ayam</div>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="characteristics" style="background-color:white !important;padding-top:0px;">
		<div class="container">
			<div class="row">

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="<?php echo base_url();?>assets/images/icon-img/refresh-button.png" alt="" style="height:30px"></div>
						<div class="char_content">
							<div class="char_title">Sustainable</div>
							<div class="char_subtitle">Tersedia 10000+ produk</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="<?php echo base_url();?>assets/images/icon-img/phone.png" alt="" style="height:30px"></div>
						<div class="char_content">
							<div class="char_title">Technology</div>
							<div class="char_subtitle">Aplikasi multiplatform </div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="<?php echo base_url();?>assets/images/icon-img/tag.png" alt="" style="height:30px"></div>
						<div class="char_content">
							<div class="char_title">Innovation</div>
							<div class="char_subtitle">Transaksi menjadi mudah</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="<?php echo base_url();?>assets/images/icon-img/shipped.png" alt="" style="height:50px"></div>
						<div class="char_content">
							<div class="char_title">Logistic</div>
							<div class="char_subtitle">Tersedia 20+ kurir</div>
						</div>
					</div>
				</div>






			</div>
		</div>
	</div>

	<!-- Banner -->

	<div class="banner_2">
		<div class="banner_2_background" style="background-image:url(<?php echo base_url();?>assets/images/bg-img/bg-03.jpg)"></div>
		<div class="banner_2_container">
			<div class="banner_2_dots"></div>
			<!-- Banner 2 Slider -->

			<div class="owl-carousel owl-theme banner_2_slider">

				<!-- Banner 2 Slider Item -->
				<div class="owl-item">
					<div class="banner_2_item">
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col-lg-4 col-md-6 fill_height">
									<div class="banner_2_content">
										<div class="banner_2_category">Hasil Olahan</div>
										<div class="banner_2_title">Madu Kualitas Super</div>
										<div class="banner_2_text">Madu ini sangat berkualitas karena dihasilkan oleh Hachi yg sedang mencari ibunya.</div>
										<div class="rating_r rating_r_5 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="button banner_2_button"><a href="<?php echo base_url();?>assets/#">Lihat Produk</a></div>
									</div>

								</div>
								<div class="col-lg-8 col-md-6 fill_height">
									<div class="banner_2_image_container">
										<div class="banner_2_image"><img src="<?php echo base_url();?>assets/images/product/stil/honey.png" alt=""></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Banner 2 Slider Item -->
				<div class="owl-item">
					<div class="banner_2_item">
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col-lg-4 col-md-6 fill_height">
									<div class="banner_2_content">
										<div class="banner_2_category">Hasil Olahan</div>
										<div class="banner_2_title">Kopi Luwak</div>
										<div class="banner_2_text">Kopi Luwak STIL sangat menyehatkan, tidak bikin kembung seperti LUWAK WHITE COFFEE.</div>
										<div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="button banner_2_button"><a href="<?php echo base_url();?>assets/#">Lihat Produk</a></div>
									</div>

								</div>
								<div class="col-lg-8 col-md-6 fill_height">
									<div class="banner_2_image_container">
										<div class="banner_2_image"><img src="<?php echo base_url();?>assets/images/product/stil/luwak.png" alt=""></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Modal: modalQuickView -->
	<div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">

	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <img height="30px" src="<?php echo base_url();?>assets/images/logoNameLandscape.png">
	      <button data-dismiss="modal" class="close" style="cursor:pointer;">×</button>
	    </div>
	    <div class="modal-body" id="quickviewItem">

	    </div>
	  </div>
	</div>
	</div>
