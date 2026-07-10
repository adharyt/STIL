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
<script src="<?php echo base_url();?>assets/vendor/bootstrap-datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap-datatable/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#moneyHistory').DataTable();
    $('#pendingWD').DataTable();
    $('#historyWD').DataTable();
} );

function cairkanUang(){
  $('#pencairanModal').modal('show');
}

function requestWD(){
  var wd_amount=$('#wd_amount').val().split('.').join("");
  var wd_user_bank_id=$('#wd_user_bank_id').val();

  if(wd_amount!='' && wd_user_bank_id!=''){
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
        url: "<?php echo base_url();?>Sc_credit/requestWD",
        type: "post",
        data: {
          wd_amount:wd_amount,
          wd_user_bank_id:wd_user_bank_id
        },
        success: function (response) {
          swal.close();
          if(response=="OK"){
              Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Input data berhasil!',
                text: 'Permintaan akan segera diproses',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                location.reload();
              });

          }else if(response=="MONEY INSUFFICIENT"){
            mon=$('#mycurrentmoney').text();
            Swal.fire({
              type: 'warning',
              html:   "Saldo Anda hanya tersisa "+mon+"!",
              showCloseButton: false,
              showCancelButton: false,
              showConfirmButton:true,
              allowEnterKey:true,
              confirmButtonColor:'#009245'
            });
          }else if(response=="MONEY TOLOW"){
            Swal.fire({
              type: 'warning',
              html:   "Minimum pencairan dana adalah Rp 30.000!",
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
  }else{
    Swal.fire({
      type: 'warning',
      html:   "Semua field harus diisi!",
      showCloseButton: false,
      showCancelButton: false,
      showConfirmButton:true,
      allowEnterKey:true,
      confirmButtonColor:'#009245'
    });
  }
}
</script>

</body>
</html>
