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
				<div class="row d-flex" style="padding-left:15px;padding-right:15px;">
					<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
						<span class="fas fa-edit"></span>
					</div>
					<div class="ml-3 mt-2 p-0 h-100 align-middle">
						<h3>Ulasan Produk <span class="fa fa-angle-double-right"></span> <b><?php echo $trans['id_transaksi']; ?></b></h3>
            <input type='hidden' name='id_trans' value='<?php echo $trans['id_trans']; ?>'/>
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
                          <div class="col-12">
														<div class="row">
															<div class="col-1">
																<img src="<?php echo $this->productModel->getProductImage($product['pr_id'])[0]['img_url'];?>" class="product-image" style="width:70px;height:70px">
															</div>
															<div class="col-8">
																<div class="row">
																	<div class="col-12">
																		<a style="color:#099245" target="_blank" href="<?php echo base_url();?>history/transaction/<?php echo $trans['id_transaksi']; ?>/p/<?php echo $product['id'];?>">
																			<?php echo $product['pr_name'];?>
																		</a>
																	</div>
																	<?php
																		//Cek apakah sudah diulas atau belum
																		$product_id=$product['pr_id'];
																		$sdc_id=$cour['id'];
																		$user_id=$this->session->userdata('user_id');
																		$cek=$this->db->query("SELECT * FROM response_productreview where id_user='$user_id' and id_sales_detail_courier='$sdc_id' and id_product='$product_id'");
																		if($cek->num_rows()>0){
																			$dataReview=$cek->result_array()[0];
																	?>
																	<div class="col-12">
																		<div class="pr-star-rating">
														          <div class="pr-back-stars">
														              <i class="fa fa-star" aria-hidden="true"></i>
														              <i class="fa fa-star" aria-hidden="true"></i>
														              <i class="fa fa-star" aria-hidden="true"></i>
														              <i class="fa fa-star" aria-hidden="true"></i>
														              <i class="fa fa-star" aria-hidden="true"></i>

														              <div class="pr-front-stars" style="width:<?php echo ($dataReview['rating']/5)*100;?>%;">
														                  <i class="fa fa-star" aria-hidden="true"></i>
														                  <i class="fa fa-star" aria-hidden="true"></i>
														                  <i class="fa fa-star" aria-hidden="true"></i>
														                  <i class="fa fa-star" aria-hidden="true"></i>
														                  <i class="fa fa-star" aria-hidden="true"></i>
														              </div>
														          </div>
																			<?php if($dataReview['edited_at']!=''){
																				$timeReview=$dataReview['edited_at'];
																			}else{
																				$timeReview=$dataReview['lup'];
																			}
																			?>
																			&nbsp;<sub style="color:#5a5a5a"><?php echo $this->timeModel->get_waktuIndo($timeReview);?></sub>
																		</div>
																	</div>
																	<div class="col-12">
																		<i>"<?php echo $dataReview['review'];?>"</i>
																	</div>
																</div>
															</div>
															<div class="col-3">
																<a href="<?php echo base_url().'my-account/transaction/feedback/'.$cour['id'].'/product/'.$product['pr_id'];?>/edit">
																	<div class="btn btn-success" style="background-color:#099245;border-color:#009245;cursor:pointer;">Edit Ulasan Produk</div>
																</a>
															</div>
														</div>
																<?php
																	}else{
																	//jika belum diulas
																?>
																	<div class="col-12">
																		<i style="color:#5a5a5a">Belum ada ulasan untuk produk ini</i>
																	</div>
																</div>
															</div>
															<div class="col-3">
																<a href="<?php echo base_url().'my-account/transaction/feedback/'.$cour['id'].'/product/'.$product['pr_id'];?>">
																	<div class="btn btn-success" style="background-color:#099245;border-color:#009245;cursor:pointer;">Ulas Produk</div>
																</a>
															</div>
														</div>
														<?php
															} //end jika belum diulas
														?>
														<hr>
                          </div>
                        </div>
                    <?php } ?>
                  <?php } ?>
                  <br>
                  &nbsp;
							</div>
						</div>
						<br>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
