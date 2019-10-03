<?php foreach($dataProduct as $product){ ?>
<div class="featured_slider_item" style="padding:10px;">
  <div class="border_active" style="height:100%"></div>
  <div class="product_item <?php if($product['is_discount']==1){ echo 'discount';}?> <?php if($product['pr_condition']==0){echo 'is_new';}?>">
    <div class="product_border"></div>
    <div onClick="quickview('<?php echo $product['pr_slug'].'-'.$product['pr_uniq'];?>','<?php echo $product['store_link'];?>');" class="product_image d-flex flex-column align-items-center justify-content-center">
      <img style="height:100%" src="<?php echo $this->productModel->getProductImage($product['product_id'])[0]['img_url']; ?>" alt=""></div>
    <div onClick="quickview('<?php echo $product['pr_slug'].'-'.$product['pr_uniq'];?>','<?php echo $product['store_link'];?>');"class="product_content" style="border:0px solid black;text-align:left;padding-left:5px">
      <div class="product_name" style="height:40px;margin-left:5px"><div><a href="javascript:void(0);" tabindex="0" title="<?php echo $product['pr_name'];?>"><?php echo $product['pr_name'];?></a></div></div>
      <div class="product_price" style="margin-top:5px;margin-left:5px;text-align:left;font-size:15px">
        <?php if($product['is_discount']==1){ echo '<strike><sub style="color:#aeaeae">Rp 11.125.000</sub></strike>&nbsp;';}?>
        <?php if($product['is_wholesale']==1){ echo '<div class="label label-info label-xs">Grosir</div>';}?>
        <br><?php echo $this->currencyModel->integerToCurrency('rupiah',$product['price']);?></div>

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
    <div class="product_fav <?php if($this->productModel->isWishlist($product['product_id'])>0){echo "active";} ?>"
      onClick="swishlist('<?php echo $product['pr_slug'].'-'.$product['pr_uniq'];?>','<?php echo $product['store_link'];?>');"><i class="fas fa-heart"></i></div>
    <ul class="product_marks">
      <li class="product_mark product_new">Bekas</li>
      <li class="product_mark product_discount">-25%</li>
    </ul>
  </div>

</div>
<?php } ?>
