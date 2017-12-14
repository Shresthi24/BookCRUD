$(document).ready(function(){
    $("#loginbar").click(function(){
        $("#loginbox").fadeToggle().keyup(function(e){
			   if (e.keyCode == 27) {
				   $("#loginbox").fadeout();
				   	 $("#forgotpassword").fadeout();
				   
			   }
			
			
		});
		
		
        
    });
	
	$('#fp').click(function(){
		 $("#loginbox").hide();
		 $("#forgotpassword").fadeToggle();
		 
		
	});
	
	
		$('#fp-signin').click(function(){
		 $("#forgotpassword").hide();
		 $("#loginbox").fadeToggle();
		 
		
	});
	
	
	
	
	
});