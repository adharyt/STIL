<?php
class productModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getProducts(){
    $sql = "SELECT
    p.*,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.is_deleted as product_availability,
    s.id as store_id,
    s.store_name,
    s.store_notes,
    s.store_city,
    u.username as store_link,
    u.photo
    FROM user_client as u
    LEFT JOIN product as p on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user
    where s.is_store_active='1'
    and p.is_visibility=1
    and p.is_deleted=0
    limit 10";
    return $this->db->query($sql);
  }

  public function getProductDetail($store_id,$slug){
    $sql = "SELECT
    p.*,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.last_updated as product_lastupdated,
    p.is_deleted as product_availability,
    s.id as store_id,
    s.store_name,
    s.store_notes,
    s.store_notes,
    s.store_city,
    s.store_lastdelivery,
    s.store_processtime_id,
    s.store_processtime_instan,
    s.store_processtime_preorder,
    s.store_lup_active,
    u.username as store_link,
    u.photo,
    u.gender
    FROM user_client as u
    LEFT JOIN product as p on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user
    where u.username='$store_id'
    and concat(p.pr_slug,'-',p.pr_uniq)='$slug'
    and s.is_store_active='1'
    limit 1";
    return $this->db->query($sql);
  }

  public function getProductImage($product_id){
    $sql = "SELECT img_url,is_selected
    FROM product_image
    where id_product='$product_id'
    and is_deleted=0
    ORDER BY is_selected desc";

    $cek_img=$this->db->query($sql)->num_rows();
    if($cek_img>0){
      return $this->db->query($sql)->result_array();
    }else{
      //Jika gambar tidak ada
      $data_img=[
        ["img_url"=>"image-not-available.png","is_selected"=>1]
      ];
      return $data_img;
    }
  }

  public function getFeedback($store_id,$vibes){
    switch($vibes){
      case 'positive':
          $sql = "SELECT
                  f.*,
                  f.id as feedback_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  FROM response_storefeedback as f
                  INNER JOIN user_client as u on f.id_user=u.id
                  where f.id_store='$store_id'
                  and u.is_active=1
                  and u.is_deleted=0
                  and f.is_visibility=1
                  and f.response=1
                  ORDER BY lup desc";
          break;
      case 'negative':
          $sql = "SELECT
                  f.*,
                  f.id as feedback_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  FROM response_storefeedback as f
                  INNER JOIN user_client as u on f.id_user=u.id
                  where f.id_store='$store_id'
                  and u.is_active=1
                  and u.is_deleted=0
                  and f.is_visibility=1
                  and f.response=0
                  ORDER BY lup desc";
          break;
      default:
          $sql = "SELECT
                  f.*,
                  f.id as feedback_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  FROM response_storefeedback as f
                  INNER JOIN user_client as u on f.id_user=u.id
                  where f.id_store='$store_id'
                  and u.is_active=1
                  and u.is_deleted=0
                  and f.is_visibility=1
                  ORDER BY lup desc";
          break;
    }
    return $this->db->query($sql);
  }

  public function getReview($product_id,$vibes){
    $parameter="
      FROM response_productreview as r
      INNER JOIN user_client as u on r.id_user=u.id
      where r.id_product='$product_id'
      and u.is_active=1
      and u.is_deleted=0
      and r.is_visibility=1
    ";
    switch($vibes){
      case 'count':
          $sql = "SELECT
                  r.*,
                  r.id as review_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  $parameter";
          return $this->db->query($sql)->num_rows();
          break;
      case 'average':
          $sql = "SELECT
                  avg(rating) as avgRating
                  $parameter";
          $avg=$this->db->query($sql)->result_array()[0]['avgRating'];
          if(is_null($avg)){
            $avg=0;
          }
          return $avg;
          break;
      case 'data':
          $sql = "SELECT
                  r.*,
                  r.id as review_id,
                  u.username as user_username,
                  u.name as user_name,
                  u.photo as user_photo
                  $parameter
                  ORDER BY r.lup desc";
          return $this->db->query($sql)->result_array();
          break;
      default:
          $sql = "SELECT rating, count(r.id) as count
                  $parameter
                  group by rating
                  ";

          $ratingAvail=$this->db->query($sql)->result_array();
          $dataTemp=[
            ["rating"=>"1","count"=>"0"],
            ["rating"=>"2","count"=>"0"],
            ["rating"=>"3","count"=>"0"],
            ["rating"=>"4","count"=>"0"],
            ["rating"=>"5","count"=>"0"]
          ];

          if(!is_null($ratingAvail)){
            foreach($ratingAvail as $rating){
              $index=$rating['rating']-1;
              $dataTemp[$index]['count']=$rating['count'];
            }
          }
          return $dataTemp;
          break;
    }
  }


  public function newProduct_submit($data){
    $insert=$this->db->insert('product', $data);
    if($insert){
      return "OK";
    }else{
      return "FALSE";
    }
  }

  public function newProductImage_submit($data){
    $insert=$this->db->insert('product_image', $data);
    if($insert){
      return "OK";
    }else{
      return "FALSE";
    }
  }

  public function getStoreDefaultConf($store_id){
    $sql = "SELECT
    s.store_processtime_id,
    s.store_processtime_instan,
    s.store_processtime_preorder,
    s.store_lup_active,
    u.username as store_name,
    u.photo
    FROM user_client as u
    INNER JOIN store as s on u.id=s.id_user
    where u.username='$store_id'
    and s.is_store_active='1'
    limit 1";
    return $this->db->query($sql)->result_array();
  }

  public function getStorefront(){
    $id_client=$this->session->userdata('user_id');
    $sql = "SELECT name as text,id as value
    FROM product_storefront
    where id_user='$id_client'
    ORDER BY name ASC";

    $data=$this->db->query($sql)->result_array();
    return json_encode($data);
  }

  public function getCategoryName($type,$id){
    switch($type){
      case 'm':
        $data=$this->db->query("SELECT name FROM productcategory_main where id='$id'")->result_array();
        $data_n=$data[0]['name'];
        return $data_n;
        break;
      case 's':
        $data=$this->db->query("SELECT name,id_parent FROM productcategory_sub where id='$id'")->result_array();
        $data_n=$data[0]['name'];
        $data_p=$data[0]['id_parent'];

        $data_main=$this->db->query("SELECT name FROM productcategory_main where id='$data_p'")->result_array();
        $data_main=$data_main[0]['name'];

        return $data_main.' / '.$data_n;
        break;
      case 'p':
        $data=$this->db->query("SELECT name,id_parent FROM productcategory_subofsubs where id='$id'")->result_array();
        $data_n=$data[0]['name'];
        $data_p=$data[0]['id_parent'];

        $data_sub=$this->db->query("SELECT name,id_parent FROM productcategory_sub where id='$data_p'")->result_array();
        $data_sub_n=$data_sub[0]['name'];
        $data_sub_p=$data_sub[0]['id_parent'];

        $data_main=$this->db->query("SELECT name FROM productcategory_main where id='$data_sub_p'")->result_array();
        $data_main_n=$data_main[0]['name'];
        return $data_main_n.' / '.$data_sub_n.' / '.$data_n;
        break;
      default:
        return "ERROR";
        break;

    }

  }

  public function getCategoryNameSummary($type,$id){
    switch($type){
      case 'm':
        $data=$this->db->query("SELECT name FROM productcategory_main where id='$id'")->result_array();
        $data_n=$data[0]['name'];
        return $data_n;
        break;
      case 's':
        $data=$this->db->query("SELECT name,id_parent FROM productcategory_sub where id='$id'")->result_array();
        $data_n=$data[0]['name'];
        return $data_n;
        break;
      case 'p':
        $data=$this->db->query("SELECT name,id_parent FROM productcategory_subofsubs where id='$id'")->result_array();
        $data_n=$data[0]['name'];
        return $data_n;
        break;
      default:
        return "Lain-lain";
        break;

    }

  }

}

?>
