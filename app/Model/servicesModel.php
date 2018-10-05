<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model; 
use Session;
use DB;

class servicesModel extends Model
{
    protected $services = "services";
    protected $services_category = "services_category";
    protected $services_type = "services_type";

    public function getServicesListData()
    {	
        $response = DB::table($this->services)->select('service_id','city_id','type','sub_type','service_price','service_type','service_image','is_active','created_at')->get();
        
        return $response;
    }

    public function getActiveServicesListData()
    {	
        $response = DB::table($this->services)->select('service_id','city_id','type','sub_type','service_price','service_type','service_image','is_active','created_at')->where([
        	['is_active',"1"],
        ])->get()->toArray();
        
        return $response;
    }

    public function getServiceData($id)
    {	
        $response = DB::table($this->services)->select('service_id','city_id','type','sub_type','service_price','service_type','service_image','is_active','created_at')->where([
        	['service_id',$id],
        ])->get();
        
        return $response;
    }
    
    public function add_data($postData)
    {
    	$responce = DB::table($this->services)->insert([
	        	"type" => $postData['type'],
	        	"sub_type" => $postData['sub_type'],
	        	"service_type" => $postData['service_type'],
	        	"service_price" => $postData['service_price'],
	        	"is_active" => $postData['is_active'],
	     ]);

    	return true;
    }
    
    public function update_data($postData)
    {
    	$responce = DB::table($this->services)->where('service_id',$postData['service_id'])->update([
	        	"type" => $postData['type'],
	        	"sub_type" => $postData['sub_type'],
	        	"service_type" => $postData['service_type'],
	        	"service_price" => $postData['service_price'],
	        	"is_active" => $postData['is_active'],
	        ]);

    	return true;
    }

    public function getServicesCategoryListData()
    {	
        $response = DB::table($this->services_category)->select('services_category_id','service_id','category_name','is_active')->get();
        
        return $response;
    }

    public function getServiceCategoryData($id)
    {	
        $response = DB::table($this->services_category)->select('services_category_id','service_id','category_name','is_active')->where([
        	['services_category_id',$id],
        ])->get();
        
        return $response;
    }

    public function add_service_category_data($postData)
    {
    	$responce = DB::table($this->services_category)->insert([
	        	"service_id" => $postData['service_id'],
	        	"category_name" => $postData['category_name'],
	        	"is_active" => $postData['is_active'],
	     ]);

    	return true;
    }
    
    public function update_service_category_data($postData)
    {
    	$responce = DB::table($this->services_category)->where('services_category_id',$postData['services_category_id'])->update([
    			"service_id" => $postData['service_id'],
	        	"category_name" => $postData['category_name'],
	        	"is_active" => $postData['is_active'],
	        ]);

    	return true;
    }

    public function getServicesCategoryTypeListData()
    {	
        $response = DB::table($this->services_type." as st")->select('st.service_type_id','st.services_category_id','st.service_id','st.type_name','st.type_price','st.service_for','st.is_active','st.created_at','sc.category_name')->join($this->services_category." as sc", 'sc.services_category_id', '=', 'st.services_category_id')->get();
        
        return $response;
    }

    public function getServiceCategoryTypeData($id)
    {	
        $response = DB::table($this->services_type)->select('service_type_id','services_category_id','service_id','type_name','type_price','service_for','is_active','created_at')->where([
        	['service_type_id',$id],
        ])->get();
        
        return $response;
    }

    public function add_service_category_type_data($postData)
    {
    	$responce = DB::table($this->services_type)->insert([
	        	"services_category_id" => $postData['services_category_id'],
	        	"type_name" => $postData['type_name'],
	        	"type_price" => $postData['type_price'],
	        	"is_active" => $postData['is_active'],
	     ]);

    	return true;
    }
    
    public function update_service_category_type_data($postData)
    {
    	$responce = DB::table($this->services_type)->where('service_type_id',$postData['service_type_id'])->update([
    			"services_category_id" => $postData['services_category_id'],
	        	"type_name" => $postData['type_name'],
	        	"type_price" => $postData['type_price'],
	        	"is_active" => $postData['is_active'],
	        ]);

    	return true;
    }

    public function create_select_option($postData,$column_name="",$message_text = "Select one option")
    {
    	$response_data = array();

        // $key_data = array_keys(array_column($postData, $column_name), $column_name);
    	$key_data = array_column($postData, $column_name);

    	print_r($key_data); 
        exit;
    	return true;
    }

}
