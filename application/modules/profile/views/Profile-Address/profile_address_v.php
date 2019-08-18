<body>
		<div class="col-lg-9">
			<ul class="nav nav-tab">
				<li class="nav-item">
					<a class="nav-link active text-primary" href="#">Profil</a>
				</li>
				<span class="mt-2">></span>
				<li class="nav-item">
					<a class="nav-link" href="#">Daftar Alamat</a>
				</li>
			</ul>
		
			<div class="card p-2" style="width: 100%">
				<div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="bg-success rounded pr-2 pl-2">
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
                                <tr>
                                    <td>
                                        <a>
                                            <img src="<?php echo base_url();?>assets/images/icon-img/mark.png" alt="Icon Cash" class="mr-2 icon-mark">
                                        </a>
                                    </td>
                                    <td>Dadang Suparman<br> 081310842519</td>
                                    <td>Rumah dadang</td>
                                    <td>Jl. Ujung berung no. 1 Rt.02 Rw 05, Bogor, 16161</td>
                                    <td class="row d-flex justify-content-between">
                                        <a  data-toggle="modal" data-target="#editAddressModal" class="pl-2 pr-2 pt-1 pb-1 rounded row btn-edit">
                                            <i class="fas fa-edit mt-1 mr-1 text-white"></i>
                                            <p class="text-white">Edit</p>
                                        </a>
                                        <a  data-toggle="modal" data-target="#deleteAddressModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded row ml-1">
                                            <i class="fas fa-trash-alt mt-1 mr-1 text-white"></i>
                                            <p class="text-white">Delete</p>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Abimanyu<br>081310841235</td>
                                    <td>Kos</td>
                                    <td>Jl. Ujung berung no. 1 Rt.02 Rw 05, Bogor, 16161</td>
                                    <td class="row d-flex justify-content-between">
                                        <a  data-toggle="modal" data-target="#editAddressModal" class="pl-2 pr-2 pt-1 pb-1 rounded row btn-edit">
                                            <i class="fas fa-edit mt-1 mr-1 text-white"></i>
                                            <p class="text-white">Edit</p>
                                        </a>
                                        <a  data-toggle="modal" data-target="#deleteAddressModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded row ml-1">
                                            <i class="fas fa-trash-alt mt-1 mr-1 text-white"></i>
                                            <p class="text-white">Delete</p>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Add new Address Modal -->
                        <div class="modal fade" id="newAddressModal" tabindex="-1" role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header new-address-header">
                                <h5 class="modal-title new-address-title" id="newAddressLabel">Tambah Alamat Baru</h5>
                                <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="fas fa-times-circle"></span>
                                </button>
                            </div>
                            <div class="modal-body d-flex justify-content-center p-2 new-address-body">
                                <div class="row">
                                    <fieldset class="form-group col-md-12">	    
                                        <label for="addressName-label">Nama</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="addressName-label" placeholder="Contoh: Rumah, Kos">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col">	
                                        <label for="recipientName-label">Nama Penerima</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="recipientName-label" >
                                    </fieldset>
                                    <fieldset class="form-group col">	
                                        <label for="telp-label">Nomer Telepon</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="telp-label">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col">	
                                        <label for="city-label">Kota atau kecamatan</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="city-label">
                                    </fieldset>
                                    <fieldset class="form-group col">	
                                        <label for="poscode-label">Kode Pos</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="poscode-label">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col-md-12">	
                                        <label for="address-label">Alamat</label>
                                        <textarea class="form-control rounded-0 text-dark i-address-name" id="address-label" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Edit Address Modal -->
                        <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header new-address-header">
                                <h5 class="modal-title new-address-title" id="editAddressLabel">Edit Alamat</h5>
                                <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="fas fa-times-circle"></span>
                                </button>
                            </div>
                            <div class="modal-body d-flex justify-content-center p-2 new-address-body">
                                <div class="row">
                                    <fieldset class="form-group col-md-12">	    
                                        <label for="addressName-label">Nama</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="addressName-label" placeholder="Contoh: Rumah, Kos">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col">	
                                        <label for="recipientName-label">Nama Penerima</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="recipientName-label">
                                    </fieldset>
                                    <fieldset class="form-group col">	
                                        <label for="telp-label">Nomer Telepon</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="telp-label">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col">	
                                        <label for="city-label">Kota atau kecamatan</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="city-label">
                                    </fieldset>
                                    <fieldset class="form-group col">	
                                        <label for="poscode-label">Kode Pos</label>
                                        <input type="text" class="form-control text-dark i-address-name" id="poscode-label">
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <fieldset class="form-group col-md-12">	
                                        <label for="address-label">Alamat</label>
                                        <textarea class="form-control rounded-0 text-dark i-address-name" id="address-label" rows="3"></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Delete Address Modal -->
                        <div class="modal fade" id="deleteAddressModal" tabindex="-1" role="dialog" aria-labelledby="deleteAddressLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header new-address-header">
                                <h5 class="modal-title new-address-title" id="deleteAddressLabel">Hapus Alamat</h5>
                                <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="fas fa-times-circle"></span>
                                </button>
                            </div>
                            <div class="modal-body d-flex justify-content-center p-2 delete-address-body">
                                <div class="row">
                                    <p class="delete-confirmation">Apakah anda yakin akan menghapus alamat ini?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                            </div>
                            </div>
                        </div>
                        </div>
					</div>
				</div>
			</div>

		</div>
	</div>
</body>