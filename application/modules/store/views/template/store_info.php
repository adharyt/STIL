<?php
//STOREFEEDBACK
$storeFeedbackCountPositive=$this->storeModel->getFeedback($seller_id,'positivesum')->result_array()[0]['summarize'];
$storeFeedbackCountNegative=$this->storeModel->getFeedback($seller_id,'negativesum')->result_array()[0]['summarize'];
$storeFeedbackCount=$storeFeedbackCountPositive+$storeFeedbackCountNegative;
$storeFeedbackCountUniq=$this->storeModel->getFeedback($seller_id,'all')->num_rows();
$storeFeedback=$this->storeModel->getFeedback($seller_id,'all','5')->result_array();
//STORE PELANGGAN
$storeFollowersCount=$this->storeModel->getFollowers($seller_id);
$storeBuyersCount=$this->storeModel->getBuyers($seller_id);
//STORE SENT TIME
$storeAverageSentTime=$this->storeModel->getAverageSentTime($seller_id);
//STOREACCEPTEDORDER
$storeOrderAccepted=$this->storeModel->getOrderCount($seller_id,'accepted')->num_rows();
$storeOrderTotal=$this->storeModel->getOrderCount($seller_id,'all')->num_rows();
?>
<div class="card m-2 pb-3">
    <div class="header-container pr-3 pt-2" style="height:200px;background:url('<?php echo $this->storeModel->getHeaderPhoto($profilPenjual['store_link'],$profilPenjual['store_header']); ?>') no-repeat center center;background-size:100% 100%" >
        <ul class="nav nav-tab">

        </ul>
        <?php if($this->session->userdata('username')==$profilPenjual['store_link']){ ?>
          <label for="upload_image_header" class="btn-edit-header" style="color:#099245">Ubah Foto Header</label>
          <input type="file" name="upload_image_header" id="upload_image_header" accept="image/*" style="opacity:0;position:absolute;z-index: -1;"/>
        <?php } ?>
    </div>
    <div class="row dashboard-seller-profile-container">

          <div class="col-md-1 col-xs-6 text-center" style="padding:0px">
            <div class="ml-3 mt-3 profile-name-container" style="margin-left:0px!important">
            <img id="storecurrentpic" src="<?php echo $this->storeModel->getStorePhoto($profilPenjual['store_link'],$profilPenjual['store_photo']); ?>" alt="Photo Profile" class="img-thumbnail img-profile" style="width:102px!important;height:102px!important;border:0px solid white">
            <?php if($this->session->userdata('username')==$profilPenjual['store_link']){ ?>
              <label title="Ubah Foto Toko" for="upload_image_store" class="btn-edit-header btn-xs" style="margin-top:10px;color:#099245">
                Ubah Foto Toko
              </label>
              <input type="file" name="upload_image_store" id="upload_image_store" accept="image/*" style="display:none;opacity:0;position:absolute;z-index: -1;"/>
            <?php }else{

              if($this->session->userdata('is_login')=='y'){
              ?>
                <span style="cursor:pointer" onClick="storeFavo('<?php echo $profilPenjual['user_id']; ?>');">
                    <?php if($this->storeModel->isFavorite($profilPenjual['user_id'])>0){
                        echo "<a class='btn btn-xs' style='border-color:#099245;color:#099245;margin-top:10px' title='Unfollow'>Following</a>";
                      }else{
                        echo "<a class='btn btn-xs' style='background-color:#099245;color:white;margin-top:10px'>Follow</a>";
                      }
                    ?>
                </span>
            <?php
                }
              }
            ?>
          </div>
          </div>
          <div class="col-md-9">
            <div>
                <div class="ml-3 mt-3 profile-name-container text-left">
                    <br>
                    <h4 style="line-height:20px;color:#099245"><a style="color:#099245"href="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>"><?php echo $profilPenjual['store_name'];?></a></h4>
                    <p style="line-height:2px;"><?php echo ucwords(strtolower($profilPenjual['store_location']));?></p>
                </div>
            </div>
          </div>
          <div class="col-md-2">
            <div>
                <div class="ml-3 mt-3 profile-name-container text-left">
                  <?php if($this->session->userdata('username')==$profilPenjual['store_link']){ ?>
                    <a href="<?php echo base_url();?>my-store/settings" style="width:100%;background-color:#FFFFFF;border:2px solid #009245;color:#009245;cursor:pointer;" class="btn btn-secondary"><i class="fas fa-cogs" style="transform: scale(1, 1);"></i> Pengaturan Toko</a>
                  <?php }else{ ?>
                    <button onclick="startChatFromUser(`<?php echo $profilPenjual['store_id'];?>`);" style="width:100%;background-color:#FFFFFF;border:2px solid #009245;color:#009245;cursor:pointer;" class="btn btn-secondary"><i class="fas fa-comment" style="transform: scale(1, 1);"></i> Chat Penjual</button>
                  <?php } ?>
                </div>
            </div>
          </div>

    </div>

</div>
<div id="uploadimage_headerModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
             <div class="col-md-12 text-center">
              <div id="image_to_crop_header" style="width:100%; margin-top:5px;height:auto"></div>
              <br>
              <button class="btn btn-success crop_image" id="crop_imagebutton" style="cursor:pointer">Crop & Upload Image</button>
             </div>
          </div>
       </div>

     </div>
    </div>
</div>
<div id="uploadimageStoreModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
             <div class="col-md-12 text-center">
              <div id="image_store_to_crop" style="width:100%; margin-top:5px;height:auto"></div>
              <br>
              <button class="btn btn-success crop_image" id="crop_store_image_now" style="cursor:pointer">Crop & Upload Image</button>
             </div>
          </div>
       </div>

     </div>
    </div>
</div>

<!--
<div class="dashboard-proudcts-container">
    <p class="text-show-products">Tampilkan berbagai pilihan<br>barang unggulan kamu disini</p>
    <div class="btn-settings-products">
        <a>Atur Barang Unggulan</a>
    </div>
</div>
-->

<div class="row">
    <div class="col-md-3 side-bar-container pr-0">
        <div class="card p-4" >
            <div class="text-storefront-label mb-2">Informasi Toko</div>
            <font style="color:gray;font-size:12px;margin-top:10px">Tingkat kepuasan pembeli</font>
            <a style="color:#099245"href="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback">
              <?php $storeFeedbackCount==0?$feedbackDiv=1:$feedbackDiv=$storeFeedbackCount; echo number_format(($storeFeedbackCountPositive/$feedbackDiv)*100,0,'.',','); ?>% (<?php $storeFeedbackCountPositive==''?$storeFeedbackCountPositivePrint=0:$storeFeedbackCountPositivePrint=$storeFeedbackCountPositive;echo $storeFeedbackCountPositivePrint; ?> pembeli puas)
            </a>
            <font style="color:gray;font-size:12px;margin-top:10px">Jumlah feedback</font>
            <a style="color:#099245"href="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/feedback">
              <?php echo $storeFeedbackCount; ?> feedback
            </a>
            <font style="color:gray;font-size:12px;margin-top:10px">Pesanan diterima</font>
            <?php $storeOrderTotal==0?$orderCountDiv=1:$orderCountDiv=$storeOrderTotal; echo number_format(($storeOrderAccepted/$orderCountDiv)*100,0,'.',','); ?>% (menerima <?php echo $storeOrderAccepted;?> dari <?php echo $storeOrderTotal;?> pesanan)
            <br>
            <font style="color:gray;font-size:12px;margin-top:10px">Rata-rata waktu kirim pesanan</font>
            <?php echo $storeAverageSentTime;?>
            <br>
            <font style="color:gray;font-size:12px;margin-top:10px">Jumlah pelanggan</font>
            <?php echo $storeBuyersCount;?> orang
            <br>
            <font style="color:gray;font-size:12px;margin-top:10px">Jumlah pengikut</font>
            <?php echo $storeFollowersCount;?> orang
            <br>
            <font style="color:gray;font-size:12px;margin-top:10px">Tanggal bergabung</font>
            <?php echo $this->timeModel->get_TanggalIndo($storeLupActive); ?>
            <br>
        </div>
    </div>
