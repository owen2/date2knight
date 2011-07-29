function doCommand(com,grid)
{
    if (com == 'Mark Paid')
    {
	$('.trSelected',grid).each(function(){
	    var id = $(this).attr('id');
	    id = id.substring(id.lastIndexOf('row')+3);
	    $.ajax({
		url: "markpaid.php",
		data: 'id=' + id,
		type: 'post',
		success: function(){
		    $('#flex').flexReload();
		}
	    });
	});
    }
    else if (com == 'Unmark Paid')
    {
	$('.trSelected',grid).each(function(){
	    var id = $(this).attr('id');
	    id = id.substring(id.lastIndexOf('row')+3);
	    $.ajax({
		url: "unmarkpaid.php",
		data: 'id=' + id,
		type: 'post',
		success: function(){
		    $('#flex').flexReload();
		}
	    });
	});
    }
}
$(document).ready(function(){
    $('#flex').flexigrid({
	url: "kioskdata.php",
	dataType: "json",
	colModel: [
		   {display: "First Name", name: "firstname",width: 80,sortable: true,align: "left"},
		   {display: "Last Name",name: "lastname", width: 80,sortable: true,align: "left"},
		   {display: "Box",name: "box", width:60,sortable: true,align:"left"},
		   {display: "Paid",name: "box",width:60,sortable: true,align: "left"}
	],
		buttons: [
			  {name: "Mark Paid",bclass: "add",onpress: doCommand},
			  {name: "Unmark Paid",bclass: "delete",onpress: doCommand}
			  ],
	searchitems: [
		      {display: "First Name",name: "firstname"},
		      {display: "Last Name",name: "lastname"}
	],
	sortname: "lastname",
	sortorder: "asc",
	usepager: true,
	useRp: true,
	rp: 10,
	showTableToggleBtn: false,
	resizable: true,
	width:960,
	height:330,
	singleSelect: true
    });


});
