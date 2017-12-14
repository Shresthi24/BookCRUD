
<script>
    
    
   $(document).ready(function () {  
      
      $('#siblingno').click(function(){
       
             
              $('#brotherCount').val('');
              $('#sisterCount').val('');
        
      });
    
       
      $(window).scroll(function () {
            if ($(this).scrollTop() > 135) {
                $('#accordion').addClass('fixed');
            } else {
                $('#accordion').removeClass('fixed');
            }
        });
        
        if($('#siblingyes').is(':checked')){
            
            $('#countDivBrother').show();
               $('#countDivBrother').show();
         BroBoxCreate(parseInt($('option:selected', $('#brotherCount')).val()));
                
            
            
        }
        
        
         $('#defaultlangHelp').text("{{$EnglishHelpText[22]->message}}");
            $('#selectedhelpText').text("{{$SelectedHelpText[22]->message}}");
        
        
        $("#siblingyes").click(function () {
            $('#countDivBrother').show();
            $('#countDivSister').show();
            

    });
    
        $("#siblingno").click(function () {
            $('#countDivBrother').hide();
            $('#countDivSister').hide();
      
      
             for (var i = 1; i <= 3; i++) {
         var sisterboxcount='#sisterbox'+i;
                      $(sisterboxcount).remove();
                  }
    
      for (var i = 1; i <= 3; i++) {
         var borboxid='#brotherbox'+i;
    $(borboxid).remove();
                }
    });
    
    
$('#brotherCount').change(function () {
    
    var num = parseInt(this.value);

     for (var i = 1; i <= 3; i++) {
         var borboxid='#brotherbox'+i;
    $(borboxid).remove();
    }
    //for every div.element, update the name, id, value   
     for (var i = 1; i <= num; i++) {
             var newRow =  $('div.brotherbox:first').clone();   
             newRow.attr('id', 'brotherbox'+i);
    newRow.find('.form-group').each(function() {       
        $(this).find('input.firstname').attr('name', 'firstnamebrother' + i);
        $(this).find('input.secondname').attr('name', 'lastnamebrother' + i);
        $(this).find('input.agebrother').attr('name', 'agebrother' + i);
        $(this).find('select.schoolselect').attr('name', 'brotherschool' + i);
        $(this).find('select.classselect').attr('name', 'brotherclass' + i);
        $(this).find('input.divisionselect').attr('name', 'brotherdiv' + i);
        $(this).find('input.rollselect').attr('name', 'brotherroll' + i); 
        $(this).find('input.isbrother').attr('name', 'isbrother' + i); 
        
       
       
        $(this).find('input.firstname').attr('id', 'firstnamebrother' + i);
        $(this).find('input.secondname').attr('id', 'lastnamebrother' + i);
         $(this).find('input.agebrother').attr('id', 'agebrother' + i);
        $(this).find('select.schoolselect').attr('id', 'brotherschool' + i);
        $(this).find('select.classselect').attr('id', 'brotherclass' + i);
        $(this).find('input.divisionselect').attr('id', 'brotherdiv' + i);
        $(this).find('input.rollselect').attr('id', 'brotherroll' + i);
           $(this).find('input.isbrother').attr('id', 'isbrother' + i); 
         });
    
           $('div.brotherbox:last').after(newRow);
             newRow.show();
        
    //return false... just because clone is a <a> tag
     }
     
    

});

 function BroBoxCreate(num){
     
       for (var i = 1; i <= num; i++) {
             var newRow =  $('div.brotherbox:first').clone();   
             newRow.attr('id', 'brotherbox'+i);
    newRow.find('.form-group').each(function() {       
        $(this).find('input.firstname').attr('name', 'firstnamebrother' + i);
        $(this).find('input.secondname').attr('name', 'lastnamebrother' + i);
        $(this).find('input.agebrother').attr('name', 'agebrother' + i);
        $(this).find('select.schoolselect').attr('name', 'brotherschool' + i);
        $(this).find('select.classselect').attr('name', 'brotherclass' + i);
        $(this).find('input.divisionselect').attr('name', 'brotherdiv' + i);
        $(this).find('input.rollselect').attr('name', 'brotherroll' + i); 
        $(this).find('input.isbrother').attr('name', 'isbrother' + i); 

       
        $(this).find('input.firstname').attr('id', 'firstnamebrother' + i);
        $(this).find('input.secondname').attr('id', 'lastnamebrother' + i);
         $(this).find('input.agebrother').attr('id', 'agebrother' + i);
        $(this).find('select.schoolselect').attr('id', 'brotherschool' + i);
        $(this).find('select.classselect').attr('id', 'brotherclass' + i);
        $(this).find('input.divisionselect').attr('id', 'brotherdiv' + i);
        $(this).find('input.rollselect').attr('id', 'brotherroll' + i);
           $(this).find('input.isbrother').attr('id', 'isbrother' + i); 
         });
    
           $('div.brotherbox:last').after(newRow);
             newRow.show();
        
    //return false... just because clone is a <a> tag
     }
     
 }


//sistercount
$('#sisterCount').change(function () {
    
    var num = parseInt(this.value);

     for (var i = 1; i <= 3; i++) {
         var sisterboxcount='#sisterbox'+i;
    $(sisterboxcount).remove();
    }
    //for every div.element, update the name, id, value   
     for (var i = 1; i <= num; i++) {
             var newRow =  $('div.sisterbox:first').clone();   
             newRow.attr('id', 'sisterbox'+i);
    newRow.find('.form-group').each(function() {       
        $(this).find('input.firstname').attr('name', 'firstnamesister' + i);
        $(this).find('input.secondname').attr('name', 'lastnamesister' + i);
        $(this).find('input.agesister').attr('name', 'agesister' + i);
        $(this).find('select.selectschool').attr('name', 'sisterschool' + i);
        $(this).find('select.classselect').attr('name', 'sisterclass' + i);
        $(this).find('input.divisionselect').attr('name', 'sisterdiv' + i);
        $(this).find('input.rollselect').attr('name', 'sisterroll' + i); 
        $(this).find('input.isSister').attr('name', 'isSister' + i); 
       
       
          
       
        $(this).find('input.firstname').attr('id', 'firstnamesister' + i);
        $(this).find('input.secondname').attr('id', 'lastnamesister' + i);
        $(this).find('input.agesister').attr('id', 'agesister' + i);
        $(this).find('select.selectschool').attr('id', 'sisterschool' + i);
        $(this).find('select.classselect').attr('id', 'sisterclass' + i);
        $(this).find('input.divisionselect').attr('id', 'sisterdiv' + i);
        $(this).find('input.rollselect').attr('id', 'sisterroll' + i); 
        $(this).find('input.isSister').attr('id', 'isSister' + i);
         });
    
           $('div.sisterbox:last').after(newRow);
             newRow.show();
        
    //return false... just because clone is a <a> tag
     }

});



});


</script>