<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
    <div class="title-text">Pengaturan Informasi Lapak</div>
    <div class="default-text">Kelola profil, alamat, catatan, dan waktu tutup lapak agar pembeli lebih 
        mudah mendapatkan informasi lapakmu.</div>
    <div class="card p-4 mt-3">
        <div class="name-text m-0 mb-2">Ubah Informasi Toko</div>
        <div class="body-bold-text mt-2">Foto Header Lapak</div>
        <img class="header-photo-container" src="<?php echo base_url();?>assets/images/profile/header-profile-penjual.png">
        <a class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1 store-info-delete-icon" style="cursor:pointer;">
            <i class="fas fa-trash-alt mt-1 text-white"></i>
        </a>
        <form class="form-group">
            <div class="row">
                <fieldset class="form-group col mt-3 mb-3">
                <label class="default-text m-0" for="nama-label">Deskripsi Toko</label>
                    <textarea class="form-control mt-2" rows="5" id="comment"></textarea>
                </fieldset>
            </div>
            <div class="row">
                <fieldset class="form-group col-lg-7">
                    <label class="default-text m-0" for="nama-label">Nomer Kontak Penjual</label>
                    <input class="form-control text-dark default-text m-0 mt-1" id="nama-label" value="0123124124124">
                </fieldset>
            </div>
        </form>
        <div class="alert alert-warning alert-custom-container">
            <i class="fa fa-info-circle icon-style" aria-hidden="true"></i>
            <div class="default-text ml-0">	Nomor kontak lapak tidak akan digunakan untuk OTP dan akan 
                digunakan untuk keperluan pengiriman barang, seperti GO-SEND, bukti pembayaran, dan lain-
                lain. Jika dikosongkan, nomor kontak lapak akan menggunakan nomor handphone utama.</div> 
        </div>
        <div class="row mt-5 mb-3">
            <div class="col mt-2 d-flex justify-content-end">
                <button class="btn btn-secondary" id="btnCancel"  style="cursor:pointer;">Batal</button>&nbsp;
                <button class="btn btn-success" id="btnSave" style="cursor:pointer;">Simpan Perubahan</button>
            </div>
        </div>
    </div>
    
    
</div>
</div>
