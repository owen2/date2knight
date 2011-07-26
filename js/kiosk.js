function doCommand(com,grid)
{
    return 0;

}
$(document).ready(function(){
    $('#flex').flexigrid({
	url: "kioskdata.php",
	dataType: "json",
	colModel: [
		   {display: "Name", name: "name",width: 80,sortable: true,align: "left"},
		   {display: "Box",name: "box", width:60,sortable: true,align:"left"},
		   {display: "Paid",name: "box",width:60,sortable: true,align: "left"}
	],
		buttons: [
			  {name: "Mark Paid",bclass: "add",onpress: doCommand},
			  {name: "Unmark Paid",bclass: "delete",onpress: doCommand}
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
