<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STIL | Register</title>
		<link rel="icon" href="<?php echo base_url();?>assets/images/logo.png" type="image/x-icon">
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/as_login/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/as_login/vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/as_login/css/style.css">
		<link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
</head>
<body>
<style>



/* Shared */
.container {
    width: 100%;
    background: #fff;
}

.register-form {
    padding: 50px 90px 90px 80px;
    margin-bottom: -8px;
}

a:link {
  color:#039648;
  font-style:none;
  text-decoration: none;
}

a:visited {
  color:#039648;
  font-style:none;
  text-decoration: none;
}

.loginBtn {
  box-sizing: border-box;
  position: relative;
  /* width: 13em;  - apply for fixed size */
  padding: 0 15px 0 46px;
  border: none;
  margin-top:0.2em;
  text-align: left;
  line-height: 34px;
  white-space: nowrap;
  border-radius: 0.2em;
  font-size: 16px;
  color: #FFF;
}
.loginBtn:before {
  content: "";
  box-sizing: border-box;
  position: absolute;
  top: 0;
  left: 0;
  width: 34px;
  height: 100%;
}
.loginBtn:focus {
  outline: none;
}
.loginBtn:active {
  box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
}


/* Facebook */
.loginBtn--facebook {
  background-color: #4C69BA;
  background-image: linear-gradient(#4C69BA, #3B55A0);
  /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
  text-shadow: 0 -1px 0 #354C8C;
}
.loginBtn--facebook:before {
  border-right: #364e92 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
}
.loginBtn--facebook:hover,
.loginBtn--facebook:focus {
  background-color: #5B7BD5;
  background-image: linear-gradient(#5B7BD5, #4864B1);
}


/* Google */
.loginBtn--google {
  /*font-family: "Roboto", Roboto, arial, sans-serif;*/
  background: #DD4B39;
}
.loginBtn--google:before {
  border-right: #BB3F30 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
}
.loginBtn--google:hover,
.loginBtn--google:focus {
  background: #E74B37;
}


.signup-img::after {
background-color: #FFFFFF;
content: "";
display: block;
position: absolute;
top: 0px;
left: 0px;
width: 100%;
height: 99.2%;
z-index: 2;
opacity: 0.6;
}

h1 {
    display: block;
    margin-top: 0em;
    margin-bottom: -1em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
h5 {
    display: block;
    margin-top: 1.2em;
    margin-bottom: 0em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
</style>

    <div class="main">

        <div class="container">

            <div class="signup-content">
                <div class="signup-img">
                    <img src="<?php echo base_url();?>assets/as_login/images/form-img.jpg" alt="">
                    <div class="signup-img-content" style="z-index:3">
						<img src="<?php echo base_url();?>assets/images/logoName.png" width="90%" alt="">
                        <p>Daftar sekarang!</p>
                    </div>
                </div>
                <div class="signup-form">

                    <div class="register-form">
					<h1>Mendaftar akun STIL</h1>
					<h5>Sudah punya akun? <a href="#">Login disini!</a></h5>
							<button class="loginBtn loginBtn--google">
								Daftar menggunakan Google
							</button>

							<button class="loginBtn loginBtn--facebook">
								Daftar menggunakan Facebook
							</button>
							<br>&nbsp;


                        <div class="form-row">
							<div class="form-group">
								<div class="form-input">
                                    <label for="name" class="required">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" onKeyUp="validate_ac();" maxlength="50"/>
                                    <div id="validate_name" style="color:red;font-style:oblique"></div>
                                </div>
                                <div class="form-input">
                                    <label for="birthdate" class="required">Tanggal Lahir</label>
																		<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										                    <input  id="dateshowv" size="16" type="text" value="" readonly onChange="validate_ac();">
																				<span id="dateshow"class="input-group-addon" style="background-color:white;border: 1px solid #ebebeb"><span class="glyphicon glyphicon-calendar"></span></span>
										                </div>
                                    <div id="validate_date" style="color:red;font-style:oblique"></div>
																		<input type="hidden" id="dtp_input2" value="" /><br/>

                                </div>
                                <div class="form-select">
                                    <div class="label-flex">
                                        <label for="job">Pendidikan Terakhir</label>
                                    </div>
                                    <div class="select-list" onClick="validate_ac();">
                                        <select name="job" id="meal_preference" >
																						<option value="NULL" selected disabled>- Pilih Satu -</option>
                                            <?php
                                              foreach($lastEdu as $lastEduItem){
                                                echo "<option value='$lastEduItem[id]'>$lastEduItem[nama]</option>";
                                              }
                                            ?>
                                        </select>
                                    </div>
                                    <div id="validate_edu" style="color:red;font-style:oblique"></div>
                                </div>
								                <div class="form-radio">
                                    <div class="label-flex">
                                        <label for="payment">Jenis Kelamin</label>
                                    </div>
                                    <div class="form-radio-group">
                                        <div class="form-radio-item">
                                            <input type="radio" name="gender" id="gmale" value="m" checked>
                                            <label for="gmale">Laki-laki</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="gender" id="gfemale" value="f">
                                            <label for="gfemale">Perempuan</label>
                                            <span class="check"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-radio">
                                    <div class="label-flex">
                                        <label for="payment">Status Pernikahan</label>
                                    </div>
                                    <div class="form-radio-group">
                                        <div class="form-radio-item">
                                            <input type="radio" name="marital" id="bm" value="bm" checked>
                                            <label for="bm">Belum Menikah</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="marital" id="sm" value="sm">
                                            <label for="sm">Sudah Menikah</label>
                                            <span class="check"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                              <div class="form-input">
                                  <label for="phone" class="required">Nomor Telepon</label>
                                  <input type="text" name="phone" id="phone" onKeyUp="validate_ac();" onkeypress="return number_only(event);" maxlength="15"/>
                                  <div id="validate_phone" style="color:red;font-style:oblique"></div>
                              </div>
								                <div class="form-input">
                                    <label for="email" class="required">Email</label>
                                    <input type="text" name="email" id="email" onKeyUp="validate_ac();" placeholder="yourname@domain.com" maxlength="50"/>
                                    <div id="validate_email" style="color:red;font-style:oblique"></div>
                                </div>
								<div class="form-input">
                                    <label for="password" class="required">Password <small><i>(Minimal terdiri dari 8 karakter)</i></small></label>
                                    <input type="password" name="password" id="password" onKeyUp="validate_ac();"/>
                                    <div id="validate_password" style="color:red;font-style:oblique"></div>
                                </div>
								<div class="form-input">
                                    <label for="rpassword" class="required">Konfirmasi Password</label>
                                    <input type="password" name="rpassword" id="rpassword" onKeyUp="validate_ac();"/>
                                    <div id="validate_rpassword" style="color:red;font-style:oblique"></div>
                                </div>
								<br>
								<div class="form-input">
                                    <label for="phone" class="required">PIN <small><i>(Terdiri dari 6 angka)</i></small></label>
                                    <input type="text" name="pin" id="pin"onKeyUp="validate_ac();" onkeypress="return number_only(event);" maxlength="6"/>
                                    <div id="validate_pin" style="color:red;font-style:oblique"></div>
                                </div>




                            </div>
                        </div>

                        <div class="form-submit">
						<center>
						 Dengan melakukan klik pada tombol "<b>Daftar</b>", saya telah setuju<br>dengan <a href="#">Aturan Penggunaan</a> dan <a href="#">Kebijakan Privasi</a> STIL.

						<br>
                            <input type="submit" value="Daftar" class="submit" id="submit" style="margin-right:0px;" onClick="register();" />
							</center>




                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url();?>assets/as_login/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/as_login/vendor/nouislider/nouislider.min.js"></script>
    <script src="<?php echo base_url();?>assets/as_login/vendor/wnumb/wNumb.js"></script>
    <script src="<?php echo base_url();?>assets/as_login/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/as_login/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?php echo base_url();?>assets/as_login/js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    
		<script type="text/javascript">
      var is_register_click=0;
      var validate_name_status=0;
      var validate_date_status=0;
      var validate_phone_status=0;
      var validate_email_status=0;
      var validate_password_status=0;
      var validate_rpassword_status=0;
      var validate_pin_status=0;
      var validate_edu_status=0;
      $('#validate_pin').hide();
      $('#validate_name').hide();
      $('#validate_password').hide();
      $('#validate_rpassword').hide();
      $('#validate_email').hide();
      $('#validate_phone').hide();
      $('#validate_date').hide();
      $('#validate_edu').hide();

			$('.form_date').datetimepicker({
		    weekStart: 1,
		    todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0
		    });

		</script>
		<script>
        function validate_name(name){
          if(name!=''){
            validate_name_status=1;
            $('#validate_name').hide();
            $('#name').css("border-color","#ebebeb");
          }else{
            validate_name_status=0;
            $('#validate_name').text('Nama lengkap harus diisi!');
            $('#validate_name').show();
            $('#name').css("border-color","red");
          }
        }

        function validate_date(date){
          if(date!=''){
            validate_date_status=1;
            $('#validate_date').hide();
            $('#dateshowv').css("border-color","#ebebeb");
          }else{
            validate_date_status=0;
            $('#validate_date').text('Tanggal lahir harus diisi!');
            $('#validate_date').show();
            $('#dateshowv').css("border-color","red");
          }
        }

        function validate_edu(edu){
          if(typeof edu!='undefined'){
            validate_edu_status=1;
            $('#validate_edu').hide();
            $('#meal_preference').css("border-color","#ebebeb");
          }else{
            validate_edu_status=0;
            $('#validate_edu').text('Pendidikan terakhir harus diisi!');
            $('#validate_edu').show();
            $('#meal_preference').css("border-color","red");
          }
        }

        function validate_phone(phone){
          if(phone!=''){
            if(phone.length>10){
                $.ajax({
        	            url: "<?php echo base_url();?>x_validate/phone",
        	            type: "post",
        	            data: {
        	                phone:phone
        	            } ,
        	            success: function (response) {
            	               if(response=='OK'){
                               validate_phone_status=1;
                               $('#validate_phone').hide();
                               $('#phone').css("border-color","#ebebeb");
                             }else{
                               validate_phone_status=0;
                               $('#validate_phone').text('Nomor telepon yang Anda masukan sudah terdaftar!');
                               $('#validate_phone').show();
                               $('#phone').css("border-color","red");
                             }
        	            },
        	            error: function(jqXHR, textStatus, errorThrown) {
        	               console.log(textStatus, errorThrown);
        	            }


        	        })
            }else{
              validate_phone_status=0;
              $('#validate_phone').text('Mohon masukan nomor telepon yang valid!');
              $('#validate_phone').show();
              $('#phone').css("border-color","red");
            }
          }else{
            validate_phone_status=0;
            $('#validate_phone').text('Nomor telepon harus diisi!');
            $('#validate_phone').show();
            $('#phone').css("border-color","red");
          }
        }

        function validate_email(email){
          if(email!=''){
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            if(pattern.test(email)){
                $.ajax({
        	            url: "<?php echo base_url();?>x_validate/email",
        	            type: "post",
        	            data: {
        	                email:email
        	            } ,
        	            success: function (response) {
            	               if(response=='OK'){
                               validate_email_status=1;
                               $('#validate_email').hide();
                               $('#email').css("border-color","#ebebeb");
                             }else{
                               validate_email_status=0;
                               $('#validate_email').text('Alamat email yang Anda masukan sudah terdaftar!');
                               $('#validate_email').show();
                               $('#email').css("border-color","red");
                             }
        	            },
        	            error: function(jqXHR, textStatus, errorThrown) {
        	               console.log(textStatus, errorThrown);
        	            }


        	        })
            }else{
              validate_email_status=0;
              $('#validate_email').text('Mohon masukan alamat email yang valid!');
              $('#validate_email').show();
              $('#email').css("border-color","red");
            }
          }else{
            validate_email_status=0;
            $('#validate_email').text('Alamat email harus diisi!');
            $('#validate_email').show();
            $('#email').css("border-color","red");
          }
        }



        function validate_password(password){
          if(password!=''){
            if(password.length>=8){
              validate_password_status=1;
              $('#validate_password').hide();
              $('#password').css("border-color","#ebebeb");
            }else{
              validate_password_status=0;
              $('#validate_password').text('Password harus terdiri dari minimal 8 karakter!');
              $('#validate_password').show();
              $('#password').css("border-color","red");
            }
          }else{
            validate_password_status=0;
            $('#validate_password').text('Password harus diisi!');
            $('#validate_password').show();
            $('#password').css("border-color","red");
          }
        }

        function validate_rpassword(password,rpassword){
          if(rpassword!=''){
            if(password==rpassword){
              validate_rpassword_status=1;
              $('#validate_rpassword').hide();
              $('#rpassword').css("border-color","#ebebeb");
            }else{
              validate_rpassword_status=0;
              $('#validate_rpassword').text('Kombinasi password tidak cocok!');
              $('#validate_rpassword').show();
              $('#rpassword').css("border-color","red");
            }
          }else{
            validate_rpassword_status=0;
            $('#validate_rpassword').text('Konfirmasi password harus diisi!');
            $('#validate_rpassword').show();
            $('#rpassword').css("border-color","red");
          }
        }

        function validate_pin(pin){
          if(pin!=''){
            if(pin.length==6){
              validate_pin_status=1;
              $('#validate_pin').hide();
              $('#pin').css("border-color","#ebebeb");
            }else{
              validate_pin_status=0;
              $('#validate_pin').text('PIN harus terdiri dari 6 karakter!');
              $('#validate_pin').show();
              $('#pin').css("border-color","red");
            }
          }else{
            validate_pin_status=0;
            $('#validate_pin').text('PIN harus diisi!');
            $('#validate_pin').show();
            $('#pin').css("border-color","red");
          }
        }

        function validate_ac(){
          var name=$('#name').val();
					var date=$('#dtp_input2').val();
					var gender=$("input[name='gender']:checked").val();
					var phone=$('#phone').val();
					var pin=$('#pin').val();
					var email=$('#email').val();
					var password=$('#password').val();
					var rpassword=$('#rpassword').val();
          var edu=$('#meal_preference').find('.selected').attr('value');

          if(is_register_click==1){
            validate_name(name);
            validate_date(date);
            validate_phone(phone);
            validate_email(email);
            validate_password(password);
            validate_rpassword(password,rpassword);
            validate_pin(pin);
            validate_edu(edu);
          }
        }

				function register(){
          is_register_click=1;
					var name=$('#name').val();
					var date=$('#dtp_input2').val();
					var gender=$("input[name='gender']:checked").val();
          var marital=$("input[name='marital']:checked").val();
					var phone=$('#phone').val();
					var pin=$('#pin').val();
					var email=$('#email').val();
					var password=$('#password').val();
					var rpassword=$('#rpassword').val();
          var edu=$('#meal_preference').find('.selected').attr('value');

          validate_name(name);
          validate_date(date);
          validate_phone(phone);
          validate_email(email);
          validate_password(password);
          validate_rpassword(password,rpassword);
          validate_pin(pin);
          validate_edu(edu);


					if(validate_edu_status==1 && validate_name_status==1 && validate_date_status==1 && validate_phone_status==1 && validate_email_status==1 && validate_password_status && validate_rpassword_status==1 && validate_pin_status==1){
            $.ajax({
    	            url: "<?php echo base_url();?>register/register_submit",
    	            type: "post",
    	            data: {
    	                name:name,
    	                date:date,
    	                gender:gender,
    	                phone:phone,
                      email:email,
                      marital:marital,
                      edu:edu,
                      password:password,
                      pin:pin
    	            } ,
    	            success: function (response) {
    	               // you will get response from your php page (what you echo or print)
    	               switch(response){
                       case 'SUCCESS':
                             Swal.fire({
                              type: 'success',
                              title: 'Registrasi Berhasil',
                              text: 'Akun anda berhasil dibuat!'
                            });
                            break;
                        case  'FAILED DUPLICATE EMAIL':
                              Swal.fire({
                               type: 'error',
                               title: 'Registrasi Gagal',
                               text: 'Email yang digunakan sudah terdaftar!'
                             });
                             break;
                        case  'FAILED DUPLICATE PHONE':
                               Swal.fire({
                                type: 'error',
                                title: 'Registrasi Gagal',
                                text: 'Nomor telepon yang digunakan sudah terdaftar!'
                              });
                              break;
                        case 'FAILED INSERT':
                              Swal.fire({
                               type: 'error',
                               title: 'Registrasi Gagal',
                               text: 'Mohon periksa koneksi internet Anda!'
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


    	        })

					}else{
            return false;
          }



				}
		</script>
</body>
</html>
