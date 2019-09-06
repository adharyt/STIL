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
		<div class="col-sm-9" style="margin-top:30px;">
			<div class="row d-flex" style="padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-user-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle">
					<h3>Akun Saya</h3>
				</div>
			</div>
			<div class="card p-2" style="width: 100%">
				<div class="body">
					<div class="row pl-3 pr-3">
						<img src="<?php echo $this->userModel->getPhoto($this->session->userdata('username'),$this->session->userdata('photo'),$this->session->userdata('gender')); ?>" alt="Photo Profile" class="img-thumbnail img-profile">
						<div>
							<div class="ml-3 mt-2 p-0 h-100 align-middle">
								<h4><?php echo $this->session->userdata('name');?></h4>
								<p><?php echo $this->session->userdata('email');?></p>
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
