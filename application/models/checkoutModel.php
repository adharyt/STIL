<?php
class checkoutModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }


  public function getAddressList($user_id){
    $sql = "SELECT
    * FROM user_client_address where id_user='$user_id' and is_deleted=0 ORDER by is_default DESC";

    return $this->db->query($sql)->result_array();
  }

  public function inputCheckout($user_id,$datas){
    $cekDump=$this->db->query("UPDATE cart_tempcheckout set status=2 where status=0 and id_user='$user_id'");
    $cekInsert=0;
    foreach($datas as $data){

      $fixedQuantity=$this->productModel->cekStokBarang($data['id'],$data['quantity'])['value'];
      $insert=$this->db->query("INSERT into cart_tempcheckout
      (
        id_user,
        id_store,
        id_product,
        quantity,
        src,
        status,
        lup
      )
      VALUES
      (
        '$user_id',
        '$data[store_id]',
        '$data[id]',
        '$fixedQuantity',
        'WEB CART',
        '0',
        now()
      )
      ");
      if($insert){
        $cekInsert++;
      }
    }

    if($cekDump && $cekInsert==count($datas)){
      return "SUCCESS";
    }else{
      return "FAILED";
    }


  }

  public function checkoutPerStore($id_user){
    $sql="SELECT distinct c.id_store,s.is_store_active,s.store_name,s.store_city
    FROM cart_tempcheckout as c inner join store as s
    ON c.id_store=s.id_user
    where c.id_user='$id_user'
    and c.status=0 order by c.lup desc";

    $data_final=$this->db->query($sql)->result_array();

    for($i=0;$i<count($data_final);$i++){
        $cur_idstore=$data_final[$i]['id_store'];
        $data_final[$i]['id_product']=$this->checkoutModel->getProductCheckout($id_user,$cur_idstore);
        $cekSpecialDelivery=$this->db->query("SELECT p.is_specialdelivery from product as p
                                              INNER JOIN cart_tempcheckout as ct ON p.id=ct.id_product
                                              WHERE ct.id_store='$cur_idstore' AND ct.id_user='$id_user'
                                              AND p.is_specialdelivery=1
                                              AND ct.status=0")->num_rows();
        if($cekSpecialDelivery>0){
          $data_final[$i]['is_specialdelivery']=1;
        }else{
          $data_final[$i]['is_specialdelivery']=0;
        }

        $count_availability=0;
        foreach($data_final[$i]['id_product'] as $productData){
          $status=$this->productModel->checkAvailability($productData['product_id']);
          if($status==1){$count_availability++;}
        }
        $data_final[$i]['count_availability']=$count_availability;
    }

    return $data_final;

  }

  public function getProductCheckout($id_user,$id_store){
    $sql = "SELECT
    c.id as checkout_id,
    c.quantity,
    p.id as product_id,
    p.lup as product_lup,
    p.is_visibility as product_visibility,
    p.pr_slug as product_slug,
    p.pr_uniq as product_uniq,
    p.pr_name as product_name,
    p.buy_minimum,
    p.stock_type,
    p.stock,
    p.weight,
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
    FROM cart_tempcheckout as c
    LEFT JOIN product as p on c.id_product=p.id
    LEFT JOIN stil.user_client as u on c.id_user=u.id
    where c.id_user='$id_user'
    and c.id_store='$id_store'
    and c.status=0
    order by c.lup desc";

    return $this->db->query($sql)->result_array();
  }


  public function getCheckoutProductn($idProduct){
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
    LEFT JOIN stil.user_client as u on c.id_user=u.id
    where c.id_user='$id_user'
    and c.id_store='$id_store'
    order by c.lup desc";

    return $this->db->query($sql)->result_array();
  }

  public function editQuantity($id,$value){
    $sql = "SELECT
    c.id as checkout_id,
    c.id_user,
    c.quantity,
    p.buy_minimum,
    p.stock_type,
    p.stock,
    p.id as product_id,
    p.is_visibility
    FROM cart_tempcheckout as c
    LEFT JOIN product as p on c.id_product=p.id
    where c.id='$id'
    limit 1";
    $data=$this->db->query($sql)->result_array()[0];

    $id_user=$data['id_user'];
    $id_product=$data['product_id'];

    $new_value=$this->productModel->cekStokBarang($data['product_id'],$value)['value'];
    $msg=$this->productModel->cekStokBarang($data['product_id'],$value)['msg'];
    $price=$this->productModel->cekHargaBarang($data['product_id'],$new_value);

    $update=$this->db->query("UPDATE cart_tempcheckout set quantity='$new_value' where id='$id'");
    if($update){
      $data = array(
				'quantity' => $new_value,
        'msg' => $msg,
				'price' => $this->currencyModel->integerToCurrency('rupiah',$price*$new_value)
				);
      $this->db->query("UPDATE cart set quantity='$new_value' where id_user='$id_user' and id_product='$id_product'");
      echo json_encode($data);
    }else{
      echo "FALSE";
    }




  }

}

?>
