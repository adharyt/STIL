
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/js/cart_custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

<!-- kurir -->
<script type="text/javascript">
$('.accordpayment').on('click', function(){
  $(this).parent().find('a').trigger('click')
});

function select_payment(){
  var method=$('input[name=payment_method]:checked').val();
  switch(method){
    case 'bank_transfer':
      var virtual_account='';
      break;
    case 'virtual_account':
      var virtual_account=$('select[name=virtual_account]').val();
      break;
    default:
      break;
  }


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
        url: "<?php echo base_url();?>checkout_payment/process",
        type: "post",
        data: {
            id_sales:'<?php echo $id_sales;?>',
            method:method,
            virtual_account:virtual_account
        },
        success: function (response) {
          Swal.close();
          if(response=="SUCCESS"){
            window.location.href='<?php echo base_url();?>checkout-payment/<?php echo $invoice;?>/confirmation'
          }

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

  });

}

</script>
