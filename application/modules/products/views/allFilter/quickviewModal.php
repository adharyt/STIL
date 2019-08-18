<div class="row">
  <div class="col-lg-5">
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
      data-ride="carousel">
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($dataProductImg as $productImg){ $i++;?>
        <div class="carousel-item <?php if($i==1){echo 'active';} ?>">
          <img class="d-block w-100"
            src="<?php echo base_url();?>document_upload/<?php echo $productQV['store_link'].'/product/'.$productQV['product_id'].'/'.$productImg['img_url'];?>"
            alt="">
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
          <img src="<?php echo base_url();?>document_upload/<?php echo $productQV['store_link'].'/product/'.$productQV['product_id'].'/'.$productImg['img_url'];?>" width="60">
        </li>
        <?php $i++; } ?>
      </ol>
    </div>
    <!--/.Carousel Wrapper-->
  </div>
  <div class="col-lg-7">
    <h4 class="h4-responsive product-name">
      <small><?php echo $productQV['name_category']; ?></small><br>
      <?php echo $productQV['pr_name'];?>
    </h4>
    <?php $productReviewAverage=$this->productModel->getReview($productQV['product_id'],'average'); ?>
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
        &nbsp;<sub><small style="color:#999;"><?php echo $this->productModel->getReview($productQV['product_id'],'count'); ?> ulasan</small></sub>
    </div>
    <br>
    <h3 class="h4-responsive">
      <span class="green-text" <?php if($productQV['is_discount']==1){ echo "style='color:#df3b3b'"; }?>>
        <?php echo $this->currencyModel->integerToCurrency('rupiah',$productQV['price']);?>
      </span>
      <?php if($productQV['is_discount']==1){ ?>
      <span class="grey-text">
        <small>
          <s>Rp 30.000.000</s>
        </small>
      </span>
      <?php } ?>
    </h3>
    <?php if($productQV['is_wholesale']==1){ ?>
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
										switch($productQV['pr_condition']){
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
										switch($productQV['pr_source']){
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
                  <td>[NOT SET]</td>
                </tr>
                <tr>
                  <td width="100px"><i class="fas fa-clock"></i> Waktu Proses</td>
                  <td width="10px">:</td>
                  <td>
                    <?php
                        if($productQV['is_processtime_set']==1){
                          switch($productQV['processtime_id']){
                            case '1':
                              $waktuProses=$productQV['processtime_instan'].' jam';
                              break;
                            case '2':
                              $waktuProses='2 hari';
                              break;
                            case '3':
                              $waktuProses=$productQV['processtime_preorder'].' hari';
                              break;
                            default:
                              $waktuProses='2 hari';
                              break;
                          }
                        }else{
                          switch($productQV['store_processtime_id']){
                            case '1':
                              $waktuProses=$productQV['store_processtime_instan'].' jam';
                              break;
                            case '2':
                              $waktuProses='2 hari';
                              break;
                            case '3':
                              $waktuProses=$productQV['store_processtime_preorder'].' hari';
                              break;
                            default:
                              $waktuProses='2 hari';
                              break;
                          }
                        }

                        echo $waktuProses;
                     ?>
                  </td>
                </tr>
                <tr>
                  <td width="100px"><i class="fas fa-edit"></i> Diperbarui</td>
                  <td width="10px">:</td>
                  <td><?php echo $this->timeModel->get_TanggalIndo($productQV['product_lastupdated']); ?></td>
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
              Informasi Penjual <i class="fas fa-angle-down rotate-icon"></i>
            </h5>
          </a>
        </div>

        <!-- Card body -->
        <div id="collapsepenjual" class="collapse" role="tabpanel" aria-labelledby="infopenjual"
          data-parent="#accordionEx">
          <div class="card-body">
            <div class="row">
              <div class="col-2" style="padding-right:0px">
                  <img style="margin-right:0px" src="<?php echo $this->userModel->getPhoto($productQV['store_link'],$productQV['photo'],$productQV['gender']); ?>" class="img-profile" alt="User-Profile-Image">
              </div>
              <div class="col-9">
                <?php echo $productQV['store_name']; ?><br>
                <font style="font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;">
                  <?php echo number_format(($storeFeedbackCountPositive/$storeFeedbackCount)*100,0,'.',','); ?>% (<?php echo $storeFeedbackCount; ?> feedback)
                </font><br>
                  <font style="font-size:12px;color:#7f5994"><i class="fas fa-map-marker-alt"></i> <?php echo $productQV['store_city']; ?></font><br>
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
        <button style="width:100%;background-color:#009245;border-color:#009245;" class="btn btn-secondary">Beli Sekarang</button>
      </div>
      <div class="col-6" style="padding-left:5px;">
        <a href="<?php echo base_url().'p/'.$productQV['store_link'].'/'.$productQV['pr_slug'].'-'.$productQV['pr_uniq'];?>">
          <button style="width:100%;background-color:#FFFFFF;border:2px solid #009245;color:#009245" class="btn btn-secondary">Informasi Lebih Detail</button>
        </a>
      </div>
    </div>
  </div>
</div>
