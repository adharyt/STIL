<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text">Kurir dan Jadwal Pengiriman</div>
    <div class="acorddion-style" data-toggle="collapse" data-target="#collapseShippingSchedule" aria-expanded="false" aria-controls="collapseSchedule">
        Jadwal Pengiriman
        <i class="fa fa-chevron-up"></i>
    </div>

    <div class="collapse show" id="collapseShippingSchedule">
		<div class="card card-body">
            <div class="body-bold-text">Hari Kerja</div>
            <div class="default-text mt-1 ml-0">Pilih hari apa saja kamu dapat mengirimkan barang ke jasa pengiriman.</div>
            <div class="shipping-day-container default-text">
                <div class="checkbox mr-4">
                    <label><input value="all" class="openday" type="checkbox"
											<?php if($infoToko['store_open_monday']==1
														&& $infoToko['store_open_tuesday']==1
														&& $infoToko['store_open_wednesday']==1
														&& $infoToko['store_open_thursday']==1
														&& $infoToko['store_open_friday']==1
														&& $infoToko['store_open_saturday']==1
														&& $infoToko['store_open_sunday']==1)
														{echo "checked='checked'";} ?>
											> Semua</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input value="monday" class="openday" type="checkbox" <?php if($infoToko['store_open_monday']==1){echo "checked='checked'";} ?>> Senin</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input value="tuesday" class="openday" type="checkbox" <?php if($infoToko['store_open_tuesday']==1){echo "checked='checked'";} ?>> Selasa</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input value="wednesday" class="openday" type="checkbox" <?php if($infoToko['store_open_wednesday']==1){echo "checked='checked'";} ?>> Rabu</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input value="thursday" class="openday" type="checkbox" <?php if($infoToko['store_open_thursday']==1){echo "checked='checked'";} ?>> Kamis</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input value="friday" class="openday" type="checkbox" <?php if($infoToko['store_open_friday']==1){echo "checked='checked'";} ?>> Jum'at</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input value="saturday" class="openday" type="checkbox" <?php if($infoToko['store_open_saturday']==1){echo "checked='checked'";} ?>> Sabtu</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input value="sunday"  class="openday" type="checkbox" <?php if($infoToko['store_open_sunday']==1){echo "checked='checked'";} ?>> Minggu</label>
                </div>
            </div>
            <div class="body-bold-text mt-2">Jam Pemesanan Terakhir</div>
            <div class="default-text mt-1 ml-0">Atur jam pemesanan terakhir di tokomu (berlaku untuk setiap hari pengiriman).</div>
            <div class="shipping-time-container">
                <select id="jam" class="selectpicker time-pick" title="Jam" data-size="5" data-container="body" data-dropup-auto="false">
									<option <?php if(substr($infoToko['store_lastdelivery'],0,2)==sprintf("%02d", 0)){echo "selected='selected'";} ?> value="<?php echo sprintf("%02d", 0);?>"><?php echo sprintf("%02d", 0);?></option>
                    <?php
											for($i=1;$i<=23;$i++){ ?>
													<option <?php if(substr($infoToko['store_lastdelivery'],0,2)==sprintf("%02d", $i)){echo "selected='selected'";} ?> value="<?php echo sprintf("%02d", $i);?>"><?php echo sprintf("%02d", $i);?></option>
									<?php	}
										 ?>
                </select>
                <div class="body-bold-text ml-3 mr-3">:</div>
                <select id="menit" class="selectpicker time-pick" title="Menit" data-size="5" data-container="body" data-dropup-auto="false">
                    <option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 0)){echo "selected='selected'";} ?> value="00">00</option>
										<option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 15)){echo "selected='selected'";} ?> value="15">15</option>
										<option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 30)){echo "selected='selected'";} ?> value="30">30</option>
										<option <?php if(substr($infoToko['store_lastdelivery'],3,2)==sprintf("%02d", 45)){echo "selected='selected'";} ?> value="45">45</option>
                </select>
            </div>
            <div class="mt-2">
                <div class="alert alert-warning mt-2">
                    Preview informasi yang akan ditampilkan
                </div>
                <div class="default-text">Pesan sebelum</div>
                <div class="body-bold-text" style="margin-left: 10px;"><span id="lastdelivery"><?php echo $infoToko['store_lastdelivery'];?></span> WIB</div>
                <div class="default-text">Agar pesananmu dikirim hari ini</div>
                <div class="alert alert-warning mt-3">
                    <ul>
                        <li class="default-text ml-0">Jam pemesanan terakhir akan ditampilkan di halaman lapakmu.</li>
                        <li class="default-text ml-0">Jangan lupa kirim barang untuk pesanan yang diterima sebelum waktu yang sudah kamu atur ya.</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="mt-2">
                <div class="body-bold-text mt-2">Batas Waktu Memproses Pesanan</div>
                <div class="default-text mt-1 ml-0">Rentang waktu dari pesanan diterima sampai kamu memasukkan resi ke sistem Bukalapak. ( <b>Berlaku untuk semua barang</b> )</div>
            </div>
		</div>
	</div>

    <div class="acorddion-style" data-toggle="collapse" data-target="#collapseCourier" aria-expanded="false" aria-controls="collapseCourier">
        <div>Kurir</div>
        <i class="fa fa-chevron-down"></i>
    </div>

	<div class="collapse" id="collapseCourier">
		<div class="card card-body">
            <div class="alert alert-warning">
                Pelapak dianggap menolak pesanan jika tidak mengirimkan barang sejak transaksi berhasil dibayar dalam batas waktu berikut ini:
                <ol>
                    <li class="default-text ml-4">2 hari kerja untuk layanan pengiriman reguler</li>
                    <li class="default-text ml-4">2x24 jam (tidak termasuk hari besar) untuk layanan pengiriman kilat</li>
                    <li class="default-text ml-4">1x24 jam untuk layanan pengiriman sameday service</li>
                </ol>
            </div>

            <div class="checkbox">
                    <label><input type="checkbox" value=""> Pembeli dapat ambil barang pesanannya langsung ke lokasi pelapak terdekat.</label>
                </div>
            <div class="p-3 pb-5 row" id="jasaPengiriman">
								<?php foreach($couriers as $courier){ ?>
                <div class="col-4">
                    <img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:50px;width:auto;margin-bottom:10px">
										<?php
											foreach($courier['courier_services'] as $courier_service){
										 ?>
                    <div class="checkbox">
                        <label><input class="courier" type="checkbox" value="<?php echo $courier_service['id']; ?>" <?php if($courier_service['is_checked']==1){echo "checked";} ?>> <?php echo $courier_service['service_name']; ?></label>
                    </div>
										<?php } ?>
                </div>
								<?php } ?>
            </div>

            <div class="modal fade" id="ketentuanAmbilSendiri" tabindex="-1" role="dialog" aria-labelledby="ketentuanAmbilSendiriLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header new-address-header">
                            <h5 class="modal-title new-address-title" id="newAddressLabel">Ketentuan Penggunaan Ambil Sendiri</h5>
                            <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times-circle"></span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-center p-2 courier-body">
                            <ol>
                                <li>Alamat Utama yang kamu gunakan dijadikan sebagai Alamat Lapak</li>
                                <li>Alamat Lapakmu akan diberitahukan ke pembeli pada saat pembeli pilih layanan Ambil Sendiri di halaman Isi Data Pembelian dan pada bagian Informasi Pelapak setelah pelapak sudah konfirmasi barang siap diambil oleh pembeli</li>
                                <li>Kamu harus aktifkan notifikasi chat sebagai media informasi dengan pembeli</li> <li>Kamu harus buat kesepakatan waktu ambil barang setelah konfirmasi barang siap diambil ke pembeli</li>
                                <li>Kamu harus buat kesepakatan waktu ambil barang setelah konfirmasi barang siap diambil ke pembeli</li>
                                <li>Ketika pembeli datang, tanyakan nomor transaksi, nama pembeli, barang yang dipesan, dan kode unik ke pembeli sebelum menyerahkan pesanan</li>
                                <li>Ketika pembeli datang, tanyakan nomor transaksi, nama pembeli, barang yang dipesan, dan kode unik ke pembeli sebelum menyerahkan pesanan</li>
                                <li>Gunakan kode unik tersebut untuk validasi dan konfirmasi bahwa barang sudah diambil pembeli</li>
                                <li>Jika kamu sudah konfirmasi barang diambil pembeli, namum pembeli belum konfirmasi barang sudah diterima hingga 2x24 jam, maka dana transaksi akan diteruskan ke saldo BukaDompetmu secara otomatis</li>
                                <li>Kamu dapat aktifkan layanan Ambil Sendiri per barang yang kamu jual</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
