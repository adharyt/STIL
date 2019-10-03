<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script> 
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>
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
</script>

<!-- Sortable List -->
<script>
Sortable.create(storefront_category_list, {
  animation: 100,
  group: 'list-1',
  draggable: '.list-group-item',
  handle: '.list-group-item',
  sort: true,
  filter: '.sortable-disabled',
  chosenClass: 'active'
});
</script>

</body>
</html>
