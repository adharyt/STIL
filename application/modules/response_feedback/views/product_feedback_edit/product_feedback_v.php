<style>
	.active a {
		background-color: #FFA500 !important;
	}

	.img-profile {
		width: 150px;
		height:150px;
	}
</style>
<body>
			<div class="col-sm-9" style="margin-top:30px;">
				<?php if(count($trans_cour)>0){ ?>
				<div class="row d-flex" style="padding-left:15px;padding-right:15px;">
					<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
						<span class="fas fa-edit"></span>
					</div>
					<div class="ml-3 mt-2 p-0 h-100 align-middle">
						<h3>Edit Ulasan Produk <span class="fa fa-angle-double-right"></span> <b><?php echo $trans['id_transaksi']; ?></b></h3>
            <input type='hidden' name='id_trans_cour' value='<?php echo $trans['id_trans_cour']; ?>'/>
						<input type='hidden' name='invoice' value='<?php echo $trans['invoice']; ?>'/>
					</div>
				</div>
				<div class="row" style="padding-left:15px;padding-right:15px;">

					<div class="col-md-12 p-0">
						<div class="card">
							<div class="card-body mt-4 pt-0 pb-0 pr-1">


                    <?php
                    foreach($trans_cour as $cour){ ?>
                      <b><span class="fa fa-store"></span>&nbsp;<?php echo $trans['store_name']; ?></b> <span class="fa fa-long-arrow-alt-right"></span> <?php echo $cour['service_name'];?><br><br>
                      <?php foreach($cour['products'] as $product){ ?>
                        <div class="row">
                          <div class="col-6">
                            <h5>Informasi Produk</h5>
                            <table>
                              <tr>
                                <td style="padding:5px;">
                                  <img src="<?php echo $this->productModel->getProductImage($product['pr_id'])[0]['img_url'];?>" class="product-image" style="width:70px;height:70px">
                                </td>
                                <td style="padding:5px;" valign="top">
																	<a style="color:#099245" target="_blank" href="<?php echo base_url();?>history/transaction/<?php echo $trans['id_transaksi']; ?>/p/<?php echo $product['id'];?>">
																		<?php echo $product['pr_name'];?>
																	</a>
                                  <input type="hidden" class="product_item" name="id_product<?php echo $product['pr_id'];?>" value="<?php echo $product['pr_id'];?>"/>
                                </td>
                              </tr>


                            </table>
                          </div>
                          <div class="col-6">
                            <div class="row">
                              <div class="col-12">
                                <h5>Rating</h5>
																<div style="cursor:pointer">
																	<span class="star-rating star-5">
																	  <input type="radio" name="rating<?php echo $product['pr_id'];?>" value="1" style="cursor:pointer" <?php if($product['rating']==1){echo "checked";} ?>><i></i>
																	  <input type="radio" name="rating<?php echo $product['pr_id'];?>" value="2" style="cursor:pointer" <?php if($product['rating']==2){echo "checked";} ?>><i></i>
																	  <input type="radio" name="rating<?php echo $product['pr_id'];?>" value="3" style="cursor:pointer" <?php if($product['rating']==3){echo "checked";} ?>><i></i>
																	  <input type="radio" name="rating<?php echo $product['pr_id'];?>" value="4" style="cursor:pointer" <?php if($product['rating']==4){echo "checked";} ?>><i></i>
																	  <input type="radio" name="rating<?php echo $product['pr_id'];?>" value="5" style="cursor:pointer" <?php if($product['rating']==5){echo "checked";} ?>><i></i>
																	</span>
																</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-12">
                            <h5>Ulasan</h5>
                            <textarea style="width:90%" class="form-control ulasan_form" rows="5" name='response<?php echo $product['pr_id'];?>'><?php echo $product['review'];?></textarea>
                          </div>
                        </div>
                        <br>
												<br>
                    <?php } ?>
										<!--<hr>-->
                  <?php } ?>

									<div class="row">
										<div class="col-12">
											<button type="button" class="btn btn-primary" onClick="submitReview();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan Perubahan</button>
										</div>
									</div>
                  &nbsp;

							</div>
						</div>
						<br>
					</div>
				</div>
				<?php }else{ ?>
				Tidak ada data
				<?php } ?>

			</div>
		</div>
	</div>
</body>
