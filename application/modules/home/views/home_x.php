<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/slick-1.8.0/slick.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

$('.sliderTab').on('click',function(e){
  setTimeout(
  function()
  {
    $('.featured_slider_item').css('padding','10px');
  }, 500);

});
</script>
<script type="text/javascript">
  function addToCart(product_id){
    <?php if($this->session->userdata('is_login')=='y'){ ?>
    var quantity=$('#qv_min_quantity').text();
    Swal.fire({
      text:'Loading...',
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
          url: "<?php echo base_url();?>cart/addToCart",
          type: "post",
          data: {
              idProduk:product_id,
              quantity:quantity,
              src:'WEB'
          },
          success: function (response) {
            Swal.close();
            if(response!="FAILED"){
              $('#cartcount').text(response);
              Swal.fire({
                title: 'Berhasil!',
                text: "Barang berhasil ditambahkan ke keranjang! Lihat keranjang Anda sekarang?",
                type: 'success',
                reverseButtons:true,
                showCancelButton: true,
                confirmButtonColor: '#099235',
                confirmButtonText: 'Lihat Keranjang',
                cancelButtonText: 'Nanti Saja'
              }).then((result) => {
                if (result.value) {
                  location.href="<?php echo base_url();?>cart";
                }
              })
            }


          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
      <?php }else{ ?>
        login();
        <?php } ?>
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
    <?php if($this->session->userdata('is_login')=='y'){ ?>
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

      });
      <?php }else{ ?>
        login();
      <?php } ?>

  }

</script>
</body>
</html>
