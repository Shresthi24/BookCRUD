@extends('layouts.app')
@section('content')

<script src='vendor/assets/lib/jquery.min.js'></script>

<script>
  $('#vendorForm').submit(function(e){
            e.preventDefault();
         var $form = $(e.target);
         var cc=$form.serialize();
           $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: cc,
            success: function(result) {

                $('#vendorform').modal('toggle');
                $('#onsucessajax').fadeIn("fast", function() { $(this).delay(1500).fadeOut("slow"); });
                     },
                        Error:function(data){
               $('#onfailajax').fadeIn("fast", function() { $(this).delay(1500).fadeOut("slow"); });

              }
              });
        });
</script>
<div class="row">
    <div class="col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3">

            <div class="panel-body">

              {!!Form::open([ 'enctype'=>'multipart/form-data','route'=>['clientdatesubmit'],'id'=>'vendorform',
              'class'=>'form','role'=>'form','method'=>'post'])!!}
<div class="row">
@include('clientdateform')
</div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>




 @include('resusable.footer')

@endsection