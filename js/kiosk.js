$(document).ready(function(){
    $('#flex').flexigrid({
	url: "kioskdata.php",
	dataType: "json",
	colModel: [
	    {display: "Name", name: "name",width: 80,sortable: true,align: "left"}
	],
	searchitems: [
	    {display: "Name",name: "name"}
	],
	sortname: "name",
	sortorder: "asc",
	usepager: true,
	useRp: true,
	rp: 10,
	showTableToggleBtn: false,
	resizable: true,
	width:600,
	height:330,
	singleSelect: true
    });


});
