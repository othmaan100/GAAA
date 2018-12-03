/*
Author: Usman A Musa 08034398046
*/

$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			pwd: {
			required: true,
			},
			uemail: {
            required: true
            
            },
	   },
       messages:
	   {
            pwd:{
                      required: "please enter your password"
                     },
            uemail: "please enter your Staff ID number",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'login_process.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp;checking ...');
			},
			success :  function(response)
			   {						
					if(response=="ok"){
									
						$("#btn-login").html('<img src="images/btn-ajax-loader.gif" style="height:20px;width:20px;" /> &nbsp; Login In ...');
						setTimeout(' window.location.href = "users/index.php"; ',4000);
					}
					else{
									
						$("#error").fadeIn(1000, function(){						
				$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
											$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Try again');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});