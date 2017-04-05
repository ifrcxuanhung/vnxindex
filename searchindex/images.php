<?php
//start session
session_start();

//include functions
include_once ("include/commonfuncs.php");

require_once('settings/db_search.php'); 
require_once('settings/conf.php');
require_once("include/searchfuncs.php");
include_once ("settings/en-language.php");



//extract(getHttpVars());

// define the post value
if (isset($_GET['query']))
	$query = $_GET['query'];
    $term = $_GET['query'];
if (isset($_GET['search']))
	$search = $_GET['search'];
 
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
<title>Sphider Pro Image Search</title> 
</head>
<body>
<br /><br />
<a href="index.php" title="Web Search">Web</a> | <a href="images.php">Images</a>
<br /><br />
<form id="searchbox" name="searchForm" action="images.php" method="get">
<table>
<tr><td>
<script type="text/javascript">
/*<![CDATA[*/
document.write("<input name=\"query\" class=\"search\" type=\"text\" id=\"query\" size=\"50\" value=\"<?php print quote_replace($query);?>\" + action=\"include/js_suggest/suggest.php\" columns=\"2\" autocomplete=\"off\" delay=\"0\"  />");
/*]]>*/
</script> 
</td><td>

    <input class="submit" type="submit" value="Search" />
</td>
</tr>
</table>
</form>
<script type="text/javascript">
<!--

document.searchForm.query.focus();

//-->
</script> 


<br /><br />

<?php
if ($query !='') {
include_once ("include/imgsfunctions.php");
}
?>

<?php
mysql_close($link);
?>

</body>
</html>