<style>
	.img-profile{
		width: 10%;
		height: 10%;
		border-radius: 50%;
		border-color: #009245;
	}
	.circle {
		border-radius: 25px;
	}
	.icon-sack {
		width: 20px;
		height: 20px;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/styles/shop_responsive.css">
<body>
		<div class="col-sm-9" style="margin-top:30px;">
			<div class="row d-flex" style="padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-user-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle">
					<h3>Wishlist</h3>
				</div>
			</div>


			<div class="row mt-3 pl-3 pr-3">
				<?php
					$this->load->view('template/product_gridView');
				?>
			</div>
		</div>
	</div>
</body>
