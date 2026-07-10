<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text">Tutup Toko</div>
    <div class="card p-4 mt-3">
        <div class="name-text m-0 mb-2">Atur waktu tutup Lapak</div>
        <div class="alert alert-warning alert-custom-container">
            <i class="fa fa-info-circle icon-style" aria-hidden="true"></i>
            <div class="default-text ml-0">	Pastikan kamu mengatur tanggal buka dan tutup lapak dengan 
            benar. Kami akan mengirimkan e-mail pengingat 1x24 jam sebelum lapak dibuka.</div> 
        </div>
        <div class="store-row-sb-container mt-1">
            <fieldset class="form-group col p-0 pr-2" id="datetimepicker3">
                <label for="date-label" class="body-text">Tanggal Mulai Tutup</label>
                <input type='date' placeholder="dd/mm/yyyy" value="" class="form-control text-dark" id="date-label"/>
            </fieldset>
            <fieldset class="form-group col p-0 pl-2" id="datetimepicker3">
                <label for="date-label" class="body-text">Tanggal Akan Buka</label>
                <input type='date' placeholder="dd/mm/yyyy" value="" class="form-control text-dark" id="date-label"/>
            </fieldset>
        </div>
        <div class="body-text">Alasan Tutup</div>
        <div class="close-store-reason-container">
            <div id="restock" class="close-store-reason" onClick="restock();">
                Restok Barang
            </div>
            <div id="otherMarketplace" class="close-store-reason" onClick="otherMarketplace();">
                Pindah ke Marketplace Lain
            </div>
            <div id="newStore" class="close-store-reason" onClick="newStore();">
                Pindah ke Lapak Baru
            </div>
            <div id="vacation" class="close-store-reason" onClick="vacation();">
                Mau Liburan
            </div>
            <div id="otherReason" class="close-store-reason" onClick="otherReason();">
                Alasan Lain
            </div>
        </div>

        <!-- Other Marketplace -->
        <div id="inputOtherMarketplace" class="row mt-4" style="display:none">
            <fieldset class="form-group col mt-3">
                <label class="body-text m-0" for="nama-label">Pindah ke mana?</label>
                <input class="form-control text-dark default-text m-0 mt-2" id="nama-label" value="" placeholder="Masukkan nama Marketplace">
            </fieldset>
        </div>

        <!-- New Store -->
        <div id="inputNewStore" class="row mt-4" style="display:none">
            <fieldset class="form-group col mt-3">
                <label class="body-text m-0" for="nama-label">Masukkan link toko baru kamu di STIL</label>
                <input class="form-control text-dark default-text m-0 mt-2" id="nama-label" value="" placeholder="">
            </fieldset>
        </div>

        <!-- Other Reason -->
        <div id="inputOtherReason" class="row mt-4" style="display:none">
            <fieldset class="form-group col mt-3">
                <label class="body-text m-0" for="nama-label">Ceritakan Alasan Kamu</label>
                <textarea class="form-control mt-2" rows="5" id="comment"></textarea>
            </fieldset>
        </div>

        <div class="row mt-5 mb-3">
            <div class="col mt-2 d-flex justify-content-end">
                <button class="btn btn-secondary" id="btnCancel"  style="cursor:pointer;">Batal</button>&nbsp;
                <button class="btn btn-success" id="btnSave" disabled style="cursor:pointer;">Simpan Perubahan</button>
            </div>
        </div>
    </div>
    
    
</div>
</div>
