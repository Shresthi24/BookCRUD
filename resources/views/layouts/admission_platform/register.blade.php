@extends('main')

@section('registerd')

	<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading"  id="panel-heading1">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 100%; position: relative; top:-10px; color:white"><a style="color:white;" href='{{ route('login') }}' onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                          <!--  <form id="signupform" class="form-horizontal" role="form"> -->
                                {!!Form::open(['route'=>'form.login','class'=>'form-horizontal','id'=>'signupform','role'=>'from','method'=>'post'])!!}
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>od
                                </div>
                                    	@if($errors->any())
                              
                                <div class="alert alert-error">
                                    <a href="#" class="close" data-dismiss="alert">$times;</a>
                                    {{ implode('',$errors->all('<li>class="error">:message</li>'))}}
                                    
                                </div>
                             @endif
                                
                                  
                                
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        {!!Form::text('username','',array('required' => 'required','class'=>'form-control','placeholder'=>'Applicant First Name eg:Arun'))!!}
                                        
                                    </div>
                                </div>
								
								          <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Mobile No.</label>
                                    <div class="col-md-9">
                                  {{Form::number('phoneno','',array('required' => 'required','class'=>'Form-control','placeholder'=>'Enter Registered Mobile No','maxlength' => 10))}}
                                    </div>
                                </div>
                              
                                
                                   
                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                           {!! Form::submit('Register', ['class' => 'btn btn-sucess','id'=>'bt-signup'] ) !!}
                                   
                          
                                    </div>
                                </div>
                                
                             
                                
                                
                                
                            {!!form::close()!!}
                         </div>
                    </div>

               
               
                
         </div> 

@endsection