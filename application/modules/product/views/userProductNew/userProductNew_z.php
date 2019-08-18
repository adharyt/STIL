      <script type="text/javascript">
        var totalQueue=0;
        var productId="";
        var grosir_status=0;
        var processtime_status=0;
        var berat_real=0;
        var is_submit_click=0;
        var is_validate_nama_produk=0; //done
        var is_validate_sku_produk=0; //done
        var is_validate_kategori_produk=0; //done
        var is_validate_etalase=1; //no validation, done
        var is_validate_deskripsi_produk=0;
        var is_validate_kondisi_produk=1; //no validation, done
        var is_validate_sumber_produk=1; //no validation, done
        var is_validate_stockType=1; //no validation, done
        var is_validate_stockValue=1; //no validation, done
        var is_validate_unit_min=1; //no validation, done
        var is_validate_harga_produk=0;//done
        var is_validate_berat_produk=0;//done
        var is_validate_grosir=1;//done
        var is_validate_processtime=1;
        var is_validate_video_produk=0; //done

        function validateData(){
          validation_nama_produk();
          validation_sku_produk();
          validation_kategori_produk();
          validation_deskripsi_produk();
          validation_harga_produk();
          validation_berat_produk();
          validation_video_produk();
        }

        function submit(){
          is_submit_click=1;
          validateData();
          if(
            is_validate_nama_produk==1 &&
            is_validate_sku_produk==1 &&
            is_validate_kategori_produk==1 &&
            is_validate_etalase==1 &&
            is_validate_deskripsi_produk==1 &&
            is_validate_kondisi_produk==1 &&
            is_validate_sumber_produk==1 &&
            is_validate_stockType==1 &&
            is_validate_stockValue==1 &&
            is_validate_unit_min==1 &&
            is_validate_harga_produk==1 &&
            is_validate_berat_produk==1 &&
            is_validate_grosir==1 &&
            is_validate_video_produk==1 &&
            is_validate_processtime==1){


              for(i=1;i<=5;i++){
                if($('#grosir_unit'+i).val()=='' || $('#grosir_harga'+i).val()==''){
                  $('#grosir_unit'+i).val('');
                  $('#grosir_harga'+i).val('');
                }
              }
              $.ajax({
                    url: "<?php echo base_url();?>product/newProduct_submit",
                    type: "post",
                    data: {
                        produk_nama:$('#nama_produk').val(),
                        produk_sku:$('#sku_produk').val(),
                        produk_kategori:$('#kategori_produk_id').val(),
                        produk_etalase:$('#etalase').val(),
                        produk_deskripsi:$('#deskripsi_produk').val(),
                        produk_kondisi:$("input[name='kondisi_produk']:checked").val(),
                        produk_sumber:$("input[name='sumber_produk']:checked").val(),
                        produk_stockType:$("input[name='stock']:checked").val(),
                        produk_stockValue:$("#stock_limit_val").val(),
                        produk_unitMin:$('#unit_min').val(),
                        produk_harga:$('#harga').val(),
                        produk_berat:berat_real,
                        produk_asuransi:$("input[name='asuransi']:checked").val(),
                        produk_video:$('#video_produk').val(),
                        grosir_is_active:$('#grosir_status').val(),
                        grosir_u1:$('#grosir_unit1').val(),
                        grosir_h1:$('#grosir_harga1').val(),
                        grosir_u2:$('#grosir_unit2').val(),
                        grosir_h2:$('#grosir_harga2').val(),
                        grosir_u3:$('#grosir_unit3').val(),
                        grosir_h3:$('#grosir_harga3').val(),
                        grosir_u4:$('#grosir_unit4').val(),
                        grosir_h4:$('#grosir_harga4').val(),
                        grosir_u5:$('#grosir_unit5').val(),
                        grosir_h5:$('#grosir_harga5').val(),
                        processtime_is_active:$('#processtime_status').val(),
                        processtime_type:$("input[name='waktu_proses']:checked").val(),
                        processtime_instan:$('#processtime_instan').val(),
                        processtime_preorder:$('#processtime_preorder').val()
                    },
                    success: function (response) {

                      if(response=="FAILED"){

                      }else{
                        totalQueue=myDropzone.getQueuedFiles().length;
                        productId=response;
                        myDropzone.processQueue();
                      }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                    }

                })
            }else{
              return false;
            }
        }

        function recorrection(){
          if(is_submit_click==1){
            validateData();
          }else{
            return false;
          }
        }


      </script>

    <!-- SCRIPT: GROSIR START -->
    <script type="text/javascript">
    function toggle_grosir(){
      if(grosir_status==0){
        grosir_status=1;
        $('#grosir_status').val('1');
        validation_grosir();
        $("#grosir_container").show();
        $("#grosir_status_text").text("Harga Grosir diaktifkan.");
        $("#grosir_button_text").text("Hapus Pengaturan");
      }else{
        grosir_status=0;
        $('#grosir_status').val('0');
        validation_grosir();
        $("#grosir_container").hide();
        is_validate_grosir=1;
        $("#grosir_status_text").text("Harga Grosir tidak diaktifkan.");
        $("#grosir_button_text").text("Aktifkan Sekarang");
      }
    }

    function validation_grosir(){

      var gu=[];
      var gh=[];
      gu[0]=1;
      gh[0]=parseInt($("#harga").val());
      if(grosir_status==1){
        checkProp(1);
      }else{
        for(i=1;i<=5;i++){
          disableProp(i);
        }
        $("#grosir_notif_1").hide();
        $("#grosir_notif_2").hide();
        $("#grosir_notif_3").hide();
        $("#grosir_notif_4").hide();
        $("#grosir_notif_5").hide();

      }

      function checkProp(id){
        enableProp(id);
        gu[id]=parseInt($("#grosir_unit"+id).val());
        gh[id]=parseInt($("#grosir_harga"+id).val());

        if(!isNaN(gu[id]) && !isNaN(gh[id])){
          if(gu[id]>gu[id-1] && gh[id]<gh[id-1]){
            checkProp(id+1);
            $("#grosir_notif_"+id).hide();
            $("#grosir_notif_1h").hide();
          }else{
            if(id==1){
              if(isNaN(gh[0]) || gh[0]==0){
                $("#grosir_notif_1h").show();
                $("#grosir_notif_1").hide();
                is_validate_grosir=0;
              }else{
                $("#grosir_notif_1").show();
                $("#grosir_notif_1h").hide();
                is_validate_grosir=0;
              }
            }else{
              $("#grosir_notif_"+id).show();
              is_validate_grosir=0;
            }
            for(i=id+1;i<=5;i++){
              disableProp(i);
            }
          }
        }else{
          is_validate_grosir=1;
          $("#grosir_notif_"+id).hide();

          var i;
          for(i=id+1;i<=5;i++){
            disableProp(i);
          }
        }
      }

      function disableProp(id){
        $("#grosir_unit"+id).prop("readonly", true);
        $("#grosir_harga"+id).prop("readonly", true);
        $('#grosir_unit'+id).val('');
        $('#grosir_harga'+id).val('');
      }

      function enableProp(id){
        $("#grosir_unit"+id).prop("readonly", false);
        $("#grosir_harga"+id).prop("readonly", false);
      }
    }
    </script>
    <!-- SCRIPT: GROSIR END -->

    <!-- SCRIPT: WAKTU PROSES START -->
    <script type="text/javascript">
    function toggle_processtime(){
      if(processtime_status==0){
        processtime_status=1;
        $('#processtime_status').val('1');
        validation_processtime();
        $("#processtime_custom").show();
        $("#processtime_default").hide();
        $("#processtime_status_text").text("Waktu proses pesanan (hanya untuk produk ini).");
        $("#processtime_button_text").text("Hapus Pengaturan");
      }else{
        processtime_status=0;
        $('#processtime_status').val('0');
        validation_processtime();
        $("#processtime_custom").hide();
        $("#processtime_default").show();
        is_validate_processtime=1;
        $("#processtime_status_text").html("Waktu proses pesanan tidak diatur (mengikuti <a href=# style='color:#009245'>pengaturan default</a>).");
        $("#processtime_button_text").text("Atur Sekarang");
      }
    }

    function validation_processtime(){
        var timeprocessType = $("input[name='waktu_proses']:checked").val();
        if(timeprocessType==1){
            $('#con_instan').show();
            $('#con_reguler').hide();
            $('#con_preorder').hide();
            $('#bul_instan').css('background-color','white');
            $('#bul_reguler').css('background-color','#fafafa');
            $('#bul_preorder').css('background-color','#fafafa');
          }
          else if(timeprocessType==2){
            $('#con_instan').hide();
            $('#con_reguler').show();
            $('#con_preorder').hide();
            $('#bul_instan').css('background-color','#fafafa');
            $('#bul_reguler').css('background-color','white');
            $('#bul_preorder').css('background-color','#fafafa');
          }
          else{
            $('#con_instan').hide();
            $('#con_reguler').hide();
            $('#con_preorder').show();
            $('#bul_instan').css('background-color','#fafafa');
            $('#bul_reguler').css('background-color','#fafafa');
            $('#bul_preorder').css('background-color','white');
        }
    }
    </script>
    <!-- SCRIPT: WAKTU PROSES END -->


    <!-- SCRIPT: STOCK START -->
    <script type="text/javascript">
    function validation_stock(){
        var stockType = $("input[name='stock']:checked").val();
        if(stockType==2){
          $("#stock_limit_val").prop("readonly", false);
          var stockValue=$("#stock_limit_val").val();
          if(isNaN(stockValue) || stockValue==0){
            $("#stock_limit_val").val(1);
          }

        }else{
          $("#stock_limit_val").prop("readonly", true);
          $("#stock_limit_val").val('');
        }
    }
    </script>
    <!-- SCRIPT: STOCK END -->

    <!-- SCRIPT: SUBMIT START -->
    <script type="text/javascript">
    function validation_nama_produk(){
      var nama_produk=$('#nama_produk').val();
      if(nama_produk!=''){
        if(nama_produk.length>50){
          is_validate_nama_produk=0;
          $('#notif_nama_produk_text').text('Nama produk tidak boleh lebih dari 50 karakter.');
          $('#notif_nama_produk').show();
        }else if(nama_produk.length<5){
          is_validate_nama_produk=0;
          $('#notif_nama_produk_text').text('Nama produk tidak boleh kurang dari 5 karakter.');
          $('#notif_nama_produk').show();
        }else{
          is_validate_nama_produk=1;
          $('#notif_nama_produk').hide();
        }
      }else{
        is_validate_nama_produk=0;
        $('#notif_nama_produk_text').text('Nama produk tidak boleh kosong.');
        $('#notif_nama_produk').show();
      }
    }

    function validation_sku_produk(){
      var sku_produk=$('#sku_produk').val();
      if(sku_produk!=''){
        if(sku_produk.length>20){
          is_validate_sku_produk=0;
          $('#notif_sku_produk_text').text('SKU produk tidak boleh lebih dari 20 karakter.');
          $('#notif_sku_produk').show();
        }else if(sku_produk.length<3){
          is_validate_sku_produk=0;
          $('#notif_sku_produk_text').text('SKU produk tidak boleh kurang dari 3 karakter.');
          $('#notif_sku_produk').show();
        }else{
          is_validate_sku_produk=1;
          $('#notif_sku_produk').hide();
        }
      }else{
        is_validate_sku_produk=1;
        $('#notif_sku_produk').hide();
      }
    }

    function validation_kategori_produk(){
      var kategori_produk=$('#kategori_produk_id').val();
      if(kategori_produk!=''){
          is_validate_kategori_produk=1;
          $('#notif_kategori_produk').hide();
      }else{
        is_validate_kategori_produk=0;
        $('#notif_kategori_produk_text').text('Kategori produk harus diisi.');
        $('#notif_kategori_produk').show();
      }
    }

    function validation_deskripsi_produk(){
      var deskripsi_produk=$('#deskripsi_produk').val();
      if(deskripsi_produk==''){
        is_validate_deskripsi_produk=0;
        $('#notif_deskripsi_produk_text').text('Deskripsi produk tidak boleh kosong.');
        $('#notif_deskripsi_produk').show();
      }else if(deskripsi_produk.length<=30){
        is_validate_deskripsi_produk=0;
        $('#notif_deskripsi_produk_text').text('Deskripsi produk minimal harus mengandung 30 karakter.');
        $('#notif_deskripsi_produk').show();
      }else{
        is_validate_deskripsi_produk=1;
        $('#notif_deskripsi_produk').hide();
      }
    }

    function validation_harga_produk(){
      var harga_produk=$('#harga').val();
      if(harga_produk=='' || isNaN(harga_produk) || harga_produk<1){
          is_validate_harga_produk=0;
          $('#notif_harga_produk_text').text('Harga produk harus diisi.');
          $('#notif_harga_produk').show();
      }else{
        is_validate_harga_produk=1;
        $('#notif_harga_produk').hide();
      }
    }

    function validation_berat_produk(){
      var berat=$('#weight').val();
      if(berat=='' || isNaN(berat) || berat<1){
          is_validate_berat_produk=0;
          $('#notif_berat_produk_text').text('Berat produk harus diisi.');
          $('#notif_berat_produk').show();
          berat_real=0;
      }else{
        is_validate_berat_produk=1;
        $('#notif_berat_produk').hide();
        berat_type=$("#weight_type").val();
        if(berat_type=="kg"){
          berat_real=berat*1000;
        }else{
          berat_real=berat;
        }
      }
    }

    function validation_video_produk(){
      var video_produk=$('#video_produk').val();
      if(video_produk!=''){
        if(!video_produk.includes('youtube.com/watch?v=')){
          is_validate_video_produk=0;
          $('#notif_video_produk_text').text('URL Video Youtube tidak valid.');
          $('#notif_video_produk').show();
        }else{
          is_validate_video_produk=1;
          $('#notif_video_produk').hide();
        }
      }else{
        is_validate_video_produk=1;
        $('#notif_video_produk').hide();
      }
    }
    </script>
    <!-- SCRIPT: SUBMIT END -->
