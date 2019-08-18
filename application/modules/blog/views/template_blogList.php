<div class="blog_post">
  <div class="blog_image" style="background-image:url(<?php echo base_url();?>assets/images/blog-img/thumbnail/<?php echo $blogPost['thumbnail']; ?>)"></div>
  <div class="blog_info"><i class="fas fa-calendar-alt"></i> <?php echo $this->timeModel->get_TanggalIndo($blogPost['datepost']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-eye"></i> Dibaca sebanyak <?php echo $blogPost['hit'];?> kali</div>
  <div class="blog_text"><?php echo $blogPost['title']; ?></div>
  <div class="blog_button"><a href="<?php echo base_url().'blog/post/'.$blogPost['slug'];?>">Lanjutkan Membaca</a></div>
</div>
<?php
if(isset($append) && $nowDt==$ttlDt){
  if($totalRowCount > $showLimit ){ ?>
    <div class="col-12 col-lg-12" id="show_more_main<?php echo $lastPostID;?>">
        <div class="col-12 text-center">
            <a href="javascript:void(0);" id="<?php echo $lastPostID;?>" class="btn uza-btn btn-3 show_more">Load More</a>
        </div>
        <div class="col-12 text-center">
            <a href="javascript:void(0);" class="btn uza-btn btn-3 loading">Loading...</a>
        </div>
    </div>
  <?php }else{ ?>
    <div class="col-12 col-lg-12">
        <div class="col-12 text-center">
            <p>You're reaching the first post.</p>
        </div>
    </div>
<?php
  }
}
?>
