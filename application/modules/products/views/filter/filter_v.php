	<!-- Shop -->
	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Kategori</div>
							<div id="kategori">
								<ol class="dd-list">
									<li class="dd-item">
										<div class="dd-handle <?php if($data_search['category']==''){echo "dd-active";}?>"><a href="<?php echo base_url();?>products<?php echo $searchVariable;?>">Semua Kategori (<?php echo $this->productModel->countProductbyCategory('all-0',$searchVariable,$data_search); ?>)</a></div>
									</li>
									<?php
                      $mainMenu=$this->db->query("SELECT id,name,is_parent FROM productcategory_main WHERE is_deleted=0 ORDER BY order_pos ASC")->result_array();
                      foreach($mainMenu as $mainItem){ ?>
												<li class="dd-item">
													<div class="dd-handle <?php if(in_array('m-'.$mainItem['id'],$data_search['activeMenu'])){echo "dd-active";}?>"><a href="<?php echo base_url();?>c/<?php echo 'm-'.$mainItem['id'];?><?php echo $searchVariable;?>" style=""><?php echo $mainItem['name'];?> (<?php echo $this->productModel->countProductbyCategory('m-'.$mainItem['id'],$searchVariable,$data_search); ?>)</a>
														<?php if($mainItem['is_parent']==1){ if(in_array('m-'.$mainItem['id'],$data_search['activeMenu'])){echo '&nbsp;<i class="fas fa-chevron-down pointerhand"></i>';}else{echo'&nbsp;<i class="fas fa-chevron-right pointerhand"></i>';}}?></div>
                          <?php if($mainItem['is_parent']==1){ ?>
                            <ol class="dd-list" style="display:<?php if(in_array('m-'.$mainItem['id'],$data_search['activeMenu'])){echo 'block';}else{echo 'none';}?>">
                            <?php
                              $subMenu=$this->db->query("SELECT id,name,is_parent FROM productcategory_sub where id_parent=$mainItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
                              foreach($subMenu as $subItem){ ?>
																	<li class="dd-item">
																		<div class="dd-handle <?php if(in_array('s-'.$subItem['id'],$data_search['activeMenu'])){echo "dd-active";}?>"><a href="<?php echo base_url();?>c/<?php echo 's-'.$subItem['id']; ?><?php echo $searchVariable;?>"><?php echo $subItem['name']; ?> (<?php echo $this->productModel->countProductbyCategory('s-'.$subItem['id'],$searchVariable,$data_search); ?>)</a>
																			<?php if($subItem['is_parent']==1){ if(in_array('s-'.$subItem['id'],$data_search['activeMenu'])){echo '&nbsp;<i class="fas fa-chevron-down pointerhand"></i>';}else{echo'&nbsp;<i class="fas fa-chevron-right pointerhand"></i>';}}?></div>
                                <?php if($subItem['is_parent']==1){ ?>
          												<ol class="dd-list" style="display:<?php if(in_array('s-'.$subItem['id'],$data_search['activeMenu'])){echo 'block';}else{echo 'none';}?>">
                                    <?php
                                    $subprMenu=$this->db->query("SELECT id,name FROM productcategory_subofsubs where id_parent=$subItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
                                    foreach($subprMenu as $subprItem){ ?>
																			<li class="dd-item">
																				<div class="dd-handle <?php if(in_array('p-'.$subprItem['id'],$data_search['activeMenu'])){echo "dd-active";}?>"><a href="<?php echo base_url();?>c/<?php echo 'p-'.$subprItem['id']; ?><?php echo $searchVariable;?>"><?php echo $subprItem['name']; ?> (<?php echo $this->productModel->countProductbyCategory('p-'.$subprItem['id'],$searchVariable,$data_search); ?>)</a></div>
																			</li>
                                    <?php } ?>
          												</ol>
                                <?php } ?>
        												</li>
                              <?php } ?>

        										</ol>

                          <?php } ?>
												</li>

                <?php } ?>
								</ol>
							</div>
						</div>
						<hr>
						<br>
						<div class="sidebar_title">Filter</div>
						<form method="get" action="">
						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Lokasi Penjual</div>
							<div class="form-group" style="margin-bottom:5px">
						   <select name="search_province" id="provinsi" class="form-control select2">
						    <option value="">- Pilih Provinsi -</option>
						   </select>
						 </div>
							<div class="form-group" style="display:none;" id="kotakon">
							 <select name="search_city" id="kota" class="form-control select2" >
						    <option value="">- Pilih Kota -</option>
						   </select>
						 </div>
						</div>

						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Rentang Harga</div>
							<div class="form-group" style="margin-bottom:5px">
						   <input name="search_price_min" class="form-control" placeholder="Minimum" value="<?php echo $data_search['price_min']; ?>" style="height:28px;font-size:14px;padding-left:10px;">
						 </div>
							<div class="form-group" style="margin-bottom:5px">
							 <input name="search_price_max" class="form-control" placeholder="Maksimum" value="<?php echo $data_search['price_max']; ?>" style="height:28px;font-size:14px;padding-left:10px;">
						 </div>
							<div class="checkbox">
							  <label style="margin-bottom:0px;"><input name="search_is_discount" type="checkbox" value="1" <?php if($data_search['is_discount']==1){echo "checked";} ?>>&nbsp;Diskon</label>
							</div>
							<div class="checkbox">
							  <label style="margin-bottom:0px;"><input name="search_is_wholesale" type="checkbox" value="1" <?php if($data_search['is_wholesale']==1){echo "checked";} ?>>&nbsp;Grosir</label>
							</div>
						</div>

						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Kondisi Barang</div>
							<div class="checkbox">
							  <label style="margin-bottom:0px;"><input name="search_is_condition_new" type="hidden" value="0"><input name="search_is_condition_new" type="checkbox" value="1" <?php if($data_search['is_condition_new']==1){echo "checked";} ?>>&nbsp;Baru</label>
							</div>
							<div class="checkbox">
							  <label><input name="search_is_condition_second" type="hidden" value="0"><input name="search_is_condition_second" type="checkbox" value="1" <?php if($data_search['is_condition_second']==1){echo "checked";} ?>>&nbsp;Bekas</label>
							</div>
						</div>

						<button type="submit" class="btn btn-primary btn-sm" style="cursor:pointer;width:auto;background-color:#009245;border-color:#009245">Perbarui Filter</button>
						</form>
					</div>

				</div>

				<div class="col-lg-9">
						<?php
							$this->load->view('template/product_gridView');
						 ?>
				</div>
			</div>
		</div>
	</div>

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
