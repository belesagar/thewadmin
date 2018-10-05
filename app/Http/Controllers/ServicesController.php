<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\servicesModel;
use Session;
use DB;

class ServicesController extends Controller
{
    public function __construct()
    {
         $this->servicesModel = new servicesModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request) {

    	//This function for getting employee data
    	$responseData =  $this->servicesModel->getServicesListData();
		return view('admin.services.services_list',['result_data'=>$responseData]);
    }

    public function operations(Request $request,$type,$id=0) {
    	$responseData = array();
    	
    	if($type == "edit")
    	{
    		$response =  $this->servicesModel->getServiceData($id);
    		$responseData = $response[0];
    	}
		return view('admin.services.service_operation',['result_data'=>$responseData,'type'=>$type]);
    }

    public function get_service_data(Request $request) {
		
		$request_data = $request->all();
    	
    	$validator = \Validator::make($request->all(),[
          'operation_type' => 'required',
          'type' => 'required',
          'service_price' => 'required|numeric',
          'is_active' => 'required|numeric',
          // 'role' => 'required',
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        if($request_data['operation_type'] == "edit")
        {
        	$responseData =  $this->servicesModel->update_data($request_data);
        	Session::flash('success_message', "Service is successfully updated.");
        }else{
        	$responseData =  $this->servicesModel->add_data($request_data);
        	Session::flash('success_message', "Service is successfully added.");
        }
        return redirect()->route('serviceslist');
	}

	public function services_category(Request $request) {

    	//This function for getting employee data
    	$responseData =  $this->servicesModel->getServicesCategoryListData();
		return view('admin.services.service_category.services_category_list',['result_data'=>$responseData]);
    }

    public function services_category_operations(Request $request,$type,$id=0) {
    	$responseData = array();
    	
    	if($type == "edit")
    	{
    		$response =  $this->servicesModel->getServiceCategoryData($id);
    		$responseData = $response[0];
    	}

    	$servicesList =  $this->servicesModel->getActiveServicesListData();
    	
    	// $scandir(directory)ervicesList->put('', "Select Service ID");
    	// $servicesList = $servicesList->sort();
    	// dd($servicesList);
		return view('admin.services.service_category.service_category_operation',['result_data'=>$responseData,'type'=>$type,'servicesList'=>$servicesList]);
    }

     public function get_service_category_data(Request $request) {
		
		$request_data = $request->all();
    	
    	$validator = \Validator::make($request->all(),[
          'operation_type' => 'required',
          // 'service_id' => 'required',
          'category_name' => 'required',
          'is_active' => 'required|numeric',
          // 'role' => 'required',
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        if($request_data['operation_type'] == "edit")
        {
        	$responseData =  $this->servicesModel->update_service_category_data($request_data);
        	Session::flash('success_message', "Service is successfully updated.");
        }else{
        	$responseData =  $this->servicesModel->add_service_category_data($request_data);
        	Session::flash('success_message', "Service is successfully added.");
        }
        return redirect()->route('servicescategorylist');
	}

	public function services_category_type(Request $request) {

    	//This function for getting employee data
    	$responseData =  $this->servicesModel->getServicesCategoryTypeListData();
		return view('admin.services.service_category_type.services_category_type_list',['result_data'=>$responseData]);
    }

    public function services_category_type_operations(Request $request,$type,$id=0) {
    	$responseData = array();
    	
    	if($type == "edit")
    	{
    		$response =  $this->servicesModel->getServiceCategoryTypeData($id);
    		$responseData = $response[0];
    	}

    	$servicesList =  $this->servicesModel->getServicesCategoryListData();
    	
    	// $scandir(directory)ervicesList->put('', "Select Service ID");
    	// $servicesList = $servicesList->sort();

        $select_array[""] = "Select category";
        foreach ($servicesList as $key => $value) {
           $select_array[$value->services_category_id] = $value->category_name;
        }
        
    	// dd($servicesList);
		return view('admin.services.service_category_type.service_category_type_operation',['result_data'=>$responseData,'type'=>$type,'servicesList'=>$select_array]);
    }

    public function get_services_category_type_data(Request $request) {
		
		$request_data = $request->all();
    	
    	$validator = \Validator::make($request->all(),[
          'operation_type' => 'required',
          'services_category_id' => 'required',
          'type_name' => 'required',
          'type_price' => 'required',
          'is_active' => 'required|numeric',
          // 'role' => 'required',
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        if($request_data['operation_type'] == "edit")
        {
        	$responseData =  $this->servicesModel->update_service_category_type_data($request_data);
        	Session::flash('success_message', "Service is successfully updated.");
        }else{
        	$responseData =  $this->servicesModel->add_service_category_type_data($request_data);
        	Session::flash('success_message', "Service is successfully added.");
        }
        return redirect()->route('servicescategorytypelist');
	}

}
