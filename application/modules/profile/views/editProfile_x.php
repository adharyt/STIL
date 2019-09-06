<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-select/bootstrap-select.js"></script>
<script src="<?php echo base_url();?>assets/plugins/croppie/croppie.js"></script>
<script src="<?php echo base_url();?>assets/https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>

<!-- Edit Profile JQuery -->
<script>

  function editProfile() {
    $('#btnEdit').hide();
    $('#btnCancel').show();
    $('#btnSave').show();
    $('#nama-label').css("background-color","white").prop( "readonly", false );
    $('#date-label').css("background-color","white").prop( "readonly", false );
    $('#jeniskelamin-label').css("background-color","white").prop( "disabled", false );
    $('#pendidikan-label').css("background-color","white").prop( "disabled", false );
    $('#ktp-label').css("background-color","white").prop( "readonly", false );
    $('#telp-label').css("background-color","white").prop( "readonly", false );
  }

  function saveProfile() {
    var nama=$('#nama-label').val();
    var birthdate=$('#date-label').val();
    var gender=$('#jeniskelamin-label').val();
    var education=$('#pendidikan-label').val();
    var ktp_no=$('#ktp-label').val();
    var phone=$('#telp-label').val();

    Swal.fire({
      text:'Menyimpan perubahan...',
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
          url: "<?php echo base_url();?>profile/editSave",
          type: "post",
          data: {
            nama:nama,
            birthdate:birthdate,
            gender:gender,
            education:education,
            ktp_no:ktp_no,
            phone:phone,
          },
          success: function (response) {
            swal.close();
            if(response=="OK"){
                Swal.fire({
                  type: 'success',
                  html:   "Perubahan berhasil disimpan!",
                  showCloseButton: false,
                  showCancelButton: false,
                  showConfirmButton:true,
                  allowEnterKey:true,
                  confirmButtonColor:'#009245'
                }).then((result) => {
                  $('#btnEdit').show();
                  $('#btnCancel').hide();
                  $('#btnSave').hide();
                  $('#nama-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
                  $('#date-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
                  $('#jeniskelamin-label').attr("style","background-color:  #E8E8E8 !important").prop( "disabled", true );
                  $('#pendidikan-label').attr("style","background-color:  #E8E8E8 !important").prop( "disabled", true );
                  $('#ktp-label').attr("style", "background-color :#E8E8E8 !important").prop( "readonly", true );
                  $('#telp-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
                  location.reload();
                });

            }else{
              Swal.fire({
                type: 'warning',
                html:   "Ada kesalahan dalam pengisian form!",
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton:true,
                allowEnterKey:true,
                confirmButtonColor:'#009245'
              });
            }

          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });


  }

  // Enable Bootstrap Select plugins
  $('.selectpicker').selectpicker();
</script>



<!-- CROPPIE -->
<script>
$(document).ready(function(){

 $image_crop = $('#image_to_crop').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle' //square
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        //console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      Swal.fire({
        text:'Mengganti foto profil...',
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
        url:"<?php echo base_url();?>profile/photo_upload",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#currentpic').attr("src",data);
          $('#imgProfileHeader').attr("src",data);
          swal.close();
          //location.reload();
        }
      });
    })
  });

});
</script>
</body>

</html>
