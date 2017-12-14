 
 <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>





<div class="row">
          

     <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
        {!! Form::label('Book Name')  !!}
        <span class="text-danger ">*</span>
        <div>

            {!! Form::text('book_name', null, 
                array('required',
                'class'=>'form-control',
                'placeholder'=> 'Book Name '
                ) )!!}
            <div class="help-block with-errors"></div>
        </div>
          @if ($errors->has('book_name')) 
                                <p class="help-block" style="color: Red">
                                {{ $errors->first('book_name') }}
                                </p>
                                 @endif
    </div>
    </div>


     <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
        {!! Form::label('Publication Name') !!}
         <span class="text-danger ">*</span>
        <div>
            {!! Form::text('publish_name', null, 
               array( 'required',
                'class'=>'form-control',
                'placeholder'=> 'Publication Name'
                )) !!}
            <div class="help-block with-errors"></div>
        </div>
        @if ($errors->has('publish_name')) 
                                <p class="help-block" style="color: Red">
                                {{ $errors->first('publish_name') }}
                                </p>
                                 @endif

    </div>
    </div>

     <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
        {!! Form::label('Enviromentory Count')  !!}
        <span class="text-danger ">*</span>
        <div >
            {!! Form::number('environementry_count', null, 
               array( 'required',
                'class'=>'form-control',
                'placeholder'=> 'Enviromentory Count'
                )) !!}
            <div class="help-block with-errors"></div>
        </div>
          @if ($errors->has('EnviromentoryName'))
                                 <p class="help-block" style="color: Red">
                                 {{ $errors->first('EnviromentoryName') }}
                                 </p> 
                                 @endif
    </div>
    </div>
    </div>


<div class="col-xs-12">
   <div class="form-group">
    {!! Form::submit('Submit', 
      array('class'=>'btn btn-primary')) !!}
</div>
</div>

{!! Form::close() !!}