<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\orderModel;
use App\Model\productModel;
use Session;
use DB;

class OrdersController extends Controller
{
    public function __construct()
    {
         $this->orderModel = new orderModel();
         $this->productModel = new productModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request) {

		return view('admin.orders.orders_list');
    }
    
    public function ordersTableData(Request $request) {

    	return view('admin.orders.orders_table');
    }

    public function getOrderData(Request $request) {

    	$request_data = $request->all();

    	$statusArray = array(
            "ordered" => "Ordered",
            "picked_up" => "Picked up",
            "processing" => "Processing",
            "ready" => "Ready",
            "delivered" => "Delivered",
            "payment_pending" => "Payment pending",
            "cancelled" => "Cancelled",
        );

    	$postData = array(
    		"status" => $statusArray[$request_data['status']]
    	);
    	$orderModel =  $this->orderModel->getOrdersListData($postData);

    	$dataarray = array();

    	$dataarray['recordsTotal'] = $orderModel->count();
        $dataarray['recordsFiltered'] = $orderModel->count();
        $dataarray['data'] = $orderModel;

        print_r(json_encode($dataarray)); 
    	exit;

    	//return view('admin.orders.orders_table');
    }
    
    public function view(Request $request,$id) {

        $postData = array(
            "order_id" => $id
        );

        $responseData =  $this->orderModel->getOrderData($postData);

        $orderProductData =  $this->productModel->getOrdersProductData($postData);
        
        if($responseData->count() == 1)
        {
            return view('admin.orders.order_view',['result_data'=>$responseData,'product_data'=>$orderProductData]);
        }else{
            Session::flash('error_message', "Invalid Employee.");
            return redirect()->back();
        }
    }
    
    public function addOrderWeight(Request $request) {
        $request_data = $request->all();

        $validator = \Validator::make($request->all(),[
          'order_weight' => 'required|numeric',
          'id' => 'required|numeric',
        ]); 
       
        if ($validator->fails()) {
            // dd(implode(", ",$validator->errors()->all()));
            $error_msg = implode(", ",$validator->errors()->all());
            Session::flash('error_message', $error_msg);
            return redirect()->back();

            // send back to the page with the input data and errors
            // return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        $postData = array(
            "order_id" => $request_data['id']
        );

        $responseData =  $this->orderModel->getOrderInformationData($postData);

        $order_weight = $request_data['order_weight'];
        $total_amount = 0;
        if($responseData[0]->service_ids != "")
        {
            $order_amount = $order_weight * $responseData[0]->service_price;
            $total_amount = $order_amount;

            $updateData = array(
                "weight_of_order" => $order_weight,
                "amount_of_order" => $order_amount,
                "total_amount" => $total_amount
            );
            // dd($updateData);
           $whereData = [
                ['order_id', $request_data['id']]
            ];

            $updateResponseData =  $this->orderModel->updateOrder($whereData,$updateData);

            if($updateResponseData)
            {
                Session::flash('success_message', "Weight of order is successfully added.");
            }

        }else{
            Session::flash('error_message', "Service is missing of this user");
        }
        
        return redirect()->back();

    }

    public function changeOrderStatus(Request $request) {
        $request_data = $request->all();

        $validator = \Validator::make($request->all(),[
          'status_id' => 'required|numeric',
        ]); 
       
        if ($validator->fails()) {
            // dd(implode(", ",$validator->errors()->all()));
            $error_msg = implode(", ",$validator->errors()->all());
            Session::flash('error_message', $error_msg);
            return redirect()->back();

            // send back to the page with the input data and errors
            // return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        $order_id = $request_data['status_id'];

        $postData = array(
            "order_id" => $order_id
        );

        $responseData =  $this->orderModel->getOrderData($postData);

        if($responseData->count() == 1)
        {   
            //This code for taking current order status
            $order_status = $responseData[0]->status;

            //This code for getting status list
            $status_list = \Helpers::order_status();
            $index = array_search($order_status,$status_list,true);
            
            $next_status = $status_list[++$index];

            //This condition for checking weight of order is added or not before changing status
            if($next_status == "Processing")
            {
                if($order_status['weight_of_order'] == "")
                {
                    Session::flash('error_message', "Weight of order is missing, Please add the weight of the order.");
                    return redirect()->back();
                }
            }

            $updateData = array(
                "status" => $next_status
            );
            // dd($updateData);
            $whereData = [
                ['order_id', $order_id]
            ];

            $updateResponseData =  $this->orderModel->updateOrder($whereData,$updateData);

            if($updateResponseData)
            {
                Session::flash('success_message', "Status Change successfully.");
            }
            
            return redirect()->back();
           
        }else{
            Session::flash('error_message', "Invalid Order.");
            return redirect()->route('orderslist');
        }
    }

}
