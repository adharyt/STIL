<input type="hidden" id="optName" value="<?php echo $this->locationModel->getName($infoToko['store_subcity'])['text'];?>">
<input type="hidden" id="optID" value="<?php echo $infoToko['store_subcity'];?>">
<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
  <div class="card">
    <div class="card-header" style="background-color:white;border-bottom:0px solid white;padding-left:0px;padding-right:0px">
        <?php $this->load->view('template/header/seller_center_setting_tab');?>
    </div>
    <div class="card-body">
      <div class="row">
            <div class="card-body">

              <form class="form-group">

                  <div class="row">
                    <div class="col-6" style="padding-right:30px;padding-left:30px">
                      <div class="name-text m-0 mt-2 mb-2">Informasi Umum</div>
                      <div class="row">
                          <fieldset class="form-group col-lg-12  mb-3">
                          <label class="default-text m-0" for="nama-label">Deskripsi Toko</label>
                              <textarea class="form-control mt-2" rows="5" id="description"><?php echo $infoToko['store_description'];?></textarea>
                          </fieldset>
                      </div>
                      <div class="row">
                          <fieldset class="form-group col-lg-12  mb-3">
                          <label class="default-text m-0" for="nama-label">Catatan Penjual</label>
                              <textarea class="form-control mt-2" rows="5" id="notes"><?php echo $infoToko['store_notes'];?></textarea>
                          </fieldset>
                      </div>
                      <div class="row">
                          <fieldset class="form-group col-lg-12">
                              <label class="default-text m-0" for="nama-label">Nomor Kontak Penjual</label>
                              <input class="form-control text-dark default-text m-0 mt-1" id="phone" value="<?php echo $infoToko['store_phone'];?>">
                              <div class="alert alert-warning alert-custom-container">
                                  <i class="fa fa-info-circle icon-style" aria-hidden="true"></i>
                                  <div class="default-text ml-0">	Nomor kontak toko tidak akan digunakan untuk OTP dan akan digunakan untuk keperluan pengiriman barang, bukti pembayaran, dan lain-lain. Jika dikosongkan, nomor kontak toko akan menggunakan nomor handphone utama.</div>
                              </div>
                          </fieldset>

                      </div>
                    </div>
                    <div class="col-6" style="padding-left:30px;padding-right:30px">
                      <div class="name-text m-0 mt-2 mb-2">Informasi Alamat</div>
                      <div class="row">
                          <fieldset class="form-group col-lg-12">
                              <label for="city-label">Kecamatan atau Kota</label>
                              <select name="search_subcity" id="edit-kecamatan" class="form-control select2" style="margin-left:0px">
               						    option value="">&nbsp;</option>
               						   </select>
                          </fieldset>
                      </div>
                      <div class="row">
                      <fieldset class="form-group col-lg-12 mb-3">
                        <label for="city-label">Alamat Lengkap</label>
                          <textarea class="form-control mt-2" rows="5" id="address"><?php echo $infoToko['store_address'];?></textarea>
                      </fieldset>
                      </div>
                      <div class="row">
                          <fieldset class="form-group col-lg-12">
                              <label for="city-label">Kode Pos</label>
                              <input class="form-control text-dark default-text m-0 mt-1" id="postalcode" value="<?php echo $infoToko['store_postalcode'];?>">
                          </fieldset>
                      </div>
                    </div>
                  </div>




              </form>

              <div class="row mt-5 mb-3">
                  <div class="col mt-2 d-flex justify-content-end">
                    <a href="<?php echo base_url();?>my-store/settings/general">
                      <button class="btn btn-secondary" id="btnCancel"  style="cursor:pointer;background-color:#bdbdbd;border-color:#bdbdbd">Batal</button>&nbsp;
                    </a>
                      <button onClick="save();" class="btn btn-success" id="btnSave" style="cursor:pointer;background-color:#099245;border-color:#099245">Simpan Perubahan</button>
                  </div>
              </div>

    </div>
  </div>
</div>
</div>
</div>



</div>
</div>
