<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class offerModel extends Model
{
    protected $offers = "offers as o";

    public function getOffersListData()
    {	
        $response = DB::table($this->offers)->select('offer_id','offer_code','offer_type','details','offer_amount_type','offer_amount','start_date','end_date','is_active','created_at')->orderBy('offer_id', 'desc')->get();
        
        return $response;
    }

    public function getOfferData($postData)
    {	
        $response = DB::table($this->offers)->select('offer_id','offer_code','offer_type','details','offer_amount_type','offer_amount','start_date','end_date','is_active','created_at')->where([
        	['offer_id',$postData['offer_id']],
        ])->get();
        
        return $response;
    }

    public function checkOfferCode($postData)
    {	
        $response = DB::table($this->offers)->select('offer_id','offer_code')->where([
        	['offer_code',$postData['offer_code']],
        ])->get();
        
        return $response;
    }

}
