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
			<div class="row d-flex" style="margin-left:10px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-exchange-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle">
					<h3>Daftar Transaksi</h3>
				</div>
			</div>
			<div class="tramsactioon-filter-container">
			<div class="row ml-1 mr-1">
				<div class="col-lg-4 col-md-6">
					<div class="form-group" style="margin-left: 12px; margin-bottom:10px;">
						<div class="form-control dropdown-select-style" data-toggle="dropdown" style="cursor:pointer;">
							<span class="fa fa-receipt icon-invoice-style"></span>&nbsp;Tampilkan berdasarkan invoice
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
						<ul class="col dropdown-menu dropdown-container">
							<a href="<?php echo base_url();?>my-account/transaction"><li style="color:#099245" class="dropdown-text-style" data-value="option1" tabIndex="-1"><span class="fa fa-receipt icon-invoice-style"></span>&nbsp;Tampilkan berdasarkan invoice</li></a>
							<a href="<?php echo base_url();?>my-account/transaction-split"><li class="dropdown-text-style" data-value="option1" tabIndex="-1"><span class="fa fa-truck-loading icon-transaction-style" ></span>&nbsp;Tampilkan berdasarkan transaksi</li></a>
						</ul>
					</div>
				</div>
				<?php
				 	$filter_pick=0;
					if($filter['transPaid']==1){$filter_pick++;}
					if($filter['transUnpaid']==1){$filter_pick++;}
					if($filter['transExpired']==1){$filter_pick++;}
				?>
				<div class="col checkbox checkbox-success col-lg-4 col-md-6">
					<div class="form-group" style="margin-left: 12px; margin-bottom:10px;">
						<div class="form-control dropdown-select-style" data-toggle="dropdown" style="cursor:pointer;">
							<span class="fa fa-file-invoice icon-invoice-style"></span>
									&nbsp;Status pembayaran (<?php if($filter_pick==3){echo "semua";}else{ echo $filter_pick; } ?> dipilih)
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
						<ul class="col dropdown-menu dropdown-container">
							<li class="dropdown-text-style" data-value="option1" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_unpaid" value="true" <?php if($filter['transUnpaid']==1){echo "checked";} ?> style="cursor:pointer;"/>&nbsp;Tagihan belum dibayarkan</li>
							<li class="dropdown-text-style" data-value="option2" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_paid" value="true" <?php if($filter['transPaid']==1){echo "checked";} ?> style="cursor:pointer;"/>&nbsp;Tagihan sudah dibayarkan</li>
							<li class="dropdown-text-style" data-value="option3" tabIndex="-1"><input onChange="filter_transaction();" type="checkbox" id="filter_expired" value="true" <?php if($filter['transExpired']==1){echo "checked";} ?> style="cursor:pointer;"/>&nbsp;Tagihan kadaluarsa</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 ml-md-auto">
					<div class="form-group" style="margin-left: 12px; margin-bottom:10px;">
						<div class="form-control dropdown-select-style" data-toggle="dropdown" style="cursor:pointer;">
							<span class="fa fa-money-check icon-invoice-style"></span>&nbsp;Metode pembayaran (<?php if(count($filter['payment_method'])==0 || count($filter['payment_method'])==3){echo "semua";}else{ echo count($filter['payment_method']); } ?> dipilih)
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
						<ul class="col dropdown-menu dropdown-container">
							<li class="dropdown-text-style" data-value="option1" tabIndex="-1"><input onChange="filter_transaction();" name="filter_payment_method" type="checkbox" value="bank_transfer" <?php if(count($filter['payment_method'])==0 || in_array('bank_transfer',$filter['payment_method'])){echo "checked";} ?> style="cursor:pointer;"/>&nbsp;Bank Transfer</li>
							<li class="dropdown-text-style" data-value="option1" tabIndex="-1"><input onChange="filter_transaction();" name="filter_payment_method" type="checkbox" value="virtual_account" <?php if(count($filter['payment_method'])==0 || in_array('virtual_account',$filter['payment_method'])){echo "checked";} ?> style="cursor:pointer;"/>&nbsp;Virtual Account</li>
							<li class="dropdown-text-style" data-value="option1" tabIndex="-1"><input onChange="filter_transaction();" name="filter_payment_method" type="checkbox" value="NULL" <?php if(count($filter['payment_method'])==0 || in_array('NULL',$filter['payment_method'])){echo "checked";} ?> style="cursor:pointer;"/>&nbsp;Belum dipilih</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group" style="margin-left: 12px; margin-bottom:10px;">
						<div class="form-control dropdown-select-style" style="cursor:pointer;" onClick="$('#transactiondate').focus();">
							<span class="fa fa-calendar icon-invoice-style"></span><input readonly id="transactiondate" style="padding-left:5px;border:0px;width:80%;cursor:pointer"/>
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
						<input name="in" id="trans_date_start" value="<?php echo $filter['from'];?>" type="hidden" readonly=""/>
						<input name="in" id="trans_date_end" value="<?php echo $filter['to'];?>" type="hidden" readonly=""/>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group" style="margin-left: 12px; margin-bottom:10px;">
						<div class="form-control dropdown-select-style" data-toggle="dropdown" style="cursor:pointer;">
							<input type="hidden" id="sort_trans" value="<?php echo $filter['sort'];?>" />
							<span class="fa fa-sort-amount-down icon-invoice-style"></span>&nbsp;<?php if($filter['sort']=="TIME_DESC"){echo "Transaksi terbaru";}else{echo "Transaksi terlawas";}?>
							<span class="fa fa-caret-down icon-transaction-style" style="float:right"></span>
						</div>
						<ul class="col dropdown-menu dropdown-container">
							<a href="<?php echo base_url();?>my-account/transaction<?php echo $filter_add_bar;?>&sort=TIME_DESC"><li <?php if($filter['sort']=="TIME_DESC"){echo "style='color:#099245'";}?> class="dropdown-text-style" data-value="option1" tabIndex="-1">Transaksi terbaru</li></a>
							<a href="<?php echo base_url();?>my-account/transaction<?php echo $filter_add_bar;?>&sort=TIME_ASC"><li <?php if($filter['sort']=="TIME_ASC"){echo "style='color:#099245'";}?>class="dropdown-text-style" data-value="option1" tabIndex="-1">Transaksi terlawas</li></a>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 ml-md-auto">
				<div class="form-group has-search" style="margin-left: 12px; margin-bottom:10px;">
					<span class="fa fa-search form-control-search"></span>
					<input type="text" class="form-control search-text-style" placeholder="Cari nomor tagihan..." id="reference" value="<?php echo $filter['reference'];?>">
				</div>
			</div>
		</div>
		</div>



			<div class="row mt-3 ml-2">
				<?php if(count($transactions)>0){ ?>
					<div class="col-md-12 postList">
						<div style="color:#9c9c9c;margin-bottom:5px">
							<i><?php echo "Ditemukan <u>$totalTransaction transaksi</u> dari $totalRowCount invoice yang sesuai dengan filter saat ini";?></i>
						</div>
						<?php
							$data['nowData']=0;
							foreach($transactions as $trans){
							$data['nowData']++;
							$data['lastPostID']=$trans['id'];
							$data['trans']=$trans;
							$this->load->view('profileTransactionTemplate_v',$data);
							 } ?>
					</div>
				<?php }else{ ?>
					<div class="card p-4 ml-2 mr-4 mb-5" style="width: 100%">
						<div class="card-body">
							<center>
								<img src="<?php echo base_url();?>assets/images/icon-img/transactions-not-available.png" width="200px">
								<h5>Transaksi tidak ditemukan.</h5>
							</center>
						</div>
					</div>
				<?php	} ?>
				<br>&nbsp;
			</div>
		</div>
	</div>
	<!-- Detail Weight Modal -->
	<div class="modal fade" id="detailWeightModal" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" style="margin-top:100px">
			<div class="modal-dialog" role="document">
					<div class="modal-content" id="detailWeightModalContent">

					</div>
			</div>
	</div>
	<div class="modal fade" id="detailPriceModal" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" style="margin-top:100px">
			<div class="modal-dialog" role="document">
					<div class="modal-content" id="detailPriceModalContent">

					</div>
			</div>
	</div>

	<!-- Accept Transaction Modal -->
	<div class="modal fade" id="acceptTransactionModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
					<div class="modal-content" id="acceptTransactionModalContent">

					</div>
			</div>
	</div>
</body>
