 <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script> 
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>

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
