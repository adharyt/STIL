<?php
$profilPenjual=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));
 ?>
<div class="row seller-center-container">
    <div class="col-md-3">
        <div class="sidebar-seller-center-container">
            <div class="row sidebar-seller-center-profile-container">
                <img src="<?php echo $this->userModel->getStorePhoto($profilPenjual['store_link'],$profilPenjual['store_photo']);?>" alt="Photo Profile" class="img-profile-sidebar">
                <div class="name-text">
                  <div><?php echo $profilPenjual['store_name'];?></div>
                  <br style="display:block;margin:0px;line-height:0px;content:'';">
                  <small><?php echo $this->session->userdata('name');?></small>
                </div>

            </div>
            <ul>
                <li class="sidebar-item">
                    <a class="default-text">Dashboard</a>
                </li>
                <li class="sidebar-item">
                    <a class="default-text">Produk</a>
                </li>
                <li class="sidebar-item">
                    <a class="default-text">Etalase Produk</a>
                </li>
                <li class="sidebar-item">
                    <a class="default-text">Penjualan</a>
                </li>
                <li class="sidebar-item">
                    <a class="default-text">Promosi</a>
                </li>
                <li class="sidebar-item">
                    <a class="default-text">Statistik</a>
                </li>
                <li class="sidebar-item">
                    <a class="default-text" onClick="show_pengaturan_toko();">Pengaturan Toko</a>
                </li>
            </ul>
        </div>
    </div>
