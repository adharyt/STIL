<style media="screen">
.modal-header .close {
    padding: 15px;
    margin: -15px -15px -15px auto;
}
.close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
}
button.close {
    background: 0 0;
    border: 0;
    -webkit-appearance: none;
}
.new-address-header {
	background-color: #009245;
}
.new-address-title {
	font-family: 'helvetica';
	font-size: 1.2rem;
	color: white;
}
.new-address-btn-close {
	color: white;
}
.new-address-btn-close:hover {
	color: red;
}
.new-address-body {
	font-family: 'helvetica';
	font-size: 0.9rem;
	color: black;
	flex-direction: column;
	padding: 20px !important;
}
.delete-address-body {
	font-family: 'helvetica';
	font-size: 1.1rem;
	color: black;
	flex-direction: column;
	padding: 20px !important;
	align-self: center;
}
.delete-confirmation {
	font-size: 1.1rem !important;
	color: black !important;
}
.i-address-name {
	width: 100%;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 36px;
}
.select2-container--default .select2-selection--single {
    background-color: rgb(255, 255, 255);
    border-width: 1px;
    border-style: solid;
    border-color: rgb(170, 170, 170);
    border-image: initial;
    border-radius: 4px;
    height: 36px;
}

</style>
<br>
<div class="container" style="max-width:90%">

			<?php if(count($products)>0){ ?>
      <!-- Product -->
			<div class="row">
				<div class="col-lg-7">
					<div class="row">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header" style="background-color:#009245;color:white;">
										Detail Penerima dan Alamat Pengiriman
									</div>
									<div class="card-body">
										<?php	if($this->userModel->checkIsHaveAddress($this->session->userdata('user_id'))>=1){ ?>
											<select  id="receiveraddress" style="font-size:16px;margin-left:0px;width:100%;color:green;-webkit-appearance: menulist;">
 											 <?php
 											 	foreach($addressList as $address){ ?>
 													<option value="<?php echo $address['id'];?>"><?php echo '['.$address['alias'].'] '.$address['receiver'].' - '.$address['phone'];?></option >
 											  <?php } ?>
 										 </select>
 										 <br><br>
 										 <p align="justify" style="color:black">
 										 <b>Penerima:</b><br>
 										 <span id='addr_receiver'><?php echo $addressList[0]['receiver'];?></span><br><span id="addr_phone"><?php echo $addressList[0]['phone'];?></span><br>
 										 <br>
 										 <b>Alamat:</b><br>
 										 <span id="addr_address"><?php echo $addressList[0]['address'];?></span><br>
 										 <span id="addr_postal"><?php echo $addressList[0]['postalcode'];?></span><br>
 										 <br>
 									 	</p>
									<?php }else{	?>
										Anda belum menambahkan informasi alamat pengiriman.<br>
										   <button onClick="$('#newAddressModal').modal('show');" class="btn btn-success btn-xs" style="height:24px;cursor:pointer;background-color:#f28f16">Tambah Alamat Baru</button>


									<?php } ?>



									</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header" style="background-color:#009245;color:white;">
										Detail Pembelian
									</div>
									<div class="card-body" style="padding-left:5px;padding-right:5px;padding-top:20px;">
									<?php foreach($products as $product){ ?>
                      <?php if($product['count_availability']>0){ ?>
    									<div class="row seller" id="<?php echo $product['id_store'];?>">
    										<div class="col-lg-12">
    												<div class="card">
    													<div class="card-header" style="background-color:white;color:black;border:0px">
    														<b><?php echo $product['store_name'];?></b>
    													</div>
    													<div class="card-body">

    														<?php
    															$totalHargaBarang=0;
    															foreach($product['id_product'] as $productData){
                                    //VISIBILITY
      															$availability=$this->productModel->checkAvailability($productData['product_id']);
                                    if($availability==1){
      															//STOCK
      															switch($productData['stock_type']){
      																case '1':
      																		$quantity=1;
      																		$max=1;
      																		$min=1;
      																		break;
      																case '2':
      																		if($productData['stock']<$productData['quantity']){
      																			$quantity=$productData['stock'];
      																			$max=$productData['stock'];
      																			$min=$productData['buy_minimum'];
      																		}else{
      																			$quantity=$productData['quantity'];
      																			$max=$productData['stock'];
      																			$min=$productData['buy_minimum'];
      																		}
      																		break;
      																case '3':
      																		$quantity=$productData['quantity'];
      																		$min=$productData['buy_minimum'];
      																		$max=999999;
      																		break;
      																default:
      																		$quantity=1;
      																		$max=1;
      																		$min=1;
      																		break;
      															}


      															?>

      											      <div class="item items<?php echo $product['id_store'];?>" id="cart_temp<?php echo $productData['checkout_id'];?>" c_id="<?php echo $productData['checkout_id'];?>" p_id="<?php echo $productData['product_id'];?>">
      				                      <div class="row" style="width:100%;">
      				                        <div class="col-12" >
      				                              <div class="row">
      				                                <div class="col-3">
                                                <div style="border:1px solid #aeaeae;padding:5px;width:120px;height:120px;vertical-align:middle;display: inline-block;align-items: center; justify-content: center;display:flex" class="text-center">
                                                  <img src="<?php echo $this->productModel->getProductImage($productData['product_id'])[0]['img_url']; ?>" style="max-height:100%;max-width:100%;">
                                                </div>
      				                                </div>
      				                                <div class="col-9">
      																					<?php $totalharga=$this->productModel->cekHargaBarang($productData['product_id'],$quantity)*$quantity; $totalHargaBarang+=$totalharga;?>

      				                                  <div><a href="<?php echo base_url().'p/'.$productData['store_link'].'/'.$productData['product_slug'].'-'.$productData['product_uniq'];?>" target="_blank" style="color:#009245;font-size:16px"><?php echo $productData['product_name']; ?></a></div>
      																					<span style="color:#f28f16;font-size:14px" id='price<?php echo $productData['checkout_id'];?>' class="pprice<?php echo $product['id_store'];?> priceperunit"><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalharga); ?></span>
      																					<div style="line-height:10px;font-size:15px"><small style="color:gray;"><?php echo $quantity;?> barang (<?php $totweight=$productData['weight']*$quantity;if($totweight>1000){echo $this->currencyModel->integerSeparation('.',2,$totweight/1000).' kilogram';}else{ echo $this->currencyModel->integerSeparation('.',2,$totweight).' gram';} ?>)</small></div>
      																					<div class="row">
      																						<div class="col-12">
      																							<div class="cour_by_product<?php echo $product['id_store'];?>" style="display:<?php if($product['is_specialdelivery']==1){echo 'block';}else{echo 'none';} ?>;margin-top:10px">
      																								<select class="js-source-states select_cour_by_product cour_store<?php echo $product['id_store'];?>" style="display:block;width:100%" id="ship_product_<?php echo $productData['product_id'];?>" pr_id="<?php echo $productData['product_id'];?>"  sh_id="product_<?php echo $productData['product_id'];?>" st_id="<?php echo $product['id_store'];?>">
      																								</select>
      																							</div>
      																						</div>
      																					</div>
      				                                </div>

      				                              </div>


      				                        </div>
      				                      </div>
      											      </div>

      														<hr <?php if(count($product['id_product'])>1){echo 'style="border-top:0px solid"';}?>>
                                <?php } ?>
    														<?php } ?>


    														<div class="alert alert-warning" role="alert" style="display:<?php if($product['is_specialdelivery']==1){echo 'block';}else{echo 'none';} ?>">
    											  			Salah satu produk pada toko ini menggunakan fitur jasa pengiriman khusus sehingga Anda tidak dapat melakukan pemilihan kurir untuk semua produk.
    														</div>
    														<input type="hidden" id="is_specialdelivery_store_<?php echo $product['id_store'];?>" value="<?php if($product['is_specialdelivery']==0){echo 'n';}else{echo 'y';}?>">
    														<div class="cour_by_store" style="display:<?php if($product['is_specialdelivery']==0){echo 'block';}else{echo 'none';} ?>">
    														<h5>Kurir Pengiriman</h5>
    															<select class="js-source-states select_cour_by_store" style="display:block;width:100%" id="ship_store_<?php echo $product['id_store'];?>" sh_id="store_<?php echo $product['id_store'];?>" st_id="<?php echo $product['id_store'];?>">
    															</select>
    														</div>
    														<br>&nbsp;
    														<h5>Catatan Untuk Penjual</h5>
    														<textarea id="notes<?php echo $product['id_store'];?>" class="form-control" style="font-size:14px" rows="4" placeholder="Tuliskan catatan mengenai informasi khusus untuk penjual seperti pilihan ukuran, warna, dan lainnya."></textarea>

    														<div class="row" id="subtotal<?php echo $product['id_store'];?>">
    															<div class="col-12 text-right" style="padding-top:20px">
    																Subtotal: <b class="subtotalval" id="subtotalval<?php echo $product['id_store'];?>"><?php echo $this->currencyModel->integerToCurrency('rupiah',$totalHargaBarang);?></b><br>
    																<small id="ship_store_<?php echo $product['id_store'];?>_ongkir">Belum termasuk ongkos kirim</small>
    															</div>
    														</div>

    												</div>
    											</div>
    										</div>
    									</div>

    									<br>
                      <?php } ?>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

			</div>
			<div class="col-lg-5">
				<div class="row">
					<div class="col-lg-12">
							<div class="card">
								<div class="card-header" style="color:white;background-color:#009245">
									Ringkasan Belanja
								</div>
								<div class="card-body" id="summaryCart_temp">
									<div class="row">
										<div class="col-5 text-left">
											Total harga barang:
										</div>
										<div class="col-7 text-right">
											<b id="totalhargabarang">Rp 0</b><br>
										</div>
									</div>
									<div class="row">
										<div class="col-5 text-left">
											Total ongkos kirim:
										</div>
										<div class="col-7 text-right">
											<b id="totalongkir">Rp 0</b><br>
										</div>
									</div>
									<div class="row">
										<div class="col-5 text-left">
											Total bayar:
										</div>
										<div class="col-7 text-right">
											<b id="totalbayar">Rp 0</b><br>
										</div>
									</div>
										<hr>
										<div class="row">
											<div class="col-12 text-right">
												<a href="javascript:void(0);" onClick="checkout();"><div class="btn btn-md" style="color:white;background-color:#009245">Checkout</div></a>
											</div>
										</div>

								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br>
		<!-- Add new Address Modal -->
		<div class="modal fade" id="newAddressModal"  role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header new-address-header">
						<h5 class="modal-title new-address-title" id="newAddressLabel">Tambah Alamat Baru</h5>
						<button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
						<span aria-hidden="true" class="fas fa-times-circle"></span>
						</button>
				</div>
				<div class="modal-body d-flex justify-content-center p-2 new-address-body">
						<div class="row">
								<fieldset class="form-group col-md-12">
										<label for="addressName-label">Nama</label>
										<input type="text" class="form-control text-dark i-address-name" id="add-name" placeholder="Contoh: Rumah, Kos">
								</fieldset>
						</div>
						<div class="row">
								<fieldset class="form-group col">
										<label for="recipientName-label">Nama Penerima</label>
										<input type="text" class="form-control text-dark i-address-name" id="add-penerima" >
								</fieldset>
								<fieldset class="form-group col">
										<label for="telp-label">Nomer Telepon</label>
										<input type="text" class="form-control text-dark i-address-name" id="add-telepon">
								</fieldset>
						</div>
						<div class="row">
								<fieldset class="form-group col">
										<label for="city-label">Kota atau kecamatan</label>
										 <select name="search_city" id="add-kecamatan" class="form-control select2" >
											<option value="">- Pilih Kota -</option>
										 </select>
								</fieldset>
								<fieldset class="form-group col">
										<label for="poscode-label">Kode Pos</label>
										<input type="text" class="form-control text-dark i-address-name" id="add-kodepos">
								</fieldset>
						</div>
						<div class="row">
								<fieldset class="form-group col-md-12">
										<label for="address-label">Alamat</label>
										<textarea class="form-control rounded-0 text-dark i-address-name" id="add-alamat" rows="3"></textarea>
								</fieldset>
						</div>
				</div>
				<div class="modal-footer">
						<button type="button" class="btn btn-primary" onClick="insertNewAddress();" style="height:38px;background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
				</div>
				</div>
		</div>
		</div>
	<?php }else{ ?>
		<div class="row text-center">
			<div class="col-lg-12">
			<!-- Single Product -->
				<div class="single_product">
					<div class="container text-center">
						<div class="card" style="padding:50px">
							<center><img src="<?php echo base_url();?>assets/images/icon-img/trans-empty.png" width="200px"></center><br>
							<h4>Anda belum memilih barang untuk dibayar. <a href="<?php echo base_url();?>cart" style="color:#099245">Periksa keranjang belanja</a>.</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
	<?php } ?>

    </div>
