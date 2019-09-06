<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

<script type="text/javascript">
    $(function(){
       $('#add-kecamatan').select2({
           minimumInputLength: 3,
           allowClear: true,
           placeholder: 'Ketik nama Kota/Kabupaten',
           ajax: {
              dataType: 'json',
              url: 'http://localhost/stil/API/getLocation/ID/ALLCITYANDBELOW',
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data, page) {
              return {
                results: data
              };
            },
          }
      }).on('change', function (evt) {
         var data = $("#add-kecamatan option:selected").val();
      });

 });

function initEditKecamatan(){
    $('#edit-kecamatan').select2({
        minimumInputLength: 3,
        allowClear: true,
        placeholder: 'Ketik nama Kota/Kabupaten',
        ajax: {
           dataType: 'json',
           url: 'http://localhost/stil/API/getLocation/ID/ALLCITYANDBELOW',
           delay: 800,
           data: function(params) {
             return {
               search: params.term
             }
           },
           processResults: function (data, page) {
           return {
             results: data
           };
         },
       }
   }).on('change', function (evt) {
      var data = $("#edit-kecamatan option:selected").val();
   });

   var newOption = new Option($('#optName').val(), $('#optID').val(), true, true);
   $('#edit-kecamatan').append(newOption).trigger('change');

}

 function insertNewAddress() {
   var name=$('#add-name').val();
   var penerima=$('#add-penerima').val();
   var telepon=$('#add-telepon').val();
   var kecamatan=$('#add-kecamatan').val();
   var kodepos=$('#add-kodepos').val();
   var alamat=$('#add-alamat').val();

   Swal.fire({
     text:'Menyimpan alamat baru...',
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
         url: "<?php echo base_url();?>profile/addressAdd",
         type: "post",
         data: {
           name:name,
           penerima:penerima,
           telepon:telepon,
           kecamatan:kecamatan,
           kodepos:kodepos,
           alamat:alamat
         },
         success: function (response) {
           swal.close();
           if(response=="OK"){
               Swal.fire({
                 position: 'center',
                 type: 'success',
                 title: 'Alamat berhasil ditambahkan!',
                 showConfirmButton: false,
                 timer: 1500
               }).then((result) => {
                 location.reload();
               });

           }else if(response=="DUPLICATE"){
             Swal.fire({
               type: 'warning',
               html:   "Nama alamat sudah terdaftar!",
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

 function editAddressModal(idAddress){
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
         url: "<?php echo base_url();?>profile/getMemberAddress",
         type: "post",
         data: {
             id:idAddress
         },
         success: function (response) {

             $('#kontenEditModal').html(response);
             $('#editAddressModal').modal("show");
             setTimeout(
             function()
             {
               initEditKecamatan();
               swal.close();
             }, 1000);





         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     })

 }

 function editAddressSave() {
   var id=$('#edit-id').val();
   var name=$('#edit-name').val();
   var penerima=$('#edit-penerima').val();
   var telepon=$('#edit-telepon').val();
   var kecamatan=$('#edit-kecamatan').val();
   var kodepos=$('#edit-kodepos').val();
   var alamat=$('#edit-alamat').val();


   Swal.fire({
     text:'Menyimpan perubahan alamat...',
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
         url: "<?php echo base_url();?>profile/addressEdit",
         type: "post",
         data: {
           id:id,
           name:name,
           penerima:penerima,
           telepon:telepon,
           kecamatan:kecamatan,
           kodepos:kodepos,
           alamat:alamat
         },
         success: function (response) {
           swal.close();
           if(response=="OK"){
               Swal.fire({
                 position: 'center',
                 type: 'success',
                 title: 'Alamat berhasil dirubah!',
                 showConfirmButton: false,
                 timer: 1500
               }).then((result) => {
                 location.reload();
               });

           }else if(response=="DUPLICATE"){
             Swal.fire({
               type: 'warning',
               html:   "Nama alamat sudah terdaftar!",
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

 function deleteAddressModal(idAddress){
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
         url: "<?php echo base_url();?>profile/getMemberAddressDelete",
         type: "post",
         data: {
             id:idAddress
         },
         success: function (response) {
             swal.close();
             $('#kontenDeleteModal').html(response);
             $('#deleteAddressModal').modal("show");
         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }

     })

 }

 function deleteAddress() {
   var id=$('#delete-id').val();


   Swal.fire({
     text:'Menghapus alamat...',
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
         url: "<?php echo base_url();?>profile/addressDelete",
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
                 title: 'Alamat berhasil dihapus!',
                 showConfirmButton: false,
                 timer: 1500
               }).then((result) => {
                 location.reload();
               });

           }else{
             Swal.fire({
               type: 'danger',
               html:   "Gagal menghapus alamat!",
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

 function setAddressDefault(id) {

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
         url: "<?php echo base_url();?>profile/addressSetDefault",
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
                 text: 'Alamat default berhasil dirubah!',
                 showConfirmButton: false,
                 timer: 1000
               }).then((result) => {
                 location.reload();
               });

           }else{
             Swal.fire({
               type: 'warning',
               html:   "Alamat default gagal dirubah!",
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
