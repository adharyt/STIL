<input type="hidden" id="edit_id" value="<?php echo $memberRekening['id'];?>">

<div class="row">
    <fieldset class="form-group col-md-12">
        <label for="addressName-label">Nama Bank</label>
        <select name="search_rekening" id="edit_nama_bank" class="form-control dropdown-select-style" style="margin-left:0px">
            <option value="">- Pilih Rekening -</option>
            <?php foreach($listBank as $bank){ ?>
              <option <?php if($bank['id']==$memberRekening['id_bank']){echo 'selected';}?> value="<?php echo $bank['id'];?>"><?php echo $bank['nama_bank'];?></option>
            <?php } ?>
        </select>
    </fieldset>
</div>
<div class="row">
    <fieldset class="form-group col-md-12">
        <label for="addressName-label">Cabang Pembuka</label>
        <input value="<?php echo $memberRekening['cabang'];?>" type="text" class="form-control text-dark i-address-name" id="edit_cabang_bank" placeholder="Misalnya: BNI KCP Jakarta Pusat">
    </fieldset>
</div>
<div class="row">
    <fieldset class="form-group col-md-12">
        <label for="addressName-label">Nomor Rekening</label>
        <input value="<?php echo $memberRekening['rekening'];?>" type="text" class="form-control text-dark i-address-name" id="edit_nomor_rekening">
    </fieldset>
</div>
<div class="row">
    <fieldset class="form-group col-md-12">
        <label for="addressName-label">Nama Pemilik Rekening</label>
        <input value="<?php echo $memberRekening['atas_nama'];?>" type="text" class="form-control text-dark i-address-name" id="edit_nama_pemilik_rekening">
    </fieldset>
</div>
