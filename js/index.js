$(document).ready(function(){
    $('#form').validationEngine('attach', {promptPosition : "topRight", scroll: true});

    $('#submit').click(function(e){
	e.preventDefault();
	$('#loading').html('<img src="images/spinner.gif"> &nbsp; Processing...');
	if ($("#form").validationEngine('validate')){
	    if ($('#instant').val() == '1')
		var formAction = 'instantproc.php';
	    else
		var formAction = 'indexproc.php';
	    $.ajax({
		type: 'post',
		url: formAction,
		data: 'email=' + $('#email').val(),
		success: function(response){
		    $('#loading').html(response);
		}
	    });
	}
    });
});