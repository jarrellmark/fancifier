<!--
$(document).ready(function(){

   	  var input = $('#text').attr('value'); 
   	  var type = $('input:radio[name=fancyType]:checked').val();
 	  	
      $.ajax({
        type: "POST",
        url:  "fancify.php",
        data: "type=" + type + "&input=" + input,
        success: function(){
            alert("success!");
        }
      });
	  
	  return false;
	});
});
-->