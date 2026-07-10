<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>

<!-- Seller Center Dashboard JQuery -->
<script>
    function show_pengaturan_toko() {
        $('#pengaturan_toko_content').show();
    }

    $('.acorddion-style').on('click',function(e){
        $(this).children('i').toggleClass('fa-chevron-down fa-chevron-up');
    });

    function insertNewRekening() {
   var nama_bank=$('#nama_bank').val();
   var cabang_bank=$('#cabang_bank').val();
   var nomor_rekening=$('#nomor_rekening').val();
   var nama_pemilik_rekening=$('#nama_pemilik_rekening').val();

   if(nama_bank!='' && cabang_bank!='' && nomor_rekening!='' && nama_pemilik_rekening!=''){
   Swal.fire({
     text:'Menyimpan rekening baru...',
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
         url: "<?php echo base_url();?>Sc_rekening/rekeningAdd",
         type: "post",
         data: {
           nama_bank:nama_bank,
           cabang_bank:cabang_bank,
           nomor_rekening:nomor_rekening,
           nama_pemilik_rekening:nama_pemilik_rekening
         },
         success: function (response) {
           swal.close();
           if(response=="OK"){
               Swal.fire({
                 position: 'center',
                 type: 'success',
                 title: 'Rekening berhasil ditambahkan!',
                 showConfirmButton: false,
                 timer: 1500
               }).then((result) => {
                 location.reload();
               });

           }else if(response=="DUPLICATE"){
             Swal.fire({
               type: 'warning',
               html:   "Rekening sudah terdaftar!",
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:true,
               allowEnterKey:true,
               confirmButtonColor:'#009245'
             });
           }else{
             Swal.fire({
               type: 'warning',
               html:   "Ada kesalahan dalam pengisian form!",
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:true,
               allowEnterKey:true,
               confirmButtonColor:'#009245'
             });
           }

         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     });
   }else{
     Swal.fire({
       type: 'warning',
       html:   "Semua field harus diisi!",
       showCloseButton: false,
       showCancelButton: false,
       showConfirmButton:true,
       allowEnterKey:true,
       confirmButtonColor:'#009245'
     });
   }


 }

 function editRekeningModal(idRekening){
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
         url: "<?php echo base_url();?>Sc_rekening/getMemberRekening",
         type: "post",
         data: {
             id:idRekening
         },
         success: function (response) {

             $('#kontenEditModal').html(response);
             $('#editRekeningModal').modal("show");
             Swal.close();





         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     })

 }

 function editRekeningSave() {
   var id=$('#edit_id').val();
   var edit_nama_bank=$('#edit_nama_bank').val();
   var edit_cabang_bank=$('#edit_cabang_bank').val();
   var edit_nomor_rekening=$('#edit_nomor_rekening').val();
   var edit_nama_pemilik_rekening=$('#edit_nama_pemilik_rekening').val();


   Swal.fire({
     text:'Menyimpan perubahan rekening...',
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
         url: "<?php echo base_url();?>Sc_rekening/rekeningEdit",
         type: "post",
         data: {
           id:id,
           edit_nama_bank:edit_nama_bank,
           edit_cabang_bank:edit_cabang_bank,
           edit_nomor_rekening:edit_nomor_rekening,
           edit_nama_pemilik_rekening:edit_nama_pemilik_rekening
         },
         success: function (response) {
           swal.close();
           if(response=="OK"){
               Swal.fire({
                 position: 'center',
                 type: 'success',
                 title: 'Rekening berhasil dirubah!',
                 showConfirmButton: false,
                 timer: 1500
               }).then((result) => {
                 location.reload();
               });

           }else if(response=="DUPLICATE"){
             Swal.fire({
               type: 'warning',
               html:   "Data rekening sudah terdaftar!",
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:true,
               allowEnterKey:true,
               confirmButtonColor:'#009245'
             });
           }else{
             Swal.fire({
               type: 'warning',
               html:   "Ada kesalahan dalam pengisian form!",
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:true,
               allowEnterKey:true,
               confirmButtonColor:'#009245'
             });
           }

         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     });


 }

 function deleteRekeningModal(idRekening){
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
         url: "<?php echo base_url();?>Sc_rekening/getMemberRekeningDelete",
         type: "post",
         data: {
             id:idRekening
         },
         success: function (response) {
             swal.close();
             $('#kontenDeleteModal').html(response);
             $('#deleteRekeningModal').modal("show");
         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     })

 }

 function deleteRekening() {
   var id=$('#delete-id').val();


   Swal.fire({
     text:'Menghapus rekening...',
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
         url: "<?php echo base_url();?>Sc_rekening/rekeningDelete",
         type: "post",
         data: {
           id:id
         },
         success: function (response) {
           swal.close();
           if(response=="OK"){
               Swal.fire({
                 position: 'center',
                 type: 'success',
                 title: 'Rekening berhasil dihapus!',
                 showConfirmButton: false,
                 timer: 1500
               }).then((result) => {
                 location.reload();
               });

           }else{
             Swal.fire({
               type: 'danger',
               html:   "Gagal menghapus rekening!",
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:true,
               allowEnterKey:true,
               confirmButtonColor:'#009245'
             });
           }

         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     });


 }

 function setRekeningDefault(id) {

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
         url: "<?php echo base_url();?>Sc_rekening/rekeningSetDefault",
         type: "post",
         data: {
           id:id
         },
         success: function (response) {
           swal.close();
           if(response=="OK"){
               Swal.fire({
                 position: 'center',
                 type: 'success',
                 text: 'Rekening default berhasil dirubah!',
                 showConfirmButton: false,
                 timer: 1000
               }).then((result) => {
                 location.reload();
               });

           }else{
             Swal.fire({
               type: 'warning',
               html:   "Rekening default gagal dirubah!",
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:true,
               allowEnterKey:true,
               confirmButtonColor:'#009245'
             });
           }

         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     });


 }
</script>

</body>
</html>
