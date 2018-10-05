<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class walletModel extends Model
{
    protected $wallet = "wallet";
    protected $users = "users";
   
    public function getUserWalletHistory($id)
    {	
        $response = DB::table($this->wallet." as w")->select('w.wallet_id','w.user_id','w.wallet_amount','w.wallet_total_amount','w.type','w.comment','w.updated_by','w.created_at','u.name','u.email','u.mobile')->join($this->users." as u", 'u.id', '=', 'w.user_id')->where([
        	['user_id',$id],
        ])->get();
        
        return $response;
    }

    public function getLastEntryOfUserWallet($id)
    {	
        $response = DB::table($this->wallet." as w")->select('w.wallet_id','w.user_id','w.wallet_amount','w.wallet_total_amount','w.type','w.comment','w.updated_by','w.created_at')->where([
        	['user_id',$id],
        ])->orderBy('w.wallet_id', 'desc')->latest()->first();
        
        return $response;
    }
}
