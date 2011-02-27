var phone_expr = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
<<<<<<< HEAD

=======
$(document).ready(function(){
>>>>>>> 2e9c0870ac57ba3acd34927e58821f3d11e0e89e
	$("input[name=box]").blur(function() {
	    var box_error = $(this).next();
	    if ($(this).val() == null || $(this).val() == "") {
	        box_error.text("Email is invalid");
	    } else {
	        box_error.text("");
	    }
	});
	$("input[name=phone]").blur(function() {
	    var phone_error = $(this).next();

	    if ($(this).val() == null || $(this).val() == "" || !phone_expr.test($(this).val())) {
	        phone_error.text("Phone is invalid");
	    } else {
	        phone_error.text("");
	    }
	});
	
	function validate(){
		if(!$("input[name=box]").val()==""){
			if(!$("input[name=phone]").val()==""){
				if(phone_expr.test($("input[name=phone]").val())){
					return true;							
				}			
			}
		}
		return false;
	}
	
	$('#quiz').submit(function() {
	   return validate();
<<<<<<< HEAD
	});
=======
	});
});
>>>>>>> 2e9c0870ac57ba3acd34927e58821f3d11e0e89e
