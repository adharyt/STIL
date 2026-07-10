
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/product_filter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

<script type="text/javascript">
$(function(){
$('#kategori').find('i').click(function(e){
    $(this).parent().parent().children('ol').toggle();
    $(this).toggleClass('fa-chevron-right fa-chevron-down');
    $(this).parent().toggleClass('dd-active dd-nactive');
});
});
</script>
<script type="text/javascript">
  function addToCart(product_id){
    <?php if($this->session->userdata('is_login')=='y'){ ?>
    var quantity=1;
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

</script>
<script type="text/javascript">
  function quickview(idProduk,storeLink){
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
          url: "<?php echo base_url();?>products/getQuickview",
          type: "post",
          data: {
              id:idProduk,
              store:storeLink
          },
          success: function (response) {
              $('#quickviewItem').html(response);
              $('#modalQuickView').modal("show");
							swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      })

  }

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
            }else{
              var newVal=parseInt($('#wishlistCount').text())-1;
              $('#wishlistCount').text(newVal);
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
    $(function(){
       $('#provinsi').select2({
           minimumInputLength: 3,
           allowClear: true,
           placeholder: 'Semua Wilayah/Provinsi',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url();?>API/getLocation/ID/PROVINCE',
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
         var data = $("#provinsi option:selected").val();
         if(data!=''){
           $('#kotakon').show();
           $('.select2').css('width','100%');
           $("#kota").val('').trigger('change') ;
         }else{
           $('#kotakon').hide();
           $("#kota").val('').trigger('change') ;
         }
      });
      <?php
      if(isset($_GET['search_province'])){
        if($this->input->get('search_province')!=''){
          $param0=$this->input->get('search_province');
          $dataProv=$this->db->query("SELECT kode_wilayah,nama FROM zone_id WHERE kode_wilayah='$param0' and level=1")->result_array();
          if(count($dataProv)>0){
          ?>
          var newOption = new Option("<?php echo $dataProv[0]['nama'] ;?>", "<?php echo $dataProv[0]['kode_wilayah'] ;?>", true, true);
          $('#provinsi').append(newOption).trigger('change');
          <?php
          if(isset($_GET['search_city'])){
            if($this->input->get('search_city')!=''){
              $param=$this->input->get('search_city');
              $dataCity=$this->db->query("SELECT kode_wilayah,nama FROM zone_id WHERE kode_wilayah='$param' and mst_kode_wilayah='$param0' and level=2")->result_array();
              if(count($dataCity)>0){
              ?>
              var newOption2 = new Option("<?php echo $dataCity[0]['nama'] ;?>", "<?php echo $dataCity[0]['kode_wilayah'] ;?>", true, true);
              $('#kota').append(newOption2).trigger('change');
              <?php
            }
          }
        }

        }
        }
      }
      ?>


 });
</script>
<script type="text/javascript">
    $(function(){
       $('#kota').select2({
           minimumInputLength: 3,
           allowClear: true,
           placeholder: 'Semua Kota/Kabupaten',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url();?>API/getLocation/ID/CITY',
              delay: 800,
              data: function(params) {
                return {
                  search: params.term,
                  parent:$('#provinsi').val()
                }
              },
              processResults: function (data, page) {
              return {
                results: data
              };
            },
          }
      }).on('change', function (evt) {
         var data = $("#kota option:selected").val();
      });

 });
</script>
