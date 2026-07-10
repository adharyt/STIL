<body>
			<div class="col-sm-9" style="margin-top:30px;">
				<div class="row d-flex" style="margin-left:10px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
					<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
						<span class="fas fa-home"></span>
					</div>
					<div class="ml-3 mt-2 p-0 h-100 align-middle">
						<h3>Daftar Alamat</h3>
					</div>
				</div>

			<div class="card p-2" style="width: 100%">
				<div class="card-body">
					<?php	if($this->userModel->checkIsHaveAddress($this->session->userdata('user_id'))>=1){ ?>
                        <div class="d-flex justify-content-end" style="margin-bottom:5px">
                            <a class="bg-success rounded pr-2 pl-2" style="cursor:pointer;">
                                <p class="text-white text-center mt-1" data-toggle="modal" data-target="#newAddressModal">+ Tambah Alamat</p>
                            </a>
                        </div>
										 <div class="row pl-3 pr-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Nama Alamat</th>
                                    <th scope="col">Alamat Pengiriman</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
															<?php foreach($memberAddress as $address){ ?>
                                <tr>
                                    <td width="5%">
																				<?php if($address['is_default']==1){ ?>
                                        <a onClick="void(0);" style="cursor:pointer;">
                                            <img src="<?php echo base_url();?>assets/images/icon-img/mark.png" class="mr-2 icon-mark">
                                        </a>
																				<?php }else{ ?>
																					<a onClick="setAddressDefault('<?php echo $address['id']; ?>');" style="cursor:pointer;">
																							<img src="<?php echo base_url();?>assets/images/icon-img/not-mark.png" class="mr-2 icon-mark">
																					</a>
																				<?php } ?>
                                    </td>
                                    <td width="25%"><?php echo $address['receiver']; ?><br> <?php echo $address['phone']; ?></td>
                                    <td width="30%"><b><?php echo $address['alias']; ?></b><br><?php echo $address['address']; ?></td>
                                    <td width="30%"><?php echo ucwords(strtolower($this->locationModel->printDetail($address['subcity'])));?> <?php echo $address['postalcode']; ?></td>
                                    <td class="justify-content-center" width="10%">
																			<div class="row">
																				<div class="col-lg-6 col-md-12" style="margin-right:-20px; margin-bottom:10px">
                                        <a  onClick="editAddressModal('<?php echo $address['id']; ?>');" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="background-color:#f28f16;cursor:pointer;">
                                            <i class="fas fa-edit mt-1 text-white"></i>
                                        </a>
																				</div>
																				<div class="col-lg-6 col-md-12" style="margin-left:-4px;">
                                        <a  onClick="deleteAddressModal('<?php echo $address['id']; ?>');" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                                        </a>
																			</div>
																			</div>
                                    </td>
                                </tr>
																<?php } ?>
                            </tbody>
                        </table>


					</div>
				<?php }else{ ?>
					<center>
						<img src="<?php echo base_url();?>assets/images/icon-img/alamat-empty.png" width="270px"><br><br>
						<h5>Anda belum menambahkan informasi alamat untuk keperluan pengiriman.</h5>
						<button onClick="$('#newAddressModal').modal('show');" class="btn btn-success" style="cursor:pointer;background-color:#f28f16;border:1px solid #f28f16;">Tambah Alamat Baru</button>
					</center>
					<br>
				<?php } ?>
				</div>
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
								<button type="button" class="btn btn-primary" onClick="insertNewAddress();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
						</div>
						</div>
				</div>
				</div>

				<!-- Edit Address Modal -->
				<div class="modal fade" id="editAddressModal" role="dialog" aria-labelledby="editAddressLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header new-address-header">
								<h5 class="modal-title new-address-title" id="editAddressLabel">Edit Alamat</h5>
								<button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
								<span aria-hidden="true" class="fas fa-times-circle"></span>
								</button>
						</div>
						<div class="modal-body d-flex justify-content-center p-2 new-address-body" id="kontenEditModal">

						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-primary" onClick="editAddressSave();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
						</div>
						</div>
				</div>
				</div>

				<!-- Delete Address Modal -->
				<div class="modal fade" id="deleteAddressModal" tabindex="-1" role="dialog" aria-labelledby="deleteAddressLabel" aria-hidden="true">
				<div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
						<div class="modal-content">
						<div class="modal-header new-address-header">
								<h5 class="modal-title new-address-title" id="deleteAddressLabel">Hapus Alamat</h5>
						</div>
						<div class="modal-body d-flex justify-content-center p-2 delete-address-body" id="kontenDeleteModal">

						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Tidak</button>
								<button type="button" class="btn btn-primary" onClick="deleteAddress();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Ya</button>
						</div>
						</div>
				</div>
				</div>
			</div>
			<br>

		</div>
	</div>
</body>
