<?php
define("_DB_NAME","vnxindex_sendmail");
define("_DB_USER","local");
define("_DB_PASS","ifrcvn");
define("_DB_SERVER","210.211.109.27");

define("_DB_NAME_WEB","vnxindex_data");
define("_DB_USER_WEB","vnxindex_user");
define("_DB_PASS_WEB","indexvnx");
define("_DB_SERVER_WEB","210.211.109.27");

define("_TEMPLATE_DIR","templates/");
define("_NEWSLETTERS_DIR","newsletters/");
define("_IMAGES_DIR","images/");
define("_MAIL_SMTP",true); 
//define("_MAIL_SMTP_HOST","smtp.gmail.com");
define("_MAIL_SMTP_HOST","mail.ifrc.vn");
define("_MAIL_SMTP_PORT",465);//Google-465 //1and1-587
define("_MAIL_SMTP_SECURE","ssl");
define("_MAIL_SMTP_AUTH",true);  

define("_MAIL_SMTP_USER","admin@ifrc.vn");
define("_MAIL_SMTP_PASS","ifrcvn");

define("_DEBUG_MODE",false);
define("_DEMO_MODE",false);
ini_set("display_errors",_DEBUG_MODE);

// date format for printing dates to the screen (uses php date syntax)
define("_DATE_FORMAT","d/m/Y"); 
// date format for inputting dates into the system
// 1 = DD/MM/YYYY
// 2 = YYYY/MM/DD
// 3 = MM/DD/YYYY
define("_DATE_INPUT",1); 
switch(_DATE_INPUT){
	case 1: define('_DATE_INPUT_HELP','DD/MM/YYYY'); break;
	case 2: define('_DATE_INPUT_HELP','YYYY/MM/DD'); break;
	case 3: define('_DATE_INPUT_HELP','MM/DD/YYYY'); break;
}

define('HOST','http://'.$_SERVER['HTTP_HOST']);
define('BASE_URL',HOST.dirname($_SERVER['PHP_SELF']).'/');
define('PARENT_URL', str_replace('sendmail/', '', BASE_URL));
