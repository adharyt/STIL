
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
<script src="https://unpkg.com/dropzone"></script>
<script src="<?php echo base_url();?>files/assets/fastselect/dist/fastselect.standalone.js"></script>
<script src="https://unpkg.com/cropperjs"></script>

<script type="text/javascript">
      var cover="";
      var countUploaded=0;

      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone("#product-img", {
        url: "<?php echo base_url();?>product/uploadimg",
        method: "post",
        withCredentials: !1,
        parallelUploads: 6,
        uploadMultiple: !1,
        maxFilesize: 10,
        paramName: "file",
        createImageThumbnails: !0,
        maxThumbnailFilesize: 10,
        thumbnailWidth: 120,
        thumbnailHeight: 120,
        filesizeBase: 1e3,
        maxFiles: 6,
        params: {},
        clickable: !0,
        ignoreHiddenFiles: !0,
        acceptedFiles: '.gif,.png,.jpg,.jpeg',
        acceptedMimeTypes: null,
        autoProcessQueue: false,
        autoQueue: !0,
        addRemoveLinks: 1,
        previewsContainer: null,
        hiddenInputContainer: "body",
        capture: null,
        renameFilename: null,
        dictDefaultMessage: "<img src='<?php echo base_url();?>assets/images/icon-img/PilihGambar.png' width='200px'><br><font color='#009245'><b>Pilih Gambar Barang</b></font><br><small>atau tarik Gambar kesini</small>",
        dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
        dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
        dictFileTooBig: "File is too big ({{filesize}}MB). Max filesize: {{maxFilesize}}MB.",
        dictInvalidFileType: "You can't upload files of this type.",
        dictResponseError: "Server responded with {{statusCode}} code.",
        dictCancelUpload: "Cancel upload",
        dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
        dictRemoveFile: "Hapus Gambar",
        dictRemoveFileConfirmation: null,
        dictMaxFilesExceeded: "Anda tidak dapat menambahkan gambar lagi (maksimal 5)",
        maxfilesexceeded: function(file) {
              Swal.fire({
                type: 'warning',
                title: 'Limit gambar terpenuhi',
                html: "Gambar <b>"+file.name+"</b> tidak bisa ditambahkan. Maksimal gambar yang dapat diupload adalah 6 (enam) gambar, silahkan hapus salah satu gambar yang sudah diupload terlebih dahulu."
                }
              )
        },
        init: function() {
        this.on("maxfilesexceeded", function(file) {
              this.removeFile(file);
        });
        this.on("sending", function(file, xhr, formData) {
          formData.append("productId", productId);
          formData.append("thumbnail", cover);
        });
        this.on('error', function(file, errorMessage) {
          var mypreview = document.getElementsByClassName('dz-error');
          mypreview = mypreview[mypreview.length - 1];
          mypreview.classList.toggle('dz-error');
          mypreview.classList.toggle('dz-success');
        });
        this.on("addedfile", function(file) {
          // Create the image editor overlay
          var editor = document.createElement('div');
          editor.style.position = 'fixed';
          editor.style.left = 0;
          editor.style.right = 0;
          editor.style.top = 0;
          editor.style.bottom = 0;
          editor.style.zIndex = 9999;
          editor.style.backgroundColor = '#000';
          document.body.appendChild(editor);
          // Create confirm button at the top left of the viewport
          var buttonConfirm = document.createElement('button');
          buttonConfirm.style.position = 'absolute';
          buttonConfirm.style.left = '10px';
          buttonConfirm.style.top = '10px';
          buttonConfirm.style.zIndex = 9999;
          buttonConfirm.textContent = 'Confirm';
          editor.appendChild(buttonConfirm);
          buttonConfirm.addEventListener('click', function() {
            // Get the canvas with image data from Cropper.js
            var canvas = cropper.getCroppedCanvas({
              width: 120,
              height: 120
            });
            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function(blob) {
              // Create a new Dropzone file thumbnail
              myDropzone.createThumbnail(
                blob,
                myDropzone.options.thumbnailWidth,
                myDropzone.options.thumbnailHeight,
                myDropzone.options.thumbnailMethod,
                false,
                function(dataURL) {

                  // Update the Dropzone file thumbnail
                  myDropzone.emit('thumbnail', file, dataURL);
                  // Return the file to Dropzone
                  canvas.toDataURL("image/jpeg");

              });
            });
            // Remove the editor from the view
            document.body.removeChild(editor);
          });
          // Create an image node for Cropper.js
          var image = new Image();
          image.src = URL.createObjectURL(file);
          editor.appendChild(image);

          // Create Cropper.js
          var cropper = new Cropper(image, { aspectRatio: 1 });

          $(".dz-remove").html('<div  class="btn btn-danger btn-xs" href="javascript:void(0);"  style="cursor:pointer">Hapus</div>&nbsp;');
          $(".dz-remove").css('display','inline');
          var fileuploded = file.previewElement.querySelector("[data-dz-name]");
          var datetemp = new Date();
          var nodetemp = datetemp.getTime();
          var defaultButton = Dropzone.createElement('<button id="'+nodetemp+'" class="btn btn-primary btn-xs btnThumbnail" href="javascript:void(0);" onClick="setThumbnail(`'+nodetemp+'`,`'+file.name+'`)" style="cursor:pointer">Set Cover</button>');
          file.previewElement.append(defaultButton);
          if(cover==""){
            setThumbnail(nodetemp,file.name);
          }
        });
        this.on("thumbnail", function(file) {
          recorrection();
        });
        },

        success: function(a,response) {
          countUploaded++;
          if(countUploaded>=totalQueue){
            var link=$('#slug').val();
            window.location.href='<?php echo base_url().'p/'.$this->session->userdata('username');?>/'+link;
          }else{
            return a.previewElement ? a.previewElement.classList.add("dz-success") : void 0
          }


        },
       removedfile: function(file) {
         if (file.previewElement != null && file.previewElement.parentNode != null) {
           file.previewElement.parentNode.removeChild(file.previewElement);
         }
         if(cover==file.name){
           cover="";
         }
         recorrection();
         return this._updateMaxFilesReachedClass();
      }
      });

    </script>
    <script type="text/javascript">
      $('#etalase').fastselect({

      });

      function newStorefront(input){
        $.ajax({
                url: "<?php echo base_url();?>sc_storefront/newStorefront",
                type: "post",
                data: {
                    name:input
                } ,
                success: function (response) {
                   // you will get response from your php page (what you echo or print)
                   if(response=='OK'){
                     $('#etalaseContainer').load(' #etalaseContainer');
                     $('#etalaseContainer').css('margin-left','-15px');
                     Swal.fire({
                          title: "Etalase berhasil ditambahkan!",
                          text: "Klik ok untuk menyegarkan list",
                          type: 'Success',
                          showCancelButton: false,
                          confirmButtonColor: '#009245',
                        }).then((result) => {
                          $('#etalase').fastselect('destroy');
                          $('#etalase').fastselect('rebuild');
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
    function categorySelect(node){
      $.ajax({
              url: "<?php echo base_url();?>product/getCategoryBread",
              type: "post",
              data: {
                  node:node
              } ,
              success: function (response) {
                 // you will get response from your php page (what you echo or print)
                 $('#kategori_produk').val(response);
                 $('#kategori_produk_id').val(node);
                 recorrection();

              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }


          })
    }
    function setThumbnail(id,name){
      $('.btnThumbnail').text('Set Cover');
      $('.btnThumbnail').prop('disabled',false);
      $('#'+id).text('Dipilih');
      $('#'+id).prop('disabled',true);
      cover=name;

    }

    function eVolumetricW(){
      var panjang=Number($('#ev_panjang').val());
      var lebar=Number($('#ev_lebar').val());
      var tinggi=Number($('#ev_tinggi').val());
      if( panjang=='' || isNaN(panjang) || panjang==0 ||
          lebar=='' || isNaN(lebar) || lebar==0 ||
          tinggi=='' || isNaN(tinggi) || tinggi==0){
          $('#ev_value').text('0');
          $('#ev_button').prop('disabled',true);
      }else{

        $('#ev_value').text(((panjang*lebar*tinggi)/6).toFixed(2).replace(".00", "").replace(",00", ""));
        $('#ev_button').prop('disabled',false);
      }
    }

    function eVolumetricE(){
        var nw_value=$('#ev_value').text();
        if(nw_value>0){
          $('#weight').val(nw_value);
          $('#weight_type option[value=g]').prop('selected',true);
          $('#weightModal').modal('hide');
        }else{
          return false;
        }
    }
    </script>

    <script type="text/javascript">
        function cekJasaPengirimanKhusus(){
            var courier=[];
            $('.courier').each(function () {
              var id=$(this).val();
              if($(this).is(':checked')){
                courier.push(id);
              }
            });
            $('#pengirimanKhususModal').modal('hide');
            if(courier.length>0){
              $('#pengirimanKhususText0').hide();
              $('#pengirimanKhususText1').show();
              $('#pengirimanKhususValue').text(courier.length);
            }else{
              $('#pengirimanKhususText1').hide();
              $('#pengirimanKhususText0').show();
              $('#pengirimanKhususValue').text('0');
            }
            //console.log(courier);
        }

    </script>
