@extends('main')

@section('forgotpassword')


		 		<div id="forgotpassword" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading"  id="panel-heading1">
                            <div class="panel-title">Forgot Password</div>
                            <div style="float:right; font-size: 100%; position: relative; top:-10px; color:whi"><a id="fp-signin" style="color:white;" href='{{ route('login') }}' >Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                        {!!Form::open(['url'=>'fp','class'=>'form-horizontal','id'=>'signupform','role'=>'from'])!!}
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Mobile No</label>
								
									
                                    <div class="col-md-9">
                                     
                                         {!!Form::number('phonenumber','',array('class'=>'form-control','Enter Registered Mobile Number'))!!}
                                    </div>
                                </div>
								
                                
                                    
                               

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                       
                                            {!! Form::submit('Sign Up', ['class' => 'btn btn-info','id'=>'bt-signup'] ) !!}
                                    </div>
                                </div>
                                
                             
                                
                                
                                
                           {!! form::close()!!}
                         </div>
                    </div>

               
               
                
         </div> 



@endsection