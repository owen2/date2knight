<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
include("functions.php");
$name = "Test User";
$email = "spam@colorfullimo.com";

$db = db_connect();
$stmt = $db->stmt_init();
if (isset($_SESSION['instant']))
{
    if ($stmt->prepare("SELECT firstname,lastname,email FROM profile WHERE validated=?"))
    {
	$stmt->bind_param('s',$_SESSION['instant']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($firstname,$lastname,$email);
	if ($stmt->num_rows < 1)
	{
	    die('<font color="red">Your unique code was not found. Please try again.</font>');
	}
	$stmt->fetch();
	$stmt->free_result();
	$name = $first . ' ' . $last;
    }
}else
{
    if ($stmt->prepare("SELECT `username` FROM `queue` WHERE `token`=?"))
    {
	$stmt->bind_param('s',$_GET['token']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($username);
	if ($stmt->num_rows < 1)
	{
	    die('<font color="red">Your unique code was not found. Please try again.</font>');
	}
	$stmt->fetch();
	$stmt->free_result();
	$email = $username . '@wartburg.edu';
	$nameFrag = explode('.',$username);
	$name = ucfirst($nameFrag[0]) . ' ' . ucfirst($nameFrag[1]);
	
    }
}
?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />

        <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>   
	<script type="text/javascript" src="js/jquery.validationEngine-en.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery.validationEngine.js" charset="utf-8"></script>
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"></script>
        <script type="text/javascript" src="js/quiz.js"></script> 
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

    </head>
    <body>

        <div class="bodywrap">
            <br>
            <h1>Date2Knight Survey</h1>
            <form id="quiz" action="capturedata.php" method="post" >
            <input type="hidden" name="token" value="<?php echo($_GET['token']);?>" />
            <table width=100%>
    <?php
    if ($stmt->prepare("SELECT `id`,`text`,`lefttext`,`righttext` FROM `question` WHERE `enable`=1 ORDER BY rand();"))
    {
	$stmt->execute();
	$stmt->bind_result($id,$text,$lefttext,$righttext);
	while($stmt->fetch())
	{
	    ?>
	               <tr><td colspan="3" class="question"><?php echo($text);?></td></tr><?php ?>
		<tr><td class="centered"><?php echo($lefttext);?></td><td><input id="<?php echo($id);?>" name="question_<?php echo($id);?>" type="range" class="slider" min="0" max="10" value="5"/></td><td class="centered"><?php echo($righttext);?></td></tr>
                    <tr><td colspan="3"><hr></td></tr>
											    
		    <?php
       }
	$stmt->close();
    }
    $db->close();
    ?>

		    </table>
		    <table class="padded content">
                <tr>
                    <th colspan=2>Contact Info</th>
                </tr>
                <tr>
                    <td> Full Name:</td><td><?php echo($name);?><input type="hidden" name="name" value="<?php echo($name); ?>"/></td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td> <?php echo($email);?><input type="hidden" name="email" value="<?php echo($email); ?>"/></td>                
                </tr>
                <tr>
                    <td>Send my results to box:</td>
                    <td style="width:300px"><input name="box" id="box" class="validate[required]" /><span class="error"></span></td>
                </tr>
                <tr>
                    <td>Public phone number:</td>
                    <td style="width:300px"><input name="phone" id="phone" class="validate[required]" /><span class="error"></span></td>
                </tr>
                
                <tr>
                    <th colspan="2">Sexual Orientation</th>
                </tr>
                <tr>
                    <td>Are you female or male?</td>
                    <td><input type="radio" name="gender" value="f"/>Female<input type="radio" name="gender" value="m"/>Male</td>
                </tr>
                <tr>
                    <td>Interested in men?</td><td><input class="loveseeking" type="checkbox" name="seeksmale"/>Match me with men. </td>
                </tr>
                <tr>
                    <td>Interested in women?</td><td><input type="checkbox" class="loveseeking" name="seeksfemale" />Match me with women.</td>
                </tr>
                <tr>
                    <td>Not looking for dates?</td><td><input id="friend" type="checkbox" name="seeksfriend" />Exclude me from love matches, I only want friend matches.</td>
                </tr>
		<tr>
		  <th>Personal Biography</th>
		</tr>
		    </table>
			<textarea id="elm1" name="bio" rows="15" cols="80" style="width: 80%"></textarea>

		    <input class="hugebutton" type="submit" value="Next &raquo;"></input>
		    <input type="submit" id="hiddenSubmit" style="display: none;" />
		    </form>
		    <script>
            $(":range").rangeinput();
            </script>
            <br>
	    </div>
    </body>
</html>
