<?php if($cekStore=='y'){ ?>
<?php $this->load->view('template/store_info');?>

    <!-- Semua barang -->
    <div class="col-md-9 dashboard-filter-product-container" id="semua_barang_container">
      <div class="card pt-2">
          <div class="card-header card-header-style" style="background-color:white">
            <div class="row" style="margin-bottom:10px">
              <div class="col">
                <div class="text-storefront-label mb-2">Feedback Toko</div>
              </div>
              <div class="col">
                <select onChange="location=this.value" class="form-control" style="float:right;height:25px;margin:0px;font-size:inherit;-webkit-appearance: menulist;width:max-content;min-width:max-content">
                  <option <?php if($feedback_type=='all'){echo  'selected';} ?> value="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback">Semua feedback</option>
                  <option <?php if($feedback_type=='positive'){echo  'selected';} ?> value="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback?feedback_type=positive">Feedback positif</option>
                  <option <?php if($feedback_type=='negative'){echo  'selected';} ?> value="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback?feedback_type=negative">Feedback negatif</option>
                </select>
              </div>
            </div>
            <div class="row pl-5 pr-5 pt-2 pb-2">
              <div class="col">
                <!-- feedback start -->
    						<?php
    						if($storeFeedbackCountData>0){
    							$i=0;
    							foreach($storeFeedback as $feedback){
    							$i++;
    							if($i>1){echo "<hr>";}
    						?>
    						<div class="row">
                  <div class="col-lg-12">
                    <div class="comment_list">
                      <div class="review_item">
                        <div class="media">
                          <div class="d-flex">
                            <img
                              src="<?php echo $this->userModel->getUserPhoto($feedback['user_username']);?>"
                              alt="" class="img-profile"
                            />
                          </div>
                          <div class="media-body">
                            <h4>
    													<?php echo $feedback['user_name']; ?>
    													<?php
    													 	switch($feedback['response']){
    															case '1':
    																echo '<i class="fas fa-thumbs-up" style="color:green"></i>';
    																break;
    															default:
    																echo '<i class="fas fa-thumbs-down" style="color:#d63a3a"></i>';
    																break;
    														}

    													?>
    												</h4>
                            <h5><?php echo $this->timeModel->get_waktuIndo($feedback['lup']); ?></h5>
                          </div>
                        </div>
                        <p>
    											<?php if($feedback['id_user']==1){
    												if($feedback['response']==1){$resp=" Feedback Positif karena ";}else{$resp=" Feedback Negatif karena ";}
    												echo "Mendapatkan ".$feedback['response_quantity'].$resp.$feedback['response_detail'];
    											}else{
    												 echo $feedback['response_detail'];
    											 }
    											?>
                        </p>
                      </div>


                    </div>
                  </div>

                </div>
    						<!-- feedback end -->
    						<?php } ?>
                <div class="shop_page_nav d-flex flex-row align-items-center text-center justify-content-center" style="display:inline-block;margin-top:30px">
                  <?php if($page>1 && $page<=$pages){ ?>
                        <div onClick="location.href='<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback?page=<?php echo $page-1;echo $final_filter;?>'" class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                  <?php } ?>

                  <ul class="page_nav d-flex flex-row">

                    <?php for($i=1;$i<=$pages;$i++){
                      if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $pages))
                       {
                          if (($lastLink == 1) && ($i != 2))  echo "<li style='cursor:no-drop'>...</li>";
                          if (($lastLink != ($pages - 1)) && ($i == $pages))  echo "<li style='cursor:no-drop'>...</li>";
                          ?>
                            <a href="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback?page=<?php echo $i;echo $final_filter;?>" <?php if($page==$i){echo "style='color:white;cursor:no-drop;font-weight:500'";}else{echo "style='color:black;font-weight:500'";} ?>><li <?php if($page==$i){echo "class='paginationactive' style='cursor:no-drop'";} ?>><?php echo $i;?></li></a>
                          <?php
                          $lastLink=$i;
                       }

                     }?>


                  </ul>
                  <?php if($page>=1 && $page<$pages){ ?>
                        <div onClick="location.href='<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback?page=<?php echo $page+1;echo $final_filter;?>'" class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
                  <?php } ?>

                </div>
              </div>
    				<?php	}//feedback >0
    					else{
                  if($feedback_type=='positive'){
                    $nf_resp='belum memiliki feedback positif';
                  }else if($feedback_type=='negative'){
                    $nf_resp='tidak memiliki feedback negatif';
                  }else{
                    $nf_resp='belum memiliki feedback';
                  }
    							echo "<center style='color:#999'><img src='".base_url()."assets/images/product/no-feedback.png' width='25%'><br>Penjual ini $nf_resp</center>";
    					}?>
            </div>
        </div>
    </div>
  </div>
    <!--  End of Semua Barang  -->



</div>
<?php }else if($cekStore=='c'){ ?>

  <?php $this->load->view('template/store_info');?>
  <?php $this->load->view('template/store_tutup');?>



<?php }else{ ?>
  <?php $this->load->view('template/store_not_found');?>
<?php } ?>
