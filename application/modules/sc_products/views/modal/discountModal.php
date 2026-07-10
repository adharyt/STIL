<?php
$is_discount=$this->productModel->checkDiscountByParam($product['discount_start'],$product['discount_end'],$product['discount_value']);
$is_grosir=$this->productModel->checkWholesaleByParam($product['is_wholesale'],$is_discount,$product['is_discount_grosir'],$product['stock_type']);


if($is_discount!="0"){
  $disc_start=$product['discount_start'];
  $disc_end=$product['discount_end'];
}else{
  $disc_start='';
  $disc_end='';
}

if($is_discount!='0'){

  if($is_discount=='1'){
    $alert='<div class="alert alert-primary" role="alert"">
              <i class="fa fa-info" style="margin-right:10px"></i> Diskon sedang aktif hingga tanggal '.$this->timeModel->get_waktuIndo($product["discount_end"]).'
              </div>';
  }else{
    $alert='<div class="alert alert-warning" role="alert"">
              <i class="fa fa-exclamation" style="margin-right:10px"></i> Diskon akan aktif pada tanggal '.$this->timeModel->get_waktuIndo($product["discount_start"]).'
            </div>';
  }

  $header="Edit Diskon Produk";
  $button_main="Simpan Perubahan";
  $button_cancel='<button class="btn btn-success default-text m-0 mr-1" onClick="setDiscount(`unset`);"  style="background-color:#9e111f!important;border-color:#9e111f!important;color:white;cursor:pointer;" >Batalkan Diskon</button>';
}else{
  $header="Atur Diskon Produk";
  $button_main="Terapkan Diskon";
  $alert="";
  $button_cancel="";
}

?>
<div class="modal-header new-address-header">
  <h5 class="modal-title new-address-title"><?php echo $header;?></h5>
  <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer">
  <span aria-hidden="true" class="fas fa-times-circle"></span>
  </button>
</div>
<div class="modal-body" style="padding-left:25px;padding-right:25px">
  <?php
    if($alert!=''){
      echo $alert;
    }
  ?>
  <div class="row">
    <div class="col-6">
      <div style="color:gray;font-size:12px;">Nama Produk</div>
      <?php echo $product['pr_name'];?>
      <input type="hidden" value="<?php echo $product['product_id'];?>" id="disc_pr_id"/>
    </div>
    <div class="col-6">
      <div style="color:gray;font-size:12px;">Tanggal Publikasi Produk</div>
        <?php echo $this->timeModel->get_waktuIndo($product['lup']);?>
      </div>


  </div>
  <div class="row mt-4">
      <div class="col-6">
        <div style="color:gray;font-size:12px;">Periode Diskon</div>
        <input style="border: 1px solid #ced4da;border-radius: .25rem;height:30px;width:100%;cursor:pointer;text-align:center;padding-left:5px;padding-right:5px" id="selectdate" class="input_field_n" type="text" required="required" data-error="Tentukan periode diskon!" readonly value="">
    		<input name="in" id="discount_start" value="<?php echo $disc_start; ?>" class="input_field_n" type="hidden"  readonly>
    		<input name="out" id="discount_end" value="<?php echo $disc_end; ?>" class="input_field_n" type="hidden"  readonly>
      </div>
      <div class="col-6">
        <div style="color:gray;font-size:12px;">Jumlah Potongan</div>
        <div class="input-group">
          <input id="disc_value" onkeyup="discFunc()" onChange="discFunc();" type="number" min="0" max="99" class="form-control" style="max-width:60px;height:30px" value="<?php if($is_discount==1){echo $product['discount_value'];}else{echo "10";} ?>">
          <div class="input-group-append">
            <span class="input-group-text" style="border-left:0px;height:30px;margin-left:-5px">%</span>
          </div>
        </div>
        <?php if($product['is_wholesale']==1){ ?>
          <small><input id="disc_is_grosir" onChange="$('#grosir_discount').toggle();" type="checkbox" <?php if($is_discount==1 && $product['is_discount_grosir']==1){echo "checked";}else{echo"";} ?>>&nbsp;Aktifkan diskon untuk harga grosir</input></small>
        <?php } ?>
      </div>
    </div>

    <div class="row mt-4 mb-4">
      <div class="col-6">
        <div style="color:gray;font-size:12px;">Harga Awal</div>
        <div>
          <span id="disc_harga_awal">
            <?php echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product['product_id'],1,FALSE)); ?>
          </span>
          <br>
          <?php
            if($product['is_wholesale']==1){

            $grosir_html_header="
            <table width='100%' style='text-align:center'>
              <tr>
                <th style='text-align:left'>
                  <u>Unit</u>
                </th>
                <th style='padding-left:20px;text-align:left'>
                  <u>Harga</u>
                </th>
              </tr>";
            $grosir_html_content='';
            for($i=1;$i<=5;$i++){
              if($product["wh_unit$i"]!=0 && $product["wh_unit$i"]!='' && $product["wh_price$i"]!=0 && $product["wh_price$i"]!=''){
                $grosir_html_content.=
                  "	<tr>
                      <td style='text-align:left'>
                        ≥".$product["wh_unit$i"]."
                      </td>
                      <td style='padding-left:20px;text-align:left'>
                        ".$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product["product_id"],$product["wh_unit$i"],FALSE))

                      ."</td>
                    </tr>";
                }
            }
            $grosir_html_footer="
            </table>
            ";
            $grosir_html=$grosir_html_header.$grosir_html_content.$grosir_html_footer;
          ?>
         <span style="color:#828282;font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;"><a href="javascript:void(0);" title="<b>Daftar Harga Grosir</b>" data-html="true" data-toggle="popover" data-placement="bottom" data-content="<?php echo $grosir_html;?>" title="Lihat daftar harga grosir">Harga Grosir</a></span>
         <?php } ?>

        </div>
      </div>
      <div class="col-6">
        <div style="color:gray;font-size:12px;">Harga Setelah Potongan</div>
        <span id="disc_harga_akhir">
        <?php
            echo $this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product['product_id'],1,FALSE));
        ?>
        </span>
        <br>
        <?php
          $grosir_html_header="
          <table width='100%' style='text-align:center'>
            <tr>
              <th style='text-align:left'>
                <u>Unit</u>
              </th>
              <th style='padding-left:20px;text-align:left'>
                <u>Harga</u>
              </th>
            </tr>";
          $grosir_html_content='';
          for($i=1;$i<=5;$i++){
            if($product["wh_unit$i"]!=0 && $product["wh_unit$i"]!='' && $product["wh_price$i"]!=0 && $product["wh_price$i"]!=''){
                $discountGrosir='';

              $grosir_html_content.=
                "	<tr>
                    <td style='text-align:left'>
                      ≥".$product["wh_unit$i"]."
                    </td>
                    <td style='padding-left:20px;text-align:left' class='disc_val_grosir' gr_val='".$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product["product_id"],$product["wh_unit$i"],FALSE)).' '.$discountGrosir."'>
                      ".$this->currencyModel->integerToCurrency('rupiah',$this->productModel->cekHargaBarang($product["product_id"],$product["wh_unit$i"],FALSE)).' '.$discountGrosir

                    ."</td>
                  </tr>";
              }
          }
          $grosir_html_footer="
          </table>
          ";
          $grosir_html=$grosir_html_header.$grosir_html_content.$grosir_html_footer;
        ?>
        <div id="grosir_discount" style="display:<?php if($is_discount==1 && $product['is_discount_grosir']==1){echo 'block';}else{echo'none';}?>">
          <span style="color:#828282;font-size:13px;text-decoration-line: underline;text-decoration-style:dashed;"><a id="discGrosir" href="javascript:void(0);" onClick="discGrosirToggle();" title="<b>Daftar Harga Grosir</b>" data-html="true" data-toggle="popover" data-placement="bottom" data-content="<?php echo $grosir_html;?>" title="Lihat daftar harga grosir">Harga Grosir</a></span>
        </div>
      </div>
  </div>
  <div class="store-row-sb-container mt-2">

    <div class="default-text m-0">&nbsp;</div>
    <div class="mt-2 d-flex justify-content-end">
      <?php echo $button_cancel;?>
      <button class="btn btn-success default-text m-0" onClick="setDiscount(`new`);"  style="color:white;cursor:pointer;background-color:#099245;border-color:#099245" ><?php echo $button_main;?></button>
    </div>
  </div>
</div>
