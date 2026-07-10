<?php
$profilPenjual=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));
 ?>
<div class="row seller-center-title-container">
    <div class="row">
        <img class="logo-img"src="<?php echo base_url();?>assets/images/logoName.png">
        <div class="seller-center-title-text">My Store</div>
    </div>
    <div class="seller-center-icon-header-container">
      <i class="fa fa-bell icon-style" aria-hidden="true"></i>
      <i class="fa fa-envelope icon-style" aria-hidden="true"></i>
      <div class="horizontal-divider"></div>
      <div class="seller-center-profile-header-container">
        <img src="<?php echo $this->userModel->getStorePhoto($profilPenjual['store_link'],$profilPenjual['store_photo']);?>" alt="Photo Profile" class="img-profile-header">
        <i class="fa fa-sort-down icon-style" aria-hidden="true"></i>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
