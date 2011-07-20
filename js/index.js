$(document).ready(function(){
    $('#form').validationEngine('attach', {promptPosition : "topRight", scroll: true});

    $('#submit').click(function(e){
	e.preventDefault();
	$('#loading').html('<img src="images/spinner.gif"> &nbsp; Processing...');
	if ($("#form").validationEngine('validate')){
	    $.ajax({
		type: 'post',
		url: 'indexproc.php',
		data: 'email=' + $('#email').val(),
		success: function(response){
		    $('#loading').html(response);
		}
	    });
	}
    });
});