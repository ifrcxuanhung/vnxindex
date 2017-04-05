<?php
Class Config
{
    public $server = "27.0.14.51";
    public $username = "intranet_user";
    public $password = "ifrcintranet";
    public $database = "intranet_db";
    
	public $server2      = "local";
    public $username2    = "local";
    public $password2    = "ifrcvn";
    public $database2    = "vnxindex_data";
}

define('HOST','http://'.$_SERVER['HTTP_HOST']);
if(HOST == "http://m.vnxindex.com")
{
    define('BASE_URL',HOST.'/');
    define('PARENT_URL','http://intranet.ifrc.vn/');
    //define('PARENT_URL',str_replace('m.','',BASE_URL));
    define('TEMPLATE_URL',BASE_URL.'template/');
}
else
{
    define('BASE_URL',HOST.dirname($_SERVER['PHP_SELF']).'/');
    //define('PARENT_URL',str_replace('mobile/','',BASE_URL));
    define('PARENT_URL','http://intranet.ifrc.vn/');
    define('TEMPLATE_URL',BASE_URL.'template/');
}
