
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo base_url();?>assets/js/shop_custom.js"></script>
<script src="<?php echo base_url();?>assets/plugins/croppie/croppie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/product_filter.js"></script>
<script src="<?php echo base_url();?>assets/https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>

<script type="text/javascript">
function storeFavo(idStore){
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
        url: "<?php echo base_url();?>store/storeFav",
        type: "post",
        data: {
            id:idStore
        },
        success: function (response) {
          swal.close();
          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    })

}
</script>
<script type="text/javascript">
  function quickview(idProduk,storeLink){
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
          url: "<?php echo base_url();?>products/getQuickview",
          type: "post",
          data: {
              id:idProduk,
              store:storeLink
          },
          success: function (response) {
              $('#quickviewItem').html(response);
              $('#modalQuickView').modal("show");
							swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      })

  }

	function swishlist(idProduk,storeLink){
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
          url: "<?php echo base_url();?>product/swishlist",
          type: "post",
          data: {
              id:idProduk,
              store:storeLink
          },
          success: function (response) {
            if(response=="OKi"){
              var newVal=parseInt($('#wishlistCount').text())+1;
              $('#wishlistCount').text(newVal);
            }else{
              var newVal=parseInt($('#wishlistCount').text())-1;
              $('#wishlistCount').text(newVal);
            }

						swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      })

  }

</script>
<!-- CROPPIE -->
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
           $('#storecurrentpic').attr("src",data);
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
