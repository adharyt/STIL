<?php if($this->session->flashdata('redirect_link')!=''){
    $redirect_link=$this->session->flashdata('redirect_link');
  }else{
    $redirect_link=base_url();
  }
?>
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
                    <span class="step-current"><span class="step-current-content"><span class="step-number"><span>01</span>/02</span></span></span>
                    <div class="fieldset-flex">
                        <figure>
                            <img src="<?php echo base_url();?>assets/st_register/images/signup-img-3.png" alt="">
                        </figure>
                        <div class="fieldset-content">
                            <label class="form-label">Informasi Penerima</label>
                            Nama Alamat atau Alias<sup style="color:red"><small>*</small></sup>
                            <div class="form-group">
                                <input type="text"  id="add-name" placeholder="Misalnya: Rumah, Kantor, Kost, dll"/>
                            </div>
                            Nama Penerima<sup style="color:red"><small>*</small></sup>
                            <div class="form-group">
                                <input type="text" name="receiver" id="add-penerima" />
                            </div>
                            Nomor Telepon Penerima<sup style="color:red"><small>*</small></sup>
                            <div class="form-group">
                                <input type="text"  id="add-telepon" />
                            </div>
                        </div>
                    </div>

                </fieldset>
                <h3></h3>
                <fieldset>
                    <span class="step-current"><span class="step-current-content"><span class="step-number"><span>02</span>/02</span></span></span>
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
                              <textarea style="height:120px" id="add-alamat" ></textarea>
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
                return true;
            },
            onFinished: function(event, currentIndex) {
              var name=$('#add-name').val();
              var penerima=$('#add-penerima').val();
              var telepon=$('#add-telepon').val();
              var kecamatan=$('#add-kecamatan').val();
              var kodepos='';
              var alamat=$('#add-alamat').val();

              Swal.fire({
                text:'Menyimpan alamat baru...',
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
                    url: "<?php echo base_url();?>profile_address/addressAdd",
                    type: "post",
                    data: {
                      name:name,
                      penerima:penerima,
                      telepon:telepon,
                      kecamatan:kecamatan,
                      kodepos:kodepos,
                      alamat:alamat
                    },
                    success: function (response) {
                      swal.close();
                      if(response=="OK"){
                          Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Alamat berhasil ditambahkan!',
                            showConfirmButton: false,
                            timer: 1500
                          }).then((result) => {
                            window.location.href="<?php echo $redirect_link;?>";
                          });

                      }else if(response=="DUPLICATE"){
                        Swal.fire({
                          type: 'warning',
                          html:   "Nama alamat sudah terdaftar!",
                          showCloseButton: false,
                          showCancelButton: false,
                          showConfirmButton:true,
                          allowEnterKey:true,
                          confirmButtonColor:'#009245'
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
