@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')
	

@endsection


@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
    	<!-- <div class="m-subheader ">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title">
						Change Password
					</h3>								
				</div>							
			</div>
		</div> -->
		<div class="m-content">
						<div class="row">
							
							<div class="col-xl-9 col-lg-8">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">	
											<div class="headingpage">
												<i class="flaticon-lock-1"></i>
												@if ($type == "add")
												    Add Service
												@else
													Edit Service
												@endif												
											</div>											
										</div>										
									</div>

									{!! \Helpers::show_message() !!}
									
									<div class="tab-content">
										<div class="tab-pane active" id="m_user_profile_tab_1">
											{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_service_operation','route' => 'get_service_data')) }}
											<!--<form class="m-form m-form--fit m-form--label-align-right">  -->
												{{ Form::hidden('operation_type',$type,array('class' => 'form-control m-input')) }}
												{{ Form::hidden('service_id',isset($result_data->service_id)?$result_data->service_id:"",array('class' => 'form-control m-input')) }}
												<div class="m-portlet__body">									
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Service Name
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('type',isset($result_data->type)?$result_data->type:"",array('class' => 'form-control m-input','placeholder' => 'Service Name','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('type') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Sub Type
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('sub_type',isset($result_data->sub_type)?$result_data->sub_type:"",array('class' => 'form-control m-input','id' => 'id_new_password','placeholder' => 'Sub Type','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('sub_type') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Service Type
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('service_type',isset($result_data->service_type)?$result_data->service_type:"",array('class' => 'form-control m-input','placeholder' => 'Service Type','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('service_type') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Service Price
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('service_price',isset($result_data->service_price)?$result_data->service_price:"",array('class' => 'form-control m-input','placeholder' => 'Service Price','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('service_price') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Service Image
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::file('service_image','',array('class' => 'form-control m-input')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('service_image') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Is Active
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::select('is_active',array('' => 'Select Status','1' => 'Active', '0' => 'Inactive'),isset($result_data->is_active)?$result_data->is_active:"",array('class' => 'form-control m-input selectBox')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('is_active') !!} </span>
														</div>
													</div>					
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-2"></div>
															<div class="col-7">
																<button type="submit" class="btn btn-accent m-btn m-btn--custom purplebtn">
																	Submit
																</button>
																&nbsp;&nbsp;
																<a href="{{route('serviceslist')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																	Cancel
																</a>
															</div>
														</div>
													</div>
												</div>
											<!--</form>-->
											{{ Form::close() }}
										</div>
										<!-- <div class="tab-pane active" id="m_user_profile_tab_2"></div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
		
	</div>
@endsection


@section('script')

<script type="text/javascript">
	
	  $( function() {
	    $( "#id_start_date" ).datepicker();
	    $( "#id_end_date" ).datepicker();
	  } );

</script>>

@endsection
