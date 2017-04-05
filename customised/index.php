<?php
    session_start();
	include_once "config/config.php";
    include_once "config/db.php";
    include_once "config/my_helper.php";
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
    if(!isset($_SESSION['LANG_CURRENT'])) $_SESSION['LANG_CURRENT'] = $lang_default;

	include "controller/".$con."_controller.php";
	$con = $con."_controller";
	$controller = new $con;
	$controller->$act();
?>