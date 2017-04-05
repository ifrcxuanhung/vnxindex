<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL ^ E_NOTICE);
$base_url = "http://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']); 
/* replace url if you in search page */
$base_url = str_replace("/search", "", $base_url);
define('WEBSITE_URL',$base_url);
define('DB_DATABASE', 'ueldb');
define('HTTP_HOST',$_SERVER['SERVER_NAME']);
define('DB_HOST', 'local.itvn.fr');
define('DB_USER', 'local');
define('DB_PASS', 'ifrcvn');
define('SMTP_HOST', 'smtp.rsap.fr');
define('SMTP_EMAIL', 'mail@rsap.fr');
define('SMTP_USER', 'mail@rsap.fr');
define('SMTP_PASS', 'ifrc@2012');
define('TIME_CACHE', '43200'); // second = 12h
define('TIME_EXPIRE', '86400'); // second = 1day
define('LANG_DEFAULT','en');

?>