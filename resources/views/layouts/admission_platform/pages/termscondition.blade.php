

<script type="text/javascript">
    $(document).ready(function () {

         /* modal doesnt colse after clicking background */
        $('#myModal').modal({backdrop: 'static', keyboard: false});
            

        $('#category').on('change', function (e) {
             $("#subcategory").prop('disabled', false);
             
            $('#subcategory').addClass('loadinggif');
            console.log(e);
             $('#subcategory').empty();
           
            $("#lang").prop('disabled', false);
            var cat_id = e.target.value;
            $.get('ajax-subcat?cat_id=' + cat_id, function (data) {
                  $('#subcategory').removeClass('loadinggif');
                $.each(data, function (index, subcatobj) {
                    $('#subcategory').append('<option value="' + subcatobj.cityId + '">' + subcatobj.cityName + '</option>');


                });

            });
        });



    });
</script>
<style>
    .box{
    background: #f5f5f5;
    border-radius: 0px;
    padding:10px;
}
#modal-title{
    text-align: center;
    color: white;
   
}
 
#modal-header
{
    background-color: black;
}
    


#bt-signup{
    width: 100%;
}

</style>

<div class="container">

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
          <!--      <div class="modal-header" id='modal-header'>
                    <!--  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> -->
               <!--     <h4 class="modal-title" id='modal-title' >Required Documents</h4>
                </div>  -->
                <div class="modal-body"   style="overflow-y:auto;overflow-x:hidden; max-height:60%;  ">
 
<table class="table">
  <thead class="thead">
    <tr>
      <th >Required Documents</th>
      <th >Mandatory</th>
   
      <th >Non-Mandatory</th>
    </tr>
  </thead>
  <tbody>
      <tr >
      <th>For Venue Owner </th>
      <td>
          
          
                                    <li>Venue Photo</li>     
                                    <li>GST Number</li>
                                    <li>Document 2</li>
          
      </td>
    
      <td>  
          
        <li>a</li>
          <li>b</li>
          <li>c</li>
          <li>d</li>
          
      
      </td>
    </tr>
    <tr style="width:80px;" >
        <th    style=" width: inherit;">For Service Provider
     <div class="small" style="color:Blue; font-weight:normal; font-size: 12px;"> : </div>
               </th>
      <td>
                                    <li>GST Number</li>
                                    <li>b </li>
                                    <li>c</li>
                                    
</td>
  <td>  
          
        <li>a</li>
          <li>b</li>
          <li>c</li>
          <li>d</li>
          
      
      </td>
<td>
     
     
    </tr>

  </tbody>
</table>
                   
                   
               
                       
                </div>
                <div class="modal-footer">
                    {!!Form::open(['route'=>'tcvalidate','class'=>'form','role'=>'form','method'=>'post'])!!}
                         {{ csrf_field() }}
                          <div style="float:left; padding-ht:20px"rig class="form-group"> 
                   
                       </div>
                        </div>

                        


                    <!-- <div  style="color:red; "><h4>{{$errors->first()}}</h4></div> -->
                    
                    <!-- <a href="#" class="btn btn-primary">Accept and Proceed</a>  -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-2 col-xs-6">

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 center-block">
                            {!! Form::submit('Accept and Procced', ['class' => 'btn btn-primary','id'=>'bt-signup'] ) !!}
                        </div>



                        <div class="col-lg-4 col-md-4 col-sm-2 col-xs-6">

                            <a href="{{action('termscondition@getlogout')}}" class="btn" >Logout</a>

                        </div>



                    </div> 

            </div>
                    {!!form::close()!!}




                </div>

            </div>

        </div>

    </div>

</div>
