@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')
	
	 <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
		  .controls {
			background-color: #fff;
			border-radius: 2px;
			border: 1px solid transparent;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
			box-sizing: border-box;
			font-family: Roboto;
			font-size: 15px;
			font-weight: 300;
			height: 29px;
			margin-left: 17px;
			margin-top: 10px;
			outline: none;
			padding: 0 11px 0 13px;
			text-overflow: ellipsis;
			width: 400px;
		  }

		  .controls:focus {
			border-color: #4d90fe;
		  }
		  .title {
			font-weight: bold;
		  }
		  #infowindow-content {
			display: none;
		  }
		  #map #infowindow-content {
			display: inline;
		  }

    </style>


@endsection


@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
    	<!-- <div class="m-subheader ">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title ">
						User Details

					</h3>
				</div>
			</div>
		</div> -->
		<!-- END: Subheader -->
		<div class="m-content">
			<div class="row">

				{!! \Helpers::show_message() !!}
				
									
					<div class="col-xl-12 col-lg-12">
						<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
							<!-- <div class="m-portlet__head">
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#personal_details" role="tab">											
												Transaction Details
											</a>
										</li>
										
										
									</ul>
								</div>							
							</div> -->
							
							<div class="m-portlet__head">
								<div class="m-portlet__head-tools">	
									<div class="headingpage">
										<i class="flaticon-lock-1"></i>
										Order Details - {{$result_data[0]->order_unique_id}}
										<!-- <a href="{{route('edit_user',['id'=>$result_data[0]->order_id])}}" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
											Edit
										</a> -->
									</div>											
								</div>										
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="personal_details">
									
										<div class="m-portlet__body">										<h3 class="heading-color">Order Details</h3>
											<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
												{{ Form::hidden('order_id',$result_data[0]->order_id,array('class' => 'form-control m-input','id' => 'id_order_id','autocomplete' => 'off')) }}
												<tbody> 
																		
													<tr>
														<th>Order ID</th> 
														<td>{{!empty($result_data[0]->order_unique_id) ? $result_data[0]->order_unique_id : "-"}}</td> 
														<th>Pick Up Slot</th> 
														<td>{{!empty($result_data[0]->pick_up_slot) ? $result_data[0]->pick_up_slot : ""}}</td> 
																					
													</tr>
													<tr>
														<th>Service</th> 
														<td>{{!empty($result_data[0]->type) ? $result_data[0]->type : "-"}}</td> 
														<th>Status</th> 
														<td>{{!empty($result_data[0]->status) ? $result_data[0]->status : "-"}}

															@if ($result_data[0]->status != "Cancelled")

																{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_change_status','route' => 'change_order_status')) }}

																	
																		<button class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin" onclick="changeStatus()">
																				Change Status
																		</button>
																	

																	{{ Form::hidden('status_id','',array('class' => 'form-control m-input','id' => 'id_for_status','autocomplete' => 'off')) }}

																{{ Form::close() }}

															@endif
														</td> 
																					
													</tr>
													<tr>
														<th>Weight of Order</th> 
														<td>{{!empty($result_data[0]->weight_of_order) ? $result_data[0]->weight_of_order.'&nbsp; Kg' : "-"}}

															@if ($result_data[0]->weight_of_order == "")
																<button class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin" data-toggle="modal" data-target="#myModal">
																	Add Order Weight
																</button>
															@endif

														</td> 
														<th>Order Date</th> 
														<td>{{!empty($result_data[0]->order_date) ? $result_data[0]->order_date : "-"}}</td> 
																					
													</tr>
													
													
												</tbody>
										
											</table>
											<hr class="purplebtn">
											<h3 class="heading-color">Order Product Details</h3>
											<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
												<thead class="text-primary">
													<th>No.</th>
													<th>Service Name</th>
													<th>Service Amount</th>
													<th>Product Amount</th>
													
													
													<!-- <th>Action</th> -->									
												</thead>

												<tbody> 
											
													@foreach ($product_data as $key => $row_data)										
														<tr id="row-{{$row_data->id}}">
															<td>{{++$key}}</td> 
															<td>{{$row_data->type}}</td> 
															<td>{{$row_data->service_amount}}/Kg</td> 
															<td>{{$row_data->total_amount != ""?$row_data->total_amount:"-"}}</td> 
															 
																							
														</tr>
													@endforeach
													
												</tbody>

											</table>

											<hr class="purplebtn">
											<h3 class="heading-color">Order Amount Details</h3>
											<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
										
												<tbody> 
																		
													<tr>
														<th>Order Amount</th> 
														<td>{{!empty($result_data[0]->amount_of_order) ? '&#x20B9;'.$result_data[0]->amount_of_order : "-"}}</td> 
														 
																					
													</tr>
													<!-- <tr>
														<th>Remaning Bill Amount</th> 
														<td>&#x20B9;{{!empty($result_data[0]->order_unique_id) ? $result_data[0]->order_unique_id : "-"}}</td> 
														 
																					
													</tr> -->
													<tr>
														<th><b>Total Bill</b></th> 
														<td><b>{{!empty($result_data[0]->total_amount) ? '&#x20B9;'.$result_data[0]->total_amount : "-"}}</b></td> 
														 
																					
													</tr>
													
												</tbody>
										
											</table>

											<hr class="purplebtn">
											<h3 class="heading-color">User Details</h3>
											<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
										
												<tbody> 
																		
													<tr>
														<th>Name</th> 
														<td>{{!empty($result_data[0]->name) ? $result_data[0]->name : "-"}}</td> 
														<th>Email</th> 
														<td>{{!empty($result_data[0]->email) ? $result_data[0]->email : ""}}</td> 
																					
													</tr>
													<tr>
														<th>Mobile</th> 
														<td>{{!empty($result_data[0]->mobile) ? $result_data[0]->mobile : "-"}}</td> 
														<th>Alternet Mobile no</th> 
														<td>{{!empty($result_data[0]->alternet_mobile_no) ? $result_data[0]->alternet_mobile_no : "-"}}</td> 
																					
													</tr>
													<tr>
														<th>Address</th> 
														<td>{{!empty($result_data[0]->address_line1) ? $result_data[0]->address_line1." ,".$result_data[0]->address_line2 : "-"}}</td>
														<th>Landmark</th> 
														<td>{{!empty($result_data[0]->landmark) ? $result_data[0]->landmark : "-"}}</td> 
																					
													</tr>
													
													<tr>
														<th>Pincode</th> 
														<td>{{!empty($result_data[0]->pincode) ? $result_data[0]->pincode : "-"}}</td> 
														<th>Status</th> 
														<td>{{$result_data[0]->is_active == "1"?"Active":"Inavtive"}}</td> 
																					
													</tr>
													
													<tr>
														<th>Created Date</th> 
														<td>{{!empty($result_data[0]->created_at) ? $result_data[0]->created_at : "-"}}</td> 
														<th></th> 
														<td></td> 
																					
													</tr>
													
												</tbody>
										
											</table>

										</div>
																
								</div>
								
								

							</div>
						</div>
					</div>
				
			</div>
		</div>
		

	</div>

	<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Weight Of Order</h4>
        </div>
        {{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_add_weight','route' => 'orders_add_weight')) }}
	        <div class="modal-body">
	          <div class="form-group m-form__group row">
				<label for="example-text-input" class="col-3 col-form-label">
					Order Weight
				</label>
				<div class="col-7">
					<!--<input class="form-control m-input" type="text" value="">-->
					{{ Form::number('order_weight','',array('class' => 'form-control m-input','placeholder' => 'Order Weight','autocomplete' => 'off')) }}
					<span class="text-danger"> {!! $errors->errormsg->first('order_weight') !!} </span>
				</div>
				{{ Form::hidden('id','',array('class' => 'form-control m-input','id' => 'id_for_weight','autocomplete' => 'off')) }}
			</div>
	        </div>
        
        <div class="modal-footer">
        	<button type="button" id="id_save_weight" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
				Save
			</button>
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>


@endsection


@section('script')

<script type="text/javascript">

	$("#id_save_weight").click(function(){

		$("#id_for_weight").val($("#id_order_id").val());
    	$("#id_add_weight").submit();
	}); 

	function changeStatus()
	{
		$("#id_for_status").val($("#id_order_id").val());
    	$("#id_change_status").submit();
	}

	function test()
	{
		//if (navigator.share) {
		  navigator.share({
		      title: 'Web Fundamentals',
		      text: 'Check out Web Fundamentals — it rocks!',
		      url: 'https://developers.google.com/web',
		  })
		    .then(() => console.log('Successful share'))
		    .catch((error) => console.log('Error sharing', error));
		//}
	}
</script>

@endsection
