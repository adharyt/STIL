<div class="modal-header new-address-header">
    <h5 class="modal-title new-address-title" id="editAddressLabel">Informasi Detail Harga Barang</h5>
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
              Sub-total Harga
            </td>
          </tr>
        <?php
          $totalharga=0;
          foreach($products as $product){
            $harga_produk=$this->productModel->cekHargaBarangTerjual($product['product_id'],$product['quantity'])*$product['quantity'];
            $totalharga+=$harga_produk;
          ?>
          <tr>
            <td  style="text-align:left">
              <a style="color:#099245" target="_blank" href="<?php echo base_url();?>history/transaction/<?php echo $product['id_trans']; ?>/p/<?php echo $product['product_id'];?>">
                <?php echo $product['pr_name'];?>
              </a>
              <small>(x<?php echo $this->currencyModel->integerSeparation('.',0,$product['quantity']);?>)</small>

            </td>
            <td style="text-align:right;padding-left:30px">
              <?php echo $this->currencyModel->integerToCurrency('rupiah',$harga_produk);?>
            </td>
          </tr>

        <?php } ?>
        <tr style="border-top:1px solid lightgray;">
          <td>
            <b>Total Harga</b>
          </td>
          <td  style="text-align:right;;padding-left:30px;padding-top:5px">
            <div>
              <b><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalharga);?></b>
            </div>
          </td>
        </tr>
      </table>
      <br>
      </center>
    </div>

</div>
