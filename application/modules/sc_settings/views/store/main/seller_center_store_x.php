<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/croppie/croppie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/store_photo.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/croppie/croppie.js"></script>
<script>
$(document).ready(function(){

 $image_crop = $('#image_to_crop_header').croppie({
    enableExif: true,
    quality:1,
    size: { width: 1300, height: 200},
    viewport: {
      width:390,
      height:60,
      type:'square' //square
    },
    boundary:{
      width:390,
      height:60
    }
  });

  $('#upload_image_header').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        //console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimage_headerModal').modal('show');
  });

  $('#crop_imagebutton').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: { width: 1300, height: 200 }
    }).then(function(response){
      Swal.fire({
        text:'Mengganti foto header...',
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
        url:"<?php echo base_url();?>store/store_header_upload",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimage_headerModal').modal('hide');
          swal.close();
          location.reload();
        }
      });
    })
  });

  $store_image_crop = $('#image_store_to_crop').croppie({
     enableExif: true,
     viewport: {
       width:200,
       height:200,
       type:'circle' //square
     },
     boundary:{
       width:300,
       height:300
     }
   });

   $('#upload_image_store').on('change', function(){
     var reader = new FileReader();
     reader.onload = function (event) {
       $store_image_crop.croppie('bind', {
         url: event.target.result
       }).then(function(){
         //console.log('jQuery bind complete');
       });
     }
     reader.readAsDataURL(this.files[0]);
     $('#uploadimageStoreModal').modal('show');
   });

   $('#crop_store_image_now').click(function(event){
     $store_image_crop.croppie('result', {
       type: 'canvas',
       size: 'viewport'
     }).then(function(response){
       Swal.fire({
         text:'Mengganti foto toko...',
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
         url:"<?php echo base_url();?>store/store_photo_upload",
         type: "POST",
         data:{"image": response},
         success:function(data)
         {
           $('#uploadimageStoreModal').modal('hide');
           $('.img-profile-sidebar').attr("src",data);
           swal.close();
           //location.reload();
         }
       });
     })
   });

});
</script>

</body>
</html>
