<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text"><i class="fa fa-list m-0"></i> Etalase Barang</div>
    <div class="card p-4 mt-3">
        <div class="name-text m-0 mb-2">Atur Posisi dan Urutan Etalase</div>
        <div class="default-text m-0">Klik, tahan, dan seret etalase yang ingin kamu pindahkan posisinya.</div>

        <ul class="list-group mt-2" id="storefront_category_list">
						<?php
						$countSF=count($storefronts);

						if($countSF>0){
						foreach($storefronts as $storefront){ ?>
            <li class="list-group-item">
                <div class="store-row-sb-container">
                    <div class="storefront" storefront_id="<?php echo $storefront['value']; ?>"><?php echo $storefront['text']; ?></div>
                    <div class="store-row-container">
                        <a class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="cursor:pointer;" onClick="editStoreFront('<?php echo $storefront['value'];?>');">
                            <i class="fas fa-edit mt-1 text-white"></i>
                        </a>
                        <a class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;" onClick="deleteStoreFront('<?php echo $storefront['value'];?>');">
                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                        </a>
                    <div>
                </div>
            </li>
						<?php }
					}else{ ?>
						<div class="row text-center">
							<div class="col-lg-12">
							<!-- Single Product -->
								<div class="single_product">
									<div class="container text-center">
										<div class="card" style="padding:50px">
											<center><img src="<?php echo base_url();?>assets/images/icon-img/storefront-not-available.png" width="200px"></center><br>
											<h4>Anda belum memiliki Etalase</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php	}?>
        </ul>
        <div class="store-row-sb-container mt-2">
            <div class="default-text m-0"> <?php if($countSF<6){?>Kamu masih dapat menambah <?php echo 6-$countSF; ?> etalase lagi<?php }else{echo "Kamu sudah tidak dapat menambah etalase lagi (maksimal 6).";}?></div>
            <div class="mt-2 d-flex justify-content-end">
                <button class="btn btn-success default-text m-0" id="btnAdd" data-toggle="modal" data-target="#addCategoryModal" style="color:white;cursor:pointer;" <?php if($countSF>=6){echo "disabled";}?>>Tambah Etalase</button>
            </div>
        </div>

    </div>
    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header new-address-header">
                    <h5 class="modal-title new-address-title" id="editAddressLabel">Tambah Etalase Baru</h5>
                    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                    <span aria-hidden="true" class="fas fa-times-circle"></span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center p-2 new-address-body">
                    <div class="row">
                        <fieldset class="form-group col-md-12">
                            <label for="addressName-label">Nama Etalase</label>
                            <input value="" type="text" class="form-control text-dark i-address-name" id="new-storefront">
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="newStorefront();" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Tambah Etalase</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editStorefrontModal" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="editStorefrontModalContent">

            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteStorefrontModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
            <div class="modal-content" id="deleteStorefrontModalContent">

            </div>
        </div>
    </div>
</div>
</div>
