<style>
	.active a {
		background-color: #FFA500 !important;
	}

	.img-profile {
		width: 150px;
		height:150px;
	}
</style>
<body>
			<div class="col-sm-9" style="margin-top:30px;">
				<div class="row d-flex" style="padding-left:15px;padding-right:15px;">
					<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
						<span class="fas fa-edit"></span>
					</div>
					<div class="ml-3 mt-2 p-0 h-100 align-middle">
						<h3>Profil Akun</h3>
					</div>
				</div>
				<div class="row" style="padding-left:15px;padding-right:15px;">
					<div class="col-md-3 p-0">
						<div class="card p-0 bg-light"	style="width:100%;background-color:white!important">
							<div class="card-body d-flex flex-column text-center">
								<center>
									<img id="currentpic" src="<?php echo $this->userModel->getPhoto($this->session->userdata('username'),$this->session->userdata('photo'),$this->session->userdata('gender')); ?>" alt="Photo Profile" class="img-thumbnail img-profile">
									<br><br>
									<label for="upload_image" class="btn btn-light mt-2" style="border-color: #009245;cursor:pointer">Pilih Foto Profil</label>
									<input type="file" name="upload_image" id="upload_image" accept="image/*" style="opacity:0;position:absolute;z-index: -1;"/>
								</center>
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
											<input readonly type="text" class="form-control text-dark" id="nama-label" value="<?php echo $profile['name']; ?>" style="background-color:#E8E8E8">
										</fieldset>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2" id="datetimepicker3">
											<label for="date-label">Tanggal Lahir</label>
											<input readonly type='date' placeholder="dd/mm/yyyy" value="<?php echo $profile['birthdate'];?>" class="form-control text-dark" id="date-label" style="background-color:#E8E8E8"/>
										</fieldset>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2" style="margin-left: -10px">
											<label for="jeniskelamin-label" style="margin-left: 10px">Jenis Kelamin</label>
											<select disabled class="form-control text-dark" id="jeniskelamin-label" style="background-color:#E8E8E8">
												<option disabled>- Pilih Jenis Kelamin -</option>
												<option value="m" <?php if($profile['gender']=='m'){echo "selected";}?>>Laki-laki</option>
												<option value="f" <?php if($profile['gender']=='f'){echo "selected";}?>>Perempuan</option>
											</select>
											<span></span>
										</fieldset>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2" style="margin-left: -10px">
											<label for="pendidikan-label" style="margin-left: 10px">Pendidikan Terakhir</label>
											<select disabled class="form-control  text-dark" id="pendidikan-label" style="background-color:#E8E8E8">
												<option disabled>- Pilih Pendidikan Terakhir -</option>
												<?php
													foreach($lastEdu as $lastEduItem){
														if($profile['last_education']==$lastEduItem['id']){$LEsel='selected';}else{$LEsel='';}
														echo "<option value='$lastEduItem[id]' $LEsel>$lastEduItem[nama]</option>";
													}
												?>
											</select>
										</fieldset>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2">
											<label for="email-label">Email</label>
											<input readonly type="email" class="form-control bg-white text-dark" value="<?php echo $profile['email'];?>" style="background-color:#E8E8E8 !important">
										</fieldset>
										<div class="align-self-end pb-3	mb-1">
										<?php if($profile['email_status']==1){
											echo '<span class="badge badge-pill bg-success text-white mt-3 p-2">
															<span class="fas fa-check mr-1"></span>
															Diverifikasi
														</span>';
										}else{
											echo '<span class="badge badge-pill bg-secondary text-white mt-3 p-2">
															<span class="fas fa-exclamation-circle mr-1"></span>
															Belum diverifikasi
														</span>';
										}
										?>
										</div>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2">
											<label for="telp-label">Nomor Telepon</label>
											<input  readonly type="number" class="form-control  text-dark" id="telp-label"  pattern="[0-9]" value="<?php echo $profile['phone'];?>" style="background-color:#E8E8E8">
										</fieldset>
										<div class="align-self-end pb-3	mb-1">
										<?php if($profile['phone_status']==1){
											echo '<span class="badge badge-pill bg-success text-white mt-3 p-2">
															<span class="fas fa-check mr-1"></span>
															Diverifikasi
														</span>';
										}else{
											echo '<span class="badge badge-pill bg-secondary text-white mt-3 p-2">
															<span class="fas fa-exclamation-circle mr-1"></span>
															Belum diverifikasi
														</span>
														';
										}
										?>
										</div>
									</div>

									<div class="row">
										<fieldset class="form-group col-lg-9 mt-2">
											<label for="ktp-label">Nomor KTP</label>
											<input readonly type="number" class="form-control bg-white text-dark" id="ktp-label"  pattern="[0-9]" value="" style="background-color:#E8E8E8 !important">
										</fieldset>
										<div class="align-self-end pb-3	mb-1">
										<?php if($profile['ktp_no']!='' && $profile['ktp_status']==1){
											echo '<span class="badge badge-pill bg-success text-white mt-3 p-2">
															<span class="fas fa-check mr-1"></span>
															Diverifikasi
														</span>';
										}else if($profile['ktp_no']!='' && $profile['ktp_status']==2){
											echo '<span class="badge badge-pill bg-danger text-white mt-3 p-2">
															<span class="fas fa-times-circle mr-1"></span>
															Verifikasi ditolak
														</span>';
										}else if($profile['ktp_no']!='' && ($profile['ktp_status']!=1 || $profile['ktp_status']!=2)){
											echo '<span class="badge badge-pill bg-secondary text-white mt-3 p-2">
															<span class="fas fa-exclamation-circle mr-1"></span>
															Belum diverifikasi
														</span>';
										}
										?>
										</div>
									</div>


									<div class="row">
										<div class="col-lg-9 mt-2 d-flex justify-content-end">
											<div class="btn btn-success" id="btnEdit" onClick="editProfile();" style="cursor:pointer;">Sunting Data Profile</div>
											<div class="btn btn-secondary" id="btnCancel" onClick="location.reload();" style="display:none;cursor:pointer;">Batal</div>&nbsp;
											<div class="btn btn-success" id="btnSave" onClick="saveProfile();" style="display:none;cursor:pointer;">Simpan Perubahan</div>

										</div>
									</div>
								</form>
							</div>
						</div>
						<br>
					</div>
				</div>
				<div id="uploadimageModal" class="modal" role="dialog">
				 <div class="modal-dialog">
				  <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				        </div>
				        <div class="modal-body">
				          <div class="row">
							       <div class="col-md-12 text-center">
							        <div id="image_to_crop" style="width:100%; margin-top:5px;height:auto"></div>
											<br>
											<button class="btn btn-success crop_image">Crop & Upload Image</button>
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
