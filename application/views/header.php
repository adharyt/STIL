<!DOCTYPE html>
<html lang="en">
<head>
<title>STIL - Home</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.css">
<link href="<?php echo base_url();?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/responsive.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
function login(){
Swal.fire({
  html:
                    '<br><img src="<?php echo base_url();?>assets/images/logoName.png" width="40%"><br>&nbsp;'+
                    '<div class="contact-form-area">'+
                                '<div class="row">'+
                                '<div class="col-md-2  col-xs-0"></div>'+
                                '<div class="col-md-8  col-xs-12">'+
                                    '<div class="form-group">'+
                                        '<input type="text" class="form-control" id="username" placeholder="Email or Username">'+
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
                                    '<div class="button banner_button"><a href="http://localhost/stil/assets/#">Login</a></div>'+
                                '</div>'+

                                '<div class="row">'+
                                  '<div class="col-md-1  col-xs-0"></div>'+
                                  '<div class="col-md-10 col-xs-12">'+
                                      '<br><p>Register | Forgot Password</p>'+
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
    $.ajax({
            url: "<?php echo base_url();?>auth/login",
            type: "post",
            data: {
                username:username,
                password:password
            } ,
            success: function (response) {
               // you will get response from your php page (what you echo or print)
               //alert(response);
               if(response=='FAILED'){
                 Swal.fire({
                   type: 'error',
                   title: 'Authentication Failed',
                   html:   "Wrong Username/Password!<br>&nbsp;"+
                                     '<div class="contact-form-area">'+
                                                 '<div class="row">'+
                                                 '<div class="col-12">'+
                                                     '<div class="button banner_button"><a href="http://localhost/stil/assets/#">Belanja Sekarang</a></div>'+
                                                 '</div>'+
                                                 '</div>'+
                                     '</div>',
                   showCloseButton: true,
                   showCancelButton: false,
                   showConfirmButton:false,
                   allowEnterKey:false
                 });
               }else{
                 //console.log(response);
               //alert(response);
               location.reload();
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
                                        '<div id="btnok1" class="button banner_button" onClick="login();">Ok</div><br>&nbsp;'+
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


</script>

</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo base_url();?>assets/images/phone.png" alt=""></div>+62 87884 044440</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo base_url();?>assets/images/mail.png" alt=""></div><a href="<?php echo base_url();?>assets/mailto:fastsales@gmail.com">contact@stil.com</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="<?php echo base_url();?>assets/#">Indonesia<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="<?php echo base_url();?>assets/#">English</a></li>
										</ul>
									</li>
									<li>
										<a href="<?php echo base_url();?>assets/#">IDR<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="<?php echo base_url();?>assets/#">USD</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="top_bar_user">
								<div class="user_icon"><img src="<?php echo base_url();?>assets/images/user.svg" alt=""></div>
								<div><a href="javascript:login();">Masuk</a></div>
                <div><a href="<?php echo base_url();?>register">Daftar</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="<?php echo base_url();?>assets/#">STIL</a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Cari produk...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">Semua Kategori</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="<?php echo base_url();?>assets/#">Semua Kategori</a></li>
													<li><a class="clc" href="<?php echo base_url();?>assets/#">Kehutanan</a></li>
													<li><a class="clc" href="<?php echo base_url();?>assets/#">Pertanian</a></li>
													<li><a class="clc" href="<?php echo base_url();?>assets/#">Peternakan</a></li>
													<li><a class="clc" href="<?php echo base_url();?>assets/#">Hasil Olahan</a></li>
													<li><a class="clc" href="<?php echo base_url();?>assets/#">Merchandise</a></li>
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
								<div class="wishlist_icon"><img src="<?php echo base_url();?>assets/images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="<?php echo base_url();?>assets/#">Wishlist</a></div>
									<div class="wishlist_count">5</div>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="<?php echo base_url();?>assets/images/cart.png" alt="">
										<div class="cart_count"><span>10</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="<?php echo base_url();?>assets/#">Cart</a></div>
										<div class="cart_price">IDR 825.000,00</div>
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
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Kehutanan<i class="fas fa-chevron-right"></i></a>
										<ul>
											<li class="hassubs">
												<a href="<?php echo base_url();?>assets/#">Kayu<i class="fas fa-chevron-right"></i></a>
												<ul>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
												</ul>
											</li>
											<li><a href="<?php echo base_url();?>assets/#">Gum Rosin<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Terpentin<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Kopal<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Madu<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Minyak Kayu Putih<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Sutra<i class="fas fa-chevron-right"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Pertanian<i class="fas fa-chevron-right"></i></a>
										<ul>
											<li class="hassubs">
												<a href="<?php echo base_url();?>assets/#">Kopi<i class="fas fa-chevron-right"></i></a>
											</li>
											<li><a href="<?php echo base_url();?>assets/#">Jagung<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Beras<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Lada<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Cengkeh<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Pala<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Kunyit<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Jahe<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Lengkuas<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Nanas<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Singkong<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Kacang Kedelai<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Kacang Tanah<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Kacang Panjang<i class="fas fa-chevron-right"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Peternakan<i class="fas fa-chevron-right"></i></a>
										<ul>
											<li class="hassubs">
												<a href="<?php echo base_url();?>assets/#">Sapi<i class="fas fa-chevron-right"></i></a>
											</li>
											<li><a href="<?php echo base_url();?>assets/#">Kambing<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Ayam<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Lele<i class="fas fa-chevron-right"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Hasil Olahan<i class="fas fa-chevron-right"></i></a>
										<ul>
											<li class="hassubs">
												<a href="<?php echo base_url();?>assets/#">Kopi<i class="fas fa-chevron-right"></i></a>
											</li>
											<li><a href="<?php echo base_url();?>assets/#">Kerajinan Kulit<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Kopi Kemasan<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Corn Flakes<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Marning<i class="fas fa-chevron-right"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Merchandise<i class="fas fa-chevron-right"></i></a>
										<ul>
											<li><a href="<?php echo base_url();?>assets/#">Kaos<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Tas<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Gantungan Kunci<i class="fas fa-chevron-right"></i></a></li>
										</ul>
									</li>
									<li><a href="<?php echo base_url();?>assets/#">Lain-lain<i class="fas fa-chevron-right"></i></a></li>
								</ul>
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="<?php echo base_url();?>assets/#">Home<i class="fas fa-chevron-down"></i></a></li>
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Super Deals<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
												</ul>
											</li>
											<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Featured Brands<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
												</ul>
											</li>
											<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="<?php echo base_url();?>assets/#">Pages<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="<?php echo base_url();?>assets/shop.html">Shop<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/product.html">Product<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/blog.html">Blog<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/blog_single.html">Blog Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/regular.html">Regular Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/cart.html">Cart<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="<?php echo base_url();?>assets/contact.html">Contact<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li><a href="<?php echo base_url();?>assets/blog.html">Blog<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="<?php echo base_url();?>assets/contact.html">Contact<i class="fas fa-chevron-down"></i></a></li>
								</ul>
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
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							<ul class="page_menu_nav">
								<li class="page_menu_item has-children">
									<a href="<?php echo base_url();?>assets/#">Language<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="<?php echo base_url();?>assets/#">English<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Italian<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Spanish<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Japanese<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="<?php echo base_url();?>assets/#">Currency<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="<?php echo base_url();?>assets/#">US Dollar<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item">
									<a href="<?php echo base_url();?>assets/#">Home<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item has-children">
									<a href="<?php echo base_url();?>assets/#">Super Deals<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="<?php echo base_url();?>assets/#">Super Deals<i class="fa fa-angle-down"></i></a></li>
										<li class="page_menu_item has-children">
											<a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a>
											<ul class="page_menu_selection">
												<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											</ul>
										</li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="<?php echo base_url();?>assets/#">Featured Brands<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="<?php echo base_url();?>assets/#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="<?php echo base_url();?>assets/#">Trending Styles<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="<?php echo base_url();?>assets/#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="<?php echo base_url();?>assets/#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item"><a href="<?php echo base_url();?>assets/blog.html">blog<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="<?php echo base_url();?>assets/contact.html">contact<i class="fa fa-angle-down"></i></a></li>
							</ul>

							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo base_url();?>assets/images/phone_white.png" alt=""></div>+38 068 005 3570</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo base_url();?>assets/images/mail_white.png" alt=""></div><a href="<?php echo base_url();?>assets/mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>
