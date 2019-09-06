<div class="card m-2 pb-3">
    <div class="header-container pr-3 pt-2" style="height:200px;background:url('<?php echo $this->userModel->getHeaderPhoto($profilPenjual['store_link'],$profilPenjual['store_header']); ?>') no-repeat center center;background-size:100% 100%" >
        <ul class="nav nav-tab">

        </ul>
        <label for="upload_image_header" class="btn-edit-header">Ubah Foto Header</label>
        <input type="file" name="upload_image_header" id="upload_image_header" accept="image/*" style="opacity:0;position:absolute;z-index: -1;"/>
    </div>
    <div class="row dashboard-seller-profile-container">

          <div class="col-md-1 col-xs-6 text-center" style="padding:0px">
            <div class="ml-3 mt-3 profile-name-container" style="margin-left:0px!important">
            <img src="<?php echo $this->userModel->getStorePhoto($profilPenjual['store_link'],$profilPenjual['store_photo']); ?>" alt="Photo Profile" class="img-thumbnail img-profile" style="width:100%;height:auto">
          </div>
          </div>
          <div class="col-md-10 col-xs-6">
            <div>
                <div class="ml-3 mt-3 profile-name-container text-left">
                    <br>
                    <h4><?php echo $profilPenjual['store_name'];?></h4>
                    <p><?php echo ucwords(strtolower($profilPenjual['store_location']));?></p>
                </div>
            </div>
          </div>

        <div class="btn-settings-shop">
            <i class="fas fa-cog icon-settings"></i>
            <a>Atur Toko</a>
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
    <div class="col-md-2 side-bar-container pr-0">
        <div class="card p-2" >
            <div class="text-storefront-label">Etalase</div>
            <ul>
            <li class="text-default mt-2 hoverPointer"><a href="<?php echo base_url();?>s/drmp" style="color:#009245;<?php if($activeEtalase==''){echo  'font-weight:700';}?>">Semua Barang</a></li>
            <?php $placeholderToko='Cari barang di semua etalase';
            foreach($etalasePenjual as $etalase){ ?>
                <li class="text-default mt-2 hoverPointer"><a href="<?php echo base_url();?>s/drmp/label/<?php echo $etalase['slug']; ?>"
                  style="color:#009245;<?php if($activeEtalase==$etalase['slug']){echo  'font-weight:700';}?>;"><?php echo ucfirst($etalase['name']);?></a></li>
            <?php
                if($activeEtalase==$etalase['slug']){
                  $placeholderToko="Cari barang di etalase '".ucfirst($etalase['slug'])."'";
                }
              }  ?>
          </ul>
        </div>
    </div>

    <!-- Semua barang -->
    <div class="col-md-10 dashboard-filter-product-container" id="semua_barang_container">
        <div class="card">
            <div class="card-header card-header-style" style="background-color:white">
                <div class="row">
                    <div class="input-icons col-lg-9 col-md-6 col-sm-4">
                        <i class="fa fa-search icon"></i>
                        <input class="input-field text-default" type="text" placeholder="<?php echo $placeholderToko;?>">
                    </div>

                    <!-- Flter Dropdown -->

                    <a href="" class="icon-horizontal col-lg-1 mt-2 text-default" data-toggle="modal" data-target="#filterModal">
                        <i class="fa fa-filter mt-1"></i>
                        <p class="ml-2">Filter</p>
                    </a>

                    <!-- Filter Modal -->
                    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="overflow: hidden; height: 500px">
                            <div class="modal-header new-address-header">
                                <h5 class="modal-title new-address-title" id="editAddressLabel">Filter Barang</h5>
                                <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="fas fa-times-circle"></span>
                                </button>
                            </div>
                            <div class="modal-body justify-content-center p-0 pl-3 pr-3">
                                <div class="row">
                                    <div class="col-4 bg-light p-3 ">
                                        <ul>
                                            <li class="m-0 mt-2">
                                                <span id="rentang_harga_label" class="mt-2 p-1 text-default"
                                                    onClick="rentangHarga();">Rentang Harga</span>
                                            </li>
                                            <li class="m-0 mt-2">
                                                <span id="kondisi_barang_label" class="mt-2 p-1 text-default"
                                                    onClick="kondisiBarang();">Kondisi Barang</span>
                                            </li>
                                            <li class="m-0 mt-2">
                                                <span id="rating_label" class="mt-2 p-1 text-default"
                                                    onClick="rating();">Rating</span>
                                            </li>
                                            <li class="m-0 mt-2">
                                                <span id="gratis_ongkir_label" class="mt-2 p-1 text-default"
                                                    onClick="gratisOngkir();">Gratis Ongkir</span>
                                            </li>
                                            <li class="m-0 mt-2">
                                                <span id="jasa_pengiriman_label" class="mt-2 p-1 text-default"
                                                    onClick="jasaPengiriman();">Jasa Pengiriman</span>
                                            </li>
                                            <li class="m-0 mt-2 mb-2">
                                                <span id="lainnya_label" class="mt-2 p-1 text-default"
                                                    onClick="lainnya();">Lainnya</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Rentang Harga -->
                                    <div class="col-8 p-3" id="rentang_harga">
										<fieldset class="form-group col-12">
											<label for="min-label" class="text-default">Harga Minimal</label>
											<input type="text" class="form-control text-default text-dark" id="min-label">
										</fieldset>
                                        <fieldset class="form-group col-12">
											<label for="max-label" class="text-default">Harga Maksimal</label>
											<input type="text" class="form-control text-default text-dark" id="max-label">
										</fieldset>
                                    </div>

                                    <!-- Kondisi Barang -->
                                    <div class="col-8 p-3" id="kondisi_barang" style="display:none">
                                        <div class="radio mt-2">
                                            <label><input type="radio" name="optradio" checked> Semua Kondisi</label>
                                        </div>
                                        <div class="radio mt-2">
                                            <label><input type="radio" name="optradio"> Barang Baru</label>
                                        </div>
                                        <div class="radio mt-2">
                                            <label><input type="radio" name="optradio"> Barang Bekas</label>
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-8 p-3" id="rating" style="display:none">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Semua Rating</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="">
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="">
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="">
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="">
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="">
                                                <span class="fa fa-star" style="color: orange"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                                <span class="fa fa-star" style="color: grey"></span>
                                            </label>
                                        </div>
                                    </div>

                                     <!-- Gratis Ongkir -->
                                     <div class="col-8 p-3" id="gratisOngkir" style="display: none; overflow: auto; height: 375px">
                                        <fieldset class="form-group col-12">
                                            <input type="text" class="form-control text-default text-dark"
                                                id="go-label" placeholder="Cari nama wilayah">
										</fieldset>
                                        <label for="" style="font-weight: bold">Daerah Populer</label>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio" checked> Seluruh Indonesia</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Jabodetabek</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Pulau jawa</label>
                                        </div>

                                        <label for="" style="font-weight: bold">Jawa & Bali</label>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Bali</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Banten</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Daerah Istimewa Yogyakarta</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> DKI Jakarta</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Jawa Barat</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Jawa Tengah</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Jawa Timur</label>
                                        </div>

                                        <label for="" style="font-weight: bold">Sumatera dan Bangka</label>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Nanggroe Aceh Darussalam</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Kepulauan Bangka</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Jambi</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Bengkulu</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Kepulauan Riau</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Lampung</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Riau</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Barat</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Selatan</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Utara</label>
                                        </div>

                                        <label for="" style="font-weight: bold">Sulawesi</label>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Gorontalo</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Barat</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Selatan</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Tengah</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Tenggara</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Sulawesi Utara</label>
                                        </div>


                                        <label for="" style="font-weight: bold">Kalimantan</label>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Kalimantan Barat</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Kalimantan Selatan</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Kalimantan Tengah</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Kalimantan Timur</label>
                                        </div>

                                        <label for="" style="font-weight: bold">Nusa Tenggara</label>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Nusa Tenggara Barat</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Nusa Tenggara Timur</label>
                                        </div>

                                        <label for="" style="font-weight: bold">Maluku & Papua</label>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Maluku</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Maluku Utara</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Papua</label>
                                        </div>
                                        <div class="radio mt-2 ml-2">
                                            <label><input type="radio" name="optradio"> Papua Barat</label>
                                        </div>
                                    </div>

                                     <!-- Jasa Pengiriman -->
                                     <div class="col-8 p-3 pb-5" id="jasaPengiriman" style="display: none; overflow: auto; height: 375px">
                                        <fieldset class="form-group col-12">
                                            <input type="text" class="form-control text-default text-dark"
                                                id="jp-label" placeholder="Cari nama jasa pengiriman">
										</fieldset>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> SiCepat REG</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> SiCepat BEST</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> J&T REG</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Paxel Same Day</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Lion Parcel REGPACK</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Lion Parcel ONEPACK</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Grab Instant</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Grab Same Day</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Rocket Delivery</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> NINJA REG</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> NINJA FAST</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Wahana Tarif Normal</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> JNE REG</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> JNE YES</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> JNE Trucking</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> TIKI Reg</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> TIKI ONS</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> GO-SEND Same Day</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> GO-SEND Instant</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Alfatrex REG</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Alfatrex Next Day</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Pos Kilat Khusus</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Pos Next Day</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Ambil Sendiri</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> RPX Economy Package</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> RPX Next Day Package</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Kurir Toko</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Janio</label>
                                        </div>
                                    </div>

                                    <!-- Lainnya -->
                                    <div class="col-8 p-3" id="lainnya" style="display:none">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Diskon</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Cicilan</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Grosir</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
                <br>
                <?php
                  if($dataProductCount>0){
                    $this->load->view('template/product_gridView');
                  }else{
                ?>
                <!-- Empty Product State Semua barang -->
                <div class="no-product">
                    <img src="<?php echo base_url();?>assets/images/profile/TidakAdaBarang.png" alt="No Product" class="img-no-product">
                    <p class="text-default">Tidak ada barang</p>

                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--  End of Semua Barang  -->
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
                  <button class="btn btn-success crop_image" id="crop_imagebutton">Crop & Upload Image</button>
                 </div>
              </div>
           </div>

         </div>
        </div>
    </div>


</div>
