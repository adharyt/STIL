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
<script src="<?php echo base_url();?>assets/js/product_custom.js"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
<script type="text/javascript">
  function addToCart(product_id){
    var quantity=$('#quantity_input').val();
    if(quantity=='' || quantity<1){
      quantity=1;
      $('#quantity_input').val('1');
    }
    $.ajax({
          url: "<?php echo base_url();?>cart/addToCart",
          type: "post",
          data: {
              idProduk:product_id,
              quantity:quantity,
              src:'WEB'
          },
          success: function (response) {
            if(response=="OK"){
              alert("ok");
            }


          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      })

  }


  $('.quantity_inc').on('click', function(e) {
    e.preventDefault();
    var value = parseInt($('#quantity_input').val());


    value=value+1;
    $('#quantity_input').val(value);
    validation_quantity();
  });

  $('.quantity_dec').on('click', function(e) {
    e.preventDefault();
    var value = parseInt($('#quantity_input').val());


    value=value-1;
    $('#quantity_input').val(value);
    validation_quantity();
  });

  function validation_quantity(){
    var min=parseInt($('#quantity_input').attr('min'));
    var max=parseInt($('#quantity_input').attr('max'));
    var value=parseInt($('#quantity_input').val());
    var newval=value;
    if(value>max){
      newval=max;
    }
    if(newval<min){
      newval=min;
    }
    $('#quantity_input').val(newval);
  }
</script>
