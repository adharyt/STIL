<body>
			<div class="col-sm-9" style="margin-top:30px;">
				<div class="row d-flex" style="margin-left:10px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
					<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
						<span class="fas fa-credit-card"></span>
					</div>
					<div class="ml-3 mt-2 p-0 h-100 align-middle">
						<h3>Daftar Rekening</h3>
					</div>
				</div>

			<div class="card p-2" style="width: 100%">
				<div class="card-body">
					<?php	if($this->userModel->checkIsHaveRekening($this->session->userdata('user_id'))>=1){ ?>
                        <div class="d-flex justify-content-end" style="margin-bottom:5px">
                            <a class="bg-success rounded pr-2 pl-2" style="cursor:pointer;">
                                <p class="text-white text-center mt-1" data-toggle="modal" data-target="#newRekeningModal">+ Tambah Rekening</p>
                            </a>
                        </div>
					<div class="row pl-3 pr-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nama Bank</th>
                                    <th scope="col">Nomor Rekening</th>
                                    <th scope="col">Nama Pemilik Rekening</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
															<?php foreach($memberRekening as $rekening){ ?>
                                <tr>
                                    <td width="5%">
																				<?php if($rekening['is_default']==1){ ?>
                                        <a onClick="void(0);" style="cursor:pointer;">
                                            <img src="<?php echo base_url();?>assets/images/icon-img/mark.png" class="mr-2 icon-mark">
                                        </a>
																				<?php }else{ ?>
																					<a onClick="setRekeningDefault('<?php echo $rekening['id']; ?>');" style="cursor:pointer;">
																							<img src="<?php echo base_url();?>assets/images/icon-img/not-mark.png" class="mr-2 icon-mark">
																					</a>
																				<?php } ?>
                                    </td>
                                    <td width="25%"><b><?php echo $rekening['nama_bank']; ?></b><?php if($rekening['cabang']!=''){echo " cabang pembuka $rekening[cabang]";} ?></td>
                                    <td width="30%"><?php echo $rekening['rekening']; ?></td>
                                    <td width="30%"><?php echo $rekening['atas_nama']; ?></td>
                                    <td class="justify-content-center" width="10%">
																			<div class="row">
																				<div class="col-lg-6 col-md-12" style="margin-right:-20px; margin-bottom:10px">
	                                        <a  onClick="editRekeningModal('<?php echo $rekening['id']; ?>');" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="background-color:#f28f16;cursor:pointer;">
	                                            <i class="fas fa-edit mt-1 text-white"></i>
	                                        </a>
																				</div>
																				<div class="col-lg-6 col-md-12" style="margin-left:-4px;">
	                                        <a  onClick="deleteRekeningModal('<?php echo $rekening['id']; ?>');" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
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
						<img src="<?php echo base_url();?>assets/images/icon-img/rekening-empty.png" width="270px">
						<h5>Anda belum menambahkan informasi nomor rekening.</h5><br>
						<button onClick="$('#newRekeningModal').modal('show');" class="btn btn-success" style="cursor:pointer;background-color:#f28f16;border:1px solid #f28f16;">Tambah Nomor Rekening</button>
					</center>
					<br>
				<?php } ?>
				</div>
				<!-- Add new Address Modal -->
				<div class="modal fade" id="newRekeningModal"  role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header new-address-header">
								<h5 class="modal-title new-address-title" id="newRekeningLabel">Tambah Rekening Baru</h5>
								<button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
								<span aria-hidden="true" class="fas fa-times-circle"></span>
								</button>
						</div>
						<div class="modal-body d-flex justify-content-center p-2 new-address-body">
								<div class="row">
										<fieldset class="form-group col-md-12">
												<label for="addressName-label">Nama Bank</label>
												<select name="search_rekening" id="nama_bank" class="form-control dropdown-select-style" style="margin-left:0px">
														<option value="">- Pilih Rekening -</option>
														<?php foreach($listBank as $bank){ ?>
															<option value="<?php echo $bank['id'];?>"><?php echo $bank['nama_bank'];?></option>
														<?php } ?>
												</select>
										</fieldset>
								</div>
								<div class="row">
										<fieldset class="form-group col-md-12">
												<label for="addressName-label">Cabang Pembuka</label>
												<input type="text" class="form-control text-dark i-address-name" id="cabang_bank" placeholder="Misalnya: BNI KCP Jakarta Pusat">
										</fieldset>
								</div>
								<div class="row">
										<fieldset class="form-group col-md-12">
												<label for="addressName-label">Nomor Rekening</label>
												<input type="text" class="form-control text-dark i-address-name" id="nomor_rekening">
										</fieldset>
								</div>
								<div class="row">
										<fieldset class="form-group col-md-12">
												<label for="addressName-label">Nama Pemilik Rekening</label>
												<input type="text" class="form-control text-dark i-address-name" id="nama_pemilik_rekening">
										</fieldset>
								</div>

						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-primary" onClick="insertNewRekening();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
						</div>
						</div>
				</div>
				</div>

				<!-- Edit Rekening Modal -->
				<div class="modal fade" id="editRekeningModal" role="dialog" aria-labelledby="editRekeningLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header new-address-header">
								<h5 class="modal-title new-address-title" id="editRekeningLabel">Edit Rekening</h5>
								<button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
								<span aria-hidden="true" class="fas fa-times-circle"></span>
								</button>
						</div>
						<div class="modal-body d-flex justify-content-center p-2 new-address-body" id="kontenEditModal">

						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-primary" onClick="editRekeningSave();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
						</div>
						</div>
				</div>
				</div>

				<!-- Delete Rekening Modal -->
				<div class="modal fade" id="deleteRekeningModal" tabindex="-1" role="dialog" aria-labelledby="deleteRekeningLabel" aria-hidden="true">
				<div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
						<div class="modal-content">
						<div class="modal-header new-address-header">
								<h5 class="modal-title new-address-title" id="deleteRekeningLabel">Hapus Rekening</h5>
						</div>
						<div class="modal-body d-flex justify-content-center p-2 delete-address-body" id="kontenDeleteModal">

						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Tidak</button>
								<button type="button" class="btn btn-primary" onClick="deleteRekening();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Ya</button>
						</div>
						</div>
				</div>
				</div>
			</div>
			<br>

		</div>
	</div>
</body>
