
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/js/cart_custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

<!-- kurir -->
<script type="text/javascript">
$('#receiveraddress').on('change', function (evt) {
  var val=this.value;
  Swal.fire({
    text:'Mohon menunggu...',
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
        url: "<?php echo base_url();?>checkout/selectAddress",
        type: "post",
        data: {
            id:val
        },
        success: function (response) {
          var rdata=jQuery.parseJSON(response);
              $('#addr_receiver').text(rdata.receiver);
              $('#addr_phone').text(rdata.phone);
              $('#addr_postal').text(rdata.postalcode);
              $('#addr_address').text(rdata.address);
          setTimeout(
          function()
          {
            $('#receiveraddress').css('width','100%');
            swal.close();
          }, 500);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
});

function formatState (state) {
  if (!state.id) {
    return state.text;
  }


  if(state.id!=0){
    var $state = $(
      '<span><img height="20px" src="<?php echo base_url();?>assets/images/courier-logo/'+state.logo+'" class="img-flag" /> ' + state.text +' ('+state.time+') - Rp '+ribuan_format(state.cost)+'</span>'
    );
  }else{
    var $state = $(
      '<span>'+ state.text+ '</span>'
    );
  }
  return $state;
};

function formatStateProduct (state) {
  if (!state.id) {
    return state.text;
  }


  if(state.id!=0){
    var $state = $(
      '<span><img height="20px" src="<?php echo base_url();?>assets/images/courier-logo/'+state.logo+'" class="img-flag" /> ' + state.text +' ('+state.time+') - Rp '+ribuan_format(state.cost)+' (estimasi)</span>'
    );
  }else{
    var $state = $(
      '<span>'+ state.text+ '</span>'
    );
  }
  return $state;
};

    $(document).ready(function() {
      updateSummary();
      // Initialize "states" example
      $('.select_cour_by_store').each(function () {
          var id=$('#'+this.id).attr('sh_id');
          var id_user='<?php echo $this->session->userdata('user_id'); ?>';
          //alert(this.id);
           $('#'+this.id).select2({
               minimumInputLength: 0,
               allowClear: false,
               cache:false,
               placeholder: 'Pilih kurir pengiriman',
               templateResult: formatState,
               templateSelection: formatState,
               ajax: {
                  dataType: 'json',
                  url: '<?php echo base_url();?>API/getCourier/'+id_user+'/'+id,
                  delay: 800,
                  data: function(params) {
                    if(params.term==null){
                      params.term='';
                    }
                    return {
                      search: params.term
                    }
                  },
                  processResults: function (data, page) {
                  return {
                    results: data
                  };
                },
              }

          }).on('change', function (evt) {
            var store_id=$('#'+this.id).attr('st_id');
            var id_cour=$('#ship_store_'+store_id).select2('data')[0].id;
            if(id_cour!=0){
              var totalprice=0;
              $.each($(".pprice"+store_id), function(){
                  totalprice+=parseInt($(this).text().replace('Rp','').split('.').join(''));
              });
              var subtotal=parseInt(totalprice)+parseInt($('#ship_store_'+store_id).select2('data')[0].cost);
              $('#subtotalval'+store_id).text('Rp '+ribuan_format(subtotal));
              $('#ship_store_'+store_id+'_ongkir').text('Sudah termasuk ongkos kirim');
              updateSummary();
              $('.cour_by_product'+store_id).hide();
            }else{
              var totalprice=0;
              $.each($(".pprice"+store_id), function(){
                  totalprice+=parseInt($(this).text().replace('Rp','').split('.').join(''));
              });
              $('#subtotalval'+store_id).text('Rp '+ribuan_format(totalprice));
              $('#ship_store_'+store_id+'_ongkir').text('Belum termasuk ongkos kirim');
              $('.cour_by_product'+store_id).show();
              updateSummary();
            }

          });

          if($('#is_specialdelivery_'+id).val()=='y'){
            var newOption = new Option('Pilih kurir yang berbeda untuk setiap produk', '0', true, true);
            $('#ship_'+id).append(newOption).trigger('change');

          }


      });


      $('.select_cour_by_product').each(function () {
          var id=$('#'+this.id).attr('sh_id');
          var id_user='<?php echo $this->session->userdata('user_id'); ?>';
          //alert(this.id);
           $('#'+this.id).select2({
               minimumInputLength: 0,
               allowClear: false,
               placeholder: 'Pilih kurir pengiriman',
               templateResult: formatStateProduct,
               templateSelection: formatStateProduct,
               ajax: {
                  dataType: 'json',
                  url: '<?php echo base_url();?>API/getCourier/'+id_user+'/'+id,
                  delay: 800,
                  data: function(params) {
                    if(params.term==null){
                      params.term='';
                    }
                    return {
                      search: params.term
                    }
                  },
                  processResults: function (data, page) {
                  return {
                    results: data
                  };
                },
                cache:true
              }

          }).on('change', function (evt) {
            var product_id=$('#'+this.id).attr('pr_id');
            var store_id=$('#'+this.id).attr('st_id');
            //var id_cour=$('#ship_product_'+product_id).select2('data')[0].id;

            var totalprice=0;
            $.each($(".pprice"+store_id), function(){
                totalprice+=parseInt($(this).text().replace('Rp','').split('.').join(''));
            });

            $.each($(".cour_store"+store_id), function(){
                if(typeof($(this).select2('data')[0])=='undefined'){
                  var cour_price=0;
                }else{
                  var cour_price=parseInt($(this).select2('data')[0].cost);
                }
                totalprice+=cour_price;
            });

            $('#subtotalval'+store_id).text('Rp '+ribuan_format(totalprice));
            $('#ship_store_'+store_id+'_ongkir').text('');
            updateSummary();
          });



      });


    });


</script>
<!-- kurir end -->
<script type="text/javascript">
      function updateSummary(){
        updateTotalHargaBarang();
        updateTotalPembayaran();

        var totalbayar=parseInt($('#totalbayar').html().replace('Rp','').split('.').join(''));
        var totalhargabarang=parseInt($('#totalhargabarang').html().replace('Rp','').split('.').join(''));
        $('#totalongkir').html('Rp '+ribuan_format(totalbayar-totalhargabarang));
      }

      function updateTotalPembayaran(){
        var totalbayar=0;
            $.each($(".subtotalval"), function(){
                totalbayar+=parseInt($(this).text().replace('Rp','').split('.').join(''));
            });
            $('#totalbayar').html('Rp '+ribuan_format(totalbayar));
      }

      function updateTotalHargaBarang(){
            var totalharga=0;
            $.each($(".priceperunit"), function(){
                totalharga+=parseInt($(this).text().replace('Rp','').split('.').join(''));
            });
            $('#totalhargabarang').html('Rp '+ribuan_format(totalharga));
      }

      $("input[name='item']").on('change', function(e) {

          var prodInStore=0;
          var prodInStoreChecked=0;
          var storeid=$(this).attr('st_id');
          $.each($("input[name='item'][st_id="+storeid+"]"), function(){
              prodInStore++;
          });
          $.each($("input[name='item'][st_id="+storeid+"]"), function(){
              prodInStoreChecked++;
          });
          if(prodInStore==prodInStoreChecked){
            $("input[name='store'][value="+storeid+"]").prop('checked',true);
          }else{
            $("input[name='store'][value="+storeid+"]").prop('checked',false);
          }
          updateSummary();
      });

      $("input[name='store']").on('change', function(e) {
          if($(this).prop('checked')==true){
            var status=true;
          }else{
            var status=false;
          }
          var storeid=$(this).val();
          $.each($("input[name='item'][st_id="+storeid+"]"), function(){
              $(this).prop('checked',status);
          });
          updateSummary();

      });

      function updateStock(store_id,product_id,value){
        Swal.fire({
          text:'Mohon menunggu...',
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
              url: "<?php echo base_url();?>checkout/mQuantity",
              type: "post",
              data: {
                  id:product_id,
                  value:value
              },
              success: function (response) {
                swal.close();
                if(response!="FALSE"){
                  //alert(response);
                  var rdata=jQuery.parseJSON(response);
                        $('#cart_temp'+product_id).fadeOut(200, function(){
                              $('#quan'+product_id).val(rdata.quantity);
                              $('#price'+product_id).text(rdata.price);
                              $('#cart_temp'+product_id).fadeIn().delay(100);
                        });
                        $('#subtotal'+store_id).fadeOut(200, function(){
                          var sum = 0;
                          $('.pprice'+store_id).each(function(){
                              sum += parseInt($(this).html().replace('Rp','').split('.').join(''));
                          });
                              $('#price'+product_id).html(rdata.price);
                              $('#subtotalval'+store_id).html('Rp '+ribuan_format(sum));
                              $('#subtotal'+store_id).fadeIn().delay(100);
                        });
                  if(rdata.msg==2){
                    Swal.fire({
                      type: 'warning',
                      html:   "Sisa stock produk saat ini hanya <b>"+rdata.quantity+"</b> unit!",
                      showCloseButton: false,
                      showCancelButton: false,
                      showConfirmButton:true,
                      allowEnterKey:true,
                      confirmButtonColor:'#009245'
                    });
                  }else if(rdata.msg==3){
                    Swal.fire({
                      type: 'warning',
                      html:   "Minimum pembelian produk adalah <b>"+rdata.quantity+"</b> unit!",
                      showCloseButton: false,
                      showCancelButton: false,
                      showConfirmButton:true,
                      allowEnterKey:true,
                      confirmButtonColor:'#009245'
                    });
                  }
                  setTimeout(
                  function()
                  {
                    updateSummary();
                  }, 1000);

                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }

          });
      }


      $('.quan').on('change',function(e) {
    		e.preventDefault();
    		var $input = $(this);
    		var value = parseInt($input.val());
        var product_id=$input.attr('pr_id');
        var store_id=$input.attr('st_id');


        $input.val(value);

        updateStock(store_id,product_id,value);

    	});

      $('.minus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());
        var product_id=$input.attr('pr_id');
        var store_id=$input.attr('st_id');

    		value=value-1
        $input.val(value);
        updateStock(store_id,product_id,value);
    	});

    	$('.plus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());
        var product_id=$input.attr('pr_id');
        var store_id=$input.attr('st_id');

    		value=value+1
        $input.val(value);
        updateStock(store_id,product_id,value);
    	});

      $('.like-btn').on('click', function() {
        $(this).toggleClass('is-active');
      });

      function checkout(){
        if(<?php echo $this->userModel->checkIsHaveAddress($this->session->userdata('user_id'));?>>0){
          var data=[];
          var cour_not_selected=0;
          $.each($(".seller"), function(){
              //var store=[];
              var product=[];

              var id_store=$(this).attr('id');
              var notes=$('#notes'+id_store).val();
              var id_address=$('#receiveraddress').val();
              var id_cour='';
                  if(typeof($('#ship_store_'+id_store).select2('data')[0])!='undefined'){
                    id_cour=$('#ship_store_'+id_store).select2('data')[0].id;
                  }



                if(id_cour!=''){
                  $.each($(".items"+id_store), function(){
                      var c_id=$(this).attr('c_id');
                      var p_id=$(this).attr('p_id');

                      if(id_cour!=0){
                        product.push({"id_cart_temp":c_id,"id_product":p_id,"id_courier_service":id_cour});
                      }else{
                        var cour_id='';
                        if(typeof($('#ship_product_'+p_id).select2('data')[0])!='undefined'){
                          cour_id=$('#ship_product_'+p_id).select2('data')[0].id;
                        }
                        if(cour_id!=''){
                          product.push({"id_cart_temp":c_id,"id_product":p_id,"id_courier_service":cour_id});
                        }else{
                          cour_not_selected++;
                        }
                      }


                  });

                  data.push({"id_store":id_store,"products":product,"notes":notes});
                }else{
                  cour_not_selected++;
                }


              //data.push(store);
          });
          if(cour_not_selected==0){
            if($(".seller").length>0){
              Swal.fire({
                text:'Membuat invoice...',
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
                    url: "<?php echo base_url();?>checkout/checkout_process",
                    type: "post",
                    data: {
                        id_address:$('#receiveraddress').val(),
                        data:JSON.stringify(data)
                    },
                    success: function (response) {
                      swal.close();
                      window.location.href='<?php echo base_url();?>checkout-payment/'+response;

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                    }

                });
              }else{
                location.href='<?php echo base_url();?>';
              }
          }else{
            Swal.fire({
              type:'warning',
              text:'Pilih kurir pengiriman!',
              background:'#FFFFFF',
              width:'300px',
              height:'100px',
              confirmButtonColor:'#009245'
            });
          }
        }else{
          Swal.fire({
            type:'warning',
            text:'Anda harus menentukan alamat tujuan pengiriman terlebih dahulu!',
            background:'#FFFFFF',
            width:'400px',
            confirmButtonColor:'#009245'
          }).then((result) => {
            if (result.value) {
              $('#newAddressModal').modal('show');
            }
          });
        }

      }



    </script>
    <script type="text/javascript">
    $(function(){
       $('#add-kecamatan').select2({
           minimumInputLength: 3,
           allowClear: true,
           placeholder: 'Ketik nama Kota/Kabupaten',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url();?>API/getLocation/ID/ALLCITYANDBELOW',
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data, page) {
              return {
                results: data
              };
            },
          }
      }).on('change', function (evt) {
         var data = $("#add-kecamatan option:selected").val();
      });
    });

    function insertNewAddress() {
      var name=$('#add-name').val();
      var penerima=$('#add-penerima').val();
      var telepon=$('#add-telepon').val();
      var kecamatan=$('#add-kecamatan').val();
      var kodepos=$('#add-kodepos').val();
      var alamat=$('#add-alamat').val();

      Swal.fire({
        text:'Menyimpan alamat baru...',
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
            url: "<?php echo base_url();?>profile_address/addressAdd",
            type: "post",
            data: {
              name:name,
              penerima:penerima,
              telepon:telepon,
              kecamatan:kecamatan,
              kodepos:kodepos,
              alamat:alamat
            },
            success: function (response) {
              swal.close();
              if(response=="OK"){
                  Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Alamat berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((result) => {
                    location.reload();
                  });

              }else if(response=="DUPLICATE"){
                Swal.fire({
                  type: 'warning',
                  html:   "Nama alamat sudah terdaftar!",
                  showCloseButton: false,
                  showCancelButton: false,
                  showConfirmButton:true,
                  allowEnterKey:true,
                  confirmButtonColor:'#009245'
                });
              }else{
                Swal.fire({
                  type: 'warning',
                  html:   "Ada kesalahan dalam pengisian form!",
                  showCloseButton: false,
                  showCancelButton: false,
                  showConfirmButton:true,
                  allowEnterKey:true,
                  confirmButtonColor:'#009245'
                });
              }

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }

        });


    }
    </script>
