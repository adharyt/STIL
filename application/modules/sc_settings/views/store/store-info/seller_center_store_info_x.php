<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>



<!-- Seller Center Dashboard JQuery -->
<script type="text/javascript">
$(document).ready(function() {
    $('#edit-kecamatan').select2({
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
      var data = $("#edit-kecamatan option:selected").val();
   });

   var newOption = new Option($('#optName').val(), $('#optID').val(), true, true);
   $('#edit-kecamatan').append(newOption).trigger('change');

});

function save(){
  var description=$('#description').val();
  var notes=$('#notes').val();
  var telepon=$('#phone').val();
  var kecamatan=$('#edit-kecamatan').val();
  var kodepos=$('#postalcode').val();
  var alamat=$('#address').val();

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
        url: "<?php echo base_url();?>sc_settings/editStoreInfo",
        type: "post",
        data: {
        description:description,
        notes:notes,
        telepon:telepon,
        kecamatan:kecamatan,
        kodepos:kodepos,
        alamat:alamat
        },
        success: function (response) {
          swal.close();
          window.location.href='<?php echo base_url();?>my-store/settings/general';


        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
}
</script>

</body>
</html>
