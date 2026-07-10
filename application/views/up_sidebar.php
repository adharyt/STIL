<style media="screen">
  .header_account_title{
    font-family: 'Roboto', sans-serif;
  }
  .side_bar_menu_font{
    font-family: 'Roboto', sans-serif;
  }
</style>
<div class="row" style="min-height:500px">
    <div class="col-md-2 bg-light" style="background-color:white !important">
        <ul class="mt-2">
            <li class="p-2 m-0 border-light side_bar_menu_font">
                <a href="<?php echo base_url();?>my-account" class="m-3 ml-3 text-dark"
                  <?php if(base_url().'my-account'==current_url()){echo "style='color:#009245!important;'";}?>
                  >
                  <span class="fas fa-user-alt"></span> Ringkasan Akun</a>
            </li>
            <li class="p-2 m-0 side_bar_menu_font">
                <a href="<?php echo base_url();?>my-account/address" class="m-3 ml-3 text-dark"
                  <?php if(base_url().'my-account/address'==current_url()){echo "style='color:#009245!important;'";}?>
                  ><span class="fas fa-home"></span> Daftar Alamat</a>
            </li>
            <li class="p-2 m-0 side_bar_menu_font">
                <a href="<?php echo base_url();?>my-account/saving-account" class="m-3 ml-3 text-dark"
                  <?php if(base_url().'my-account/saving-account'==current_url()){echo "style='color:#009245!important;'";}?>
                  ><span class="fas fa-credit-card"></span> Daftar Rekening</a>
            </li>
            <li class="p-2 m-0 side_bar_menu_font">
                <a href="<?php echo base_url();?>my-account/wallet" class="m-3 ml-3 text-dark"
                  <?php if(base_url().'my-account/wallet'==current_url()){echo "style='color:#009245!important;'";}?>
                  ><span class="fas fa-wallet"></span> Dompet STIL</a>
            </li>
            <hr>

            <li class="p-2 m-0 side_bar_menu_font">
              <a href="<?php echo base_url();?>my-account/transaction" class="m-3 ml-3 text-dark"
                <?php if($this->uri->segment(1)=='my-account' && ($this->uri->segment(2)=='transaction' || $this->uri->segment(2)=='transaction-split')){echo "style='color:#009245!important;'";}?>
                ><span class="fas fa-exchange-alt"></span> Daftar Transaksi</a>
            </li>
            <li class="p-2 m-0 side_bar_menu_font">
              <a href="<?php echo base_url();?>my-account/wishlist" class="m-3 ml-3 text-dark"
                <?php if(base_url().'my-account/wishlist'==current_url()){echo "style='color:#009245!important;'";}?>
                ><span class="fas fa-heart"></span> Daftar Favorit</a>
            </li>
        </ul>
    </div>
