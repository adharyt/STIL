<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/st_register/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/st_register/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
    <style media="screen">
    .select2-container--default .select2-selection--single {
        background-color: rgb(255, 255, 255);
        border-width: 1px;
        border-style: solid;
        border-color: rgb(170, 170, 170);
        border-image: initial;
        border-radius: 4px;
        height:36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 36px;
    }
    </style>
</head>

<body>

    <div class="main" style="padding:30px">

        <div class="container">
            <form method="POST" id="signup-form" class="signup-form" enctype="multipart/form-data">
                <h3></h3>
                <fieldset>
                    <span class="step-current"> <span class="step-current-content"><span class="step-number"><span>01</span>/04</span></span> </span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="<?php echo base_url();?>assets/images/logoName.png" width="250px" alt="">
                        </figure>
                        <div class="fieldset-content">
                            <h2>Term of Agreements</h2>
                            <div class="form-flex">
                                <textarea>aaaaaaaaaaaaaaaaaarea</textarea><br>
                            </div>

                                <input id="toa" type="checkbox" style="height:10px;width:15px;display:inline"><small>Saya telah membaca dan setuju dengan Syarat & Ketentuan</small></input>
                        </div>
                    </div>
                </fieldset>

                <h3></h3>
                <fieldset>
                    <span class="step-current"><span class="step-current-content"><span class="step-number"><span>02</span>/04</span></span></span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="<?php echo base_url();?>assets/st_register/images/signup-img-3.png" alt="">
                        </figure>
                        <div class="fieldset-content">
                            <label class="form-label">Informasi Umum Toko</label>
                            Nama Toko<sup style="color:red"><small>*</small></sup>
                            <div class="form-group">
                                <input type="text"  id="nama_toko" />
                            </div>
                            Nomor Telepon Toko
                            <div class="form-group">
                                <input type="text" name="phone_number" id="nomor_telepon" />
                                <small>Nomor kontak toko tidak akan digunakan untuk OTP dan akan digunakan untuk keperluan pengiriman barang, bukti pembayaran, dan lain-lain.</small>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <h3></h3>
                <fieldset>
                    <span class="step-current"><span class="step-current-content"><span class="step-number"><span>03</span>/04</span></span></span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="<?php echo base_url();?>assets/st_register/images/signup-img-2.png" alt="">
                        </figure>
                        <div class="fieldset-content">
                          <label class="form-label">Informasi Umum Toko</label>
                            <div class="form-textarea">
                                Deskripsi Toko<sup style="color:red"><small>*</small></sup>
                                <textarea  id="deskripsi_toko"></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <h3></h3>
                <fieldset>
                    <span class="step-current"><span class="step-current-content"><span class="step-number"><span>04</span>/04</span></span></span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="<?php echo base_url();?>assets/st_register/images/signup-img-2.png" alt="">
                        </figure>
                        <div class="fieldset-content">
                          <label class="form-label">Informasi Alamat</label>
                          Kota/Kabupaten<sup style="color:red"><small>*</small></sup>
                          <div class="form-group">
                              <select name="kota_toko" id="add-kecamatan"  style="width:100%">
                              </select>
                          </div>
                          Alamat Lengkap<sup style="color:red"><small>*</small></sup>
                          <div class="form-textarea">
                              <textarea style="height:120px" id="alamat_toko" ></textarea>
                          </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="<?php echo base_url();?>assets/st_register/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/st_register/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/st_register/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?php echo base_url();?>assets/st_register/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

    <script type="text/javascript">
        $(function(){
           $('#add-kecamatan').select2({
               minimumInputLength: 3,
               allowClear: true,
               placeholder: 'Ketik nama Kota/Kabupaten',
               ajax: {
                  dataType: 'json',
                  url: '<?php echo base_url();?>API/getLocation/ID/ALLCITYANDBELOW',
                  delay: 800,
                  data: function(params) {
                    return {
                      search: params.term
                    }
                  },
                  processResults: function (data, page) {
                  return {
                    results: data
                  };
                },
              }
          }).on('change', function (evt) {
             var data = $("#add-kecamatan option:selected").val();
          });

     });

     </script>
    <script>
    (function($) {

        var form = $("#signup-form");
        form.steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            labels: {
                previous: 'Prev',
                next: 'Next',
                finish: 'Submit',
                current: ''
            },
            titleTemplate: '<h3 class="title">#title#</h3>',
            onStepChanging: function (event, currentIndex, newIndex)
            {
                if(currentIndex === 0) {
                    if($('#toa').is(':checked')){
                      return true;
                    }else{
                        Swal.fire({
                           html: "Untuk melanjutkan, Anda harus<br>menyetujui Term of Agreement!",
                           type: 'warning',
                           showCancelButton: false,
                           confirmButtonColor: '#009245',
                         });
                      return false;
                    }
                }
                return true;
            },
            onFinished: function(event, currentIndex) {
              var nama_toko=$('#nama_toko').val();
              var nomor_telepon=$('#nomor_telepon').val();
              var deskripsi_toko=$('#deskripsi_toko').val();
              var kota_toko=$('#add-kecamatan').val();
              var alamat_toko=$('#alamat_toko').val();

              if(nama_toko!='' && deskripsi_toko!='' && kota_toko!='' && alamat_toko!=''){
                Swal.fire({
            	    text:'Membuat toko...',
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
        	            url: "<?php echo base_url();?>sc_register/register_submit",
        	            type: "post",
        	            data: {
        	                nama_toko:nama_toko,
        	                nomor_telepon:nomor_telepon,
        	                deskripsi_toko:deskripsi_toko,
        	                kota_toko:kota_toko,
                          alamat_toko:alamat_toko
        	            } ,
        	            success: function (response) {
                        Swal.close();
                        console.log(response);
        	               // you will get response from your php page (what you echo or print)
        	               switch(response){
                           case 'SUCCESS':
                                 Swal.fire({
                                   position: 'center',
                                   type: 'success',
                                   title: 'Toko Anda berhasil dibuat!',
                                   showConfirmButton: false,
                                   timer: 1500
                                 });
                                 window.location.href="<?php echo base_url();?>my-store";
                                break;
                            case  'FAILED DUPLICATE NAME':
                                  Swal.fire({
                                   type: 'error',
                                   title: 'Pendaftaran Gagal',
                                   text: 'Nama Toko yang dipilih sudah terdaftar!'
                                 });
                                 break;
                            default:
                                  Swal.fire({
                                   type: 'error',
                                   title: 'Registrasi Gagal',
                                   text: 'Mohon periksa koneksi internet Anda!'
                                 });
                                  break;

                         }

        	            },
        	            error: function(jqXHR, textStatus, errorThrown) {
        	               console.log(textStatus, errorThrown);
        	            }


        	        });
              }else{
                var text="Mohon lengkapi seluruh form yang wajib diisi!";
                Swal.fire({
                   html: text,
                   type: 'warning',
                   showCancelButton: false,
                   confirmButtonColor: '#009245',
                 });
              }

            }
        });

        $(".toggle-password").on('click', function() {

            $(this).toggleClass("zmdi-eye zmdi-eye-off");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

    })(jQuery);
    </script>
</body>

</html>
