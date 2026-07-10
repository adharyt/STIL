
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/js/product_custom.js"></script>
<script type="text/javascript">
function submitFeedback(){
  var fb_response=$('input[name=response]:checked').val();
  var fb_response_detail=$('textarea[name=response_detail]').val();
  var id_trans=$('input[name=id_trans]').val();
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
          url: "<?php echo base_url();?>response_feedback/store_submit",
          type: "post",
          data: {
              id_trans:id_trans,
              response:fb_response,
              response_detail:fb_response_detail
          } ,
          success: function (response) {
          swal.close();
          if(response!='FAILED'){
            alert(response);
          }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }


      })
}
</script>
