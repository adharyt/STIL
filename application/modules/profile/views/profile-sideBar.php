<div class="row">
    <div class="col-md-2 bg-light">
        <ul class="mt-2">
          <hr>
            <li class="p-2 m-0 border-light text-center">
                <a href="<?php echo base_url();?>product/new" target="_blank">
                  <button class="btn btn-success" style="cursor:pointer;background-color:#009245">Jual barang</button>
                </a>
            </li>
            <hr>
            <li class="p-2 m-0 border-light">
                <a href="<?php echo base_url();?>my-account" class="m-3 ml-3 text-dark"
                  <?php if(base_url().'my-account'==current_url()){echo "style='color:#009245!important;'";}?>
                  >Akun Saya</a>
            </li>
            <li class="p-2 m-0">
                <a href="<?php echo base_url();?>my-account/profile" class="m-3 ml-3 text-dark"
                  <?php if(base_url().'my-account/profile'==current_url()){echo "style='color:#009245!important;'";}?>
                  >Profil Akun</a>
            </li>
            <li class="p-2 m-0">
                <a href="<?php echo base_url();?>my-account/address" class="m-3 ml-3 text-dark"
                  <?php if(base_url().'my-account/address'==current_url()){echo "style='color:#009245!important;'";}?>
                  >Daftar Alamat</a>
            </li>
            <li class="p-2 m-0">
                <a href="#" class="m-3 ml-3 text-dark">Pengaturan Akun</a>
            </li>
        </ul>
    </div>`
