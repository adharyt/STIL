<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<style>
	fieldset.form-group {
		position: relative;
	}

	.active a {
		background-color: #FFA500 !important;
	}

	label {
		position: absolute;
		top: 0.6rem;
		left: 1rem;
		color:grey;
		top:-10px;
		background-color: #fff;
		padding: 0 2px
		transition:all 0.4s linear;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="card" style="border-color: #9400D3">
				<div class="card-header text-white bg-success">
					Pengaturan
				</div>
				<div class="card-body p-0 m-0">
				<ul>
					<li class="card p-0 m-0 border-light">
						<a href="#" class="m-3 ml-3 text-dark">Akun Saya</a>
					</li>
					<li class="card p-0 m-0">
						<a href="#" class="m-3 ml-3 text-dark">Pengaturan Akun</a>
					</li>
					<li class="card p-0 m-0">
						<a href="#" class="m-3 ml-3 text-dark">Go somewhere</a>
					</li>
				</ul>
				</div>
				</div>
			</div>
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
					<div class="ml-3 mt-2 p-0 ">
						<span class="badge badge-success p-2">Verified</span>
						<h3></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 p-0 d-flex">
						<div class="card p-0 bg-light" style="border-color: #9400D3">
							<div class="card-body d-flex flex-column">
								<img  src="<?php echo base_url();?>assets/images/photo_profile_default.png" alt="Photo Profile" class="img-thumbnail">
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
						<div class="card ml-3 " style="border-color: #9400D3">
						<div class="card-body mt-4 pt-0 pb-0 pl=1 pr-1">
							<form class="form-group">
								<div class="row">
									<fieldset class="form-group col-lg-9">
										<input type="text" class="form-control text-dark" id="nama-label" value="Abimanyu Bhamakerti">
										<label for="nama-label" style="margin-left: 1rem">Nama</label>
									</fieldset>
								</div>

								<div class="row">
									<fieldset class="form-group col-lg-9 mt-2" id="datetimepicker3">
										<input type='date' placeholder="10/10/2020" class="form-control text-dark" id="date-label"/>
										<label for="date-label" style="margin-left: 1rem">Tanggal Lahir</label>
									</fieldset>
								</div>

								<div class="row">
									<fieldset class="form-group col-lg-9 mt-2" style="margin-left: -10px">
										<select class="custom-select" id="jeniskelamin-label">
											<option selected>Pilih...</option>
											<option value="1">Laki-laki</option>
											<option value="2">Perempuan</option>
										</select>
										<label for="jeniskelamin-label" style="margin-left: 1.7rem">Jenis Kelamin</label>
									</fieldset>
								</div>

								<div class="row">
									<fieldset class="form-group col-lg-9 mt-2" style="margin-left: -10px">
										<select class="custom-select" id="pendidikan-label">
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
										<label for="pendidikan-label" style="margin-left: 1.7rem">Pendidikan Terakhir</label>
									</fieldset>
								</div>

								<div class="row">
									<fieldset class="form-group col-lg-9 mt-2">
										<input disabled type="email" class="form-control bg-white text-dark" id="email-label" value="abimanyu@gmail.com">
										<label for="email-label" style="margin-left: 1rem">Email</label>
									</fieldset>
									<div class="">
										<span class="badge badge-pill bg-success text-white mt-3 p-2">
											<span class="fas fa-check"></span>
											Verified
										</span>
									</div>
									<a href="#" class="ml-2 mt-3 p-1">Ubah</a>
								</div>

								<div class="row">
									<fieldset class="form-group col-lg-9 mt-2">
										<input disabled type="number" class="form-control bg-white text-dark" id="telp-label"  pattern="[0-9]" value="0913123123123123">
										<label for="telp-label" style="margin-left: 1rem">Nomor Telepon</label>
									</fieldset>
									<div class="">
										<span class="badge badge-pill bg-success text-white mt-3 p-2">
											<span class="fas fa-check"></span>
											Verified
										</span>
									</div>
									<a href="#" class="ml-2 mt-3 p-1">Ubah</a>
								</div>

								<div class="row">
									<fieldset class="form-group mt-2 col-md-9">
										<input disabled type="password" class="form-control bg-white text-dark" id="password-label" value="wadidaw123!">
										<label for="password-label" style="margin-left: 1rem">Password</label>
									</fieldset>
									<a href="#" class="mt-3 p-1">Ubah</a>
								</div>
								<div class="row">
									<div class="col-lg-9 mt-2 d-flex justify-content-end">
										<button class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="card">
			<div class="card-header">
apa
			</div>
			<div class="card-body">
tes
			</div>
			</div>
	</div>
</body>
