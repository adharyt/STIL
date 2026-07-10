<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>

<!-- Seller Center Dashboard JQuery -->
<script>

$(".list-group-item").on("drop", function(e) {
  var data=[];
  var pos=0;
  $.each($(".storefront"), function(){
    pos++;
    data.push({"storefront_id":$(this).attr('storefront_id'),"pos":pos});
  });
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
        url: "<?php echo base_url();?>sc_storefront/position_edit",
        type: "post",
        data: {
            data:JSON.stringify(data)
        },
        success: function (response) {
          swal.close();
          console.log(response);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
});
</script>
<script type="text/javascript">
function newStorefront(){
  $.ajax({
          url: "<?php echo base_url();?>sc_storefront/newStorefront",
          type: "post",
          data: {
              name:$('#new-storefront').val()
          } ,
          success: function (response) {
             // you will get response from your php page (what you echo or print)
             if(response=='OK'){
               Swal.fire({
                    title: "Etalase berhasil ditambahkan!",
                    text: "Klik ok untuk merefresh halaman",
                    type: 'Success',
                    showCancelButton: false,
                    confirmButtonColor: '#009245',
                  }).then((result) => {
                    location.reload();
                  })
              }else if(response=="MAX"){
                Swal.fire({
                     title: "Etalase gagal ditambahkan!",
                     text: "Anda hanya dapat memiliki 6 etalase!",
                     type: 'warning',
                     showCancelButton: false,
                     confirmButtonColor: '#009245',
                   });
              }else{
                Swal.fire({
                     title: "Etalase gagal ditambahkan!",
                     text: "Data sudah ada",
                     type: 'warning',
                     showCancelButton: false,
                     confirmButtonColor: '#009245',
                   });
              }


          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }


      })
}
</script>
<script type="text/javascript">
function editStoreFront(id){
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
          url: "<?php echo base_url();?>sc_storefront/editConfirm",
          type: "post",
          data: {
              id:id,
          },
          success: function (response) {
              $('#editStorefrontModalContent').html(response);
              $('#editStorefrontModal').modal("show");
              swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>
<script type="text/javascript">
function deleteStoreFront(id){
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
          url: "<?php echo base_url();?>sc_storefront/deleteConfirm",
          type: "post",
          data: {
              id:id,
          },
          success: function (response) {
              $('#deleteStorefrontModalContent').html(response);
              $('#deleteStorefrontModal').modal("show");
              swal.close();
          },
          error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus, errorThrown);
          }

      });
}
</script>

<!-- Sortable List -->
<script>
Sortable.create(storefront_category_list, {
  animation: 100,
  group: 'list-1',
  draggable: '.list-group-item',
  handle: '.list-group-item',
  sort: true,
  filter: '.sortable-disabled',
  chosenClass: 'active'
});
</script>

</body>
</html>
