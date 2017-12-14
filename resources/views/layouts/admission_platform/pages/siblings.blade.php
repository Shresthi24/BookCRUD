
@extends('parentform')

@section('title', 'Sibling\'s Form')

@section('siblingform')


 

<style>


    .fixed {position:fixed; top:20px; margin-right:30px;}




</style>
<div class="col-md-12  col-lg-12">
    <div class="row">
        <div class="col-md-8 col-md-8">
          {!!Form::open(['route'=>'siblingpost','class'=>'form','role'=>'from','method'=>'post','id'=>'myform'])!!}
                <div class="row">
                    
                    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<input type="hidden" name="_token" value="<?=csrf_token()?>">
                    <div class="col-md-8 col-lg-8 col-xs-8">
                        
                        @inject('ApplicantName', 'App\helper\ApplicantNameHelper');
                        
                        <h3><strong>School Going Brothers/Sisters : {{ $ApplicantName->GetApplicantName() }}</strong>
                            <br> <small>Please Enter brother(s) and/or sister(s) of </small></h3>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-8 col-md-8">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Has Brother and/or Sister <span
                                    class="text-danger">*</span> :
                            </label>
                            <div>
                                <label class="radio-inline" for="example-inline-radio1">
                                     <input id="siblingno" name="applicanthasSiblings" type="radio" value="false" checked="checked"   {{ old('applicanthasSiblings')=="false" ? 'checked='.'"'.'checked'.'"' : '' }}  /> No 
                                   
                                </label> <label class="radio-inline" for="example-inline-radio2">
                                    <input id="siblingyes" name="applicanthasSiblings" type="radio" value="true"  {{ old('applicanthasSiblings')=="true" ? 'checked='.'"'.'checked'.'"' : '' }} /> Yes
                                </label> 
                            </div>
                        </div>


                    </div>
                </div> 


                
                    <div class="row" id="countDivBrother"
                         style="display:none ;">
                        <div class="col-md-12 col-sm-3 col-xs-12">
                            <label for="exampleInputEmail1">No. Of Brother(s)</label>
                        </div>
                    
                    
                        <div class="col-md-4 col-sm-4 col-xs-8">
                            <div class="form-group">

                                <div>
                                     {{ Form::select("applicantbrotherCount", ['1'=>'1','2'=>'2','3'=>'3'],null,['class'=>'form-control','id'=>'brotherCount','value'=>'','placeholder'=>'Select No. Of Brother(s)','value'=>old('applicantsisterCount')]) }}  
                            


                                </div>
                            </div>
                        </div>
                     
                </div>
                    <!-- sample -->
                    <div class="box brotherbox" id="brotherbox" style="margin-bottom: 20px; display:none;">
                        <div id="brother">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8"> 
                                    <H4>Brother Details</H4>
                                </div>

                            </div>
                            <div class="row brorow1">
                                <div class="col-lg-4 col-md-4 col-sm-4"> 
                                    <div class="form-group">
                                        <label for="First Name">First Name <span
                                                class="text-danger">*</span></label>
                                        <input id="firstnamebrother" name="firstnamebrother" placeholder="First Name" class="form-control input_capital firstname" type="text" value=""/> 
                                         @if ($errors->has('motherMastermotherLastName')) <p class="help-block" style="color: Red">{{ $errors->first('motherMastermotherLastName') }}</p> @endif
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4"> 
                                    <div class="form-group">
                                        <label for="Last Name">Last Name <span
                                                class="text-danger">*</span></label>
                                        <input id="lastnamebrother" name="lastnamebrother" placeholder="Last Name" class="form-control input_capital secondname" type="text" value=""/> 
                                  
                                    </div>
                                </div>
                                
                                    <div class="form-group" style="display:none;">
                                      <input type="text" value="1" name="isbrother" id="isbrother" class="isbrother">
                                    </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"> 
                                    <div class="form-group">
                                        <label for="Sibling age">Sibling Age <span
                                                class="text-danger">*</span></label>
                                                <input id="agebrother" name="agebrother" placeholder="Age" class="form-control input_capital agebrother" maxlength="2" type="text" value=""/> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8"> 
                                    <div class="form-group">
                                        <label for="School Name">School <span
                                                class="text-danger">*</span></label>
                                        <select id="brotherschool" name="brotherschool" class="form-control schoolselect">
                                            <option value="">Select School</option>
                                            <option value="1"></option>
                                            <option value="2"></option>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"> 
                                    <div class="form-group">
                                        <label for="School Name">Class <span
                                                class="text-danger">*</span></label>
                                                  {{ Form::select("brotherclass",$Classname,null,['class'=>'form-control classselect','id'=>'brotherclass','value'=>'','placeholder'=>'Select Class','value'=>old('brotherclass')]) }}  
                   
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"> 
                                    <div class="form-group">
                                        <label for="School Name">Division <span
                                                class="text-danger">*</span></label>
                                                
                                                <input type="text" class="form-control divisionselect" id="brotherdiv" name="brotherdiv" >
           
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"> 
                                    <div class="form-group">
                                        <label for="School Name">Roll No. <span
                                                class="text-danger">*</span></label>
                                                <input type="text" id="brotherroll" name="brotherroll" placeholder="Roll No" maxlength="2" class="form-control rollselect">      
            

                                    </div>
                                </div>
                            </div>




                        </div>

                    </div>
               

                <!-- sister below -->
                <div class="row" id="countDivSister"
                     style="display:none;">
                    <div class="col-md-12 col-sm-3 col-xs-12">
                        <label for="exampleInputEmail1">No. Of Sister(s)</label>
                    </div>

              
                
                    <div class="col-md-4 col-sm-4 col-xs-8">
                        <div class="form-group">
                            <div>
                                 {{ Form::select("applicantsisterCount", ['1'=>'1','2'=>'2','3'=>'3'],null,['class'=>'form-control','id'=>'sisterCount','value'=>'','placeholder'=>'Select No. Of Sister(s)','value'=>old('applicantsisterCount')]) }}  
                    
                            </div>
                        </div>
                    </div>
                </div>
                   
                <!-- logic for number of bro sister in jquery -->

                <div id="sisterbox" class="box sisterbox" style="margin-bottom: 20px; display:none;">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8"> 
                            <H4>Sister Details</H4>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4"> 
                            <div class="form-group">
                                <label for="First Name">First Name <span
                                        class="text-danger">*</span></label>
                                <input id="firstnamesister" name="firstnamesister" placeholder="First Name" class="form-control input_capital firstname" type="text" value=""/> 
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
                        <input type="text" value="0" name="isSister" id="isSister" class="isSister">
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4"> 
                            <div class="form-group">
                                <label for="Last Name">Last Name <span
                                        class="text-danger">*</span></label>
                                <input id="lastnamesister" name="lastnamesister" placeholder="Last Name" class="form-control input_capital secondname" type="text" value=""/> 
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"> 
                            <div class="form-group">
                                <label for="Sibling age">Sibling Age <span
                                        class="text-danger">*</span></label>
                                <input id="agesister" name="agesister" placeholder="Age" class="form-control input_capital agesister" type="text" maxlength="2" value=""/> 
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"> 
                            <div class="form-group">
                                <label for="School Name">School <span
                                        class="text-danger">*</span></label>
                                <select id="sisterschool" name="sisterschool" class="form-control selectschool">
                                    <option value="">Select School</option>
                                    <option value="1"></option>
                                    <option value="2"></option>

                                </select>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"> 
                            <div class="form-group">
                                <label for="School Name">Class <span
                                        class="text-danger">*</span></label>
                                    {{ Form::select("sisterclass",$Classname,null,['class'=>'form-control classselect','id'=>'sisterclass','placeholder'=>'Select Class','value'=>old('sisterclass')]) }}       
                          
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-8"> 
                            <div class="form-group">
                                <label for="School Name">Division <span
                                        class="text-danger">*</span></label>
                                        <input type="text" id="sisterdiv" name="sisterdiv" class="form-control divisionselect">       
                            

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-8"> 
                            <div class="form-group">
                                <label for="School Name">Roll No. <span
                                        class="text-danger">*</span></label>
                                          <input type="text" id="sisterroll" name="sisterroll" placeholder="Roll No" maxlength="3" class="form-control rollselect">       
      

                            </div>
                        </div>

                    </div>

                </div>
                <br><br>

                <div class="col-xs-12 text-center" style="
                     margin-bottom: 20px;">

                    <button type="submit" id="draft" class="btn btn-success">Save
                        As Draft</button>

                    <button type="submit" id="submit" class="btn btn-success">Save And Proceed</button>
                </div>
                <br>

           {!!form::close()!!}  
       
    </div>       
    <!--  whole row of total rows -->
     <div class="col-md-4 col-sm-4 col-xs-12" id="hello" style="margin-top:40px;">

            <div class='row'>
                <div class="panel-group scrollingBox hidden-xs" id="accordion"
                     role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="true" aria-controls="collapseOne">
                                    <h5 style="color: #357f50;">
                                        <i class="fa fa-minus-square text-success"></i><strong>
                                            Help Section</strong>
                                    </h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in"
                             role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body" id="tooltip">

                                <div id="defaultlangHelp" style="color:green; font-weight:normal;" ></div>
                                <div id="selectedhelpText" style="color:blue; font-weight:normal;"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>
<!-- total rows -->
   
@include('customscripts.siblingscripts')
@include('vendor.lrgt.ajax_script', ['form' => '#myform','request'=>'App/Http/Requests/TestRequest','on_start'=>false])
</div>
<script>
        $(function(){ // this will be called when the DOM is ready
  $('#firstnamebrother1').keyup(function() {
    alert('Handler for .keyup() called.');
  });
});
    </script>

@endsection