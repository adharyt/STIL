<div class="modal-header new-address-header">
    <h5 class="modal-title new-address-title" id="editAddressLabel">Informasi Detail Berat Barang</h5>
    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
    <span aria-hidden="true" class="fas fa-times-circle"></span>
    </button>
</div>
<div class="modal-body justify-content-center p-2">
  <div style="padding-right:10px;padding-left:10px">
        <center>

        <table width="100%">
          <tr>
            <td  style="color:gray;font-size:13px;text-align:left">
              Info Produk
            </td>
            <td  style="color:gray;font-size:13px;text-align:right;padding-left:30px">
              Sub-total Berat
            </td>
          </tr>
        <?php
          $totalweight=0;
          foreach($products as $product){
          $totalweight=$totalweight+($product['quantity']*$product['weight']);
          ?>
          <tr>
            <td  style="text-align:left">
              <a style="color:#099245" target="_blank" href="<?php echo base_url();?>history/transaction/<?php echo $product['id_trans']; ?>/p/<?php echo $product['product_id'];?>">
                  <?php echo $product['pr_name'];?>
              </a>
              <small>(x<?php echo $this->currencyModel->integerSeparation('.',0,$product['quantity']);?> @ <?php echo $this->currencyModel->integerSeparation('.',2,$product['weight']); ?> gram)</small>

            </td>
            <td style="text-align:right;padding-left:30px">
              <?php echo $this->currencyModel->integerSeparation('.',4,(($product['quantity']*$product['weight'])/1000));?> kilogram
            </td>
          </tr>

        <?php }
          if($totalweight!=0){
            $total_weight_kg=$totalweight/1000;
            $total_weight_kg_cour=$total_weight_kg;
          }else{
            $total_weight_kg=0;
            $total_weight_kg_cour=1;
          }

         ?>
        <tr style="border-top:1px solid lightgray;">
          <td>
            <b>Total Berat</b>
          </td>
          <td  style="text-align:right;;padding-left:30px;padding-top:5px">
            <div>
              <b><?php echo $this->currencyModel->integerSeparation('.',4,$total_weight_kg);?> kilogram</b>
            </div>
            <div style="padding-top:0px;margin-top:0px;vertical-align:top;line-height:10px">
              <small style="color:gray">
                dibulatkan menjadi <?php echo $this->currencyModel->integerSeparation('.',0,ceil($total_weight_kg));?> kilogram <i class="fas fa-question-circle"></i>
              </small>
            </div>
          </td>
        </tr>
      </table>
      <br>
      <div style="padding:10px;border:1px solid lightgray">
      <table width="100%">
        <tr>
          <td rowspan="3">
            <img src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" style="max-width:100px">&nbsp;&nbsp;
          </td>
          <td>
            Jenis Layanan
          </td>
          <td>
            :&nbsp;
          </td>
          <td style="text-align:right">
            <?php echo $courier['service_name'];?>
          </td>
        </tr>
        <?php if($courier['cour_id']!=1){ ?>
        <tr>
          <td>
            Harga Layanan<small>/kilogram</small>
          </td>
          <td>
            :&nbsp;
          </td>
          <td style="text-align:right">
            <?php echo $this->currencyModel->integerToCurrency('rupiah',($courier['price']/ceil($total_weight_kg_cour)));?>
          </td>
        </tr>
        <tr>
          <td>
            Total Biaya Pengiriman
          </td>
          <td>
            :&nbsp;
          </td>
          <td style="text-align:right">
            <?php echo $this->currencyModel->integerToCurrency('rupiah',$courier['price']);?>
          </td>
        </tr>
      <?php }else{ ?>
        <tr>
          <td>
            Biaya Layanan
          </td>
          <td>
            :&nbsp;
          </td>
          <td style="text-align:right">
            <?php echo $this->currencyModel->integerToCurrency('rupiah',$courier['price']);?>
          </td>
        </tr>
      <?php } ?>
      </table>
    </div>
      <br>
      </center>
    </div>

</div>
