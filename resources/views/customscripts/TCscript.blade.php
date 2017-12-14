
<script type="text/javascript">
    $(document).ready(function () {

         /* modal doesnt colse after clicking background */
        $('#myModal').modal({backdrop: 'static', keyboard: false});
            

        $('#state').on('change', function (e) {
             $("#city").prop('disabled', false);
             
            $('#city').addClass('loadinggif');
            console.log(e);
             $('#city').empty();
           
            $("#lang").prop('disabled', false);
            var cat_id = e.target.value;
            $.get('ajax-subcat?cat_id=' + cat_id, function (data) {
                  $('#city').removeClass('loadinggif');
                $.each(data, function (index, subcatobj) {
                    $('#city').append('<option value="' + subcatobj.cityId + '">' + subcatobj.cityName + '</option>');


                });

            });
        });



    });
</script>
