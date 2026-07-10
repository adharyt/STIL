<?php 	if(count($productReview)>0){ ?>

<div class="col-lg-12">
 <?php
    foreach($productReview as $review){
  ?>
<!-- REVIEWSTART -->
 <div class="review_list">
   <div class="review_item">
     <div class="media">
       <div class="d-flex">
         <img
           src="<?php echo $this->userModel->getUserPhoto($review['user_username']);?>"
           alt="" class="img-profile"
         />
       </div>
       <div class="media-body">
         <h4><?php echo $review['user_name']; ?>, <small style="color:#999"><?php echo $this->timeModel->get_waktuIndo($review['lup']); ?></small></h4>
         <?php
            $grayRate=5;
            for($i=0;$i<$review['rating'];$i++){
              $grayRate--;
              echo '<i class="fa fa-star"></i>';
            }
            for($i=0;$i<$grayRate;$i++){
              echo '<i class="fa fa-star" style="color:#ddd"></i>';
            }
         ?>

       </div>
     </div>
     <p>
       <?php echo $review['review']; ?>
     </p>
   </div>
  </div>
  <hr>
  <!-- REVIEWEND -->
<?php } ?>
    <?php
    }//review >0
    else{
        echo "<center style='color:#999'><img src='".base_url()."assets/images/product/no-review.png' width='25%'><br>Belum ada ulasan untuk produk ini</center>";
    }?>
  </div>
