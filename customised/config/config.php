<?php
Class Config
{
	public $server      = "local";
    public $username    = "local";
    public $password    = "ifrcvn";
    public $database    = "vnxindex_data";
}

define('HOST','http://'.$_SERVER['HTTP_HOST']);
if(HOST == "http://customised.vnxindex.com")
{
    define('BASE_URL',HOST.'/');
    define('PARENT_URL',str_replace('customised.','',BASE_URL));
    define('TEMPLATE_URL',BASE_URL.'template/');
}
else
{
    define('BASE_URL',HOST.dirname($_SERVER['PHP_SELF']).'/');
    define('PARENT_URL',str_replace('customised/','',BASE_URL));
    define('TEMPLATE_URL',BASE_URL.'template/');
}
