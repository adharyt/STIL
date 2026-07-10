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
					<div class="sidebar_title" >Filter</div>
					<input type="hidden" id="search_keyword" value="<?php $data_search['keyword'];?>">
					<div class="sidebar_section" style="margin-top:-15px">
						<div class="sidebar_subtitle brands_subtitle" style="margin-bottom:10px">Lokasi Penjual</div>
						<div class="form-group" style="margin-bottom:0px">
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
						<div class="sidebar_subtitle brands_subtitle" style="margin-top:25px;">Jasa Pengiriman</div>
						<?php

						$selected_courier=explode(',',$data_search['courier']);
						foreach($couriers as $courier){ ?>
						<div class="containers">
							<label style="margin-bottom:0px; cursor:pointer;"><input name="courier" type="checkbox" value="<?php echo $courier['id'];?>"
								<?php
								if(in_array('all',$selected_courier) || in_array($courier['id'],$selected_courier)){
									echo "checked";
								}
								?>> &nbsp;<?php echo $courier['service_name'];?>
								<span class="checkmark"></span>
							</label>
						</div>
						<?php } ?>
					</div>

					<div class="sidebar_section">
						<div class="sidebar_subtitle brands_subtitle" style="margin-bottom:10px">Rentang Harga</div>
						<div class="form-group input-group" style="margin-bottom:5px">
                <span class="input-group-addon" style="height:28px">Rp</span>
						 <input name="search_price_min" class="form-control" placeholder="Minimum" value="<?php echo $this->numberingModel->integerSeparation('.',0,$data_search['price_min']); ?>" style="height:28px;font-size:14px;padding-left:10px;" onkeydown="return numbersonly(this, event);" onkeyup="javascript:custom_number_format(this,'rupiah');">
					 </div>
					 <div class="form-group input-group" style="margin-bottom:5px">
							 <span class="input-group-addon" style="height:28px">Rp</span>
						 <input name="search_price_max" class="form-control" placeholder="Maksimum" value="<?php echo $this->numberingModel->integerSeparation('.',0,$data_search['price_max']); ?>" style="height:28px;font-size:14px;padding-left:10px;" onkeydown="return numbersonly(this, event);" onkeyup="javascript:custom_number_format(this,'rupiah');">
					 </div>
						<div class="containers" style="margin-top:25px;">
							<label style="margin-bottom:0px; cursor:pointer;"><input name="search_is_discount" type="checkbox" value="1" <?php if($data_search['is_discount']==1){echo "checked";} ?>>&nbsp;Hanya tampilkan barang diskon
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="containers">
							<label style="margin-bottom:0px; cursor:pointer;"><input name="search_is_wholesale" type="checkbox" value="1" <?php if($data_search['is_wholesale']==1){echo "checked";} ?>>&nbsp;Hanya tampilkan barang grosir
								<span class="checkmark"></span>
							</label>
						</div>
					</div>

					<!--
					<div class="sidebar_section">
						<div class="sidebar_subtitle brands_subtitle">Kondisi Barang</div>
						<div class="checkbox">
							<label style="margin-bottom:0px;"><input name="search_is_condition_new" type="hidden" value="0"><input name="search_is_condition_new" type="checkbox" value="1" <?php if($data_search['is_condition_new']==1){echo "checked";} ?>>&nbsp;Baru</label>
						</div>
						<div class="checkbox">
							<label><input name="search_is_condition_second" type="hidden" value="0"><input name="search_is_condition_second" type="checkbox" value="1" <?php if($data_search['is_condition_second']==1){echo "checked";} ?>>&nbsp;Bekas</label>
						</div>
					</div>
				-->

					<div class="sidebar_section">
						<div class="sidebar_subtitle brands_subtitle">Minimum Rating</div>
						<div class="slidecontainer">
							<input type="range" min="0" max="5" name="search_minimum_rating" value="<?php echo $data_search['search_minimum_rating'];?>" class="slider" id="myRange"
							style="background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, color-stop(<?php echo $data_search['search_minimum_rating']/5;?>, rgb(77, 179, 125)), color-stop(<?php echo $data_search['search_minimum_rating']/5;?>, rgb(211, 211, 219)));"
							>
						</div>
						<div class="container" style="margin-left:15px; margin-top:10px; margin-bottom:10px;">
						<div class="radio">
								<label><input style="display:none;" type="radio"  value="5" <?php if($data_search['search_minimum_rating']==5){echo "checked";} ?>>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
								</label>
						</div>
						<div class="radio">
								<label><input style="display:none;" type="radio"  value="4" <?php if($data_search['search_minimum_rating']==4){echo "checked";} ?>>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: grey"></span>
								</label>
						</div>
						<div class="radio">
								<label><input style="display:none;" type="radio"  value="3" <?php if($data_search['search_minimum_rating']==3){echo "checked";} ?>>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: grey"></span>
									<span class="fa fa-star" style="color: grey"></span>
								</label>
						</div>
						<div class="radio">
								<label><input style="display:none;" type="radio"  value="2"  <?php if($data_search['search_minimum_rating']==2){echo "checked";} ?>>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: grey"></span>
									<span class="fa fa-star" style="color: grey"></span>
									<span class="fa fa-star" style="color: grey"></span>
								</label>
						</div>
						<div class="radio">
								<label><input style="display:none;" type="radio"  value="1" <?php if($data_search['search_minimum_rating']==1){echo "checked";} ?>>
									<span class="fa fa-star" style="color: orange"></span>
									<span class="fa fa-star" style="color: grey"></span>
									<span class="fa fa-star" style="color: grey"></span>
									<span class="fa fa-star" style="color: grey"></span>
									<span class="fa fa-star" style="color: grey"></span>
								</label>
						</div>
						<div class="radio">
								<label><input style="display:none;" type="radio"  value="0" <?php if($data_search['search_minimum_rating']==0){echo "checked";} ?> >
									Semua Rating
								</label>
						</div>
					</div>
				</div>



					<button type="button" onClick="setFilter();" class="btn btn-primary btn-sm" style="cursor:pointer;width:auto;background-color:#009245;border-color:#009245;border-radius:0px;">Perbarui Filter</button>

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
