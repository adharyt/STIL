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
                    <label><input type="checkbox"> Semua</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input type="checkbox"> Senin</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input type="checkbox"> Selasa</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input type="checkbox"> Rabu</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input type="checkbox"> Kamis</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input type="checkbox"> Jum'at</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input type="checkbox"> Sabtu</label>
                </div>
                <div class="checkbox mr-4">
                    <label><input type="checkbox"> Minggu</label>
                </div>
            </div>
            <div class="body-bold-text mt-2">Jam Pemesanan Terakhir</div>
            <div class="default-text mt-1 ml-0">Atur jam pemesanan terakhir di tokomu (berlaku untuk setiap hari pengiriman).</div>
            <div class="shipping-time-container">
                <select class="selectpicker time-pick" title="Jam" data-size="5" data-container="body" data-dropup-auto="false">
                    <option>01</option><option>02</option><option>03</option><option>04</option><option>05</option>
                    <option>06</option><option>07</option><option>08</option><option>09</option><option>10</option>
                    <option>11</option><option>12</option><option>13</option><option>14</option><option>15</option>
                    <option>16</option><option>17</option><option>18</option><option>19</option><option>20</option>
                    <option>21</option><option>22</option><option>23</option><option>24</option>
                </select>
                <div class="body-bold-text ml-3 mr-3">:</div>
                <select class="selectpicker time-pick" title="Menit" data-size="5" data-container="body" data-dropup-auto="false">
                    <option>00</option><option>15</option><option>30</option><option>45</option>
                </select>
            </div>
            <div class="mt-2">
                <div class="alert alert-warning mt-2">
                    Preview informasi yang akan ditampilkan
                </div>
                <div class="default-text">Pesan sebelum</div> 
                <div class="body-bold-text" style="margin-left: 10px;">22:00 WIB</div>          
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
                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/sicepat.png" alt="Photo Profile" class="img-courier-logo logo-sicepat">
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> SiCepat REG</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> SiCepat BEST</label>
                    </div>
                </div>
                
                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/j&t.png" alt="Photo Profile" class="img-courier-logo mt-3 logo-jnt">
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> J&T REG</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/paxel.png" alt="Photo Profile" class="img-courier-logo logo-paxel">
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Paxel Same Day</label>
                    </div>
                </div>
                
                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/lion-parcel.png" alt="Photo Profile" class="img-courier-logo logo-lion-parcel">
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Lion Parcel REGPACK</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Lion Parcel ONEPACK</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/grab.png" alt="Photo Profile" class="img-courier-logo logo-grab">    
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Grab Instant</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Grab Same Day</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/ninja-xpress.png" alt="Photo Profile" class="img-courier-logo logo-ninja">  
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> NINJA REG</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> NINJA FAST</label>
                    </div>
                </div>
                
                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/wahana-express.png" alt="Photo Profile" class="img-courier-logo logo-grab">  
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Wahana Tarif Normal</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/jne.png" alt="Photo Profile" class="img-courier-logo logo-jne">  
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> JNE REG</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> JNE YES</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> JNE Trucking</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/tiki.png" alt="Photo Profile" class="img-courier-logo logo-tiki">  
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> TIKI Reg</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> TIKI ONS</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/gosend.png" alt="Photo Profile" class="img-courier-logo logo-gosend">  
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> GO-SEND Same Day</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> GO-SEND Instant</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/pos.png" alt="Photo Profile" class="img-courier-logo logo-grab">  
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Pos Kilat Khusus</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Pos Next Day</label>
                    </div>
                </div>
                
                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/rpx.png" alt="Photo Profile" class="img-courier-logo logo-grab">  
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> RPX Economy Package</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> RPX Next Day Package</label>
                    </div>
                </div>

                <div class="col-4">
                    <img src="<?php echo base_url();?>assets/images/courier-logo/grab.png" alt="Photo Profile" class="img-courier-logo logo-grab">
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Kurir Pelapak</label>
                    </div>
                </div>
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
