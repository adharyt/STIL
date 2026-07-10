<div class="modal-header new-address-header">
    <h5 class="modal-title new-address-title" id="deleteCategoryLabel">Hapus Etalase</h5>
</div>
<div class="modal-body d-flex justify-content-center p-2 delete-address-body" id="kontenDeleteModal">
    <div class="body-text mt-1"> Apakah kamu yakin ingin mengapus Etalase <b><?php echo $node['name'];?></b>?</div>

</div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Tidak</button>
    <button type="button" class="btn btn-primary" onClick="deleteStoreFrontExe()" style="background-color:#009245;border-color:#009245;cursor:pointer;">Ya</button>
</div>
<script type="text/javascript">
function deleteStoreFrontExe(id){
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
          url: "<?php echo base_url();?>sc_storefront/deleteExe",
          type: "post",
          data: {
              id:'<?php echo $node['id'];?>',
          },
          success: function (response) {
              $('#deleteStorefrontModal').modal("hide");
              swal.close();
              location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
