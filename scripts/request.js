<!--
$(document).ready(function(){

   	  var input = $('#text').attr('value'); 
   	  var type = $('input:radio[name=fancyType]:checked').val();
 	  
 	  alert("success!");
 	   	  
      $.ajax({
        type: "POST",
        url:  "fancify.php",
        data: "type=" + type + "&input=" + input,
        success: function(response){
            alert("success!");
        }
      });
	  
	  return false;
	});
});
-->