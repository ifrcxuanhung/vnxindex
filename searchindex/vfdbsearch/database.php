<?php 

error_reporting (E_ALL ^ E_NOTICE);

$include_dir = "../include";
include "auth.php";
include "$include_dir/commonfuncs.php";
extract (getHttpVars());
$settings_dir = "../settings";
include "$settings_dir/conf.php";
$backup_path="./backup/";
$dbname=$database;
$dbprefix=$mysql_table_prefix;
extract($_POST);
extract($_REQUEST);
if (isset($send2)) {
	include("db_backup.php");
}


//show functions
function getStatistics() {
		global $mysql_table_prefix;
		$stats = array();
		$keywordQuery = "select count(keyword_id) from ".$mysql_table_prefix."keywords";
		$linksQuery = "select count(url) from ".$mysql_table_prefix."links";
		$siteQuery = "select count(site_id) from ".$mysql_table_prefix."sites";
		$domainQuery = "select count(domain) from ".$mysql_table_prefix."domains";
		$imgQuery = "select count(imgUrl) from ".$mysql_table_prefix."imgs";

		$result = mysql_query($keywordQuery);
		echo mysql_error();
		if ($row=mysql_fetch_array($result)) {
			$stats['keywords']=$row[0];
		}
		$result = mysql_query($linksQuery);
		echo mysql_error();
		if ($row=mysql_fetch_array($result)) {
			$stats['links']=$row[0];
		}
		for ($i=0;$i<=15; $i++) {
			$char = dechex($i);
			$result = mysql_query("select count(link_id) from ".$mysql_table_prefix."link_keyword$char");
			echo mysql_error();
			if ($row=mysql_fetch_array($result)) {
				$stats['index']+=$row[0];
			}
		}
		$result = mysql_query($siteQuery);
		echo mysql_error();
		if ($row=mysql_fetch_array($result)) {
			$stats['sites']=$row[0];
		}
		$result = mysql_query($domainQuery);
		echo mysql_error();
		if ($row=mysql_fetch_array($result)) {
			$stats['domain']=$row[0];
		}
		$result = mysql_query($imgQuery);
		echo mysql_error();
		if ($row=mysql_fetch_array($result)) {
			$stats['imgUrl']=$row[0];
		}

		return $stats;
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<script language="JavaScript">
function checkAll(theForm, cName, allNo_stat) {
	var n=theForm.elements.length;
	for (var x=0;x<n;x++){
		if (theForm.elements[x].className.indexOf(cName) !=-1){
			if (allNo_stat.checked) {
			theForm.elements[x].checked = true;
		} else {
			theForm.elements[x].checked = false;
		}
	}
	}
}

  function confirm_del_prompt(URL) {
	if (!confirm("Do you really want to delete the backup file?")) 
		return false;	  
	window.location = URL;
	}

 function confirm_rest_prompt(URL) {
	if (!confirm("Do you want to restore the database from backup file? Current database will be lost.")) 
		return false;	  
	window.location = URL;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Sphider Pro administrator tools</title>
<link rel="stylesheet" href="main.css" type="text/css" />
</head>
<body>
<div id="admin"> 
	<div id="tabs">
		<ul>
		<li><a href="index.php" id="default">Sites</a></li> 
        <li><a href="categories.php" id="default">Categories</a></li>
		<li><a href="clean.php" id="default">Clean tables</a></li>
		<li><a href="settings.php" id="default">Settings</a></li>
		<li><a href="statistics.php" id="default">Statistics</a></li>
		<li><a href="database.php" id="selected">Database</a></li>
		<li><a href="logout.php" id="default">Log out</a></li>
		</ul>
	</div>
	<div id="main">  
		<div id='submenu'>
        <!-- submenu links here -->
		 
          <!-- end submenu links -->
		</div>
        <div id="searchform"><form action="index.php" method="post">
        <input type="hidden" name="f" value="searchsite" /><input type="text" name="searchurl" size="25" /><input type="submit" value="Find site" /></form></div>
<!-- main bady functions here -->
<br /><br />
<?php

include "db_main.php";
?>
<!-- end body functions -->
<br /><br />
<?php
$stats = getStatistics();
	print "<br/><br/>	<center>Currently in database: ".number_format($stats['sites'])." sites, ".number_format($stats['domain'])." domains, ".number_format($stats['links'])." links, ".number_format($stats['keywords'])." keywords and ".number_format($stats['imgUrl'])." images.<br/><br/></center>\n";
?>
<br /><br />
</div>
</div>
</body>
</html>