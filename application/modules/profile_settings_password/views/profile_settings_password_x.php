
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

<script type="text/javascript">
var status_old_password=0;
var status_new_password=0;
var status_new_password_c=0;
var is_reset_click=0;

function validate_new_password_confirm(password){
  if(password!=''){
    $('#alert_password_c_null').hide();
    if(password==$('#new_password').val()){
      status_new_password_c=1;
      $('#alert_password_not_match').hide();
    }else{
      status_new_password_c=0;
      $('#alert_password_not_match').show();
    }
  }else{
    $('#alert_password_c_null').show();
    status_new_password_c=0;
  }
}

function validate_old_password(password){
  $('#alert_null_password_old').hide();
  $('#alert_wrong_password').hide();
  if(password!=''){
    $.ajax({
            url: "<?php echo base_url();?>Profile_settings_password/checkOldPassword",
            type: "post",
            data: {
                password:password
            } ,
            success: function (response) {
               // you will get response from your php page (what you echo or print)
               switch(response){
                 case 'OK':
                   $('#alert_wrong_password').hide();
                   status_old_password=1;
                   break;
                 case 'NOT OK':
                   $('#alert_wrong_password').show();
                   status_old_password=0;
                   break;
                  default:
                    status_old_password=0;
                    break;
               }

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }


        });
  }else{
    $('#alert_null_password_old').show();
    $('#alert_wrong_password').hide();
    status_old_password=0;
  }
}

function validate_new_password(password){
  $('#alert_null_password_new').hide();
  $('#alert_minimum_char').hide();
  $('#alert_password_match_old').hide();
  if(password!=''){
    if(password.length<8){
      $('#alert_minimum_char').show();
      status_new_password=0;
    }else{
      $.ajax({
              url: "<?php echo base_url();?>Profile_settings_password/checkOldPassword",
              type: "post",
              data: {
                  password:password
              } ,
              success: function (response) {
                 // you will get response from your php page (what you echo or print)
                 switch(response){
                   case 'OK':
                     $('#alert_password_match_old').show();
                     status_new_password=0;
                     break;
                   case 'NOT OK':
                     status_new_password=1;
                     break;
                    default:
                      status_new_password=0;
                      break;
                 }

              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }


          });
        }
  }else{
    $('#alert_null_password_new').show();
    $('#alert_minimum_char').hide();
    $('#alert_password_match_old').hide();
    status_new_password=0;
  }
}

</script>
<script type="text/javascript">
function validateAfter(){
  if(is_reset_click==1){
    var old_password=$('#old_password').val();
    var new_password=$('#new_password').val();
    var new_password_confirm=$('#new_password_confirm').val();
    validate_old_password(old_password);
    validate_new_password(new_password);
    validate_new_password_confirm(new_password_confirm);
  }
}

function changePassword(){
  is_reset_click=1;
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

  var old_password=$('#old_password').val();
  var new_password=$('#new_password').val();
  var new_password_confirm=$('#new_password_confirm').val();
  validate_old_password(old_password);
  validate_new_password(new_password);
  validate_new_password_confirm(new_password_confirm);

  setTimeout(change, 3000);


}

function change(){
  var old_password=$('#old_password').val();
  var new_password=$('#new_password').val();
  var new_password_confirm=$('#new_password_confirm').val();
  if(status_old_password==1 && status_new_password==1 && status_new_password_c==1){
    if(new_password==new_password_confirm){
      $('#alert_password_not_match').hide();
    $.ajax({
            url: "<?php echo base_url();?>Profile_settings_password/change",
            type: "post",
            data: {
                old_password:old_password,
                password:new_password
            } ,
            success: function (response) {
              Swal.close();
               // you will get response from your php page (what you echo or print)
               switch(response){
                 case 'OK':
                     Swal.fire({
                       type: 'success',
                       title: 'Perubahan Password Berhasil',
                       html:   "Anda harus login kembali menggunakan password baru!",
                       showCloseButton: true,
                       showCancelButton: false,
                       showConfirmButton:true,
                       confirmButtonColor:'#099245',
                       allowEnterKey:false
                     }).then((result) => {
                        if (result.value) {
                            location.href="<?php echo base_url();?>logout";
                        }
                      });
                     break;
                  case 'NOT FOUND':
                      Swal.fire({
                        type: 'error',
                        title: 'Error',
                        html:   "Data tidak ditemukan",
                        showCloseButton: true,
                        showCancelButton: false,
                        showConfirmButton:true,
                        confirmButtonColor:'#099245',
                        allowEnterKey:false
                      });
                      break;
                   default:
                   Swal.fire({
                     type: 'error',
                     title: 'Error',
                     html:   "Error",
                     showCloseButton: true,
                     showCancelButton: false,
                     showConfirmButton:true,
                     confirmButtonColor:'#099245',
                     allowEnterKey:false
                   });
                   break;

               }

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }


        })
      }else{
        $('#alert_password_not_match').show();
      }
  }else{
    Swal.close();
    Swal.fire({
      type: 'error',
      title: 'Perubahan Password Gagal',
      html:   "Terdapat beberapa kesalahan!",
      showCloseButton: true,
      showCancelButton: false,
      showConfirmButton:true,
      confirmButtonColor:'#099245',
      allowEnterKey:true,
      focusConfirm:true,
      onBeforeOpen: () =>{
      },
      onOpen: () => {
        Swal.hideLoading();
        Swal.disableLoading();
      }
    });

  }
}
</script>

</body>

</html>
