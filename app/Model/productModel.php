<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class productModel extends Model
{
    protected $product_data = "product_data as pd";
    protected $service_table = 'services';

    public function getOrdersProductData($postData)
    {	
        $response = DB::table($this->product_data)->select('id','order_id','pd.service_id','service_type_id','service_amount','total_amount','pd.created_at','s.type')->join($this->service_table." as s", 's.service_id', '=', 'pd.service_id')->where([
            ['pd.order_id',$postData['order_id']],
        ])->get();
        
        return $response;
    }

}
