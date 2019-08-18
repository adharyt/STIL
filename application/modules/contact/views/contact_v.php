<!-- Contact Info -->

	<div class="contact_info">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="<?php echo base_url();?>assets/images/icon-img/phone.png" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Nomor Telepon</div>
								<div class="contact_info_text"><?php echo contact('telepon');?></div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="<?php echo base_url();?>assets/images/icon-img/mail.png" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Alamat Email</div>
								<div class="contact_info_text"><?php echo contact('email');?></div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="<?php echo base_url();?>assets/images/icon-img/location.png" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Alamat Kantor</div>
								<div class="contact_info_text">Jakarta Pusat, Indonesia</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact Form -->

	<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title">Hubungi Kami</div>


							<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
								<input type="text" name="contact_form_name"  id="contact_form_name" class="contact_form_name input_field" placeholder="Nama Lengkap" required="required" data-error="Name is required.">
								<input type="text" name="contact_form_email" id="contact_form_email" class="contact_form_email input_field" placeholder="Alamat Email" required="required" data-error="Email is required.">
								<input onkeypress="return number_only(event);" maxlength="15" type="text" name="contact_form_phone" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Nomor Telepon">
							</div>
							<div class="contact_form_text">
								<textarea name="contact_form_message" id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Pesan" required="required" data-error="Please, write us a message."></textarea>
							</div>
							<div class="contact_form_button">
								<button  class="button contact_submit_button" onClick="send();">Kirim Pesan</button>
							</div>

					</div>
				</div>
			</div>
		</div>
		<br><br><br>
	</div>

	<!-- Map -->

	<div class="contact_map">
		<div id="google_map" class="google_map">
			<div class="map_container">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4148139845283!2d106.81619931431008!3d-6.2088912625462775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4029ddcb01d%3A0x8c45c69b461fb15e!2sCitywalk+Sudirman!5e0!3m2!1sid!2sid!4v1563949945290!5m2!1sid!2sid" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
