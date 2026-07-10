
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo base_url();?>assets/js/shop_custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $(function() {
  $('#transactiondate').daterangepicker({
        startDate: $('#trans_date_start').val(),
        endDate: $('#trans_date_end').val(),
        opens: 'right',
        ranges: {
           'Semua transaksi': ['<?php echo $this->session->userdata('registered_date');?>', moment()],
           'Transaksi bulan ini': [moment().startOf('month'), moment().endOf('month')],
           'Transaksi 30 hari terakhir': [moment().subtract(29, 'days'), moment()],
           'Transaksi 7 hari terakhir': [moment().subtract(6, 'days'), moment()],
           'Transaksi kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Transaksi hari ini': [moment(), moment()]
        },
        locale: {
          format: 'YYYY-MM-DD'
        }
      }, function(start, end, label) {
        $('#trans_date_start').val(start.format('YYYY-MM-DD'));
        $('#trans_date_end').val(end.format('YYYY-MM-DD'));
        filter_transaction();
      });
    });

  $('[data-toggle="tooltip"]').tooltip();
  $('.loading').hide();
    $(document).on('click','.show_more',function(){

        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loading').show();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>profile_transaction/profileTransactionSingle/append<?php echo $filter;?>',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.postList').append(html);
                $('.loading').hide();
            }
        });
    });
});
</script>
<script type="text/javascript">
//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 1500;  //time in ms (5 seconds)

//on keyup, start the countdown
$('#reference').keyup(function(){
    clearTimeout(typingTimer);
        typingTimer = setTimeout(filter_transaction, doneTypingInterval);
});

  function filter_transaction(){
    //KURIR
    var cour_total=0;
    $.each($("input[name=lc_method]"), function(){
      cour_total++;
    });

    var couriers=[];
    $.each($("input[name=lc_method]:checked"), function(){
      couriers.push($(this).val());
    });

    if(couriers.length>0 && couriers.length!=cour_total){
      var courier=couriers.join(",");
    }else{
      var courier='all';
    }

    //STATUS TRANSAKSI
    if($('#filter_pending').is(':checked')){
      var filter_pending='true';
    }else{
      var filter_pending='false';
    }
    if($('#filter_process').is(':checked')){
      var filter_process='true';
    }else{
      var filter_process='false';
    }
    if($('#filter_sent').is(':checked')){
      var filter_sent='true';
    }else{
      var filter_sent='false';
    }
    if($('#filter_delivered').is(':checked')){
      var filter_delivered='true';
    }else{
      var filter_delivered='false';
    }
    if($('#filter_success').is(':checked')){
      var filter_success='true';
    }else{
      var filter_success='false';
    }
    if($('#filter_decline').is(':checked')){
      var filter_decline='true';
    }else{
      var filter_decline='false';
    }

    //TANGGAL TRANSAKSI
    if($('#trans_date_start').val()!=''){
      var trans_date_start=$('#trans_date_start').val();
    }else{
      var trans_date_start='<?php echo $this->session->userdata('registered_date');?>';
    }

    if($('#trans_date_end').val()!=''){
      var trans_date_end=$('#trans_date_end').val();
    }else{
      var trans_date_end='<?php echo date('Y-m-d');?>';
    }

    var reference=$('#reference').val();
    if(reference!=''){
      reference="&reference="+reference;
    }
    location.href="<?php echo base_url();?>my-account/transaction-split?from="+trans_date_start+"&to="+trans_date_end+"&showPending="+filter_pending+"&showProcess="+filter_process+"&showSent="+filter_sent+"&showDelivered="+filter_delivered+"&showSuccess="+filter_success+"&showDecline="+filter_decline+"&lc_method="+courier+reference;


  }
</script>
<script type="text/javascript">
function getDetailWeight(id){
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
          url: "<?php echo base_url();?>profile_transaction/profileDetailWeight",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              $('#detailWeightModalContent').html(response);
              $('#detailWeightModal').modal("show");
              swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script type="text/javascript">
function getDetailPrice(id){
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
          url: "<?php echo base_url();?>profile_transaction/profileDetailPrice",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              $('#detailPriceModalContent').html(response);
              $('#detailPriceModal').modal("show");
              swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script type="text/javascript">
function terimaPesanan(id){
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
          url: "<?php echo base_url();?>profile_transaction/modal_terimaBarang",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              $('#acceptTransactionModalContent').html(response);
              $('#acceptTransactionModal').modal("show");
              swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script type="text/javascript">
  function submitFeedback(){
    if($('input[name=rating_cour_ontime]').is(':checked') && $('input[name=rating_cour_protection]').is(':checked') && $('textarea[name=response_detail]').val()!=''){
      var valid=1;
    }else{
      var valid=0;
    }

    if(valid==1){
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Konfirmasi bahwa barang telah Anda terima dan teruskan uang ke penjual?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#009245',
        cancelButtonColor: '#868e96',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          var fb_response=$('input[name=response]:checked').val();
          var fb_response_detail=$('textarea[name=response_detail]').val();
          var id_trans=$('input[name=id_trans]').val();
          var fb_rating_cour_ontime=$('input[name=rating_cour_ontime]:checked').val();
          var fb_rating_cour_protection=$('input[name=rating_cour_protection]:checked').val();
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
                  url: "<?php echo base_url();?>profile_transaction/trans_terimaBarang",
                  type: "post",
                  data: {
                      id_trans:id_trans,
                      response:fb_response,
                      response_detail:fb_response_detail,
                      rating_cour_ontime:fb_rating_cour_ontime,
                      rating_cour_protection:fb_rating_cour_protection
                  } ,
                  success: function (response) {
                  swal.close();
                  if(response!='FAILED'){
                    Swal.fire({
                      title: 'Konfirmasi',
                      text: 'Apakah Anda ingin mengulas produk yang Anda beli dalam transaksi ini?',
                      type: 'success',
                      showCancelButton: true,
                      confirmButtonColor: '#009245',
                      cancelButtonColor: '#868e96',
                      cancelButtonText: 'Tidak',
                      confirmButtonText: 'Ya',
                      reverseButtons: true
                    }).then((result) => {
                      if (result.value) {
                        window.location.href='<?php echo base_url();?>my-account/transaction/feedback/'+response+'/reviewDelivered/'+id_trans;
                      }else{
                        location.reload();
                      }
                    });
                  }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                     console.log(textStatus, errorThrown);
                  }


              })
        }
      });
    }else{
      Swal.fire({
        html: 'Mohon isi feedback untuk penjual dan rating untuk kurir!',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#099245',
        confirmButtonText: 'Ya',
        reverseButtons:true
      })
    }
  }
</script>
