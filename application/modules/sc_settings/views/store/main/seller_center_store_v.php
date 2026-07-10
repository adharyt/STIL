<?php $profilPenjual=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));?>
<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text"><i class="fa fa-cogs m-0 mb-3"></i> Pengaturan Toko</div>
	<div class="card">
		<div class="card-header" style="background-color:white;border-bottom:0px solid white;padding-left:0px;padding-right:0px">
				<?php $this->load->view('template/header/seller_center_setting_tab');?>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-3 text-center">
						<div class="name-text" style="margin-left:0px">Foto Profil Toko</div>
						<img style="height:120px;width:120px" id="storecurrentpic" src="<?php echo $this->storeModel->getStorePhoto($profilPenjual['store_link'],$profilPenjual['store_photo']);?>" alt="Photo Profile" class="img-profile-sidebar">
						<br>
						<label title="Ubah Foto Toko" for="upload_image_store" style="border-color: #009245;cursor:pointer;margin-top:5px">
							<a class="btn btn-xs"  style="background-color:#099245;color:white">Ubah Foto Toko</a>
						</label>
						<input type="file" name="upload_image_store" id="upload_image_store" accept="image/*" style="display:none;opacity:0;position:absolute;z-index: -1;"/>
				</div>
				<div class="col-9 text-left">
					<div class="name-text" style="margin-left:0px">Banner Toko</div>
					<div  style="height:120px;background:url('<?php echo $this->storeModel->getHeaderPhoto($profilPenjual['store_link'],$profilPenjual['store_header']); ?>') no-repeat center center;background-size:100% 100%" ></div>
					<label for="upload_image_header" class="btn-edit-header" style="border-color: #009245;cursor:pointer;margin-top:5px">
						<a class="btn btn-xs"  style="background-color:#099245;color:white">Ubah Foto Banner</a>
					</label>
					<input type="file" name="upload_image_header" id="upload_image_header" accept="image/*" style="opacity:0;position:absolute;z-index: -1;"/>
				</div>

			</div>

				<div class="row" style="margin-top:40px">
						<div class="col-6">
							<div class="default-bold-text m-0 mt-2 mt-2">Nomor Kontak Penjual</div>
								<div class="default-text ml-0">
									<?php
										if($infoToko['store_phone']==''){
											echo "$infoToko[user_phone]<br>
											<small style='color:#aeaeae'>
														Anda belum mencantumkan nomor telepon toko sehingga untuk saat ini nomor telepon utama Anda digunakan sebagai nomor telepon toko.
											</small>";
										}else{
											echo $infoToko['store_phone'];
										}
									 ?>
								</div>
						</div>
						<div class="col-6">
							<div class="default-bold-text m-0">Alamat Toko</div>
							<div class="default-text ml-0"><?php echo $infoToko['store_address'].', '.ucwords(strtolower($this->locationModel->printDetail($infoToko['store_subcity']))).' '.$infoToko['store_postalcode'];?></div>
						</div>
					</div>
					<div class="row" style="margin-top:30px">
						<div class="col-6">
							<div class="default-bold-text m-0">Deskripsi Toko</div>
									<div class="default-text ml-0">
										<?php
											if($infoToko['store_description']==''){
												echo "<i>Belum ada deskripsi toko</i>";
											}else{
												echo $infoToko['store_description'];
											}
										 ?>
									</div>
						</div>
						<div class="col-6">
						<div class="default-bold-text m-0 mt-2 mt-2">Catatan Penjual</div>
								<div class="default-text ml-0">
									<?php
										if($infoToko['store_notes']==''){
											echo "<i>Belum ada catatan untuk tokomu</i>";
										}else{
											echo $infoToko['store_notes'];
										}
									 ?>
								</div>
								<div class="default-text ml-0">
									<small style="color:#aeaeae">
										<?php
											if($infoToko['store_notes']==''){
												echo "";
											}else{
												echo "Catatan Penjual terakhir kali diubah pada $infoToko[store_notes_lup]";
											}
										 ?>

									</small>
								</div>
						  </div>
				</div>
				<br>
				<div class="d-flex justify-content-end" style="margin-bottom:5px">
						<a class="btn"  href="<?php echo base_url();?>my-store/settings/general/information-edit" style="background-color:#099245;color:white">Sunting Data</a>
				</div>
			</div>


		</div>
	</div>
	<!--  End of Semua Barang  -->
	<div id="uploadimage_headerModal" class="modal" role="dialog">
	 <div class="modal-dialog">
		<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							 <div class="col-md-12 text-center">
								<div id="image_to_crop_header" style="width:100%; margin-top:5px;height:auto"></div>
								<br>
								<button class="btn btn-success crop_image" id="crop_imagebutton" style="cursor:pointer;">Crop & Upload Image</button>
							 </div>
						</div>
				 </div>

			 </div>
			</div>
	</div>
	<div id="uploadimageStoreModal" class="modal" role="dialog">
	 <div class="modal-dialog">
		<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							 <div class="col-md-12 text-center">
								<div id="image_store_to_crop" style="width:100%; margin-top:5px;height:auto"></div>
								<br>
								<button class="btn btn-success crop_image" id="crop_store_image_now" style="cursor:pointer;">Crop & Upload Image</button>
							 </div>
						</div>
				 </div>

			 </div>
			</div>
	</div>

</div>
</div>
