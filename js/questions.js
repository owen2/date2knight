function doCommand(com,grid)
{
    if (com == "Add")
    {
	$('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('questionform.php');
    }
    if (com == 'Edit')
    {
	$('.trSelected',grid).each(function(){
	    var questionId = $(this).attr('id');
	    questionId = questionId.substring(questionId.lastIndexOf('row')+3);
	    $('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('questionform.php',{id: questionId});
	});
    }
    if (com == 'Delete')
    {
	$('.trSelected',grid).each(function(){
	    var questionId = $(this).attr('id');
	    questionId = questionId.substring(questionId.lastIndexOf('row')+3);
	    $('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('deletequestion.php',{id: questionId},function(){$('#flex').flexReload();});
	});
    }
    if (com == 'Enable')
    {
	$('.trSelected',grid).each(function(){
	    var questionId = $(this).attr('id');
	    questionId = questionId.substring(questionId.lastIndexOf('row')+3);
	    $('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('enablequestion.php',{id: questionId,enable:'1'},function(){$('#flex').flexReload();});
	});
    }
    if (com == 'Disable')
    {
	$('.trSelected',grid).each(function(){
	    var questionId = $(this).attr('id');
	    questionId = questionId.substring(questionId.lastIndexOf('row')+3);
	    $('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('enablequestion.php',{id: questionId,enable:'0'},function(){$('#flex').flexReload();});
	});
    }
}
function cancel()
{
    $('#formspace').empty();
}
function save()
{
    var questionId = $('#questionId').val();
    var leftarea = $('#left').val();
    var rightarea = $('#right').val();
    var questionarea = $('#question').val();
    $('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('updatequestion.php',{id: questionId,left: leftarea,question: questionarea,right: rightarea},function(){$('#flex').flexReload();});
    
}
function insert()
{
    var leftarea = $('#left').val();
    var rightarea = $('#right').val();
    var questionarea = $('#question').val();
    $('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('insertquestion.php',{left: leftarea,question: questionarea,right: rightarea},function(){$('#flex').flexReload();});

}
$(document).ready(function(){
    $('#flex').flexigrid({
	url: "questionsdata.php",
	dataType: "json",
	colModel: [
	    {display: "Left Text", name: 'lefttext',width:170,sortable: true,align: 'left'},
	    {display: "Question", name: 'text', width:400, sortable: true, align:'left'},
	    {display: "Right Text", name: 'righttext',width: 170,sortable:true,align: 'left'},
	    {display: "Enabled", name: 'enable',width:40,sortable: true,align:'left'}
	],
	buttons: [
	    {name: "Add", bclass: 'add',onpress: doCommand},
	    {name: 'Delete',bclass: 'delete',onpress: doCommand},
	    {name: 'Edit',bclass: 'edit',onpress: doCommand},
	    {name: 'Enable',onpress: doCommand},
	    {name: 'Disable',onpress: doCommand}
	],
	searchitems: [
	    {display: 'Left Text',name: 'lefttext'},
	    {display: 'Text',name: 'text'},
	    {display: 'Right Text', name: 'righttext'}
	],
	sortname: 'enable',
	sortorder: 'desc',
	usepager: true,
	useRp: true,
	rp: 15,
	showTableToggleBtn: false,
	resizeable: true,
	width: 960,
	height: 390,
	singleSelect: true
    });
    $('#flex').dblclick(function(e){
	    target = $(e.target);

	    while(target.get(0).tagName != "TR"){
		target = target.parent();
	    }
	    var questionId = target.get(0).id.substr(3);
	    $('#formspace').html('<img src="images/spinner.gif"> &nbsp; Processing...').load('questionform.php',{id: questionId});
	});
});
