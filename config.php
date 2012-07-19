<?php
require_once("defaults.php");

/// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //  ///
///  Use this file to edit many aspects of the application. If nothing is specified, the value will be pulled from defaults.php ///
///  // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // ///

DBAuth::$host = 'mysql.owenjohnson.info';
DBAuth::$user = 'viorg';
DBAuth::$password = '3ast3r3gg!';
DBAuth::$db = 'candidata';


Settings::$name = "Vote Informed";
Settings::$organization = "Owen Johnson";
//Settings::$adminpass = "missingbytes";
Settings::$baseurl = "http://voteinformed.org";
Settings::$mailfrom = "mail-bot@voteinformed.org";
Settings::$envelopefrom = "VoteInformed.org";
    
Settings::$validEmailDomain = "somedomain.mail";
Settings::$restrictDomain = false;
    
Settings::$pollMonthOpen = 1;
Settings::$pollMonthClose = 12;
Settings::$pollDayOpen = 12; // first day inclusive
Settings::$pollDayClose = 31; // last day inclusive
    
?>
