function validateForm()
{
 	var x=document.forms["login"]["email"].value
  	var y=document.forms["login"]["password"].value
  	if (x==null || x=="" || y == null || y == "")
 	{
 		alert("You missed a spot.");
 		return false;
 	}
}