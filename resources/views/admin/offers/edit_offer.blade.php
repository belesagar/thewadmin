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
												Edit Offer													
											</div>											
										</div>										
									</div>

									{!! \Helpers::show_message() !!}
									
									<div class="tab-content">
										<div class="tab-pane active" id="m_user_profile_tab_1">
											{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_add_offer','route' => 'edit_offer_data')) }}
											<!--<form class="m-form m-form--fit m-form--label-align-right">  -->
												<div class="m-portlet__body">	

													{{ Form::hidden('offer_id',$result_data[0]->offer_id) }}	
																				
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Offer Code
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('offer_code',$result_data[0]->offer_code,array('class' => 'form-control m-input','placeholder' => 'Offer Code','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('offer_code') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Offer Type
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('offer_type',$result_data[0]->offer_type,array('class' => 'form-control m-input','id' => 'id_new_password','placeholder' => 'Offer Type','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('offer_type') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Offer Details
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('details',$result_data[0]->details,array('class' => 'form-control m-input','placeholder' => 'Offer Details','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('details') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Offer Amount Type
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::select('offer_amount_type',array('' => 'Select amount type','percent' => 'Percent', 'amount' => 'Amount'),$result_data[0]->offer_amount_type,array('class' => 'form-control m-input selectBox')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('offer_amount_type') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Offer Amount
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::number('offer_amount',$result_data[0]->offer_amount,array('class' => 'form-control m-input','placeholder' => 'Offer Amount','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('offer_amount') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Start Date 
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('start_date',$result_data[0]->start_date,array('class' => 'form-control m-input','id' => 'id_start_date','placeholder' => 'Start Date','autocomplete' => 'off','readonly' => 'true')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('start_date') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															End Date
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('end_date',$result_data[0]->end_date,array('class' => 'form-control m-input','id' => 'id_end_date','placeholder' => 'End Date','autocomplete' => 'off','readonly' => 'true')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('end_date') !!} </span>
														</div>
													</div>	
																
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Is Active
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::select('is_active',array('' => 'Select Status','1' => 'Active', '0' => 'Inactive'),$result_data[0]->is_active,array('class' => 'form-control m-input selectBox')) }}
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
																	Edit
																</button>
																&nbsp;&nbsp;
																<a href="{{route('offerslist')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
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
