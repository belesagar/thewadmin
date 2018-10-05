<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\walletModel;
use Session;
use DB;
use validator;

class walletController extends Controller
{
    public function __construct()
    {
         $this->walletModel = new walletModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request,$id) {

    	//This function for getting employee data
    	$responseData =  $this->walletModel->getUserWalletHistory($id);
		return view('admin.wallet.wallet_list',['result_data'=>$responseData]);
    }

    public function add_amount(Request $request) {

    	
    	$admin_user_id = session($this->sessionName)['admin_user_id'];

    	$request_data = $request->all();
    	$total_wallet_amount = 0;

    	$validator = \Validator::make($request->all(),[
          'comment' => 'required|string',
          'id' => 'required|numeric',
          'amount' => 'required|numeric',
          'type' => 'required|string',
           
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        //This code for getting last entry of data
        $lastEntryData =  $this->walletModel->getLastEntryOfUserWallet($request_data['id']);
        
        $type = $request_data['type'];
        
        if($type == "credit")
        {
        	$total_wallet_amount = $lastEntryData->wallet_total_amount + $request_data['amount'];
        }else{
        	if($request_data['amount'] > $lastEntryData->wallet_total_amount)
        	{
        		Session::flash('error_message', "Debit amount is greater than total wallet amount.");

				return redirect()->route('view_user',['id',$request_data['id']]);
        	}else{
        		$total_wallet_amount = $lastEntryData->wallet_total_amount - $request_data['amount'];
        	}
        }

        $responce = DB::table('wallet')->insert([
        	"user_id" => $request_data['id'],
        	"wallet_amount" => $request_data['amount'],
        	"wallet_total_amount" => $total_wallet_amount,
        	"type" => $type,
        	"comment" => $request_data['comment'],
        	"updated_by" => $admin_user_id,
        ]);
	        
	        
	   Session::flash('success_message', "Wallet amount is successfully added.");

		return redirect()->route('view_user',['id',$request_data['id']]);
    }

}
