<?php
// A simple authentication library by Owen Johnson
// auth.php
// require_once this file before output starts. Call exactly one of the following auth functions.

function checkSimplePasskey($realpass, $challenge)
{
    if(isset($_SESSION['key']))
    {
        return $_SESSION['key'] == $realpass;
    }
    elseif ($realpass==$challenge)
    {
        $_SESSION['key'] = $challenge;
        return true;
    }
    else
    {
        return false;
    }
}
?>
