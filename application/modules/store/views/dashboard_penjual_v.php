<?php if($cekStore=='y'){ ?>
<?php $this->load->view('template/store_info');?>

    <!-- Semua barang -->
    <div class="col-md-9 dashboard-filter-product-container" id="semua_barang_container">
        <div class="card pt-2">
            <div class="card-header card-header-style" style="background-color:white">
              <div class="row" style="margin-bottom:10px">
                <div class="col">
                  <div class="text-storefront-label mb-2">Barang Dagangan Toko</div>
                  <div>
                    <?php $data['placeholderToko']="Cari barang";?>
                    <select onChange="location=this.value" class="form-control" style="float:left;height:25px;margin:0px;font-size:inherit;-webkit-appearance: menulist;width:max-content;min-width:max-content">
                      <option <?php if($activeEtalase==''){echo  'selected';} ?> value="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>">Tampilkan semua barang di toko ini</option>
                      <?php foreach($etalasePenjual as $etalase){ ?>
                        <option <?php if($activeEtalase==$etalase['slug']){echo  'selected';} ?> value="<?php echo base_url();?>s/<?php echo $profilPenjual['store_link'];?>/label/<?php echo $etalase['slug']; ?>">Tampilkan barang hanya dari etalase <b>"<?php echo ucfirst($etalase['name']);?>"</b></option>
                      <?php
                        if($activeEtalase==$etalase['slug']){
                          $data['placeholderToko']="Cari barang di etalase '".ucfirst($etalase['name'])."'";
                        }
                      } ?>
                    </select>
                  </div>
                </div>
                <div class="col" style="float:right">

                </div>
              </div>


                <?php $this->load->view('template/filterBar',$data); ?>
                <hr>
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

</div>
<?php }else if($cekStore=='c'){ ?>
  <?php $this->load->view('template/store_info');?>
  <?php $this->load->view('template/store_tutup');?>
<?php }else{ ?>
  <?php $this->load->view('template/store_not_found');?>
<?php } ?>
