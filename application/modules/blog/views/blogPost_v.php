<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url();?>assets/images/blog-img/thumbnail/<?php echo $blogPost['thumbnail'];?>" data-speed="0.8"></div>
	</div>

	<!-- Single Blog Post -->

	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<h5 style="color:#707070">
						<i class="fas fa-user"></i> <?php echo $blogPost['name'];?>&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fas fa-calendar-alt"></i> <?php echo $this->timeModel->get_TanggalIndo($blogPost['datepost']); ?>&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fas fa-eye"></i> Dibaca sebanyak <?php echo $blogPost['hit'];?> kali
					</h5>
					<div class="single_post_title"><?php echo $blogPost['title'];?></div>
					<div class="single_post_text">
							<?php echo $blogPost['content'];?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blog Posts -->

	<?php if(count($similarPost)>0){ ?>
	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<h3 class="text-center">Artikel yang berkaitan:</h3>
					<br>
					<div class="blog_posts d-flex flex-row align-items-start justify-content-around">
						<?php foreach($similarPost as $blogPost){
									$lastPostID=$blogPost['idpost'];
									$data['blogPost']=$blogPost;
											$this->load->view('template_blogList',$data);
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else{ echo "<br><br><br>";}?>
