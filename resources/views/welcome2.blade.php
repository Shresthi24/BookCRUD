
<html>

<Head>
      <title>Home Page</title>
      
          
          
       

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

<Body>
    
    <nav class="navbar transparent navbar-default" role="navigation" style="margin-bottom: 0px">
<div class="navbar-inner" style="margin-bottom: 0px>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="margin-bottom: 0px">
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
                  
                  
                <!--   <li><p class="navbar-text">Already have an account?</p></li>  -->
        <li class="dropdown">
            
              @if (Route::has('login'))
                    <div class="top-right links">
                    @if (Auth::check())
                        <li><a href="{{ url('/home') }}">Home</a></li>
                   
                         @else
                         
                          <li><a href="{{ url('/home') }}">Home</a></li>
                           <li><a href="{{ url('/home') }}">Home</a></li>
                         
                     <!--      <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>  -->
            
                    @endif
                
             @endif

                    </li>

                </ul>
    
    
       </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>
    
</Body>
</html>