<html>
    <Head>
        <title>assignment</title>
<link rel="icon" href="{!! asset('images/title-icon.png') !!}"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Jasper">

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('css/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" >

        <!-- MetisMenu CSS -->
        <link href="{{asset('css/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

        <!-- form css -->

        <link href="{{asset('css/dist/css/parentform.css')}}" rel="stylesheet"  type="text/css">

        <!-- fontawesome -->
        <link href="{{asset('css/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.slim.min.js"></script>


        <!-- jQuery -->
        <script src="{{asset('css/vendor/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('css/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- custom css -->
        <link rel="stylesheet" href="{{asset('css/dist/css/indexstyle.css')}}" type="text/css">

        <!-- custom js -->
        <script type="text/javascript" src="{{asset('js/dist/js/index.js')}}"></script>

        <script>
window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
        </script>

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
    </Head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
        </div>


        @yield('welcome')  
        @yield('content')

    </body>
</html>