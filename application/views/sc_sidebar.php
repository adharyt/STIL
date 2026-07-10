<?php
$profilPenjual=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/croppie/croppie.css">
<div class="row seller-center-container" style="min-height:700px;margin-left:0px;padding-top:75px">
    <div class="col-md-3" style="padding-left:0px">
        <div class="sidebar-seller-center-container">
            <div class="row sidebar-seller-center-profile-container">
                <div class="row">
                  <div class="col-3">
                <img id="storecurrentpic" src="<?php echo $this->storeModel->getStorePhoto($profilPenjual['store_link'],$profilPenjual['store_photo']);?>" alt="Photo Profile" class="img-profile-sidebar">
              </div>

                <div class="col-9" style="padding-top:10px">
                <div class="name-text">
                  <div><?php echo $profilPenjual['store_name'];?></div>
                  <small><?php echo $this->session->userdata('name');?></small>
                </div>
              </div>
              </div>
            </div>
            <div class="row sidebar-seller-center-profile-container">
            <div class="row">
              <div class="col-5">
                <a href="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>" target="_blank">
                  <button class="btn btn-success" style="cursor:pointer;background-color:#009245">Lihat Toko</button>
                </a>
              </div>
              <div class="col-5">
                <a href="<?php echo base_url();?>my-store/products/new" target="_blank">
                  <button class="btn btn-success" style="cursor:pointer;border:2px solid #009245;color:#009245;background-color:white;">Jual barang</button>
                </a>
              </div>
            </div>
            </div>
            <ul>
                <li class="sidebar-item <?php if($this->uri->segment(2)==''){echo 'active';}?>">
                    <a href="<?php echo base_url();?>my-store" class="default-text">
                      <i class="fa fa-home m-0" ></i>
                      Dashboard</a>
                </li>
                <li class="sidebar-item <?php if($this->uri->segment(2)=='products'){echo 'active';}?>">
                    <a href="<?php echo base_url();?>my-store/products" class="default-text">
                      <i class="fa fa-archive m-0" ></i>
                      Daftar Produk</a>
                </li>
                <li class="sidebar-item <?php if($this->uri->segment(2)=='storefront'){echo 'active';}?>">
                    <a href="<?php echo base_url();?>my-store/storefront" class="default-text">
                      <i class="fa fa-list m-0" ></i>
                      Etalase Produk</a>
                </li>
                <li class="sidebar-item <?php if($this->uri->segment(2)=='transaction'){echo 'active';}?>">
                    <a href="<?php echo base_url();?>my-store/transaction" class="default-text">
                      <i class="fa fa-exchange-alt m-0" ></i>
                      Transaksi dan Penjualan</a>
                </li>
                <li class="sidebar-item <?php if($this->uri->segment(2)=='credit'){echo 'active';}?>">
                    <a href="<?php echo base_url();?>my-store/credit" class="default-text">
                      <i class="fa fa-credit-card m-0" ></i>
                      Credit</a>
                </li>
                <li class="sidebar-item <?php if($this->uri->segment(2)=='settings'){echo 'active';}?>">
                    <a href="<?php echo base_url();?>my-store/settings" class="default-text">
                      <i class="fa fa-cogs m-0" ></i>
                      Pengaturan Toko</a>
                </li>
            </ul>
        </div>
    </div>
