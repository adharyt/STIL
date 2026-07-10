<!-- CSS styles -->
<link href="<?php echo base_url();?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<style>
.chat-modal-container {

}

.chat-modal-body-container {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 60%;
  top: 5px;
  position: fixed;
  min-height: 100vh;
  font-family: "Roboto", sans-serif;
  font-size: 1em;
  letter-spacing: 0.1px;
  color: #7ac39a;
  text-rendering: optimizeLegibility;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
  -webkit-font-smoothing: antialiased;
  z-index: 9999999;
}

#frame {
  border: 1px solid #989898;
  width: 95%;
  min-width: 360px;
  max-width: 1000px;
  height: 92vh;
  min-height: 300px;
  max-height: 720px;
  background: #E6EAEA;
}
@media screen and (max-width: 360px) {
  #frame {
    width: 100%;
    height: 100vh;
  }
}
#frame #sidepanel {
  float: left;
  min-width: 280px;
  max-width: 340px;
  width: 40%;
  height: 100%;
  background: #FFFFFF;
  color: #f5f5f5;
  overflow: hidden;
  position: relative;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel {
    width: 58px;
    min-width: 58px;
  }
}
#frame #sidepanel #profile {
  width: 80%;
  margin: 25px auto;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile {
    width: 100%;
    margin: 0 auto;
    padding: 5px 0 0 0;
    background: #7ac39a;
  }
}
#frame #sidepanel #profile.expanded .wrap {
  height: 210px;
  line-height: initial;
}
#frame #sidepanel #profile.expanded .wrap i.expand-button {
  -moz-transform: scaleY(-1);
  -o-transform: scaleY(-1);
  -webkit-transform: scaleY(-1);
  transform: scaleY(-1);
  filter: FlipH;
  -ms-filter: "FlipH";
}
#frame #sidepanel #profile .wrap {
  height: 60px;
  line-height: 60px;
  overflow: hidden;
  -moz-transition: 0.3s height ease;
  -o-transition: 0.3s height ease;
  -webkit-transition: 0.3s height ease;
  transition: 0.3s height ease;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap {
    height: 55px;
  }
}
#frame #sidepanel #profile .wrap img {
  width: 50px;
  border-radius: 50%;
  padding: 3px;
  border: 2px solid #e74c3c;
  height: auto;
  float: left;
  cursor: pointer;
  -moz-transition: 0.3s border ease;
  -o-transition: 0.3s border ease;
  -webkit-transition: 0.3s border ease;
  transition: 0.3s border ease;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap img {
    width: 40px;
    margin-left: 4px;
  }
}
#frame #sidepanel #profile .wrap img.online {
  border: 2px solid #2ecc71;
}
#frame #sidepanel #profile .wrap img.away {
  border: 2px solid #f1c40f;
}
#frame #sidepanel #profile .wrap img.busy {
  border: 2px solid #e74c3c;
}
#frame #sidepanel #profile .wrap img.offline {
  border: 2px solid #95a5a6;
}
#frame #sidepanel #profile .wrap p {
  float: left;
  margin-left: 15px;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap p {
    display: none;
  }
}
.expand-button {
  float: right;
  margin-top: 20px;
  font-size: 0.8em;
  color: #099245;
}
.expand-button:hover {
  cursor: pointer !important;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap i.expand-button {
    display: none;
  }
}
#frame #sidepanel #profile .wrap #status-options {
  position: absolute;
  opacity: 0;
  visibility: hidden;
  width: 150px;
  margin: 70px 0 0 0;
  border-radius: 6px;
  z-index: 99;
  line-height: initial;
  background: #099245;
  -moz-transition: 0.3s all ease;
  -o-transition: 0.3s all ease;
  -webkit-transition: 0.3s all ease;
  transition: 0.3s all ease;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options {
    width: 58px;
    margin-top: 57px;
  }
}
#frame #sidepanel #profile .wrap #status-options.active {
  opacity: 1;
  visibility: visible;
  margin: 75px 0 0 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options.active {
    margin-top: 62px;
  }
}
#frame #sidepanel #profile .wrap #status-options:before {
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-bottom: 8px solid #099245;
  margin: -8px 0 0 24px;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options:before {
    margin-left: 23px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul {
  overflow: hidden;
  border-radius: 6px;
}
#frame #sidepanel #profile .wrap #status-options ul li {
  padding: 15px 0 30px 18px;
  display: block;
  cursor: pointer;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li {
    padding: 15px 0 35px 22px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li:hover {
  background: #496886;
}
#frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
  position: absolute;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  margin: 5px 0 0 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
    width: 14px;
    height: 14px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
  content: '';
  position: absolute;
  width: 14px;
  height: 14px;
  margin: -3px 0 0 -3px;
  background: transparent;
  border-radius: 50%;
  z-index: 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
    height: 18px;
    width: 18px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li p {
  padding-left: 12px;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li p {
    display: none;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li#status-online span.status-circle {
  background: #2ecc71;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-online.active span.status-circle:before {
  border: 1px solid #2ecc71;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-away span.status-circle {
  background: #f1c40f;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-away.active span.status-circle:before {
  border: 1px solid #f1c40f;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-busy span.status-circle {
  background: #e74c3c;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-busy.active span.status-circle:before {
  border: 1px solid #e74c3c;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-offline span.status-circle {
  background: #95a5a6;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-offline.active span.status-circle:before {
  border: 1px solid #95a5a6;
}
#frame #sidepanel #profile .wrap #expanded {
  padding: 75px 0 0 0;
  display: block;
  line-height: initial !important;
}
#frame #sidepanel #profile .wrap #expanded label {
  float: left;
  clear: both;
  margin: 0 8px 5px 0;
  padding: 5px 0;
}
#frame #sidepanel #profile .wrap #expanded input {
  border: none;
  margin-bottom: 6px;
  background: #7ac39a;
  border-radius: 3px;
  color: #f5f5f5;
  padding: 7px;
  width: calc(100% - 43px);
}
#frame #sidepanel #profile .wrap #expanded input:focus {
  outline: none;
  background: #099245;
}
#frame #sidepanel #search {
  border-top: 2px solid #949494;
  border-bottom: 2px solid #949494;
  font-weight: 300;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #search {
    display: none;
  }
}
#frame #sidepanel #search label {
  position: absolute;
  margin: 10px 0 0 20px;
}
#frame #sidepanel #search input {
  font-family: 'Roboto', sans-serif;
  padding: 10px 0 10px 46px;
  width: 100%;
  border: none;
  background: #949494;
  color: #f5f5f5;
}
#frame #sidepanel #search input:focus {
  outline: none;
  background: #949494;
}
#frame #sidepanel #search input::-webkit-input-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #search input::-moz-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #search input:-ms-input-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #search input:-moz-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #contacts {
  height: calc(100% - 152px);
  overflow-y: scroll;
  overflow-x: hidden;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts {
    height: calc(100% - 149px);
    overflow-y: scroll;
    overflow-x: hidden;
  }
  #frame #sidepanel #contacts::-webkit-scrollbar {
    display: none;
  }
}
#frame #sidepanel #contacts.expanded {
  height: calc(100% - 334px);
}
#frame #sidepanel #contacts::-webkit-scrollbar {
  width: 1px;
  background: #989898;
}
#frame #sidepanel #contacts::-webkit-scrollbar-thumb {
  background-color: #243140;
}
#frame #sidepanel #contacts ul li.contact {
  position: relative;
  padding: 10px 0 15px 0;
  font-size: 0.9em;
  cursor: pointer;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact {
    padding: 6px 0 46px 8px;
  }
}
#frame #sidepanel #contacts ul li.contact:hover {
  background: #7ac39a;
}
#frame #sidepanel #contacts ul li.contact.active {
  background: #7ac39a;
  border-right: 5px solid #f28f16;
}
#frame #sidepanel #contacts ul li.contact.active span.contact-status {
  border: 2px solid #7ac39a !important;
}
#frame #sidepanel #contacts ul li.contact .wrap {
  width: 88%;
  margin: 0 auto;
  position: relative;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact .wrap {
    width: 100%;
  }
}
#frame #sidepanel #contacts ul li.contact .wrap span {
  position: absolute;
  left: 0;
  margin: -2px 0 0 -2px;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: 2px solid #2c3e50;
  background: #95a5a6;
}
#frame #sidepanel #contacts ul li.contact .wrap span.online {
  background: #2ecc71;
}
#frame #sidepanel #contacts ul li.contact .wrap span.away {
  background: #f1c40f;
}
#frame #sidepanel #contacts ul li.contact .wrap span.busy {
  background: #e74c3c;
}
#frame #sidepanel #contacts ul li.contact .wrap img {
  width: 40px;
  border-radius: 50%;
  float: left;
  margin-right: 10px;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact .wrap img {
    margin-right: 0px;
  }
}
#frame #sidepanel #contacts ul li.contact .wrap .meta {
  padding: 5px 0 0 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact .wrap .meta {
    display: none;
  }
}
#frame #sidepanel #contacts ul li.contact .wrap .meta .name {
  font-weight: 600;
}
#frame #sidepanel #contacts ul li.contact .wrap .meta .preview {
  margin: 5px 0 0 0;
  padding: 0 0 1px;
  font-weight: 400;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -moz-transition: 1s all ease;
  -o-transition: 1s all ease;
  -webkit-transition: 1s all ease;
  transition: 1s all ease;
}
#frame #sidepanel #contacts ul li.contact .wrap .meta .preview span {
  position: initial;
  border-radius: initial;
  background: none;
  border: none;
  padding: 0 2px 0 0;
  margin: 0 0 0 1px;
  opacity: .5;
}
#frame #sidepanel #bottom-bar {
  position: absolute;
  width: 100%;
  bottom: 0;
}
#frame #sidepanel #bottom-bar button {
  float: left;
  border: none;
  width: 50%;
  padding: 10px 0;
  background: #7ac39a;
  color: #f5f5f5;
  cursor: pointer;
  font-size: 0.85em;
  font-family: 'Roboto', sans-serif;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button {
    float: none;
    width: 100%;
    padding: 15px 0;
  }
}
#frame #sidepanel #bottom-bar button:focus {
  outline: none;
}
#frame #sidepanel #bottom-bar button:nth-child(1) {
  border-right: 1px solid #2c3e50;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button:nth-child(1) {
    border-right: none;
    border-bottom: 1px solid #2c3e50;
  }
}
#frame #sidepanel #bottom-bar button:hover {
  background: #099245;
}
#frame #sidepanel #bottom-bar button i {
  margin-right: 3px;
  font-size: 1em;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button i {
    font-size: 1.3em;
  }
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button span {
    display: none;
  }
}
#frame .content {
  float: right;
  width: 60%;
  height: 100%;
  overflow: hidden;
  position: relative;
}
@media screen and (max-width: 735px) {
  #frame .content {
    width: calc(100% - 58px);
    min-width: 300px !important;
  }
}
@media screen and (min-width: 900px) {
  #frame .content {
    width: calc(100% - 340px);
  }
}
#frame .content .contact-profile {
  width: 100%;
  height: 60px;
  line-height: 60px;
  background: #f5f5f5;
}
#frame .content .contact-profile img {
  width: 40px;
  border-radius: 50%;
  float: left;
  margin: 9px 12px 0 9px;
}
#frame .content .contact-profile p {
  float: left;
}
#frame .content .contact-profile .social-media {
  float: right;
}
#frame .content .contact-profile .social-media i {
  margin-left: 14px;
  cursor: pointer;
  font-size: 1.6rem;
}
#frame .content .contact-profile .social-media i:nth-last-child(1) {
  margin-right: 20px;
}
#frame .content .contact-profile .social-media i:hover {
  color: #099245;
}
#frame .content .messages {
  height: auto;
  min-height: calc(100% - 93px);
  max-height: calc(100% - 93px);
  overflow-y: scroll;
  overflow-x: hidden;
}
@media screen and (max-width: 735px) {
  #frame .content .messages {
    max-height: calc(100% - 105px);
  }
}
#frame .content .messages::-webkit-scrollbar {
  width: 8px;
  background: transparent;
}
#frame .content .messages::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3);
}
#frame .content .messages ul li {
  display: inline-block;
  clear: both;
  float: left;
  margin: 15px 15px 5px 15px;
  width: calc(100% - 25px);
  font-size: 0.9em;
}
#frame .content .messages ul li:nth-last-child(1) {
  margin-bottom: 20px;
}
#frame .content .messages ul li.sent img {
  margin: 6px 8px 0 0;
}
#frame .content .messages ul li.sent p {
  background: #099245;
  color: #f5f5f5;
}
#frame .content .messages ul li.replies img {
  float: right;
  margin: 6px 0 0 8px;
}
#frame .content .messages ul li.replies p {
  background: #f5f5f5;
  float: right;
}
#frame .content .messages ul li img {
  width: 22px;
  border-radius: 50%;
  float: left;
}
#frame .content .messages ul li p {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 10px;
  max-width: 205px;
  line-height: 130%;
}
@media screen and (min-width: 735px) {
  #frame .content .messages ul li p {
    max-width: 300px;
  }
}
#frame .content .message-input {
  position: absolute;
  bottom: 0;
  width: 100%;
  z-index: 99;
}
#frame .content .message-input .wrap {
  position: relative;
}
#frame .content .message-input .wrap input {
  font-family: 'Roboto', sans-serif;
  float: left;
  border: none;
  width: calc(100% - 52px);
  height: 45px;
  padding: 11px 32px 10px 8px;
  font-size: 0.9em;
  color: #7ac39a;
}
@media screen and (max-width: 735px) {
  #frame .content .message-input .wrap input {
    padding: 15px 32px 16px 8px;
  }
}
#frame .content .message-input .wrap input:focus {
  outline: none;
}
#frame .content .message-input .wrap .attachment {
  position: absolute;
  right: 60px;
  z-index: 4;
  margin-top: 10px;
  font-size: 1.1em;
  color: #099245;
  opacity: .5;
  cursor: pointer;
}
@media screen and (max-width: 735px) {
  #frame .content .message-input .wrap .attachment {
    margin-top: 17px;
    right: 65px;
  }
}
#frame .content .message-input .wrap .attachment:hover {
  opacity: 1;
}
#frame .content .message-input .wrap button {
  float: right;
  border: none;
  width: 50px;
  padding: 12px 0;
  cursor: pointer;
  background: #099245;
  color: #f5f5f5;
}
@media screen and (max-width: 735px) {
  #frame .content .message-input .wrap button {
    padding: 16px 0;
  }
}
#frame .content .message-input .wrap button:hover {
  background: #099245;
}
#frame .content .message-input .wrap button:focus {
  outline: none;
}
.btn-circle {
  text-align: center;
  padding: 0;
  border-radius: 50%;
  position: fixed;
	bottom:40px;
	right:40px;
  z-index: 99999;
}

.btn-circle:hover {
   transform: scale(1.2);
   cursor: pointer;
}

.btn-circle:focus {
  outline: none;
  border: none;
}

.btn-circle i {
  position: relative;
  top: -1px;
}

.btn-circle-sm {
  width: 35px;
  height: 35px;
  line-height: 35px;
  font-size: 0.9rem;
}

.btn-circle-lg {
  width: 55px;
  height: 55px;
  line-height: 55px;
  font-size: 1.1rem;
}
#chatModal {
  display: none;
}
.talk-to-name-container {
  display: inline-block;
  vertical-align: middle;
}
.talk-to-name {
  font-family: "Roboto", sans-serif;
  font-weight: bold;
  font-size: 1em;
  letter-spacing: 0.1px;
  margin-bottom: 0px !important;
}
.my-name {
  font-family: "Roboto", sans-serif;
  font-size: 1.15em;
  font-weight: bold;
  letter-spacing: 0.1px;
  margin-top: 14px;
  margin-left: 12px;
  margin-bottom: 0px !important;
}
.chat-room-container {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.name {
  font-size: 1.1em !important;
  margin-bottom: 0px !important;
}
.preview {
  margin: 0px !important;
  font-size: 0.95em !important;
}
.img-profile-chat-room {
  width: 40px !important;
  height: 40px !important;
  border-radius: 50%;
}
.img-profile {
  width: 52px !important;
  height: 52px !important;
}
#btn-dropdown {
  z-index: 9999999;
  cursor: pointer;
  align-self: start;
}
#profile.expanded #btn-dropdown {
  margin-top: 20px;
}
.chat-account-name {
  margin-left: 16px;
  margin-top: 10px;
}
.chat-account-name-container {
  display: flex;
  flex-direction: row;
}
.wrap:hover{
  cursor: pointer;
}
.expanded-container{
  display: flex;
  flex-direction: column;
}
.chat-switch-account-container {
  display: flex;
  flex-direction: row;
  background-color: #7ac39a;
  padding: 10px 10px 0 10px;
  margin-bottom: 10px;
  z-index: 2147483637;
}
.chat-account-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  height: 60px;
  line-height: 60px;
  overflow: hidden;
  -moz-transition: 0.3s height ease;
  -o-transition: 0.3s height ease;
  -webkit-transition: 0.3s height ease;
  transition: 0.3s height ease;
}
#profile.expended {
  height: 210px;
  line-height: initial;
}
.chat-account-container img {
  width: 50px;
  border-radius: 50%;
  padding: 3px;
  height: auto;
  float: left;
  -moz-transition: 0.3s border ease;
  -o-transition: 0.3s border ease;
  -webkit-transition: 0.3s border ease;
  transition: 0.3s border ease;
}
.dropdown-activated {
  -moz-transform: scaleY(-1);
  -o-transform: scaleY(-1);
  -webkit-transform: scaleY(-1);
  transform: scaleY(-1);
  filter: FlipH;
  -ms-filter: "FlipH";
  margin-bottom: : 40px !important;
}
.chat-switch-acc {
  display: none;
  transition: 0.3s height ease;
}
.chat-notif-icon {
  height: fit-content;
}
.chat-switch-account-container:hover{
  cursor: pointer;
  background-color: #46586a;
}
.cht-cnt {
  display: flex;
  flex-direction: row;
}
.chat-room-container {
display: flex;
 flex-direction: row;
 align-items: center;
Justify-content: space-between;
}

</style>

<div id="chatModal" class="chat-modal-container">
  <div  class="chat-modal-body-container">
    <div id="frame">
      <div id="sidepanel">
        <div id="profile">
          <div class="chat-account-container">
            <div class="cht-cnt">
              <img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="img-profile" alt="" />
              <p class="my-name">Mike Ross</p>
            </div>
            <i id="btn-dropdown" onclick="toggleSwitchAccount();"class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
          </div>
            <!-- <div id="status-options">
              <ul>
                <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
                <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
              </ul>
            </div> -->
          <div id="chat-expanded" class="chat-switch-acc">
            <ul class="expanded-container">
              <li id="switch-as-user" class="chat-switch-account-container">
                <img id="photo-profile-user" src="http://emilcarlsson.se/assets/mikeross.png" alt="" class="img-profile-chat-room" />
                <p id="chatAccountUserName" class="chat-account-name">AMER BARKOWI</p>
                <span id="chatNotification" class="badge badge-pill badge-danger chat-notif-icon">10</span>
              </li>
              <li id="switch-as-store" class="chat-switch-account-container">
                <img id="photo-profile-store" src="http://emilcarlsson.se/assets/mikeross.png" alt="" class="img-profile-chat-room" />
                <p id="chatAccountStoreName" class="chat-account-name">AMER BARKOWI</p>
                <span id="chatNotification" class="badge badge-pill badge-danger chat-notif-icon">10</span>
              </li>
            </ul>
            <!-- <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="mikeross" />
            <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="ross81" />
            <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="mike.ross" /> -->
          </div>
        </div>
        <div id="search">
          <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
          <input id="search_contact" type="text" placeholder="Search contacts..." />
        </div>
        <div id="contacts">
          <ul>
            <!-- Chat Would Append here -->
          </ul>
        </div>
        <!-- <div id="bottom-bar">
          <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
          <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
        </div> -->
      </div>
      <div class="content" id="content_available" style="display:none">
        <div class="contact-profile">
          <img id="contactProfile" src="" alt="" />
          <div class="talk-to-name-container">
            <p class="talk-to-name">-</p>
          </div>
          <div class="social-media">
            <!-- <i class="fa fa-facebook" aria-hidden="true"></i>
            <i class="fa fa-twitter" aria-hidden="true"></i> -->
            <div class="">
              <i class="fa fa-times" aria-hidden="true" onclick="closeChatModal();"></i>
            </div>
          </div>
        </div>
        <div class="messages">
          <ul>
          </ul>
        </div>
        <div class="message-input">
          <div class="wrap">
          <input type="text" placeholder="Write your message..." />
          <!-- <i class="fa fa-paperclip attachment" aria-hidden="true"></i> -->
          <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
      <div class="content" id="content_not_available">
        <div class="contact-profile">
          <img id="contactProfile" src="" alt="" />
          <div class="talk-to-name-container">
            <p class="talk-to-name">-</p>
          </div>
          <div class="social-media">
            <!-- <i class="fa fa-facebook" aria-hidden="true"></i>
            <i class="fa fa-twitter" aria-hidden="true"></i> -->
            <div class="">
              <i class="fa fa-times" aria-hidden="true" onclick="closeChatModal();"></i>
            </div>
          </div>
        </div>
        <div class="messages">
          <ul>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chat Button -->
<div class="btn-chat-container">
  <button id="btnChat" class="btn btn-success btn-circle btn-circle-lg m-1" onclick="showChatModal();"><i class="fa fa-comment"></i></button>
</div>

<!-- javascript -->
<script src="http://localhost/stil/assets/js/jquery-3.3.1.min.js"></script>
<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script type="text/javascript">


$("#search_contact").on("keyup", function() {
  var count=0;
  var value = $(this).val().toLowerCase();
  $(".contact .chat-room-container .meta .name").filter(function() {
    if($(this).text().toLowerCase().indexOf(value) > -1){
        count++;
    }
    $(this).parent().parent().parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //console.log(count);

    if (count>0) {
      $('#search_none').hide();
    } else {
      $('#search_none').show();
    }
  });
});

function filterContent() {
  // get word from value of clicked button.
  var word = this.value;

  // filter while toggling and count result.
  var hasMatches = $items
    .filter(toggleItem(word))
    .length;

  // if no matches, show message.
  $none.toggle(!hasMatches);

}
</script>
<script>
  var count = 0;
  var globalId;
  var globalStoreId;
  var globalUserId;
  var globalUserType = "1"; // 1 for User | 2 for Store
  var globalUserPhoto= "<?php echo $this->userModel->getPhoto($this->session->userdata('username'),$this->session->userdata('photo'),$this->session->userdata('gender')); ?>";
  var globalStorePhoto= "<?php echo $this->storeModel->getStorePhoto($this->session->userdata('username'),'');?>";
  var globalChattersPhoto="";
  var globalLastChatID="";
  var globalCurrentRoomID="";
  var globalLastChatRoomUpdated="";

  //create a new WebSocket object.
  //var msgBox = $('#message-box');
  var wsUri = "ws://localhost:9000/demo/server.php";
  websocket = new WebSocket(wsUri);

  websocket.onopen = function(ev) { // connection is open
  	console.log("Connected"); //notify user
  }
  // Message received from server
  websocket.onmessage = function(ev) {

    if(globalUserType=="1"){
      getChatRoom(<?php echo $this->session->userdata('user_id');?>, globalUserType);
    }else{
      getStoreId();
    }

  	var response = JSON.parse(ev.data); //PHP sends Json data
    globalLastChatRoomUpdated=response.room_id;
    //console.log(response);
  	var res_type = response.type; //message type

    //console.log("respon "+res_type);
    //console.log("globalUserType "+globalUserType);
  	var user_message = response.message; //message text
  	var user_name = response.name; //user name
  	var user_img = ""; //image

        if(res_type==1 && globalUserType==1){
          pht=globalUserPhoto;
          cls="sent";
        }else if(res_type==2 && globalUserType==2){
          pht=globalStorePhoto;
          cls="sent";
        }else if(res_type==1 && globalUserType==2){
          pht=globalChattersPhoto;
          cls="replies";
        }else if(res_type==2 && globalUserType==1){
          pht=globalChattersPhoto;
          cls="replies";
        }
        $('<li class="'+cls+'"><img src="'+pht+'" alt="" /><p style="word-break: break-word;">' + user_message + '</p></li>').prependTo($('.messages ul'));
        //$('#previewChat'+ globalStoreId).html('<span>You: </span>' + user_message);
        //$(".messages").animate({ scrollTop: 999999 }, "fast");


  	//msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message

  };

  websocket.onerror	= console.log("Connection Error");
  websocket.onclose = console.log("Connection Closed");

//$(".messages").animate({ scrollTop: 999999 }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});



$("#btn-dropdown").click(function() {
  $("#profile").addClass("expanded");
	$("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");

	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};

	$("#status-options").removeClass("active");
});

$("#switch-as-user").click(function() {
  globalLastChatID="";
  setUserType("1");
  getChatRoom(<?php echo $this->session->userdata('user_id');?>, globalUserType);
});

$("#switch-as-store").click(function() {
  globalLastChatID="";
  setUserType("2");
  getStoreId();
});

function toggleSwitchAccount() {
  $("#chat-expanded").toggle();
  $("#btn-dropdown").toggleClass("dropdown-activated");
}

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});

function showChatModal() {
  var chatBtn = document.getElementById("btnChat");
  var chatModal = document.getElementById("chatModal");

  if(count < 1) {
    chatModal.style.display = "block";
    btnChat.style.display = "none";
    getChatRoom(<?php echo $this->session->userdata('user_id');?>, globalUserType);
    count++;
  }
}

function closeChatModal() {
  var chatBtn = document.getElementById("btnChat");
  var chatModal = document.getElementById("chatModal");

  if(count != 0) {
    chatModal.style.display = "none";
    chatBtn.style.display = "block";
    count = 0;
  }
}

function setUserType(userType) {
  globalUserType = userType;
}

function getProfileName() {
  $('#chatAccountUserName').html("<?php echo  $this->stringModel->trimString($this->session->userdata('name'), 23, "...")?>");
  $('#chatAccountStoreName').html("<?php echo  $this->stringModel->trimString($this->session->userdata('name'), 23, "...")?>");
}

function getStoreId() {
  $.ajax({
    url: "<?php echo base_url();?>chat/getStoreId",
    type: "get",
    data: {
    },
    success: function (response) {
      globalStoreId = response;
      getChatRoom(response, globalUserType);
    },
    error: function(jqXHR, textStatus, errorThrown) {
       console.log(textStatus, errorThrown);
    }
  });
}

function getChatRoom(id, globalUserType) {

  $.ajax({
    url: "<?php echo base_url();?>chat/getChatRoom",
    type: "post",
    data: {
      id: id,
      type: globalUserType
    },
    success: function (response) {
      //console.log(response);
      var result = JSON.parse(response);
      //console.log(result);
      var i = 0;
      if(result.response == "SUCCESS" && result.data[0].id!='' && result.data[0].id!=0 && 1>0) {
        globalStoreId = result.data[0].id;
        $('#contacts ul').html('');

        var photoStore = result.photoProfileStore;
        var photoUser = result.photoProfileUser;

        if(globalUserType == "1") {
          $('#profile-img').attr("src", photoUser);
          $('.my-name').html("<?php echo  $this->stringModel->trimString($this->session->userdata('name'), 23, "...")?>");
        } else {
          $('#profile-img').attr("src", photoStore);
          $('.my-name').html(result.name);
        }
        $('#chatAccountUserName').html("<?php echo  $this->stringModel->trimString($this->session->userdata('name'), 23, "...")?>");
        $('#photo-profile-user').attr("src", photoUser);
        $('#chatAccountStoreName').html(result.name);
        $('#photo-profile-store').attr("src", photoStore);


        for(i; i < result.data.length; i++) {
          var chatName = result.data[i].name;
          var id = result.data[i].id;
          var id_room = result.data[i].id_room;
          var chatPhoto = result.photo[i];
          var lastChat = result.data[i].message;
          var senderType = result.data[i].sender_type;
          var lastChatLup = result.data[i].last_chat;
          var msg_unread = result.data[i].total_unread;
          console.log(globalCurrentRoomID+' '+id_room);
          if(globalCurrentRoomID==id_room){
            msg_unread=0;
          }

          if(parseInt(msg_unread)>0){
            var msg_unread_prop='<div style="font-size:0.8rem;padding-top:5px;padding-bottom:5px;" class="badge badge-pill badge-success chat-notif-icon" id="msg_unread'+id+'">'+msg_unread+'</div>';
          }else{
            var msg_unread_prop='';
          }

          if(chatName.length>=18){
            var chatNameRoom=chatName.substring(0,15)+'...';
          }else{
            var chatNameRoom=chatName;
          }

          if(lastChat.length>=14){
            var lastChatRoom=lastChat.substring(0,11)+'...';
          }else{
            var lastChatRoom=lastChat;
          }

          if (lastChat != null) {
                      if(senderType == globalUserType) {
                        $('#contacts ul').append('<li class="contact" cr_id="'+id+'" onclick="getMessage('+ id +')">'+
                          '<div class="wrap chat-room-container">'+
                            '<div style="display:flex;flex-direction:row;">'+
                              //'<span class="contact-status online"></span>'+
                              '<img src="'+ chatPhoto +'" alt="" class="img-profile-chat-room" />'+
                              '<div class="meta">'+
                                '<p class="name">' + chatNameRoom + '</p>'+
                                '<p id="previewChat'+ id +'" class="preview">'+
                                  '<span>You: </span>'+ lastChatRoom +
                                '</p>'+
                              '</div>'+
                            '</div>'+
                            '<div style="text-align:end">'+
                              '<div style="font-size:0.7rem; margin-bottom:5px;">'+lastChatLup+'</div>'+
                              '<div style="font-size:0.8rem;padding-top:5px;padding-bottom:5px">&nbsp;</div>'+
                            '</div>'+
                          '</div></li>');
                      } else {
                        $('#contacts ul').append('<li class="contact" cr_id="'+id+'" onclick="getMessage('+ id +')">'+
                          '<div class="wrap chat-room-container">'+
                            '<div style="display:flex;flex-direction:row;">'+
                              //'<span class="contact-status online"></span>'+
                              '<img src="'+ chatPhoto +'" alt="" class="img-profile-chat-room" />'+
                              '<div class="meta">'+
                                '<p class="name">' + chatNameRoom + '</p>'+
                                '<p id="previewChat'+ id +'" class="preview">'+
                                  lastChatRoom +
                                '</p>'+
                              '</div>'+
                            '</div>'+
                            '<div style="text-align:end">'+
                              '<div style="font-size:0.7rem; margin-bottom:5px;">'+lastChatLup+'</div>'+
                              msg_unread_prop+
                            '</div>'+
                          '</div></li>');
                      }
                    } else {
                      $('#contacts ul').append('<li class="contact" cr_id="'+id+'" onclick="getMessage('+ id +')">'+
                        '<div class="wrap chat-room-container">'+
                          '<div style="display:flex;flex-direction:row;">'+
                            //'<span class="contact-status online"></span>'+
                            '<img src="'+ chatPhoto +'" alt="" class="img-profile-chat-room" />'+
                            '<div class="meta">'+
                              '<p class="name">' + chatNameRoom+ '</p>'+
                              '<p id="previewChat'+ id +'" class="preview">'+
                                '<span></span>' +
                              '</p>'+
                            '</div>'+
                          '</div>'+
                          '<div style="text-align:end">'+
                            '<div style="font-size:0.7rem; margin-bottom:5px;">'+lastChatLup+'</div>'+
                            msg_unread_prop+
                          '</div>'+
                        '</div></li>');
                    }


        }
        $('<div class="contact" id="search_none" style="padding:20px;display:none"><div class="wrap chat-room-container">Kontak tidak ditemukan</div></div>').appendTo($('#contacts ul'));

        //console.log(globalLastChatID+'glcid '+globalCurrentRoomID+'gcrid '+globalLastChatRoomUpdated);



        if(globalLastChatID!=""){

          if(globalCurrentRoomID==globalLastChatRoomUpdated){
            getMessage(globalLastChatID);
          }else{
            $(".contact").removeClass("active");
            $('.contact[cr_id='+globalLastChatID+']').addClass("active");
          }

        }else{
          if(globalCurrentRoomID==globalLastChatRoomUpdated || globalLastChatRoomUpdated==''){
            getMessage(result.data[0].id);
            globalLastChatID=result.data[0].id;
          }else{
            $(".contact").removeClass("active");
            $('.contact[cr_id='+result.data[0].id+']').addClass("active");
          }

        }

        $('#content_available').show();
        $('#content_not_available').hide();

      } else {
        $('#contacts ul').html('');
        if(globalUserType == "1") {
          var photo = globalUserPhoto;
          $('#profile-img').attr("src", photo);
          $('.my-name').html("<?php echo  $this->stringModel->trimString($this->session->userdata('name'), 23, "...")?>");
          $('#chatAccountUserName').html("<?php echo  $this->stringModel->trimString($this->session->userdata('name'), 23, "...")?>");
          $('#chatAccountStoreName').html(result.name);

        } else {
          var photo = result.photoProfile;
          $('#profile-img').attr("src", photo);
          $('.my-name').html(result.name);
          $('#chatAccountUserName').html("<?php echo  $this->stringModel->trimString($this->session->userdata('name'), 23, "...")?>");
          $('#chatAccountStoreName').html(result.name);
        }

        $('#content_available').hide();
        $('#content_not_available').show();
        $('<div class="contact" id="search_none" style="padding:20px;display:block"><div class="wrap chat-room-container">Anda belum memiliki obrolan</div></div>').appendTo($('#contacts ul'));
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
       console.log(textStatus, errorThrown);
    }
  });
}

function getMessage(id) {
  $('#msg_unread'+id).text('');
  $(".message-input input").val('');
  globalLastChatID=id;
  $(".contact").removeClass("active");
  $('.contact[cr_id='+globalLastChatID+']').addClass("active");


  globalId = id;
  $.ajax({
    url: "<?php echo base_url();?>chat/getMessage",
    type: "post",
    data: {
        id: id,
        type: globalUserType
    },
    success: function (response) {
      //console.log(response);
      var result = JSON.parse(response);
      var name;
      var photo;
      //console.log(result);
      globalChattersPhoto=result.photo;
      if(result.response == "EMPTY CHAT") {
        name = result.profileResult[0].name;
        photo = result.photo;

        $('.talk-to-name').html(name);
        $('#contactProfile').attr("src",photo);
        $('.messages ul').html('');
      } else {
        var i = 0;
        name = result.profileResult[0].name;
        globalCurrentRoomID=result.profileResult[0].id;
        console.log('a'+globalCurrentRoomID);
        photo = result.photo;


        $('.talk-to-name').html(name);
        $('#contactProfile').attr("src",photo);
        $('.messages ul').html('');

        for(i; i < result.chatResult.length; i++) {
          var user_message = result.chatResult[i].message;
          var lup = result.chatResult[i].lups;
          var type = result.chatResult[i].type;

          if(globalUserType == type) {
            if(globalUserType==1){
              pht=globalUserPhoto;
            }else{
              pht=globalStorePhoto;
            }
            $('<li class="sent"><img src="'+pht+'" alt="" /><p style="word-break: break-word;">' + user_message + '<br><sub>'+lup+'</sub></p></li>').prependTo($('.messages ul'));
            //$('#previewChat'+ globalStoreId).html('<span>You: </span>' + user_message);
          } else {
            $('<li class="replies"><img src="'+photo+'" alt="" /><p style="word-break: break-word;">' + user_message + '<br><sub>'+lup+'</sub></p></li>').prependTo($('.messages ul'));
            //$('#previewChat'+ globalUserId).html(user_message);
          }
        }


          $(".messages").animate({ scrollTop: 999999 }, "fast");

      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
       //console.log(textStatus, errorThrown);
    }
  });
}

function newMessage() {
	var message = $(".message-input input").val();

  if($.trim(message) == '') {
		return false;
	}

  var payload = {
    room_id:globalCurrentRoomID,
    message: message,
    id: globalId,
    type: globalUserType
  };

  $.ajax({
    url: "<?php echo base_url();?>chat/insertNewMessage",
    type: "post",
    data: {
      room_id:globalCurrentRoomID,
      message: message,
      id: globalId,
      type: globalUserType
    },
    success: function (response) {
      //console.log(response);
      if(response != "FAILED") {
        //convert and send data to server
        //globalLastChatRoomUpdated=response;
        websocket.send(JSON.stringify(payload));
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
       //console.log(textStatus, errorThrown);
    }
  });

  $('.message-input input').val(null);
};
</script>
