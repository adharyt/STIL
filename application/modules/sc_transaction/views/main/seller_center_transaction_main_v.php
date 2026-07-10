<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
    <div class="title-text m-0"><i class="fa fa-exchange-alt m-0"></i> Transaksi Penjualan</div>

    <div class="tramsactioon-filter-container">
				<div class="col">
          <div class="form-group" style="margin-bottom:0px;">
						<div class="form-control dropdown-select-style" style="cursor:pointer;" onClick="$('#transactiondate').focus();">
							<span class="fa fa-calendar icon-invoice-style"></span><input readonly id="transactiondate" style="padding-left:5px;border:0px;width:80%;cursor:pointer"/>
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
            <input name="in" id="trans_date_start" value="<?php echo $filter['from'];?>" type="hidden" readonly=""/>
						<input name="in" id="trans_date_end" value="<?php echo $filter['to'];?>" type="hidden" readonly=""/>
					</div>
				</div>
				<div class="col checkbox checkbox-success">
          <?php
            $filter_pick=0;
            if($filter['transPending']==1){$filter_pick++;}
            if($filter['transProcess']==1){$filter_pick++;}
            if($filter['transSent']==1){$filter_pick++;}
            if($filter['transSuccess']==1){$filter_pick++;}
            if($filter['transDecline']==1){$filter_pick++;}
          ?>
					<div class="form-group" style="margin-bottom:0px;">
						<div class="form-control dropdown-select-style" data-toggle="dropdown" style="cursor:pointer;">
							<span class="fa fa-box icon-invoice-style">&nbsp;</span>Status transaksi (<?php if($filter_pick==5){echo "semua";}else{ echo $filter_pick; } ?> dipilih)
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
            <ul class="col dropdown-menu dropdown-container">
              <li class="dropdown-text-style" data-value="option1" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_pending" value="true" <?php if($filter['transPending']==1){echo "checked";} ?>  style="cursor:pointer;"/>&nbsp;Pending</li>
              <li class="dropdown-text-style" data-value="option2" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_process" value="true" <?php if($filter['transProcess']==1){echo "checked";} ?>  style="cursor:pointer;"/>&nbsp;Sedang Diproses</li>
              <li class="dropdown-text-style" data-value="option3" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_sent" value="true" <?php if($filter['transSent']==1){echo "checked";} ?>  style="cursor:pointer;"/>&nbsp;Sedang Dikirim</li>
              <li class="dropdown-text-style" data-value="option3" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_success" value="true" <?php if($filter['transSuccess']==1){echo "checked";} ?>  style="cursor:pointer;"/>&nbsp;Transaksi Sukses</li>
              <li class="dropdown-text-style" data-value="option3" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_decline" value="true" <?php if($filter['transDecline']==1){echo "checked";} ?>  style="cursor:pointer;"/>&nbsp;Transaksi Ditolak</li>
            </ul>
					</div>
				</div>

				<div class="col">
					<div class="form-group" style="margin-bottom:0px;">
						<div class="form-control dropdown-select-style" data-toggle="dropdown" style="cursor:pointer;">
							<span class="fa fa-truck icon-invoice-style"></span>&nbsp;Logistik/pengiriman (<?php if(count($filter['logistic_method'])==1 && $filter['logistic_method'][0]=='all'){echo "semua";}else{ echo count($filter['logistic_method']); } ?> dipilih)
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
            <ul class="col dropdown-menu dropdown-container">
							<?php foreach($couriers as $courier){ ?>
							<li class="dropdown-text-style" data-value="option1" tabIndex="-1">
								<input onChange="filter_transaction();" name="lc_method" type="checkbox" value="<?php echo $courier['id'];?>"
									<?php if(in_array('all',$filter['logistic_method']) || in_array($courier['id'],$filter['logistic_method'])){
										echo "checked";
									} ?> style="cursor:pointer;"/>
									&nbsp;<?php echo $courier['service_name'];?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="tramsactioon-filter-container">
				<div class="col-4">
          <div class="form-group" style="margin-bottom:0px;">
						<div class="form-control dropdown-select-style" data-toggle="dropdown" style="cursor:pointer;">
							<input type="hidden" id="sort_trans" value="<?php echo $filter['sort'];?>" />
							<span class="fa fa-sort-amount-down icon-invoice-style"></span>&nbsp;<?php if($filter['sort']=="TIME_DESC"){echo "Transaksi terbaru";}else{echo "Transaksi terlawas";}?>
              <span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
            </div>
						<ul class="col dropdown-menu dropdown-container">
              <a href="<?php echo base_url();?>my-store/transaction<?php echo $filter_add_bar;?>&sort=TIME_DESC"><li <?php if($filter['sort']=="TIME_DESC"){echo "style='color:#099245'";}?> class="dropdown-text-style" data-value="option1" tabIndex="-1">Transaksi terbaru</li></a>
							<a href="<?php echo base_url();?>my-store/transaction<?php echo $filter_add_bar;?>&sort=TIME_ASC"><li <?php if($filter['sort']=="TIME_ASC"){echo "style='color:#099245'";}?>class="dropdown-text-style" data-value="option1" tabIndex="-1">Transaksi terlawas</li></a>
						</ul>
					</div>
				</div>
				<div class="col form-group has-search" style="margin-bottom:0px;">
					<span class="fa fa-search form-control-search"></span>
					<input type="text" class="form-control search-text-style" placeholder="Cari Nomor Transaksi" id="reference" value="<?php echo $filter['reference'];?>">
				</div>
			</div>

      <div class="postList ml-3 mr-3 mt-3">
        <div style="color:#9c9c9c;margin-bottom:5px">
          <i><?php echo "Ditemukan <u>$totalTransaction transaksi</u> dari $totalRowCount invoice yang sesuai dengan filter saat ini";?></i>
        </div>
        <?php if(count($transactions)<1){ ?>
        <div class="no-transaction-container">
            <img style="margin-bottom:0px;width:300px" src="<?php echo base_url();?>assets/images/icon-img/transactions-not-available.png" alt="No Transaction" class="img-no-transaction">
            <p class="text-default">Transaksi tidak ditemukan</p>
        </div>
      <?php }else{
                    $data['nowData']=0;
      							foreach($transactions as $transaction){
        							$data['nowData']++;
        							$data['lastPostID']=$transaction['id'];
        							$data['transaction']=$transaction;
        							$this->load->view('template/transList',$data);
      							 }
             } ?>
    </div>

    <!-- Detail Weight Modal -->
  	<div class="modal fade" id="detailWeightModal" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" style="margin-top:100px">
  			<div class="modal-dialog" role="document">
  					<div class="modal-content" id="detailWeightModalContent">

  					</div>
  			</div>
  	</div>

      <!-- Tolak Transaksi Modal -->
      <div class="modal fade" id="declineTransactionModal" tabindex="-1" role="dialog" aria-labelledby="declineTransactionLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
                <div class="modal-content">
                <div class="modal-header new-address-header">
                    <h5 class="modal-title new-address-title">Tolak Transaksi</h5>
                </div>
                <div class="modal-body d-flex justify-content-center p-2 delete-address-body">
                    <input type="hidden" value="" id="declineTransId"/>
                    <div class="body-text mt-1"> Alasan penolakan Transaksi <b id="declineTransContent"></b>:</div>
                    <textarea class="form-control" id="decline_reason"></textarea>

                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Batal</button>
                    <button type="button" class="btn btn-primary" onClick="declineTransactionExe();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Tolak Transksi</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Accept Transaksi Modal -->
        <div class="modal fade" id="acceptTransactionModal" tabindex="-1" role="dialog" aria-labelledby="acceptTransactionLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
                  <div class="modal-content">
                  <div class="modal-header new-address-header">
                      <h5 class="modal-title new-address-title">Proses Transaksi</h5>
                  </div>
                  <div class="modal-body d-flex justify-content-center p-2 delete-address-body">
                      <input type="hidden" value="" id="acceptTransId"/>
                      <div class="body-text mt-1">Proses transaksi <b id="acceptTransContent"></b>?</div>
                  </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Batal</button>
                      <button type="button" class="btn btn-primary" onClick="acceptTransactionExe();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Proses Transksi</button>
                  </div>
                  </div>
              </div>
          </div>

          <!-- Kirim Transaksi Modal -->
          <div class="modal fade" id="kirimTransactionModal" tabindex="-1" role="dialog" aria-labelledby="kirimTransactionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
                    <div class="modal-content">
                    <div class="modal-header new-address-header">
                        <h5 class="modal-title new-address-title">Kirim Barang</h5>
                    </div>
                    <div class="modal-body d-flex justify-content-center p-2 delete-address-body">
                        <input type="hidden" value="" id="kirimTransId"/>
                        <div class="body-text mt-1">Kirim Barang <b id="kirimTransContent"></b>?</div>
                        <br>
                        Resi Pengiriman<input type="text" value="" id="kirimResi"/>
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Batal</button>
                        <button type="button" class="btn btn-primary" onClick="kirimTransactionExe();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Kirim Barang</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Update resi Modal -->
            <div class="modal fade" id="updateResiModal" tabindex="-1" role="dialog" aria-labelledby="updateResiLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
                      <div class="modal-content">
                      <div class="modal-header new-address-header">
                          <h5 class="modal-title new-address-title">Update Resi Pengiriman</h5>
                      </div>
                      <div class="modal-body d-flex justify-content-center p-2 delete-address-body">
                          <input type="hidden" value="" id="updateResiId"/>
                          <div class="body-text mt-1">Masukan resi <b id="updateResiContent"></b></div>
                          <br>
                          Resi Pengiriman<input type="text" value="" id="updateResi"/>
                      </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Batal</button>
                          <button type="button" class="btn btn-primary" onClick="updateResiExe();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Update Resi</button>
                      </div>
                      </div>
                  </div>
              </div>

              <!-- Ambil Barang Modal -->
              <div class="modal fade" id="pengambilanBarangModal" tabindex="-1" role="dialog" aria-labelledby="pengambilanBarangLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
                        <div class="modal-content">
                        <div class="modal-header new-address-header">
                            <h5 class="modal-title new-address-title">Tolak Transaksi</h5>
                        </div>
                        <div class="modal-body d-flex justify-content-center p-2 delete-address-body">
                            <input type="hidden" value="" id="pengambilanBarangId"/>
                            <div class="body-text mt-1"> Pengambilan barang <b id="pengambilanBarangContent"></b>:</div>
                              <input id="pengambilanEmail" placeholder="Email Pembeli"></input>
                              <input id="pengambilanKodeAmbil" placeholder="Kode Ambil"></input>
                        </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onClick="pengambilanBarangExe();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Ambil Barang</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- InfoPembeli Modal -->
                <div class="modal fade" id="infoPembeliModal" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" style="margin-top:100px">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header new-address-header">
                              <h5 class="modal-title new-address-title" id="editAddressLabel">Informasi Penerima Pesanan</h5>
                              <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                              <span aria-hidden="true" class="fas fa-times-circle"></span>
                              </button>
                          </div>
                          <div class="modal-body d-flex justify-content-center p-2 new-address-body">
                              <div class="row" style="padding-left:25px;padding-right:25px">

                                    <table>
                                      <tr style="padding-top:30px">
                                        <td valign="top" width="25%">Nama Penerima</td>
                                        <td valign="top">:&nbsp;</td>
                                        <td valign="top"><span id="infoPembeliModalContent_nama"></span></td>
                                      </tr>
                                      <tr style="padding-top:30px">
                                        <td valign="top" width="25%">Nomor Telepon</td>
                                        <td valign="top">:&nbsp;</td>
                                        <td valign="top"><span id="infoPembeliModalContent_telepon"></span></td>
                                      </tr>
                                      <tr style="padding-top:30px">
                                        <td valign="top" width="25%">Alamat Lengkap</td>
                                        <td valign="top">:&nbsp;</td>
                                        <td valign="top"><span id="infoPembeliModalContent_alamat"></span></td>
                                      </tr>


                                    </table>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
</div>
