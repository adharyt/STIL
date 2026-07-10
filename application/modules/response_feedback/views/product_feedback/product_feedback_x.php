
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
function submitReview(){
      valid=1;
      product_data=[];
      $.each($(".product_item"), function(){
        var id_product=$(this).val();
        if($('input[name=rating'+id_product+']').is(':checked')){
          var rating=$('input[name=rating'+id_product+']:checked').val();
        }else{
          var rating=0;
          valid=0;
        }
        var response=$('textarea[name=response'+id_product+']').val();
        if(response==''){
          valid=0;
        }
        product_data.push({"product_id":id_product,"rating":rating,"response":response});
      });
      if(valid==0){
        Swal.fire({
          type: 'warning',
          html:   'Isi rating dan ulasan terlebih dahulu!',
          showCloseButton: true,
          showCancelButton: false,
          showConfirmButton:false,
          allowEnterKey:false
        });
      }else{
        var id_trans_cour=$('input[name=id_trans_cour]').val();
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
                url: "<?php echo base_url();?>response_feedback/product_submit",
                type: "post",
                data: {
                    id_trans_cour:id_trans_cour,
                    review_data:product_data
                } ,
                success: function (response) {
                swal.close();
                if(response!='FAILED'){
                  window.location.href='<?php echo base_url();?>my-account/transaction/feedback/'+id_trans_cour+'/product';
                }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }


            });
        }
}
</script>
