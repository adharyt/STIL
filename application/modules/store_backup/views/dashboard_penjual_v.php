<div class="card m-2 pb-5 ">
    <img src="<?php echo base_url();?>assets/images/profile/header-profile-penjual.png" alt="Photo Profile" class="img-profile-header">
    <div class="header-container row mt-2">
        <ul class="nav nav-tab">
            <li class="nav-item">
                <a class="nav-link active" href="#">Profil</a>
            </li>
            <span class="mt-2">></span>
            <li class="nav-item">
                <a class="nav-link" href="#">Ringkasan Akun</a>
            </li>
        </ul>
        <div class="btn-edit-header">
            <a>Ubah Foto Header</a>
        </div>
    </div>
    <div class="row dashboard-seller-profile-container">
        <div class="row">
            <img src="<?php echo base_url();?>assets/images/image-user/default_user_m.png" alt="Photo Profile" class="img-thumbnail img-profile">
            <div>
                <div class="ml-3 mt-5 profile-name-container">
                    <h4>Abimanyu Bhamakerti</h4>
                    <p>abimanyu.bhamakerti@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="btn-settings-shop">
            <i class="fas fa-cog icon-settings"></i>
            <a>Atur lapak</a>
        </div>
    </div>
</div>

<div class="dashboard-proudcts-container">
    <p class="text-show-products">Tampilkan berbagai pilihan<br>barang unggulan kamu disini</p>
    <div class="btn-settings-products">
        <a>Atur Barang Unggulan</a>
    </div>
</div>

<div class="row">
    <div class="col-md-2 side-bar-container">
        <div class="card p-2" >
            <div class="text-storefront-label">Etalase</div>
            <span class="text-default mt-2 hoverPointer" href="" onClick="showSemuaBarang();">Semua barang</span>
            <span class="text-default mt-2 hoverPointer" href="" onClick="showBarangDijual();">Barang Dijual</span>
            <span class="text-default mt-2 hoverPointer" href="" onClick="showBarangBelumDijual();">Barang Belum Dijual</span>
            <span class="text-default mt-2 hoverPointer" href="" onClick="showBarangDraft();">Barang Draft</span>
        </div>
    </div>

    <!-- Semua barang -->
    <div class="col-md-10 p-2 dashboard-filter-product-container" id="semua_barang_container">
        <div class="card">
            <div class="card-header card-header-style">
                <div class="row">
                    <div class="input-icons col-lg-9 col-md-6 col-sm-4">
                        <i class="fa fa-search icon"></i>
                        <input class="input-field text-default" type="text" placeholder="Cari Produk anda">
                    </div>

                    <!-- Flter Dropdown -->
                    <a href="" class="icon-horizontal col-lg-1 mt-2 text-default" data-toggle="dropdown" data-target="filter_semua_barang">
                        <i class="fa fa-sort-amount-down mt-1"></i>
                        <p class="ml-2">Terbaru</p>
                    </a>
                    <div class="dropdown-menu filter_semua_barang">
                        <a class="dropdown-item text-default" href="#">Terlaris</a>
                        <a class="dropdown-item text-default" href="#">Terbaru</a>
                        <a class="dropdown-item text-default" href="#">Termurah</a>
                        <a class="dropdown-item text-default" href="#">Termahal</a>
                        <a class="dropdown-item text-default" href="#">Diskon Terbesar</a>
                        <a class="dropdown-item text-default" href="#">Rating Tertinggi</a>
                    </div>

                    <a href="" class="icon-horizontal col-lg-1 mt-2 text-default" data-toggle="modal" data-target="#filterModal">
                        <i class="fa fa-sort-amount-down mt-1"></i>
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
                                            <label><input type="checkbox" value=""> Kurir Pelapak</label>
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
                <p class="text-bold">Semua Barang</p>

                <!-- Empty Product State Semua barang -->
                <div class="no-product">
                    <img src="<?php echo base_url();?>assets/images/profile/TidakAdaBarang.png" alt="No Product" class="img-no-product">
                    <p class="text-default">Tidak ada barang</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------- End of Semua Barang ----------- -->

    <!-- Barang Dijual -->
    <div class="col-md-10 p-2 dashboard-filter-product-container" id="barang_dijual_container" style="display: none">
        <div class="card">
            <div class="card-header card-header-style">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 pr-1">
                        <input class="form-control text-default" type="text" placeholder="Cari Produk anda">
                    </div>
                    <!-- Flter Dropdown -->
                    <form class="col-lg-2 p-0">
                        <div class="form-group text-dark">
                        <select class="form-control text-dark text-default">
                            <option selected >Semua Kategori</option>
                            <option>Kehutanan</option>
                            <option>Pertanian</option>
                            <option>Peternakan</option>
                        </select>
                        </div>
                    </form>
                    <!-- Flter Dropdown -->
                    <form class="col-2">
                        <div class="form-group text-dark">
                        <select class="form-control text-dark text-default">
                            <option selected >Semua Barang</option>
                            <option>Sedang diskon</option>
                            <option>Akan diskon</option>
                            <option>Promo Campaign</option>
                            <option>Promo Homepage</option>
                        </select>
                        </div>
                    </form>
                    <!-- Flter Dropdown -->
                    <div class="col-2 pl-2 pr-1">
                        <div class="card pl-3" style="height: 39px">
                            <a href="" class=" mt-2 text-default" data-toggle="modal" data-target="#filterCourierModal">
                                <p>Pilih Kurir</p>
                            </a>
                        </div>
                    </div>
                    <div class="modal fade" id="filterCourierModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-3" style="overflow: auto;">
                                <div class="modal-body justify-content-center p-0 pl-3 pr-3">
                                    <div class="p-3 pb-5" id="jasaPengiriman" style="overflow: auto; height: 375px">
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
                                            <label><input type="checkbox" value=""> Kurir Pelapak</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Janio</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Flter Dropdown -->
                    <form class="col-3 pl-0">
                        <div class="form-group text-dark">
                        <select class="form-control text-dark text-default">
                            <option selected >Semua Etalase</option>
                        </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Empty Product State Semua barang -->
            <div class="no-product">
                <img src="<?php echo base_url();?>assets/images/profile/TidakAdaBarang.png" alt="No Product" class="img-no-product">
                <h4>Belum ada barang dijual</h4>
                <p class="text-default text-center">Barang jualan kamu akan muncul di halaman ini. Ayo mulai berjualan di STIL sekarang!</p>
                <button class="btn btn-success">Jual barang</button>
            </div>
        </div>
    </div>
    <!-- ---------- End of Barang Dijual ----------- -->

    <!-- Barang Belum Dijual -->
    <div class="col-md-10 p-2 dashboard-filter-product-container" id="barang_belum_dijual_container" style="display: none">
        <div class="card">
            <div class="card-header card-header-style">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 pr-1">
                        <input class="form-control text-default" type="text" placeholder="Cari Produk anda">
                    </div>
                    <!-- Flter Dropdown -->
                    <form class="col-lg-2 p-0">
                        <div class="form-group text-dark">
                        <select class="form-control text-dark text-default">
                            <option selected >Semua Kategori</option>
                            <option>Kehutanan</option>
                            <option>Pertanian</option>
                            <option>Peternakan</option>
                        </select>
                        </div>
                    </form>
                    <!-- Flter Dropdown -->
                    <form class="col-2">
                        <div class="form-group text-dark">
                        <select class="form-control text-dark text-default">
                            <option selected >Semua Barang</option>
                            <option>Sedang diskon</option>
                            <option>Akan diskon</option>
                            <option>Promo Campaign</option>
                            <option>Promo Homepage</option>
                        </select>
                        </div>
                    </form>
                    <!-- Flter Dropdown -->
                    <div class="col-2 pl-2 pr-1">
                        <div class="card pl-3" style="height: 39px">
                            <a href="" class=" mt-2 text-default" data-toggle="modal" data-target="#filterCourierModal">
                                <p>Pilih Kurir</p>
                            </a>
                        </div>
                    </div>
                    <div class="modal fade" id="filterCourierModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-3" style="overflow: auto;">
                                <div class="modal-body justify-content-center p-0 pl-3 pr-3">
                                    <div class="p-3 pb-5" id="jasaPengiriman" style="overflow: auto; height: 375px">
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
                                            <label><input type="checkbox" value=""> Kurir Pelapak</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Janio</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Flter Dropdown -->
                    <form class="col-3 pl-0">
                        <div class="form-group text-dark">
                        <select class="form-control text-dark text-default">
                            <option selected >Semua Etalase</option>
                        </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Empty Product State Semua barang -->
            <div class="no-product">
                <img src="<?php echo base_url();?>assets/images/profile/TidakAdaBarang.png" alt="No Product" class="img-no-product">
                <h4>Belum ada Barang di halaman ini</h4>
                <p class="text-default text-center">Barang jualan kamu yang stoknya habis atau sedang kamu nonaktifkan akan muncul di halaman ini.
                    <br> Ayo mulai berjualan di STIL sekarang!</p>
                <button class="btn btn-success">Jual barang</button>
            </div>
        </div>
    </div>
    <!-- ---------- End of Barang Belum Dijual ----------- -->
    <div class="col-md-10 p-2 dashboard-filter-product-container" id="barang_draft_container" style="display: none">
        <div class="card">
            <div class="alert alert-warning p-2" role="alert">
                <h4>Batas Penyimpanan Barang Draf</h4>
                <ul>
                    <li>Barang yang disimpan di draf maksimum 20 barang.</li>
                    <li>Jika barang tidak dijual dalam waktu 2 minggu setelah draf disimpan, akan dihapus secara otomatis.</li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="no-product">
                <img src="<?php echo base_url();?>assets/images/profile/TidakAdaBarang.png" alt="No Product" class="img-no-product">
                <p class="text-default">Belum ada barang draft</p>
            </div>
        </div>
    </div>
</div>
