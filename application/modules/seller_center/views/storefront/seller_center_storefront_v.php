<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
	<div class="title-text">Etalase Barang</div>
    <div class="card p-4 mt-3">
        <div class="name-text m-0 mb-2">Atur Posisi dan Urutan Etalase</div>
        <div class="default-text m-0">Klik, tahan, dan seret etalase yang ingin kamu pindahkan posisinya.</div>

        <ul class="list-group mt-2" id="storefront_category_list">
            <li class="list-group-item">
                <div class="store-row-sb-container">
                    <div>Cras justo odio 1</div>
                    <div class="store-row-container">
                        <a data-toggle="modal" data-target="#editCategoryModal" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="cursor:pointer;">
                            <i class="fas fa-edit mt-1 text-white"></i>
                        </a>
                        <a data-toggle="modal" data-target="#deleteCategoryModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                        </a>
                    <div>
                </div>   
            </li>
            <li class="list-group-item">
                <div class="store-row-sb-container">
                    <div>Cras justo odio 2</div>
                    <div class="store-row-container">
                        <a data-toggle="modal" data-target="#editCategoryModal" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="cursor:pointer;">
                            <i class="fas fa-edit mt-1 text-white"></i>
                        </a>
                        <a data-toggle="modal" data-target="#deleteCategoryModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                        </a>
                    <div>
                </div>   
            </li>
            <li class="list-group-item">
                <div class="store-row-sb-container">
                    <div>Cras justo odio 3</div>
                    <div class="store-row-container">
                        <a data-toggle="modal" data-target="#editCategoryModal" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="cursor:pointer;">
                            <i class="fas fa-edit mt-1 text-white"></i>
                        </a>
                        <a data-toggle="modal" data-target="#deleteCategoryModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                        </a>
                    <div>
                </div>   
            </li>
            <li class="list-group-item">
                <div class="store-row-sb-container">
                    <div>Cras justo odio 4</div>
                    <div class="store-row-container">
                        <a data-toggle="modal" data-target="#editCategoryModal" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="cursor:pointer;">
                            <i class="fas fa-edit mt-1 text-white"></i>
                        </a>
                        <a data-toggle="modal" data-target="#deleteCategoryModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                        </a>
                    <div>
                </div>   
            </li>
            <li class="list-group-item">
                <div class="store-row-sb-container">
                    <div>Cras justo odio 5</div>
                    <div class="store-row-container">
                        <a data-toggle="modal" data-target="#editCategoryModal" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="cursor:pointer;">
                            <i class="fas fa-edit mt-1 text-white"></i>
                        </a>
                        <a data-toggle="modal" data-target="#deleteCategoryModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                        </a>
                    <div>
                </div>   
            </li>
            <li class="list-group-item">
                <div class="store-row-sb-container">
                    <div>Cras justo odio</div>
                    <div class="store-row-container">
                        <a data-toggle="modal" data-target="#editCategoryModal" class="pl-2 pr-1 pt-1 pb-1 rounded btn-edit" style="cursor:pointer;">
                            <i class="fas fa-edit mt-1 text-white"></i>
                        </a>
                        <a data-toggle="modal" data-target="#deleteCategoryModal" class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded ml-1" style="cursor:pointer;">
                            <i class="fas fa-trash-alt mt-1 text-white"></i>
                        </a>
                    <div>
                </div>   
            </li>
        </ul>
        <div class="store-row-sb-container mt-2">
            <div class="default-text m-0"> Kamu masih dapat menambah 1 etalase lagi</div>
            <div class="mt-2 d-flex justify-content-end">
                <a class="btn btn-success default-text m-0" id="btnAdd" data-toggle="modal" data-target="#addCategoryModal" style="color:white;cursor:pointer;">Tambah Etalase</a>
            </div>
        </div>

    </div>
    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header new-address-header">
                    <h5 class="modal-title new-address-title" id="editAddressLabel">Tambah Etalse Baru</h5>
                    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                    <span aria-hidden="true" class="fas fa-times-circle"></span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center p-2 new-address-body">
                    <div class="row">
                        <fieldset class="form-group col-md-12">
                            <label for="addressName-label">Etalase</label>
                            <input value="" type="text" class="form-control text-dark i-address-name" id="edit-name">
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">                
                    <button type="button" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Tambah Etalase</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header new-address-header">
                    <h5 class="modal-title new-address-title" id="editAddressLabel">Edit Etalse</h5>
                    <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                    <span aria-hidden="true" class="fas fa-times-circle"></span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center p-2 new-address-body">
                    <div class="row">
                        <fieldset class="form-group col-md-12">
                            <label for="addressName-label">Etalase</label>
                            <input value="" type="text" class="form-control text-dark i-address-name" id="edit-name">
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">                
                    <button type="button" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Tambah Etalase</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="position:absolute;left:50%;top:45%;transform: translate(-50%, -50%);">
            <div class="modal-content">
            <div class="modal-header new-address-header">
                <h5 class="modal-title new-address-title" id="deleteCategoryLabel">Hapus Etalase</h5>
            </div>
            <div class="modal-body d-flex justify-content-center p-2 delete-address-body" id="kontenDeleteModal">
                <div class="body-text mt-1"> Apakah kamu yakin ingin mengapus Etalase ini:</div>

            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">Tidak</button>
                <button type="button" class="btn btn-primary" style="background-color:#009245;border-color:#009245;cursor:pointer;">Ya</button>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
