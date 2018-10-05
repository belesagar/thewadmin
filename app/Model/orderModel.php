<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class orderModel extends Model
{
    protected $orders = "orders as ord";
    protected $service_table = 'services';
    
    public function getOrdersListData($postData)
    {	
    	
        $response = DB::table($this->orders)->where([
            ['ord.status',$postData['status']],
        ])->get();
        
        return $response;
    }

    public function getOrderData($postData)
    {	
    	
        $response = DB::table($this->orders)->select('order_id','order_unique_id','user_id','service_ids','order_date','pick_up_slot','weight_of_order','amount_of_order','total_amount','status','name','mobile','alternet_mobile_no','address_line1','address_line2','landmark','pincode','ord.created_at','ord.is_active','s.type')->join($this->service_table." as s", 's.service_id', '=', 'ord.service_ids')->where([
            ['ord.order_id',$postData['order_id']],
        ])->get();
        
        return $response;
    }
    
    public function getOrderInformationData($postData)
    {   
        
        $response = DB::table($this->orders)->select('ord.*', 's.service_id','s.type','s.service_price','s.service_type')->leftJoin('services as s', 's.service_id', '=', 'ord.service_ids')->where([
            ['ord.order_id',$postData['order_id']],
        ])->get();
        
        return $response;
    }

    public function updateOrder($whereData,$updateData)
    {   
        
         $response = DB::table($this->orders)->where($whereData)->update(
                $updateData
            );
        
        return $response;
    }

}
