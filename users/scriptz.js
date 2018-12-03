  
$(function() {
  

  $(".rchk").click(function(){

    var id = $(this).attr("d");   

 
    if( $("input[name='"+id+"']:checked")){
       $('#s'+id+'').addClass("fa fa-check");
     $('#s'+id+'').css("color", "red");
     


  };

  	});

 });