<style>
	.img-profile{
		width: 10%;
		height: 10%;
		border-radius: 50%;
		border-color: #009245;
	}
	.circle {
		border-radius: 25px;
	}
	.icon-sack {
		width: 20px;
		height: 20px;
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
					<a class="nav-link" href="#">Ringkasan Akun</a>
				</li>
			</ul>
		
			<div class="card p-2" style="width: 100%">
				<div class="body">
					<div class="row pl-3 pr-3">
						<img src="<?php echo base_url();?>assets/images/image-user/default_client_m.png" alt="Photo Profile" class="img-thumbnail img-profile">
						<div>
							<div class="ml-3 mt-2 p-0 h-100 align-middle">
								<h4>Abimanyu Bhamakerti</h4>
								<p>abimanyu.bhamakerti@gmail.com</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h4>Transaksi</h4>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between"> 
								<p>Tagihan</p>
								<p>0</p>
							</div>
							<div class="d-flex justify-content-between"> 
								<p>Pembelian</p>
								<p>0</p>
							</div>
							<div class="d-flex justify-content-between"> 
								<p>Diskusi Retur</p>
								<p>0</p>
							</div>
						</div>
					</div>

					<div class="card mt-2">
						<div class="card-header">
							<h4>Favorit</h4>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between"> 
								<p>Barang Favorit</p>
								<p>0</p>
							</div>
							<div class="d-flex justify-content-between"> 
								<p>Toko Favorit</p>
								<p>0</p>
							</div>
							<div class="d-flex justify-content-between"> 
								<p>Berlangganan</p>
								<p>0</p>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h4>Investasi</h4>
						</div>
						<div class="card-body">
							<div class="row pl-3 pr-3">
								<img src="<?php echo base_url();?>assets/images/icon-img/money.png" alt="Icon Cash" class="mr-2 icon-sack">
								<p>	Investasi di STIL sekarang</p>
							</div>
							<button class="btn btn-success float-right">
								Mulai Investasi
							</button>
						</div>
					</div>

					<div class="card mt-2">
						<div class="card-header">
							<h4>Newsletter</h4>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between"> 
								<p>Status Berlangganan</p>
								<p class="bg-success pr-2 pl-2 pt-1 pb-1 text-white circle">Berlangganan</p>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</body>