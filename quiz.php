<?php error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("config.php");
require_once("quizlib.php");

if (!Settings::isPollOpen())
{
    die("The quiz isn't open, but you should come back on ". Settings::$pollMonthOpen."/".Settings::$pollDayOpen);
}

include("functions.php");
if (!isset($_SESSION))
   session_start();

$q = "SELECT * FROM `profile` WHERE `id` = ".$_SESSION['id'];
$result = mysql_query($q);
$profile = mysql_fetch_array($result);

$firstName = $profile['firstname'];
$lastName = $profile['lastname'];
$email = $profile['email'];
$bio = $profile['bio'];
$profileImage = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?r=x&d=404";
$valid = $profile['validated'];
$paid = $profile['paid'];
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
		theme : "simple",
		//plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		//theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		//theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		//theme_advanced_toolbar_location : "top",
		//theme_advanced_toolbar_align : "left",
		//theme_advanced_statusbar_location : "bottom",
		//theme_advanced_resizing : true,

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
            
            <?php  
            
            quizTable(); 
            
            function contactTable(){ ?>
		    <table class="padded content">
                <tr>
                    <th colspan=2>Contact Info</th>
                </tr>
                <tr>
                    <td> Full Name:</td><td><?php echo("$firstName $lastName");?></td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td><?php echo($email);?></td>                
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
                    <td>I am a </td>
                    <td>
                    	<select name="gender">  
                			<option value ="2" >Man</option>  
                			<option value ="1" selected="true">Woman<option>
            			</select>
            		</td>
                </tr>
                <tr>
                    <td>I'm interested in</td>
                    <td>
                    	<select name="seeks"> 
                			<option value ="0" selected="true">Friends Only</option> 
                			<option value ="2" >a Man</option>  
                			<option value ="1" >a Woman</option>  
                			<option value ="3" >a Man or a Woman</option>  
            			</select>
					</td>
                </tr>
		        <tr>
		            <th>Say something nice about yourself:</th>
		        </tr>
		        
		                  		        
		        
		    </table><?php } contactTable(); ?>
			<textarea id="elm1" name="bio" rows="15" cols="80" style="width: 80%"></textarea>
		    <input class="hugebutton" type="submit" value="Next &raquo;" />
		    <input type="submit" id="hiddenSubmit" style="display: none;" />
		    <input type="hidden" name="instant" value="yes" />
		    </form>

            <br>
	    </div>
    </body>
</html>
