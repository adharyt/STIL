<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
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


  var $state = $(
    '<span><img height="20px" src="<?php echo base_url();?>assets/images/courier-logo/'+state.logo+'" class="img-flag" /> ' + state.text +' ('+state.time+') - Rp '+ribuan_format(state.cost)+'</span>'
  );
  return $state;
};

    $(document).ready(function() {
      updateSummary();
      // Initialize "states" example
      $('.js-source-states').each(function () {
          var id=$('#'+this.id).attr('sh_id');
          //alert(this.id);
           $('#'+this.id).select2({
               minimumInputLength: 0,
               allowClear: false,
               placeholder: 'Pilih kurir pengiriman',
               templateResult: formatState,
               templateSelection: formatState,
               ajax: {
                  dataType: 'json',
                  url: '<?php echo base_url();?>API/getCourier/'+id,
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
            var totalprice=0;
            $.each($(".pprice"+store_id), function(){
                totalprice+=parseInt($(this).text().replace('Rp','').split('.').join(''));
            });
            var subtotal=parseInt(totalprice)+parseInt($('#ship_store_'+store_id).select2('data')[0].cost);
            $('#subtotalval'+store_id).text('Rp '+ribuan_format(subtotal));
            $('#ship_store_'+store_id+'_ongkir').text('Sudah termasuk ongkos kirim');
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
        var data=[];
        $.each($(".seller"), function(){
            //var store=[];
            var product=[];

            var id_store=$(this).attr('id');
            var id_address=$('#receiveraddress').val();
            var id_cour='';
              if(typeof($('#ship_store_'+id_store).select2('data')[0])!='undefined'){
                id_cour=$('#ship_store_'+id_store).select2('data')[0].id;
              }



            $.each($(".items"+id_store), function(){
                var c_id=$(this).attr('c_id');
                var p_id=$(this).attr('p_id');
                product.push({"id_cart_temp":c_id,"id_product":p_id});

            });

            data.push({"id_store":id_store,"id_courier_service":id_cour,"products":product});
            //data.push(store);
        });
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
                console.log(response);

              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }

          });
      }



    </script>
