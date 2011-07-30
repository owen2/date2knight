$(document).ready(function(){
    $('#phone').mask("(999) 999-9999");
    $('#quiz').validationEngine('attach', {promptPosition : "centerRight", scroll: true}); 
    $('#friend').click(function(){
	$('.loveseeking').attr('checked',false);
    });
    $('.loveseeking').click(function(){
	$('#friend').attr('checked',false);
    });
    $('#submit').click(function(){
	if ($("#quiz").validationEngine('validate')){
	    $('#hiddenSubmit').click();
	}
    });
});
