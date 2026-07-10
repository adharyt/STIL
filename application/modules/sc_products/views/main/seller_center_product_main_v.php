<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text"><i class="fa fa-archive m-0"></i> Daftar Produk</div>
    <div class="card-header card-header-style" style="background-color:white;margin-top:10px">
			<br>
        <!-- <ul class="store-row-container">
            <li>Semua Barang (1)</li>
            <li>Dijual (1)</li>
            <li>Tidak Dijual (0)</li>
            <li>Terkena Pelanggaran (0)</li>
            <li>Draf (0)</li>
        </ul> -->


					<?php
					$data['placeholderToko']="Cari barang";
					$this->load->view('template/filterBar',$data);
					 ?>

        <div class="product-table-container">
				<?php if(count($products)>=1){ ?>

										<?php
											foreach($products as $product){
												$is_discount=$this->productModel->checkDiscountByParam($product['discount_start'],$product['discount_end'],$product['discount_value']);
										    $is_grosir=$this->productModel->checkWholesaleByParam($product['is_wholesale'],$is_discount,$product['is_discount_grosir'],$product['stock_type']);
										?>
                    <div class="row p-3">
                        <div class="col-1">
													<div style="width:30px;height:30px;vertical-align:middle;display: flex;align-items: center; justify-content: center;" class="text-center">
									          <img src="<?php echo $this->productModel->getProductImage($product['product_id'])[0]['img_url'];?>"
									          style="max-height:100%;max-width:100%;margin-right:20px">
									        </div>
												</div>
												<div class="col-3">
                            <div><?php echo $product['pr_name'];?></div>
														<div><sup><?php echo $this->productModel->getCategoryNameByID($product['id_category']);?></sup></div>
														<?php
														$productReviewAverage=$this->productModel->getReview($product['product_id'],'average');
														$productReviewCount=$this->productModel->getReview($product['product_id'],'count');
														 ?>
														<div class="pr-star-rating" title="<?php echo ((($productReviewAverage/5))*100); ?>%">
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
																		<small style="color:#999"><?php echo number_format($productReviewAverage,1,'.',',') ?> (<?php echo "$productReviewCount";?> ulasan)</small>
														    </div>

													</div>
												</div>
                        <div class="col-2">
                            <div>
															<?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product['product_id'],1)); ?>
															<?php if($is_discount==1){
																echo '<br><strike style="color:#aeaeae"><sub style="color:#aeaeae">'.$this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarang($product['product_id'],1,FALSE))).'</strike> <sub>-'.$product['discount_value'].'%</sub>';
															}
															?><br>
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
																	if($product["wh_unit$i"]!=0 && $product["wh_unit$i"]!='' && $product["wh_price$i"]!=0 && $product["wh_price$i"]!=''){
																		if($is_discount==1){
																		 $discountGrosir='
																		 											<small><font color=gray><strike>'.$this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarang($product["product_id"],$product["wh_unit$i"],FALSE))).'</strike></font>
																													<sup>-'.$product['discount_value'].'%</sup></small>';
																 	 	}else{
																			$discountGrosir='';
																		}
																		$grosir_html_content.=
																			"	<tr>
																					<td style='text-align:left'>
																						≥".$product["wh_unit$i"]."
																					</td>
																					<td style='padding-left:20px;text-align:left'>
																						".$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product["product_id"],$product["wh_unit$i"])).' '.$discountGrosir

																					."</td>
																				</tr>";
																		}
																}
																$grosir_html_footer="
																</table>
																";
																$grosir_html=$grosir_html_header.$grosir_html_content.$grosir_html_footer;
															?>
														 <span style="color:#828282;font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;"><a href="javascript:void(0);" title="<b>Daftar Harga Grosir</b>" data-html="true" data-toggle="popover" data-placement="bottom" data-content="<?php echo $grosir_html;?>" title="Lihat daftar harga grosir">Harga Grosir</a></span>
													 	 <?php } ?>
														 <?php
														 	if($is_discount!='0'){
														   if($is_discount=='1'){
														     $alert='<div class="alert alert-primary" role="alert" style="margin:0px;padding:5px;line-height:14px;margin-top:5px;">
														               <small>Diskon sedang aktif hingga tanggal '.$this->timeModel->get_waktuIndo($product["discount_end"]).'</small>
														               </div>';
														   }else{
														     $alert='<div class="alert alert-warning" role="alert" style="margin:0px;padding:5px;line-height:14px;margin-top:5px;">
														               <small>Diskon akan aktif pada tanggal '.$this->timeModel->get_waktuIndo($product["discount_start"]).'</small>
														             </div>';
														   }
															 echo $alert;
														 	}
															 ?>
														</div>
                        </div>
                        <div class="col-5">
                            <table style="table-layout: fixed; width: 100%">
															<tr>
																<td width="27%" valign="top">Status Barang</td>
																<td width="3%" valign="top">:&nbsp;</td>
																<td valign="top">
																<?php if($product['stock']>0 || $product['stock_type']==3){ ?>
																		<select class="form-control visibility" pr_id='<?php echo $product['product_id'];?>' style="-webkit-appearance: menulist;margin:0px;padding:0px;height:21px;width:100px">
																			<option style="color:black" <?php if($product['is_visibility']==1){echo "selected";}?> value="1">Aktif</option>
																			<option style="color:black" <?php if($product['is_visibility']==0){echo "selected";}?> value="0">Non-aktif</option>
																		</select>
																<?php }else{ ?>
																		Non-aktif, stock kosong
																<?php } ?>
																</td>
															</tr>
															<tr>
																<td width="27%" valign="top">Stock Barang</td>
																<td width="3%" valign="top">:&nbsp;</td>
																<td valign="top">
																	<?php
																		switch($product['stock_type']){
																			case '1':
																				if($product['stock']>=1){echo "1 unit";}else{echo "Habis";}echo " <small style='cursor:help' data-html='true' data-toggle='tooltip' data-placement='bottom' data-original-title='<p align=justify style=color:white;margin-bottom:0px>Barang ini akan langsung non-aktif dan stock tidak dapat diupdate kembali jika sudah laku.</p>'><font color='#f28f16'><i class='fas fa-exclamation-triangle' style='color:#black'></i>Limited</font></small> ";
																				break;
																			case '2':
																				echo $product['stock'].' unit';
																				break;
																			default:
																				echo"<font color='#009245'>Selalu tersedia</font>";
																				break;
																		}
																	?>
																</td>
															</tr>
															<tr>
																<td width="27%" valign="top">Asuransi</td>
																<td width="3%" valign="top">:&nbsp;</td>
																<td valign="top"><?php if($product['is_asuransi']==0){echo "Tidak wajib";}else{ echo "Wajib asuransi";} ?></td>
															</tr>
															<tr>
																<td width="27%" valign="top">Etalase</td>
																<td width="3%" valign="top">:&nbsp;</td>
																<td valign="top" style="word-wrap: break-word">
																	<?php
																		$storefront=$this->productModel->getStorefrontByProduct($product['product_id']);
																		if($storefront!='EMPTY'){
																			foreach($storefront as $sf_item){
																				echo "<span class='label-grosir'>$sf_item[name]</span>&nbsp;";
																			}

																		}else{
																			echo "-";
																		}
																	?>
																</td>
															</tr>
														</table>

                        </div>



                        <div class="col-1">
													<div>
													<a data-html='true' data-toggle='tooltip' data-placement='right' data-original-title="Preview" target="_blank" href="<?php echo base_url().'p/'.$product['store_link'].'/'.$product['pr_slug'].'-'.$product['pr_uniq'];?>" class="rounded" style="cursor:pointer;">
															<i class="fas fa-external-link-square-alt mt-1" style="color:#cecece"></i>
													</a>
													</div>
													<div>
													<a data-html='true' data-toggle='tooltip' data-placement='right' data-original-title="Atur Diskon" target="_blank" pr_id="<?php echo $product['product_id'];?>" class="rounded discount" style="cursor:pointer;">
															<i class="fas fa-percent mt-1" style="color:#cecece"></i>
													</a>
													</div>
													<div>
                            <a data-html='true' data-toggle='tooltip' data-placement='right' data-original-title="Edit Produk" target="_blank" href="<?php echo base_url().'my-store/products/edit/'.$product['product_id'];?>" class="rounded" style="cursor:pointer;">
                                <i class="fas fa-edit mt-1" style="color:#cecece"></i>
                            </a>
													</div>
													<div>
                            <a data-html='true' data-toggle='tooltip' data-placement='right' data-original-title="Hapus Produk" class="rounded" style="cursor:pointer;" onClick="deleteProduct('<?php echo $product['product_id'];?>','<?php echo $product['pr_name'];?>');">
                                <i class="fas fa-trash-alt mt-1" style="color:#cecece"></i>
                            </a>
													</div>
                        </div>
                    </div>
										<div class="row" style="vertical-align:center">
											<div class="col-2 text-center"  style="padding:1px;padding-top:0.7rem;background-color:#f9fafb">
												<i class="fas fa-eye"></i> Dilihat: <?php echo $this->productModel->getProductViewers($product['product_id']);?>
											</div>
											<div class="col-2 text-center"  style="padding:1px;padding-top:0.7rem;background-color:#f9fafb">
												<i class="fas fa-star"></i> Difavoritkan: <?php echo $this->productModel->isWishlist($product['product_id']);?>
											</div>
											<div class="col-2 text-center"  style="padding:1px;padding-top:0.7rem;background-color:#f9fafb">
												<i class="fas fa-shopping-cart"></i> Terjual: <?php echo $this->productModel->cekTerjual($product['product_id']);?>
											</div>
											<div class="col-6">
												<sub>Dipublikasikan pada <?php echo $this->timeModel->get_waktuIndo($product['lup']);?></sub><br>
												<sup><?php if($product['last_updated']!=''){echo "Terakhir diedit pada ".$this->timeModel->get_waktuIndo($product['last_updated']);}else{echo "&nbsp;";}?></sup>
											</div>
										</div>
										<hr style="background-color:#e5e7e9">
									<?php } ?>


						<div class="shop_page_nav d-flex flex-row align-items-center text-center justify-content-center" style="display:inline-block;">
						  <?php if($page>1 && $page<=$pages){ ?>
						        <div onClick="location.href='<?php echo $searchVariable;?>&page=<?php echo $page-1;?>'" class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
						  <?php } ?>

						  <ul class="page_nav d-flex flex-row">

						    <?php for($i=1;$i<=$pages;$i++){
						      if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $pages))
						       {
						          if (($lastLink == 1) && ($i != 2))  echo "<li style='cursor:no-drop'>...</li>";
						          if (($lastLink != ($pages - 1)) && ($i == $pages))  echo "<li style='cursor:no-drop'>...</li>";
						          ?>
						            <a href="<?php echo $searchVariable;?>&page=<?php echo $i;?>" <?php if($page==$i){echo "style='color:white;cursor:no-drop;font-weight:500'";}else{echo "style='color:black;font-weight:500'";} ?>><li <?php if($page==$i){echo "class='paginationactive' style='cursor:no-drop'";} ?>><?php echo $i;?></li></a>
						          <?php
						          $lastLink=$i;
						       }

						     }?>


						  </ul>
						  <?php if($page>=1 && $page<$pages){ ?>
						        <div onClick="location.href='<?php echo $searchVariable;?>&page=<?php echo $page+1;?>'" class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
						  <?php } ?>

						</div>
						<?php
						}else{ ?>
						<div class="no-product">
								<img src="<?php echo base_url();?>assets/images/profile/TidakAdaBarang.png" alt="No Product" class="img-no-product">
								<p class="text-default">Tidak ada barang</p>
						</div>
					<?php } ?>
        </div>

    </div>

    </div>

		<!-- Modal -->
		<div id="modalDiskon" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content"  style="width:650px;" id='modalDiskonKonten'>




		    </div>

		  </div>
		</div>


</div>
</div>
