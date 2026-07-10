<body>
			<div class="col-sm-9" style="margin-top:30px;">
					<center>

					<div id="pengaturan_toko_content" class="col-12 pr-5 text-left">
						<div style="background-color:white;padding:20px;padding-left:30px;padding-right:30px;" >
							<div class="row">
								<div class="col">
									<div class="title-text ml-0 mb-3">Notifikasi</div>
								</div>
								<div class="col text-right">
									<?php if(!isset($_GET['show_unread_only'])){$_GET['show_unread_only']="false";}?>
									<select onChange="location.href='<?php echo base_url();?>my-account/notification?page=1&show_unread_only='+this.value" class="form-control" style="width:250px;font-size:13px;height:30px;-webkit-appearance: menulist;margin-left:auto;margin-right:0" >
										<option value="false" <?php if($_GET['show_unread_only']!='true'){echo "selected";}?>>Tampilkan semua notifikasi</option>
										<option value="true" <?php if($_GET['show_unread_only']=='true'){echo "selected";}?>>Hanya tampilkan yang belum dibaca</option>
									</select>
								</div>
							</div>


					        <?php $this->load->view('template/popup/notificationTemplate');?>
									<div class="shop_page_nav d-flex flex-row align-items-center text-center justify-content-center" style="display:inline-block;margin-top:30px">
									  <?php if($page>1 && $page<=$pages){ ?>
									        <div onClick="location.href='<?php echo base_url();?>my-account/notification?page=<?php echo $page-1;echo $final_filter;?>'" class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
									  <?php } ?>

									  <ul class="page_nav d-flex flex-row">

									    <?php for($i=1;$i<=$pages;$i++){
									      if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $pages))
									       {
									          if (($lastLink == 1) && ($i != 2))  echo "<li style='cursor:no-drop'>...</li>";
									          if (($lastLink != ($pages - 1)) && ($i == $pages))  echo "<li style='cursor:no-drop'>...</li>";
									          ?>
									            <a href="<?php echo base_url();?>my-account/notification?page=<?php echo $i;echo $final_filter;?>" <?php if($page==$i){echo "style='color:white;cursor:no-drop;font-weight:500'";}else{echo "style='color:black;font-weight:500'";} ?>><li <?php if($page==$i){echo "class='paginationactive' style='cursor:no-drop'";} ?>><?php echo $i;?></li></a>
									          <?php
									          $lastLink=$i;
									       }

									     }?>


									  </ul>
									  <?php if($page>=1 && $page<$pages){ ?>
									        <div onClick="location.href='<?php echo base_url();?>my-account/notification?page=<?php echo $page+1;echo $final_filter;?>'" class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
									  <?php } ?>

									</div>
									<br>
					</div>
				</div>
				</center>
			<br>


		</div>
	</div>
</body>
