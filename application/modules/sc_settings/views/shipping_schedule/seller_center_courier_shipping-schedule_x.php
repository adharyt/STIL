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


<!-- SCRIPT: WAKTU PROSES START -->
<script type="text/javascript">
function validation_processtime(){
    var timeprocessType = $("input[name='waktu_proses']:checked").val();
    if(timeprocessType==1){
        $('#con_instan').show();
        $('#con_reguler').hide();
        $('#con_preorder').hide();
        $('#bul_instan').css('background-color','white');
        $('#bul_reguler').css('background-color','#fafafa');
        $('#bul_preorder').css('background-color','#fafafa');
      }
      else if(timeprocessType==2){
        $('#con_instan').hide();
        $('#con_reguler').show();
        $('#con_preorder').hide();
        $('#bul_instan').css('background-color','#fafafa');
        $('#bul_reguler').css('background-color','white');
        $('#bul_preorder').css('background-color','#fafafa');
      }
      else{
        $('#con_instan').hide();
        $('#con_reguler').hide();
        $('#con_preorder').show();
        $('#bul_instan').css('background-color','#fafafa');
        $('#bul_reguler').css('background-color','#fafafa');
        $('#bul_preorder').css('background-color','white');
    }
}
</script>
<!-- SCRIPT: WAKTU PROSES END -->
<!-- Seller Center Dashboard JQuery -->
<script>
    $('.time-pick').css('width','80px');

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
              url: "<?php echo base_url();?>my-store/settings/shipping-openday-update",
              type: "post",
              data: {
                  id:id,
                  prop:prop
              },
              success: function (response) {
                if(response=='SUCCESS'){
                  $('.openday[value=all]').prop("checked",false);
                  swal.close();
                }else if(response=='SUCCESS-ALL'){
                  swal.close();
                  $('.openday[value=all]').prop("checked",true);
                }


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
            url: "<?php echo base_url();?>my-store/settings/shipping-openhour-update",
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

    function processtime_wg(){
      var process_type=$('input[name=waktu_proses]:checked').val();
      var processtime_instan=$('#processtime_instan').val();
      var processtime_preorder=$('#processtime_preorder').val();
      if(processtime_instan>8){
        processtime_instan=8;
        $('#processtime_instan').val('8');
      }

      if(processtime_preorder<3){
        processtime_preorder=3;
        $('#processtime_preorder').val('3');
      }else if(processtime_preorder>30){
        processtime_preorder=30;
        $('#processtime_preorder').val('30');
      }

      $('.time_instan_text').text(processtime_instan);
      $('.time_preorder_text').text(processtime_preorder);


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
              url: "<?php echo base_url();?>my-store/settings/shipping-processtime-update",
              type: "post",
              data: {
                  process_type:process_type,
                  processtime_instan:processtime_instan,
                  processtime_preorder:processtime_preorder
              },
              success: function (response) {
    							swal.close();
                  //alert(response);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }

          });
    }
</script>

</body>
</html>
