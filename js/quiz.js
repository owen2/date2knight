var phone_expr = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
$(document).ready(function(){
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
	});
});