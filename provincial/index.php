<?php

session_start();
include_once "config/config.php";
include_once "config/db.php";
include_once "config/my_helper.php";
ini_set("date.timezone", "UTC");
$db = new DB();
$con = isset($_GET["controller"]) ? $_GET["controller"] : "home";
$act = isset($_GET["action"]) ? $_GET["action"] : "index";
$sql = "SELECT * 
            FROM `language`
            WHERE `status` = 1
            ORDER BY `sort_order`";
$data = $db->selectQuery($sql);
$lang_default = $data[0]['code'];
$_SESSION['LANG_DEFAULT'] = $lang_default;
if (!isset($_SESSION['LANG_CURRENT']))
    $_SESSION['LANG_CURRENT'] = $lang_default;
if (is_file("controller/" . $con . "_controller.php"))
{
    include "controller/" . $con . "_controller.php";
    $con = $con . "_controller";
    $controller = new $con;
    if(method_exists($controller, $act) !== false) {
        $controller->$act();
    }
}
?>