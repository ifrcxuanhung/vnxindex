<?php
//start session
session_start();

//include functions
include_once ("include/commonfuncs.php");

require_once('settings/db_search.php'); 
require_once('settings/conf.php');

//gather the get and post values
if(isset($_GET['adv'])){
	$adv = $_GET['adv'];
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="include/common.css" type="text/css" />
<meta name="robots" content="index,follow" />
<link href="include/js_suggest/SuggestFramework.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="include/js_suggest/SuggestFramework.js"></script>
<script type="text/javascript">window.onload = initializeSuggestFramework;</script> 
<script src="include/jquery_compressed.js" type="text/javascript"></script>
<title>Sphider Pro</title> 
</head>
<body>
<br /><br />
<a href="index.php" title="Web Search">Web</a> | <a href="images.php">Images</a>
<br /><br />
<form id="searchbox" name="searchForm" action="results.php" method="get">
<table>
<tr><td>
<?php
	if(!isset($query)){
		$query='';
	}
?>
<script type="text/javascript">
/*<![CDATA[*/
document.write("<input name=\"query\" class=\"search\" type=\"text\" id=\"query\" size=\"50\" value=\"<?php print quote_replace($query);?>\" + action=\"include/js_suggest/suggest.php\" columns=\"2\" autocomplete=\"off\" delay=\"0\"  />");
/*]]>*/
</script> 
</td><td>
<input class="submit" type="submit" value="Search" />
</td>
</tr>
<tr>
<td colspan="2" class="center">
<?php
if(!isset($adv)){
	$adv=0;
}
 if (($advanced_search==1) && ($adv!=1)) {
	echo "<a href='index.php?adv=1' title='Advanced Search'>Advanced Search</a>";
}
if (($advanced_search==1) && ($adv==1)) {
	//show advanced search options
require_once('include/advancedSearch.php');	
}
?>
</td>
</tr>
</table>
</form>
<script type="text/javascript">
<!--

document.searchForm.query.focus();

//-->
</script> 


	
<?php
mysql_close($link);
?>
</body>
</html>