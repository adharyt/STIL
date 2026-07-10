<style media="screen">
.input-group-append {
	margin-left: -2px;
	display: flex;
	display: -ms-flexbox;
}
.input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle), .input-group>.input-group-append:last-child>.input-group-text:not(:last-child), .input-group>.input-group-append:not(:last-child)>.btn, .input-group>.input-group-append:not(:last-child)>.input-group-text, .input-group>.input-group-prepend>.btn, .input-group>.input-group-prepend>.input-group-text {
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
}
.input-group-text {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: center;
		align-items: center;
		padding: .375rem .75rem;
		margin-bottom: 0;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
		color: #495057;
		text-align: center;
		white-space: nowrap;
		background-color: #e9ecef;
		border: 1px solid #ced4da;
		border-radius: 0rem;
}
</style>
<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text"><i class="fa fa-cogs m-0 mb-3"></i> Pengaturan Toko</div>
	<div class="card">
		<div class="card-header" style="background-color:white;border-bottom:0px solid white;padding-left:0px;padding-right:0px">
				<?php $this->load->view('template/header/seller_center_setting_tab');?>
		</div>
		<div class="card-body">
			<div class="row p-3">
				<div class="col-1" >
					<img style="height:70px;margin-top:-20px;" src="<?php echo base_url();?>assets/images/courier-logo/courier-category/antar-ke-ekspedisi.png">
				</div>
				<div class="col-11" >
					<h4 style="margin-bottom:0px">Antar ke Kantor Ekspedisi</h4>
					<p>Antar barang ke kantor ekspedisi terdekat dan minta resi dari petugas.</p>
				</div>
			</div>
			<div class="p-3 pb-5 row" id="jasaPengiriman">
					<?php foreach($couriers_abke as $courier){ ?>
					<div class="col-4">
							<img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:50px;width:auto;margin-bottom:10px">
							<?php
								foreach($courier['courier_services'] as $courier_service){
							 ?>
							 <div class="containers">
		          	   <label><input class="courier" type="checkbox" value="<?php echo $courier_service['id']; ?>" <?php if($courier_service['is_checked']==1){echo "checked";} ?>> <?php echo $courier_service['service_name']; ?>
		                   <span class="checkmark"></span>
		               </label>
            				 <?php
										 switch($courier_service['jenis_pengiriman']){
											 case 'same_day':
											 		$info_cour="SAME DAY";
													break;
											 case 'next_day':
											 		$info_cour="NEXT DAY";
													break;
											 default:
											 		$info_cour="REGULAR";
													break;
										 }
										 ?>
										<span class="badge badge-xs badge-info " style="font-size:65%;padding-left:.4em;padding-right:.4em;">
											<?php echo $info_cour;?>
									 </span>
		          	</div>
							<?php } ?>
					</div>
					<?php } ?>
			</div>
			<hr style="background-color:#e5e7e9">
			<div class="row p-3">
				<div class="col-1" >
					<img style="height:70px;margin-top:-20px;" src="<?php echo base_url();?>assets/images/courier-logo/courier-category/dijemput-kurir.png">
				</div>
				<div class="col-11" >
					<h4 style="margin-bottom:0px">Dijemput Kurir Ekspedisi</h4>
					<p>Kurir akan menjemput pesanan di alamatmu untuk diantar ke pembeli.</p>
				</div>
			</div>
			<div class="p-3 pb-5 row" id="jasaPengiriman">
					<?php foreach($couriers_bade as $courier){ ?>
					<div class="col-4">
							<img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:50px;width:auto;margin-bottom:10px">
							<?php
								foreach($courier['courier_services'] as $courier_service){
							 ?>
							 <div class="containers">
		          	   <label><input class="courier" type="checkbox" value="<?php echo $courier_service['id']; ?>" <?php if($courier_service['is_checked']==1){echo "checked";} ?>> <?php echo $courier_service['service_name']; ?>
		                   <span class="checkmark"></span>
		               </label>
									 <?php
									 switch($courier_service['jenis_pengiriman']){
										 case 'same_day':
												$info_cour="SAME DAY";
												break;
										 case 'next_day':
												$info_cour="NEXT DAY";
												break;
										 default:
												$info_cour="REGULAR";
												break;
									 }
									 ?>
									<span class="badge badge-xs badge-info " style="font-size:65%;padding-left:.4em;padding-right:.4em;">
										<?php echo $info_cour;?>
								 </span>

		          	</div>
							<?php } ?>
					</div>
					<?php } ?>
			</div>
			<hr style="background-color:#e5e7e9">
			<div class="row p-3">
				<div class="col-1" >
					<img style="height:70px;margin-top:-20px;" src="<?php echo base_url();?>assets/images/courier-logo/courier-category/ambil-sendiri.png">
				</div>
				<div class="col-11" >
					<h4 style="margin-bottom:0px">Ambil Barang Sendiri</h4>
					<p>Pembeli dapat mengambil pesanannya sendiri ke lokasimu</p>
				</div>
			</div>
			<div class="p-3 pb-5 row" id="jasaPengiriman">
					<?php foreach($couriers_stil as $courier){ ?>
					<div class="col-4">
							<img  src="<?php echo base_url();?>assets/images/courier-logo/<?php echo $courier['logo'];?>" alt="<?php echo $courier['name'];?>" title="<?php echo $courier['name'];?>" class="img-courier-logo" style="height:50px;width:auto;margin-bottom:10px">
							<?php
								foreach($courier['courier_services'] as $courier_service){
							 ?>
							 <div class="containers">
		          	   <label><input class="courier" type="checkbox" value="<?php echo $courier_service['id']; ?>" <?php if($courier_service['is_checked']==1){echo "checked";} ?>> <?php echo $courier_service['service_name']; ?>
		                   <span class="checkmark"></span>
		               </label>
									 <span class="badge badge-xs badge-info " style="font-size:65%;padding-left:.4em;padding-right:.4em;">
 										REGULAR
 								 </span>
		          	</div>
							<?php } ?>
					</div>
					<?php } ?>
			</div>
		</div>
	</div>

</div>
</div>
