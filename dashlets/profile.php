<h2>Your Profile</h2>
<form action="update-profile.php" method="post">
    <p>My name is <?php echo($firstName." ".$lastName);?> and I am a <select name="gender">  <option value ="10">Man</option>  <option value ="01">Woman<option></select>, who is looking for a good time with <select name="seeks"> <option value ="00">some new pals</option> <option value ="10">a Man</option>  <option value ="01">a Woman</option>  <option value ="11">a Man or a Woman</option>  </select>.</p>
    <p>People can send me mail at <?php echo($email);?> or my campus box <input name="box" type="number" class="short register-field" required="required" /> and call me at <input pattern="^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$" class="register-field"/>.</p>
    <p>My friends would say <?php echo($firstName); ?> <input name="bio" required="required" class="long register-field">.</p>
    <input type="submit"/>
</form>
