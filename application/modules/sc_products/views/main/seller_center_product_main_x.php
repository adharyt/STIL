
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/product_filter.js"></script>



<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
});
</script>

<script>
function deleteProduct(id,name){
  Swal.fire({
  html: 'Apakah Anda yakin menghapus produk <b>'+name+'</b>?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#099245',
  confirmButtonText: 'Yes, delete it!',
  reverseButtons:true
}).then((result) => {
  if (result.value) {
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
          url: "<?php echo base_url();?>sc_products/deleteProduct",
          type: "post",
          data: {
              id:id,
          },
          success: function (response) {
              if(response=="FAILED"){
                swal.close();
              }else{
                location.reload();
              }

          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
  }
});

}
</script>
<script type="text/javascript">
$( ".discount" ).click(function() {
  var product_id=$(this).attr('pr_id');

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
        url: "<?php echo base_url();?>sc_products/getProductDiscount",
        type: "post",
        data: {
            id:product_id
        },
        success: function (response) {
            $('#modalDiskonKonten').html(response);
            $('[data-toggle="popover"]').popover();
            $('#modalDiskon').modal('show');
            var modal_date_start=$('#discount_start').val();
            var modal_date_end=$('#discount_end').val();
            if(modal_date_start=='' || modal_date_start=='0' || modal_date_start=='0000-00-00 00:00:00'){
              modal_date_start=moment().format('YYYY-MM-DD 00:00:00');
            }
            if(modal_date_end=='' || modal_date_end=='0' || modal_date_end=='0000-00-00 00:00:00'){
              modal_date_end=moment().add(6,'days').format('YYYY-MM-DD 23:59:59');
            }


            $(function() {
              $('#selectdate').daterangepicker({
                timePicker:true,
                timePicker24Hour:true,
                startDate: modal_date_start,
                endDate: modal_date_end,
                opens: 'left',
                locale: {
                  format: 'YYYY-MM-DD HH:mm'
                }
              }, function(start, end, label) {
                $('#discount_start').val(start.format('YYYY-MM-DD HH:mm')+':00');
                $('#discount_end').val(end.format('YYYY-MM-DD HH:mm')+':59');
              });
            });
            $('#discount_start').val(modal_date_start);
            $('#discount_end').val(modal_date_end);
            discFunc();
            Swal.close();

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });

});
</script>
<script type="text/javascript">
function discFunc(){
  var disc_value=$('#disc_value').val();
  if(disc_value>99 || disc_value<0 || disc_value==''){
    disc_value=0;
    $('#disc_value').val(0);
  }
  var disc_harga_awal=ribuan_unformat($('#disc_harga_awal').text());
  $('#disc_harga_akhir').text('Rp '+ribuan_format(disc_harga_awal-(disc_harga_awal*(disc_value/100))));
  $('.disc_val_grosir').each(function () {
    var disc_harga_awal_gr=ribuan_unformat($(this).attr('gr_val'));
    $(this).text('Rp '+ribuan_format(disc_harga_awal_gr-(disc_harga_awal_gr*(disc_value/100))));

  });
}

function discGrosirToggle(){
  $('#discGrosir').popover('toggle');
  discFunc();

}
</script>
<script type="text/javascript">
function setDiscount(param){
    var disc_pr_id=$('#disc_pr_id').val();
    if(param=='new'){
      var discount_start=$('#discount_start').val();
      var discount_end=$('#discount_end').val();
      var disc_value=$('#disc_value').val();
      if($('#disc_is_grosir').is(':checked')){
        var disc_is_grosir=1;
      }else{
        var disc_is_grosir=0;
      }
    }else{
      var discount_start='0000-00-00 00:00:00';
      var discount_end='0000-00-00 00:00:00';
      var disc_value=0;
      var disc_is_grosir=0;
    }

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
          url: "<?php echo base_url();?>sc_products/setProductDiscount",
          type: "post",
          data: {
              id:disc_pr_id,
              discount_start:discount_start,
              discount_end:discount_end,
              disc_value:disc_value,
              disc_is_grosir:disc_is_grosir

          },
          success: function (response) {
              if(response=="OK"){
                location.reload();
              }else{
                location.reload();
              }


          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });


}
</script>
<script type="text/javascript">
$( ".visibility" ).change(function() {
    var id=$(this).attr('pr_id');
    var visibility=$(this).val();

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
          url: "<?php echo base_url();?>sc_products/updateVisibility",
          type: "post",
          data: {
              id:id,
              visibility:visibility
          },
          success: function (response) {

              if(response=="FAILED"){
                location.reload();
              }else{
                swal.close();
              }

          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });

});
</script>
</body>
</html>
