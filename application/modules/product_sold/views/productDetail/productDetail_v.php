<?php if($cek=='y'){ ?>
<?php
	$is_discount=$this->productModel->checkDiscountByParam($dataProduct['discount_start'],$dataProduct['discount_end'],$dataProduct['discount_value']);
	$is_grosir=$this->productModel->checkWholesaleByParam($dataProduct['is_wholesale'],$is_discount,$dataProduct['is_discount_grosir']);
?>
<div class="row">
	<div class="col-lg-9">

<!-- Single Product -->
	<div class="single_product">
		<div class="container"  style="background-color:white!important;padding:20px;">
			<div class="alert alert-warning" role="alert">
  			Halaman ini menampilkan detail produk pada saat transaksi di tanggal <?php echo $this->timeModel->get_TanggalIndo($dataProduct['lup']);?>, pukul <?php echo $this->timeModel->get_JamIndo($dataProduct['lup']);?>.<br>Klik <small><b><a target="_blank" href="<?php echo base_url().'p/'.$dataProduct['store_link'].'/'.$dataProduct['pr_slug'].'-'.$dataProduct['pr_uniq'];?>">disini</a></b></small> untuk melihat detail terbaru.
			</div>
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
						<div class="product_name"><?php echo $dataProduct['pr_name'];  ?></div>

						<hr style="margin-bottom:10px">

						<div class="product_price" style="margin-top:0px"><?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarangTerjual($dataProduct['id'],$dataProduct['quantity'],TRUE,$check_markup)); ?></div>
						<?php if($is_discount==1){?>
							<div class="product_price" style="margin-bottom:3px;font-size:20px;vertical-align:bottom;color:#7a7a7a"><strike><?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarangTerjual($dataProduct['id'],1,FALSE,$check_markup)); ?></strike> <sup><small><?php echo '-'.$dataProduct['discount_value'].'%'; ?></small></sup></div>
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
									 											<small><font color=gray><strike>'.$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarangTerjual($dataProduct["id"],$dataProduct["wh_unit$i"],FALSE,$check_markup)).'</strike></font>
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
													".$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarangTerjual($dataProduct["id"],$dataProduct["wh_unit$i"],TRUE,$check_markup)).' '.$discountGrosir

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

					</div>
				</div>

			</div>
		</div>
	</div>

	<!--================Product Description Area =================-->
    <section class="product_description_area" >
      <div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color:#009245;color:white">
					&nbsp;&nbsp;
          Detail Barang

        </ul>
        <div class="tab-content" id="myTabContent"  style="background-color:white">
          <div
            class="tab-pane fade show active"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

					<div class="row" >
						<div class="col-lg-2">
							Spesifikasi
						</div>
						<div class="col-lg-10">
							<table style="font-size:12px">
								<tr>
									<td width="100px">Kondisi</td>
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
            <?php echo $dataProduct['store_notes_x']; ?><br>
						<small style="color:#999">Catatan Penjual pada tanggal <?php echo $this->timeModel->get_TanggalIndo($dataProduct['lup']);?>, pukul <?php echo $this->timeModel->get_JamIndo($dataProduct['lup']);?></small>
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
				Informasi Penjual
			</div>
			<div class="card-body">


				<div class="row">
					<div class="col-3">
							<img src="<?php echo $this->storeModel->getStorePhoto($dataProduct['store_link'],$dataProduct['store_photo']); ?>" class="img-profile" alt="User-Profile-Image">
					</div>
					<div class="col-9">
						<?php echo $dataProduct['store_name']; ?><br>
						<font style="font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;">
							<?php $storeFeedbackCount==0?$feedbackDiv=1:$feedbackDiv=$storeFeedbackCount; echo number_format(($storeFeedbackCountPositive/$feedbackDiv)*100,0,'.',','); ?>% (<?php echo $storeFeedbackCount; ?> feedback)
						</font><br>
							<font style="font-size:12px;color:#7f5994"><i class="fas fa-map-marker-alt"></i> <?php echo ucwords(strtolower($dataProduct['store_city'])); ?></font><br>
					 </div>
				</div>
				<hr>





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

	<hr width="100%"/>
