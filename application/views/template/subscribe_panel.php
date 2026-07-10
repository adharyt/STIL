<!-- Newsletter -->
<div class="newsletter" style="background-color:white!important">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
          <div class="newsletter_title_container">
            <div class="newsletter_icon"><img width="60" src="<?php echo base_url();?>assets/images/icon-img/send.png" alt=""></div>
            <div class="newsletter_title">Berlangganan Newsletter</div>
            <div class="newsletter_text"><p>...dan dapatkan berbagai promo menarik!</p></div>
          </div>
          <div class="newsletter_content clearfix">
            <div class="newsletter_form">
              <input id="newsletter_email" type="email" class="newsletter_input" required="required" placeholder="example: yourname@domain.com">
              <button onClick="subscribe();" class="newsletter_button">Berlangganan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function subscribe(){
  var subs_email=$('#newsletter_email').val();

  if(subs_email!=''){
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    if(pattern.test(subs_email)){
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
            url: "<?php echo base_url();?>subscribe",
            type: "post",
            data: {
                email:subs_email
            } ,
            success: function (response) {
              Swal.close();
               // you will get response from your php page (what you echo or print)
               if(response=='SUB'){
                 $('#newsletter_email').val('');
                 Swal.fire({
                   type: 'success',
                   title: 'Pendaftaran Newsletter Berhasil',
                   html:   "Untuk memulai berlangganan, silahkan verifikasi email Anda dengan cara menekan tombol konfirmasi yang telah kami kirim ke email Anda!<br>&nbsp;"+
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
               }else{
                 $('#newsletter_email').val('');
                 Swal.fire({
                   type: 'info',
                   title: 'Pendaftaran Newsletter',
                   html:   "Email Anda sudah terdaftar!<br>&nbsp;"+
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
          title: 'Pendaftaran Newsletter Gagal',
          html:   "Alamat email tidak valid!<br>&nbsp;"+
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
  }else{
    Swal.fire({
      type: 'warning',
      title: 'Pendaftaran Newsletter Gagal',
      html:   "Alamat email wajib diisi!<br>&nbsp;"+
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
