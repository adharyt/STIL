<?php
class salesModel extends CI_Model{
  public function __construct(){
    $this->load->database();
  }


  public function storeSales($id_user,$node){
    switch($node){
      case 'amountProductSold':
         $value_query=$this->db->query("SELECT sum(s.amount) as amount
         FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
         inner join sales as s ON sdt.id_invoice=s.invoice
         inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
         where id_seller='$id_user' and s.status='1'
         AND sdc.status in(3,52)");

         if($value_query->result_array()[0]['amount']!=0 || $value_query->result_array()[0]['amount']!=''){
           $value=$value_query->result_array()[0]['amount'];
         }else{
           $value='0';
         }
      break;
      case 'countProductSold':
         $value_query=$this->db->query("SELECT sum(sdp.quantity) as quantity
         FROM sales_detail_trans as sdt inner join stil.user_client as u on sdt.id_seller=u.id
         inner join sales as s ON sdt.id_invoice=s.invoice
         inner join sales_detail_courier as sdc on sdc.id_sales_detail_trans=sdt.id
         inner join sales_detail_product as sdp on sdp.id_sales_detail_trans=sdp.id
         where id_seller='$id_user' and s.status='1'
         AND sdc.status in(3,52)");

         if($value_query->result_array()[0]['quantity']!=0 || $value_query->result_array()[0]['quantity']!=''){
           $value=$value_query->result_array()[0]['quantity'];
         }else{
           $value='0';
         }
      break;

    }
    return $value;
  }

  public function storeSalesInterval($id_user,$from,$to){
    $value="";

    return $value;
  }

  public function getSalesByDaterange($id_seller,$start_date,$end_date){
    $sales7dayfinal=array();
    $sales7day=$this->db->query("CALL get_UserSalesByDate('$id_seller','$start_date','$end_date')")->result_array();
    $this->db->close();
    $this->db->reconnect();


    $salesRange=$this->timeModel->getDatesFromRange($start_date,$end_date);
    foreach($salesRange as $date){
      $temp['date']=$date;
      $i=0;
      foreach($sales7day as $sales){
        if($sales['tanggal']==$date){
          $temp['amount']=$sales['totalprice'];
          $temp['item_count']=$sales['jumlah'];
          $i=1;
        }
      }
      if($i!=1){
        $temp['amount']=0;
        $temp['item_count']=0;
      }

      array_push($sales7dayfinal,$temp);
    }

    return $sales7dayfinal;
  }

  public function getSalesAmountByTransactionID($id_sdc,$stil=FALSE){

      $status_kurir=$this->statusModel->getStatusInfo('TRANS_SUCCESS');

      $queryCek=$this->db->query("SELECT sdc.price,sdc.id_service FROM sales_detail_courier as sdc where sdc.id='$id_sdc' AND sdc.status in($status_kurir)");
      //PRICE COURIER
      if($queryCek->num_rows()>0){
        $data_cour=$queryCek->result_array();

        if($stil!=TRUE){
          if($data_cour[0]['id_service']!=1){
            $price_courier=$data_cour[0]['price'];
          }else{
            $price_courier=0;
          }
        }else{
          if($data_cour[0]['id_service']==1){
            $price_courier=$data_cour[0]['price'];
          }else{
            $price_courier=0;
          }
        }



        //PRICE PRODUCTS
        $price_products=0;
        $products=$this->db->query("SELECT id,quantity FROM sales_detail_product
                                    WHERE id IN (SELECT id_sales_detail_product as pr_id
                                                 FROM sales_detail_courier_by_product as ssdcbp
                                                 INNER JOIN sales_detail_courier as ssdc
                                                 ON ssdc.id=ssdcbp.id_sales_detail_courier
                                                 where id_sales_detail_courier='$id_sdc'
                                                 AND ssdc.status IN($status_kurir)
                                               )
                                    AND status=1 AND is_refund=0
                                    ")->result_array();
        foreach($products as $product){
          if($stil!=TRUE){
            $price_products+=$this->productModel->cekHargaBarangTerjual($product['id'],$product['quantity'],TRUE,FALSE)*$product['quantity'];
          }else{
            $price_products+=$this->productModel->cekHargaBarangTerjual($product['id'],$product['quantity'],TRUE,TRUE,TRUE)*$product['quantity'];
          }
        }
        return $price_courier+$price_products;
      }else{
        return 0;
      }

  }

}

?>
