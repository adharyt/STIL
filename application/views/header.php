<style media="screen">
.img-profile {
	border-radius: 50%;
	border: 2px solid #fff;
	-webkit-box-shadow: 0 5px 10px 0 rgba(43, 43, 43, .2);
	box-shadow: 0 5px 10px 0 rgba(43, 43, 43, .2);
	width: 60px;
	height: 60px;
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
  color: black;
  text-decoration: none;
  font-size: 17px;
	height:100%;
}

/* Navbar links on mouse-over */
.navbar a:hover {
  background-color: #000;
}

/* Current/active navbar link */
.active {
  background-color: #4CAF50;
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
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Cari produk..." style="width:90%">

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
									<div class="wishlist_count">0 item</div>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="<?php echo base_url();?>assets/images/cart.png" alt="">
										<div class="cart_count"><span>0</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text">
											<?php if($this->session->userdata('is_login')!='y'){ ?>
												<a href="javascript:login();">Cart</a>
											<?php }else{ ?>
												<a href="javascript:login();"><?php echo $this->session->userdata('email');?></a>
											<?php } ?>
										</div>
										<div class="cart_price">0 item</div>
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
      										<a href="<?php echo base_url();?>assets/#"><?php echo $mainItem['name'];?><i class="fas fa-chevron-right"></i></a>

                          <?php if($mainItem['is_parent']==1){ ?>
                            <ul>
                            <?php
                              $subMenu=$this->db->query("SELECT id,name,is_parent FROM productcategory_sub where id_parent=$mainItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
                              foreach($subMenu as $subItem){ ?>
        											<li <?php if($subItem['is_parent']==1){echo "class='hassubs'";}?>>
        												<a href="<?php echo base_url();?>assets/#"><?php echo $subItem['name']; ?><i class="fas fa-chevron-right"></i></a>
                                <?php if($subItem['is_parent']==1){ ?>
          												<ul>
                                    <?php
                                    $subprMenu=$this->db->query("SELECT id,name FROM productcategory_subofsubs where id_parent=$subItem[id] AND is_deleted=0 ORDER BY order_pos ASC")->result_array();
                                    foreach($subprMenu as $subprItem){ ?>
          													<li><a href="<?php echo base_url();?>assets/#"><?php echo $subprItem['name']; ?><i class="fas fa-chevron-right"></i></a></li>
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
							  <a style="border-left:1px solid silver;border-right:1px solid silver;"  href="#"><i class="fa fa-fw fa-wallet"></i></a>
								<a href="#"><i class="fa fa-fw fa-comment-dots"></i></a>
								<a href="#" class="active"><i class="fa fa-fw fa-exchange-alt"></i></a>
							  <a href="#"><i class="fa fa-fw fa-bell"></i></a>
							  <a href="#" style="border-left:1px solid silver;border-right:0px solid silver;"><i class="fa fa-fw fa-store-alt"></i></a>
							  <a href="#" style="border-left:1px solid silver;border-right:1px solid silver;"><i class="fa fa-fw fa-user"></i></a>
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
