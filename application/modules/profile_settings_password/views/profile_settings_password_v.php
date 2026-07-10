<body>
        <div class="col profile-settings-container" style="margin-top:30px;">
            <div class="row d-flex" style="padding-left:30px;padding-right:15px;">
                <div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
                    <span class="fas fa-cog"></span>
                </div>
                <div class="ml-3 mt-2 p-0 h-100 align-middle">
                    <h3>Pengaturan Kata Sandi</h3>
                </div>
            </div>

            <div class="card profile-settings-password-container">
                <div class="col-6 profile-settings-password-form-container">
                    <div class="form-group m-0 mb-3 p-0">
                        <label class="profile-settings-password-text" for="old-password">Masukkan Kata Sandi Lama kamu</label>
                        <input onChange="validateAfter();" onkeyup="validateAfter();" type="password" class="form-control" id="old_password" placeholder="">
                        <div class="profile-settings-password-warning-text" id="alert_null_password_old" style="display:none;">*Kata sandi harus diisi</div>
                        <div class="profile-settings-password-wrong-text" id="alert_wrong_password" style="display:none;">*Kata sandi lama yang Anda masukan salah</div>
                    </div>
                    <div class="form-group m-0 mb-3 p-0">
                        <label class="profile-settings-password-text" for="old-password">Masukkan Kata Sandi Baru kamu</label>
                        <input onChange="validateAfter();" onkeyup="validateAfter();" type="password" class="form-control" id="new_password" placeholder="">
                        <div class="profile-settings-password-warning-text" id="alert_null_password_new" style="display:none;">*Kata sandi harus diisi</div>
                        <div class="profile-settings-password-warning-text" id="alert_minimum_char" style="display:none;">*Kata sandi harus terdiri dari minimal 8 karakter</div>
                        <div class="profile-settings-password-warning-text" id="alert_password_match_old" style="display:none;">*Kata sandi baru harus berbeda dengan kata sandi lama</div>
                    </div>
                    <div class="form-group m-0 mb-3 p-0">
                        <label class="profile-settings-password-text" for="old-password">Konfirmasi Kata Sandi Baru kamu</label>
                        <input onChange="validateAfter();" onkeyup="validateAfter();" type="password" class="form-control" id="new_password_confirm" placeholder="">
                        <div class="profile-settings-password-warning-text" id="alert_password_c_null" style="display:none;">*Konfirmasi kata sandi harus diisi</div>
                        <div class="profile-settings-password-warning-text" id="alert_password_not_match" style="display:none;">*Konfirmasi kata sandi tidak sesuai</div>
                    </div>
                    <div class="button-konfirmasi-password" onClick="changePassword();">
                        Simpan Perubahan
                    </div>
                </div>
                <a class="col">
                    <img class="profile-settings-password-image" src="<?php echo base_url();?>application/modules/profile_settings_password/email_icon_konfirmasi_reset_berhasil-01.png" alt="">
                </a>
            </div>

		</div>
	</div>
</body>
