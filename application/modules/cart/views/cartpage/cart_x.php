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
<script type="text/javascript">
      function updateSummary(){
        var selected = [];
        var store=[];
        var totalbayar=0;
            $.each($("input[name='item']:checked"), function(){
                selected.push($(this).val());
                if($.inArray($(this).attr('st_id'), store)<0) {
                    store.push($(this).attr('st_id'));
                }
                totalbayar+=parseInt($('#price'+$(this).val()).html().replace('Rp','').split('.').join(''));

            });
            $('#totalbayar').html('Rp '+ribuan_format(totalbayar));
            $('#totalbarang').html(selected.length);
            $('#totalstore').html(store.length);


      }

      $("input[name='item']").on('change', function(e) {

          var prodInStore=0;
          var prodInStoreChecked=0;
          var storeid=$(this).attr('st_id');
          $.each($("input[name='item'][st_id="+storeid+"]"), function(){
              prodInStore++;
          });
          $.each($("input[name='item'][st_id="+storeid+"]:checked"), function(){
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
          title: 'Please wait...',
          html: "<p align=center>Don't close this page!</p>",
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
              url: "<?php echo base_url();?>cart/mQuantity",
              type: "post",
              data: {
                  id:product_id,
                  value:value
              },
              success: function (response) {
                swal.close();
                if(response!="FALSE"){
                  var rdata=jQuery.parseJSON(response);
                        $('#cart'+product_id).fadeOut(200, function(){
                              $('#quan'+product_id).val(rdata.quantity);
                              $('#price'+product_id).text(rdata.price);
                              $('#cart'+product_id).fadeIn().delay(100);
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
    </script>
