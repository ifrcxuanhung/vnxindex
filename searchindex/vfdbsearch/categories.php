<?php 


error_reporting (E_ALL ^ E_NOTICE);

$include_dir = "../include";
include "auth.php";
include "$include_dir/commonfuncs.php";
extract (getHttpVars());
$settings_dir = "../settings";
include "$settings_dir/conf.php";
set_time_limit (0);

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
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Sphider Pro administrator tools</title>
<link rel="stylesheet" href="main.css" type="text/css" />
</head>
<body>
<div id="admin"> 
	<div id="tabs">
		<ul>
		<li><a href="index.php" id="default">Sites</a></li> 
        <li><a href="categories.php" id="selected">Categories</a></li>
		<li><a href="clean.php" id="default">Clean tables</a></li>
		<li><a href="settings.php" id="default">Settings</a></li>
		<li><a href="statistics.php" id="default">Statistics</a></li>
		<li><a href="database.php" id="default">Database</a></li>
		<li><a href="logout.php" id="default">Log out</a></li>
		</ul>
	</div>
	<div id="main">  
		<div id='submenu'>
        <!-- submenu links here -->
		 <ul>
		  <li><a href='categories.php?f=add_category'>Add Category</a> </li>
          </ul>
          <!-- end submenu links -->
		</div>
        <div id="searchform"><form action="index.php" method="post">
        <input type="hidden" name="f" value="searchsite" /><input type="text" name="searchurl" size="25" /><input type="submit" value="Find site" /></form></div>
<!-- main bady functions here -->

<?php
if ($f=='add_category') {
	//create a new category
	     if ($af=='submitted') {
		//site submitted so add site
	global $mysql_table_prefix;
		$category_name = addslashes($category_name);
		$result = mysql_query("select category from ".$mysql_table_prefix."categories where category='$category_name'");
		echo mysql_error();
		$rows = mysql_numrows($result);
		if ($rows==0 ) {
			mysql_query("INSERT INTO ".$mysql_table_prefix."categories (category, parent_num) VALUES ('$category_name', '0')");
			echo mysql_error();
			$result = mysql_query("select category_id from ".$mysql_table_prefix."categories where category='$category_name'");
			echo mysql_error();
			$row = mysql_fetch_row($result);
			$category_id = $row[0];
		
			if (!mysql_error())	{
				$message =  "<br/><center><b>Category Created</b></center>" ;
			} else {
				$message = mysql_error();
			}

		} else {
			$message = "<center><b>Category already in database</b></center>";
		}
		
	}
	?>
	<div class="header">ADD Category form</div><br /><br />
    <?php echo "<span class='red'>$message</span><br /><br />"; ?>
	<div align=center><center><table>
		<form action="categories.php" method="post">
   		<input type="hidden" name='f' value='add_category'>
		<input type="hidden" name='af' value='submitted'>
		<tr><td><b>Category Name:</b></td><td align ="right"></td><td><input type="text" name="category_name" size="60" value=""></td></tr>	
		<tr><td></td><td></td><td><input type="submit" id="submit" value="Create Category"></td></tr></form></table></center></div>
<?php }

if ($f=='1') {
	//edit a category
	global $mysql_table_prefix;
		$result = mysql_query("select * from ".$mysql_table_prefix."categories WHERE category_id='$cat_id'");
		echo mysql_error();
		if (mysql_num_rows($result) < 1) {
	            //there are nor categories added yet
				$message = "<span class='red'><center><b>Invalid Category</b></center></span>";
				echo "$message";
		} else {
			if ($af=='update') {
		//site submitted so add site
	        global $mysql_table_prefix;
		
			mysql_query("UPDATE ".$mysql_table_prefix."categories SET category='$category_name' WHERE category_id='$cat_id'");
			echo mysql_error();
		
			if (!mysql_error())	{
				$message =  "<br/><center><b>Category Updated</b></center>" ;
			} else {
				$message = mysql_error();
			}

		} 
	    $result = mysql_query("select * from ".$mysql_table_prefix."categories WHERE category_id='$cat_id'");
		echo mysql_error();
		while ($row = mysql_fetch_array($result)) {
	         $category_id = $row['category_id'];
			 $category = $row['category'];
		}
	?>
	<div class="header">Edit Category form</div><br /><br />
    <?php echo "<span class='red'>$message</span><br /><br />"; ?>
	<div align=center><center><table>
		<form action="categories.php" method="post">
   		<input type="hidden" name='f' value='1' />
		<input type="hidden" name='af' value='update' />
        <input type="hidden" name="cat_id" value="<?php echo "$category_id"; ?>" />
		<tr><td><b>Category Name:</b></td><td align ="right"></td><td><input type="text" name="category_name" size="60" value="<?php echo "$category"; ?>"></td></tr>	
		<tr><td></td><td></td><td><input type="submit" id="submit" value="Update Category"></td></tr></form></table></center></div>
<?php }}

if ($f=='') {
	//no category function selected, show main page
	if ($af=='delete') {
		//site submitted so add site
	global $mysql_table_prefix;
		$result = mysql_query("DELETE FROM ".$mysql_table_prefix."categories where category_id='$cat_id'");
		echo mysql_error();	
			if (!mysql_error())	{
				$message =  "<br/><center><b>Category Deleted</b></center>" ;
			} else {
				$message = mysql_error();
			}
		
	}
global $mysql_table_prefix;
		$result = mysql_query("select * from ".$mysql_table_prefix."categories ORDER BY category ASC");
		echo mysql_error();
		if (mysql_num_rows($result) < 1) {
	            //there are nor categories added yet
				$message = "<span class='red'><center><b>No Categories Have been created</b></center></span>";
				echo "$message";
		} else {
			?><?php echo "<span class='red'>$message</span><br /><br />"; ?><br/><div align="center"><table cellspacing ="0" cellpadding="0" class="darkgrey"><tr><td align="left"><table cellpadding="3" cellspacing = "1"  width="500">
            <?php
		while ($row = mysql_fetch_array($result)) {
	         $category_id = $row['category_id'];
			 $category = $row['category'];
		?>
		
		<tr class="grey"><td align="left" width="400"><?php echo "$category"; ?> 
		 </td><td align="left"><a href="categories.php?f=1&amp;cat_id=<?php echo "$category_id"; ?>" id="small_button">Edit</a></td><td align="left"><a href="categories.php?af=delete&amp;cat_id=<?php echo "$category_id"; ?>" id="small_button">Delete</a></td></tr>
         <?php }?>
		</table></td></tr></table></div>
<?php }}?>

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