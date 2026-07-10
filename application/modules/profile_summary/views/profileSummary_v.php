
<body>
		<div class="col-sm-9" style="margin-top:30px;">
			<div class="row d-flex" style="margin-left:10px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-user-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle header_account_title">
					<h3>Ringkasan Akun</h3>
				</div>
			</div>
			<div class="card p-2 profile-summary-card-container">
				<div class="body">
					<div class="row info-user-container">
						<div class="col-lg-4">
								<img src="<?php echo $this->userModel->getPhoto($this->session->userdata('username'),$this->session->userdata('photo'),$this->session->userdata('gender')); ?>" alt="Photo Profile" class="img-thumbnail profile_img-profile">
						</div>
						<div class="col-lg-4 col-md-6">
								<div class="align-middle" style="margin-top:20px">
									<div class="name-text"><?php echo $this->session->userdata('name');?></div>
									<p class="email-text" style="margin-bottom:5px"><?php echo $this->session->userdata('email');?></p>
									<a href="<?php echo $this->config->item('landing_url');?>/profile" target="_blank">
										<button class="btn btn-success btn-sm" style="cursor:pointer;background-color:#009245">Edit Profil</button>
									</a>
								</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="favorite-container" style="margin-top:20px; margin-left:-15px">
								<div class="favorite-title-text">Favorit</div>
								<a href="<?php echo base_url();?>my-account/wishlist">
									<div class="favorite-item-container">
										<div class="favorite-text">Barang Favorit</div>
										<div class="favorite-text"><?php echo $count['wishlist'];?></div>
									</div>
								</a>
								<a data-toggle="modal" data-target="#addCategoryModal" style="cursor:pointer">
									<div class="favorite-item-container">
										<div class="favorite-text">Toko Favorit</div>
										<div class="favorite-text"><?php echo $count['favstore'];?></div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<h4>Transaksi</h4>
					<div class="row card summary-container" style="align:center">
						<div class="profile-summary-item col-lg-3 col-sm-6" style="margin-left:-10px;margin-top:10px; margin-bottom:10px;">
							<a href="<?php echo base_url();?>my-account/transaction?showUnpaid=true&showPaid=false&showExpired=false" class="profile-summary-item-content">
								<i class="fas fa-receipt icon-profile-summary"></i>
								<div class="icon-desc-text">Tagihan<br>Pembayaran</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><?php echo $transUnpaid;?></span>
						</div>


						<!--
						<div class="col profile-summary-item">
							<a class="profile-summary-item-content">
								<i class="fas fa-comments icon-profile-summary"></i>
								<div class="icon-desc-text">Diskusi <br> Retur</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon">0</span>
						</div>
					-->

						<div class="profile-summary-item col-lg-3 col-sm-6" style="margin-top:10px; margin-bottom:10px;">
							<a href="<?php echo base_url();?>my-account/transaction-split?showPending=true&showProcess=true&showSent=true&showDelivered=true&showSuccess=false&showDecline=false" class="profile-summary-item-content">
								<i class="fas fa-sync-alt icon-profile-summary"></i>
								<div class="icon-desc-text">Transaksi <br> Ongoing</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><?php echo $transProcess;?></span>
						</div>

						<div class="profile-summary-item col-lg-3 col-sm-6" style="margin-top:10px; margin-bottom:10px;">
							<a href="<?php echo base_url();?>my-account/transaction-split?showPending=false&showProcess=false&showSent=false&showDelivered=false&showSuccess=true&showDecline=false" class="profile-summary-item-content">
								<i class="fas fa-check-circle icon-profile-summary"></i>
								<div class="icon-desc-text">Transaksi <br> Sukses</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><?php echo $transSuccess;?></span>
						</div>

						<div class="profile-summary-item col-lg-3 col-sm-6" style="margin-top:10px; margin-bottom:10px;">
							<a href="<?php echo base_url();?>my-account/transaction-split?showPending=false&showProcess=false&showSent=false&showDelivered=false&showSuccess=false&showDecline=true" class="profile-summary-item-content">
								<i class="fas fa-times-circle icon-profile-summary"></i>
								<div class="icon-desc-text">Transaksi <br> Batal</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><?php echo $transFailed;?></span>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row mt-3">
				<div class="col" style="margin-bottom:10px">

					<div class="card">

						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-6">
									<div class="row">
										<div class="col-6">
											<h1><?php echo $transUnpaid;?></h1>
											<p>Tagihan</p>
										</div>
										<div class="col-6">
											<h1>0</h1>
											<p>Diskusi Retur</p>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-4">
											<h1><?php echo $transProcess;?></h1>
											<p>On Process</p>
										</div>
										<div class="col-4">
											<h1><?php echo $transSuccess;?></h1>
											<p>Transaksi Sukses</p>
										</div>
										<div class="col-4">
											<h1><?php echo $transFailed;?></h1>
											<p>Transaksi Batal</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- <div class="row mt-3">
				<div class="col-md-6">
					<div class="row">
						<div class="col-12" style="margin-bottom:10px">
							<div class="card">
								<div class="card-header" style="background-color:#009245;color:white">
									<h4>Uang Digital</h4>
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<p><img src="<?php echo base_url();?>assets/images/icon-img/money.png" alt="Icon Cash" class="mr-2 icon-sack">Kredit STIL</p>
										<p><?php echo $this->currencyModel->integerToCurrency('rupiah',$userMoney);?></p>
									</div>
									Lihat History | Cairkan Uang
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header" style="background-color:#009245;color:white">
							<h4>Favorit</h4>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<p>Barang Favorit</p>
								<a href="<?php echo base_url();?>my-account/wishlist">
									<p><?php echo $count['wishlist'];?></p>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<p>Toko Favorit</p>
								<a data-toggle="modal" data-target="#addCategoryModal" style="cursor:pointer">
									<p><?php echo $count['favstore'];?></p>
								</a>
							</div>
						</div>
					</div> -->

					<!-- <div class="card mt-2">
						<div class="card-header" style="background-color:#009245;color:white">
							<h4>Newsletter</h4>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<p>Status Berlangganan</p>
								<style media="screen">
								.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open>.dropdown-toggle.btn-default {
									color: #333;
									background-color: #e6e6e6;
									border-color: #adadad;
								}
								.btn-default:active, .btn-default.active, .open>.dropdown-toggle.btn-default {
								    background-image: none;
								}
								.btn-default {
								    color: #333;
								    background-color: #fff;
								    border-color: #ccc;
								}
								.toggle-group,.toggle-on,.toggle-off{
									cursor:pointer
								}
								</style>
								<input <?php if($is_subscribe==1){echo "checked";}?> id="newsletterstatus" type="checkbox"  data-toggle="toggle" data-on="Berlangganan	" data-off="Tidak Berlangganan" data-onstyle="success" data-offstyle="danger">
							</div>
						</div>
					</div> -->
					<br>
				</div>
			</div>
		</div>

		<div class="modal fade" id="addCategoryModal" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true" style="margin-top:100px">
				<div class="modal-dialog" role="document" style="max-width:300px">
						<div class="modal-content">
								<div class="modal-header new-address-header">
										<h5 class="modal-title new-address-title" id="editAddressLabel">Daftar Toko Favorit</h5>
										<button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
										<span aria-hidden="true" class="fas fa-times-circle"></span>
										</button>
								</div>
								<div class="modal-body d-flex justify-content-center p-2 new-address-body">
										<div class="row">
												<?php if($count['favstore']>0){
													echo "<table border=0 style='padding:20px'>";
													foreach($favstore as $store){ ?>
														<tr style="border-bottom:1px solid gray;">
															<td style="padding-right:5px;padding-top:5px;padding-bottom:5px">
																<img style="height:60px;border-radius: 50%;border-color: #009245;" class="img-thumbnail" src="<?php echo $this->storeModel->getStorePhoto($store['store_link'],$store['store_photo']); ?>">
															</td>
															<td style="padding-left:5px;padding-top:5px;padding-bottom:5px">
																<a style="color:#009245" href="<?php echo base_url();?>s/<?php echo $store['store_link']; ?>"><h4 style="margin-bottom:0px;padding-top:10px"><?php echo $store['store_name'];?></h4></a>
																<?php echo ucwords(strtolower($store['store_location']));?>
																<br>&nbsp;
															</td>
														</tr>
												<?php	}
												echo "</table>";
												}else{
													echo "Belum ada toko favorit.";
												}
												?>
										</div>
								</div>
						</div>
				</div>
		</div>
	</div>
</body>
