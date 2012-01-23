<?php

class DbAuth
{
    public static $host = 'mysql.owenjohnson.info';
    public static $user = 'lovematch';
    public static $password = 'lovematch';
    public static $db = 'lovematch';
}

class Settings
{
    public static $name = "Date2Knight";
    public static $organization = "Wartburg Computer Club";
    public static $adminpass = "missingbytes";
    public static $baseurl = "http://date2knight.com/";
    public static $mailfrom = "mail-bot@date2knight.com";
    public static $envelopefrom = "Date 2 Knight";
    
    public static $validEmailDomain = "wartburg.edu";
    public static $DEBUG_ALLOW_ANY_EMAIL = false;
    
    public static function isAddressAllowed($address)
    {
        return $this->DEBUG_ALLOW_ANY_EMAIL or strpos($address, Settings::$validEmailDomain);
    }
    
    public static $pollMonthOpen = 2;
    public static $pollMonthClose = 2;
    public static $pollDayOpen = 1; // first day inclusive
    public static $pollDayClose = 14; // last day inclusive
    
    public static function isPollOpen()
    {
        return ((Settings::$pollMonthOpen <= Date('n') and Date('n') <= Settings::$pollMonthClose) and (Settings::$pollDayOpen <= Date('j') and Date('j') <= Settings::$pollDayClose));
    }
}
?>
