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

		::-webkit-datetime-edit-year-field:not([aria-valuenow]),
::-webkit-datetime-edit-month-field:not([aria-valuenow]),
::-webkit-datetime-edit-day-field:not([aria-valuenow]) {
    color: transparent;

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
										User Details
										<a href="{{route('edit_user',['id'=>$result_data[0]->id])}}" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
											Edit
										</a>
										<!-- <a href="{{route('wallet_history',['id'=>$result_data[0]->id])}}" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
											Wallet History
										</a> -->
									</div>											
								</div>										
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="personal_details">
									
										<div class="m-portlet__body">										
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
	<hr>

						<div class="m-portlet__head">
							<div class="m-portlet__head-tools">	
								<div class="headingpage">
									<i class="flaticon-lock-1"></i>
									Wallet History
									<a href="#" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin" data-toggle="modal" data-target="#myModal">
										Add Amount in wallet
									</a>
								</div>											
							</div>										
						</div>
						{!! \Helpers::show_message() !!}	
						<div class="m-portlet__body">
							
							<!-- <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
								<div class="row align-items-center">
									<div class="col-xl-8 order-2 order-xl-1">
										<div class="form-group m-form__group row align-items-center">
											<div class="col-md-4">
												<div class="m-input-icon m-input-icon--left">
													<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
													<span class="m-input-icon__icon m-input-icon__icon--left">
														<span>
															<i class="la la-search"></i>
														</span>
													</span>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div> -->


							<div class="tab-content userlistbx">
								<div class="tab-pane active instantcashlisttablebx" >
									<div class="table-responsive instantcashlisttablebx2" id="m_user_profile_tab_1">

									<!-- <div id="post_content"></div> -->
									<table class="table table-bordered table-hover" id="wallet_table">
										<thead class="text-primary">
											<th>No.</th>
											<!-- <th>User Name</th> -->
											<th>Wallet Amount</th>
											<th>Wallet Total Amount</th>
											<th>Type</th>
											<th>Comment</th>
											<th>Created Date</th>
											<!-- <th>Action</th>									 -->
										</thead>
										<tbody>
											@foreach ($wallet_data as $key=>$row)
											<tr>
												<td>{{++$key}}</td>
												<!-- <td>{{$row->name}}</td> -->
												<td>{{$row->wallet_amount}}</td>
												<td>{{$row->wallet_total_amount}}</td>
												<td>{{$row->type}}</td>
												<td>{{$row->comment}}</td>
												<td>{{$row->created_at}}</td>
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								</div>
								<!-- <div class="tab-pane active" id="m_user_profile_tab_2"></div> -->
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
          <h4 class="modal-title">Add Amount In User Wallet</h4>
        </div>
        {{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_add_wallet_amount','route' => 'add_amount')) }}
	        <div class="modal-body">
	          <div class="form-group m-form__group row">
				<label for="example-text-input" class="col-3 col-form-label">
					
				</label>
				<div class="col-7">
					<!--<input class="form-control m-input" type="text" value="">-->
					{{ Form::radio('type','credit',false) }}&nbsp;Credit
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{ Form::radio('type','debit',false) }}&nbsp;Debit
					<span class="text-danger"> {!! $errors->errormsg->first('amount') !!} </span>
				</div>
				{{ Form::hidden('id','',array('class' => 'form-control m-input','id' => 'id_for_weight','autocomplete' => 'off')) }}
			</div>
			<div class="form-group m-form__group row">
				<label for="example-text-input" class="col-3 col-form-label">
					Amount
				</label>
				<div class="col-7">
					<!--<input class="form-control m-input" type="text" value="">-->
					{{ Form::number('amount','',array('class' => 'form-control m-input','placeholder' => 'Amount','autocomplete' => 'off')) }}
					<span class="text-danger"> {!! $errors->errormsg->first('amount') !!} </span>
				</div>
				{{ Form::hidden('id','',array('class' => 'form-control m-input','id' => 'id_for_weight','autocomplete' => 'off')) }}
			</div>
			<div class="form-group m-form__group row">
				<label for="example-text-input" class="col-3 col-form-label">
					Comment
				</label>
				<div class="col-7">
					<!--<input class="form-control m-input" type="text" value="">-->
					{{ Form::text('comment','',array('class' => 'form-control m-input','placeholder' => 'Comment','autocomplete' => 'off')) }}
					<span class="text-danger"> {!! $errors->errormsg->first('comment') !!} </span>
				</div>
				{{ Form::hidden('id',$result_data[0]->id,array('class' => 'form-control m-input','id' => 'id_for_weight','autocomplete' => 'off')) }}
			</div>
	        </div>
        
        <div class="modal-footer">
        	<button type="submit" id="id_save_weight" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
				Add
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

	$('#wallet_table').DataTable();

	</script>

@endsection
