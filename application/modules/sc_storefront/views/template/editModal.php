<div class="modal-header new-address-header">
    <h5 class="modal-title new-address-title" id="editAddressLabel">Edit Etalse</h5>
    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
    <span aria-hidden="true" class="fas fa-times-circle"></span>
    </button>
</div>
<div class="modal-body d-flex justify-content-center p-2 new-address-body">
    <div class="row">
        <fieldset class="form-group col-md-12">
            <label for="addressName-label">Nama Etalase</label>
            <input value="<?php echo $node['name'];?>" type="text" class="form-control text-dark i-address-name" id="edit-name">
        </fieldset>
    </div>
</div>
<div class="modal-footer">
    <button onClick="editStoreFrontExe('<?php echo $node['id'];?>');" type="button" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Simpan</button>
</div>
<script type="text/javascript">
function editStoreFrontExe(id){
    Swal.fire({
      text:'Mohon menunggu...',
      background:'#FFFFFF',
      width:'300px',
      height:'100px',
      confirmButtonColor:'#009245',
      showConfirmButton:false,
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      onBeforeOpen: () =>{
      },
      onOpen: () => {
        swal.showLoading()
      }
    });
    $.ajax({
          url: "<?php echo base_url();?>sc_storefront/EditExe",
          type: "post",
          data: {
              id:id,
              name:$('#edit-name').val()
          },
          success: function (response) {
            if(response=='OK'){
              Swal.fire({
                   title: "Perubahan berhasil disimpan!",
                   text: "Klik ok untuk merefresh halaman",
                   type: 'Success',
                   showCancelButton: false,
                   confirmButtonColor: '#009245',
                 }).then((result) => {
                   $('#editStorefrontModal').modal("hide");
                   swal.close();
                   location.reload();
                 })
             }else{
               Swal.fire({
                    title: "Etalase gagal ditambahkan!",
                    text: "Data sudah ada",
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#009245',
                  });
             }

          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
