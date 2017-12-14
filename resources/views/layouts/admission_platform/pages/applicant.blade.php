@extends('layouts.app')

@section('title', 'Vendor\'s Form')

@section('applicantform')

<script src="{{asset('js/SearchablePlugin/search/jquery.searchable.js')}}"></script> 
<script src="{{asset('js/SearchablePlugin/search/schoolsearch.js')}}"></script>  
<link href="{{asset('css/croppic/applicantphoto.css')}}" rel="stylesheet" type="text/css" > 
<link href="{{asset('css/croppic/croppic.css')}}" rel="stylesheet" type="text/css" >
<script src="{{asset('js/croppic/croppic.js')}}"></script> 

<script type="text/javascript">

$(document).ready(function () {

/*nationality of applicant on validatiion*/
if ($("#otherNationality").is(':checked'))
        {
        $("#rowNationalityOther").show();
        }
else
        {
        $("#rowNationalityOther").hide();
        }

/*current address on ready doc */
if ($('#differentaddress').is(':checked')) {  $('#currentAddressSection').show();
$('#applicantCurrAddressHeader').show();
}
else
{
$('#currentAddressSection').hide();
$('#applicantCurrAddressHeader').hide();
}

if( $('option:selected', $('#caste')).val()!=49)
{
     $('#casteselect').show();
    
}
else
{
    $('#casteselect').hide();
    
}
if( $('option:selected', $('#caste')).val()==46)
{
   
    $('#subCasteDiv').show();
}
else
{     
    $('#subCasteDiv').hide();
}

if ($('#specialNeed').is(':checked')) {
$('#divdisability').show();
$('#medicalCertificateouter').show();
}
else
{
    $('#divdisability').hide();
    $('#medicalCertificateouter').hide();
}  

    var checkapplyingschool=$('option:selected', $('#applyingToClass')).text();
               var   checkapp = checkapplyingschool.toUpperCase();
if ( checkapp=='SELECT CLASS' || checkapplyingschool!=='JR KG' || checkapplyingschool!=='NURSERY' )
        {
       $('#schoolAttendedDiv').hide();
    $('#studingDiv').hide();
     $("#leavingCertificateDiv").hide();
     $("#marksheetDiv").hide();
        }
else if( checkapp!=='SR KG' )
{
           $('#schoolAttendedDiv').show();
    $('#studingDiv').show();
     $("#leavingCertificateDiv").hide();
     $("#marksheetDiv").hide();
}
else
{
       $('#schoolAttendedDiv').show();
    $('#studingDiv').show();
     $("#leavingCertificateDiv").show();
     $("#marksheetDiv").show();
    
}


if ($("#applicantcityBirthcityId").val() !== null)
        {
        $('#applicantcityBirthcityId').prop('disabled', false);
        }


if ($("#applicantstateBirthstateId").val() != null)
        {
        $('#applicantstateBirthstateId').prop('disabled', false);
        }




/* validation end */

$("#indianNationality").click(function () {
$(".nationalityOther").val("");
$("#rowNationalityOther").hide();
});
$("#otherNationality").click(function () {
$("#rowNationalityOther").show();
});
/* actually live user responsiveness */
/*applying to class */
// $("#applyingToClass").change(function () {

// var selectedapllyingtoclass = $('option:selected', $(this)).text();
// var applyingClass = selectedapllyingtoclass.toUpperCase();
// if (applyingClass !== 'JR KG' && applyingClass !== 'NURSERY' && applyingClass !== 'SELECT CLASS')
//         {
           
//         $("#schoolAttendedDiv").show();
//         $("#studingDiv").show();
//         $("#leavingCertificateDiv").show();
//         $("#marksheetDiv").show();
//          if(applyingClass=='SR KG'){
//                 $("#leavingCertificateDiv").hide();
//                 $("#marksheetDiv").hide();
//             }
//         /*automatic update current class */
//         var i = 0;
//         var selectedIndex = $(".applyingToClass_chosen").prop("selectedIndex");
//         var length = 13;
//         var test = $('.lastSchool_chosen').children('option').remove();
//         for (i = 0; i <= length; i++) {
//         if (selectedIndex == i || selectedIndex == (i + 1)) {
//         $(".lastSchool_chosen").append('<option value=' + $('.applyingToClass_chosen option').eq(i).val() + '>' + $('.applyingToClass_chosen option').eq(i).text() + '</option>');
//         }
//         }

//         }
else
        {
        $("#schoolAttendedDiv").hide();
        $("#studingDiv").hide();
        $("#marksheetDiv").hide();
      $("#leavingCertificateDiv").hide();
        }

});
/*Disability enable disable */

$("#specialNeed").click(function () {
$("#divdisability").show();
$("#disabilityCertificateouter").show();
});
$("#noSpecialNeed").click(function () {
$("#divdisability").hide();
$("#disabilityCertificateouter").hide();
});
/*caste certificate */

$("#CasteDiv").change(function () {

var selectedcaste = $('option:selected', $(this)).text();
if (selectedcaste !== '')
        {
        $("#casteselect").show();
        } else
        {
        $("#casteselect").hide();
        }


});
/*on selection catholic */

$("#applicantreligionserialId").change(function () {


var selectedreligion = $('option:selected', $(this)).text();
if (selectedreligion == 'Catholic' && selectedreligion != '')
        {
        $("#baptismCertificateDiv").show();
        } else
        {
        $("#baptismCertificateDiv").hide();
        }

});
/*loads locality and area country ajax*/

var timer = 0;
var token = '{{Session::token()}}';
var fetchareamaster = '{{route('edit')}}';
/* to search city area state via pincode ajax */
function mySearch() {

$('#permanentOtherStateName').addClass('loadinggif');
$('#permanentOtherCityName').addClass('loadinggif');
$('#permanentAreaName').addClass('loadinggif');
$.ajax({
method: "POST",
        url: fetchareamaster,
        data: {body: $('#permanentPincode').val(), postId: '', _token: token},
        success: function (data) {
        //   $("#content").html(content);

        $.each(data, function (index, resdt) {
        $('#permanentAreaName').val(resdt.areaName);
        $('#permanentOtherStateName').val(resdt.statemaster.stateName);
        $('#permanentOtherCityName').val(resdt.citymaster.cityName);
        });
        }
}).done(function (data) {

//$("#permanentOtherStateName").prop('disabled', false);
//$("#permanentOtherCityName").prop('disabled', false);
//$("#permanentAreaName").prop('disabled', false);
$('#permanentOtherStateName').removeClass('loadinggif');
$('#permanentOtherCityName').removeClass('loadinggif');
$('#permanentAreaName').removeClass('loadinggif');
console.log(data);
});
}

/* permamnent pincode */
$('#permanentPincode').keyup(function () {
if (timer) {
clearTimeout(timer);
}
timer = setTimeout(mySearch, 2000);
});
/*current address */

$("#sameaddress").click(function () {
$('#currentAddressSection').hide();
$('#applicantCurrAddressHeader').hide();
});
$("#differentaddress").click(function () {
$('#currentAddressSection').show();
$('#applicantCurrAddressHeader').show();
});
/*current pincode */
$('#currentPincode').keyup(function () {
if (timer) {
clearTimeout(timer);
}
timer = setTimeout(mycurrentSearch, 2000);
});
/* for cuurent adddress pincode to data search */
function mycurrentSearch() {
$('#applicantcurrentStateName').addClass('loadinggif');
$('#applicantcurrentCityName').addClass('loadinggif');
$('#currentAreaName').addClass('loadinggif');
$.ajax({
method: "POST",
        url: fetchareamaster,
        data: {body: $('#currentPincode').val(), postId: '', _token: token},
        success: function (data) {
        //   $("#content").html(content);

        $.each(data, function (index, resdt) {
        $('#currentAreaName').val(resdt.areaName);
        $('#applicantcurrentStateName').val(resdt.statemaster.stateName);
        $('#applicantcurrentCityName').val(resdt.citymaster.cityName);
        });
        }
}).done(function (data) {

$("#applicantcurrentStateName").prop('disabled', false);
$("#applicantcurrentCityName").prop('disabled', false);
$("#currentAreaName").prop('disabled', false);
$('#applicantcurrentStateName').removeClass('loadinggif');
$('#applicantcurrentCityName').removeClass('loadinggif');
$('#currentAreaName').removeClass('loadinggif');
console.log(data);
});
}



/* date- birth state select wrt to country */
var fetchstate = '{{route('stateselect')}}';
$("#applicantbirthcountry").change(function () {

stateSelect();
});
/* undertest */

stateSelect();
function stateSelect()
{
var countryvalue = $('option:selected', $('#applicantbirthcountry')).val();
$('#applicantstateBirthstateId').empty();
$('#applicantstateBirthstateId').prop('disabled', false);
$('#applicantstateBirthstateId').addClass('loadinggif');
$.ajax({
method: "POST",
        url: fetchstate,
        data: {body: countryvalue, postId: '', _token: token},
        success: function (data) {
        $('#applicantstateBirthstateId').empty();
        $.each(data, function (index, stateobj) {
        $('#applicantstateBirthstateId').append('<option value="' + stateobj.stateId + '">' + stateobj.stateName + '</option>');
        });
        }
}).done(function (data) {

$('#applicantstateBirthstateId').removeClass('loadinggif');
$('#applicantstateBirthstateId').prop('disabled', false);
//   console.log(data);
});
}

/* city birth select from state input */
var fetchcity = '{{route('applicantcityselect')}}';
$("#applicantstateBirthstateId").change(function () {
citySelect();
});
// bind a change event:
setTimeout(citySelect, 5000);
function citySelect()
{
var statevalue = $('option:selected', $("#applicantstateBirthstateId")).val();
$('#applicantcityBirthcityId').addClass('loadinggif');
$.ajax({
method: "POST",
        url: fetchcity,
        data: {body: statevalue, postId: '', _token: token},
        success: function (data) {
        $('#applicantcityBirthcityId').empty();
        //  $('#applicantcityBirthcityId').empty();
        $.each(data, function (index, cityobj) {
        $('#applicantcityBirthcityId').append('<option value="' + cityobj.cityId + '">' + cityobj.cityName + '</option>');
        });
        }
}).done(function (data) {
$('#applicantcityBirthcityId').removeClass('loadinggif');
$("#applicantcityBirthcityId").prop('disabled', false);
console.log(data);
});
}

/*caste to subcaste */
$("#caste").change(function () {
$('#applicantsubcasteserialId').val("");
$('#subCasteDiv').hide();
var caste = $('option:selected', $(this)).text();
if (caste === "S.C."){
$('#subCasteDiv').show();
}
});
/*date time picker */

$('.form_date').datetimepicker({
//  language:  'fr',
weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
});
//help text logic


$(window).scroll(function(){
if ($(this).scrollTop() > 135) {
$('#accordion').addClass('fixed');
} else {
$('#accordion').removeClass('fixed');
}
});
//helptextdata

/* file upload using plugin */



var uploadbirthcert = '{{route('uploadbirthcert')}}';
var ajaxappadharcardupload = '{{route('ajaxappadharcardupload')}}';
var ajaxappdisabilitycertupload = '{{route('ajaxappdisabilitycertupload')}}';
var ajaxleavingcertupload = '{{route('ajaxleavingcertupload')}}';
var ajaxmarksheetupload = '{{route('ajaxmarksheetupload')}}';
var ajaxcastecertupload = '{{route('ajaxcastecertupload')}}';
$("#applicantsbirthcertificate").uploadify({
buttonText : 'SELECT FILE',
        fileSizeLimit : '1000KB',
        formData     : {'_token':'{{ csrf_token() }}'},
        fileObjName : 'applicantsbirthcertificate',
        fileTypeExts : '*.jpeg;*.JPG *.jpg;*.JPEG;*.PDF;*.pdf',
        height        : 30,
        swf           : 'js/uploadify/uploadify.swf',
        uploader      : uploadbirthcert,
        width         : 120,
         'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var applicantsbirthcertificateLink = $("<a>");
                applicantsbirthcertificateLink.attr("href",data.path);
                applicantsbirthcertificateLink.text(data.filename);
                applicantsbirthcertificateLink.addClass("link");
                applicantsbirthcertificateLink.attr("download",data.filename);
                 $("#applicantsbirthcertificateLink").html(applicantsbirthcertificateLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
            
            $("#applicantsbirthcertificateCheck").val(data.filename);
            
            
        },
          'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError' : function(file, INVALID_FILETYPE) {
        alert('The file ' + file.name + ' have invalid extension.');
        }
});




$("#applicantAadharCard").uploadify({
buttonText : 'SELECT FILE',
        fileSizeLimit : '1000KB',
        formData     : {'_token':'{{ csrf_token() }}'},
        fileObjName : 'applicantAadharCard',
        fileTypeExts : '*.jpeg;*.JPG *.jpg;*.JPEG; *.PDF;*.pdf',
        height        : 30,
        swf           : 'js/uploadify/uploadify.swf',
        uploader      : ajaxappadharcardupload,
        width         : 120,
        'onUploadStart':function(file){
        if ($('#applicantaadharNumber').val() === "")
        {
        $('#applicantadharcardhelptext').show();
        $('#applicantAadharCard').uploadify('cancel');
        }
        else
        {
        uploadify_update_formdataAadharCardNumber();
        }

        },
          'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var applicantAadharCardLink = $("<a>");
                applicantAadharCardLink.attr("href",data.path);
                applicantAadharCardLink.text(data.filename);
                applicantAadharCardLink.addClass("link");
                applicantAadharCardLink.attr("download",data.filename);
                 $("#applicantAadharCardLink").html(applicantAadharCardLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
            
            $('#applicantAadharCardCheck').val(data.filename);
        },
        'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError' : function(file, INVALID_FILETYPE) {
        alert('The file ' + file.name + ' have invalid extension.');
        }
});
function uploadify_update_formdataAadharCardNumber(){

$("#applicantAadharCard").uploadify('settings', 'formData', {
'aadharnumber':$('#applicantaadharNumber').val()
});
}
$('#applicantaadharNumber').on('change', function(){

uploadify_update_formdataAadharCardNumber()
        });
$("#disabilityCertificate").uploadify({
buttonText : 'SELECT FILE',
        fileSizeLimit : '1000KB',
        formData     : {'_token':'{{ csrf_token() }}'},
        fileObjName : 'disabilityCertificate',
        fileTypeExts : '*.jpeg;*.JPG *.jpg;*.JPEG;*.PDF;*.pdf',
        height        : 30,
        swf           : 'js/uploadify/uploadify.swf',
        uploader      : ajaxappdisabilitycertupload,
        width         : 120,
        'onSelectError' : function(file, INVALID_FILETYPE) {
        alert('The file ' + file.name + ' have invalid extension.');
        },
        
          'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var disabilityCertificateLink = $("<a>");
                disabilityCertificateLink.attr("href",data.path);
                disabilityCertificateLink.text(data.filename);
                disabilityCertificateLink.addClass("link");
                disabilityCertificateLink.attr("download",data.filename);
                 $("#disabilityCertificateLink").html(disabilityCertificateLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
            
            $('#disabilityCertificateCheck').val(data.filename);
        },
         'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + '' + errorString);
        },
        
        
});




$("#leavingCertificate").uploadify({
buttonText : 'SELECT FILE',
        fileSizeLimit : '1000KB',
        formData     : {'_token':'{{ csrf_token() }}'},
        fileObjName : 'leavingCertificate',
        fileTypeExts : '*.jpeg;*.JPG *.jpg;*.JPEG;*.PDF;*.pdf',
        height        : 30,
        swf           : 'js/uploadify/uploadify.swf',
        uploader      : ajaxleavingcertupload,
        width         : 120,
              'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var leavingCertificateLink = $("<a>");
                leavingCertificateLink.attr("href",data.path);
                leavingCertificateLink.text(data.filename);
                leavingCertificateLink.addClass("link");
                leavingCertificateLink.attr("download",data.filename);
                 $("#leavingCertificateLink").html(leavingCertificateLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
            $("#leavingCertificateCheck").val(data.filename);
            
        },
           'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError' : function(file, INVALID_FILETYPE) {
        alert('The file ' + file.name + ' have invalid extension.');
        }
});
$("#marksheet").uploadify({
buttonText : 'SELECT FILE',
        fileSizeLimit : '1000KB',
        formData     : {'_token':'{{ csrf_token() }}'},
        fileObjName : 'marksheet',
        fileTypeExts : '*.jpeg;*.JPG *.jpg;*.JPEG;*.PDF;*.pdf',
        height        : 30,
        swf           : 'js/uploadify/uploadify.swf',
        uploader      : ajaxmarksheetupload,
        width         : 120,
          'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var marksheetLink = $("<a>");
                marksheetLink.attr("href",data.path);
                marksheetLink.text(data.filename);
                marksheetLink.addClass("link");
                marksheetLink.attr("download",data.filename);
                 $("#marksheetLink").html(marksheetLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
            $("#marksheetCheck").val(data.filename);
            
        },
         'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError' : function(file, INVALID_FILETYPE) {
        alert('The file ' + file.name + ' have invalid extension.');
        }
});
$("#casteCertificate").uploadify({
buttonText : 'SELECT FILE',
        fileSizeLimit : '1000KB',
        formData     : {'_token':'{{ csrf_token() }}'},
        fileObjName : 'casteCertificate',
        fileTypeExts : '*.jpeg;*.JPG *.jpg;*.JPEG;*.PDF;*.pdf',
        height        : 30,
        swf           : 'js/uploadify/uploadify.swf',
        uploader      : ajaxcastecertupload,
        width         : 120,
          'onUploadSuccess' : function(file, data, response) {
         var data = $.parseJSON(data);
         // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
           // alert(data.path);
           
           var casteCertificateLink = $("<a>");
                casteCertificateLink.attr("href",data.path);
                casteCertificateLink.text(data.filename);
                casteCertificateLink.addClass("link");
                casteCertificateLink.attr("download",data.filename);
                 $("#casteCertificateLink").html(casteCertificateLink); 
          //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
              $("#casteCertificateCheck").val(data.filename);
            
        },
         'onUploadError': function (file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
        },
        'onSelectError' : function(file, INVALID_FILETYPE) {
        alert('The file ' + file.name + ' have invalid extension.');
        }
});
$('#applicantaadharNumber').keyup(function () {
if (timer) {
clearTimeout(timer);
}
timer = setTimeout(disableAdharFile, 2000);
});
function disableAdharFile()
        {
        if ($.trim($('#applicantaadharNumber').val()) === "212223242526")
                {
                $("#adharcardAstrik").hide();   
                $('#applicantAadharCard').uploadify('disable', true);
                }
        else
                {
                    $("#adharcardAstrik").show();   
                $('#applicantAadharCard').uploadify('disable', false);
                }
        }
});</script>

<style>
    .no-gutters {
        margin-right: 0;
        margin-left: 0;

        > .col,
        > [class*="col-"] {
            padding-right: 0;
            padding-left: 0;
        }
    }

    .input-group.input-group-unstyled input.form-control {
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }
    .input-group-unstyled .input-group-addon {
        border-radius: 4px;
        border: 0px;
        background-color: transparent;
    }

    .fixed {position:fixed; top:20px; margin-right:30px;}


</style>

<div class="col-md-12  col-lg-12">
    @if ( Session::has('flash_message') )

    <div class="alert alert-info flashmsg ">
        <h3>{{ Session::get('flash_message') }}</h3>
    </div>

    @endif
    <br>
    <div class="row">

        <div class="col-md-8 col-md-8 col-md-8">

            {!!Form::open([ 'enctype'=>'multipart/form-data','route'=>'applicant','class'=>'form','role'=>'form','method'=>'post'])!!}	


            <!-- <div class="row">
                <div class="col-md-12 col-sm-12" >
                    <div class="form-group row no-gutters">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-md-6 col-form-label" style=" line-height:2; padding-left: 0px; padding-right: 0px ">Applying to Class
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-6" >

                                        {{ Form::select('applyingToClassserialId',[''=>''],null,['class'=>'form-control  applyingToClass_chosen','id'=>'applyingToClass','placeholder'=>'select class','value'=>old('applyingToClassserialId')]) }}
                                        @if ($errors->has('ApplyingToClass')) <p class="help-block" style="color: Red">{{ $errors->first('ApplyingToClass') }}</p> @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="Gender" class="col-md-5 col-form-label" style="  line-height:2 ">Gender
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-6" style="padding-left:0px;">
                                        {{ Form::select('genderSerialId', [''=>''],null,['class'=>'form-control gender_chosen','id'=>'applicantgenderserialId','value'=>old('genderSerialId')]) }} 

                                        @if ($errors->has('Gender')) <p class="help-block" style="color: Red">{{ $errors->first('Gender') }}</p> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
 -->
            <div class='box' id="personaldetails">

                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name <span
                                    class="text-danger ">*</span></label>
                            <input id="applicantapplicantFirstName" name="applicantFirstName" placeholder="First Name" class="form-control input_capital  capitalize" type="text" value="{{old('applicantFirstName')}}"/>
                            @if ($errors->has('FirstName')) <p class="help-block" style="color: Red">{{ $errors->first('FirstName') }}</p> @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Middle Name </label>
                            <input id="applicantapplicantMiddleName" name="applicantMiddleName" placeholder="Middle Name" class="form-control input_capital" type="text" value="{{old('applicantMiddleName')}}"/>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name <span
                                    class="text-danger">*</span></label>
                            <input id="applicantapplicantLastName" name="applicantLastName" placeholder="Last Name" class="form-control input_capital" type="text" value="{{old('applicantLastName')}}"/>

                            @if ($errors->has('LastName')) <p class="help-block" style="color: Red">{{ $errors->first('LastName') }}</p> @endif
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4 col-sm-4 col-xs-12">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nationality <span class="text-danger">*</span>
                            </label>

                            <div>
                                <label  for="example-inline-radio1"> 
                                    <input id="indianNationality" name="applicantnationality" type="radio" value="Indian" checked="checked" {{ old('applicantnationality')=="Indian" ? 'checked='.'"'.'checked'.'"' : '' }}/> Indian
                                </label> 
                                <label  for="example-inline-radio2"> 
                                    <input id="otherNationality" name="applicantnationality" type="radio" value="Other" {{ old('applicantnationality')=="Other" ? 'checked='.'"'.'checked'.'"' : '' }}/> Other
                                </label>
                                @if ($errors->has('applicantnationality')) <p class="help-block" style="color: Red">Select Nationality</p> @endif
                            </div>
                        </div>
                    </div>


                    <div class="row" id="rowNationalityOther" style="display: none;">

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Other Nationality <span class="text-danger">*</span>
                                </label> 
                                <input id="applicantnationalityOther" name="applicantnationalityOther" placeholder="Nationality" class="form-control nationalityOther input_capital" type="text" value="{{old('applicant_nationalityOther')}}"/>
                                @if ($errors->has('OtherNationality')) <p class="help-block" style="color: Red">{{ $errors->first('OtherNationality') }}</p> @endif
                            </div>
                        </div>
                    </div>  


                </div>  

                <div class="row">

                    <!-- below depends applying for class -->   

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group" id="studingDiv" style="display: none">
                            <label for="exampleInputEmail1"> Currently in Class <span class="text-danger" id="currentAstrick">*</span>
                            </label>
                            {{ Form::select('applicantclassAttendedid', [''=>''],null,['class'=>'form-control lastSchool_chosen','id'=>'lastClassPassed','placeholder'=>'select class','value'=>old("applicantclassAttendedid") ]) }}
                            @if ($errors->has('CurrentlyClass')) <p class="help-block" style="color: Red">{{ $errors->first('CurrentlyClass') }}</p> @endif
                        </div>
                    </div>



                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group" id="schoolAttendedDiv" style="display: none">
                            <label for="exampleInputmail1">Last School Attended <span class="text-danger" id="schoolAstrick">*</span>
                            </label>
                            {{ Form::select('applicantschoolAttendedid',[''=>''],null,['class'=>'form-control school_chosen ','id'=>'schoolAttended','placeholder'=>'select school','value'=>old("applicantschoolAttendedid") ]) }}

                            @if ($errors->has('LastSchool')) <p class="help-block" style="color: Red">{{ $errors->first('LastSchool') }}</p> @endif
                        </div>												
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">

                    </div>  
                </div>	


                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="applicanttelprefix">Resi.Tel | City Code
                            </label>

                            <div class="input-group" >
                                <input id="telprefix" name="applicanttelprefix" style="border: transparent;cursor:none;text-align: center;" placeholder="Tel Prefix" class="form-control" readonly="readonly" type="hidden" value="+91"/>
                                <span class="input-group-addon" style="width:50%; font-weight:bold; ">+91</span>
                                <input id="applicanttelcitycode" name="applicanttelcitycode" placeholder="CityCode" class="form-control" type="text" value="{{old('applicanttelcitycode')}}"/>
                              
                            </div>
                              @if ($errors->has('CityCode')) <p class="help-block" style="color: Red">{{ $errors->first('CityCode') }}</p> @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="telno">Resi.Tel No </label>
                            <input id="applicanttelno" name="applicanttelno" placeholder="Tel No." class="form-control" type="text" value="{{old('applicanttelno')}}"/>
                            @if ($errors->has('TelephoneNumber')) <p class="help-block" style="color: Red">{{ $errors->first('TelephoneNumber') }}</p> @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-3 col-xs-12">

                        <div class="form-group">
                            <label for="dtp_input2" class=" control-label">Date of Birth</label>
                            <div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input  name='applicantdateOfBirth' class="form-control " type="text" value="{{old('applicantdateofbirthready')}}" readonly>
                            <!--  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span -->
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            @if ($errors->has('DateOfBirth')) <p class="help-block" style="color: Red">{{ $errors->first('DateOfBirth') }}</p> @endif
                            <input name="applicantdateofbirthready" type="hidden" id="dtp_input2" value="" /><br/>
                        </div>
                    </div> 

                </div>
            </div>



            <!-- Date and Place of birth -->            
            <div class="row">
                <div class="col-md-12">
                    <label>
                        <strong>Place of Birth :</strong>
                    </label>
                </div>
            </div>


            <!-- date and place of birth -->

            <div class="box" id="dateOfBirthSection">
                <div class="row">


                    <div class="col-md-4 col-sm-4 col-xs-12">

                        <div class="form-group" id="birthCountryDiv">
                            <label for="exampleInputEmail1">Country <span
                                    class="text-danger">*</span></label>

                            {{ Form::select('applicantcountryBirthcountryId', [''=>''],null,['class'=>'form-control','id'=>'applicantbirthcountry','value'=>old('applicantcountryBirthcountryId')]) }}

                            @if ($errors->has('CountryOfBirth')) <p class="help-block" style="color: Red">{{ $errors->first('CountryOfBirth') }}</p> @endif
                        </div>         
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group" id="birthStateDiv">
                            <label for="exampleInputEmail1">State <span
                                    class="text-danger">*</span></label>  

                            <select id="applicantstateBirthstateId" name="applicantstateBirthstateId" disabled="disabled" class="form-control birthState birthState_chosen" value="{{old('applicantstateBirthstateId')}}">

                            </select> 
                            @if ($errors->has('StateOfBirth')) <p class="help-block" style="color: Red">{{ $errors->first('StateOfBirth') }}</p> @endif
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group" id="birthCityDiv">
                            <label for="exampleInputEmail1">City <span
                                    class="text-danger">*</span></label>
                            <select id="applicantcityBirthcityId" name="applicantcityBirthcityId" disabled="disabled" class="form-control birthCity birthCity_chosen" value="{{old('applicantcityBirthcityId')}}">

                            </select>
                            @if ($errors->has('CityOfBirth')) <p class="help-block" style="color: Red">{{ $errors->first('CityOfBirth') }}</p> @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <label>
                        <strong>Permanent Address :</strong>
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
                            <span class="text-danger" id="pernotavailable"  style="display: none"> Pincode entered is incorrect. Proceed with selecting State, City, Area. </span> <span class="text-success" id="peravailable"
                                                                                                                                                                                         style="display: none"> Registered </span>
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
                            <span class="text-danger" id="pernotavailable"  style="display: none"> Pincode entered is incorrect. Proceed with selecting State, City, Area. </span> <span class="text-success" id="peravailable"
                                                                                                                                                style="display: none"> Registered </span>
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


                </div>   

            </div>
            <!--  below is for  current address-->
            <div class="row" style="margin-top:5px;" >
                <div class="col-md-10">
                   
                        <div class="form-group row no-gutters">
                            <label for="selectaddress" class="col-md-5 col-sm-5 col-form-label">Is current address the same <span class="text-danger">*</span>
                            </label>

                            <div>
                                <label> 
                                    <input id="sameaddress" type="radio" name="applicantaddressradio" value="yes" checked="checked"  {{ old('applicantaddressradio')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>Yes

                                </label> 
                                <label> 
                                    <input id="differentaddress" type="radio" name="applicantaddressradio" value="no" {{ old('applicantaddressradio')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}> No
                                </label>
                                
                            </div>
                             @if ($errors->has('applicantaddressradio')) <p class="help-block" style="color: Red">{{ $errors->first('applicantaddressradio') }}</p> @endif
                        </div>
                   
                </div>
            </div>        
            <div class="row" id="applicantCurrAddressHeader" style="display:none">
                <div class="col-md-12" >
                    <label>
                        <strong>Current Address :</strong>
                    </label>
                </div>
            </div>

            <div class="box" id="currentAddressSection" style="display: none">

                <div class="row" id="row1currentadd" >
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group" id="currentCountryDiv">
                            <label for="applicantcurrentCountrycountryId">Country <span class="text-danger">*</span></label>
                            {{ Form::select('applicantcurrentCountrycountryId', [''=>''],null,['class'=>'form-control applicantcurrentCountrycountryId','id'=>'currentCountry','value'=>old('applicantcurrentCountrycountryId')]) }}

                            @if ($errors->has('CurrentCountry')) <p class="help-block" style="color: Red">{{ $errors->first('CurrentCountry') }}</p> @endif
                            <span class="text-danger" id="notselectedcountry" style="display: none">Please Select Country
                                before entering Pincode. </span>

                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">			
                            <label for="applicantcurrentPincode">Pincode <span class="text-danger" id="pincodeastrik">*</span></label>
                            <input id="currentPincode" name="applicantcurrentPincode" placeholder="Pincode" class="form-control applicantcurrentPincode" type="text" value="{{old('applicantcurrentPincode')}}"/>
                            @if ($errors->has('CurrentPincode')) <p class="help-block" style="color: Red">{{ $errors->first('CurrentPincode') }}</p> @endif
                            <span class="text-danger" id="pernotavailable"  style="display: none"> Pincode entered is incorrect. Proceed with selecting State, City, Area. </span> <span class="text-success" id="peravailable"
                                                                                                                                                                                         style="display: none"> Registered </span>

                        </div>
                    </div>

                    <div class="col-md-3 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="applicantcurrentStateName">State </label>
                            <input id="applicantcurrentStateName"style=" cursor:none; " readonly="readonly" name="applicantcurrentStateName" placeholder="State" class="form-control applicantcurrentStateName capitalize" type="text" value="{{old('applicantcurrentStateName')}}"/>
                            @if ($errors->has('applicantcurrentStateName')) <p class="help-block" style="color: Red">Required State</p> @endif
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="applicantcurrentCityName"> City </label>
                            <input id="applicantcurrentCityName"  style=" cursor:none; " readonly="readonly" name="applicantcurrentCityName" placeholder=" City" class="form-control permanentOtherCityName capitalize" type="text" value="{{old('applicantcurrentCityName')}}"/> 	
                            @if ($errors->has('applicantcurrentCityName')) <p class="help-block" style="color: Red">Required City</p> @endif
                        </div>
                    </div>
                </div>



                <div class="row" id="row2currentadd" >



                    <div class="col-md-3 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="applicantcurrentAreaName">Area</label>
                            <input id="currentAreaName" style=" cursor:none; " readonly="readonly" name="applicantcurrentAreaName" placeholder="Area" class="form-control applicantcurrentAreaName capitalize" type="text" value="{{old('applicantcurrentAreaName')}}"/>
                            @if ($errors->has('applicantcurrentAreaName')) <p class="help-block" style="color: Red">Required Area</p> @endif
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">			
                            <label for="applicantcurrentdistrict">District <span class="text-danger" id="pincodeastrik">*</span></label>
                            <input id="applicantDistrict" readonly="readyonly" style="cursor:none;" name="applicantcurrentdistrict" placeholder="District" class="form-control applicantcurrentdistrict" type="text" value="{{old('applicantcurrentdistrict')}}"/>
                            @if ($errors->has('applicantcurrentdistrict')) <p class="help-block" style="color: Red">Required District</p> @endif
                            <span class="text-danger" id="pernotavailable"  style="display: none"> Pincode entered is incorrect. Proceed with selecting State, City, Area. </span> <span class="text-success" id="peravailable"
                                                                                                                                                                                         style="helpdisplay: none"> Registered </span>
                            <div id="perloading" style="display: none;">
                                <i class="fa fa-spinner fa-spin"></i>Saving Information
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">			
                            <label for="applicantcurrenttaluka">Taluka <span class="text-danger" id="pincodeastrik">*</span></label>
                            <input id="applicanttaluka" readonly="readyonly" style="cursor:none;" name="applicantcurrenttaluka" placeholder="Taluka" class="form-control applicantcurrenttaluka" type="text" value="{{old('applicantcurrenttaluka')}}"/>
                            @if ($errors->has('applicantcurrenttaluka')) <p class="help-block" style="color: Red">Required Taluka</p> @endif
                            <span class="text-danger" id="pernotavailable"  style="display: none"> Pincode entered is incorrect. Proceed with selecting State, City, Area. </span> <span class="text-success" id="peravailable"
                                                                                                                                                                                         style="display: none"> Registered </span>
                            <div id="perloading" style="display: none;">
                                <i class="fa fa-spinner fa-spin"></i>Saving Information
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="applicantcurrentLocalityName">Locality <span class="text-danger">*</span>
                            </label>
                            <input id="applicantcurrentLocalityName" name="applicantcurrentLocalityName" placeholder="Enter Locality " class="form-control applicantcurrentLocalityName capitalize" type="text" value="{{old('applicantcurrentLocalityName')}}"/>
                            @if ($errors->has('applicantcurrentLocalityName')) <p class="help-block" style="color: Red">Required Locality</p> @endif
                        </div>
                    </div>
                </div> 

                <div class="row" id="row3currentadd">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Flat No./Building<span class="text-danger" id="currflatAstrick">*</span>
                            </label>
                            <input id="applicantpermanentBuildingName" name="applicantcurrentBuildingName" placeholder="Flat No./Building" class="form-control permanentBuilding capitalize" type="text" value="{{old('applicantcurrentBuildingName')}}"/>
                            @if ($errors->has('CurrentBuilding')) <p class="help-block" style="color: Red">{{ $errors->first('CurrentBuilding') }}</p> @endif
                        </div>
                    </div>






                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Street Address<span class="text-danger" id="currstreetAstrick">*</span> </label>
                            <input id="applicantpermanentStreetName" name="applicantcurrentStreetName" placeholder="Street Address " class="form-control permanentStreetName capitalize" type="text" value="{{old('applicantcurrentStreetName')}}"/>
                            @if ($errors->has('CurrenStreetAddress')) <p class="help-block" style="color: Red">{{ $errors->first('CurrenStreetAddress') }}</p> @endif

                        </div>
                    </div>
                </div>   

                <!-- below current address close -->
            </div>


             <div class="row">
                <div class="col-md-12">
                    <label>
                       <!--  <strong>Other Details :</strong>
                     --></label>
                </div>
            </div>
 
            <!-- OTHER DETAILS -->

             <!-- <div class="box" id="otherDetails"> -->
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-4 col-sm-4 col-xs-12"> -->
                        <!-- <div class="form-group" id="ReligionDiv"> -->
                           <!--  <label for="exampleInputEmail1">Religion <span
                                    class="text-danger">*</span></label>
                            {{ Form::select('applicantreligionserialId', [''=>''],null,['value'=>old('applicantreligionserialId'),'class'=>'form-control religion religion_chosen','id'=>'applicantreligionserialId','placeholder'=>'select religion']) }}

                            @if ($errors->has('Religion')) <p class="help-block" style="color: Red">{{ $errors->first('Religion') }}</p> @endif
                         </div>
                    </div><-->




                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group" id="bloodGroupDiv">
                            <!-- <label for="exampleInputEmail1">Blood Group<span
                                    class="text-danger">*</span></label>
                            {{ Form::select('applicantbloodGroupserialId',[''=>''],null,['class'=>'form-control  bloodGroup_chosen','id'=>'applicantbloodGroupserialId','placeholder'=>'Blood Group','value'=>old('applicantbloodGroupserialId')]) }} 

                            @if ($errors->has('BloodGroup')) <p class="help-block" style="color: Red">{{ $errors->first('BloodGroup') }}</p> @endif
                         --></div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group" id="CasteDiv">
                        <!--     <label for="exampleInputEmail1">Reserved Category<span
                                    class="text-danger">*</span></label>
                            {{ Form::select('applicantcasteserialId', [''=>''],null,['value'=>'applicantcasteserialId','class'=>'form-control religion religion_chosen','id'=>'caste']) }}

                            @if ($errors->has('ReservedCategory')) <p class="help-block" style="color: Red">{{ $errors->first('ReservedCategory') }}</p> @endif
                        --> </div>
                    </div>
                   

                </div>

                <div class="row">

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group" id="languageDiv">
                       <!--      <label for="exampleInputEmail1">Main Language
                                <span class="text-danger">*</span>
                            </label>
                            {{ Form::select('applicantlanguageserialId', [''=>''],null,['value'=>old('applicantlanguageserialId'),'class'=>'form-control  language_chosen','id'=>'applicantlanguageserialId','placeholder'=>'language']) }}
                            @if ($errors->has('MainLanguage')) <p class="help-block" style="color: Red">{{ $errors->first('MainLanguage') }}</p> @endif
                       -->  </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group" id="languageDiv">
                      <!--       <label for="exampleInputEmail1">Second Language
                                <span class="text-danger"></span>
                            </label>
                            {{ Form::select('applicantsecondlanguageserialId', [''=>''],null,['value'=>old('applicantsecondlanguageserialId'),'class'=>'form-control  language_chosen','id'=>'applicantsecondlanguageserialId','placeholder'=>'language']) }}

                            @if ($errors->has('SecondLanguage')) <p class="help-block" style="color: Red">{{ $errors->first('SecondLanguage') }}</p> @endif
                       -->  </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group" id="languageDiv">
                      <!--       <label for="exampleInputEmail1">Third Language
                                <span class="text-danger"></span>
                            </label>
                            {{ Form::select('applicantthirdlanguageserialId', [''=>''],null,['value'=>old('applicantthirdlanguageserialId'),'class'=>'form-control  language_chosen','id'=>'applicantthirdlanguageserialId','placeholder'=>'language']) }}

                            @if ($errors->has('ThirdLang')) <p class="help-block" style="color: Red">{{ $errors->first('ThirdLang') }}</p> @endif

                       -->  </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12" id="subCasteDiv" style="display:none">
                        <div class="form-group"  >
                            <label for="applicantsubcasteserialId">Sub-Caste <span class="text-danger">*</span></label>

                            <input id="applicantsubcasteserialId"  name="applicantsubcasteserialId" placeholder="sub caste" class="form-control applicantsubcasteserialId capitalize" type="text" value="{{old('applicantsubcasteserialId')}}"/>


                            @if ($errors->has('subcaste')) <p class="help-block" style="color: Red">{{ $errors->first('subcaste') }}</p> @endif
                        </div>
                    </div>

                </div>

 

                <!-- <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="inline-radio1">Does your child
                                have special needs? <span class="text-danger">*</span>
                            </label>
                            <div>
                                <label>
                                    <input id="noSpecialNeed" name="applicanthasSpecialNeeds" type="radio" value="false" checked="true" {{ old('applicanthasSpecialNeeds')=="false" ? 'checked='.'"'.'checked'.'"' : '' }}> No


                                </label>
                                <label> 
                                    <input id="specialNeed" name="applicanthasSpecialNeeds" type="radio" value="true"  {{ old('applicanthasSpecialNeeds')=="true" ? 'checked='.'"'.'checked'.'"' : '' }}> Yes
                                </label>
                                @if ($errors->has('specialneeds')) <p class="help-block" style="color: Red">{{ $errors->first('specialneeds') }}</p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12"  id="divdisability"

                         style="display:none;" >
                        <div class="form-group">
                            <label for="Disability">Disability <span
                                    class="text-danger">*</span></label>
                            {{ Form::select('applicantspecialNeedsserialId', [''=>''],null,['value'=>old('applicantspecialNeedsserialId'),'class'=>'form-control','id'=>'applicantspecialNeedsserialId','placeholder'=>'select']) }} 

                            @if ($errors->has('specialneedselect')) <p class="help-block" style="color: Red">{{ $errors->first('specialneedselect') }}</p> @endif
                        </div>
                    </div>
                </div>
                <div class="row"style="display:none;"

                     >
                    <div class="col-md-6 col-sm-6 col-xs-12"></div>

                </div>
 -->
                <!-- below is for other details close -->      
            </div>   



            <div class="row">
                <div class="col-md-12">
                    <label>
                        <strong>Documents: (Upload only jpg, jpeg files, max size allowed is 1 MB)</label>
                    </h4>
                </div>
            </div>   



            <div class="box" id="uploads">

                <div class="row">



                    <div class="col-md-6 col-sm-6 col-xs-12" style="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">AUser Photo: This will appear in correspondance with clients <span
                                    class="text-danger">*</span>
                            </label><br> <a href="#imagecrop_popup" data-toggle="modal"
                                            data-backdrop="static" data-keyboard="false"
                                            class="control-label" id="imagecropLink">Click Here
                                to Upload User Photo</a>
                                            
                                          
                            <div id="imagecroppopupLink"></div>
                            <div id="applicantPhotoDiv"
                                 style="display:none;">
                                <a id="applicantPhotoAnchor"
                                   class="control-label mid-blue-text wrap-word"
                                   href="/CAP/"
                                   download="">

                                    <i
                                        class="fa fa-download fa-fw"></i>
                                </a>
                            </div>


                            
                        </div>
                        @if ($errors->has('applicantphoto')) <p class="help-block" style="color: Red; font-weight:normal; ">{{ $errors->first('applicantphoto') }}</p> @endif
                    </div>
                   <!--  <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Applicant's Birth
                                Certificate <span class="text-danger">*</span>
                            </label>
                            <input type="file" id="applicantsbirthcertificate"
                                   name="applicantsbirthcertificate" value="">
                            <div id="applicantsbirthcertificateLink"></div>
                           
                        </div>
                         
                        @if ($errors->has('BirthCertificate')) <p class="help-block" style="color: Red; font-weight:normal;">{{ $errors->first('BirthCertificate') }}</p> @endif
                    </div>

 -->



                </div>


                <div class="row">

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Aadhaar Card
                                Number<span
                                    class="text-danger">*</span></label>
                            <input id="applicantaadharNumber" name="applicantaadharNumber" placeholder="Aadhar Card Number" class="form-control" type="text" value="{{old('applicantaadharNumber')}}"/>
                            <div id="applicantadharcardhelptext" style="display: none"> <p class="help-block" style="color: Red">Aadhar Card Number Required</p></div>
                            <p class="help-block" >Enter 212223242526 If do not have Aadhar card</p>
                        </div>
                          @if ($errors->has('AadharCardNumber')) <p class="help-block" style="color: Red; font-weight:normal;">{{ $errors->first('AadharCardNumber') }}</p> @endif
                    </div>
  <div class="col-md-2 col-lg-2 col-xs-12">

                    </div> 


                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Aadhar Card<span
                                  id="adharcardAstrik"  class="text-danger">*</span></label>

                            <input type="file" id="applicantAadharCard"
                                   name="applicantAadharCard"
                                   accept="image/jpg,image/jpeg,image/pdf">

                            <div id="applicantAadharCardLink"></div>
                        </div>
                        @if ($errors->has('AadharCardCheck')) <p class="help-block" style="color: Red; font-weight:normal;">{{ $errors->first('AadharCardCheck') }}</p> @endif
                    </div>






                </div>


                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12" id="leavingCertificateDiv" style="display:none;">
                        <div class="form-group">
                            <label for="exampleInputEmail1">School Leaving
                                Certificate</label> <input type="file" id="leavingCertificate"
                                                       name="leavingCertificate" accept="image/jpg,image/jpeg">

                                <div id="leavingCertificateLink"></div>
                        </div>
                             @if ($errors->has('leavingCertificate')) <p class="help-block" style="color: Red; font-weight:normal;">{{ $errors->first('leavingCertificate') }}</p> @endif
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12" id="marksheetDiv" style="display: none;">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Recent Term /
                                Semester Marksheet<span class="text-danger"
                                                        id="marksheetAstrik"> *</span>
                            </label> <input type="file" id="marksheet" name="marksheet"
                                            accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff">
                            <div id="marksheetLink"></div>
                        </div>
                         @if ($errors->has('marksheet')) <p class="help-block" style="color: Red; font-weight:normal;">{{ $errors->first('marksheet') }}</p> @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group" style="display: none;" id="casteselect">
                            <label for="exampleInputEmail1">Caste Certificate<span
                                    class="text-danger" id="casteastrick">*</span>
                            </label>

                            <input type="file" id="casteCertificate"
                                   name="casteCertificate" accept="image/jpg,image/jpeg">

                            <div id="casteCertificateLink"></div>
                        </div>
                         @if ($errors->has('casteCertificate')) <p class="help-block" style="color: Red; font-weight:normal;">{{ $errors->first('casteCertificate') }}</p> @endif
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group" style="display: none;" id="medicalCertificateouter" >
                            <label for="exampleInputEmail1">Medical 
                                Certificate <span class="text-danger"
                                                  id="disabilityastrick">*</span>
                            </label> <input type="file" id="disabilityCertificate"
                                            name="disabilityCertificate"
                                            accept="image/jpg,image/jpeg">
                            <div id="disabilityCertificateLink"></div>
                        </div>
                         @if ($errors->has('medicalCertificate')) <p class="help-block" style="color: Red; font-weight:normal;">{{ $errors->first('medicalCertificate') }}</p> @endif
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12"
                         id="baptismCertificateDiv" style="display: none;">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Baptism
                                Certificate <span class="text-danger"
                                                  id="baptismastrick">*</span>
                            </label> <input type="file" id="baptismCertificate"
                                            name="baptismCertificate" accept="image/jpg,image/jpeg">




                        </div>
                    </div>
                </div>

                <!-- below box closing -->
            </div>    
            <br>
             <input type="hidden" name="applicantphotocheck" id="applicantphotocheck" value="">
            <input type="hidden" name="applicantsbirthcertificateCheck" id="applicantsbirthcertificateCheck" value="">
             <input type="hidden" name="applicantAadharCardCheck" id="applicantAadharCardCheck" value="">
              <input type="hidden" name="leavingCertificateCheck" id="leavingCertificateCheck" value="">
               <input type="hidden" name="marksheetCheck" id="marksheetCheck" value="">
                <input type="hidden" name="casteCertificateCheck" id="casteCertificateCheck" value="">
                 <input type="hidden" name="disabilityCertificateCheck" id="disabilityCertificateCheck" value="">
                 
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-md-12 text-center">
                    <button   id="drafttobe" class="save btn btn-success">Save
                        As Draft</button>
                    <button type="submit" id="submit"
                            class="save btn btn-success">Save And Proceed</button>
                </div>
            </div>


            {!!form::close()!!}
        </div>
        <!--  forn col end -->
        <!-- help text start -->
        <!-- <div class="col-md-4 col-sm-4 col-xs-12"  style="margin-top:50px;" > -->

            <!-- <div class="panel-group scrollingBox hidden-xs" id="accordion"
                 role="tablist" aria-multiselectable="true" >
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
                            <div id="selectedhelpText" style="color:blue; font-weight:normal; "><span></div></span>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- helpt text end -->

        <!-- col help one -->
    </div>


    <!-- image modal -->

    <div id="imagecrop_popup" class="modal fade" tabindex="-1"
         role="dialog" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="model-close btn btn-sm btn-primary save pull-right export enablecomponents"
                            data-dismiss="modal">Upload</button>
                    <button type="button" id="backcroppicmodal"
                            class="model-close btn btn-sm btn-primary save pull-right enablecomponents"
                            data-dismiss="modal" style="margin-right: 10px;">Back</button>
                    <h4 class="modal-title">Upload and Crop Image</h4>
                </div>
                <div class="modal-body" id="modalbodyUpload">
                   
                        <div class="row margin-bottom-40">
                            <div class=" col-md-12">

                                <div id="cropContainerEyecandy" >


                                </div>
                            </div>
                            
                        </div>
                    

                                                                                        <!-- <input type="file" class="cropit-image-input enablecomponents">  -->


                    <!-- 								     <button type="button" class="export">Export</button> -->
                </div>

            </div>
        </div>
    </div>
</div>

<!--image modal end -->

<!-- main col end -->

</div>

<script>

var uploadpath='{{ route('upload') }}';
var croppath='{{ route('crop') }}';

    var eyeCandy = $('#cropContainerEyecandy');
    var croppedOptions = {
      
            uploadUrl: uploadpath,
            cropUrl: croppath,
            loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
            processInline:true,
             imgEyecandy:true,
              imgEyecandyOpacity:0.2,
        
            onError: function(data){ alert('onError:'+data); },

     onAfterImgUpload: function(){ 
        
     //this step here to get your image
     var imageUrl = $(this)[0].imgUrl;
    $.ajax({
method: "POST",
        url: uploadpath,
        data: {body:imageUrl , postId: '', _token: '{{ csrf_token() }}'},
        success: function (data) {
        //   $("#content").html(content);
       // alert("Applicant Photo Upload "+data.link);
     var d=new Date();
        $('#profilepic').attr("src",data.link+'?'+d.getTime());
        
         var imagecroppopupLink = $("<a>");
                imagecroppopupLink.attr("href",data.link);
                imagecroppopupLink.text(data.filename);
                imagecroppopupLink.addClass("link");
                imagecroppopupLink.attr("download",data.filename);
                 $("#imagecroppopupLink").html(imagecroppopupLink);
                  $("#applicantphotocheck").val(data.filename);
                
         
        
        },
       error: function(data) {   
      var dataa= $.parseJSON(data.responseText);
         
          cropperBox.reset();
       alert('Applicant Photo Upload: '+dataa.message);
       
      }   
}).done(function (data) {


});  
   
 },
      onAfterImgCrop:function(data){
       var  d = new Date();
         
              $('#profilepic').attr("src",data.url+'?'+d.getTime());
           var imagecroppopupLink = $("<a>");
                imagecroppopupLink.attr("href",data.url);
                imagecroppopupLink.text(data.filename);
                imagecroppopupLink.addClass("link");
                imagecroppopupLink.attr("download",data.filename);
                 $("#imagecroppopupLink").html(imagecroppopupLink); 
             $("#applicantphotocheck").val(data.filename);
         }
    }
    var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
    $('#backcroppicmodal').click(function(){
          cropperBox.reset();
    });
    
    
</script>

@endsection

