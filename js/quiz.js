$(document).ready(function(){
    $('#phone').mask("(999) 999-9999");
    $('#quiz').validationEngine('attach', {promptPosition : "centerRight", scroll: true}); 
    $('#submit').click(function(){
	if ($("#quiz").validationEngine('validate')){
	    $('#hiddenSubmit').click();
	}
    });
});
