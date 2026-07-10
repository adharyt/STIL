<style media="screen">
  .gallery-item{
    display: inline-block;
	  position: relative;
	  width: 100%;
	  margin: 5% 5% 0 0;
	  float: left;
	  font-size: 12px;
  }
  .gallery-item:before {
  content: "";
  display: block;
  padding-top: 100%;
  /* initial ratio of 1:1*/
}
.content {
  /* Positioning */
  	  position: absolute;
  	  top: 0;
  	  left: 0;
  	  bottom: 0;
  	  right: 0;
  	  /* Styling */
  	  text-align: center;
  	  vertical-align: middle;
  	  text-transform: uppercase;
  	  color: #fff;
}
.form-check-input {
     margin-left: 0px;
}
.gallery-item-add:hover {
	color: #67ff67 !important;
}
</style>
<div class="gallery">
  <?php 
  $uimg=0;
  if(count($product_image)>0){
      foreach($product_image as $image){
        $uimg++;
        ?>
        <div class="col-lg col-sm-12" style="padding:15px;">
      <div class="gallery-item" tabindex="0" style="margin:0px;">
        <div class="content text-center">
            <div style="width:100%;height:100%;vertical-align:middle;display: flex;align-items: center; justify-content: center;" class="text-center">
              <img src="<?php echo $image['img_url'];?>"
              style="max-height:100%;max-width:100%;">
            </div>
            <div class="gallery-item-info" style="width:100%;height:100%;">
              <ul>
                <?php if($image['is_selected']==0){?>
                  <li class="gallery-item-cover" onClick="img_setCover('<?php echo $image['img_id'];?>');"><i class="fas fa-images" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Jadikan Gambar Utama"></i></li>
                <?php } ?>
                <label title="Ganti Gambar" for="edit_current_image<?php echo $image['img_id'];?>" style="border-color: #009245;cursor:pointer">
                  <li class="gallery-item-edit"><i class="fas fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ganti Gambar"></i></li>
                </label>
                <input type="file" class="edit_current_image" name="edit_current_image<?php echo $image['img_id'];?>" id="edit_current_image<?php echo $image['img_id'];?>" img_id='<?php echo $image['img_id'];?>' accept="image/*" style="display:none;opacity:0;position:absolute;z-index: -1;"/>
                <li class="gallery-item-delete" onClick="img_delete('<?php echo $image['img_id'];?>');"><i class="fas fa-trash-alt" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hapus Gambar"></i></li>
              </ul>
            </div>



        </div>
      </div>
      <?php if($image['is_selected']==1){?>
        <span class="label label-info">Gambar Utama</span>
      <?php } ?>
    </div>
      <?php }
  }//endif ?>
  <?php
    for($i=$uimg;$i<5;$i++){
  ?>
  <div class="col-lg col-sm-12" style="padding:15px;">
  <div class="gallery-item" tabindex="0"  style="margin:0px;">
    <div class="content text-center">
      <div style="width:100%;height:100%;vertical-align:middle;display: inline-block;align-items: center; justify-content: center;" class="text-center">
        <img src="<?php echo base_url();?>assets/images/icon-img/add-image.png"
        style="max-height:100%;max-width:100%;">
      </div>
    <div class="gallery-item-info" style="width:100%;height:100%;">
      <ul>
        <div class="col-1" >
          <br><br>
          <label title="Tambah Gambar Baru" for="add_new_image" style="border-color: #009245;cursor:pointer">
            <li class="gallery-item-add" style="text-align:left">Tambah Gambar Baru</li>
          </label>
          <input type="file" class="add_new_image" name="add_new_image" id="add_new_image" accept="image/*" style="display:none;opacity:0;position:absolute;z-index: -1;"/>
        </div>

      </ul>
    </div>
  </div>
  </div>
</div>
  <?php } ?>


</div>
