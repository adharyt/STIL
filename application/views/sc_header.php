<?php
if($this->session->userdata('is_login')=='y'){
	$id_member=$this->session->userdata('user_id');

  $id_store=$this->storeModel->getStoreIdByUserId($id_member);

	$unread_message=$this->chatModel->getChatCountUnread($id_member);
	$unread_trans=$this->notificationModel->get_PopUpTransactionStore($id_member,'y');
	$unread_notif=$this->notificationModel->countNotificationStore($id_member);

}
 ?>
<style media="screen">
.notification-popup{
    top:45px;
  }
.arrow_box:after{
  left:82.5%;
}
.arrow_box:before{
  left:82.5%;
}
.arrow_box_trans {
    position: relative;
    background: white;
    border: 2px solid lightslategrey;
    border-radius: 6px;
    padding: 12px 0 12px 12px;
}
.arrow_box_trans:after, .arrow_box_trans:before {
    bottom: 100%;
    border: solid transparent;
    content: " ";
    left:67.5%;
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
}
.arrow_box_trans:before{
  border-color: rgba(194, 225, 245, 0);
  border-bottom-color: lightslategrey;
  border-width: 18px;
  margin-left: -18px;
}
.arrow_box_trans:after {
    border-color: rgba(136, 183, 213, 0);
    border-bottom-color: white;
    border-width: 15px;
    margin-left: -15px;
}


</style>
<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
function showNotificationStore(){
  $('#popupTransactionStore').hide();
  $('[data-toggle="tooltip"]').tooltip('hide');
  var popup = document.getElementById("popupNotificationStore");
  if (popup.style.display === "none") {
      popup.style.display = "block";
      $.ajax({
              url: "<?php echo base_url();?>sc_notification/getNotification",
              type: "post",
              data: {
                  valid:'valid'
              } ,
              success: function (response) {
                   $('#popupNotificationStoreContent').html(response);
                   $('#showAllNotificationStore').show();
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }


          })
  } else {
      popup.style.display = "none";
      $('#popupNotificationStoreContent').html('Loading....');
      $('#showAllNotificationStore').hide();
  }

}

function showNotificationTransStore(){
  $('#popupNotificationStore').hide();
  $('[data-toggle="tooltip"]').tooltip('hide');
  var popup = document.getElementById("popupTransactionStore");
  if (popup.style.display === "none") {
      popup.style.display = "block";
      $.ajax({
              url: "<?php echo base_url();?>Sc_notification/getTransNotification",
              type: "post",
              data: {
                  valid:'valid'
              } ,
              success: function (response) {
                   $('#popupTransactionStoreContent').html(response);
                   $('#showAllTransactionStore').show();
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }


          })
  } else {
      popup.style.display = "none";
      $('#popupTransactionContent').html('Loading....');
      $('#showAllTransaction').hide();
  }

}
</script>
<?php
$profilPenjual=$this->seller_centerModel->getStoreProfile($this->session->userdata('username'));
 ?>
<div class="row seller-center-title-container" style="padding:3px!important;padding-left:0px!important">
    <div class="row">
        <img class="logo-img" src="<?php echo base_url();?>assets/images/logoSeller.png" style="width:auto;height:65px">
    </div>
    <div class="seller-center-icon-header-container" >
      <div class="row" style="width:65px;margin-left:0px;margin-right:0px;">
        <div class="col" style="padding:0px">
          <a href="javascript:globalUserType=2;showChatModal();" data-toggle="tooltip" data-placement="bottom" title="Pesan">
            <i class="fa fa-fw fa-comment-dots icon-style"></i>
          </a>
        </div>
        <div class="col" style="padding:0px">
          <span id="chat_badge" class="badge badge-pill badge-danger " style="margin-left: -30px;margin-top: 12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:<?php if($unread_message>0){echo 'inline-block';}else{echo 'none';}?>">
            <?php if($unread_message>99){
              echo "99+";
            }else if($unread_message==1){
              echo $unread_message.'&nbsp;';
            }else{
              echo $unread_message;
            }
            ?>
          </span>
        </div>
      </div>


      <div class="row" style="width:65px;margin-left:0px;margin-right:0px;">
        <div class="col" style="padding:0px">
          <a href="javascript:void(0);" onClick="showNotificationTransStore();" data-toggle="tooltip" data-placement="bottom" title="Transaksi">
            <i class="fa fa-fw fa-exchange-alt icon-style"></i>
          </a>
        </div>
        <div class="col" style="padding:0px">
          <span class="badge badge-pill badge-danger " style="margin-left: -30px;margin-top: 12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:<?php if($unread_trans>0){echo 'inline-block';}else{echo 'none';}?>">
            <?php if($unread_trans>99){
              echo "99+";
            }else if($unread_trans==1){
              echo $unread_trans.'&nbsp;';
            }else{
              echo $unread_trans;
            }
            ?>
          </span>
        </div>
      </div>



      <!-- Transaction -->
      <div id="popupTransactionStore" class="notification-popup popUpHeader" style="display:none !important;width:425px">
        <div class="arrow_box_trans" id="popupTransactionStoreContent" style="padding:12px 10px 12px 10px;">
          Loading...
        </div>
      </div>

      <!-- Notifikasi -->
      <div id="popupNotificationStore" class="notification-popup popUpHeader" style="display:none !important;width:425px">
        <div class="arrow_box" id="popupNotificationStoreContent" style="padding:12px 10px 12px 10px;">
          Loading...
        </div>
      </div>

      <div class="row" style="width:65px;margin-left:0px;margin-right:0px;">
        <div class="col" style="padding:0px">
          <a href="javascript:void(0);" onClick="showNotificationStore();" data-toggle="tooltip" data-placement="bottom" title="Notifikasi">
            <i class="fa fa-fw fa-bell icon-style"></i>
          </a>
        </div>
        <div class="col" style="padding:0px">
          <span id="notification_store_badge" class="badge badge-pill badge-danger " style="margin-left: -30px;margin-top: 12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:<?php if($unread_notif>0){echo 'inline-block';}else{echo 'none';}?>">
            <?php if($unread_notif>99){
              echo "99+";
            }else if($unread_notif==1){
              echo $unread_notif.'&nbsp;';
            }else{
              echo $unread_notif;
            }
            ?>
          </span>
        </div>
      </div>



    <div class="row" style="width:65px;margin-left:0px;margin-right:0px;">
      <div class="col" style="padding:0px;margin-top:-2px">
        <a href="<?php echo base_url();?>" data-toggle="tooltip" data-placement="bottom" title="Halaman Pembeli">
          <i class="fa fa-fw fa-user icon-style"></i>
        </a>
      </div>
      <div class="col" style="padding:0px;">
        &nbsp;
      </div>
    </div>
    <div class="row" style="width:65px;margin-left:0px;margin-right:0px;">
      <div class="col" style="padding:0px;margin-top:-2px">
        <a href="<?php echo $this->config->item('landing_url_logout');?>" style="color:#099245">
          <div class="seller-center-profile-header-container">
            <i class="fa fa-sign-out-alt icon-style" aria-hidden="true"></i>
          </div>
        </a>
      </div>
      <div class="col" style="padding:0px">
        &nbsp;
      </div>
    </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
