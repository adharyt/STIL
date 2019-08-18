<?php
class blogModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getPost($slug){
    $sql = "SELECT *,p.id as idpost FROM blog_post as p inner join user_admin as u on p.author=u.id where slug='$slug' limit 1";
    return $this->db->query($sql)->result_array();
  }

  public function getPostList(){
    $sql = "SELECT *,p.id as idpost FROM blog_post as p  inner join user_admin as u on p.author=u.id order by datepost desc LIMIT 6";
    return $this->db->query($sql);
  }


  public function getSimilarPost($id,$category){
    $sql = "SELECT *,p.id as idpost FROM blog_post as p  inner join user_admin as u on p.author=u.id where category='$category' and p.id!='$id' order by datepost desc LIMIT 3";
    return $this->db->query($sql);
  }

  public function getPostCategory(){
    $sql = "SELECT category,count(category) as jumlah FROM blog_post group by category order by category asc";
    return $this->db->query($sql)->result_array();
  }

  public function getPostTag(){
    $sql = "SELECT tag FROM blog_post";
    return $this->db->query($sql)->result_array();
  }
}

?>
