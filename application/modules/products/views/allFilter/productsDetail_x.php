<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
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

<script type="text/javascript">
$(function(){
$('#kategori').find('div').click(function(e){
    $(this).parent().children('ol').toggle();
    $(this).children('i').toggleClass('fa-chevron-right fa-chevron-down');
});
});
</script>
<script type="text/javascript">
  function quickview(idProduk,storeLink){
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

          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      })

  }



</script>
