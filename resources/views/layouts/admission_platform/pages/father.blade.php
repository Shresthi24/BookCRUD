@extends('parentform')

@section('title', 'Company details')

@section('fatherform')


<script src="{{asset('js/SearchablePlugin/search/jquery.searchable.js')}}"></script> 
<script src="{{asset('js/SearchablePlugin/search/schoolsearch.js')}}"></script>  

<script>
$(document).ready(function () {

/*father deceased */

if ($("#indianResidentFather").is(':checked')){
    $('#otherResidingCountryFatherDiv').hide();
}
else{

    $('#otherResidingCountryFatherDiv').show();
}
    /*father nationality */

    $("#indianNationalityFather").click(function () {
        $("#rowFatherNationalityOther").val("");
        $("#rowFatherNationalityOther").hide();
    });

    $("#otherNationalityFather").click(function () {
        $("#rowFatherNationalityOther").show();
    });

    /* residence of father */
    $("#fatherMobilePrefix").val('91');
    $("#indianResidentFather").click(function () {
        $("#residingCountryOther").val("");
        $("#otherResidingCountryFatherDiv").hide();
        $("#fatherMobilePrefix").val('91');
    });


    $("#otherResidentFather").click(function () {
        $("#fatherMobilePrefix").val('');
        $("#otherResidingCountryFatherDiv").show();
    });


$("#servicetype").change(function() {
     var serviceselected = $('option:selected', $(this)).val();
         
       
      if (serviceselected == '1') {
             
            $("#productname").hide();
            
        } else if (serviceselected == '2')
        {   
            $("#productname").show();
        

        }

    });


    /*father edu logic */
    $("#highestQualification").change(function () {
        var qualificationselected = $('option:selected', $(this)).val();
alert(qualificationselected);

      
        $("#instituteCity").val("");
        $("#schoolCompleting").val("");
        $("#graduationYear").val("");

        $("#instituteName").prop('disabled', false);
        $("#instituteCity").prop('disabled', false);
        $("#schoolCompleting").prop('disabled', false);
        $("#graduationYear").prop('disabled', false);

        if (qualificationselected == '87') {

            $("#instituteName").prop('disabled', true);
            $("#instituteCity").prop('disabled', true);
            $("#schoolCompleting").prop('disabled', true);
            $("#graduationYear").prop('disabled', true);
        } else if (qualificationselected == '86')
        {
            $("#instituteName").prop('disabled', true);
            $("#instituteCity").prop('disabled', true);

        }

    });


    /*occupt */

    $("#fatherOccupation").change(function () {
        var occuptionselected = $('option:selected', $(this)).val();

        $("#fatherProfession").prop('disabled', false);
        $("#fatherOfficeAddress").prop('disabled', false);
        $("#fatherEmployerName").prop('disabled', false);
            $('#fatherIncome').prop('disabled',false);


        if (occuptionselected == '147') {
            $("#fatherProfession").val("");
            $("#fatherOfficeAddress").val("");
            $("#fatherEmployerName").val("");
            $('#fatherIncome').val("");

            $("#fatherProfession").prop('disabled', true);
            $("#fatherOfficeAddress").prop('disabled', true);
            $("#fatherEmployerName").prop('disabled', true);
            $('#fatherIncome').prop('disabled',true);

        }


    });

   
    
    
    
    $("#fatherDeceasedYes").click(function () {

        fatherDeceasedYes();

    });
    
    
    $("#fatherDeceasedNo").click(function () {
        fatherDeceasedNo();

    });

    /*
     /*father occuption */



    /* search and selecting father school  logic */

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var addFatherSchool = '{{route('addFatherSchool')}}';
    $("#schoolCompleting").click(function () {

        $('#myModal').modal('show');
        $('.fatherschoolsearchtable').find('tr').click(function () {
            var row = $(this).find('td:first').text();

            $('.fatherschoolclicked').val(row);

            $('#selectButtonfatherSchool').click(function () {
                $('#schoolCompleting').val(row);
                $('#myModal').modal('hide');


            });



        });


        /* school add logic */
        $('#fatherschoolfound').click(function () {
            $('#fatherSchooladdtext').val("");
            $('#FatherEnterSchoolrow').hide();
        });

        $('#fatherschoolnotfound').click(function () {

            $('#FatherEnterSchoolrow').show();

            $('#addschoolFatherform').on('submit', function () {
                $.ajax({
                    method: "POST",
                    url: addFatherSchool,
                    data: {body: $('#fatherSchooladdtext').val(), postId: '', _token: CSRF_TOKEN},
                    success: function () {
                        //   $("#content").html(content);


                    }
                }).done(function () {

                    // console.log(data);
                });


            });

        });


    });


    $(window).scroll(function () {
        if ($(this).scrollTop() > 135) {
            $('#accordion').addClass('fixed');
        } else {
            $('#accordion').removeClass('fixed');
        }
    });

    /*help text logic */


    /*help text default */

   

    /*mouse leave help text */
  
    // });

    /* personal details father */
  
    // });

    /*educational details */
    // });

    /*father employement details */
  
    // });


  
    // });



    /*doc upload father */

    var ajaxFatherAdharUploadPost = '{{route('ajaxFatherAdharUploadPost')}}';

    $("#fatherAadharCard").uploadify({
        
        buttonText: 'SELECT FILE',
        fileSizeLimit: '1000KB',
        formData: {'_token': '{{ csrf_token() }}'},
        fileObjName: 'fatherAadharCard',
        fileTypeExts: '*.jpeg;*.JPG;*.jpg;*.JPEG;*.PDF;*.pdf;',
        height: 30,
        swf: 'js/uploadify/uploadify.swf',
        uploader: ajaxFatherAdharUploadPost,
        width: 120,
        'onUploadStart': function (file) {
            if ($('#fatherAadharCardNumber').val() === "")
            {
                $('#fatheraadharcardhelptext').show();
                $('#fatherAadharCard').uploadify('cancel');
            } else
            {
                uploadify_update_formdataAadharCardNumber();
            }

        },
 'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var link = $("<a>");
                link.attr("href",data.path);
                link.text(data.filename);
                link.addClass("link");
                link.attr("download",data.filename);
                 $("#jsonresponseFatherAdharcard").html(link); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
            $('#aadharCardCheck').val(data.filename);
            
        },
        'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError':
                function (file, INVALID_FILETYPE) {
                    alert('The file ' + file.name + ' have invalid extension.');
                }
    });

    function uploadify_update_formdataAadharCardNumber() {

        $("#fatherAadharCard").uploadify('settings', 'formData', {
            'aadharnumber': $('#fatherAadharCardNumber').val()
        });

    }
    $('#fatherAadharCardNumber').on('change', function () {

        uploadify_update_formdataAadharCardNumber()
    });


    var ajaxFatherAddrssProofUploadPost = '{{route('ajaxFatherAddrssProofUploadPost')}}';

    $("#987456").uploadify({
        buttonText: 'SELECT FILE',
        fileSizeLimit: '1000KB',
        formData: {'_token': '{{ csrf_token() }}'},
        fileObjName: 'fatherAddressProofDoc',
        fileTypeExts: '*.jpeg;*.JPG;*.JPEG;*.jpg; *.PDF;*.pdf;',
        height: 30,
        swf: 'js/uploadify/uploadify.swf',
        uploader: ajaxFatherAddrssProofUploadPost,
        width: 120,
        'onUploadStart': function (file) {
            uploadify_update_formdataAddressProof();

        },
        'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var fatherAddressProofDocLink = $("<a>");
                fatherAddressProofDocLink.attr("href",data.path);
                fatherAddressProofDocLink.text(data.filename);
                fatherAddressProofDocLink.addClass("link");
                fatherAddressProofDocLink.attr("download",data.filename);
                 $("#fatherAddressProofDocLink").html(fatherAddressProofDocLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
            $('#AddressDocCheck').val(data.filename);
            
        },
         'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError': function (file, INVALID_FILETYPE) {
            alert('The file ' + file.name + ' have invalid extension.');
        }
    });



    function uploadify_update_formdataAddressProof() {
        $("#987456").uploadify('settings', 'formData', {
            'Doctype': $('#123456').val()
        });
    }
    $('#123456').on('change', function () {
        uploadify_update_formdataAddressProof()
    });

    var ajaxFatherIdentityProofUploadPost = '{{route('ajaxFatherIdentityProofUploadPost')}}';
    $("#fatherIdentityProofDoc").uploadify({
        buttonText: 'SELECT FILE',
        fileSizeLimit: '1000KB',
        formData: {'_token': '{{ csrf_token() }}'},
        fileObjName: 'fatherIdentityProofDoc',
        fileTypeExts: '*.jpeg;*.JPG;*.JPEG;*.jpg; *.PDF;*.pdf;',
        height: 30,
        swf: 'js/uploadify/uploadify.swf',
        uploader: ajaxFatherIdentityProofUploadPost,
        width: 120,
        'onUploadStart': function (file) {
            uploadify_update_formdataIdentityProof();

        },
          'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var fatherIdentityProofDocLink = $("<a>");
                fatherIdentityProofDocLink.attr("href",data.path);
                fatherIdentityProofDocLink.text(data.filename);
                fatherIdentityProofDocLink.addClass("link");
                fatherIdentityProofDocLink.attr("download",data.filename);
                 $("#fatherIdentityProofDocLink").html(fatherIdentityProofDocLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
              $('#IdentityDocCheck').val(data.filename);
            
        },
           'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError': function (file, INVALID_FILETYPE) {
            alert('The file ' + file.name + ' have invalid extension.');
        }
    });


    function uploadify_update_formdataIdentityProof() {
        $("#fatherIdentityProofDoc").uploadify('settings', 'formData', {
            'Doctype': $('#fatherIdProof').val()
        });
    }
    $('#fatherIdProof').on('change', function () {
        uploadify_update_formdataIdentityProof()
    });
    var timer = 0;
    $('#fatherAadharCardNumber').keyup(function () {
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(disableAdharFile, 2000);
    });


    function disableAdharFile()
    {
        if ($.trim($('#fatherAadharCardNumber').val()) === "212223242526")
        {
            $("#fatherAadharCardNumberAstrik").hide();
            $('#fatherAadharCard').uploadify('disable', true);
        } else
        {
            $("#fatherAadharCardNumberAstrik").show();
            $('#fatherAadharCard').uploadify('disable', false);
        }
    }
/*
if ($("#fatherDeceasedYes").is(':checked'))
        {
           fatherDeceasedYes();
        }
else
        {
          fatherDeceasedNo();
        
        }

*/


 function fatherDeceasedNo()
    {
        
        $('#indianResidentFather').attr('checked', false);
        $('#otherResidentFather').attr('checked', false);
        $("#age").val("");
        $("#highestQualification").val("");
        $("#fatherEmployerName").val("");
        $("#instituteName").val("");
        $("#instituteCity").val("");
        $("#fatherOfficeAddress").val("");
        $("#fatherEmployerName").val("");
        $("#fatherOfficeAddress").val("");
        $("#fatherOccupation").val("");
        $("#fatherProfession").val("");
        $("#fatherAnnualIncome").val("");
        $("#fatherdependants").val("");
        $("#fatherMobilePrefix").val("");
        $("#fatherMobileNumber").val("");
        $("#fatherEmail").val("");
        $("#fatherAadharCard").val("");
        $("#fatherAadharCardNumber").val("");
        $("#123456").val("");
        $("#987456").val("");
        $("#fatherIdProof").val("");
        $("#doumentUpload").val("");


        $("#ageAstrik").show();
        $("#indianResidentFatherAstrik").show();
        $("#qualificationAsterisk").show();
        $("#employerAstrik").show();
        $("#officeAstrik").show();
        $("#prefixAstrik").show();
        $("#mobNoAstrik").show();
        $("#employerAstrik").show();
        $("#officeAstrik").show();
        $("#occupationAstrik").show();
        $("#incomeAstrik").show();
        $("#professionAstrik").show();
        $("#dependantsAstrik").show();
        $("#fatherAddressProof").show();
        $("#fatherIdentityProof").show();
        $("#fatherAddressProofDocumentation").show();
        $("#fatherIdentityProofDocumentation").show();
        $("#fatherAadharCardAstrik").show();

        $("#age").prop('disabled', false);
      $("#indianResidentFather").prop('disabled', false);
        $("#otherResidentFather").prop('disabled', false);
        $("#highestQualification").prop('disabled', false);
        $("#fatherdependants").prop('disabled', false);
        $("#fatherOccupation").prop('disabled', false);
        $("#fatherProfession").prop('disabled', false);
        $("#fatherOfficeAddress").prop('disabled', false);
        $("#fatherAnnualIncome").prop('disabled', false);
        $("#fatherEmployerName").prop('disabled', false);
        $("#fatherMobileNumber").prop('disabled', false);
        $("#fatherMobilePrefix").prop('disabled', false);
        $("#doumentUpload").prop('disabled', false);
        $("#instituteName").prop('disabled', false);
        $("#instituteCity").prop('disabled', false);
        $("#fatherEmail").prop('disabled', false);
        $("#fatherAadharCardNumber").prop('disabled', false);
        $("#123456").prop('disabled', false);     
        $("#fatherIdProof").prop('disabled', false);
        $('#fatherIncome').prop('disabled', false);
        
        $('#fatherIdentityProofDoc').uploadify('disable', false);
        $("#987456").uploadify('disable', false);
         $('#fatherAadharCard').uploadify('disable', false);
    }



    function fatherDeceasedYes()
    {
         $("#ageAstrik").hide();
        $("#indianResidentFatherAstrik").hide();
        $("#qualificationAsterisk").hide();
        $("#employerAstrik").hide();
        $("#officeAstrik").hide();
        $("#prefixAstrik").hide();
        $("#mobNoAstrik").hide();
        $("#employerAstrik").hide();
        $("#officeAstrik").hide();
        $("#occupationAstrik").hide();
        $("#incomeAstrik").hide();
        $("#professionAstrik").hide();
        $("#dependantsAstrik").hide();
        $("#fatherAddressProof").hide();
        $("#fatherIdentityProof").hide();
        $("#fatherAddressProofDocumentation").hide();
        $("#fatherIdentityProofDocumentation").hide();
        $("#fatherAadharCardAstrik").hide();

        $("#age").prop('disabled', true);
      //  $("#indianResidentFather").prop('disabled', true);
      //  $("#otherResidentFather").prop('disabled', true);
        $("#highestQualification").prop('disabled', true);
        $("#fatherdependants").prop('disabled', true);
        $("#fatherOccupation").prop('disabled', true);
        $("#fatherProfession").prop('disabled', true);
        $("#fatherOfficeAddress").prop('disabled', true);
        $("#fatherAnnualIncome").prop('disabled', true);
        $("#fatherEmployerName").prop('disabled', true);
        $("#fatherMobileNumber").prop('disabled', true);
        $("#fatherMobilePrefix").prop('disabled', true);
        $("#doumentUpload").prop('disabled', true);
        $("#instituteName").prop('disabled', true);
        $("#instituteCity").prop('disabled', true);
        $("#fatherEmail").prop('disabled', true);
        $("#fatherAadharCardNumber").prop('disabled', true);
        $("#123456").prop('disabled', true);
        $("#fatherIdProof").prop('disabled', true);
        $('#fatherIncome').prop('disabled', true);
        
        $('#fatherIdentityProofDoc').uploadify('disable', true);
       
        $('#fatherAadharCard').uploadify('disable', true);
         $("#987456").uploadify('disable', true);
    }

});





</script> 


<style>


    .table-fixed thead {
        width: 100%;
    }
    .table-fixed tbody {
        height: 200px;
        overflow-y: auto;
        width: 100%;
    }
    .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
        display: block;
    }
    .table-fixed tbody td, .table-fixed thead > tr> th {
        float: center;
        border-bottom-width: 0;
    }


    .fixed {position:fixed; top:20px; margin-right:30px;}


</style>


<div class="col-md-12  col-lg-12">

    <div class="row">
        <div class="col-md-8 col-md-8 col-md-8">

            {!!Form::open(['route'=>'father','class'=>'form','role'=>'form','method'=>'post'])!!}

            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <label>
                        <strong>Company Details :</strong>
                        <label>
                            </div>
                            </div>
                            <!-- father personal details -->
                            <div class="box" id="personDetailsSection">
                                <div class="row">
                                    <div class="col-md-4 col-sm-3 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Name <span
                                                    class="text-danger ">*</span> :
                                            </label>
                                            <div>
                                               
                                                    <input type="text" class= "form-control" name="">
                                              
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Vendor type<span class="text-danger">*</span>
                                            </label>
                                            
                                               {{ Form::select('Servicetype', $servicetype,null,['class' => 'form-control','id'=> 'servicetype' ]) }}
                                                   <!--  <select class="form-control">
                                                      <option value="select-one">select one</option>
                                                    <option value="Venue">Venue/location</option>
                                                      <option value="Service">Service Provider</option>    
                                                    
                                                    </select> -->
                                                
                                         
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group" id= "productname">
                                            <label for="exampleInputEmail1">Service Type<span
                                                    class="text-danger">*</span></label>
                                            <div>

                                               {{ Form::select('Servicetype', $product,null,['class' => 'form-control','id'=> 'servicetype', 'placeholder'=>'Service offered']) }}
                                              <!-- <select class="form-control">
                                                      <option value="select"></option>
                                                    <option value="caterer">caterer</option>
                                                      <option value="DJ">DJ</option> 
                                                      <option value="c">c</option> 
                                                      <option value="D">D</option>    
                                                    <option value="e">e</option> 
                                                    </select> -->
                                                
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>  


                                <div class="row">
                                   <div class="col-md-4 col-sm-3 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Events Available For <span
                                                    class="text-danger ">*</span> :
                                            </label>
                                            <div>
                                               
                                               {{ Form::select('Servicetype', $serviceusage,null,['class' => 'form-control','id'=> 'servicetype', 'placeholder'=>'Events Covered']) }}
                                                
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>

                                           
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <span
                                                    class="text-danger">*</span></label>
                                            <!-- {{Form::text('fatherLastName','', array('id'=>'fatherLastName','class'=>'form-control input_capital','placeholder' => 'Last Name','maxlength' => 10,'value'=>old('fatherLastName') ) )}}       
                                               @if ($errors->has('fatherLastName')) <p class="help-block" style="color: Red">{{ $errors->first('fatherLastName') }}</p> @endif -->
                                        </div>
                                    </div>
                                </div>
                                <div class="">

                <div class="col-md-12">
                    <label>
                        <strong>Contact Information</strong>
                    </label>
                </div>
            </div>

            <!-- Permanent Address -->

            <div class="box" id="permanentAddressSection">

                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group" id="permanentCountryDiv">
                            <label for="permanentCountry">Country <span class="text-danger">*</span></label>
                            {{ Form::select('applicantpermanentCountrycountryId', [''=>''],null,['class'=>'form-control permanentCountry permanentCountry_chosen','id'=>'permanentCountry','value'=>old('applicantpermanentCountrycountryId')]) }}

                            @if ($errors->has('PermanentCountry')) <p class="help-block" style="color: Red">{{ $errors->first('PermanentCountry') }}</p> @endif
                            <span class="text-danger" id="notselectedcountry" style="display: none">Please Select Country
                                before entering Pincode. </span>

                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">            
                            <label for="permanentPincode">Pincode <span class="text-danger" id="pincodeastrik">*</span></label>
                            <input id="permanentPincode" name="applicantpermanentPincode" placeholder="Pincode" class="form-control permanentPincode" type="text" value="{{old('applicantpermanentPincode')}}"/>
                            @if ($errors->has('PermanentPincode')) <p class="help-block" style="color: Red">{{ $errors->first('PermanentPincode') }}</p> @endif
                            <span class="text-danger" id="pernotavailable"  style="display: none"> Pincode entered is incorrect. Proceed with selecting State, City, Area. </span> <span class="text-success" id="peravailable"                                                                                                                                                 style="display: none"> Registered </span>
                            <div id="perloading" style="display:none ;">
                                <i class="fa fa-spinner fa-spin"></i>Saving Information
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="permanentOtherStateName">State </label>
                            <input id="permanentOtherStateName" style=" cursor:none; " readonly="readonly"  name="applicantpermanentStateName" placeholder="State" class="form-control permanentOtherStateName capitalize " type="text" value="{{old('applicantpermanentStateName')}}"/>
                            @if ($errors->has('applicantpermanentStateName')) <p class="help-block" style="color: Red">Required State</p> @endif
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="permanentOtherCityName"> City</label>
                            <input id="permanentOtherCityName" style=" cursor:none; " readonly="readonly"  name="applicantpermanentCityName" placeholder=" City" class="form-control permanentOtherCityName capitalize" type="text" value="{{old('applicantpermanentCityName')}}"/>     
                            @if ($errors->has('applicantpermanentCityName')) <p class="help-block" style="color: Red">Required state</p> @endif
                        </div>
                    </div>
                </div>



                <div class="row" id="notIndiaStateAndCityDiv">



                    <div class="col-md-3 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="permanentAreaName">Area</label>
                            <input id="permanentAreaName" style=" cursor:none; " readonly="readonly" name="applicantpermanentAreaName" placeholder="Area" class="form-control permanentAreaName capitalize" type="text" value="{{old('applicantpermanentAreaName')}}"/>
                            @if ($errors->has('applicantpermanentAreaName')) <p class="help-block" style="color: Red">Required Area</p> @endif
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">            
                            <label for="permanentPincode">District <span class="text-danger" id="pincodeastrik">*</span></label>
                            <input id="District" name="applicantpermanentdistrict" placeholder="District" style=" cursor:none; " readonly="readonly"  class="form-control permanentPincode" type="text" value="{{old('applicantpermanentdistrict')}}"/>
                            @if ($errors->has('applicantpermanentdistrict')) <p class="help-block" style="color: Red">Required District</p> @endif
                            <span class="text-danger" id="pernotavailable"  style="display: none"> Pincode entered is incorrect. Proceed with selecting State, City, Area. </span> <span class="text-success" id="peravailable"                                                                                                                                             style="display: none"> Registered </span>
                            <div id="perloading" style="display: none;">
                                <i class="fa fa-spinner fa-spin"></i>Saving Information
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">            
                            <label for="permanentPincode">Taluka <span class="text-danger" id="pincodeastrik">*</span></label>
                            <input id="District" readonly="readyonly" style=" cursor:none;" name="applicantpermanenttaluka" placeholder="Taluka" class="form-control permanentPincode" type="text" value="{{old('applicantpermanenttaluka')}}"/>
                            @if ($errors->has('applicantpermanenttaluka')) <p class="help-block" style="color: Red">Required Taluka</p> @endif

                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="AreaLocalityName">Locality <span class="text-danger">*</span>
                            </label>
                            <input id="OtherAreaLocalityName" name="applicantAreaLocalityName" placeholder="Enter Locality " class="form-control OtherAreaLocalityName capitalize" type="text" value="{{old('applicantAreaLocalityName')}}"/>
                            @if ($errors->has('applicantAreaLocalityName')) <p class="help-block" style="color: Red">Required Locality</p> @endif
                        </div>
                    </div>
                </div> 

                <div class="row">

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Flat No./Building<span class="text-danger" id="flattAstrick">*</span>
                            </label>
                            <input id="applicantpermanentBuildingName" name="applicantpermanentBuildingName" placeholder="Flat No./Building" class="form-control permanentBuilding capitalize" type="text" value="{{old('applicantpermanentBuildingName')}}"/>
                            @if ($errors->has('PermanentBuilding')) <p class="help-block" style="color: Red">{{ $errors->first('PermanentBuilding') }}</p> @endif
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Street Address<span class="text-danger" id="streetAstrick">*</span> </label>
                            <input id="applicantpermanentStreetName" name="applicantpermanentStreetName" placeholder="Street Address " class="form-control permanentStreetName capitalize" type="text" value="{{old('applicantpermanentStreetName')}}"/>
                            @if ($errors->has('PermanentStreetName')) <p class="help-block" style="color: Red">{{ $errors->first('PermanentStreetName') }}</p> @endif
                        </div>
                    </div>



                   

           
            

                                <!-- <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div id="divAge" class="form-group">
                                            <label for="exampleInputEmail1">Age <span
                                                    class="text-danger" id="ageAstrik">*</span></label>

                                            {{Form::text('fatherAge','', array('id'=>'age','class'=>'form-control input_capital','placeholder' => 'Age','maxlength' => 3,'value'=>old('fatherAge')) )}}       
                                             @if ($errors->has('fatherAge')) <p class="help-block" style="color: Red">{{ $errors->first('fatherAge') }}</p> @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nationality <span
                                                    class="text-danger">*</span> :
                                            </label>
                                            <div>
                                                <label class="radio-inline" for="example-inline-radio1">
                                                    <input id="indianNationalityFather" name="fatherNationality"  type="radio" value="Indian" checked="checked" {{ old('fatherNationality')=="Indian" ? 'checked='.'"'.'checked'.'"' : '' }} /> Indian
                                                </label> <label class="radio-inline" for="example-inline-radio2">
                                                    <input id="otherNationalityFather" name="fatherNationality"  type="radio" value="Other" {{ old('fatherNationality')=="Other" ? 'checked='.'"'.'checked'.'"' : '' }}/> Other
                                                </label>
                                            </div>
                                              @if ($errors->has('fatherNationality')) <p class="help-block" style="color: Red">{{ $errors->first('fatherNationality') }}</p> @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12"
                                         id="rowFatherNationalityOther"
                                         style="display:none ;">
                                        <div class="">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Other Nationality
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input id="otherNationality" name="fatherMasterfatherNationalityOther" placeholder="Nationality" class="form-control input_capital" type="text" value="{{old('fatherMasterfatherNationalityOther')}}"/>
                                                  @if ($errors->has('fatherMasterfatherNationalityOther')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherNationalityOther') }}</p> @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Religion <span
                                                    class="text-danger">*</span></label>
                                            {{ Form::select('fatherMasterfatherReligionserialId', [''=>''],null,['class'=>'form-control','id'=>'fatherMasterfatherReligionserialId','value'=>old('fatherMasterfatherReligionserialId')]) }}  
                                             @if ($errors->has('fatherMasterfatherReligionserialId')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherReligionserialId') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group" >
                                            <label>Country Of
                                                Residence<span class="text-danger" id="indianResidentFatherAstrik">*</span>
                                            </label>
                                            <div>
                                                <label >
                                                    <input id="indianResidentFather" name="fatherMasterfatherResidingCountry" type="radio" value="India" checked="true" {{ old('fatherMasterfatherResidingCountry')=="India" ? 'checked='.'"'.'checked'.'"' : '' }}  /> India
                                                </label> 
                                                <label>
                                                    <input id="otherResidentFather" name="fatherMasterfatherResidingCountry"  type="radio" value="Other" {{ old('fatherMasterfatherResidingCountry')=="Other" ? 'checked='.'"'.'checked'.'"' : '' }}   /> Other
                                                </label>
                                                 @if ($errors->has('fatherMasterfatherResidingCountry')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherResidingCountry') }}</p> @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12"
                                         id="otherResidingCountryFatherDiv"
                                         style="display: none;">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Country Of
                                                Residence <span class="text-danger">*</span>
                                            </label>
                                            <input id="residingCountryOther" name="fatherMasterfatherResidingCountryOther" placeholder="Country Of Residence" class="form-control input_capital" type="text" value="{{ old('fatherMasterfatherResidingCountryOther') }}"/>
                                         @if ($errors->has('fatherMasterfatherResidingCountryOther')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherResidingCountryOther') }}</p> @endif
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Id</label>
                                            <input id="fatherEmail" name="fatherMasterfatherEmail" placeholder="Email Id" class="form-control " type="text" value="{{ old('fatherMasterfatherEmail') }}"/>
                                             @if ($errors->has('fatherMasterfatherEmail')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherEmail') }}</p> @endif
                                        </div>
                                    </div>
                                 -->    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div id="divprefix" class="form-group">
                                            <label for="exampleInputEmail1">Mobile Prefix <span
                                                    class="text-danger" id="prefixAstrik">*</span></label>
                                                    <input id="fatherMobilePrefix" name="fatherMasterfatherMobilePrefix" placeholder="Enter country code, for eg. + 91 for India" class="form-control" type="text" maxlength="4" value="{{ old('fatherMasterfatherMobilePrefix') }}"/>
                                                    @if ($errors->has('fatherMasterfatherMobilePrefix')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherMobilePrefix') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div id="divMobNo" class="form-group">
                                            <label for="exampleInputEmail1">Mobile Number <span
                                                    class="text-danger" id="mobNoAstrik">*</span></label>
                                            <input id="fatherMobileNumber" name="fatherMasterfatherMobile" placeholder="Mobile Number" class="form-control" type="text" value="{{ old('fatherMasterfatherMobile')}}"/>
                                             @if ($errors->has('fatherMasterfatherMobile')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherMobile') }}</p> @endif
                                        </div>
                                    </div>
                                 
                                </div>
                                            <label for="exampleInputEmail1">Company Website (if available) <span
                                                    class="text-danger ">*</span> :
                                            </label>
                                            <div>
                                               
                                                    <input type="text" class= "form-control" name="">
                                              
                                                
                                                
                                            </div>
                 <label for="exampleInputEmail1">Contact Email address <span
                                                    class="text-danger ">*</span> :
                                            </label>
                                            <div>
                                               
                                                    <input type="text" class= "form-control" name="">
                                              
                                                
                                                
                                            </div>
                            </div>
                             </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <strong> Particulars</strong>
                                    </label>
                                </div>
                           </div>
                            <!-- father edu -->
                            <div class="box" id="educationSection">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div id="divhighestQualificaction" class="form-group">
                                            <label for="exampleInputEmail1">Maximum Headcount <span class="text-danger"  id="qualificationAsterisk">*</span>
                                            </label>
                                            <input type="text" class= "form-control" name="">
  
                                            @if ($errors->has('fatherMasterfatherHighestQualificationserialId')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherHighestQualificationserialId') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div id="divnameofinstitute" class="form-group">
                                            <label for="exampleInputEmail1">Minimum Headcount <span class="text-danger"
                                                                id="instituteNameAsterisk" style="display: none;">*</span>
                                            </label>
                                            <input type="text" class= "form-control" name="">
                                          @if ($errors->has('fatherMasterfatherNameOfInstitute')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherNameOfInstitute') }}</p> @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div id="divcityofinstitute" class="form-group">
<!--                                            <label for="exampleInputEmail1">Institute City<span
                                                    class="text-danger" id="instituteCityAsterisk"
                                                    style="display: none;">*</span>
                                            </label>
                                            <input id="instituteCity" name="fatherMasterinstituteCity" placeholder="Institute City" class="form-control input_capital" type="text" value="{{ old('fatherMasterinstituteCity')}}"/>
                                            @if ($errors->has('fatherMasterinstituteCity')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterinstituteCity') }}</p> @endif
                                    -->    </div>
                                    </div>
                                </div>

                                <div class="row">





                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Items included in cost </label>
                                            <div>
                                                          <input type="text" class= "form-control" name="">
<!--                                                <input type="text" id="schoolCompleting" name="fatherMasterschoolid" class="form-control fatherschool" value="{{ old('fatherMasterschoolid') }}">
                                                     @if ($errors->has('fatherMasterschoolid')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterschoolid') }}</p> @endif-->

                                            </div>
                                        </div>
                                    </div> 


                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <span class="text-danger"
                                                                    id="graduationYearAsterisk" style="display: none;">*</span>
                                            </label>
<!--                                            {{ Form::selectYear('graduationYear', 1970, [''=>''],null,['id'=>'graduationYear','class' => 'form-control','size'=>'1','placeholder'=>'Select year','value'=>old('graduationYear')]) }}
                                            @if ($errors->has('graduationYear')) <p class="help-block" style="color: Red">{{ $errors->first('graduationYear') }}</p> @endif
                                    -->    </div>
                                    </div>

                                </div>



                            </div>

<!--
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <strong>Father's Employment Details :</strong>
                                    </label>
                                </div>
                            </div>-->


<!--                            <div class="box" id="employmentDetails">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div id="divfatherOccupation" class="form-group">
                                            <label for="exampleInputEmail1">Occupation<span
                                                    class="text-danger" id="occupationAstrik">*</span>
                                            </label>
                                            {{ Form::select('fatherMasteroccupationserialId', [''=>''],null,['class'=>'form-control fatherOccupation','id'=>'fatherOccupation','placeholder'=>'Select Occupation','value'=>old('fatherMasteroccupationserialId')]) }}
                                              @if ($errors->has('fatherMasteroccupationserialId')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasteroccupationserialId') }}</p> @endif
                                        </div>

                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div id="divfatherProfession" class="form-group">
                                            <label for="exampleInputEmail1">Profession<span
                                                    class="text-danger" id="professionAstrik">*</span>
                                            </label>
                                            {{ Form::select('fatherMasterprofessionserialId', [''=>''],null,['class'=>'form-control fatherProfession','id'=>'fatherProfession','placeholder'=>'Select Profession','value'=>old('fatherMasterprofessionserialId')]) }}
                                                     @if ($errors->has('fatherMasterprofessionserialId')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterprofessionserialId') }}</p> @endif
                                        </div>
                                    </div>

                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div id="divfatherEmployerName" class="form-group">
                                            <label for="exampleInputEmail1">
                                                Business/Employer's Name<span class="text-danger"
                                                                              id="employerAstrik">*</span>
                                            </label>
                                            <input id="fatherEmployerName" name="fatherMasterfatherEmployerName" placeholder="Employer&#39;s Name" class="form-control input_capital" type="text" value='{{ old('fatherMasterfatherEmployerName') }}'/>
                                       @if ($errors->has('fatherMasterfatherEmployerName')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherEmployerName') }}</p> @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">


                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="divfatherOfficeAddress" class="form-group">
                                            <label for="exampleInputEmail1">Office Address <span
                                                    class="text-danger" id="officeAstrik">*</span></label>
                                            <input id="fatherOfficeAddress" name="fatherMasterfatherOfficeAddress" placeholder="Office Address" class="form-control input_capital" type="text" value="{{ old('fatherMasterfatherOfficeAddress') }}"/>
                                            @if ($errors->has('fatherMasterfatherOfficeAddress')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherOfficeAddress') }}</p> @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="divannualIncome" class="form-group">
                                            <label for="exampleInputEmail1">Annual Income<span
                                                    class="text-danger" id="incomeAstrik">*</span>
                                            </label>
                                            {{ Form::select('fatherMasterfatherMonthlyIncomeserialId', [''=>''],null,['class'=>'form-control','id'=>'fatherIncome','placeholder'=>'Select Profession','value'=>old('fatherMasterfatherMonthlyIncomeserialId') ]) }}
                                            @if ($errors->has('fatherMasterfatherMonthlyIncomeserialId')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterfatherMonthlyIncomeserialId') }}</p> @endif
                                        </div>
                                    </div>



                                </div>


                            </div>-->




                            <div class="row">
                                <div class="col-md-12">
          
                                        <label>Photographs :</label>
                                </div>
                            </div>

                            <div class="box" id="documentSection">

                                <div class="row">

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                             <label for="exampleInputEmail1">Photo<span
                                    class="text-danger">*</span>
                            </label><br> <a href="#imagecrop_popup" data-toggle="modal"
                                            data-backdrop="static" data-keyboard="false"
                                            class="control-label" id="imagecropLink">Click Here
                                to Upload a photo of the Venue or of Prior events</a>
                              
<!--                                            <label for="exampleInputEmail1">Aadhar Card Number
                                                <span class="text-danger" id="fatherAadharCardNumberAstrik">*</span></label>
                                            <input id="fatherAadharCardNumber" name="fatherMasteraadharCardNumber" placeholder="Aadhar Card Number" class="form-control" type="text" value="{{ old('fatherMasteraadharCardNumber') }}"/>
                                             @if ($errors->has('fatherMasteraadharCardNumber')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasteraadharCardNumber') }}</p> @endif
                                            <b class="help-block" >Enter 212223242526 If do not have Aadhar card</b>
                                            <div id="fatheraadharcardhelptext" style="display: none"> <p class="help-block" style="color: Red">Aadhar Card Number Required</p></div>-->
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xs-12">

                                    </div> 

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
<!--                                            <label for="exampleInputEmail1">Aadhar Card &nbsp;</label><span
                                                class="text-danger" id="fatherAadharCardAstrik">*</span>

                                            <input type="file" id="fatherAadharCard"
                                                   name="fatherAadharCard"
                                                   accept="image/jpg,image/jpeg,image/pdf">
                                            <div id="jsonresponseFatherAdharcard"> </div>-->

                                        </div>
                                         @if ($errors->has('aadharCardCheck')) <p class="help-block" style="color: Red">{{ $errors->first('aadharCardCheck') }}</p> @endif
                                    </div>


                                </div>



                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div id="divaddressProof" class="form-group">
<!--                                            <label for="exampleInputEmail1">Address Proof<span
                                                    class="text-danger" id="fatherAddressProof">*</span>
                                            </label>
                                            {{ Form::select("fatherMasterdocumentsserialId",  [''=>''],null,['class'=>'form-control','id'=>'123456','value'=>'','placeholder'=>'Select Adress Proof','value'=>old('fatherMasterdocumentsserialId')]) }}  

                                        </div>
                                         @if ($errors->has('fatherMasterdocumentsserialId')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasterdocumentsserialId') }}</p> @endif-->
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xs-12">

                                    </div>

                                    <div id="divaddressdocuments" class="col-md-4 col-sm-6 col-xs-12">
                                        <div id="divadrressdocument" class="form-group">
<!--                                            <label for="exampleInputFile">Address Proof
                                                Document<span class="text-danger"
                                                              id="fatherAddressProofDocumentation">*</span>
                                            </label>-->


<!--                                            <input type="file" id="987456"
                                                   name="fatherAddressProofDoc" 
                                                   accept="image/jpg,image/jpeg,image/pdf">

                                            <div id="fatherAddressProofDocLink"></div>-->


                                        </div>
                                         @if ($errors->has('AddressDocCheck')) <p class="help-block" style="color: Red">{{ $errors->first('AddressDocCheck') }}</p> @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div id="dividentityProof" class="form-group">
<!--                                            <label for="exampleInputEmail1">Identity Proof<span
                                                    class="text-danger" id="fatherIdentityProof">*</span>
                                            </label>
                                            {{ Form::select("fatherMasteridentityProofserialId",  [''=>''],null,['class'=>'form-control','id'=>'fatherIdProof','value'=>'','placeholder'=>'Select Identity Proof']) }}  
                                             @if ($errors->has('fatherMasteridentityProofserialId')) <p class="help-block" style="color: Red">{{ $errors->first('fatherMasteridentityProofserialId') }}</p> @endif-->
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">

                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div id="divdocumentproof" class="form-group">
<!--                                            <label for="exampleInputFile">Identity Proof
                                                Document<span class="text-danger"
                                                              id="fatherIdentityProofDocumentation">*</span>
                                            </label>-->


<!--                                            <input type="file" id="fatherIdentityProofDoc"
                                                   name="fatherIdentityProofDoc" 
                                                   accept="image/jpg,image/jpeg,image/pdf">
-->
                                            <div id="fatherIdentityProofDocLink"></div>
                                        </div>
                                          @if ($errors->has('IdentityDocCheck')) <p class="help-block" style="color: Red">{{ $errors->first('IdentityDocCheck') }}</p> @endif
                                    </div>
                                </div>
                            </div>


                            <br>
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-xs-12 text-center">

                                    <button id="submit" class="save btn btn-success">Save And Proceed</button>
                                </div>
                            </div>







                            <input type='hidden' name="aadharCardCheck" id='aadharCardCheck' value=''>
                            <input type='hidden' name="AddressDocCheck" id='AddressDocCheck' value=''>
                            <input type='hidden' name="IdentityDocCheck" id='IdentityDocCheck' value=''>





                            {!!form::close()!!}
                            </div>
                            <!-- help text start-->
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

                                                    <div id="defaultlangHelp" style="color:green; font-weight:normal;" ><span></div></span>
                                                    <div id="selectedhelpText" style="color:blue; font-weight:normal;"><span></div></span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--help text end -->

                            </div>

                            <!-- modal for other school -->

                            <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                            <h4 class="modal-title center">Completed Standard
                                                10 From</h4>
                                        </div>
                                        <div class="modal-body"   style="overflow-y: hidden; max-height:40%;  margin-top: 0; margin-bottom:0;">

                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="searchschool" class="col-md-3 col-form-label" style="padding-right: 0px;  ">Search School</label>

                                                    <div class=" col-md-7">
                                                        <div class="input-group">
                                                            <input type="search" id="search" value="" class="form-control fatherschoolclicked" placeholder="Search School">
                                                            <div class="input-group-btn">
                                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>    

                                            <table class="table table-fixed text-center fatherschoolsearchtable" id="table">
                                                <thead>
                                                    <tr>

                                                        <th class="text-center">School Name</th>

                                                    </tr>
                                                </thead>
                                                <!-- all school populated down here -->
                                               <!--  -->
                                            </table>


                                            <form class="form-inline " id="addschoolFatherform" method="post">  
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <label class="" for="inlineFormInputGroup" style="margin-left:20px;">School found ? &nbsp; </label>

                                                    <label class="radio-inline" for="example-inline-radio1">
                                                        <input id="fatherschoolfound" name="fatherschool"  type="radio" value="1" checked="checked"/> Yes
                                                    </label> 
                                                    <label class="radio-inline" for="example-inline-radio2">
                                                        <input id="fatherschoolnotfound" name="fatherschool" type="radio" value="0" />
                                                        No
                                                    </label>



                                                </div>

                                                <div class="row"  id="FatherEnterSchoolrow" style="display:none;">

                                                    <label class="" for="inlineFormInput" style="margin-left:20px; margin-top:20px; ">Add School &nbsp;</label>
                                                    <input type="text" class="form-control " id="fatherSchooladdtext" placeholder="Enter School Name" value="" >
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>                                           


                                            </form>

                                        </div>
                                        <div class="modal-footer">



                                            <a href="#" id="selectButtonfatherSchool" data-dismiss="modal" class="btn">Select</a>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- modal end -->

                            </div>

   

                            <!-- main col end -->


                            @endsection