<?php if($cekProduk=='y'){ ?>
	<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
		<div class="title-text"><i class="fa fa-archive m-0"></i> Edit Produk</div>
		<br>
<input type="hidden" id="id_product" value="<?php echo $product['product_id'];?>"/>
<div class="row">
	<div class="col-12">
	   	<div>
			<div class="container">
				<div class="card">
					<div class="card-header" style="background-color:#009245;color:white;">
						Gambar Produk
					</div>
					<div class="card-body">
						<div class="container" id="img_container">
							<?php $this->load->view('userProductEdit/template_image',$product_image);?>
						</div>

						<div class="form-group" style="display:none">
							<label>Link Video Youtube (opsional)</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" style="border-right:0px;"><i style="font-size:25px" class="fab fa-youtube"></i></span>
								</div>
								<input onChange="recorrection();" onKeyUp="recorrection();" id="video_produk" name="video_produk" type="text" class="form-control" placeholder="youtube.com/watch?v=yourVideoUrl">
							</div>
							<small id="notif_video_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_video_produk_text"></span><br>&nbsp;</small>
						</div>
					</div>
				</div>
         	</div>
       	</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-12">
	   	<div style="margin-bottom:20px">
			<div class="container">
					 <div class="card">
				 			<div class="card-header" style="background-color:#009245;color:white;">
				 				Informasi Produk
				 			</div>
				 			<div class="card-body">
								<!-- Nama Produk -->
								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Nama Produk<font color="red">*</font></label>
							    <div class="col-sm-9">
							      <input onChange="recorrection();" onKeyUp="recorrection();" type="text" class="form-control" id="nama_produk"  name="nama_produk" style="max-width:500px" value="<?php echo $product['pr_name'];?>">
										<small class="form-text text-muted">Nama produk masih dapat diubah selama barang belum masuk transaksi.</small>
										<small id="notif_nama_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_nama_produk_text"></span><br>&nbsp;</small>
									</div>
							  </div>
								<!-- Stock Keeping Unit -->
								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Stock Keeping Unit</label>
							    <div class="col-sm-9">
							      <input onChange="recorrection();" onKeyUp="recorrection();" type="text" class="form-control" id="sku_produk"  name="sku_produk" style="max-width:500px" value="<?php echo $product['pr_sku'];?>">
										<small class="form-text text-muted">SKU (Stock Keeping Unit) adalah nomor unik pada produk untuk mempermudah pengaturan stock.</small>
										<small id="notif_sku_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_sku_produk_text"></span><br>&nbsp;</small>
									</div>
							  </div>
								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Kategori Produk<font color="red">*</font></label>
							    <div class="col-sm-9">
										<div class="cat_menu_container" style="width:500px;padding-left:0px;height:20px;background:#FFFFFF">
											<?php
											$node_ex=explode("-",$product['id_category']);
											$category_cat=$node_ex[0];
											$category_id=$node_ex[1];


											 ?>
											<input readonly type="text" value="<?php echo $this->productModel->getCategoryName($category_cat,$category_id);?>" class="form-control" id="kategori_produk"  name="kategori_produk" style="background-color:#FFFFFF;max-width:500px">
											<input readonly type="hidden" value="<?php echo $product['id_category'];?>" class="form-control" id="kategori_produk_id"  name="kategori_produk_id" style="background-color:#FFFFFF;max-width:500px">
											<small class="form-text text-muted">Kategori Produk mempermudah produk yang kamu untuk ditemukan oleh pembeli.</small>
											<ul class="cat_menu" style="top:40px">
			                  <?php
			                      $mainMenu=$this->db->query("SELECT id,name,is_parent FROM productcategory_main WHERE is_deleted=0 ORDER BY order_pos ASC")->result_array();
			                      foreach($mainMenu as $mainItem){ ?>
			                        <li <?php if($mainItem['is_parent']==0){echo "onClick=categorySelect('m-".$mainItem['id']."')";}?>  style="width:166.7px;padding-left:10px;padding-right:5px" <?php if($mainItem['is_parent']==1){echo "class='hassubs'";}?>>
			      										<a style="font-size:12px" href="javascript:void(0);"><?php echo $mainItem['name'];?><i class="fas fa-chevron-right"></i></a>
			                          <?php if($mainItem['is_parent']==1){ ?>
			                            <ul>
			                            <?php
			                              $subMenu=$this->db->query("SELECT id,name,is_parent FROM productcategory_sub where id_parent=$mainItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
			                              foreach($subMenu as $subItem){ ?>
			        											<li <?php if($subItem['is_parent']==0){echo "onClick=categorySelect('s-".$subItem['id']."')";}?> style="width:166.7px;padding-left:10px;padding-right:5px" <?php if($subItem['is_parent']==1){echo "class='hassubs'";}?>>
			        												<a style="font-size:12px" href="javascript:void(0);"><?php echo $subItem['name']; ?><i class="fas fa-chevron-right"></i></a>
			                                <?php if($subItem['is_parent']==1){ ?>
			          												<ul>
			                                    <?php
			                                    $subprMenu=$this->db->query("SELECT id,name FROM productcategory_subofsubs where id_parent=$subItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
			                                    foreach($subprMenu as $subprItem){ ?>
			          													<li onClick="categorySelect('p-<?php echo $subprItem['id'];?>')" style="width:166.7px;padding-left:10px;padding-right:5px"><a style="font-size:12px" href="javascript:void(0);"><?php echo $subprItem['name']; ?><i class="fas fa-chevron-right"></i></a></li>
			                                    <?php } ?>
			          												</ul>
			                                <?php } ?>
			        											</li>
			                              <?php } ?>

			        										</ul>

			                          <?php } ?>

			      									</li>

			                <?php } ?>
											</ul>
										</div>
										<br><br>
										<small id="notif_kategori_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_kategori_produk_text"></span><br>&nbsp;</small>
							    </div>
							  </div>
								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Etalase Produk</label>
							    <div class="col-sm-9" id="etalaseContainer">
										<input
												id="etalase"
										    type="text"
										    multiple
										    class="tagsInput"
										    value="<?php echo $this->sc_storefrontModel->getStorefrontByProductAoS($this->session->userdata('user_id'),$product['product_id']);?>"
										    data-initial-value='<?php echo $this->sc_storefrontModel->getStorefrontByProduct($this->session->userdata('user_id'),$product['product_id']);?>'
										    data-user-option-allowed="false"
										    data-url="<?php echo base_url();?>sc_storefront/getStorefrontJSON"
										    data-load-once="true"
										    name="etalase"

												/>
										<small class="form-text text-muted" style="margin-bottom:-5px;">Gunakan Etalase Produk untuk mengelompokan produk yang kamu jual agar lebih mudah ditemukan oleh pembeli.</small>
										<small class="form-text text-muted">Masukan produk ke etalase yang <a href=# style="color:#009245">sudah ada</a> atau <a href=# style="color:#009245">buat etalase baru</a>.</small>
										<small id="notif_etalase_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_etalase_produk_text"></span><br>&nbsp;</small>
							    </div>
							  </div>
								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Deskripsi Produk<font color="red">*</font></label>
							    <div class="col-sm-9">
										<textarea  onChange="recorrection();" onKeyUp="recorrection();" class="form-control" id="deskripsi_produk"  name="deskripsi_produk" style="max-width:500px" rows="5"><?php echo $product['pr_description'];?></textarea>
								    <small class="form-text text-muted">Deskripsikan produk secara lengkap & jelas. Rekomendasi panjang: <=2000 karakter.</small>
										<small id="notif_deskripsi_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_deskripsi_produk_text"></span><br>&nbsp;</small>
							    </div>
							  </div>
								<div class="form-group row">
							      <label class="col-sm-3">Sumber barang<font color="red">*</font></label>
							      <div class="col-sm-9">
							        <div class="form-check">
							          <input class="form-check-input" type="radio" name="sumber_produk" id="kondisi_lokal" value="0" <?php if($product['pr_source']=='0'){echo "checked";} ?>>
							          <label class="form-check-label">
							            Lokal
							          </label>
							        </div>
							        <div class="form-check">
							          <input class="form-check-input" type="radio" name="sumber_produk" id="kondisi_impor" value="1" <?php if($product['pr_source']=='1'){echo "checked";} ?>>
							          <label class="form-check-label">
							            Impor
							          </label>
							        </div>
											<small class="form-text text-muted">Opsi ini akan mempermudah customer ketika mencari produk sesuai dengan kebutuhannya.</small>
							      </div>
							  </div>
								<div class="form-group row" style="display:none">
							      <label class="col-sm-3">Kondisi barang<font color="red">*</font></label>
							      <div class="col-sm-9">
							        <div class="form-check">
							          <input class="form-check-input" type="radio" name="kondisi_produk" id="kondisi_baru" value="1" <?php if($product['pr_condition']=='1'){echo "checked";} ?>>
							          <label class="form-check-label">
							            Baru
							          </label>
							        </div>
							        <div class="form-check">
							          <input class="form-check-input" type="radio" name="kondisi_produk" id="kondisibekas" value="0" <?php if($product['pr_condition']=='0'){echo "checked";} ?>>
							          <label class="form-check-label">
							            Bekas
							          </label>
							        </div>
											<small class="form-text text-muted">Opsi ini akan mempermudah customer ketika mencari produk sesuai dengan kebutuhannya.</small>
							      </div>
							  </div>
								<!-- varian berdasarkan kategori<br>-->



								<hr style="background-color: #c5c5c5;">

								<div class="form-group row">
							      <label class="col-sm-3">Stock<font color="red">*</font></label>
							      <div class="col-sm-9">
							        <div class="form-check">
							          <input onChange="validation_stock();" class="form-check-input" type="radio" name="stock" id="stock_once" value="1" <?php if($product['stock_type']=='1'){echo "checked";} ?>>
							          <label class="form-check-label">
							            Hanya satu, tidak bisa restock
													<small class="form-text text-muted">Barang yang sudah berhasil terjual tidak akan bisa tampil ataupun diedit kembali. </small>
							          </label>
							        </div>
							        <div class="form-check">
							          <input onChange="validation_stock();" class="form-check-input" type="radio" name="stock" id="stock_limit" value="2" <?php if($product['stock_type']=='2'){echo "checked";} ?>>
							          <label class="form-check-label">
							            Stock terbatas
													<div class="input-group">
													  <input <?php if($product['stock_type']!='2'){echo "readonly";} ?> onChange="validation_stock();" onkeyup="validation_stock();" type="number" min="1" max="100000" class="form-control" id="stock_limit_val"  name="stock_limit_val" style="max-width:100px" value="<?php if($product['stock_type']=='2'){echo $product['stock'];} ?>">
													  <div class="input-group-append">
													    <span class="input-group-text" style="border-left:0px;">unit</span>
													  </div>
													</div>
													<small class="form-text text-muted">Jumlah stock dapat diatur untuk mencegah <a href=# style="color:#009245">pembatalan pembelian</a>.</small>
							          </label>

							        </div>
											<div class="form-check">
							          <input onChange="validation_stock();" class="form-check-input" type="radio" name="stock" id="stock_ready" value="3" <?php if($product['stock_type']=='3'){echo "checked";} ?>>
							          <label class="form-check-label">
							            Selalu tersedia
													<small class="form-text text-muted">Status stock akan selalu tersedia meskipun produk berhasil terjual.</small>
							          </label>
							        </div>
							      </div>
							  </div>
								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Pembelian minimum<font color="red">*</font></label>
							    <div class="col-sm-9">
										<div class="input-group">
											<input type="number" value="<?php echo $product['buy_minimum'];?>" min="1" max="100000" class="form-control" id="unit_min"  name="unit_min" style="max-width:100px" <?php if($product['stock_type']=='1'){echo "readonly";} ?>>
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">unit</span>
											</div>
										</div>
										<small class="form-text text-muted">Jumlah minimum yang harus dipesan untuk produk ini.</small>
							    </div>
							  </div>

								<hr style="background-color: #c5c5c5;">

								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Harga Produk<font color="red">*</font></label>
							    <div class="col-sm-9">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" style="border-right:0px;">Rp</span>
											</div>
											<input onkeyup="validation_grosir();recorrection();javascript:custom_number_format(this,'rupiah');" onkeydown="return numbersonly(this, event);" onchange="validation_grosir();recorrection();" type="text"   class="form-control" id="harga"  name="harga" style="max-width:200px" value="<?php echo $this->numberingModel->integerSeparation('.',0,$product['price']);?>">
										</div>
										<small class="form-text text-muted">Harga produk per-unit dalam rupiah</small>
										<small id="notif_harga_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_harga_produk_text"></span><br>&nbsp;</small>
							    </div>
							  </div>
								<div class="form-group row">
							      <label class="col-sm-3 ">Harga Grosir</label>
							      <div class="col-sm-9" style="vertical-align:top">
							       	<span id="grosir_status_text"><?php if($product['is_wholesale']==0){echo "Harga Grosir tidak diaktifkan.";}else{echo "Harga Grosir diaktifkan.";}?></span>&nbsp;&nbsp;&nbsp;<button onClick="toggle_grosir();" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i> <span id="grosir_button_text"><?php if($product['is_wholesale']==0){echo "Aktifkan Sekarang";}else{echo "Hapus Pengaturan";}?></id></button>
											<small class="form-text text-muted">Harga Grosir akan menentukan harga barang jika customer melakukan pembelian dalam jumlah tertentu.</small>
							      </div>
							  </div>
								<div class="form-group row" id="grosir_container" style="display:<?php if($product['is_wholesale']==0){echo 'none';}else{echo 'flex';}?>;">
								<input type="hidden" id="grosir_status" value="<?php if($product['is_wholesale']==0){echo "0";}else{echo "1";}?>">
							    <label class="col-sm-3 col-form-label"></label>
									<div class="col-sm-9">

										<!-- Grosir Start -->
										<div class="input-group" style="margin-bottom:5px">
											<i class="fas fa-greater-than-equal" style="margin-top:10px"></i>&nbsp;&nbsp;
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit1']!='' && $product['wh_price1']!='' && $product['wh_unit1']>0 && $product['wh_price1']>0){echo "value='$product[wh_unit1]'";}else{echo "readonly";}?> onkeyup="validation_grosir();" onchange="validation_grosir();" type="number" min="2" max="100000" class="form-control" id="grosir_unit1"  name="grosir_unit1" style="max-width:100px">
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">unit</span>
											</div>&nbsp;&nbsp;
											<i class="fas fa-equals" style="margin-top:10px"></i>&nbsp;&nbsp;
											<div class="input-group-prepend">
												<span class="input-group-text" style="border-right:0px;">Rp</span>
											</div>
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit1']!='' && $product['wh_price1']!='' && $product['wh_unit1']>0 && $product['wh_price1']>0){echo "value='".$this->numberingModel->integerSeparation('.',0,$product['wh_price1'])."'";}else{echo "readonly";}?> onkeyup="validation_grosir();javascript:custom_number_format(this,'rupiah');" onkeydown="return numbersonly(this, event);" onchange="validation_grosir();" type="text" class="form-control" id="grosir_harga1"  name="grosir_harga1" style="max-width:200px">
										</div>
										<small id="grosir_notif_1" class="form-text text-muted" style="padding-left:20px;color:red !important;display:none;">Harga grosir harus lebih murah dari Harga Satuan dan jumlah Unit Grosir harus lebih dari satu unit.<br>&nbsp;</small>
										<small id="grosir_notif_1h" class="form-text text-muted" style="padding-left:20px;color:red !important;display:none;">Harga Satuan harus diisi terlebih dahulu.<br>&nbsp;</small>
										<!-- Grosir End -->
										<!-- Grosir Start -->
										<div class="input-group" style="margin-bottom:5px">
											<i class="fas fa-greater-than-equal" style="margin-top:10px"></i>&nbsp;&nbsp;
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit2']!='' && $product['wh_price2']!='' && $product['wh_unit2']>0 && $product['wh_price2']>0){echo "value='$product[wh_unit2]'";}else{echo "readonly";}?> onkeyup="validation_grosir();" onchange="validation_grosir();"  type="number" min="1" max="100000" class="form-control" id="grosir_unit2"  name="grosir_unit2" style="max-width:100px">
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">unit</span>
											</div>&nbsp;&nbsp;
											<i class="fas fa-equals" style="margin-top:10px"></i>&nbsp;&nbsp;
											<div class="input-group-prepend">
												<span class="input-group-text" style="border-right:0px;">Rp</span>
											</div>
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit2']!='' && $product['wh_price2']!='' && $product['wh_unit2']>0 && $product['wh_price2']>0){echo "value='".$this->numberingModel->integerSeparation('.',0,$product['wh_price2'])."'";}else{echo "readonly";}?> onkeyup="validation_grosir();javascript:custom_number_format(this,'rupiah');" onkeydown="return numbersonly(this, event);" onchange="validation_grosir();"  type=textr" class="form-control" id="grosir_harga2"  name="grosir_harga2" style="max-width:200px">
										</div>
										<small id="grosir_notif_2" class="form-text text-muted" style="padding-left:20px;color:red !important;display:none;">Jumlah unit grosir produk harus lebih banyak dari jumlah unit grosir produk sebelumnya dan harga grosir produk harus lebih murah dari harga grosir produk sebelumnya.<br>&nbsp;</small>
										<!-- Grosir End -->
										<!-- Grosir Start -->
										<div class="input-group" style="margin-bottom:5px">
											<i class="fas fa-greater-than-equal" style="margin-top:10px"></i>&nbsp;&nbsp;
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit3']!='' && $product['wh_price3']!='' && $product['wh_unit3']>0 && $product['wh_price3']>0){echo "value='$product[wh_unit3]'";}else{echo "readonly";}?> onkeyup="validation_grosir();" onchange="validation_grosir();" type="number" min="1" max="100000" class="form-control" id="grosir_unit3"  name="grosir_unit3" style="max-width:100px">
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">unit</span>
											</div>&nbsp;&nbsp;
											<i class="fas fa-equals" style="margin-top:10px"></i>&nbsp;&nbsp;
											<div class="input-group-prepend">
												<span class="input-group-text" style="border-right:0px;">Rp</span>
											</div>
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit3']!='' && $product['wh_price3']!='' && $product['wh_unit3']>0 && $product['wh_price3']>0){echo "value='".$this->numberingModel->integerSeparation('.',0,$product['wh_price3'])."'";}else{echo "readonly";}?> onkeyup="validation_grosir();javascript:custom_number_format(this,'rupiah');" onkeydown="return numbersonly(this, event);" onchange="validation_grosir();" type="text" class="form-control" id="grosir_harga3"  name="grosir_harga3" style="max-width:200px">
										</div>
										<small id="grosir_notif_3" class="form-text text-muted" style="padding-left:20px;color:red !important;display:none;">Jumlah unit grosir produk harus lebih banyak dari jumlah unit grosir produk sebelumnya dan harga grosir produk harus lebih murah dari harga grosir produk sebelumnya.<br>&nbsp;</small>
										<!-- Grosir End -->
										<!-- Grosir Start -->
										<div class="input-group" style="margin-bottom:5px">
											<i class="fas fa-greater-than-equal" style="margin-top:10px"></i>&nbsp;&nbsp;
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit4']!='' && $product['wh_price4']!='' && $product['wh_unit4']>0 && $product['wh_price4']>0){echo "value='$product[wh_unit4]'";}else{echo "readonly";}?> onkeyup="validation_grosir();" onchange="validation_grosir();"  type="number" min="1" max="100000" class="form-control" id="grosir_unit4"  name="grosir_unit4" style="max-width:100px">
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">unit</span>
											</div>&nbsp;&nbsp;
											<i class="fas fa-equals" style="margin-top:10px"></i>&nbsp;&nbsp;
											<div class="input-group-prepend">
												<span class="input-group-text" style="border-right:0px;">Rp</span>
											</div>
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit4']!='' && $product['wh_price4']!='' && $product['wh_unit4']>0 && $product['wh_price4']>0){echo "value='".$this->numberingModel->integerSeparation('.',0,$product['wh_price4'])."'";}else{echo "readonly";}?> onkeyup="validation_grosir();javascript:custom_number_format(this,'rupiah');" onkeydown="return numbersonly(this, event);" onchange="validation_grosir();"  type=textr" class="form-control" id="grosir_harga4"  name="grosir_harga4" style="max-width:200px">
										</div>
										<small id="grosir_notif_4" class="form-text text-muted" style="padding-left:20px;color:red !important;display:none;">Jumlah unit grosir produk harus lebih banyak dari jumlah unit grosir produk sebelumnya dan harga grosir produk harus lebih murah dari harga grosir produk sebelumnya.<br>&nbsp;</small>
										<!-- Grosir End -->
										<!-- Grosir Start -->
										<div class="input-group" style="margin-bottom:5px">
											<i class="fas fa-greater-than-equal" style="margin-top:10px"></i>&nbsp;&nbsp;
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit5']!='' && $product['wh_price5']!='' && $product['wh_unit5']>0 && $product['wh_price5']>0){echo "value='$product[wh_unit5]'";}else{echo "readonly";}?> onkeyup="validation_grosir();" onchange="validation_grosir();" type="number" min="1" max="100000" class="form-control" id="grosir_unit5"  name="grosir_unit5" style="max-width:100px">
											<div class="input-group-append">
												<span class="input-group-text" style="border-left:0px;">unit</span>
											</div>&nbsp;&nbsp;
											<i class="fas fa-equals" style="margin-top:10px"></i>&nbsp;&nbsp;
											<div class="input-group-prepend">
												<span class="input-group-text" style="border-right:0px;">Rp</span>
											</div>
											<input <?php if($product['is_wholesale']==1 && $product['wh_unit5']!='' && $product['wh_price5']!='' && $product['wh_unit5']>0 && $product['wh_price5']>0){echo "value='".$this->numberingModel->integerSeparation('.',0,$product['wh_price5'])."'";}else{echo "readonly";}?> onkeyup="validation_grosir();javascript:custom_number_format(this,'rupiah');" onkeydown="return numbersonly(this, event);" onchange="validation_grosir();" type="text" class="form-control" id="grosir_harga5"  name="grosir_harga5" style="max-width:200px">
										</div>
										<small id="grosir_notif_5" class="form-text text-muted" style="padding-left:20px;color:red !important;display:none;">Jumlah unit grosir produk harus lebih banyak dari jumlah unit grosir produk sebelumnya dan harga grosir produk harus lebih murah dari harga grosir produk sebelumnya.<br>&nbsp;</small>
										<!-- Grosir End -->
										<small class="form-text text-muted">Tambahkan Harga Grosir untuk pembelian produk dalam jumlah tertentu (maksimal 5)</small>

							    </div>
							  </div>
								<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Berat Produk<font color="red">*</font></label>
							    <div class="col-sm-9">
										<div class="input-group">
											<input onChange="recorrection();" onkeyup="recorrection();javascript:custom_number_format(this,'rupiah');"  onkeydown="return numbersonly(this, event);" type="text" class="form-control" id="weight"  name="weight" style="max-width:170px" value="<?php echo $this->numberingModel->integerSeparation('.',0,$product['weight']);?>">
										  <select id="weight_type" class="form-control" style="-webkit-appearance: menulist;max-width:125px;margin-left:-3px;background-color:#e9ecef;color:#495057">
										    <option value="g">Gram (g)</option>
										    <option value="kg">Kilogram (kg)</option>
												<option value="ton">Ton</option>
										  </select>
										</div>
										<small class="form-text text-muted">Berat barang diperlukan untuk estimasi ongkos kirim. <br>Produk ringan dengan ukuran yang besar hitung dengan <a data-toggle="modal" data-target="#weightModal" href="javascript:void(0);" style="color:#009245">Volume Weight</a>.</small>
										<small id="notif_berat_produk" class="form-text text-muted" style="color:red !important;display:none;"><span id="notif_berat_produk_text"></span><br>&nbsp;</small>
									</div>
							  </div>
								<!-- Modal Berat Start -->
								<div id="weightModal" class="modal fade" role="dialog">
									<div class="modal-dialog modal-dialog-centered" role="document" style="max-width:600px;display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;min-height: calc(90% - (.5rem * 2));">
										<!-- konten modal-->
										<div class="modal-content">
											<!-- heading modal -->
											<div class="modal-header">
												<h4 class="modal-title">Perhitungan berat volumetrik</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<!-- body modal -->
											<div class="modal-body" style="padding:30px">
												<p>Bila hitungan berat volumetrik lebih berat dari berat aktual, maka biaya kirim akan dihitung berdasarkan hitungan berat volumetrik.</p>
												<p>Rumus perhitungan berat volumetrik adalah:<br>
												<b>(P×L×T) ÷ (6000) × 1000 gram</b></p>
												<br>
												<div class="row">
													<div class="col-4">
														<div class="input-group">
															<input onChange="eVolumetricW();" onKeyUp="eVolumetricW();" id="ev_panjang"placeholder="Panjang" type="number" min="1" max="100000" class="form-control" style="max-width:100px">
															<div class="input-group-append">
																<span class="input-group-text" style="border-left:0px;">cm</span>
															</div>
														</div>
													</div>

													<div class="col-4">
														<div class="input-group">
															<input onChange="eVolumetricW();" onKeyUp="eVolumetricW();" id="ev_lebar"placeholder="Lebar" type="number" min="1" max="100000" class="form-control" style="max-width:100px">
															<div class="input-group-append">
																<span class="input-group-text" style="border-left:0px;">cm</span>
															</div>
														</div>
													</div>

													<div class="col-4">
														<div class="input-group">
															<input onChange="eVolumetricW();" onKeyUp="eVolumetricW();" id="ev_tinggi" placeholder="Tinggi" type="number" min="1" max="100000" class="form-control" style="max-width:100px">
															<div class="input-group-append">
																<span class="input-group-text" style="border-left:0px;">cm</span>
															</div>
														</div>
													</div>
												</div>
												<br><br>
												<center>
													<h3>Berat Volumetrik</h3>
													<h1><span id="ev_value">0</span> <small>gram</small></h1>
												</center>
												<br>
												<div class="form-group row">
											      <div class="col-sm-12 text-center">
											        <a href="javascript:void(0);"><button  disabled id="ev_button" type="button" class="btn btn-primary pull-right" style="background-color:#009245;border-color:#009245" onClick="eVolumetricE();">Gunakan Estimasi Ini</button></a>
														</div>
											  </div>


											</div>
										</div>
									</div>
								</div>
								<!-- Modal Berat End -->
								<hr style="background-color: #c5c5c5;">
								<div class="form-group row">
							      <label class="col-sm-3 ">Waktu Proses Pesanan</label>
							      <div class="col-sm-9" style="vertical-align:top">
											<input type="hidden" value="<?php if($product['is_processtime_set']==1){echo '1';}else{'0';}?>" id="processtime_status">
							       	<span id="processtime_status_text"><?php if($product['is_processtime_set']==1){echo "Waktu proses pesanan (hanya untuk produk ini).";}else{ ?>Waktu proses pesanan tidak diatur (mengikuti <a href=# style="color:#009245">pengaturan default</a>).<?php } ?></span>&nbsp;&nbsp;&nbsp;<button onClick="toggle_processtime();" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i> <span id="processtime_button_text"><?php if($product['is_processtime_set']==1){echo "Hapus Pengaturan";}else{echo "Atur Sekarang";}?></span></button>
											<small class="form-text text-muted">Rentang waktu dari pesanan diterima sampai kamu memasukan resi ke sistem STIL (hanya berlaku untuk barang ini).</small>
							      </div>
							  </div>
								<div class="form-group row" id="processtime_default" style="<?php if($product['is_processtime_set']==1){echo 'display:none';}else{echo 'display:flex';}?>">
										<label class="col-sm-3 "></label>
										 <div class="col-sm-9" style="vertical-align:top;padding-left:30px">
											 <div class="row" style="border:1px solid #ddd;padding:25px;display:block;margin-right:20px">
 													<?php
															$processtime_default=$storeDefault['store_processtime_id'];
															switch($processtime_default){
																case '1':
																	$processtime_selected='
																		Waktu proses pesanan mengikuti pengaturan default toko:
																		<ul style="list-style-type: circle;margin-left:20px">
																			<li>Reguler dan Next day: <b>'.$storeDefault["store_processtime_instan"].' jam kerja</b></li>
																			<li>Sameday service: 1x24 jam</li>
																		</ul>
																	';
																	break;
															  case '2':
																  $processtime_selected='
																	  Waktu proses pesanan mengikuti pengaturan default toko:
																	  <ul style="list-style-type: circle;margin-left:20px">
																		  <li>Reguler: 2 hari kerja</li>
																			<li>Next day: 2x24 jam</li>
																		  <li>Sameday service: 1x24 jam</li>
																	  </ul>
																  ';
																	break;
																case '3':
																	$processtime_selected='
																		Waktu proses pesanan mengikuti pengaturan di toko:&nbsp;<b> '.$storeDefault["store_processtime_preorder"].' hari kerja</b>
																	';
																	break;
																default:
																	 $processtime_selected='
																		 Waktu proses pesanan mengikuti pengaturan default toko:
																		 <ul style="list-style-type: circle;margin-left:20px">
 																			<li>Reguler dan Next day: <b>'.$storeDefault["store_processtime_preorder"].' hari</b></li>
 																			<li>Sameday service: 1x24 jam</li>
 																		</ul>
																	 ';
																	break;
																}
															echo "$processtime_selected";
													 ?>
 											</div>
										 </div>
								</div>
								<div class="form-group row" id="processtime_custom" style="<?php if($product['is_processtime_set']==0){echo 'display:none';}else{'display:flex';}?>">
							      <label class="col-sm-3 "></label>
							      <div class="col-sm-9" style="vertical-align:top;padding-left:30px">
											<div class="row" style="border:1px solid #ddd;">
												<div class="col-4">
													<div id="bul_instan" class="row" <?php if($product['is_processtime_set']==1 && $product['processtime_id']==1){echo 'style="height:33.333%;padding:20px;border-top:0px solid #ddd;border-bottom:-px solid #ddd;"';}else{echo 'style="height:33.333%;padding:20px;background-color:#fafafa"';}?>>
														<div class="form-check" style="vertical-align:middle">
										          <input onChange="validation_processtime();" class="form-check-input" type="radio" name="waktu_proses" id="wp_instan" value="1" <?php if(($product['processtime_id']!=2 && $product['processtime_id']!=3) || $product['is_processtime_set']==0){echo "checked";}?>>
										          <label class="form-check-label" style="font-weight:bold">
										            Instan
										          </label>
															<small class="form-text text-muted">Kurang dari 1 hari kerja</small>
										        </div>
													</div>
													<div id="bul_reguler" class="row" <?php if($product['is_processtime_set']==1 && $product['processtime_id']==2){echo 'style="height:33.333%;padding:20px;border-top:1px solid #ddd;border-bottom:1px solid #ddd;"';}else{echo 'style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;height:33.333%;padding:20px;background-color:#fafafa"';}?>>
															<div class="form-check" style="vertical-align:middle">
											          <input onChange="validation_processtime();" class="form-check-input" type="radio" name="waktu_proses" id="wp_reguler" value="2" <?php if($product['is_processtime_set']==1 && $product['processtime_id']==2){echo "checked";}?>>
											          <label class="form-check-label" style="font-weight:bold">
											            Reguler
											          </label>
																<small class="form-text text-muted">Maksimum 2 hari kerja</small>
											        </div>
													</div>
													<div id="bul_preorder" class="row" <?php if($product['is_processtime_set']==1 && $product['processtime_id']==3){echo 'style="height:33.333%;padding:20px;border-top:1px solid #ddd;border-bottom:0px solid #ddd;"';}else{echo 'style="height:33.333%;padding:20px;background-color:#fafafa"';}?>>
															<div class="form-check" style="vertical-align:middle">
											          <input onChange="validation_processtime();" class="form-check-input" type="radio" name="waktu_proses" id="wp_preorder" value="3" <?php if($product['is_processtime_set']==1 && $product['processtime_id']==3){echo "checked";}?>>
											          <label class="form-check-label" style="font-weight:bold">
											            Pre-order
											          </label>
																<small class="form-text text-muted">Lebih dari 2 hari kerja</small>
											        </div>
													</div>
												</div>
												<!-- item -->
												<div class="col-8" style="display:<?php if($product['is_processtime_set']==1 && $product['processtime_id']==1){echo 'block';}else{echo 'none';}?>;padding:20px;padding-top:2%;" id="con_instan">
													Dikirim dalam
													<div class="input-group">
													  <input onChange="validation_processtime_val();" type="number" value="<?php if($product['is_processtime_set']==1 && $product['processtime_id']==1){echo $product['processtime_instan'];}else{echo '8';}?>" min="1" max="8" class="form-control" id="processtime_instan"  name="processtime_instan" style="max-width:60px">
													  <div class="input-group-append">
													    <span class="input-group-text" style="border-left:0px;">jam kerja</span>
													  </div><span class="input-group-text" style="border:0px;background-color:white;font-size:12px;color:#aeaeae">Maksimum 8 jam kerja</span>
													</div>
													<br>
													<div class="card" style="padding:20px">
														<div class="row">
															<div class="col-3">
																	<img width="100%" src="<?php echo base_url();?>assets/images/icon-img/processtime_instant.png"/>
															</div>
															<div class="col-9" style="font-size:12px">
																	Batas waktu maksimum pengiriman pesanan:
																	<ul style="list-style-type: circle;margin-left:20px">
																		<li>Sameday service: 1x24 jam</li>
																		<li>Next day: <span class="time_instan_text"><?php if($product['is_processtime_set']==1 && $product['processtime_id']==1){echo $product['processtime_instan'];}else{echo '8';}?></span> jam</li>
																		<li>Reguler: <span class="time_instan_text"><?php if($product['is_processtime_set']==1 && $product['processtime_id']==1){echo $product['processtime_instan'];}else{echo '8';}?></span> jam</li>
																	</ul>
															</div>
														</div>
													</div>
													<span style="font-size:12px">
														<i>Waktu kirim pesanan yang menggunakan Sameday service tetap 1x24 jam.</i>
													</span>
												</div>
												<!-- item -->
												<div class="col-8" style="display:<?php if($product['is_processtime_set']==1 && $product['processtime_id']==2){echo 'block';}else{echo 'none';}?>;padding:20px;padding-top:6%;" id="con_reguler">
													Dikirim dalam <b>maksimum 2 hari kerja</b>
													<br><br>
													<div class="card" style="padding:20px">
														<div class="row">
															<div class="col-3">
																	<img width="100%" src="<?php echo base_url();?>assets/images/icon-img/processtime_reguler.png"/>
															</div>
															<div class="col-9" style="font-size:12px">
																	Batas waktu maksimum pengiriman pesanan:
																	<ul style="list-style-type: circle;margin-left:20px">
																		<li>Sameday service: 1x24 jam</li>
																		<li>Next day: 2x24 jam</li>
																		<li>Reguler: 2 hari kerja</li>
																	</ul>
															</div>
														</div>
													</div>
												</div>
												<!-- item -->
												<div class="col-8" style="display:<?php if($product['is_processtime_set']==1 && $product['processtime_id']==3){echo 'block';}else{echo 'none';}?>;padding:20px;padding-top:2%;" id="con_preorder">
													Dikirim dalam
													<div class="input-group">
													  <input onChange="validation_processtime_val();" type="number" value="<?php if($product['is_processtime_set']==1 && $product['processtime_id']==2){echo $product['processtime_preorder'];}else{echo '14';}?>" min="1" max="30" class="form-control" id="processtime_preorder"  name="processtime_preorder" style="max-width:60px">
													  <div class="input-group-append">
													    <span class="input-group-text" style="border-left:0px;">hari kerja</span>
													  </div><span class="input-group-text" style="border:0px;background-color:white;font-size:12px;color:#aeaeae">Maksimum 30 hari kerja</span>
													</div>
													<br>
													<div class="card" style="padding:20px">
														<div class="row">
															<div class="col-3">
																	<img width="100%" src="<?php echo base_url();?>assets/images/icon-img/processtime_preorder.png"/>
															</div>
															<div class="col-9" style="font-size:12px">
																	Batas waktu maksimum pengiriman pesanan:
																	<ul style="list-style-type: circle;margin-left:20px">
																		<li>Sameday service: 1x24 jam</li>
																		<li>Next day: <span class="time_preorder_text"><?php if($product['is_processtime_set']==1 && $product['processtime_id']==2){echo $product['processtime_preorder'];}else{echo '14';}?></span> hari</li>
																		<li>Reguler: <span class="time_preorder_text"><?php if($product['is_processtime_set']==1 && $product['processtime_id']==2){echo $product['processtime_preorder'];}else{echo '14';}?></span> hari</li>
																	</ul>
															</div>
														</div>
													</div>
													<span style="font-size:12px">
														<i>Waktu kirim pesanan yang menggunakan Sameday service tetap 1x24 jam.</i>
													</span>
												</div>

											</div>
							      </div>
							  </div>
								<div class="form-group row">
							      <label class="col-sm-3 ">Jasa Pengiriman Khusus</label>
							      <div class="col-sm-9" style="vertical-align:top">
							       	<span id="pengirimanKhususText0" <?php if($product['is_specialdelivery']==0){}else{echo "style='display:none'";}?>>Jasa pengiriman khusus tidak diatur (mengikuti <a href=# style="color:#009245">pengaturan default</a>).</span>
											<span id="pengirimanKhususText1" <?php if($product['is_specialdelivery']==1){}else{echo "style='display:none'";}?>>Jasa pengiriman diatur untuk produk ini (<span id="pengirimanKhususValue"><?php echo $couriers_checked;?></span> dipilih).</span>
												&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#pengirimanKhususModal" style="cursor:pointer"><i class="fas fa-edit"></i> Ubah</button>
											<small class="form-text text-muted">Jasa pengiriman yang diberlakukan hanya untuk produk ini.</small>
										</div>
							  </div>
								<div class="form-group row" style="display:none">
							      <label class="col-sm-3 ">Gratis Ongkos Kirim</label>
							      <div class="col-sm-9" style="vertical-align:top">
							       	Gratis Ongkos Kirim tidak diatur.&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i> Ubah</button>
											<small class="form-text text-muted">Gratis Ongkos Kirim yang diberlakukan hanya untuk produk ini.</small>
										</div>
							  </div>
								<div class="form-group row" style="display:none">
							      <label class="col-sm-3">Asuransi Pengiriman<font color="red">*</font></label>
							      <div class="col-sm-9">
							        <div class="form-check">
							          <input class="form-check-input" type="radio" name="asuransi" id="asuransi_optional" value="0" checked>
							          <label class="form-check-label">
							            Opsional
							          </label>
							        </div>
							        <div class="form-check">
							          <input class="form-check-input" type="radio" name="asuransi" id="asuransi_wajib" value="1">
							          <label class="form-check-label">
							            Wajib
							          </label>
							        </div>
											<small class="form-text text-muted">Asuransi jaminan kerugian, kerusakan, dan kehilangan produk ini saat pengiriman.</small>

										</div>
							  </div>
								<div class="form-group row">
							      <div class="col-sm-12 text-center">
							        <a href="javascript:void(0);"><button  type="button" class="btn btn-primary pull-right" style="background-color:#009245;border-color:#009245;cursor:pointer" onClick="submit();">Simpan Perubahan</button></a>
										</div>
							  </div>

								<div class="modal fade" id="pengirimanKhususModal" role="dialog" aria-labelledby="pengirimanKhususModal" aria-hidden="true" style="margin-top:50px;">
						        <div class="modal-dialog modal-lg" role="document">
						            <div class="modal-content" >
						                <div class="modal-header new-address-header">
						                    <h5 class="modal-title new-address-title" id="editAddressLabel">Jasa Pengiriman Khusus</h5>
						                </div>
														<div class="modal-body d-flex justify-content-center p-2 new-address-body">
															<div class="row p-3">
																<div class="col-1" >
																	<img style="height:70px;margin-top:-20px;" src="<?php echo base_url();?>assets/images/courier-logo/courier-category/antar-ke-ekspedisi.png">
																</div>
																<div class="col-11" style="padding-left:25px">
																	<h4 style="margin-bottom:0px">Antar ke Kantor Ekspedisi</h4>
																	<p>Antar barang ke kantor ekspedisi terdekat dan minta resi dari petugas.</p>
																</div>
															</div>
															<div class="p-3 pb-5 row" id="jasaPengiriman">
																	<?php foreach($couriers_abke as $courier){ ?>
																	<div class="col-4">
																			<img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:50px;width:auto;margin-bottom:10px">
																			<?php
																				foreach($courier['courier_services'] as $courier_service){
																			 ?>
																			 <div class="containers">
														          	   <label><input class="courier" type="checkbox" value="<?php echo $courier_service['id']; ?>" <?php if($courier_service['is_checked']==1){echo "checked";} ?>> <?php echo $courier_service['service_name']; ?>
														                   <span class="checkmark"></span>
														               </label>
																					 <?php
																					 switch($courier_service['jenis_pengiriman']){
																						 case 'same_day':
																								$info_cour="SAME DAY";
																								break;
																						 case 'next_day':
																								$info_cour="NEXT DAY";
																								break;
																						 default:
																								$info_cour="REGULAR";
																								break;
																					 }
																					 ?>
																					<span class="badge badge-xs badge-info " style="font-size:65%;padding-left:.4em;padding-right:.4em;">
																						<?php echo $info_cour;?>
																				 </span>
														          	</div>
																			<?php } ?>
																	</div>
																	<?php } ?>
															</div>
															<hr style="background-color:#e5e7e9">
															<div class="row p-3">
																<div class="col-1" >
																	<img style="height:70px;margin-top:-20px;" src="<?php echo base_url();?>assets/images/courier-logo/courier-category/dijemput-kurir.png">
																</div>
																<div class="col-11" style="padding-left:25px">
																	<h4 style="margin-bottom:0px">Dijemput Kurir Ekspedisi</h4>
																	<p>Kurir akan menjemput pesanan di alamatmu untuk diantar ke pembeli.</p>
																</div>
															</div>
															<div class="p-3 pb-5 row" id="jasaPengiriman">
																	<?php foreach($couriers_bade as $courier){ ?>
																	<div class="col-4">
																			<img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:50px;width:auto;margin-bottom:10px">
																			<?php
																				foreach($courier['courier_services'] as $courier_service){
																			 ?>
																			 <div class="containers">
														          	   <label><input class="courier" type="checkbox" value="<?php echo $courier_service['id']; ?>" <?php if($courier_service['is_checked']==1){echo "checked";} ?>> <?php echo $courier_service['service_name']; ?>
														                   <span class="checkmark"></span>
														               </label>
																					 <?php
																					 switch($courier_service['jenis_pengiriman']){
																						 case 'same_day':
																								$info_cour="SAME DAY";
																								break;
																						 case 'next_day':
																								$info_cour="NEXT DAY";
																								break;
																						 default:
																								$info_cour="REGULAR";
																								break;
																					 }
																					 ?>
																					<span class="badge badge-xs badge-info " style="font-size:65%;padding-left:.4em;padding-right:.4em;">
																						<?php echo $info_cour;?>
																				 </span>
														          	</div>
																			<?php } ?>
																	</div>
																	<?php } ?>
															</div>
															<hr style="background-color:#e5e7e9">
															<div class="row p-3">
																<div class="col-1" >
																	<img style="height:70px;margin-top:-20px;" src="<?php echo base_url();?>assets/images/courier-logo/courier-category/ambil-sendiri.png">
																</div>
																<div class="col-11" style="padding-left:25px">
																	<h4 style="margin-bottom:0px">Ambil Barang Sendiri</h4>
																	<p>Pembeli dapat mengambil pesanannya sendiri ke lokasimu</p>
																</div>
															</div>
															<div class="p-3 pb-5 row" id="jasaPengiriman">
																	<?php foreach($couriers_stil as $courier){ ?>
																	<div class="col-4">
																			<img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:50px;width:auto;margin-bottom:10px">
																			<?php
																				foreach($courier['courier_services'] as $courier_service){
																			 ?>
																			 <div class="containers">
														          	   <label><input class="courier" type="checkbox" value="<?php echo $courier_service['id']; ?>" <?php if($courier_service['is_checked']==1){echo "checked";} ?>> <?php echo $courier_service['service_name']; ?>
														                   <span class="checkmark"></span>
														               </label>
																					 <?php
																					 switch($courier_service['jenis_pengiriman']){
																						 case 'same_day':
																								$info_cour="SAME DAY";
																								break;
																						 case 'next_day':
																								$info_cour="NEXT DAY";
																								break;
																						 default:
																								$info_cour="REGULAR";
																								break;
																					 }
																					 ?>
																					<span class="badge badge-xs badge-info " style="font-size:65%;padding-left:.4em;padding-right:.4em;">
																						<?php echo $info_cour;?>
																				 </span>
														          	</div>
																			<?php } ?>
																	</div>
																	<?php } ?>
															</div>



						                </div>
						                <div class="modal-footer">
						                    <button type="button" onClick="cekJasaPengirimanKhusus();" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan Perubahan</button>
						                </div>
						            </div>
						        </div>
						    </div>
								<div id="add_image_modal" class="modal" role="dialog">
						     <div class="modal-dialog">
						      <div class="modal-content">
						            <div class="modal-header">
						              <button type="button" class="close" data-dismiss="modal">&times;</button>
						            </div>
						            <div class="modal-body">
						              <div class="row">
						                 <div class="col-md-12 text-center">
						                  <div id="add_image_to_crop" style="width:100%; margin-top:5px;height:auto"></div>
						                  <br>
						                  <button class="btn btn-success crop_image" id="add_image_button">Crop & Upload Image</button>
						                 </div>
						              </div>
						           </div>

						         </div>
						        </div>
						    </div>
								<div id="edit_image_modal" class="modal" role="dialog">
						     <div class="modal-dialog">
						      <div class="modal-content">
						            <div class="modal-header">
						              <button type="button" class="close" data-dismiss="modal">&times;</button>
						            </div>
						            <div class="modal-body">
						              <div class="row">
						                 <div class="col-md-12 text-center">
						                  <div id="edit_image_to_crop" style="width:100%; margin-top:5px;height:auto"></div>
															<input type="hidden" id="img_edit_id"/>
						                  <br>
						                  <button class="btn btn-success crop_image" id="edit_image_button">Crop & Upload Image</button>
						                 </div>
						              </div>
						           </div>

						         </div>
						        </div>
						    </div>


							</div>
						</div>
         </div>
       </div>
  </div>

</div>
</div>

</div>

</div>
</div>
</div>
<?php }else{ ?>
	<div class="col-lg-9">
	<!-- Single Product -->
		<div class="single_product" style="margin-top:40px;padding-top:0px">
			<div class="container text-center">
				<div class="card" style="padding:200px;">
					<center><img src="<?php echo base_url();?>assets/images/image-default/tidak-ada-barang.png" width="250px"></center><br>
					<h3>Maaf, produk tidak ditemukan, silahkan lihat daftar produk yang Anda miliki <a style="color:#099245" href="<?php echo base_url();?>my-store/products">disini</a>.</h3>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>
<?php } ?>
<!-- diubah -->
