<div class="modal-header new-address-header">
    <h5 class="modal-title new-address-title" id="acceptTransaction">Konfirmasi Barang Diterima</h5>
    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
    <span aria-hidden="true" class="fas fa-times-circle"></span>
    </button>
</div>
<div class="modal-body justify-content-center p-2">
  <div style="padding-right:10px;padding-left:10px">
    <div class="row">
      <div class="col-12">
        <center>
          <div style="margin-bottom:7px;margin-top:10px;"><img width="90px" src="<?php echo $this->storeModel->getStorePhoto($trans['store_link'],'');?>"/></div>
          <div style="margin-bottom:0px;font-size:16px">
            <input type='hidden' name='id_trans' value='<?php echo $trans['id_trans']; ?>'/>
            <a style="cursor:pointer;color:#009245" href="<?php echo base_url();?>s/<?php echo $trans['store_link'];?>" target="_blank">
              <?php echo $trans['store_name'];?>
            </a>
          </div>
          <div style="line-height:2px"><small><i class="fas fa-map-marker-alt"></i> <?php echo $this->locationModel->getName($trans['store_city'])['text'];?></small><div>
      </center>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12 text-center">
        Bagaimanakah pelayanan penjual ini?
        <div class="radio-feedback">
            <input type="radio" id="radioBad" name="response" value="0">
            <label for="radioBad">Bad</label>
            <input type="radio" id="radioGood" name="response" value="1" checked>
            <label for="radioGood">Good</label>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        Feedback untuk penjual:
        <textarea class="form-control" name="response_detail"></textarea>
      </div>
    </div>
    <hr>
    <center>
    <div class="row">
      <div class="col-12">
        Bagaimanakah pelayanan kurir <b><?php echo $trans['service_name'];?></b>?
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-6">
        Ketepatan Waktu Pengiriman<br>
        <span class="star-rating star-5">
          <input type="radio" name="rating_cour_ontime" value="1" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_ontime" value="2" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_ontime" value="3" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_ontime" value="4" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_ontime" value="5" style="cursor:pointer"><i></i>
        </span>
      </div>
      <div class="col-6">
        Keamanan Isi Paket<br>
        <span class="star-rating star-5">
          <input type="radio" name="rating_cour_protection" value="1" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_protection" value="2" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_protection" value="3" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_protection" value="4" style="cursor:pointer"><i></i>
          <input type="radio" name="rating_cour_protection" value="5" style="cursor:pointer"><i></i>
        </span>
      </div>
    </div>
  </center>
    </div>
    <br>
    <div class="row" style="padding-left:10px;padding-right:10px">
      <div class="col-12">
        <center>
          <button onClick="submitFeedback();" type="submit" class="btn btn-primary" style="background-color:#099245;border-color:#099245;height:36px;margin-left:-5px;cursor:pointer;width:100%">Konfirmasi</button>
        </center>
      </div>
    </div>
    <br>
    &nbsp;
</div>
