<style media="screen">
  .carousel-control-next-icon, .carousel-control-prev-icon {
    background-color: black;
    height: 25px;
    width: 21px;
  }
</style>
<?php if($cek=='y'){ ?>
  <?php
    $is_discount=$this->productModel->checkDiscountByParam($product['discount_start'],$product['discount_end'],$product['discount_value']);
    $is_grosir=$this->productModel->checkWholesaleByParam($product['is_wholesale'],$is_discount,$product['is_discount_grosir'],$product['stock_type']);
  ?>
<div class="row">
  <div class="col-lg-5">
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
      data-ride="carousel">
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($dataProductImg as $productImg){ $i++;?>
        <div class="carousel-item <?php if($i==1){echo 'active';} ?>">
          <div style="width:300px;height:300px;vertical-align:middle;display: inline-block;align-items: center; justify-content: center;display:flex" class="text-center">

              <img src="<?php echo $productImg['img_url'];?>"
                style="max-height:100%;max-width:100%;">

          </div>
        </div>
      <?php } ?>
      </div>
      <!--/.Slides-->
      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->
      <ol class="carousel-indicators">
        <?php $i=0; foreach($dataProductImg as $productImg){ ?>
        <li data-target="#carousel-thumb" data-slide-to="<?php echo $i;?>" <?php if($i==0){echo 'class="active"';} ?>>
          <img src="<?php echo base_url();?>document_upload/<?php echo $product['store_link'].'/product/'.$product['product_id'].'/'.$productImg['img_url'];?>" width="60">
        </li>
        <?php $i++; } ?>
      </ol>
    </div>
    <!--/.Carousel Wrapper-->
  </div>
  <div class="col-lg-7">
    <h4 class="h4-responsive product-name">
      <small><?php echo $product['name_category']; ?></small><br>
      <?php echo $product['pr_name'];?>
      <span id="qv_min_quantity" style="display:none"><?php echo $product['buy_minimum']; ?></span>
    </h4>
    <?php $productReviewAverage=$this->productModel->getReview($product['product_id'],'average'); ?>
    <div class="pr-star-rating" title="<?php echo (($productReviewAverage/5)*100); ?>%" style="margin-bottom:10px;padding-left:3px">
        <div class="pr-back-stars">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>

            <div class="pr-front-stars" style="width:<?php echo (($productReviewAverage/5)*100); ?>%;">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
        </div>
        &nbsp;<sub><small style="color:#999;"><?php echo $this->productModel->getReview($product['product_id'],'count'); ?> ulasan</small></sub>
    </div>
    <br>
    <h3 class="h4-responsive">
      <span class="green-text" <?php if($is_discount==1){ echo "style='color:#df3b3b'"; }?>>
        <?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product['product_id'],1));?>
      </span>
      <?php if($is_discount==1){ ?>
      <span class="grey-text">
        <small  style="color:gray">
          <s><?php echo $this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarang($product['product_id'],1)*100)/(100-$product['discount_value'])).'</s><sup>-'.$product['discount_value'].'%</sup>';?>
        </small>
      </span>
      <?php } ?>
    </h3>
    <?php if($is_grosir==1){ ?>
      <p style="margin-top:-10px;margin-bottom:0px">tersedia harga grosir</p>
    <?php } ?>

    <!--Accordion wrapper-->
    <div style="margin-top:15px" class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">


      <!-- Accordion card -->
      <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="infobarang">
          <a data-toggle="collapse" data-parent="#accordionEx" href="#collapsebarang" aria-expanded="true"
            aria-controls="collapsebarang">
            <h5 class="mb-0"  style="color:#5a5a5a">
              Informasi Barang <i class="fas fa-angle-down rotate-icon"></i>
            </h5>
          </a>
        </div>

        <!-- Card body -->
        <div id="collapsebarang" class="collapse show" role="tabpanel" aria-labelledby="infobarang"
          data-parent="#accordionEx">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
              <table style="font-size:12px">
                <tr>
                  <td width="100px"><i class="fas fa-box"></i> Kondisi</td>
                  <td width="10px">:</td>
                  <td>
                    <?php
										switch($product['pr_condition']){
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
                  <td width="100px"><i class="fas fa-globe"></i> Asal Barang</td>
                  <td width="10px">:</td>
                  <td>
                    <?php
										switch($product['pr_source']){
											case '1':
												echo "Impor";
												break;
											default:
												echo "Lokal";
												break;
											}
										 ?>
                  </td>
                </tr>
                <tr>
                  <td width="100px"><i class="fas fa-shopping-cart"></i> Terjual</td>
                  <td width="10px">:</td>
                  <td><?php echo $this->productModel->cekTerjual($product['product_id']); ?></td>
                </tr>
                <tr>
                  <td width="100px"><i class="fas fa-clock"></i> Waktu Proses</td>
                  <td width="10px">:</td>
                  <td>
                    <?php
                        echo $this->productModel->cekWaktuProses($product['product_id']);
                     ?>
                  </td>
                </tr>
                <tr>
                  <td width="100px"><i class="fas fa-edit"></i> Diperbarui</td>
                  <td width="10px">:</td>
                  <td><?php if($product['product_lastupdated']==''){$lastUpdate=$product['lup'];}else{$lastUpdate=$product['product_lastupdated'];}echo $this->timeModel->get_TanggalIndo($lastUpdate); ?></td>
                </tr>
              </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- Accordion card -->

      <!-- Accordion card -->
      <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="infopenjual">
          <a data-toggle="collapse" data-parent="#accordionEx" href="#collapsepenjual" aria-expanded="true"
            aria-controls="collapsepenjual">
            <h5 class="mb-0" style="color:#5a5a5a">
              Informasi Penjual<i class="fas fa-angle-down rotate-icon"></i>
            </h5>
          </a>
        </div>

        <!-- Card body -->
        <div id="collapsepenjual" class="collapse" role="tabpanel" aria-labelledby="infopenjual"
          data-parent="#accordionEx">
          <div class="card-body">
            <div class="row">
              <div class="col-2" style="padding-right:0px">
                  <img style="margin-right:0px" src="<?php echo $this->storeModel->getStorePhoto($product['store_link'],$product['store_photo']); ?>" class="img-profile-quickview" alt="User-Profile-Image">
              </div>
              <div class="col-9">
                <a href="<?php echo base_url().'s/'.$product['store_link'];?>" style="color:black"><?php echo $product['store_name']; ?></a><br>
                <font style="font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;">
                  <?php if($storeFeedbackCount==0){$storeFeedbackCountDivider=1;}else{$storeFeedbackCountDivider=$storeFeedbackCount;} echo number_format(($storeFeedbackCountPositive/$storeFeedbackCountDivider)*100,0,'.',','); ?>% (<?php echo $storeFeedbackCount; ?> feedback)
                </font><br>
                  <font style="font-size:12px;color:#7f5994"><i class="fas fa-map-marker-alt"></i> <?php echo ucwords(strtolower($product['store_city'])); ?></font><br>
               </div>
            </div>
          </div>
        </div>

      </div>
      <!-- Accordion card -->




    </div>
    <!-- Accordion wrapper -->
    <br>

    <div class="row">
      <div class="col-6" style="padding-right:5px;">
        <?php if($this->session->userdata('username')!=$product['store_link']){ ?>
          <button onClick="addToCart('<?php echo $product['product_id']; ?>');" style="width:100%;background-color:#009245;border-color:#009245;cursor:pointer" class="btn btn-secondary">Tambahkan Ke Keranjang</button>
        <?php }else{ ?>
          <a href="<?php echo base_url();?>product/edit/<?php echo $product['product_id']; ?>"><button style="width:100%;background-color:#099245;border:2px solid #009245;color:#FFFFFF;cursor:pointer;" class="btn btn-secondary">Edit Barang</button></a>
        <?php } ?>
      </div>
      <div class="col-6" style="padding-left:5px;">
        <a href="<?php echo base_url().'p/'.$product['store_link'].'/'.$product['pr_slug'].'-'.$product['pr_uniq'];?>">
          <button style="width:100%;background-color:#FFFFFF;border:2px solid #009245;color:#009245;cursor:pointer;" class="btn btn-secondary">Informasi Lebih Detail</button>
        </a>
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

  					<center><img src="<?php echo base_url();?>assets/images/logoName.png" width="200px"></center><br>
  					<h2>Maaf, produk tidak ditemukan!</h2>
  			</div>
  		</div>
  	</div>
  </div>
<?php } ?>
