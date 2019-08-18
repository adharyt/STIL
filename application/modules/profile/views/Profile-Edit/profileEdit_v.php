<style>
	.active a {
		background-color: #FFA500 !important;
	}

	.img-profile {
		width: 100%;
	}
</style>
<body>		
			<div class="col-sm-9">
				<ul class="nav nav-tab">
					<li class="nav-item">
						<a class="nav-link active text-primary" href="#">Profil</a>
					</li>
					<span class="mt-2">></span>
					<li class="nav-item">
						<a class="nav-link" href="#">Akun Saya</a>
					</li>
				</ul>
				<div class="row d-flex">
					<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
						<span class="fas fa-user-alt"></span>
					</div>
					<div class="ml-3 mt-2 p-0 h-100 align-middle">
						<h3>Abimanyu Bhamakerti</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 p-0 d-flex">
						<div class="card p-0 bg-light"	>
							<div class="card-body d-flex flex-column">
								<img src="<?php echo base_url();?>assets/images/image-user/default_client_m.png" alt="Photo Profile" class="img-thumbnail img-profile">
								<button type="button" class="btn btn-light mt-2" style="border-color: #9400D3">Choose Photo</button>
								<div class="mt-3">
									<p class="text-justify text-center">Besar File maksimum 10 Mb
									Ekstensi ile yang diperbolehkan
									JPG, JPEG dan PNG</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-9 p-0">
						<div class="card">
							<div class="card-body mt-4 pt-0 pb-0 pr-1">
								<form class="form-group">
									<div class="row">
										<fieldset class="form-group col-lg-9">	
											<label for="nama-label">Nama</label>
											<input readonly type="text" class="form-control text-dark" id="nama-label" value="Abimanyu Bhamakerti" style="background-color:#E8E8E8">
										</fieldset>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2" id="datetimepicker3">
											<label for="date-label">Tanggal Lahir</label>
											<input readonly type='date' placeholder="10/10/2020" class="form-control text-dark" id="date-label" style="background-color:#E8E8E8"/>
										</fieldset>
									</div>    
									
									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2" style="margin-left: -10px">	
											<label for="jeniskelamin-label" style="margin-left: 10px">Jenis Kelamin</label>
											<select disabled class="form-control text-dark" id="jeniskelamin-label" style="background-color:#E8E8E8">
												<option selected>Pilih...</option>
												<option value="1">Laki-laki</option>
												<option value="2">Perempuan</option>
											</select>
											<span></span>
										</fieldset>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2" style="margin-left: -10px">
											<label for="pendidikan-label" style="margin-left: 10px">Pendidikan Terakhir</label>
											<select disabled class="form-control  text-dark" id="pendidikan-label" style="background-color:#E8E8E8">
												<option selected>Pilih...</option>
												<option value="1">Tidak / Belum Sekolah</option>
												<option value="2">Belum Tamat SD / Sederajat</option>
												<option value="3">SLTP / Sederajat</option>
												<option value="4">SLTA / Sederajat</option>
												<option value="5">Diploma I / II</option>
												<option value="6">Akademi / Diploma III / Sarjana Muda</option>
												<option value="7">Diploma IV / Sastra I</option>
												<option value="8">Sastra II</option>
												<option value="9">Sastra III</option>
											</select>
										</fieldset>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2">
											<label for="ktp-label">Nomor KTP</label>
											<input readonly type="number" class="form-control bg-white text-dark" id="ktp-label"  pattern="[0-9]" value="" style="background-color:#E8E8E8 !important">
										</fieldset>
										<div class="align-self-end pb-3	mb-1">
											<span class="badge badge-pill bg-success text-white mt-3 p-2" style="display:none">
												<span class="fas fa-check mr-1"></span>
												Verified
											</span>

											<span class="badge badge-pill bg-secondary text-white mt-3 p-2">
												<span class="fas fa-exclamation-circle mr-1"></span>
												Not verified
											</span>
										</div>
									</div>
									
									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2">
											<label for="email-label">Email</label>
											<input readonly type="email" class="form-control bg-white text-dark" id="email-label" value="abimanyu@gmail.com" style="background-color:#E8E8E8 !important">
										</fieldset>
										<div class="align-self-end pb-3	mb-1">
											<span class="badge badge-pill bg-success text-white mt-3 p-2">
												<span class="fas fa-check mr-1"></span>
												Verified
											</span>

											<span class="badge badge-pill bg-secondary text-white mt-3 p-2" style="display:none">
												<span class="fas fa-exclamation-circle mr-1"></span>
												Not verified
											</span>
										</div>
									</div>
								
									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2">
											<label for="telp-label">Nomor Telepon</label>
											<input  readonly type="number" class="form-control  text-dark" id="telp-label"  pattern="[0-9]" value="0913123123123123" style="background-color:#E8E8E8">
										</fieldset>
										<div class="align-self-end pb-3	mb-1">
											<span class="badge badge-pill bg-success text-white mt-3 p-2">
												<span class="fas fa-check mr-1"></span>
												Verified
											</span>

											<span class="badge badge-pill bg-secondary text-white mt-3 p-2" style="display:none">
												<span class="fas fa-exclamation-circle mr-1"></span>
												Not verified
											</span>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-9 mt-2 d-flex justify-content-end">
											<div class="btn btn-success" id="btnEdit" onClick="editProfile();">Edit</div>
											<div class="btn btn-success" id="btnSave" onClick="saveProfile();" style="display:none">Save</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</body>