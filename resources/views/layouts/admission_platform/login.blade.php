@extends('main')
@section('loging')
 
 <div id="loginbox" style="margin-top:50px;  " class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading" id="panel-heading1">
                        <div class="panel-title">User Login</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href='{{ route('fp') }}' id="fp"  style="color:white;">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                           {!!Form::open(['action'=>"{{url('/login')}}",'id'=>'loginform','class'=>'form-horizontal','role'=>'form','action'=>'post'])!!}
                          
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                   
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        {{Form::text('username','', array('required' => 'required','class'=>'Form-control','placeholder' => 'Enter Username','maxlength' => 10 ) )}}
                                                                       
                            </div>
				
			   <div style="margin-bottom: 25px" class="input-group">
                                     <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                      {{Form::number('phoneno','',array('required' => 'required','class'=>'Form-control','placeholder'=>'Enter Registered Mobile No','maxlength' => 10))}}
                                      
                                 
                                </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        {{Form::password('password',array('required' => 'required','class'=>'form-control','placeholder'=>'Password') ) }}
                                    </div>
                                    


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                    {!! Form::submit('Login', ['class' => 'btn btn-success'] ) !!}
                              

                                    </div>
                                </div>


                                <div class="form-group"  >
                                    <div class="col-md-12 control"  >
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                    <a href='{{ route('register') }}' onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                           
                                            Sign Up Here
                                        </a> 
                           
                                        </div>
                                    </div>
                                </div>    
                       {{Form::close()}}  



                        </div>                     
                    </div>  
        </div>
		



@endsection

