<!doctype HTML>
<html>

<Head>

  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jasper">

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" >
  
     <!-- MetisMenu CSS -->
    <link href="{{asset('css/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- fontawesome -->
    <link href="{{asset('css/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
	
     <!-- jQuery -->
     <script src="{{asset('css/vendor/jquery/jquery.min.js')}}"></script>
	
     <!-- Bootstrap Core JavaScript -->
     <script src="{{asset('css/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<!-- custom css -->
	<link rel="stylesheet" href="{{asset('css/dist/css/indexstyle.css')}}" type="text/css">
	
<!-- custom js -->
	<script type="text/javascript" src="{{asset('js/dist/js/index.js')}}"></script>
	
	
	
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
</Head>
<body>

<nav class="navbar transparent navbar-default" role="navigation">
<div class="navbar-inner">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	
   
	    <div>
	  <img src="{{asset('images/admissionlogo.png')}}"  class="logo-style">

	  </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

  
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Already have an account?</p></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" id="loginbar" data-toggle="dropdown"><b>Login</b> <span class="fa fa-user fa-fw"></span></a>
			
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>

 <div id="loginbox" style="margin-top:50px; display:none; " class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading" id="panel-heading1">
                        <div class="panel-title">User Login</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" style="color:white;">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
                            </div>
									
			   <div style="margin-bottom: 25px" class="input-group">
                                     <span class="input-group-addon"><i class="fa fa-phone"></i></span>
       
                                        <input type="text" class="form-control" name="name" placeholder="Enter registered Mobile Number">
                                 
                                </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                                    


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <a id="btn-login" href="#" class="btn btn-success">Login  </a>
                              

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
		
		<div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading"  id="panel-heading1">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 100%; position: relative; top:-10px; color:whi"><a style="color:white;" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" placeholder="Applicant First Name eg:Arun">
                                    </div>
                                </div>
								
								          <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Mobile No.</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="Mobile Number">
                                    </div>
                                </div>
                              
                                
                             

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button  id="bt-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                               
                                    </div>
                                </div>
                                
                             
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 



</body>
</html>