<?php
if($this->session->userdata('is_login')=='y'){
	$id_member=$this->session->userdata('user_id');
	$jumlahcart=$this->userModel->getCartCount($id_member);
	$jumlahwishlist=$this->userModel->getWishlistCount($id_member);


	$unread_message=$this->chatModel->getChatCountUnread($id_member);
	$unread_trans=$this->notificationModel->get_PopUpTransaction($id_member,'y');
	$unread_notif=$this->notificationModel->countNotificationUser($id_member);

}

 ?>
<style media="screen">
.img-profile {
	border-radius: 50%;
	border: 2px solid #fff;
	-webkit-box-shadow: 0 5px 10px 0 rgba(43, 43, 43, .2);
	box-shadow: 0 5px 10px 0 rgba(43, 43, 43, .2);
	width: 60px;
	height: 60px;
}
.img-profile-quickview {
	border-radius: 50%;
	border: 2px solid #fff;
	-webkit-box-shadow: 0 5px 10px 0 rgba(43, 43, 43, .2);
	box-shadow: 0 5px 10px 0 rgba(43, 43, 43, .2);
	width: 60px;
	height: 60px;
}
.img-profile-header-navbar {
	border-radius: 50%;
	border: 1px solid #fff;
	width: 35px;
	height: 35px;
}
.pr-star-rating {
  display: flex;
  align-items: center;
  font-size: 15px;
}
.pr-back-stars {
  display: flex;
  color: #ddd;
  position: relative;
  text-shadow: 4px 4px 10px #843a3a;
}
.pr-front-stars {
  display: flex;
  color: #fbd600;
  overflow: hidden;
  position: absolute;
  text-shadow: 2px 2px 5px #d29b09;
  top: 0;
}
.navbar {

  background-color: #FFF;
}

/* Navbar links */
.navbar a {
  float: right;
  text-align: center;
  padding: 12px;
  color: #009245;
  text-decoration: none;
  font-size: 17px;
	height:100%;
}

/* Navbar links on mouse-over */
.navbar a:hover {
  background-color: #009245;
	color:#FFF;
}

/* Current/active navbar link */
.activenav {
  background-color: #4CAF50;
}

/* Dropdown button */
.dropdown .dropbtn {
  border: none;
  outline: none;
  color: #009245;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
	font-size:12px;
  float: none;
  color: #009245;
  padding: 3px 5px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #f28f16;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}



/* Add responsiveness - will automatically display the navbar vertically instead of horizontally on screens less than 500 pixels */
@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/notification/notification_popup_styles.css">
<style media="screen">
.arrow_box:after, .arrow_box:before {
	left:57.5%;
}
.arrow_box_trans {
    position: relative;
    background: white;
    border: 2px solid lightslategrey;
    border-radius: 6px;
    padding: 12px 10px 12px 10px;
}
.arrow_box_trans:after, .arrow_box_trans:before {
    bottom: 100%;
    border: solid transparent;
    content: " ";
    left:54%;
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
}
.arrow_box_trans:before{
  border-color: rgba(194, 225, 245, 0);
  border-bottom-color: lightslategrey;
  border-width: 18px;
  margin-left: -18px;
}
.arrow_box_trans:after {
    border-color: rgba(136, 183, 213, 0);
    border-bottom-color: white;
    border-width: 15px;
    margin-left: -15px;
}
</style>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script>
  function showNotification(){
    $('#popupTransaction').hide();
    $('[data-toggle="tooltip"]').tooltip('hide');
    var popup = document.getElementById("popupNotification");
    if (popup.style.display === "none") {
        popup.style.display = "block";
        $.ajax({
                url: "<?php echo base_url();?>user_notification/getNotification",
                type: "post",
                data: {
                    valid:'valid'
                } ,
                success: function (response) {
                  if(response=='EXPIRED_SESSION'){
                    Swal.fire({
                      type: 'error',
                      title: 'Session Expired',
                      text:   "Mohon maaf Anda harus login kembali untuk melakukan hal ini!",
                      showCloseButton: false,
                      showCancelButton: false,
                      showConfirmButton:true,
                      confirmButtonColor:'#009245',
                      allowEnterKey:true
                    }).then((result) => {
                      if (result.value) {
                        location.href='<?php echo $this->config->item("landing_url_login");?>';
                      }
                    });
                  }else{
    							   $('#popupNotificationContent').html(response);
                     $('#showAllNotification').show();
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }


            })
    } else {
        popup.style.display = "none";
        $('#popupNotificationContent').html('Loading....');
        $('#showAllNotification').hide();
    }

  }

  function showNotificationTrans(){
    $('#popupNotification').hide();
    $('[data-toggle="tooltip"]').tooltip('hide');
    var popup = document.getElementById("popupTransaction");
    if (popup.style.display === "none") {
        popup.style.display = "block";
        $.ajax({
                url: "<?php echo base_url();?>user_notification/getTransNotification",
                type: "post",
                data: {
                    valid:'valid'
                } ,
                success: function (response) {
    							   $('#popupTransactionContent').html(response);
                     $('#showAllTransaction').show();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }


            })
    } else {
        popup.style.display = "none";
        $('#popupTransactionContent').html('Loading....');
        $('#showAllTransaction').hide();
    }

  }
  <?php

  if($this->session->flashdata('swalert')!=''){
  	switch($this->session->flashdata('swalert')){
  		case 'login_success':
        $name=$this->session->userdata('name');
  			echo "
        const Toast = Swal.mixin({
        				toast: true,
        				position: 'center',
        				showConfirmButton: false,
        				timer: 3000,
        				timerProgressBar: true,
        			});

        			Toast.fire({
        				icon: 'success',
        				title: 'Berhasil login, selamat datang $name!'
        			});
            ";
  			break;
        case 'register_newsletter_success':
    			echo "
          const Toast = Swal.mixin({
          				toast: true,
          				position: 'center',
          				showConfirmButton: false,
          				timer: 3000,
          				timerProgressBar: true,
          			});

          			Toast.fire({
          				icon: 'success',
          				title: 'Berhasil berlangganan newsletter!'
          			});
              ";
    			break;
          case 'unregister_newsletter_success':
      			echo "
            const Toast = Swal.mixin({
            				toast: true,
            				position: 'center',
            				showConfirmButton: false,
            				timer: 3000,
            				timerProgressBar: true,
            			});

            			Toast.fire({
            				icon: 'success',
            				title: 'Berhasil berhenti berlangganan newsletter!'
            			});
                ";
      			break;
  	}


  }
  ?>
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<script type="text/javascript">

<?php if($this->session->userdata('is_login')!='y'){ ?>

function login(){
Swal.fire({
  html:
                    '<br><img src="<?php echo base_url();?>assets/images/logoName.png" width="40%"><br>&nbsp;'+
                    '<div class="contact-form-area">'+
                                '<div class="row">'+
                                '<div class="col-md-2  col-xs-0"></div>'+
                                '<div class="col-md-8  col-xs-12">'+
                                    '<div class="form-group">'+
                                        '<input type="text" class="form-control" id="username" placeholder="Email atau Username">'+
                                    '</div>'+
                                '</div>'+
                                '</div>'+
                              '<div class="row">'+
                                '<div class="col-md-2  col-xs-0"></div>'+
								                '<div class="col-md-8 col-xs-12">'+
                                    '<div class="form-group">'+
                                        '<input type="password" class="form-control" id="password" placeholder="Password">'+
                                    '</div>'+
                                '</div>'+
                                '</div>'+
                                '<div class="col-12">'+
                                    '<div class="button "><a href="javascript:auth();">Login</a></div>'+
                                '</div>'+

                                '<div class="row">'+
                                  '<div class="col-md-1  col-xs-0"></div>'+
                                  '<div class="col-md-10 col-xs-12">'+
                                      '<br><p><a href="<?php echo $this->config->item('landing_url');?>/register">Daftar</a> | <a href="<?php echo $this->config->item('landing_url');?>/forgot-password">Lupa Password</a></p>'+
                                  '</div>'+
                                  '</div>'+
                    '</div>',
  showCloseButton: true,
  showCancelButton: false,
  showConfirmButton:false
});
$('#username').focus();
}

function auth(){
  var username=$('#username').val();
  var password=$('#password').val();



  if(username!='' && password!=''){
		Swal.fire({
	    text:'Logging in...',
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
            url: "<?php echo $this->config->item('landing_url');?>/auth/login",
            type: "post",
            data: {
                username:username,
                password:password
            } ,
            success: function (response) {
							Swal.close();
               // you will get response from your php page (what you echo or print)
               switch(response){
								 case 'PASSWORD MATCH':
								 		location.reload();
										break;
								 case 'NOT VALIDATE':
										 Swal.fire({
											 type: 'error',
											 title: 'Authentication Failed',
											 html:   "Akun Belum Divalidasi!"+
																				 '<div class="contact-form-area">'+
																										 '<div class="row">'+
																										 '<div class="col-12">'+
																												 '<div class="button "><a href="javascript:login();">Ok</a></div>'+
																										 '</div>'+
																										 '</div>'+
																				 '</div>',
											 showCloseButton: true,
											 showCancelButton: false,
											 showConfirmButton:false,
											 allowEnterKey:false
										 });
										 break;
									default:
											Swal.fire({
												type: 'error',
												title: 'Authentication Failed',
												html:   "Wrong Username/Password!<br>&nbsp;"+
																					'<div class="contact-form-area">'+
																											'<div class="row">'+
																											'<div class="col-12">'+
																													'<div class="button "><a href="javascript:login();">Ok</a></div>'+
																											'</div>'+
																											'</div>'+
																					'</div>',
												showCloseButton: true,
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
      type: 'error',
      title: 'Authentication Failed',
      html:   "Username/Password can't be empty!<br>&nbsp;"+
                        '<div class="contact-form-area">'+
                                    '<div class="row">'+
                                    '<div class="col-12">'+
                                        '<div class="button "><a href="javascript:login();">Ok</a></div>'+
                                    '</div>'+
                                    '</div>'+
                        '</div>',
      showCloseButton: true,
      showCancelButton: false,
      showConfirmButton:false,
      allowEnterKey:false
    });

  }
}

<?php } ?>

</script>

</head>

<body>

<div class="super_container" style="background-color:#fafafa !important">

	<!-- Header -->

	<header class="header" style="background-color:white !important">


		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logoNameLandscape.png" height="75"></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="<?php echo base_url();?>products" class="header_search_form clearfix">
										<input type="search" name="search_keyword" required="required" class="header_search_input" placeholder="Cari produk..." style="width:90%" value="<?php if(isset($_GET['search_keyword'])){echo $_GET['search_keyword'];} ?>">
										<div class="custom_dropdown" style="display:none">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">Semua Kategori</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="<?php echo base_url();?>">Semua Kategori</a></li>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="<?php echo base_url();?>assets/images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="<?php echo base_url();?>assets/images/icon-img/header-wishlist.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="<?php echo base_url();?>my-account/wishlist">Wishlist</a></div>
									<a href="<?php echo base_url();?>my-account/wishlist"><div class="wishlist_count"><span id="wishlistCount"><?php if($this->session->userdata('is_login')!='y'){echo "0";}else{echo $jumlahwishlist;} ?></span> item</div></a>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="<?php echo base_url();?>assets/images/icon-img/header-cart.png" alt="">
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="<?php echo base_url();?>cart">Cart</a></div>
										<a href="<?php echo base_url();?>cart"><div class="cart_price"><span id="cartcount"><?php if($this->session->userdata('is_login')!='y'){echo "0";}else{echo $jumlahcart;} ?></span> item</div></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">

						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">Kategori</div>
								</div>

								<ul class="cat_menu">
                  <?php
                      $mainMenu=$this->db->query("SELECT id,name,is_parent FROM productcategory_main WHERE is_deleted=0 ORDER BY order_pos ASC")->result_array();
                      foreach($mainMenu as $mainItem){ ?>
                        <li <?php if($mainItem['is_parent']==1){echo "class='hassubs'";}?>>
      										<a href="<?php echo base_url().'c/m-'.$mainItem['id'];?>"><?php echo $mainItem['name'];?><i class="fas fa-chevron-right"></i></a>

                          <?php if($mainItem['is_parent']==1){ ?>
                            <ul>
                            <?php
                              $subMenu=$this->db->query("SELECT id,name,is_parent FROM productcategory_sub where id_parent=$mainItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
                              foreach($subMenu as $subItem){ ?>
        											<li <?php if($subItem['is_parent']==1){echo "class='hassubs'";}?>>
        												<a href="<?php echo base_url().'c/s-'.$subItem['id'];?>"><?php echo $subItem['name']; ?><i class="fas fa-chevron-right"></i></a>
                                <?php if($subItem['is_parent']==1){ ?>
          												<ul>
                                    <?php
                                    $subprMenu=$this->db->query("SELECT id,name FROM productcategory_subofsubs where id_parent=$subItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
                                    foreach($subprMenu as $subprItem){ ?>
          													<li><a href="<?php echo base_url().'c/p-'.$subprItem['id'];?>"><?php echo $subprItem['name']; ?><i class="fas fa-chevron-right"></i></a></li>
                                    <?php } ?>
          												</ul>
                                <?php } ?>
        											</li>
                              <?php } ?>

        										</ul>

                          <?php } ?>

      									</li>

                <?php } ?>
								</ul>
							</div>

							<!-- Main Nav Menu -->

							<div class="navbar ml-auto d-xl-flex d-lg-flex d-none">
								<?php if($this->session->userdata('is_login')=='y'){
								?>

								<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
									<div class="col" style="padding:0px">
										<a href="<?php echo base_url();?>my-account/wallet" data-toggle="tooltip" data-placement="bottom" title="Saldo STIL">
											<i class="fa fa-fw fa-wallet"></i>
										</a>
									</div>
									<div class="col" style="padding:0px">

									</div>
								</div>
								<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
									<div class="col" style="padding:0px">
										<a href="javascript:globalUserType=1;showChatModal();" data-toggle="tooltip" data-placement="bottom" title="Pesan">
											<i class="fa fa-fw fa-comment-dots"></i>
										</a>
									</div>
									<div class="col" style="padding:0px">
										<span  id="chat_badge" class="badge badge-pill badge-danger " style="margin-left: -20px;margin-top: -12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:<?php if($unread_message>0){echo 'inline-block';}else{echo 'none';}?>">
											<?php if($unread_message>99){
												echo "99<sup>+</sup>";
											}else if($unread_message==1){
												echo $unread_message.'&nbsp;';
											}else{
												echo $unread_message;
											}
											?>
										</span>
									</div>
								</div>


								<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
									<div class="col" style="padding:0px">
										<a href="javascript:void(0);" onClick="showNotificationTrans();" data-toggle="tooltip" data-placement="bottom" title="Transaksi">
											<i class="fa fa-fw fa-exchange-alt"></i>

										</a>
									</div>
									<div class="col" style="padding:0px">
										<span class="badge badge-pill badge-danger " style="margin-left: -20px;margin-top: -12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:<?php if($unread_trans>0){echo 'inline-block';}else{echo 'none';}?>">
											<?php if($unread_trans>99){
												echo "99<sup>+</sup>";
											}else if($unread_trans==1){
												echo $unread_trans.'&nbsp;';
											}else{
												echo $unread_trans;
											}
											?>
										</span>
									</div>
								</div>



								</a>

								<!-- Transaction -->
							  <div id="popupTransaction" class="transaction-notif-popup popUpHeader" style="display:none !important;width:425px">
									<div class="arrow_box_trans" id="popupTransactionContent">
						        Loading...
								  </div>
							  </div>
								<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
									<div class="col" style="padding:0px">
										<a href="javascript:void(0);" onClick="showNotification();" data-toggle="tooltip" data-placement="bottom" title="Notifikasi">
											<i class="fa fa-fw fa-bell"></i>

										</a>
									</div>
									<div class="col" style="padding:0px">
										<span id="notification_user_badge" class="badge badge-pill badge-danger " style="margin-left: -20px;margin-top: -12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:<?php if($unread_notif>0){echo 'inline-block';}else{echo 'none';}?>">
											<?php if($unread_notif>99){
												echo "99<sup>+</sup>";
											}else if($unread_notif==1){
												echo $unread_notif.'&nbsp;';
											}else{
												echo $unread_notif;
											}
											?>
										</span>
									</div>
								</div>

								<!-- Notifikasi -->
							  <div id="popupNotification" class="notification-popup popUpHeader" style="display:none !important;width:425px">
									<div class="arrow_box" id="popupNotificationContent">
										Loading...
									</div>
							</div>

							<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
								<div class="col" style="padding:0px">
									<a href="<?php echo base_url();?>my-store" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Toko Saya">
										<i class="fa fa-fw fa-store-alt"></i>
									</a>
								</div>
								<div class="col" style="padding:0px">

								</div>
							</div>

							<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
								<div class="dropdown">
							    <button class="dropbtn" style="width:100%"><img id="imgProfileHeader" src="<?php echo $this->userModel->getPhoto($this->session->userdata('username'),$this->session->userdata('photo'),$this->session->userdata('gender')); ?>" class="img-profile-header-navbar">
							      <i class="fa fa-caret-down"></i>
							    </button>
							    <div class="dropdown-content">
										<p style="font-size:14px;padding:5px;line-height:1.1;margin-bottom:0px;border-bottom:1px solid silver;">
											<span title="<?php echo $this->session->userdata('name');?>"><?php echo substr($this->session->userdata('name'),0,20);?></span><br>
											<small><?php echo $this->session->userdata('email');?></small>
										</p>
							      <a href="<?php echo base_url();?>my-account">Akun Saya</a>
							      <a href="<?php echo $this->config->item("landing_url_logout");?>">Logout</a>
							    </div>
							  </div>
							</div>




								<?php }else{ ?>
									<button onClick="login();" class="btn btn-primary btn-sm" style="cursor:pointer;width:85px;background-color:#009245;border-color:#009245">Login</button>&nbsp;
									<a href="<?php echo $this->config->item('landing_url');?>/register" target="_blank" style="padding:0px;height:auto;cursor:pointer;"><button class="btn btn-primary btn-sm" style="cursor:pointer;width:85px;background-color:#FFFFFF;border:2px solid #009245;color:#009245">Daftar</button></a>
								<?php } ?>
							</div>

							<!-- Menu Trigger -->

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>

		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">

						<div class="page_menu_content">

							<div class="page_menu_search">
								<form action="<?php echo base_url();?>products" class="header_search_form clearfix">
									<input type="search" name="search_keyword" required="required" class="page_menu_search_input" placeholder="Cari produk..." value="<?php if(isset($_GET['search_keyword'])){echo $_GET['search_keyword'];} ?>">
								</form>
							</div>
							<?php if($this->session->userdata('is_login')=='y'){ ?>
							<ul class="page_menu_nav">
								<li class="page_menu_item"><a href="<?php echo base_url();?>my-account">Profil Akun<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="<?php echo base_url();?>my-account/transaction">Daftar Transaksi<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="<?php echo base_url();?>my-account/notification">Daftar Notifikasi<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="javascript:globalUserType=1;showChatModal();">Pesan<i class="fa fa-angle-down"></i></a></li>
							</ul>
							<div class="menu_contact">
								<div class="menu_contact_item">
									<a href="<?php echo base_url();?>/my-store" style="padding:0px;height:auto;cursor:pointer;"><button class="btn btn-primary btn-sm" style="cursor:pointer;width:auto;background-color:#FFFFFF;border:2px solid #009245;color:#009245">Halaman Penjual</button></a>&nbsp;
									<a href="<?php echo $this->config->item('landing_url');?>/logout" style="padding:0px;height:auto;cursor:pointer;"><button class="btn btn-primary btn-sm" style="cursor:pointer;width:85px;background-color:#FFFFFF;border:2px solid #009245;color:#009245">Logout</button></a>
								</div>
							</div>
						<?php }else{ ?>
							<div class="menu_contact">
								<div class="menu_contact_item">
									<button onClick="login();" class="btn btn-primary btn-sm" style="cursor:pointer;width:85px;background-color:#FFFFFF;border:2px solid #009245;color:#009245">Login</button>&nbsp;
									<a href="<?php echo $this->config->item('landing_url');?>/register" target="_blank" style="padding:0px;height:auto;cursor:pointer;"><button class="btn btn-primary btn-sm" style="cursor:pointer;width:85px;background-color:#FFFFFF;border:2px solid #009245;color:#009245">Daftar</button></a>
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>
