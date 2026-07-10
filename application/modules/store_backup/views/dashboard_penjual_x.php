 
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="<?php echo base_url();?>assets/https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>

<!-- Edit Profile JQuery -->
<script>

  // ------ Semua Barang ------
  function showSemuaBarang() {
    $('#semua_barang_container').show();
    $('#barang_dijual_container').hide();
    $('#barang_belum_dijual_container').hide();
    $('#barang_draft_container').hide();
  }

  function rentangHarga() {
    $('#rentang_harga_label').css('color', '#009245');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga').show();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function kondisiBarang() {
    $('#rentang_harga_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', '#009245');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga').hide();
    $('#kondisi_barang').show();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function rating() {
    $('#rentang_harga_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', '#009245');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga').hide();
    $('#kondisi_barang').hide();
    $('#rating').show();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function gratisOngkir() {
    $('#rentang_harga_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', '#009245');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga').hide();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').show();
    $('#jasaPengiriman').hide();
    $('#lainnya').hide();
  }

  function jasaPengiriman() {
    $('#rentang_harga_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', '#009245');
    $('#lainnya_label').css('color', 'black');
    $('#rentang_harga').hide();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').show();
    $('#lainnya').hide();
  }

  function lainnya() {
    $('#rentang_harga_label').css('color', 'black');
    $('#kondisi_barang_label').css('color', 'black');
    $('#rating_label').css('color', 'black');
    $('#gratis_ongkir_label').css('color', 'black');
    $('#jasa_pengiriman_label').css('color', 'black');
    $('#lainnya_label').css('color', '#009245');
    $('#rentang_harga').hide();
    $('#kondisi_barang').hide();
    $('#rating').hide();
    $('#gratisOngkir').hide();
    $('#jasaPengiriman').hide();
    $('#lainnya').show();
  }
  // --------------------

  // Barang Dijual
  function showBarangDijual() {
    $('#semua_barang_container').hide();
    $('#barang_dijual_container').show();
    $('#barang_belum_dijual_container').hide();
    $('#barang_draft_container').hide();
  }

  // Barang Belum dijual
  function showBarangBelumDijual() {
    $('#semua_barang_container').hide();
    $('#barang_dijual_container').hide();
    $('#barang_belum_dijual_container').show();
    $('#barang_draft_container').hide();
  }

  // Barang Draft
  function showBarangDraft() {
    $('#semua_barang_container').hide();
    $('#barang_dijual_container').hide();
    $('#barang_belum_dijual_container').hide();
    $('#barang_draft_container').show();
  }


  function saveProfile() {
    $('#btnEdit').show();
    $('#btnSave').hide();
    $('#nama-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
    $('#date-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
    $('#jeniskelamin-label').attr("style","background-color:  #E8E8E8 !important").prop( "disabled", true );
    $('#pendidikan-label').attr("style","background-color:  #E8E8E8 !important").prop( "disabled", true );
    $('#ktp-label').attr("style", "background-color :#E8E8E8 !important").prop( "readonly", true );
    $('#email-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
    $('#telp-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
  }

  // Enable Bootstrap Select plugins 
  $('.selectpicker').selectpicker();
</script>

<script type="text/javascript">
function send(){
  var contact_form_name=$('#contact_form_name').val();
  var contact_form_email=$('#contact_form_email').val();
  var contact_form_phone=$('#contact_form_phone').val();
  var contact_form_message=$('#contact_form_message').val();



if(contact_form_name!='' && contact_form_email!='' &&   contact_form_phone!='' && contact_form_message!=''){
$.ajax({
        url: "<?php echo base_url();?>contact/send",
        type: "post",
        data: {
            name:contact_form_name,
            email:contact_form_email,
            phone:contact_form_phone,
            message:contact_form_message
        } ,
        success: function (response) {
           // you will get response from your php page (what you echo or print)
           if(response=='OK'){
             Swal.fire({
               type: 'success',
               title: 'Pengiriman pesan berhasil',
               html:   "STIL akan membalas pesan Anda melalui email atau telepon<br>&nbsp;"+
                                 '<div class="contact-form-area">'+
                                             '<div class="row">'+
                                             '<div class="col-12">'+
                                                 '<div class="button "><a href="javascript:window.location.reload();">Ok</a></div>'+
                                             '</div>'+
                                             '</div>'+
                                 '</div>',
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:false,
               allowEnterKey:false
             });
           }else{
             Swal.fire({
               type: 'error',
               title: 'Gagal mengirim pesan',
               html:   "Pastikan koneksi internet Anda stabil!<br>&nbsp;"+
                                 '<div class="contact-form-area">'+
                                             '<div class="row">'+
                                             '<div class="col-12">'+
                                                 '<div class="button "><a href="javascript:swal.close();">Ok</a></div>'+
                                             '</div>'+
                                             '</div>'+
                                 '</div>',
               showCloseButton: false,
               showCancelButton: false,
               showConfirmButton:false,
               allowEnterKey:false
             });
         }

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    })
  }else{
    Swal.fire({
      type: 'warning',
      title: 'Gagal mengirim pesan',
      html:   "Setiap field tidak boleh kosong!<br>&nbsp;"+
                        '<div class="contact-form-area">'+
                                    '<div class="row">'+
                                    '<div class="col-12">'+
                                        '<div class="button "><a href="javascript:swal.close();">Ok</a></div>'+
                                    '</div>'+
                                    '</div>'+
                        '</div>',
      showCloseButton: false,
      showCancelButton: false,
      showConfirmButton:false,
      allowEnterKey:false
    });
  }
}
</script>
</body>

</html>
