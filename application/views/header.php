<?php
if($this->session->userdata('is_login')=='y'){
	$id_member=$this->session->userdata('user_id');

	$cekcart=$this->db->query("SELECT SUM(quantity) as jml FROM cart where id_user='$id_member'");
	if($cekcart->num_rows()>0){
		$jumlahcart=$cekcart->result_array()[0]['jml'];
	}else{
		$jumlahcart=0;
	}

	$cekwishlist=$this->db->query("SELECT * FROM wishlist where id_user='$id_member'");
	if($cekcart->num_rows()>0){
		$jumlahwishlist=$cekwishlist->num_rows();
	}else{
		$jumlahwishlist=0;
	}
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  function number_only(evt){
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
          return true;
  }
  function alphabet_only(evt){
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode >=  48 && charCode <= 57)
            return false;
          return true;
  }

	function ribuan_format(bilangan){
		var	number_string = bilangan.toString(),
			sisa 	= number_string.length % 3,
			rupiah 	= number_string.substr(0, sisa),
			ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		return rupiah;
	}

</script>
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
                                    '<div class="button "><a href="javascript:auth();">Login</a></div>'+
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
               if(response!='PASSWORD MATCH'){
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


</script>

</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">


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
													<li><a class="clc" href="<?php echo base_url();?>assets/#">Semua Kategori</a></li>
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
									<div class="wishlist_count"><span id="wishlistCount"><?php if($this->session->userdata('is_login')!='y'){echo "0";}else{echo $jumlahwishlist;} ?></span> item</div>
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
										<div class="cart_price"><?php if($this->session->userdata('is_login')!='y'){echo "0";}else{echo $jumlahcart;} ?> item</div>
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

							<div class="navbar ml-auto">
								<?php if($this->session->userdata('is_login')=='y'){ ?>
							  <a href="#" data-toggle="tooltip" data-placement="bottom" title="Saldo STIL"><i class="fa fa-fw fa-wallet"></i></a>
								<a href="#" data-toggle="tooltip" data-placement="bottom" title="Pesan"><i class="fa fa-fw fa-comment-dots"></i></a>
								<a href="#" data-toggle="tooltip" data-placement="bottom" title="Transaksi"><i class="fa fa-fw fa-exchange-alt"></i></a>
							  <a href="#" data-toggle="tooltip" data-placement="bottom" title="Notifikasi"><i class="fa fa-fw fa-bell"></i></a>
							  <a href="<?php echo base_url();?>my-store" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Toko Saya"><i class="fa fa-fw fa-store-alt"></i></a>
								&nbsp;&nbsp;&nbsp;

								<div class="dropdown">
    <button class="dropbtn" style="width:100%"><img id="imgProfileHeader" src="<?php echo $this->userModel->getPhoto($this->session->userdata('username'),$this->session->userdata('photo'),$this->session->userdata('gender')); ?>" class="img-profile-header-navbar">
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
			<p style="font-size:14px;padding:5px;line-height:1.1;margin-bottom:0px;border-bottom:1px solid silver;">
				<span title="Dwi Rizki Manggala Putra">Dwi Rizki Manggala P..</span><br>
				<small>drizkimp@gmail.com</small>
			</p>
      <a href="<?php echo base_url();?>my-account">Ringkasan Akun</a>
      <a href="#">Pengaturan</a>
      <a href="<?php echo base_url();?>logout">Logout</a>
    </div>
  </div>
								<?php }else{ ?>
									<button onClick="login();" class="btn btn-primary btn-sm" style="cursor:pointer;width:85px;background-color:#009245;border-color:#009245">Login</button>&nbsp;
									<a href="<?php echo base_url();?>register" target="_blank" style="padding:0px;height:auto;cursor:pointer;"><button class="btn btn-primary btn-sm" style="cursor:pointer;width:85px;background-color:#FFFFFF;border:2px solid #009245;color:#009245">Daftar</button></a>
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
