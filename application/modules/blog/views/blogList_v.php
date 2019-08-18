<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">STIL Blog</h2>
		</div>
	</div>


	<!-- Blog -->
	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-around postList">

						<?php foreach($blogList as $blogPost){
							$lastPostID=$blogPost['idpost'];
							$data['blogPost']=$blogPost;
									$this->load->view('template_blogList',$data);
							}
						?>
						<div class="col-12 col-lg-12" id="show_more_main<?php echo $lastPostID;?>">
                <div class="col-12 text-center">
                    <a href="javascript:void(0);" id="<?php echo $lastPostID;?>" class="btn uza-btn btn-3 show_more">Load More</a>
                </div>
                <div class="col-12 text-center">
                    <a href="javascript:void(0);" class="btn uza-btn btn-3 loading">Loading...</a>
                </div>
            </div>

					</div>
				</div>

			</div>
		</div>
	</div>
