<?php
class productModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function getProductsFeatured($data){
    $array= implode(',', array_map('intval', $data));

    $sql = "SELECT
    p.*,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.is_deleted as product_availability,
    s.id as store_id,
    s.store_name,
    s.store_notes,
    s.store_photo,
    l.nama as store_city,
    u.username as store_link,
    u.photo
    FROM user_client as u
    LEFT JOIN product as p on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user
    LEFT join zone_id as l on s.store_city=l.kode_wilayah
    where s.is_store_active='1'
    and p.is_visibility=1
    and p.is_deleted=0
    and p.id in($array)
    ";
    return $this->db->query($sql);
  }

  public function getProducts($data,$start='',$end='',$is_pagination='0'){
    if($is_pagination==1){
      $pagination="limit $start,$end";
    }else{
      $pagination="";
    }

    $query_filter=$this->getFilterQuery($data);
    $category_arrayC=$this->getProductInCategory($data['category']);
    if($category_arrayC!=''){
      $query_categoryC="AND id_category in($category_arrayC)";
    }else{
      $query_categoryC="";
    }

    switch($data['sorting']){
      default:
      case 'newest':
        $sort="ORDER BY p.lup desc";
        break;
      case 'cheapest':
        $sort="ORDER BY CAST(p.price AS INT) asc";
        break;
      case 'mexpensive':
        $sort="ORDER BY CAST(p.price AS INT) desc";
        break;
    }

    $sql = "SELECT
    p.*,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.is_deleted as product_availability,
    s.id as store_id,
    s.store_name,
    s.store_notes,
    s.store_photo,
    l.nama as store_city,
    u.username as store_link,
    u.photo
    FROM user_client as u
    LEFT JOIN product as p on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user
    LEFT join zone_id as l on s.store_city=l.kode_wilayah
    where s.is_store_active='1'
    and p.is_visibility=1
    and p.is_deleted=0
    $query_filter
    $query_categoryC
    $sort
    $pagination";
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
    s.store_photo,
    l.nama as store_city,
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
    LEFT join zone_id as l on s.store_city=l.kode_wilayah
    where u.username='$store_id'
    and concat(p.pr_slug,'-',p.pr_uniq)='$slug'
    and s.is_store_active='1'
    limit 1";
    return $this->db->query($sql);
  }

  public function getProductImage($product_id){
    $sql = "SELECT u.username as store_link,p.id,i.img_url,i.is_selected
    FROM product as p left join
    user_client as u on p.id_user=u.id left outer join
    product_image as i on i.id_product=p.id
    where p.id='$product_id'
    ORDER BY i.is_selected desc";

    $data_img=$this->db->query($sql)->result_array();
    if($data_img[0]['img_url']!=''){
      for($i=0;$i<count($data_img);$i++){
        $data_img[$i]['img_url']=base_url().'document_upload/'.$data_img[$i]['store_link'].'/product/'.$data_img[$i]['id'].'/'.$data_img[$i]['img_url'];
      }
    }else{
      $data_img[0]['img_url']=base_url().'assets/images/product/image-not-available.png';
      $data_img[0]['is_selected']=1;
    }

    return $data_img;
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
    s.store_photo,
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

  public function countProductbyCategory($categoryID,$searchVariable,$data_search){


    $query_filter=$this->getFilterQuery($data_search);

    $category_array=$this->getProductInCategory($categoryID);
    if($category_array!=''){
      $query_category="AND id_category in($category_array)";
    }else{
      $query_category="";
    }

    /*
    $category_arrayC=$this->getProductInCategory($data_search['category']);
    if($category_arrayC!=''){
      $query_categoryC="AND id_category in($category_arrayC)";
    }else{
      $query_categoryC="";
    }
    */


    return $this->db->query("SELECT p.id as id FROM product as p LEFT JOIN user_client as u on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user where 1=1 $query_filter $query_category")->num_rows();

  }

  public function cekHargaBarang($id,$value){
    $sql = "SELECT
    p.price as product_price,
    p.is_wholesale,
    p.wh_unit1,
    p.wh_price1,
    p.wh_unit2,
    p.wh_price2,
    p.wh_unit3,
    p.wh_price3,
    p.wh_unit4,
    p.wh_price4,
    p.wh_unit5,
    p.wh_price5,
    p.is_discount,
    p.discount_value,
    p.is_discount_stil
    FROM product as p
    where p.id='$id'
    limit 1";
    $data=$this->db->query($sql)->result_array()[0];

    if($data['is_wholesale']==1){
      if(($data['wh_unit5']!='' && $data['wh_unit5']!=0 && $data['wh_price5']!='' && $data['wh_price5']!=0) && $value>=$data['wh_unit5']){
        $price=$data['wh_price5'];
      }else if(($data['wh_unit4']!='' && $data['wh_unit4']!=0 && $data['wh_price4']!='' && $data['wh_price4']!=0) && $value>=$data['wh_unit4']){
        $price=$data['wh_price4'];
      }else if(($data['wh_unit3']!='' && $data['wh_unit3']!=0 && $data['wh_price3']!='' && $data['wh_price3']!=0) && $value>=$data['wh_unit3']){
        $price=$data['wh_price3'];
      }else if(($data['wh_unit2']!='' && $data['wh_unit2']!=0 && $data['wh_price2']!='' && $data['wh_price2']!=0) && $value>=$data['wh_unit2']){
        $price=$data['wh_price2'];
      }else if(($data['wh_unit1']!='' && $data['wh_unit1']!=0 && $data['wh_price1']!='' && $data['wh_price1']!=0) && $value>=$data['wh_unit1']){
        $price=$data['wh_price1'];
      }else{
        $price=$data['product_price'];
      }
    }else{
      $price=$data['product_price'];
    }

    return $price;


  }

  public function cekStokBarang($id,$value){
    $sql = "SELECT
    p.stock_type,
    p.stock,
    p.buy_minimum
    FROM product as p
    where p.id='$id'
    limit 1";
    $data=$this->db->query($sql)->result_array()[0];
    $msg=1;
        if($data['stock_type']==1){
          $new_value=1;
        }else if($data['stock_type']==2){
          $id_user=$this->session->userdata('user_id');
          $query=$this->db->query("SELECT sum(quantity) as q from cart_tempcheckout where status=0 and id_user!='$id_user' and id_product='$id'");
          $cek_fix_quantity=$query->num_rows();

          if($cek_fix_quantity>0){
            $fix_quantity_val=$query->result_array()[0]['q'];
          }else{
            $fix_quantity_val=0;
          }

          if($value+$fix_quantity_val<=$data['stock']){
            $new_value=$value;
          }else{
            $new_value=$data['stock']-$fix_quantity_val;
            $msg=2;
          }
          if($value+$fix_quantity_val>=$data['buy_minimum']){
            $new_value=$new_value;
          }else{
            $new_value=$data['buy_minimum'];
            $msg=3;
          }
        }else{
          if($value>=$data['buy_minimum']){
            $new_value=$value;
          }else{
            $new_value=$data['buy_minimum'];
            $msg=3;
          }
        }

        $data = array(
          'value' => $new_value,
          'msg' => $msg
          );
        return $data;
  }

  public function getProductInCategory($category){

    $cek_categoryString=substr($category, 0, 2);
    if($cek_categoryString=='m-' || $cek_categoryString=='s-' || $cek_categoryString=='p-'){
      $expCID=explode('-',$category);
      $type=$expCID[0];
      $id=$expCID[1];
      $categoryArray=array();


      switch($type){
        case 'm':
          array_push($categoryArray,'m-'.$id);
          $datas=$this->db->query("SELECT id FROM productcategory_sub where id_parent='$id' ")->result_array();
          foreach($datas as $data){
            array_push($categoryArray,'s-'.$data['id']);
            $datas_sub=$this->db->query("SELECT id FROM productcategory_subofsubs where id_parent='$data[id]'")->result_array();
            foreach($datas_sub as $data_sub){
              array_push($categoryArray,'p-'.$data_sub['id']);
            }
          }
          break;
        case 's':
          array_push($categoryArray,'s-'.$id);
          $datas=$this->db->query("SELECT id FROM productcategory_subofsubs where id_parent='$id'")->result_array();
          foreach($datas as $data){
            array_push($categoryArray,'p-'.$data['id']);
          }
          break;
        case 'p':
          array_push($categoryArray,'p-'.$id);
          break;
        default:
          break;
      }
      $dataFix="";
      foreach($categoryArray as $categoryID){
        $dataFix.="'".$categoryID."',";
      }
      $arrayQuery=rtrim($dataFix, ',');
    }else{
      $arrayQuery="";
    }
    return $arrayQuery;
  }

  public function getProductInCategoryMenuActive($category){
    $categoryArray=array();
    $cek_categoryString=substr($category, 0, 2);
    if($cek_categoryString=='m-' || $cek_categoryString=='s-' || $cek_categoryString=='p-'){
      $expCID=explode('-',$category);
      $type=$expCID[0];
      $id=$expCID[1];



      switch($type){
        case 'p':
          array_push($categoryArray,'p-'.$id);
          $datas=$this->db->query("SELECT id_parent FROM productcategory_subofsubs where id='$id' ")->result_array();
          foreach($datas as $data){
            array_push($categoryArray,'s-'.$data['id_parent']);
            $datas_sub=$this->db->query("SELECT id_parent FROM productcategory_sub where id='$data[id_parent]'")->result_array();
            foreach($datas_sub as $data_sub){
              array_push($categoryArray,'m-'.$data_sub['id_parent']);
            }
          }
          break;
        case 's':
          array_push($categoryArray,'s-'.$id);
          $datas=$this->db->query("SELECT id_parent FROM productcategory_sub where id='$id'")->result_array();
          foreach($datas as $data){
            array_push($categoryArray,'m-'.$data['id_parent']);
          }
          break;
        case 'm':
          array_push($categoryArray,'m-'.$id);
          break;
        default:
          break;
      }
    }else{

    }

    return $categoryArray;
  }

public function getFilterQuery($data_search){

  if($data_search['location_p']!=''){
    //provinsi ada
    $location_raw_cek=$this->db->query("SELECT kode_wilayah,level FROM zone_id WHERE kode_wilayah='$data_search[location_p]'")->num_rows();
    if($location_raw_cek>0 && $data_search['location_c']!=''){
      //provinsi ada dan kota ada
      $location_raw=$this->db->query("SELECT kode_wilayah,level FROM zone_id WHERE kode_wilayah='$data_search[location_c]' and mst_kode_wilayah='$data_search[location_p]'")->result_array()[0];
      $query_location="and store_city in(".$location_raw['kode_wilayah'].")";

    }else if($location_raw_cek>0){
      //provinsi ada kota gaada
      $location_rawdata="";
      $temp_loc=$this->db->query("SELECT kode_wilayah FROM zone_id where mst_kode_wilayah='$data_search[location_p]' and level=2")->result_array();
      foreach($temp_loc as $loc){
          $location_rawdata.="'".$loc['kode_wilayah']."',";
      }
      $query_location="and store_city in(".rtrim($location_rawdata, ',').")";
    }else{
      //provinsi gaada kota gaada
      $query_location="";
    }
  }else{
    //provinsi gaada
    $query_location="";
  }
  $query_wholesale=$data_search['is_wholesale'];
  $query_discount=$data_search['is_discount'];
  if($data_search['is_condition_new']==0 && $data_search['is_condition_second']==1){
    $query_condition="0";
  }else if($data_search['is_condition_new']==1 && $data_search['is_condition_second']==0){
    $query_condition="1";
  }else{
    $query_condition="0,1";
  }
  if($data_search['price_min']!=''){
    $query_pricemin="and price>=$data_search[price_min]";
  }else{
    $query_pricemin="";
  }
  if($data_search['price_max']!=''){
    $query_pricemax="and price<=$data_search[price_max]";
  }else{
    $query_pricemax="";
  }

  if($data_search['keyword']!=''){
    $kw=$data_search['keyword'];
    $query_keyword="and (pr_name like '%$kw%' or pr_description like '%$kw%')";
  }else{
    $query_keyword="";
  }


  //$query_category=$this->getProductInCategory($data_search['category']);


  return "
  and is_wholesale in ($query_wholesale)
  and is_discount in ($query_discount)
  and pr_condition in($query_condition)
  $query_keyword
  $query_location
  $query_pricemin
  $query_pricemax";
}

public function getWishlist($data,$start='',$end='',$is_pagination='0'){
  $id_user=$this->session->userdata('user_id');
  if($is_pagination==1){
    $pagination="limit $start,$end";
  }else{
    $pagination="";
  }

  $query_filter=$this->getFilterQuery($data);
  $category_arrayC=$this->getProductInCategory($data['category']);
  if($category_arrayC!=''){
    $query_categoryC="AND id_category in($category_arrayC)";
  }else{
    $query_categoryC="";
  }

  switch($data['sorting']){
    default:
    case 'newest':
      $sort="ORDER BY p.lup desc";
      break;
    case 'cheapest':
      $sort="ORDER BY CAST(p.price AS INT) asc";
      break;
    case 'mexpensive':
      $sort="ORDER BY CAST(p.price AS INT) desc";
      break;
  }

  $sql = "SELECT
  p.*,
  p.id as product_id,
  p.lup as product_lup,
  p.is_visibility as product_visibility,
  p.is_deleted as product_availability,
  s.id as store_id,
  s.store_name,
  s.store_notes,
  s.store_photo,
  l.nama as store_city,
  u.username as store_link,
  u.photo
  FROM user_client as u
  LEFT JOIN product as p on p.id_user=u.id
  LEFT JOIN store as s on u.id=s.id_user
  LEFT join zone_id as l on s.store_city=l.kode_wilayah
  where s.is_store_active='1'
  and p.is_visibility=1
  and p.is_deleted=0
  and p.id in(SELECT id_product FROM wishlist WHERE id_user='$id_user')
  $query_filter
  $query_categoryC
  $sort
  $pagination";
  return $this->db->query($sql);
}


public function isWishlist($id){
  $id_user=$this->session->userdata('user_id');

  $sql = "SELECT id_product FROM wishlist WHERE id_user='$id_user' and id_product='$id'";
  return $this->db->query($sql)->num_rows();
}

public function getProductsPerStorefront($unameStoreOwner,$storefront_id,$data,$start='',$end='',$is_pagination='0'){
  if($storefront_id==''){
    $queryetalase='';
  }else{
    $queryetalase="AND p.id in (SELECT i.id_product FROM product_storefront_byitem as i LEFT JOIN product_storefront as e on i.id_storefront=e.id LEFT JOIN user_client
      as u on e.id_user=u.id WHERE e.slug='$storefront_id' and u.username='$unameStoreOwner')";
  }
  if($is_pagination==1){
    $pagination="limit $start,$end";
  }else{
    $pagination="";
  }

  $query_filter=$this->getFilterQuery($data);
  $category_arrayC=$this->getProductInCategory($data['category']);
  if($category_arrayC!=''){
    $query_categoryC="AND id_category in($category_arrayC)";
  }else{
    $query_categoryC="";
  }

  switch($data['sorting']){
    default:
    case 'newest':
      $sort="ORDER BY p.lup desc";
      break;
    case 'cheapest':
      $sort="ORDER BY CAST(p.price AS INT) asc";
      break;
    case 'mexpensive':
      $sort="ORDER BY CAST(p.price AS INT) desc";
      break;
  }

  $sql = "SELECT
  p.*,
  p.id as product_id,
  p.lup as product_lup,
  p.is_visibility as product_visibility,
  p.is_deleted as product_availability,
  s.id as store_id,
  s.store_name,
  s.store_notes,
  s.store_photo,
  l.nama as store_city,
  u.username as store_link,
  u.photo
  FROM user_client as u
  LEFT JOIN product as p on p.id_user=u.id
  LEFT JOIN store as s on u.id=s.id_user
  LEFT join zone_id as l on s.store_city=l.kode_wilayah
  where s.is_store_active='1'
  and p.is_visibility=1
  and p.is_deleted=0
  and u.username='$unameStoreOwner'
  $queryetalase
  $query_filter
  $query_categoryC
  $sort
  $pagination";

  return $this->db->query($sql);
}


}

?>
