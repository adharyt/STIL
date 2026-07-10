<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text">Pengaturan Alamat</div>
    <div class="default-text">Atur alamat utamamu di sini. Alamat utama digunakan untuk perhitungan ongkos kirim saat pembeli berbelanja di tokomu.</div>

    <div class="card p-2 mt-4" style="width: 100%">
				<div class="card-body">
                        <div class="d-flex justify-content-end" style="margin-bottom:5px">
                            <a class="bg-success rounded pr-2 pl-2" style="cursor:pointer;display:none">
                                <p class="text-white text-center mt-1" data-toggle="modal" data-target="#newAddressModal">+ Tambah Address</p>
                            </a>
                        </div>
					<div class="row pl-3 pr-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Nama Alamat</th>
                                    <th scope="col">Alamat Pengiriman</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="25%">Doe</td>
                                    <td width="30%">Desa Penari</td>
                                    <td width="30%">Jl. Wuwung Raya no. 123</td>
                                    <td class="justify-content-center" width="10%">
                                        <a data-toggle="modal" data-target="#editAddressModal" class="pl-2 pt-1 pb-1 rounded btn-edit" style="background-color:#f28f16;cursor:pointer;">
                                            <i class="fas fa-edit mt-1 text-white"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteAddressModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Add new Address Modal -->
                        <div class="modal fade" id="newAddressModal"  role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-custom-container">
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
                                        <input value="" type="text" class="form-control text-dark i-address-name" id="edit-name" placeholder="Contoh: Rumah, Kos">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col">
                                        <label for="recipientName-label">Nama Penerima</label>
                                        <input value="" type="text" class="form-control text-dark i-address-name" id="edit-penerima" >
                                    </fieldset>
                                    <fieldset class="form-group col">
                                        <label for="telp-label">Nomer Telepon</label>
                                        <input value="" type="text" class="form-control text-dark i-address-name" id="edit-telepon">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col">
                                        <label for="city-label">Kota atau kecamatan</label>
                                        <select name="search_city" id="edit-kecamatan" class="form-control select2" style="margin-left:0px;">
                                            <option value="">&nbsp;</option>
                                        </select>
                                    </fieldset>
                                    <fieldset class="form-group col">
                                        <label for="poscode-label">Kode Pos</label>
                                        <input value="" type="text" class="form-control text-dark i-address-name" id="edit-kodepos">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="address-label">Alamat</label>
                                        <textarea class="form-control rounded-0 text-dark i-address-name" id="edit-alamat" rows="3"></textarea>
                                    </fieldset>
                                </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Edit Address Modal -->
                        <div class="modal fade" id="editAddressModal" role="dialog" aria-labelledby="editAddressLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header new-address-header">
                                <h5 class="modal-title new-address-title" id="editAddressLabel">Edit Address</h5>
                                <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                                <span aria-hidden="true" class="fas fa-times-circle"></span>
                                </button>
                            </div>
                            <div class="modal-body d-flex justify-content-center p-2 new-address-body" id="kontenEditModal">
                            <div class="row">
                                <fieldset class="form-group col-md-12">
                                    <label for="addressName-label">Nama</label>
                                    <input value="" type="text" class="form-control text-dark i-address-name" id="edit-name" placeholder="Contoh: Rumah, Kos">
                                </fieldset>
                            </div>
                            <div class="row">
                                <fieldset class="form-group col">
                                    <label for="recipientName-label">Nama Penerima</label>
                                    <input value="" type="text" class="form-control text-dark i-address-name" id="edit-penerima" >
                                </fieldset>
                                <fieldset class="form-group col">
                                    <label for="telp-label">Nomer Telepon</label>
                                    <input value="" type="text" class="form-control text-dark i-address-name" id="edit-telepon">
                                </fieldset>
                            </div>
                            <div class="row">
                                <fieldset class="form-group col">
                                    <label for="city-label">Kota atau kecamatan</label>
                                    <select name="search_city" id="edit-kecamatan" class="form-control select2" style="margin-left:0px;">
                                    <option value="">&nbsp;</option>
                                    </select>
                                </fieldset>
                                <fieldset class="form-group col">
                                    <label for="poscode-label">Kode Pos</label>
                                    <input value="" type="text" class="form-control text-dark i-address-name" id="edit-kodepos">
                                </fieldset>
                            </div>
                            <div class="row">
                                <fieldset class="form-group col-md-12">
                                    <label for="address-label">Alamat</label>
                                    <textarea class="form-control rounded-0 text-dark i-address-name" id="edit-alamat" rows="3"></textarea>
                                </fieldset>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Delete Address Modal -->
                        <div class="modal fade" id="deleteAddressModal" tabindex="-1" role="dialog" aria-labelledby="deleteAddressLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
                            <div class="modal-content">
                            <div class="modal-header new-address-header">
                                <h5 class="modal-title new-address-title" id="deleteAddressLabel">Hapus Address</h5>
                            </div>
                            <div class="modal-body d-flex justify-content-center p-2 delete-address-body" id="kontenDeleteModal">
                                <div class="body-text mt-1"> Apakah kamu yakin ingin mengapus Alamat ini:</div>

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
