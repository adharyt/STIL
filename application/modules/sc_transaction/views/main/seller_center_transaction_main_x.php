<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/croppie/croppie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/product_filter.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/store_photo.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
            url:'<?php echo base_url();?>sc_transaction/index/append<?php echo $filter;?>',
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
    location.href="<?php echo base_url();?>my-store/transaction?from="+trans_date_start+"&to="+trans_date_end+"&showPending="+filter_pending+"&showProcess="+filter_process+"&showSent="+filter_sent+"&showDelivered="+filter_delivered+"&showSuccess="+filter_success+"&showDecline="+filter_decline+"&lc_method="+courier+reference;


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
function declineTransaction(id){
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
          url: "<?php echo base_url();?>sc_transaction/getDetailSummary",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              if(response!='FALSE'){
                $('#declineTransContent').text(response);
                $('#declineTransId').val(id);
                $('#declineTransactionModal').modal("show");
                swal.close();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}

function declineTransactionExe(){
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
          url: "<?php echo base_url();?>sc_transaction/process_decline",
          type: "post",
          data: {
              id:$('#declineTransId').val(),
              reason:$('#decline_reason').val()
          },
          success: function (response) {
              if(response=='SUCCESS'){
                $('#declineTransactionModal').modal("hide");
                swal.close();
                location.reload();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script>
function acceptTransaction(id){
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
          url: "<?php echo base_url();?>sc_transaction/getDetailSummary",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              if(response!='FALSE'){
                $('#acceptTransContent').text(response);
                $('#acceptTransId').val(id);
                $('#acceptTransactionModal').modal("show");
                swal.close();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}

function acceptTransactionExe(){
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
          url: "<?php echo base_url();?>sc_transaction/process_accept",
          type: "post",
          data: {
              id:$('#acceptTransId').val()
          },
          success: function (response) {
              if(response=='SUCCESS'){
                $('#acceptTransactionModal').modal("hide");
                swal.close();
                location.reload();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script>
function kirimTransaction(id){
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
          url: "<?php echo base_url();?>sc_transaction/getDetailSummary",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              if(response!='FALSE'){
                $('#kirimTransContent').text(response);
                $('#kirimTransId').val(id);
                $('#kirimTransactionModal').modal("show");
                swal.close();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}

function kirimTransactionExe(){
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
          url: "<?php echo base_url();?>sc_transaction/process_kirim",
          type: "post",
          data: {
              id:$('#kirimTransId').val(),
              resi:$('#kirimResi').val()
          },
          success: function (response) {
              if(response=='SUCCESS'){
                $('#kirimTransactionModal').modal("hide");
                swal.close();
                location.reload();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script type="text/javascript">
function readyAmbilSendiri(id){
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
          url: "<?php echo base_url();?>sc_transaction/process_ready_ambil",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              if(response=='SUCCESS'){
                swal.close();
                location.reload();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
function pengambilanBarang(id){
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
          url: "<?php echo base_url();?>sc_transaction/getDetailSummary",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              if(response!='FALSE'){
                $('#pengambilanBarangContent').text(response);
                $('#pengambilanBarangId').val(id);
                $('#pengambilanBarangModal').modal("show");
                swal.close();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
function pengambilanBarangExe(){
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
          url: "<?php echo base_url();?>sc_transaction/process_pengambilan_barang",
          type: "post",
          data: {
              id:$('#pengambilanBarangId').val(),
              email:$('#pengambilanEmail').val(),
              kode:$('#pengambilanKodeAmbil').val()
          },
          success: function (response) {
              if(response=='SUCCESS'){
                $('#pengambilanBarangModal').modal("hide");
                swal.close();
                location.reload();
              }else if(response=='NOT FOUND'){
                swal.close();
                Swal.fire({
                  html: 'Email atau Kode Pengambilan salah!',
                  type: 'warning',
                  showCancelButton: false,
                  confirmButtonColor: '#099245',
                  confirmButtonText: 'Ya',
                  reverseButtons:true
                });
              }else{
                Swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script>
function updateResi(id){
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
          url: "<?php echo base_url();?>sc_transaction/getDetailSummary",
          type: "post",
          data: {
              id:id
          },
          success: function (response) {
              if(response!='FALSE'){
                $('#updateResiContent').text(response);
                $('#updateResiId').val(id);
                $('#updateResiModal').modal("show");
                swal.close();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}

function updateResiExe(){
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
          url: "<?php echo base_url();?>sc_transaction/process_updateResi",
          type: "post",
          data: {
              id:$('#updateResiId').val(),
              resi:$('#updateResi').val()
          },
          success: function (response) {
              if(response=='SUCCESS'){
                $('#updateResiModal').modal("hide");
                swal.close();
                location.reload();
              }else{
                swal.close();
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}

function infoPembeli(id_sdt){
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
	      swal.showLoading();
	    }
	  });
    $.ajax({
            url: "<?php echo base_url();?>Sc_transaction/getBuyerInfoModal",
            type: "post",
            data: {
                id_sdt:id_sdt
            } ,
            success: function (response) {
                var res=JSON.parse(response);

                  if(res.is_login=='TRUE'){
                    if(res.res=="OK"){
                      $('#infoPembeliModalContent_nama').html(res.content_data.user_name);
                      $('#infoPembeliModalContent_telepon').html(res.content_data.user_phone);
                      $('#infoPembeliModalContent_alamat').html(res.content_data.alamat_lengkap);
                      $('#infoPembeliModal').modal('show');
                      Swal.close();
                    }else{
                      Swal.close();
                      //tidak ada datanya
                          Swal.fire({
                            type: 'error',
                            title: 'Data Tidak Valid',
                            showCloseButton: false,
                            showCancelButton: false,
                            showConfirmButton:true,
                            confirmButtonColor:'#009245',
                            allowEnterKey:true
                          }).then((result) => {
                            if (result.value) {
                              location.reload();
                            }
                          });
                    }
                  }else{
                    //need login
                    Swal.fire({
                      type: 'warning',
                      title: 'Session Expired',
                      text:   "Mohon maaf Anda harus login kembali untuk melakukan hal ini!",
                      showCloseButton: false,
                      showCancelButton: false,
                      showConfirmButton:true,
                      confirmButtonColor:'#009245',
                      allowEnterKey:true
                    }).then((result) => {
                      if (result.value) {
                        location.href='<?php echo $this->config->item("landing_url_login");?>';
                      }
                    });
                  }
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }


        });
}
</script>
</body>
</html>
