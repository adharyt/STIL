<style media="screen">
  .label-detpen{
    background-color: none;
    border:1px solid #099245;
    color: #099245;
  }
</style>
<div class="row">
    <div class="input-icons col-lg-9 col-md-6 col-sm-4">
        <i class="fa fa-search icon"></i>
        <form>
        <input value="<?php if($data_search['keyword']!=''){echo $data_search['keyword'];}?>" class="input-field text-default" name="search_keyword" type="text" placeholder="<?php echo $placeholderToko;?>" style="width:90%;margin-right:0px">
        <button type="submit" class="btn btn-primary" style="background-color:#099245;border-color:#099245;height:36px;margin-left:-5px;cursor:pointer">Cari</button>
      </form>
    </div>

    <!-- Flter Dropdown -->

    <a href="" class="col-lg-3 mt-0 text-left" data-toggle="modal" data-target="#filterModal" >
<button class="btn btn-primary" style="background-color: white;color:#099245;border-color:#099245;height:36px;margin-left:-5px;cursor:pointer;float:right"><i class="fa fa-filter mt-1"></i>&nbsp;Pengaturan Filter</button>

    </a>
    <div class="ml-3">
      <small style="border-bottom:1px dotted;cursor:pointer" onClick="toggleDetailPencarian();" id="detailPencarianText">Tampilkan filter pencarian</small><br>
      <span id="detailPencarian" style="display:none">
      Rentang Harga: <?php if($data_search['price_min']!=''){echo "<span class='label label-detpen'>Minimal ".$this->currencyModel->integerToCurrency('rupiah',$data_search['price_min'])."</span>&nbsp;";}  if($data_search['price_max']!=''){echo "<span class='label label-detpen'>Maksimal ".$this->currencyModel->integerToCurrency('rupiah',$data_search['price_max'])."</span>&nbsp;";}if($data_search['price_min']=='' && $data_search['price_max']==''){echo '<span class="label label-detpen">Tidak diatur</span>';}?><br>
      <!--Kondisi Barang: <?php if($data_search['is_condition_new']==1 && $data_search['is_condition_second']==1){echo '<span class="label label-detpen">Baru</span>&nbsp;<span class="label label-detpen">Bekas</span>';}else if($data_search['is_condition_new']==1){echo '<span class="label label-detpen">Baru</span>';}else if($data_search['is_condition_second']==1){echo '<span class="label label-detpen">Bekas</span>';}else{echo '<span class="label label-detpen">Baru</span>&nbsp;<span class="label label-detpen">Bekas</span>';}?><br>-->
      Rating Barang: <?php if($data_search['search_minimum_rating']==0){echo "<span class='label label-detpen'>Semua rating</span>";}else{echo "<span class='label label-detpen'>Bintang ".$data_search['search_minimum_rating']." keatas</span>";} ?><br>
      Jasa Pengiriman: <?php if($data_search['courier']=='all'){echo "<span class='label label-detpen'>Semua jasa pengiriman</span>";}else{$cours=explode(',',$data_search['courier']);foreach($cours as $cour)echo "<span class='label label-detpen'>".$this->courierModel->getCourierServiceName($cour)."</span>&nbsp;";}?>
      </span>
    </div>

    <?php $this->load->view('template/filterModal'); ?>

</div>
