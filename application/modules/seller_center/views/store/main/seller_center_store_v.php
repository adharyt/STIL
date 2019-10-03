<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text">Pengaturan Toko</div>
    <div class="default-text">Kelola profil, alamat, catatan, dan waktu tutup Lapak agar pembeli lebih mudah mendapatkan informasi Tokomu.</div>
    <div class="card p-4 mt-3">
        <div class="store-row-sb-container">
            <div class="body-bold-text">Informasi Toko</div>
            <a class="btn-store-edit" href="<?php echo base_url();?>my-store/store-info">Edit</a>
        </div>
        <div class="default-bold-text m-0">Foto Header Toko</div>
        <img class="header-photo-container" src="<?php echo base_url();?>assets/images/profile/header-profile-penjual.png">
        <div class="default-bold-text m-0 mt-2">Deskripsi Toko</div>
        <div class="default-text ml-0">Belum ada deskripsi untuk tokomu</div>
        <div class="default-bold-text m-0 mt-2 mt-2">Nomor Kontak Toko</div>
        <div class="default-text ml-0">6287884044440</div>
				<div class="default-bold-text m-0 mt-2 mt-2">Alamat Toko</div>
        <div class="default-text ml-0">Jalan Kebon Pedes</div>
    </div>

    
    <div class="card p-4 mt-3">
        <div class="store-row-sb-container">
            <div class="body-bold-text m-0">Catatan Penjual</div>
            <a class="btn-store-edit"  href="<?php echo base_url();?>my-store/merchant-notes">Edit</a>
        </div>
        <div class="alert alert-warning alert-custom-container">
            <i class="fa fa-info-circle icon-style" aria-hidden="true"></i>
            <div class="default-text ml-0">Digunakan untuk memberikan informasi tambahan kepada pembeli seputar
            jadwal operasional, ketentuan toko, kelebihan berbelanja di tokomu, dan sebagainya. Catatan
            penjual tetap tunduk terhadap Aturan penggunaan STIL.</div>
        </div>
        <div class="default-bold-text m-0 mt-2">Catatan Penjual</div>
        <div class="default-text ml-0">
					<?php
						if($infoToko['store_notes']==''){
							echo "Belum ada catatan untuk tokomu";
						}else{
							echo $infoToko['store_notes'];
						}
					 ?>
				</div>
				<br>
        <div class="default-text ml-0">
					<small>
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
    <div class="card p-4 mt-3">
        <div class="store-row-sb-container">
            <div class="body-bold-text m-0">Tutup Toko</div>
            <a class="btn-store-edit"  href="<?php echo base_url();?>my-store/close-store">Edit</a>
        </div>
        <div class="alert alert-warning alert-custom-container">
            <i class="fa fa-info-circle icon-style" aria-hidden="true"></i>
            <div class="default-text ml-0">	Digunakan untuk menonaktifkan lapakmu selama waktu yang kamu
            tentukan. Gunakan fitur ini ketika kamu akan berlibur atau ketika kamu sedang tidak bisa
            menangani transaksi di STIL.</div>
        </div>
        <div class="default-bold-text m-0 mt-2">Tutup Lapak</div>
        <div class="default-text ml-0">Belum ada pengaturan tanggal tutup lapak untuk lapakmu.</div>
    </div>

</div>
</div>
