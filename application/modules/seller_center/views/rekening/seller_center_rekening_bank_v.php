<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text">Rekening Bank</div>
    <div class="default-text">Tambahkan rekening bank untuk keperluan pencairan dana dari STIL.</div>
    <div class="alert alert-warning alert-custom-container">
        <i class="fa fa-info-circle icon-style" aria-hidden="true"></i>
        <div class="default-text">Cermatlah dalam mengisi data rekening bank. Bukalapak  tidak bertanggung jawab  
        apabila terjadi hal yang tidak diinginkan akibat kesalahan dalam pengisian data rekening bank yang 
        meliputi nomor rekening, nama pemilik rekening dan nama bank.</div> 
    </div>

    <div class="card p-2" style="width: 100%">
				<div class="card-body">
                        <div class="d-flex justify-content-end" style="margin-bottom:5px">
                            <a class="bg-success rounded pr-2 pl-2" style="cursor:pointer;">
                                <p class="text-white text-center mt-1" data-toggle="modal" data-target="#newRekeningModal">+ Tambah Rekening</p>
                            </a>
                        </div>
					<div class="row pl-3 pr-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Bank   </th>
                                    <th scope="col">Nomor Rekening</th>
                                    <th scope="col">Atas Nama</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="25%">BCA</td>
                                    <td width="30%">0123456123</td>
                                    <td width="30%">Abimanyu Bhamakerti</td>
                                    <td class="justify-content-center" width="10%">
                                        <a data-toggle="modal" data-target="#editRekeningModal" class="pl-2 pt-1 pb-1 rounded btn-edit" style="background-color:#f28f16;cursor:pointer;">
                                            <i class="fas fa-edit mt-1 text-white"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteRekeningModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Add new Rekening Modal -->
                        <div class="modal fade" id="newRekeningModal"  role="dialog" aria-labelledby="newRekeningLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-custom-container">
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
                                        <select name="search_rekening" id="add-rekening" class="form-control dropdown-select-style">
                                            <option value="">- Pilih Rekening -</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="addressName-label">Atas Nama</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="add-name">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="addressName-label">Nomor Rekening</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="add-name">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
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
                            <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="addressName-label">Nama Bank</label>
                                        <select name="search_rekening" id="add-rekening" class="form-control dropdown-select-style">
                                            <option value="">- Pilih Rekening -</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="addressName-label">Atas Nama</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="add-name">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="addressName-label">Nomor Rekening</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="add-name">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onClick="editAddressSave();" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Delete Address Modal -->
                        <div class="modal fade" id="deleteRekeningModal" tabindex="-1" role="dialog" aria-labelledby="deleteRekeningLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
                            <div class="modal-content">
                            <div class="modal-header new-address-header">
                                <h5 class="modal-title new-address-title" id="deleteRekeningLabel">Hapus Rekening</h5>
                            </div>
                            <div class="modal-body d-flex justify-content-center p-2 delete-address-body" id="kontenDeleteModal">
                                <div class="body-text mt-1"> Apakah kamu yakin ingin mengapus rekening ini:</div>
                                <div class="body-bold-text mt-1"> BCA</div>
                                <div class="body-text mt-1">Atas nama Abimanyu bhamakerti (0773490391)</div>

                            </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Tidak</button>
                                <button type="button" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Ya</button>
                            </div>
                            </div>
                        </div>
                        </div>
					</div>
				</div>
			</div>

   
    
    
</div>
</div>
