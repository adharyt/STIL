<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>

<!-- Seller Center Dashboard JQuery -->
<script>
    function show_pengaturan_toko() {
        $('#pengaturan_toko_content').show();
    }

    $('.acorddion-style').on('click',function(e){
        $(this).children('i').toggleClass('fa-chevron-down fa-chevron-up');
    });

    $('.courier').on('click',function(e){

        var id=$(this).val();
        if($(this).is(':checked')){
          var prop=1;
        }else{
          var prop=0;
        }
        Swal.fire({
    			text:'Menyimpan perubahan...',
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
              url: "<?php echo base_url();?>my-store/shipping-courier-update",
              type: "post",
              data: {
                  id:id,
                  prop:prop
              },
              success: function (response) {
    							swal.close();
                  //alert(response);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }

          });
    });

    $('.openday').on('click',function(e){

        var id=$(this).val();
        if($(this).is(':checked')){
          var prop=1;
        }else{
          var prop=0;
        }
        if(id=='all'){
          if(prop==1){
            $('.openday').prop("checked",true);
          }else{
            $('.openday').prop("checked",false);
          }
        }
        Swal.fire({
    			text:'Menyimpan perubahan...',
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
              url: "<?php echo base_url();?>my-store/shipping-openday-update",
              type: "post",
              data: {
                  id:id,
                  prop:prop
              },
              success: function (response) {
    							swal.close();
                  //alert(response);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }

          });
    });

    $('.time-pick').on('change',function(e){
      var jam=$('#jam').val();
      var menit=$('#menit').val();
      $('#lastdelivery').text(jam+':'+menit);
      Swal.fire({
        text:'Menyimpan perubahan...',
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
            url: "<?php echo base_url();?>my-store/shipping-openhour-update",
            type: "post",
            data: {
                time:jam+':'+menit
            },
            success: function (response) {
                swal.close();
                //alert(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }

        });
    });
</script>

</body>
</html>
