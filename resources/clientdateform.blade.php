 
 <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


  <div class="form-group">
    {!! Form::hidden('Vendor_id', $last_insert_id1, [ 'class'=>'form-control']) !!}
        <div class="help-block with-errors"></div>
    </div>

<div class="form-group">
    {!! Form::hidden('Client_id', $last_insert_id, [ 'class'=>'form-control']) !!}
        <div class="help-block with-errors"></div>
    </div>

<div class="form-group">
    {!! Form::hidden('Event_id', $last_insert_id2, [ 'class'=>'form-control']) !!}
        <div class="help-block with-errors"></div>
    </div>


<div class="form-group">
    {!! Form::label('Starting date') !!}
    <div >
        {!! Form::date('Starting_date', null, 
            array('required',
            'class'=>'form-control',
            'id'=>'startdate',
            'placeholder'=> 'Service Type '
            )) !!}
        <div class="help-block with-errors"></div>
    </div>
     @if ($errors->has('Starting_date ')) 
                            <p class="help-block" style="color: Red">
                            {{ $errors->first('Starting_date') }}
                            </p>
                             @endif

</div>

<div class="form-group">
    {!! Form::label('Ending Date')!!}
    <div >
        {!! Form::date('Ending_Date', null, 
            array('required',
            'class'=>'form-control',
            'id'=>'enddate',
            'placeholder'=> 'Ending_Date '
            )) !!}
        <div class="help-block with-errors"></div>
    </div>
      @if ($errors->has('Ending_Date '))
                             <p class="help-block" style="color: Red">
                             {{ $errors->first('Ending_Date ') }}
                             </p> 
                             @endif
</div>


<div class="col-xs-12">
   <div class="form-group">
    {!! Form::submit('Submit', 
      array('class'=>'btn btn-primary')) !!}
</div>
</div>

{!! Form::close() !!}