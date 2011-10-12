<?php
if ($profile['gender'] == "2")
    $gender= "male";
else
    $gender= "female";
    
$seeksmask = $profile['seeks'];

?>
<div id="editprofile" style="display:none">
    <h2>Your Profile</h2>
    <form action="update-profile.php" method="post">
        <p>My name is <?php echo($firstName." ".$lastName);?> and I am a 
            <select name="gender">  
                <option value ="2" <?php if($gender == "male") echo('selected="true"');?>>Man</option>  
                <option value ="1" <?php if($gender == "female") echo('selected="true"');?>>Woman<option>
            </select>, who is looking for a good time with 
            <select name="seeks"> 
                <option value ="0" <?php if($seeksmask == "0") echo('selected="true"');?>>some new pals</option> 
                <option value ="2" <?php if($seeksmask == "2") echo('selected="true"');?>>a Man</option>  
                <option value ="1" <?php if($seeksmask == "1") echo('selected="true"');?>>a Woman</option>  
                <option value ="3" <?php if($seeksmask == "3") echo('selected="true"');?>>a Man or a Woman</option>  
            </select>.
        </p>
        <p>People can send me mail at <?php echo($email);?> or my campus box <input name="box" type="number" class="short register-field" required="required" value="<?php echo($profile['box']);?>" /> and call me at <input pattern="^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$" name="phone" value="<?php echo($profile['phone']); ?>" class="register-field"/>.</p>
        <p>My friends would say <?php echo($firstName); ?> <input name="bio" required="required" class="long register-field" value="<?php echo($profile['bio']); ?>">.</p>
        <input type="submit" value="Update"/>
    </form>
</div>
<div id="profileclicky" onclick="$('#editprofile').slideDown(600); $('#profileclicky').slideUp(500);"><h2>&raquo; Update Your Profile</h2></div>
