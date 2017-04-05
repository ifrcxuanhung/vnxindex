<?php

Class Config {

    public $server = "local.itvn.fr";
    public $username = "local";
    public $password = "ifrcvn";
    public $database = "vnxindex_data";

	// public $server = "112.213.87.62";
    // public $username    = "vnxindex_user";
    // public $password    = "IfRcdEc2013";
    // public $database    = "vnxindex_data";

}
define('HOST', 'http://'.$_SERVER['HTTP_HOST']);
define('CODE_CATE', 'provincial');
if (strpos(HOST, 'local') === false)
{
    define('BASE_URL', HOST . '/');
    define('PARENT_URL', 'http://vnxindex.com/');
    define('TEMPLATE_URL', BASE_URL . 'template/');
}
else
{
    define('BASE_URL', HOST . dirname($_SERVER['PHP_SELF']) . '/');
    define('PARENT_URL', 'http://vnxindex.com/');
    define('TEMPLATE_URL', BASE_URL . 'template/');
}