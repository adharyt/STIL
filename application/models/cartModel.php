<?php
class cartModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }


  public function getParameter($product_id){
    $sql = "SELECT
    p.id as product_id,
    p.id_user as product_store,
    p.price as product_price,
    p.is_wholesale,
    p.discount_start,
    p.discount_end,
    p.is_discount_grosir,
    p.discount_value,
    p.stock_type
    FROM product as p
    WHERE p.id='$product_id'
    limit 1";

    return $this->db->query($sql)->result_array()[0];
  }

  public function checkProductInCart($product_id,$user_id){
    $sql = "SELECT *
    FROM cart
    WHERE id_product='$product_id'
    and id_user='$user_id'
    and is_deleted=0
    limit 1";

    return $this->db->query($sql)->num_rows();
  }

  public function addItem($data){
    $insert=$this->db->insert('cart', $data);
    if($insert){
      return "OK";
    }else{
      return "FALSE";
    }
  }

  public function cartPerStore($id_user){
    $sql="SELECT distinct c.id_store,s.is_store_active,s.store_name,s.store_city
    FROM cart as c inner join store as s
    ON c.id_store=s.id_user
    where c.id_user='$id_user'
    and c.is_deleted=0
    order by c.lup desc";

    $data_final=$this->db->query($sql)->result_array();

    for($i=0;$i<count($data_final);$i++){
        $data_final[$i]['id_product']=$this->cartModel->itemPerCartPerStore($id_user,$data_final[$i]['id_store']);
        $count_availability=0;
        foreach($data_final[$i]['id_product'] as $productData){
          $status=$this->productModel->checkAvailability($productData['product_id']);
          if($status==1){$count_availability++;}
        }
        $data_final[$i]['count_availability']=$count_availability;
    }

    return $data_final;

  }


  public function itemPerCartPerStore($id_user,$id_store){
    $sql = "SELECT
    c.id as cart_id,
    c.price_cart,
    c.quantity,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.pr_slug as product_slug,
    p.pr_uniq as product_uniq,
    p.pr_name as product_name,
    p.weight,
    p.buy_minimum,
    p.stock_type,
    p.stock,
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
    p.is_discount_grosir,
    p.discount_value,
    p.is_discount_stil,
    p.is_visibility,
    p.last_updated as product_lastupdated,
    p.is_deleted as product_availability,
    u.username as store_link
    FROM cart as c
    LEFT JOIN product as p on c.id_product=p.id
    LEFT JOIN stil.user_client as u on c.id_store=u.id
    where c.id_user='$id_user'
    and c.id_store='$id_store'
    and c.is_deleted=0
    order by p.is_visibility desc,c.lup desc";

    return $this->db->query($sql)->result_array();
  }

  public function editQuantity($id,$value){
    $sql = "SELECT
    c.id as cart_id,
    c.quantity,
    c.price_cart,
    p.buy_minimum,
    p.stock_type,
    p.stock,
    p.id as product_id,
    p.is_visibility
    FROM cart as c
    LEFT JOIN product as p on c.id_product=p.id
    where c.id='$id'
    limit 1";
    $data=$this->db->query($sql)->result_array()[0];


    $new_value=$this->productModel->cekStokBarang($data['product_id'],$value)['value'];
    $msg=$this->productModel->cekStokBarang($data['product_id'],$value)['msg'];
    $price=$this->productModel->cekHargaBarang($data['product_id'],$new_value);

    $update=$this->db->query("UPDATE cart set quantity='$new_value',price_cart='$price' where id='$id'");
    if($update){
      $data = array(
				'quantity' => $new_value,
        'msg' => $msg,
				'price' => $this->currencyModel->integerToCurrency('rupiah',$price*$new_value)
				);
      echo json_encode($data);
    }else{
      echo "FALSE";
    }




  }






}

?>
