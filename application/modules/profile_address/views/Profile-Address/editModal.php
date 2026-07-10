<input type="hidden" id="edit-id" value="<?php echo $memberAddress['id'];?>">
<input type="hidden" id="optName" value="<?php echo $memberAddress['nama'];?>">
<input type="hidden" id="optID" value="<?php echo $memberAddress['subcity'];?>">
<div class="row">
    <fieldset class="form-group col-md-12">
        <label for="addressName-label">Nama</label>
        <input value="<?php echo $memberAddress['alias'];?>" type="text" class="form-control text-dark i-address-name" id="edit-name" placeholder="Contoh: Rumah, Kos">
    </fieldset>
</div>
<div class="row">
    <fieldset class="form-group col">
        <label for="recipientName-label">Nama Penerima</label>
        <input value="<?php echo $memberAddress['receiver'];?>" type="text" class="form-control text-dark i-address-name" id="edit-penerima" >
    </fieldset>
    <fieldset class="form-group col">
        <label for="telp-label">Nomer Telepon</label>
        <input value="<?php echo $memberAddress['phone'];?>" type="text" class="form-control text-dark i-address-name" id="edit-telepon">
    </fieldset>
</div>
<div class="row">
    <fieldset class="form-group col">
        <label for="city-label">Kota atau kecamatan</label>
         <select name="search_city" id="edit-kecamatan" class="form-control select2" style="margin-left:0px;">
          <option value="">&nbsp;</option>
         </select>
    </fieldset>
    <fieldset class="form-group col">
        <label for="poscode-label">Kode Pos</label>
        <input value="<?php echo $memberAddress['postalcode'];?>" type="text" class="form-control text-dark i-address-name" id="edit-kodepos">
    </fieldset>
</div>
<div class="row">
    <fieldset class="form-group col-md-12">
        <label for="address-label">Alamat</label>
        <textarea class="form-control rounded-0 text-dark i-address-name" id="edit-alamat" rows="3"><?php echo $memberAddress['address'];?></textarea>
    </fieldset>
</div>
