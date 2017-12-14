@extends('parentform')


@section('title', 'Payment Details')
@section('motherform')
<script src="{{asset('js/SearchablePlugin/search/jquery.searchable.js')}}"></script> 
<script src="{{asset('js/SearchablePlugin/search/schoolsearch.js')}}"></script>  

<script>

    $(document).ready(function () {
        /*mother nationality */


        $("#indianNationalityMother").click(function () {
            $("#otherNationality").val("");
            $("#rowMotherNationalityOther").hide();
        });

        $("#otherNationalityMother").click(function () {
            $("#rowMotherNationalityOther").show();
        });


        /* residence of father */

        $("#indianResidentMother").click(function () {
            $("#motherMobilePrefix").val('91');
            $("#otherMotherResidingCountryDiv").hide();
            $("#fatherMobilePrefix").val('91');
        });


        $("#otherResidentMother").click(function () {
            $("#motherMobilePrefix").val('');
            $("#otherMotherResidingCountryDiv").show();
        });


        /*father edu logic */
        $("#highestQualification").change(function () {
            var qualificationselected = $('option:selected', $(this)).val();

            $("#instituteName").val("");
            $("#instituteCity").val("");
            $("#schoolCompleting").val("");
            $("#graduationYear").val("");

            $("#instituteName").prop('disabled', false);
            $("#instituteCity").prop('disabled', false);
            $("#schoolCompleting").prop('disabled', false);
            $("#graduationYear").prop('disabled', false);

            if (qualificationselected === '60') {

                $("#instituteName").prop('disabled', true);
                $("#instituteCity").prop('disabled', true);
                $("#schoolCompleting").prop('disabled', true);
                $("#graduationYear").prop('disabled', true);
            } else if (qualificationselected === '59')
            {
                $("#instituteName").prop('disabled', true);
                $("#instituteCity").prop('disabled', true);

            }

        });

        $("#motherOccupation").change(function () {
            var occuptionselected = $('option:selected', $(this)).val();

            $("#motherProfession").prop('disabled', false);
            $("#motherOfficeAddress").prop('disabled', false);
            $("#motherEmployerName").prop('disabled', false);


            if (occuptionselected == '147') {
                $("#motherProfession").val("");
                $("#motherOfficeAddress").val("");
                $("#motherEmployerName").val("");

                $("#motherProfession").prop('disabled', true);
                $("#motherOfficeAddress").prop('disabled', true);
                $("#motherEmployerName").prop('disabled', true);


            }


        });



        /*mother decesaed */

        $("#motherDeceasedYes").click(function () {

            $('#indianResidentMother').attr('checked', false);
            $('#otherResidentMother').attr('checked', false);
            $("#age").val("");
            $("#highestQualification").val("");
            $("#motherEmployerName").val("");
            $("#instituteName").val("");
            $("#instituteCity").val("");
            $("#motherOfficeAddress").val("");
            $("#motherEmployerName").val("");
            $("#motherOfficeAddress").val("");
            $("#motherOccupation").val("");
            $("#motherProfession").val("");
            $("#motherAnnualIncome").val("");
            $("#motherMobilePrefix").val("");
            $("#motherMobileNumber").val("");
            $("#motherEmail").val("");
            $("#motherAadharCard").val("");
            $("#motherAadharCardNumber").val("");
            $("#motherAddressProofSerialId").val("");
            $("#motherAddressProofDoc").val("");
            $("#motherIdProof").val("");
            $("#motherdoumentUpload").val("");
            $('#motherAadharCard').val("");



            $("#age").prop('disabled', true);
            $("#indianResidentMother").prop('disabled', true);
            $("#otherResidentMother").prop('disabled', true);
            $("#highestQualification").prop('disabled', true);
            $("#motherOccupation").prop('disabled', true);
            $("#motherProfession").prop('disabled', true);
            $("#motherOfficeAddress").prop('disabled', true);
            $("#motherAnnualIncome").prop('disabled', true);
            $("#motherEmployerName").prop('disabled', true);
            $("#motherMobileNumber").prop('disabled', true);
            $("#motherMobilePrefix").prop('disabled', true);
            $("#motherAddressProofSerialId").prop('disabled', true);
            $("#motherAddressProofDoc").uploadify('disable', true);
            $("#motherIdProof").prop('disabled', true);
            $("#motherdoumentUpload").uploadify('disable', true);
            $("#instituteName").prop('disabled', true);
            $("#instituteCity").prop('disabled', true);
            $("#motherEmail").prop('disabled', true);
            $("#motherAadharCardNumber").prop('disabled', true);
            $("#motherAadharCard").uploadify('disable', true);

            $("#ageAstrik").hide();
            $("#indianResidentMotherAstrik").hide();
            $("#qualificationAsterisk").hide();
            $("#qualificationAsterisk").hide();
            $("#employerAstrik").hide();
            $("#employeemandatory").hide();
            $("#officemandatory").hide();
            $("#prefixAstrik").hide();
            $("#mobNoAstrik").hide();
            $("#occupationAstrik").hide();
            $("#incomeAstrik").hide();
            $("#professionAstrik").hide();
            $("#dependantsAstrik").hide();
            $("#motherAddressProof").hide();
            $("#motherIdentityProof").hide();
            $("#motherAddressProofDocumentation").hide();
            $("#motherIdentityProofDocumentation").hide();
            $('#motherAadharCardAstrik').hide();
            $('#motherAadharCardNumberAstrik').hide();

        });


        $("#motherDeceasedNo").click(function () {
            $("#age").prop('disabled', false);
            $("#indianResidentMother").prop('disabled', false);
            $("#otherResidentMother").prop('disabled', false);
            $("#highestQualification").prop('disabled', false);
            $("#motherOccupation").prop('disabled', false);
            $("#motherProfession").prop('disabled', false);
            $("#motherOfficeAddress").prop('disabled', false);
            $("#motherAnnualIncome").prop('disabled', false);
            $("#motherEmployerName").prop('disabled', false);
            $("#motherMobileNumber").prop('disabled', false);
            $("#motherMobilePrefix").prop('disabled', false);
            $("#motherAddressProofSerialId").prop('disabled', false);
            $("#motherAddressProofDoc").uploadify('disable', false);
            $("#motherIdProof").prop('disabled', false);
            $("#motherdoumentUpload").uploadify('disable', false);
            $("#instituteName").prop('disabled', false);
            $("#instituteCity").prop('disabled', false);
            $("#motherEmail").prop('disabled', false);
            $("#motherAadharCardNumber").prop('disabled', false);
            $("#motherAadharCard").uploadify('disable', false);

            $("#ageAstrik").show();
            $("#indianResidentMotherAstrik").show();
            $("#qualificationAsterisk").show();
            $("#qualificationAsterisk").show();
            $("#employerAstrik").show();
            $("#employeemandatory").show();
            $("#officemandatory").show();
            $("#prefixAstrik").show();
            $("#mobNoAstrik").show();
            $("#occupationAstrik").show();
            $("#incomeAstrik").show();
            $("#professionAstrik").show();
            $("#dependantsAstrik").show();
            $("#motherAddressProof").show();
            $("#motherIdentityProof").show();
            $("#motherAddressProofDocumentation").show();
            $("#motherIdentityProofDocumentation").show();
            $('#motherAadharCardAstrik').show();
            $('#motherAadharCardNumberAstrik').show();

        });


        /* help text scroll */
        $(window).scroll(function () {
            if ($(this).scrollTop() > 135) {
                $('#accordion').addClass('fixed');
            } else {
                $('#accordion').removeClass('fixed');
            }
        });


        /* Mother doc ajax */

        var ajaxMotherAdharUploadPost = '{{ route('ajaxMotherAdharUploadPost') }}';

        $("#motherAadharCard").uploadify({
            buttonText: 'SELECT FILE',
            fileSizeLimit: '1000KB',
            formData: {'_token': '{{ csrf_token() }}'},
            fileObjName: 'motherAadharCard',
            fileTypeExts: '*.jpeg;*.JPG;*.JPEG;*.jpg; *.PDF;*.pdf;',
            height: 30,
            swf: 'js/uploadify/uploadify.swf',
            uploader: ajaxMotherAdharUploadPost,
            width: 120,
            'onUploadStart': function (file) {
                if ($('#motherAadharCardNumber').val() === "")
                {
                    $('#motheraadharcardhelptext').show();
                    $('#motherAadharCard').uploadify('cancel');
                } else
                {
                    uploadify_update_formdataMotherAadharCardNumber();
                }

            },
            'onUploadSuccess': function (file, data, response) {
                var data = $.parseJSON(data);
                // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
                // alert(data.path);

                var motherAadharCardLink = $("<a>");
                motherAadharCardLink.attr("href", data.path);
                motherAadharCardLink.text(data.filename);
                motherAadharCardLink.addClass("link");
                motherAadharCardLink.attr("download", data.filename);
                $("#motherAadharCardLink").html(motherAadharCardLink);
                //  $("#jsonresponseFatherAdharcard").html("<a href=''>abc</a> ");
                 $('#aadharCardCheck').val(data.filename);
                

            },
            'onUploadError': function (file, errorCode, errorMsg, errorString) {
                alert('The file ' + file.name + 'Enter Aadhar Card Number : ' + errorString);
            },
            onSelectError: function (file, INVALID_FILETYPE) {
                alert('The file ' + file.name + ' have invalid extension.');
            }
        });

        function uploadify_update_formdataMotherAadharCardNumber() {
            $("#motherAadharCard").uploadify('settings', 'formData', {
                'aadharMothernumber': $('#motherAadharCardNumber').val()
            });
        }

        $('#motherAadharCardNumber').on('change', function () {

            uploadify_update_formdataMotherAadharCardNumber();
        });


        var ajaxMotherAddrssProofUploadPost = '{{ route('ajaxMotherAddrssProofUploadPost') }}';

        $("#motherAddressProofDoc").uploadify({
            buttonText: 'SELECT FILE',
            fileSizeLimit: '1000KB',
            formData: {'_token': '{{ csrf_token() }}'},
            fileObjName: 'motherAddressProofDoc',
            fileTypeExts: '*.jpeg;*.JPG;*.jpg;*.JPEG;*.PDF;*.pdf;',
            height: 30,
            swf: 'js/uploadify/uploadify.swf',
            uploader: ajaxMotherAddrssProofUploadPost,
            width: 120,
            'onUploadStart': function (file) {
                uploadify_update_formdataMotherAddressProof();

            },
            'onUploadSuccess': function (file, data, response) {
                var data = $.parseJSON(data);
                // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
                // alert(data.path);

                var motherAddressProofDocLink = $("<a>");
                motherAddressProofDocLink.attr("href", data.path);
                motherAddressProofDocLink.text(data.filename);
                motherAddressProofDocLink.addClass("link");
                motherAddressProofDocLink.attr("download", data.filename);
                $("#motherAddressProofDocLink").html(motherAddressProofDocLink);
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

        function uploadify_update_formdataMotherAddressProof() {
            $("#motherAddressProofDoc").uploadify('settings', 'formData', {
                'Doctype': $('#motherAddressProofSerialId').val()
            });
        }
        $('#motherAddressProofSerialId').on('change', function () {
            uploadify_update_formdataMotherAddressProof()
        });

        var ajaxMotherIdentityProofUploadPost = '{{ route('ajaxMotherIdentityProofUploadPost') }}';

        $("#motherdoumentUpload").uploadify({
            buttonText: 'SELECT FILE',
            fileSizeLimit: '1000KB',
            formData: {'_token': '{{ csrf_token() }}'},
            fileObjName: 'motherIdentityProofDoc',
            fileTypeExts: '*.jpeg;*.JPG;*.jpg;*.JPEG; *.PDF;*.pdf;',
            height: 30,
            swf: 'js/uploadify/uploadify.swf',
            uploader: ajaxMotherIdentityProofUploadPost,
            width: 120,
            'onUploadStart': function (file) {
                uploadify_update_formdataMotherIdentityProof();

            },
            'onUploadSuccess': function (file, data, response) {
                var data = $.parseJSON(data);
                // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data)
                // alert(data.path);

                var motherIdentityProofDocLink = $("<a>");
                motherIdentityProofDocLink.attr("href", data.path);
                motherIdentityProofDocLink.text(data.filename);
                motherIdentityProofDocLink.addClass("link");
                motherIdentityProofDocLink.attr("download", data.filename);
                $("#motherIdentityProofDocLink").html(motherIdentityProofDocLink);
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

        function uploadify_update_formdataMotherIdentityProof() {
            $("#motherdoumentUpload").uploadify('settings', 'formData', {
                'Doctype': $('#motherIdProof').val()
            });
        }

        $('#motherIdProof').on('change', function () {
            uploadify_update_formdataMotherIdentityProof()
        });


        var timer = 0;
        $('#motherAadharCardNumber').keyup(function () {
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(disableAdharFile, 2000);
        });


        function disableAdharFile()
        {
            if ($.trim($('#motherAadharCardNumber').val()) === "212223242526")
            {
                $("#motherAadharCardAstrik").hide();
                $('#motherAadharCard').uploadify('disable', true);
            } else
            {
                $("#motherAadharCardAstrik").show();
                $('#motherAadharCard').uploadify('disable', false);
            }
        }




var tokenforschool = $('meta[name="csrf-token"]').attr('content');
            var addMotherSchool = '{{route('addFatherSchool')}}';
    $("#schoolCompleting").click(function () {

        $('#myModal').modal('show');
        $('.motherschoolsearchtable').find('tr').click(function () {
            var row = $(this).find('td:first').text();

            $('.motherschoolclicked').val(row);

            $('#selectButtonmotherSchool').click(function () {
                $('#schoolCompleting').val(row);
                $('#myModal').modal('hide');


            });



        });
          $('#motherschoolfound').click(function () {
            $('#motherSchooladdtext').val("");
            $('#MotherEnterSchoolrow').hide();
        });

        $('#motherschoolnotfound').click(function () {

            $('#MotherEnterSchoolrow').show();

            $('#addschoolMotherform').on('submit', function () {
                $.ajax({
                    method: "POST",
                    url: addFatherSchool,
                    data: {body: $('#motherSchooladdtext').val(), postId: '', _token: tokenforschool},
                    success: function () {
                        //   $("#content").html(content);


                    }
                }).done(function () {

                    // console.log(data);
                });


            });

        });

    });     
        
        
        


   

    });




</script>

<style>


    .fixed {position:fixed; top:20px; margin-right:30px;}




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


 







</style>

<div class="col-md-12  col-lg-12">

    <div class="row" >
        <div class="col-md-8 col-md-8 col-xs-8">
            {!!Form::open(['route'=>'mother','class'=>'form','role'=>'from','method'=>'post'])!!}	
            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <label>
                        <strong>Payment Details :</strong>
                    </label>
                </div>
            </div>





            <div class="box" id="personDetailsSection">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Charge type <span
                                    class="text-danger">*</span> :
                            </label>
                            <div>
                                <label class="radio-inline" for="example-inline-radio2">
                                    <input id="motherDeceasedNo" name="motherMastermotherDeceased"  type="radio" value="false"  checked="checked" {{ old('motherMastermotherDeceased')=="false" ? 'checked='.'"'.'checked'.'"' : '' }} /> Cost Per Head
                                </label>
                                <label class="radio-inline" for="example-inline-radio1">
                                    <input id="motherDeceasedYes" name="motherMastermotherDeceased"  type="radio" value="true" {{ old('motherMastermotherDeceased')=="true" ? 'checked='.'"'.'checked'.'"' : '' }} /> Fixed Price
                                </label> 
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Amount Per Head
                                <span class="text-danger">*</span>
                            </label>
                            <div>
                                   <input id="age" name="motherMastermotherAge" placeholder="Amount per Head" class="form-control input_capital" maxlength="3" type="text" value="{{ old('motherMastermotherAge') }}"/>
<!--                                <label class="radio-inline" for="example-inline-radio1">
                                    <input id="motherMastermotherRelationWithChild1" name="motherMastermotherRelationWithChild" checked="true" type="radio" value="1" checked="checked" {{ old('motherMastermotherRelationWithChild')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} /> Mother
                                </label> <label class="radio-inline" for="example-inline-radio2">
                                    <input id="motherMastermotherRelationWithChild2" name="motherMastermotherRelationWithChild" type="radio" value="0" {{ old('motherMastermotherRelationWithChild')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                    Guardian
                                </label>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Amount Charged<span
                                    class="text-danger">*</span></label>
                            <div>

                                
                                
                                <!--                                <label class="radio-inline" for="example-inline-radio1">
                                    <input id="motherMastersingle1" name="motherMastersingle" checked="checked" type="radio" value="false" checked="checked" {{ old('motherMastersingle')=="false" ? 'checked='.'"'.'checked'.'"' : '' }} /> Married
                                </label> <label class="radio-inline" for="example-inline-radio2">
                                    <input id="motherMastersingle2" name="motherMastersingle" type="radio" value="true"  {{ old('motherMastersingle')=="true" ? 'checked='.'"'.'checked'.'"' : '' }}  /> Single
                                </label>-->
   <input id="age" name="motherMastermotherAge" placeholder="Amount" class="form-control input_capital" maxlength="3" type="text" value="{{ old('motherMastermotherAge') }}"/>
                            </div>
                        </div>
                    </div>

                </div>




                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Refund Offered? <span
                                    class="text-danger">*</span></label>
<!--                            <input id="motherMastermotherFirstName" name="motherMastermotherFirstName" placeholder="First Name" class="form-control input_capital" type="text" value="{{ old('motherMastermotherFirstName') }}"/>
                              @if ($errors->has('motherMastermotherFirstName')) <p class="help-block" style="color: Red">{{ $errors->first('motherMastermotherFirstName') }}</p> @endif-->
                       <label class="radio-inline" for="example-inline-radio1">
                                    <input id="motherMastermotherRelationWithChild1" name="motherMastermotherRelationWithChild" checked="true" type="radio" value="1" checked="checked" {{ old('motherMastermotherRelationWithChild')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} /> Yes
                                </label> <label class="radio-inline" for="example-inline-radio2">
                                    <input id="motherMastermotherRelationWithChild2" name="motherMastermotherRelationWithChild" type="radio" value="0" {{ old('motherMastermotherRelationWithChild')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                    No
                                </label>
                           
                        
                        
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mention Refund policy</label>
                            <input id="motherMastermotherMiddleName" name="motherMastermotherMiddleName" placeholder="Refund Policy" class="form-control input_capital" type="text" value=""/>
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div id="divAge" class="form-group">
                            <label for="exampleInputEmail1">Account Name<span
                                    class="text-danger" id="ageAstrik">*</span></label>
                            <input id="age" name="motherMastermotherAge" placeholder="Account Name" class="form-control input_capital" maxlength="3" type="text" value="{{ old('motherMastermotherAge') }}"/>
                              @if ($errors->has('motherMastermotherAge')) <p class="help-block" style="color: Red">{{ $errors->first('motherMastermotherAge') }}</p> @endif
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <div class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bank Name and Address<span
                                        class="text-danger">*</span></label>
                                <input id="otherNationality" name="motherMastermotherNationalityOther" placeholder="Bank Details" class="form-control input_capital" type="text" value="{{ old('motherMastermotherNationalityOther') }}"/>
                                @if ($errors->has('motherMastermotherNationalityOther')) <p class="help-block" style="color: Red">{{ $errors->first('motherMastermotherNationalityOther') }}</p> @endif
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <div class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Account Type<span
                                        class="text-danger">*</span></label>
                                <input id="otherNationality" name="motherMastermotherNationalityOther" placeholder="Account type" class="form-control input_capital" type="text" value="{{ old('motherMastermotherNationalityOther') }}"/>
                                @if ($errors->has('motherMastermotherNationalityOther')) <p class="help-block" style="color: Red">{{ $errors->first('motherMastermotherNationalityOther') }}</p> @endif
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                
                
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <div class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">IFSC Code<span
                                        class="text-danger">*</span></label>
                                <input id="otherNationality" name="motherMastermotherNationalityOther" placeholder="IFSC Code" class="form-control input_capital" type="text" value="{{ old('motherMastermotherNationalityOther') }}"/>
                                @if ($errors->has('motherMastermotherNationalityOther')) <p class="help-block" style="color: Red">{{ $errors->first('motherMastermotherNationalityOther') }}</p> @endif
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <div class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bank Name and Address<span
                                        class="text-danger">*</span></label>
                                <input id="otherNationality" name="motherMastermotherNationalityOther" placeholder="Bank Details" class="form-control input_capital" type="text" value="{{ old('motherMastermotherNationalityOther') }}"/>
                                @if ($errors->has('motherMastermotherNationalityOther')) <p class="help-block" style="color: Red">{{ $errors->first('motherMastermotherNationalityOther') }}</p> @endif
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div  class="form-group">
                            <label for="exampleInputEmail1">Account Number </label>
                            <input id="motherEmail" name="motherEmail" placeholder="Account Number" class="form-control" type="text" value="{{ old('motherEmail') }}"/>
                             @if ($errors->has('motherEmail')) <p class="help-block" style="color: Red">{{ $errors->first('motherEmail') }}</p> @endif
                        </div>
                    </div>
                    
                                   </div>
            </div>


           <div class="row">
                <div class="col-md-12">
                    <label>
                        <strong> If Details Unknown</strong>
                    </label>
                </div>
            </div>


            <div class="box" id="documentSection">
                <div class="row">

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Copy of cheque</label><span
                                class="text-danger" id="motherAadharCardNumberAstrik">*</span>
<!--                            <input id="motherAadharCardNumber" name="aadharCardNumber" placeholder="Aadhar Card Number" class="form-control" type="text" value="{{ old('aadharCardNumber') }}"/>
                          -->
                            <b class="help-block" >If you do not know your Bank Account details, kildly upload a scanned copy of a canceled cheque </b>
                             @if ($errors->has('aadharCardNumber')) <p class="help-block" style="color: Red">{{ $errors->first('aadharCardNumber') }}</p> @endif
                            <div id="motheraadharcardhelptext" style="display: none"> <p class="help-block" style="color: Red">Aadhar Card Number Required</p></div>
                      
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xs-12">

                    </div>


                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cancelled Cheque </label><span
                                class="text-danger" id="motherAadharCardAstrik">*</span>

                            <input type="file" id="motherAadharCard"
                                   name="motherAadharCard"
                                   accept="image/jpg,image/jpeg">

                            <div id='motherAadharCardLink'></div>
                        </div>
                         @if ($errors->has('aadharCardCheck')) <p class="help-block" style="color: Red">{{ $errors->first('aadharCardCheck') }}</p> @endif
                    </div>

                </div>

                
                

            </div>

            <br>

            
            
                            <input type='hidden' name="aadharCardCheck" id='aadharCardCheck' value=''>
                            <input type='hidden' name="AddressDocCheck" id='AddressDocCheck' value=''>
                            <input type='hidden' name="IdentityDocCheck" id='IdentityDocCheck' value=''>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-md-12 text-center">

                    <button id="submit" class="save btn btn-success"
                            >Save And Proceed</button>
                </div>
            </div>


            {!!form::close()!!}
              
        </div>

         help text start
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
                                    <input type="search" id="search" value="" class="form-control motherschoolclicked" placeholder="Search School">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>    

                    <table class="table table-fixed text-center motherschoolsearchtable" id="table">
                        <thead>
                            <tr>

                                <th class="text-center">School Name</th>

                            </tr>
                        </thead>
                         all school populated down here 
                        <tbody>                      
                     
 
                        </tbody>
                    </table>


                    <form class="form-inline " id="addschoolMotherform" method="post">  
                        {{ csrf_field() }}
                        <div class="row">
                            <label class="" for="inlineFormInputGroup" style="margin-left:20px;">School found ? &nbsp; </label>

                            <label class="radio-inline" for="example-inline-radio1">
                                <input id="motherschoolfound" name="fatherschool"  type="radio" value="1" checked="checked"/> Yes
                            </label> 
                            <label class="radio-inline" for="example-inline-radio2">
                                <input id="motherschoolnotfound" name="fatherschool" type="radio" value="0" />
                                No
                            </label>



                        </div>
-->
                        <div class="row"  id="MotherEnterSchoolrow" style="display:none;">

                            <label class="" for="inlineFormInput" style="margin-left:20px; margin-top:20px; ">Add School &nbsp;</label>
                            <input type="text" class="form-control " id="motherSchooladdtext" placeholder="Enter School Name" value="" >
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>                                           


                    </form>

                </div>
                <div class="modal-footer">



                    <a href="#" id="selectButtonmotherSchool" data-dismiss="modal" class="btn">Select</a>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection