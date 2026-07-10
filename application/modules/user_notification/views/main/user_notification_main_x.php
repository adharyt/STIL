 
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

  function rentangHarga() {
    $('#rentang_harga_modal_label').css('color', '#009245');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga_modal').show();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function kondisiBarang() {
    $('#rentang_harga_modal_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', '#009245');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga_modal').hide();
    $('#kondisi_barang').show();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function rating() {
    $('#rentang_harga_modal_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', '#009245');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga_modal').hide();
    $('#kondisi_barang').hide();
    $('#rating').show();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function gratisOngkir() {
    $('#rentang_harga_modal_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', '#009245');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga_modal').hide();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').show();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function jasaPengiriman() {
    $('#rentang_harga_modal_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', '#009245');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga_modal').hide();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').show();
    $('#lainnya').hide();
  }

  function lainnya() {
    $('#rentang_harga_modal_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', '#009245');
    $('#rentang_harga_modal').hide();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').show();
  }
  // --------------------
</script>
</body>
</html>
