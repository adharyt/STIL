<?php
class productModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }

  public function checkAvailability($product_id){
    $data=$this->db->query("SELECT
                            p.*
                            FROM stil.user_client as u
                            INNER JOIN product as p on p.id_user=u.id
                            INNER JOIN store as s on u.id=s.id_user
                            where p.id='$product_id'
                            and s.is_store_active='1'
                            and s.is_deleted='0'
                            and p.is_deleted='0'
                            and p.is_visibility=1
                            limit 1");

    if($data->num_rows()>0){
      $productData=$data->result_array()[0];
      if($productData['stock_type']==1 && $productData['stock']>0){
        $availability=1;
      }else	if($productData['stock_type']==2 && $productData['stock']>=$productData['buy_minimum']){
        $availability=1;
      }else if($productData['stock_type']==3){
        $availability=1;
      }else{
        $availability=0;
      }
    }else{
      $availability=0;
    }

    return $availability;
  }

  public function getProductsFeatured($data){
    $array= implode(',', array_map('intval', $data));

    $sql = "SELECT
    p.*,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.is_deleted as product_availability,
    s.id_user as store_id,
    s.store_name,
    s.store_notes,
    s.store_photo,
    l.nama as store_city,
    u.username as store_link,
    u.photo
    FROM stil.user_client as u
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
    s.id_user as store_id,
    s.store_name,
    s.store_notes,
    s.store_photo,
    l.nama as store_city,
    u.username as store_link,
    u.photo
    FROM stil.user_client as u
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
    s.id_user as store_id,
    s.id as store_real_id,
    s.store_name,
    s.store_notes,
    s.store_photo,
    l.nama as store_city,
    s.store_lastdelivery,
    s.store_processtime_id,
    s.store_processtime_instan,
    s.store_processtime_preorder,
    s.store_lup_active,
    s.store_open_sunday,
    s.store_open_monday,
    s.store_open_tuesday,
    s.store_open_wednesday,
    s.store_open_thursday,
    s.store_open_friday,
    s.store_open_saturday,
    u.username as store_link,
    u.photo,
    u.gender
    FROM stil.user_client as u
    LEFT JOIN product as p on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user
    LEFT join zone_id as l on s.store_city=l.kode_wilayah
    where u.username='$store_id'
    and concat(p.pr_slug,'-',p.pr_uniq)='$slug'
    and s.is_store_active='1'
    and s.is_deleted='0'
    and p.is_deleted='0'
    and p.is_visibility=1
    limit 1";
    return $this->db->query($sql);
  }

  //hapus aja
  public function checkDiscountBackupByParam($discount_start,$discount_end,$discount_value){
    if($discount_start<=$this->config->item('current_time')
      && $discount_end>=$this->config->item('current_time')
      && $discount_start!=''
      && $discount_end!=''
      && $discount_start!='0000-00-00 00:00:00'
      && $discount_end!='0000-00-00 00:00:00'
      && $discount_value!='' && $discount_value>0
      ){
      return 1;
    }else{
      return 0;
    }
  }

  public function checkDiscountByParam($discount_start,$discount_end,$discount_value){
    if(
         $discount_end>=$this->config->item('current_time')
      && $discount_start!=''
      && $discount_end!=''
      && $discount_start!='0000-00-00 00:00:00'
      && $discount_end!='0000-00-00 00:00:00'
      && $discount_value!='' && $discount_value>0
      ){

        if($discount_start<=$this->config->item('current_time')){
          return "1";
        }else{
          return "2";
        }

    }else{
      return "0";
    }
  }

  public function checkWholesaleByParam($is_grosir,$is_discount,$is_discount_grosir,$stock_type='2'){
    if(
      ($is_grosir==1 && $is_discount!=1 && $stock_type!=1)
      || //or
      ($is_grosir==1 && $is_discount==1 && $is_discount_grosir==1 && $stock_type!=1)
    ){
      return 1;
    }else{
      return 0;
    }
  }

  public function getProductSoldDetail($id_transaksi,$id_product){
    $sql = "SELECT
    pr.pr_slug,pr.pr_uniq,
    p.*,
    p.pr_id as product_id,
    p.lup as product_lup,
    sdt.store_notes as store_notes_x,
    s.id_user as store_id,
    s.store_name,
    s.store_notes,
    s.store_photo,
    l.nama as store_city,
    u.username as store_link,
    u.photo,
    u.gender
    FROM stil.user_client as u
    LEFT JOIN sales_detail_trans as sdt ON u.id=sdt.id_seller
    LEFT JOIN sales_detail_courier as sdc ON sdt.id=sdc.id_sales_detail_trans
    LEFT JOIN sales_detail_product as p on p.id_sales_detail_trans=sdt.id
    LEFT JOIN store as s on u.id=s.id_user
    LEFT join zone_id as l on s.store_city=l.kode_wilayah
    LEFT JOIN product as pr ON p.pr_id=pr.id
    where sdc.id_trans='$id_transaksi'
    and p.id='$id_product'
    limit 1";
    return $this->db->query($sql);
  }

  public function getProductImage($product_id,$is_edit='null'){
    $sql = "SELECT i.id as img_id, u.username as store_link,p.id,i.img_url,i.is_selected
    FROM product as p left join
    stil.user_client as u on p.id_user=u.id left outer join
    product_image as i on i.id_product=p.id
    where p.id='$product_id'
    and i.is_deleted=0
    ORDER BY i.is_selected desc";

    if($this->db->query($sql)->num_rows()>0){
      $data_img=$this->db->query($sql)->result_array();
      if($data_img[0]['img_url']!=''){
        for($i=0;$i<count($data_img);$i++){
          $data_img[$i]['img_url']=base_url().'document_upload/'.$data_img[$i]['store_link'].'/product/'.$data_img[$i]['id'].'/'.$data_img[$i]['img_url'];
        }
      }else{
        $data_img[0]['img_url']=base_url().'assets/images/product/image-not-available.png';
        $data_img[0]['is_selected']=1;
      }
    }else{
      if($is_edit=='null'){
        $data_img[0]['img_url']=base_url().'assets/images/product/image-not-available.png';
        $data_img[0]['is_selected']=1;
      }else{
        $data_img=$this->db->query($sql)->result_array();
      }
    }

    return $data_img;
  }
  public function getProductImagesEdit($product_id){
    $sql = "SELECT u.username as store_link,p.id,i.img_url,i.is_selected
    FROM product as p left join
    stil.user_client as u on p.id_user=u.id left outer join
    product_image as i on i.id_product=p.id
    where p.id='$product_id'
    ORDER BY i.is_selected desc";

    $results=$this->db->query($sql)->result_array();

    foreach($results as $data_img){ //get an array which has the names of all the files and loop through it
          $obj['name'] = $data_img['img_url']; //get the filename in array
          $obj['size'] = filesize($_SERVER['DOCUMENT_ROOT'].'/stil/document_upload/'.$data_img['store_link'].'/product/'.$data_img['id'].'/'.$data_img['img_url']); //get the flesize in array
          $obj['link']= base_url().'document_upload/'.$data_img['store_link'].'/product/'.$data_img['id'].'/'.$data_img['img_url'];
          $result[] = $obj; // copy it to another array
        }
         return $result;
  }


  public function getReview($product_id,$vibes,$limit='0'){
    if($limit=='0'){
      $limited='';
    }else{
      $limited=" limit $limit";
    }
    $parameter="
      FROM response_productreview as r
      INNER JOIN stil.user_client as u on r.id_user=u.id
      where r.id_product='$product_id'
      and u.status=1
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
                  ORDER BY r.lup desc
                  $limited";
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
    FROM stil.user_client as u
    INNER JOIN store as s on u.id=s.id_user
    where u.username='$store_id'
    and s.is_store_active='1'
    limit 1";
    return $this->db->query($sql)->result_array();
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

  public function getCategoryNameByID($categoryID){
    $node=explode('-',$categoryID);
    $type=$node[0];
    $id=$node[1];
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


    return $this->db->query("SELECT p.id as id FROM product as p LEFT JOIN stil.user_client as u on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user where s.is_deleted=0 AND p.is_deleted=0 AND p.is_visibility=1 and s.is_store_active=1 $query_filter $query_category")->num_rows();

  }

  public function cekHargaBarang($id,$value,$check_discount=TRUE){
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
    p.stock_type,
    p.discount_start,
    p.discount_end,
    p.discount_value,
    p.is_discount_grosir,
    p.is_discount_stil,
    p.markup_type,
    p.markup
    FROM product as p
    where p.id='$id'
    limit 1";
    $data=$this->db->query($sql)->result_array()[0];

    $is_discount=$this->productModel->checkDiscountByParam($data['discount_start'],$data['discount_end'],$data['discount_value']);
    $is_wholesale=$this->productModel->checkWholesaleByParam($data['is_wholesale'],$is_discount,$data['is_discount_grosir'],$data['stock_type']);

    if($is_wholesale==1){
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

    if($data['markup_type']=='percentage'){
      $price=$price+($price*($data['markup']/100));
    }else{
      $price=$price;
    }

    if($check_discount!=FALSE){
      if($is_discount==1){
        $price=$price*((100-$data['discount_value'])/100);
      }
    }



    return $price;


  }


  public function cekHargaBarangTerjual($id,$value,$check_discount=TRUE,$check_markup=TRUE,$part_stil=FALSE){
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
    p.discount_start,
    p.discount_end,
    p.discount_value,
    p.is_discount_grosir,
    p.is_discount_stil,
    p.markup,
    p.markup_type
    FROM sales_detail_product as p
    where p.id='$id'
    limit 1";
    $data=$this->db->query($sql)->result_array()[0];

    $is_discount=$this->productModel->checkDiscountByParam($data['discount_start'],$data['discount_end'],$data['discount_value']);
    $is_wholesale=$this->productModel->checkWholesaleByParam($data['is_wholesale'],$is_discount,$data['is_discount_grosir'],'');

    if($is_wholesale==1){
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



    if($check_markup!=FALSE){
      if($data['markup_type']=='percentage'){
        if($part_stil==TRUE){
          $price=$price*($data['markup']/100);
        }else{
          $price=$price+($price*($data['markup']/100));
        }
      }else{
        $price=$price;
      }
    }

    if($check_discount!=FALSE){
      if($is_discount==1){
        $price=$price*((100-$data['discount_value'])/100);
      }
    }

    return $price;


  }

  public function cekTerjual($id){
    return $this->db->query("SELECT p.id FROM product as p
                             inner join sales_detail_product as sdp ON p.id=sdp.pr_id
                             INNER JOIN sales_detail_trans as sdt ON sdt.id=sdp.id_sales_detail_trans
                             INNER JOIN sales as s ON s.invoice=sdt.id_invoice
                             WHERE p.id='$id' AND s.status=1 AND sdp.status=1 and sdp.is_refund=0")->num_rows();
  }

  public function cekWishlist($id){
    return $this->db->query("SELECT p.id FROM product as p INNER JOIN
                             wishlist as w ON p.id=w.id_product
                             WHERE p.id='$id'")->num_rows();
  }

  public function cekWaktuProses($id){
    $dataProduct=$this->db->query("SELECT
                                    p.is_processtime_set,
                                    p.processtime_instan,
                                    p.processtime_preorder,
                                    p.processtime_id,
                                    s.store_processtime_id,
                                    s.store_processtime_instan,
                                    s.store_processtime_preorder
                                    FROM product as p
                                    INNER JOIN store as s on p.id_user=s.id_user
                                    WHERE p.id='$id'")->result_array()[0];
    if($dataProduct['is_processtime_set']==1){
      switch($dataProduct['processtime_id']){
        case '1':
          $waktuProses=$dataProduct['processtime_instan'].' jam';
          break;
        case '2':
          $waktuProses='2 hari';
          break;
        case '3':
          $waktuProses=$dataProduct['processtime_preorder'].' hari';
          break;
        default:
          $waktuProses='2 hari';
          break;
      }
    }else{
      switch($dataProduct['store_processtime_id']){
        case '1':
          $waktuProses=$dataProduct['store_processtime_instan'].' jam';
          break;
        case '2':
          $waktuProses='2 hari';
          break;
        case '3':
          $waktuProses=$dataProduct['store_processtime_preorder'].' hari';
          break;
        default:
          $waktuProses='2 hari';
          break;
      }
    }

    return $waktuProses;
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
        if($data['stock_type']==1 || $data['stock_type']==2){
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
  $search_discount=$data_search['is_discount'];
  if($search_discount==1){
    $today=$this->config->item('current_time');
    $query_discount=" AND discount_start<='$today' AND discount_end>='$today' ";
  }else{
    $query_discount="";
  }


  if($data_search['is_condition_new']==0 && $data_search['is_condition_second']==1){
    $query_condition="0";
  }else if($data_search['is_condition_new']==1 && $data_search['is_condition_second']==0){
    $query_condition="1";
  }else{
    $query_condition="0,1";
  }
  if($data_search['price_min']!=''){
    $query_pricemin=" and price>=$data_search[price_min]";
  }else{
    $query_pricemin="";
  }
  if($data_search['price_max']!=''){
    $query_pricemax=" and price<=$data_search[price_max]";
  }else{
    $query_pricemax="";
  }

  if($data_search['keyword']!=''){
    $kw=$data_search['keyword'];
    $query_keyword=" and (pr_name like '%$kw%' or pr_description like '%$kw%')";
  }else{
    $query_keyword="";
  }

  if($data_search['search_minimum_rating']=='' || $data_search['search_minimum_rating']==0){
    $query_rating="";
  }else{
    $query_rating=" and p.id in (SELECT id_product FROM `response_productreview` group by id_product  having AVG(rating)>=$data_search[search_minimum_rating]) ";
  }

  if($data_search['courier']=='all'){
    $query_courier="";
  }else{
    $AoS_courier=$data_search['courier'];
    $query_courier=" and
    (
      (p.id in(SELECT id_product FROM product_special_courier WHERE id_product=p.id and id_courier_service in($AoS_courier)) && p.is_specialdelivery=1)
      or
      (p.id_user in(SELECT id_store FROM store_default_courier WHERE id_store=p.id_user and id_courier_service in($AoS_courier)) && p.is_specialdelivery=0)
    )";
  }


  //$query_category=$this->getProductInCategory($data_search['category']);
  return "
  and is_wholesale in ($query_wholesale)
  and pr_condition in($query_condition)
  $query_discount
  $query_keyword
  $query_location
  $query_pricemin
  $query_pricemax
  $query_rating
  $query_courier";
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
  u.id as store_id,
  s.store_name,
  s.store_notes,
  s.store_photo,
  l.nama as store_city,
  u.username as store_link,
  u.photo
  FROM stil.user_client as u
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

public function isPreOrder($id){
    $product = $this->db->query("SELECT id_user as id_seller,is_processtime_set,processtime_id FROM product WHERE id='$id'")->result_array()[0];
    if($product['is_processtime_set']==1){
      if($product['processtime_id']==3){
        return 1;
      }else{
        return 0;
      }
    }else{
      $store = $this->db->query("SELECT store_processtime_id FROM store WHERE id_user='$product[id_seller]'")->result_array()[0];
      if($store['store_processtime_id']==3){
        return 1;
      }else{
        return 0;
      }
    }

}

public function getProductsPerStorefront($unameStoreOwner,$storefront_id,$data,$start='',$end='',$is_pagination='0'){
  if($storefront_id==''){
    $queryetalase='';
  }else{
    $queryetalase="AND p.id in (SELECT i.id_product FROM product_storefront_byitem as i LEFT JOIN product_storefront as e on i.id_storefront=e.id LEFT JOIN stil.user_client
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
  s.id_user as store_id,
  s.store_name,
  s.store_notes,
  s.store_photo,
  l.nama as store_city,
  u.username as store_link,
  u.photo
  FROM stil.user_client as u
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

public function getProductsPerStoreAdmin($id_user,$data,$start='',$end='',$is_pagination='0'){
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
  s.id_user as store_id,
  s.store_name,
  s.store_notes,
  s.store_photo,
  l.nama as store_city,
  u.username as store_link,
  u.photo
  FROM stil.user_client as u
  LEFT JOIN product as p on p.id_user=u.id
  LEFT JOIN store as s on u.id=s.id_user
  LEFT join zone_id as l on s.store_city=l.kode_wilayah
  where p.is_deleted=0
  and p.id_user='$id_user'
  $query_filter
  $query_categoryC
  $sort
  $pagination
  ";

  return $this->db->query($sql);
}

  public function getProductDetailEdit($store_id,$product_id){
    $sql = "SELECT
    p.*,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.last_updated as product_lastupdated,
    p.is_deleted as product_availability,
    s.id_user as store_id,
    s.store_name,
    s.store_notes,
    s.store_photo,
    l.nama as store_city,
    s.store_lastdelivery,
    s.store_processtime_id,
    s.store_processtime_instan,
    s.store_processtime_preorder,
    s.store_lup_active,
    s.store_open_sunday,
    s.store_open_monday,
    s.store_open_tuesday,
    s.store_open_wednesday,
    s.store_open_thursday,
    s.store_open_friday,
    s.store_open_saturday,
    u.username as store_link,
    u.photo,
    u.gender
    FROM stil.user_client as u
    LEFT JOIN product as p on p.id_user=u.id
    LEFT JOIN store as s on u.id=s.id_user
    LEFT join zone_id as l on s.store_city=l.kode_wilayah
    where u.username='$store_id'
    and p.id='$product_id'
    and s.is_store_active='1'
    and s.is_deleted='0'
    and p.is_deleted='0'
    limit 1";
    return $this->db->query($sql);
  }

  public function getStorefrontByProduct($product_id){
    $query=$this->db->query("SELECT name,slug from product_storefront as psf inner join product_storefront_byitem as psfbi on psf.id=psfbi.id_storefront where id_product='$product_id' order by position asc,psf.lup desc");
    if($query->num_rows()>0){
      return $query->result_array();
    }else{
      return "EMPTY";
    }
  }

  public function getProductViewers($product_id,$session_id=FALSE){
    if($session_id==FALSE){
      return $this->db->query("SELECT id FROM stil_marketplace.product_viewers where product_id='$product_id'")->num_rows();
    }else{
      return $this->db->query("SELECT id FROM stil_marketplace.product_viewers where product_id='$product_id' AND session_id='$session_id'")->num_rows();
    }
  }


}

?>
