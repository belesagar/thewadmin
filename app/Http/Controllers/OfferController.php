<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\offerModel;
use Session;
use DB;

class OfferController extends Controller
{
    public function __construct()
    {
         $this->offerModel = new offerModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request) {

    	//This function for getting employee data
    	$responseData =  $this->offerModel->getOffersListData();
		return view('admin.offers.offers_list',['result_data'=>$responseData]);
    }

    public function add(Request $request) {
    	return view('admin.offers.add_offer');
    }

    public function add_data(Request $request) {

    	$request_data = $request->all();
    	
    	$validator = \Validator::make($request->all(),[
          'offer_code' => 'required|string|exists:offers,offer_code',
          'offer_type' => 'required|string',
          'details' => 'required',
          'offer_amount_type' => 'required',
          'offer_amount' => 'required|numeric',
          'start_date' => 'required',
          'end_date' => 'required',
          'is_active' => 'required|numeric',
          // 'role' => 'required',
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        $responce = DB::table("offers")->insert([
	        	"offer_code" => $request_data['offer_code'],
	        	"offer_type" => $request_data['offer_type'],
	        	"details" => $request_data['details'],
	        	"offer_amount_type" => $request_data['offer_amount_type'],
	        	"offer_amount" => $request_data['offer_amount'],
	        	"start_date" => date("Y-m-d",strtotime($request_data['start_date'])),
	        	"end_date" => date("Y-m-d",strtotime($request_data['end_date'])),
	        	"is_active" => $request_data['is_active'],
	        ]);
	        
	        
	   Session::flash('success_message', "Offer is successfully added.");

    	return redirect()->route('offerslist');
    }

    public function edit(Request $request,$id) {

    	$postData = array(
    		"offer_id" => $id
    	);

    	$responseData =  $this->offerModel->getOfferData($postData);

    	if($responseData->count() == 1)
    	{
    		return view('admin.offers.edit_offer',['result_data'=>$responseData]);
    	}else{
    		Session::flash('error_message', "Invalid Offer.");
    		return redirect()->back();
    	}
    }

    public function update(Request $request) {

    	$request_data = $request->all();

    	$validator = \Validator::make($request->all(),[
          'offer_code' => 'required|string',
          'offer_type' => 'required|string',
          'details' => 'required',
          'offer_amount_type' => 'required',
          'offer_amount' => 'required|numeric',
          'start_date' => 'required',
          'end_date' => 'required',
          'is_active' => 'required|numeric',
          // 'role' => 'required',
  
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }else{
        	$postData = array(
    			"offer_code" => $request_data['offer_code']
    		);

        	$checkData =  $this->offerModel->checkOfferCode($postData);
        	
        	if($checkData->count() != 0)
	        {
	        	if($checkData[0]->offer_id != $request_data['offer_id'])
		        {
					$validator->errors()->add('offer_code', 'Offer code already exists');
		        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
	        	}
	        }

        }

        $responce = DB::table("offers")->where('offer_id',$request_data['offer_id'])->update([
	        	"offer_code" => $request_data['offer_code'],
	        	"offer_type" => $request_data['offer_type'],
	        	"details" => $request_data['details'],
	        	"offer_amount_type" => $request_data['offer_amount_type'],
	        	"offer_amount" => $request_data['offer_amount'],
	        	"start_date" => date("Y-m-d",strtotime($request_data['start_date'])),
	        	"end_date" => date("Y-m-d",strtotime($request_data['end_date'])),
	        	"is_active" => $request_data['is_active'],
	        ]);
	        
	        
	   Session::flash('success_message', "Offer is successfully updated.");

    	return redirect()->route('offerslist');
    }

}
