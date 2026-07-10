
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/js/product_custom.js"></script>
<script type="text/javascript">
  function addToCart(product_id){
    <?php if($this->session->userdata('is_login')=='y'){ ?>
    var quantity=$('#quantity_input').val();
    if(quantity=='' || quantity<1){
      quantity=1;
      $('#quantity_input').val('1');
    }
    Swal.fire({
      text:'Loading...',
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
          url: "<?php echo base_url();?>cart/addToCart",
          type: "post",
          data: {
              idProduk:product_id,
              quantity:quantity,
              src:'WEB'
          },
          success: function (response) {
            Swal.close();
            if(response!="FAILED"){
              $('#cartcount').text(response);
              Swal.fire({
                title: 'Berhasil!',
                text: "Barang berhasil ditambahkan ke keranjang! Lihat keranjang Anda sekarang?",
                type: 'success',
                reverseButtons:true,
                showCancelButton: true,
                confirmButtonColor: '#099235',
                confirmButtonText: 'Lihat Keranjang',
                cancelButtonText: 'Nanti Saja'
              }).then((result) => {
                if (result.value) {
                  location.href="<?php echo base_url();?>cart";
                }
              })
            }


          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
      <?php }else{ ?>
        login();
        <?php } ?>
  }


  $('.quantity_inc').on('click', function(e) {
    e.preventDefault();
    var value = parseInt($('#quantity_input').val());


    value=value+1;
    $('#quantity_input').val(value);
    validation_quantity();
  });

  $('.quantity_dec').on('click', function(e) {
    e.preventDefault();
    var value = parseInt($('#quantity_input').val());


    value=value-1;
    $('#quantity_input').val(value);
    validation_quantity();
  });

  function validation_quantity(){
    var min=parseInt($('#quantity_input').attr('min'));
    var max=parseInt($('#quantity_input').attr('max'));
    var value=parseInt($('#quantity_input').val());
    var newval=value;
    if(value>max){
      newval=max;
    }
    if(newval<min){
      newval=min;
    }
    $('#quantity_input').val(newval);
  }
</script>
<script type="text/javascript">
function swishlist(idProduk,storeLink){
  <?php if($this->session->userdata('is_login')=='y'){ ?>
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
        url: "<?php echo base_url();?>product/swishlist",
        type: "post",
        data: {
            id:idProduk,
            store:storeLink
        },
        success: function (response) {
          if(response=="OKi"){
            var newVal=parseInt($('#wishlistCount').text())+1;
            $('#wishlistCount').text(newVal);
            var newValThis=parseInt($('#thisWishlist').text())+1;
            $('#thisWishlist').text(newValThis);
          }else{
            var newVal=parseInt($('#wishlistCount').text())-1;
            $('#wishlistCount').text(newVal);
            var newValThis=parseInt($('#thisWishlist').text())-1;
            $('#thisWishlist').text(newValThis);
          }

          swal.close();
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
    <?php }else{ ?>
      login();
      <?php } ?>

}
</script>
<script type="text/javascript">

function viewReview(){
  $.ajax({
          url: "<?php echo base_url();?>product/getReviews",
          type: "post",
          data: {
              id:$('#product_id').val()
          } ,
          success: function (response) {
             // you will get response from your php page (what you echo or print)
             $('#reviewContent').html(response);
             $('#reviewModal').modal('show');


          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }


      })
}
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>
