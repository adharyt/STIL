<script src="<?php echo base_url('node_modules/socket.io-client/dist/socket.io.js');?>"></script>
<script type="text/javascript">
var socket = io.connect( 'http://'+window.location.hostname+':3000' );
socket.on('notification_user', function( data ){
  if(data.id_user=='<?php echo $this->session->userdata('user_id');?>'){
    reloadNotificationUser();
  }
});

socket.on('notification_store', function( data ){
  reloadNotificationStore();
});
</script>
<script type="text/javascript">
  function reloadNotificationUser(){
    $.ajax({
            url: "<?php echo base_url();?>user_notification/countNotification",
            type: "post",
            data: {
                valid:'valid'
            } ,
            success: function (response_ajax) {
              response=JSON.parse(response_ajax);
              if(response.res_is_login!='y'){
                Swal.fire({
                  type: 'error',
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
              }else{
                var unread_message=response.res_value;
                if(unread_message>0){
                  var notification_user_badge = document.getElementById("notification_user_badge");
                  notification_user_badge.style.display = "inline-block";
                  if(unread_message>99){
                    $('#notification_user_badge').text('99+');
                  }else if(unread_message==1){
                    $('#notification_user_badge').text(unread_message+'nbsp;');
                  }else{
                    $('#notification_user_badge').text(unread_message);
                  }
                }else{
                  var notification_user_badge = document.getElementById("notification_user_badge");
                  notification_user_badge.style.display = "hide";
                }
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }


        })
  }

  function reloadNotificationStore(){
    $.ajax({
            url: "<?php echo base_url();?>sc_notification/countNotification",
            type: "post",
            data: {
                valid:'valid'
            } ,
            success: function (response_ajax) {
              response=JSON.parse(response_ajax);
              if(response.res_is_login!='y'){
                Swal.fire({
                  type: 'error',
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
              }else{
                var unread_message=response.res_value;
                if(unread_message>0){
                  var notification_store_badge = document.getElementById("notification_store_badge");
                  notification_store_badge.style.display = "inline-block";
                  if(unread_message>99){
                    $('#notification_store_badge').text('99+');
                  }else if(unread_message==1){
                    $('#notification_store_badge').text(unread_message+'nbsp;');
                  }else{
                    $('#notification_store_badge').text(unread_message);
                  }
                }else{
                  var notification_store_badge = document.getElementById("notification_store_badge");
                  notification_store_badge.style.display = "hide";
                }
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }


        })
  }
</script>
