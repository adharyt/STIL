<style media="screen">
  .tabs-left,.tabs-left-content,.tabs-right,.tabs-right-content{display:table-cell}.nav-tabs.tabs-left .slide{height:35px;width:4px;bottom:15px}.nav-tabs.tabs-right .slide{height:35px;width:4px;bottom:15px;right:0}.md-tabs.tabs-left .nav-item,.md-tabs.tabs-right .nav-item,.tabs-left .nav-item,.tabs-right .nav-item{width:100%;position:relative}.md-tabs{position:relative}.md-tabs .nav-item+.nav-item{margin:0}.md-tabs .nav-link{border:none;color:#37474f}.md-tabs .nav-item{-webkit-box-flex:1;-ms-flex:1;flex:1;text-align:center;position:relative}.md-tabs .nav-link:focus,.md-tabs .nav-link:hover{border:none}.md-tabs .nav-item .nav-link.active~.slide{opacity:1;-webkit-transition:all .3s ease-out;transition:all .3s ease-out}.md-tabs .nav-item .nav-link~.slide{opacity:0;-webkit-transition:all .3s ease-out;transition:all .3s ease-out}.md-tabs .nav-item.open .nav-link,.md-tabs .nav-item.open .nav-link:focus,.md-tabs .nav-item.open .nav-link:hover,.md-tabs .nav-link.active,.md-tabs .nav-link.active:focus,.md-tabs .nav-link.active:hover{color:#099235;border:none;background-color:transparent;border-radius:0}.md-tabs .nav-item a{padding:20px 0;color:#37474f}.nav-tabs .slide{background:#099235;width:100%;height:4px;position:absolute;-webkit-transition:left .3s ease-out;transition:left .3s ease-out;bottom:0}.nav-tabs .slide .nav-item.show .nav-link,.nav-tabs .slide .nav-link{color:#099235}
.md-tabs .nav-item a {
      padding: 0px 0;
      padding-bottom:5px;
  }
</style>
<ul class="nav nav-tabs md-tabs  b-none" role="tablist">
  <li class="nav-item">
    <a class="nav-link <?php if($this->uri->segment(3)=='general' || $this->uri->segment(3)==''){echo 'active';}?>"  href="<?php echo base_url();?>my-store/settings/general" role="tab">Informasi Toko</a>
    <div class="slide"></div>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($this->uri->segment(3)=='rekening'){echo 'active';}?>" href="<?php echo base_url();?>my-store/settings/rekening" role="tab">Rekening Toko</a>
    <div class="slide"></div>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($this->uri->segment(3)=='shipping_schedule'){echo 'active';}?>"  href="<?php echo base_url();?>my-store/settings/shipping_schedule" role="tab">Waktu Proses Pesanan</a>
    <div class="slide"></div>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($this->uri->segment(3)=='shipping'){echo 'active';}?>"  href="<?php echo base_url();?>my-store/settings/shipping" role="tab">Kurir Pengiriman</a>
    <div class="slide"></div>
  </li>
  <!--
  <li class="nav-item">
    <a class="nav-link"  href="#wdHistoryTabs" role="tab">Jadwal Tutup Toko</a>
    <div class="slide"></div>
  </li>
  -->
</ul>
