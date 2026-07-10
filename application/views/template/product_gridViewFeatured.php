<?php foreach($dataProduct as $product){ ?>
  <?php
    $is_discount=$this->productModel->checkDiscountByParam($product['discount_start'],$product['discount_end'],$product['discount_value']);
    $is_grosir=$this->productModel->checkWholesaleByParam($product['is_wholesale'],$is_discount,$product['is_discount_grosir'],$product['stock_type']);
  ?>
<div class="featured_slider_item" style="padding:10px;">
  <div class="border_active" style="height:100%"></div>
  <div class="product_item <?php if($is_discount==1){ echo 'discount';}?> <?php if($this->productModel->isPreOrder($product['product_id'])==1){echo 'is_new';}?>">
    <div class="product_border"></div>
    <div onClick="quickview('<?php echo $product['pr_slug'].'-'.$product['pr_uniq'];?>','<?php echo $product['store_link'];?>');" class="product_image d-flex flex-column align-items-center justify-content-center">
      <div style="padding:10px;width:177.5px;height:115px;vertical-align:middle;display: inline-block;align-items: center; justify-content: center;display:flex" class="text-center">
          <img src="<?php echo $this->productModel->getProductImage($product['product_id'])[0]['img_url']; ?>"
            style="max-height:100%;max-width:100%;">
      </div>
    </div>
    <div onClick="quickview('<?php echo $product['pr_slug'].'-'.$product['pr_uniq'];?>','<?php echo $product['store_link'];?>');"class="product_content" style="border:0px solid black;text-align:left;padding-left:5px">
      <div class="product_name" style="height:40px;margin-left:5px"><div><a href="javascript:void(0);" tabindex="0" title="<?php echo $product['pr_name'];?>"><?php echo $product['pr_name'];?></a></div></div>
      <div class="product_price" style="margin-top:5px;margin-left:5px;text-align:left;font-size:15px">
        <?php if($is_discount==1){
          echo '<strike style="color:#aeaeae"><sub style="color:#aeaeae">'.$this->currencyModel->integerToCurrency('rupiah',($this->productModel->cekHargaBarang($product['product_id'],1,FALSE))).'</strike>'.'</sub></strike>&nbsp;';
        }?>
        <?php if($is_grosir==1){
          echo '<div class="label label-info label-xs">Grosir</div>';
        }?>
        <br><div <?php if($is_discount==1){
          echo "style='color:#df3b3b'";
        }?>>
            <?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product['product_id'],1));?>
          </div>
      </div>

      <?php $productReviewAverage=$this->productModel->getReview($product['product_id'],'average'); ?>
      <div class="pr-star-rating" title="<?php echo (($productReviewAverage/5)*100); ?>%" style="margin-bottom:0px;padding-left:3px">
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
          <br>
      </div>
      <div style="margin-top:0px;margin-left:5px;text-align:left;font-size:15px;font-size:12px;color:#7f5994">
        <i class="fas fa-map-marker-alt"></i> <?php echo ucwords(strtolower($product['store_city'])); ?>
      </div>
      <br>


    </div>
    <!--
    <div class="row" style="text-align:left;width:100%;">
      <div class="col-12" style="text-align:center;padding-left:5px">
          <button type="button" class="button cart_button" style="height:100%;width:80%;color:white;"><i class="fa fa-link"></i> Quickview</button>
      </div>
    </div>
    -->
    <?php if($this->session->userdata('is_login')=='y'){ ?>
    <div class="product_fav <?php if($this->productModel->isWishlist($product['product_id'])>0){echo "active";} ?>"
      onClick="swishlist('<?php echo $product['pr_slug'].'-'.$product['pr_uniq'];?>','<?php echo $product['store_link'];?>');"><i class="fas fa-heart"></i></div>
    <?php } ?>
    <ul class="product_marks">
      <li class="product_mark product_new" title="Pre-Order">PO</li>
      <li class="product_mark product_discount"><?php if($is_discount==1){echo '-'.$product['discount_value'].'%';}?></li>
    </ul>
  </div>

</div>
<?php } ?>
