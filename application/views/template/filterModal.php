<style media="screen">
  .stacko{
    color:#099245;
  }
  .stacko.active{
    font-weight:550;
  }
  /* The containers */
  .containers {
    display: block;
    position: relative;
    padding-left: 20px;
    margin-top: 12px;
    /*cursor: pointer;*/
    /*font-size: 22px;*/
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* Hide the browser's default checkbox */
  .containers input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  /* Create a custom checkbox */
  .checkmark {
    cursor:pointer;
    margin-top: 2px;
    position: absolute;
    top: 0;
    left: 0;
    height: 15px;
    width: 15px;
    background-color: #eee;
  }

  /* On mouse-over, add a grey background color */
  .containers:hover input ~ .checkmark {
    background-color: #ccc;
  }

  /* When the checkbox is checked, add a blue background */
  .containers input:checked ~ .checkmark {
    background-color: #009245;
  }

  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the checkmark when checked */
  .containers input:checked ~ .checkmark:after {
    display: block;
  }

  /* Style the checkmark/indicator */
  .containers .checkmark:after {
    left: 5px;
    top: 2px;
    width: 5px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }

  /*Slider*/
  .slidecontainer {
    width: 110%;
  }

  .slider {
    -webkit-appearance: none;
    width: 50%;
    height: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
    transform:rotate(-90deg);
    border-radius:20px;
    margin-left: -70px;
    margin-top: 90px;
    position: absolute;
  }

  .slider:hover {
    opacity: 1;
  }

  .slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 15px;
    height: 15px;
    background: #009245;
    border-radius: 50%;
    cursor: pointer;
  }
  .input-group-text {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
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
    border-radius: .25rem;
}
</style>
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="overflow: hidden; height: 500px;z-index:1000">
          <input type="hidden" id="search_keyword" value="<?php echo $data_search['keyword'];?>">
        <div class="modal-header new-address-header">
            <h5 class="modal-title new-address-title" id="editAddressLabel">Filter Produk</h5>
            <button type="button" class="close new-address-btn-close" data-dismiss="modal" aria-label="Close" style="cursor:pointer">
            <span aria-hidden="true" class="fas fa-times-circle"></span>
            </button>
        </div>
        <div class="modal-body justify-content-center p-0 pl-3 pr-3">
            <div class="row" style="height:100%">
                <div class="col-4 bg-light p-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="m-0 mt-2">
                            <a href="#rentangHarga" data-toggle="pill" class="stacko active">Rentang Harga</a>
                        </li>
                        <!--
                        <li class="m-0 mt-2">
                            <a href="#kondisiBarang" data-toggle="pill" class="stacko">Kondisi Barang</a>
                        </li>
                        -->
                        <li class="m-0 mt-2">
                            <a href="#rating" data-toggle="pill" class="stacko">Rating Minimum</a>
                        </li>
                        <li class="m-0 mt-2">
                            <a href="#jasaPengiriman" data-toggle="pill" class="stacko">Jasa Pengiriman</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content col-8  p-3">

                      <div class="tab-pane active" id="rentangHarga">
                        <fieldset class="form-group col-12">
                         <label for="min-label" class="text-default">Harga Minimal</label>
                         <div class="input-group">
      											<div class="input-group-prepend">
      												<span class="input-group-text" style="border-right:0px;">Rp</span>
      											</div>
                            <input name="search_price_min" type="text" class="form-control text-default text-dark" id="min-label" value="<?php echo $this->numberingModel->integerSeparation('.',0,$data_search['price_min']); ?>" onkeyup="javascript:custom_number_format(this,'rupiah');"onkeydown="return numbersonly(this, event);" style="margin-left:-3px;">
                          </div>
                       </fieldset>
                       <fieldset class="form-group col-12">
                         <label for="max-label" class="text-default">Harga Maksimal</label>
                         <div class="input-group">
      											<div class="input-group-prepend">
      												<span class="input-group-text" style="border-right:0px;">Rp</span>
      											</div>
                            <input name="search_price_max" type="text" class="form-control text-default text-dark" id="max-label" value="<?php echo $this->numberingModel->integerSeparation('.',0,$data_search['price_max']); ?>" onkeyup="javascript:custom_number_format(this,'rupiah');"onkeydown="return numbersonly(this, event);" style="margin-left:-3px;">
                         </div>
                       </fieldset>
                       <div class="containers">
         							  <label style="margin-bottom:0px;"><input name="search_is_discount" type="checkbox" value="1" <?php if($data_search['is_discount']==1){echo "checked";} ?>>&nbsp;Hanya tampilkan barang diskon
                          <span class="checkmark"></span>
                        </label>
         							</div>
         							<div class="containers">
         							  <label style="margin-bottom:0px;"><input name="search_is_wholesale" type="checkbox" value="1" <?php if($data_search['is_wholesale']==1){echo "checked";} ?>>&nbsp;Hanya tampilkan barang grosir
                          <span class="checkmark"></span>
                        </label>
         							</div>
                      </div>

                      <div class="tab-pane" id="kondisiBarang" style="display:none;">
                        <div class="checkbox">
          							  <label style="margin-bottom:0px;"><input name="search_is_condition_new" type="hidden" value="0"><input name="search_is_condition_new" type="checkbox" value="1" <?php if($data_search['is_condition_new']==1){echo "checked";} ?>>&nbsp;Baru</label>
          							</div>
          							<div class="checkbox">
          							  <label><input name="search_is_condition_second" type="hidden" value="0"><input name="search_is_condition_second" type="checkbox" value="1" <?php if($data_search['is_condition_second']==1){echo "checked";} ?>>&nbsp;Bekas</label>
          							</div>
                      </div>

                      <div class="tab-pane" id="rating">
                        <div class="sidebar_subtitle brands_subtitle">Minimum Rating</div>
            						<div class="slidecontainer">
            							<input type="range" min="0" max="5" name="search_minimum_rating" value="<?php echo $data_search['search_minimum_rating'];?>" class="slider" id="myRange"
            							style="background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, color-stop(<?php echo $data_search['search_minimum_rating']/5;?>, rgb(77, 179, 125)), color-stop(<?php echo $data_search['search_minimum_rating']/5;?>, rgb(211, 211, 219)));"
            							>
            						</div>
            						<div class="container" style="margin-left:15px; margin-top:10px; margin-bottom:10px;">
            						<div class="radio">
            								<label><input style="display:none;" type="radio"  value="5" <?php if($data_search['search_minimum_rating']==5){echo "checked";} ?>>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            								</label>
            						</div>
            						<div class="radio">
            								<label><input style="display:none;" type="radio"  value="4" <?php if($data_search['search_minimum_rating']==4){echo "checked";} ?>>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            								</label>
            						</div>
            						<div class="radio">
            								<label><input style="display:none;" type="radio"  value="3" <?php if($data_search['search_minimum_rating']==3){echo "checked";} ?>>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            								</label>
            						</div>
            						<div class="radio">
            								<label><input style="display:none;" type="radio"  value="2"  <?php if($data_search['search_minimum_rating']==2){echo "checked";} ?>>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            								</label>
            						</div>
            						<div class="radio">
            								<label><input style="display:none;" type="radio"  value="1" <?php if($data_search['search_minimum_rating']==1){echo "checked";} ?>>
            									<span class="fa fa-star" style="color: orange"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            									<span class="fa fa-star" style="color: grey"></span>
            								</label>
            						</div>
            						<div class="radio">
            								<label><input style="display:none;" type="radio"  value="0" <?php if($data_search['search_minimum_rating']==0){echo "checked";} ?> >
            									Semua Rating
            								</label>
            						</div>
            					</div>
                      </div>

                      <div class="tab-pane" id="jasaPengiriman">
                        <div style="overflow: auto; height: 325px">
                          <?php
                          $couriers=$this->courierModel->getCourierServiceList();
                          $selected_courier=explode(',',$data_search['courier']);
            							foreach($couriers as $courier){ ?>
            							<div class="containers" >
            							  <label style="margin-bottom:0px;"><input name="courier" type="checkbox" value="<?php echo $courier['id'];?>" <?php if(in_array('all',$selected_courier) || in_array($courier['id'],$selected_courier)){echo "checked";} ?>>&nbsp;<?php echo $courier['service_name'];?>
                              <span class="checkmark"></span>
                            </label>
            							</div>
            							<?php } ?>
                      </div>
                    </div>


              </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onClick="setFilter();" class="btn btn-primary" style="cursor:pointer;background-color:#099245;border-color:#099245;">Simpan</button>
        </div>

      </div>

    </div>
  </div>
