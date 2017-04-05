<?php

	$database="vnxindex_data";
	$mysql_user = "local";
	$mysql_password = "ifrcvn"; 
	$mysql_host = "local";
	$mysql_table_prefix = "";
	/*
	$conn=mysql_connect($mysql_host,$mysql_user,$mysql_password) or die (mysql_error());
	mysql_select_db($database,$conn) or die (mysql_error());
	mysql_query('set names utf8');
	*/
	
	$success = mysql_pconnect ($mysql_host, $mysql_user, $mysql_password);
	if (!$success)
		die ("<b>Cannot connect to database, check if username, password and host are correct.</b>");
	@mysql_query("SET NAMES utf8",$success);
    $success = mysql_select_db ($database);
	if (!$success) {
		print "<b>Cannot choose database, check if database name is correct.";
		die();
	}

?>

