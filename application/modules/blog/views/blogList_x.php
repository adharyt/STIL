<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/js/blog_custom.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.loading').hide();
    $(document).on('click','.show_more',function(){

        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loading').show();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>blog/getPostListAppend',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.postList').append(html);
                $('.loading').hide();
            }
        });
    });
});
</script>
</body>

</html>
