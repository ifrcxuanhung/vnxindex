<?php 


error_reporting (E_ALL ^ E_NOTICE);

$include_dir = "../include";
include "auth.php";
include "$include_dir/commonfuncs.php";
extract (getHttpVars());
$settings_dir = "../settings";
include "$settings_dir/conf.php";
set_time_limit (0);

if ($syst==1) {
	unlink('install.php');
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
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Sphider Pro administrator tools</title>
<link rel="stylesheet" href="main.css" type="text/css" />
</head>
<body>
<div id="admin"> 
	<div id="tabs">
		<ul>
		<li><a href="index.php" id="selected">Sites</a></li> 
        <li><a href="categories.php" id="default">Categories</a></li>
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
		  <li><a href='index.php?f=add_site'>Add site</a> </li>
          <li><a href='spider.php?all=1' target='_blank'> Reindex all</a></li>
          <li><a href='randomindex.php' target='_blank'> Random Reindex</a></li>
          <li><a href='randomunindexed.php' target='_blank'>Random un-indexed</a></li>
          <li><a href='index.php?f=removeLink'> Remove Link</a></li>
          </ul>
          <!-- end submenu links -->
		</div>
        <div id="searchform"><form action="index.php" method="post">
        <input type="hidden" name="f" value="searchsite" /><input type="text" name="searchurl" size="25" /><input type="submit" value="Find site" /></form></div>
<!-- main bady functions here -->
<?php
if ($f=='5') {
	
	global $mysql_table_prefix;
		mysql_query("delete from ".$mysql_table_prefix."sites where site_id=$site_id");
		echo mysql_error();
		
		$query = "select link_id from ".$mysql_table_prefix."links where site_id=$site_id";
		$result = mysql_query($query);
		echo mysql_error();
		$todelete = array();
		while ($row=mysql_fetch_array($result)) {
			$todelete[]=$row['link_id'];
		}

		if (count($todelete)>0) {
			$todelete = implode(",", $todelete);
			for ($i=0;$i<=15; $i++) {
				$char = dechex($i);
				$query = "delete from ".$mysql_table_prefix."link_keyword$char where link_id in($todelete)";
				mysql_query($query);
				echo mysql_error();
			}
		}

		mysql_query("delete from ".$mysql_table_prefix."links where site_id=$site_id");
		echo mysql_error();
		mysql_query("delete from ".$mysql_table_prefix."pending where site_id=$site_id");
		echo mysql_error();
	    echo "<center><span class='red'>Site deleted</span></center><br /><br />";
	}

if ($f=='') {
	//show home page content
	$get_sql = "SELECT * FROM sites";
        $t = mysql_query($get_sql);
   
        $a                = mysql_fetch_object($t); 
        $total_items      = mysql_num_rows($t); 
        $limit            = $_GET['limit']; 
        $type             = $_GET['type']; 
        $page             = $_GET['page']; 

       //set default if: $limit is empty, non numerical, less than 10, greater than 50 
       if((!$limit)  || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50)) { 
       $limit = 20; //default 
     } 
      //set default if: $page is empty, non numerical, less than zero, greater than total available 
      if((!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $total_items)) { 
      $page = 1; //default 
   } 

        //calcuate total pages 
        $total_pages     = ceil($total_items / $limit); 
        $set_limit          = $page * $limit - ($limit); 
		
		global $mysql_table_prefix;
		$result = mysql_query("SELECT site_id, url, title, indexdate from ".$mysql_table_prefix."sites ORDER By indexdate, title LIMIT $set_limit, $limit");
		echo mysql_error();
		print $message;
		print "<br/>";
		
		if (mysql_num_rows($result) > 0) {
			print "<div align=\"center\"><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td><table cellpadding=\"3\" cellspacing=\"1\">
			<tr class=\"grey\"><td align=\"center\"><b>Site name</b></td><td align=\"center\"><b>Site url</b></td><td align=\"center\"><b>Last indexed</b></td><td align=\"center\"><b>Category</b></td><td colspan=4></td></tr>\n";
		} else {
			?><center>
  <p><b>Welcom to Sphider Pro Admin. <br><br>Choose "Add site" from the submenu to add a new site, or "Index" to directly go to the indexing section.</b></p></center><?php 
		}
		$class = "grey";
		while ($row=mysql_fetch_array($result))	{
			if ($row['indexdate']=='') {
				$indexstatus="<font color=\"red\">Not indexed</font>";
				$indexoption="<a href=\"index.php?f=index&url=$row[url]\">Index</a>";
			} else {
				$site_id = $row['site_id'];
				$result2 = mysql_query("SELECT site_id from ".$mysql_table_prefix."pending where site_id =$site_id");
				echo mysql_error();			
				$row2=mysql_fetch_array($result2);
				if ($row2['site_id'] == $row['site_id']) {
					$indexstatus = "Unfinished";
					$indexoption="<a href=\"index.php?f=index&url=$row[url]\">Continue</a>";

				} else {
					$indexstatus = $row['indexdate'];
					$indexoption="<a href=\"index.php?f=index&url=$row[url]&reindex=1\">Re-index</a>";
				}
			}
			
			if ($class =="white") 
				$class = "grey";
			else 
				$class = "white";
			//gather category names for site_id
			$site_id = $row['site_id'];
			    global $mysql_table_prefix;
		       $cat_result = mysql_query("SELECT site_id, category_id from ".$mysql_table_prefix."site_category WHERE site_id='$site_id'");
		    echo mysql_error();
			if (mysql_num_rows($cat_result) > 0) {
			while ($cat_row=mysql_fetch_array($cat_result))	{
				$category_id = $cat_row['category_id'];
			}}
			$result_category_name = mysql_query("SELECT category from ".$mysql_table_prefix."categories WHERE category_id='$category_id'");
		    echo mysql_error();
			if (mysql_num_rows($result_category_name) > 0) {
			while ($cat_info=mysql_fetch_array($result_category_name))	{
				$category_name = $cat_info['category'];
			}}	
			print "<tr class=\"$class\"><td align=\"left\">".stripslashes($row[title])."</td><td align=\"left\"><a href=\"$row[url]\" target=\"_blank\">$row[url]</a></td><td>$indexstatus</td><td>$category_name</td>";
			print "<td><a href=index.php?f=20&site_id=$row[site_id] id=\"small_button\">Options</a></td></tr>\n";

		}
		if (mysql_num_rows($result) > 0) {
			
			print "</table></td></tr></table></div>";
			
			echo "<div align='center'><br /><br />";
	//prev. page: 

$prev_page = $page - 1; 

if($prev_page >= 1) { 
  echo("&lt; &lt; <a href=index.php?limit=$limit&amp;page=$prev_page><b>Prev</b></a> "); 
} 

if ($page - 3 < 1) {

$pagemin = 1;

} else {

$pagemin = $page - 3;

};

if ($page + 3 > $total_pages) {

$pagemax = $total_pages;

} else {

$pagemax = $page + 3;

};

for($a = $pagemin; $a <= $pagemax; $a++) 
{ 
   if($a == $page) { 
      echo("<b> $a</b> | "); //no link 
     } else { 
  echo("  <a href=index.php?limit=$limit&amp;page=$a> $a </a> | "); 
     } 
} 

//next page: 

$next_page = $page + 1; 
if($next_page <= $total_pages) { 
   echo("<a href=index.php?limit=$limit&amp;page=$next_page><b>Next</b></a> &gt; &gt;"); 
} 
echo "</div>";
		}
	
	
} 



if ($f==searchsite) {
	//show search results function
	global $mysql_table_prefix;
		$result = mysql_query("SELECT site_id, url, title, indexdate from ".$mysql_table_prefix."sites WHERE url like '%$searchurl%'");
		echo mysql_error();
		if (mysql_num_rows($result) > 0) {
			print "<div align=\"center\"><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td><table cellpadding=\"3\" cellspacing=\"1\">
			<tr class=\"grey\"><td align=\"center\"><b>Site name</b></td><td align=\"center\"><b>Site url</b></td><td align=\"center\"><b>Last indexed</b></td><td colspan=4></td></tr>\n";
		} else {
			?><center><p>No site found</p></center><?php 
		}
		$class = "grey";
		while ($row=mysql_fetch_array($result))	{
			if ($row['indexdate']=='') {
				$indexstatus="<font color=\"red\">Not indexed</font>";
				$indexoption="<a href=\"index.php?f=index&url=$row[url]\">Index</a>";
			} else {
				$site_id = $row['site_id'];
				$result2 = mysql_query("SELECT site_id from ".$mysql_table_prefix."pending where site_id =$site_id");
				echo mysql_error();			
				$row2=mysql_fetch_array($result2);
				if ($row2['site_id'] == $row['site_id']) {
					$indexstatus = "Unfinished";
					$indexoption="<a href=\"index.php?f=index&url=$row[url]\">Continue</a>";

				} else {
					$indexstatus = $row['indexdate'];
					$indexoption="<a href=\"index.php?f=index&url=$row[url]&reindex=1\">Re-index</a>";
				}
			}
			if ($class =="white") 
				$class = "grey";
			else 
				$class = "white";
			print "<tr class=\"$class\"><td align=\"left\">".stripslashes($row[title])."</td><td align=\"left\"><a href=\"$row[url]\" target=\"_blank\">$row[url]</a></td><td>$indexstatus</td>";
			print "<td><a href=index.php?f=20&site_id=$row[site_id] id=\"small_button\">Options</a></td></tr>\n";

		}
		if (mysql_num_rows($result) > 0) {
			
			print "</table></td></tr></table></div>";
		}
			

  } 

//show add site function
if ($f=='add_site') {
	if ($af=='submitted') {
		//site submitted so add site
	global $mysql_table_prefix;
		$short_desc = addslashes($short_desc);
		$title = addslashes($title);
		$compurl=parse_url("".$url);
		if ($compurl['path']=='')
			$url=$url."/";
		$result = mysql_query("select site_ID from ".$mysql_table_prefix."sites where url='$url'");
		echo mysql_error();
		$rows = mysql_numrows($result);
		if ($rows==0 ) {
			mysql_query("INSERT INTO ".$mysql_table_prefix."sites (url, title, short_desc) VALUES ('$url', '$title', '$short_desc')");
			echo mysql_error();
			$result = mysql_query("select site_ID from ".$mysql_table_prefix."sites where url='$url'");
			echo mysql_error();
			$row = mysql_fetch_row($result);
			$site_id = $row[0];
			if ($category_id!='') {
			mysql_query("INSERT INTO ".$mysql_table_prefix."site_category (site_id, category_id) VALUES ('$site_id', '$category_id')");
			echo mysql_error();
			}
			
		
			If (!mysql_error())	{
				$message =  "<br/><center><b>Site added</b></center>" ;
			} else {
				$message = mysql_error();
			}

		} else {
			$message = "<center><b>Site already in database</b></center>";
		}
		
	}

	?>
	<div class="header">ADD Site form</div><br /><br />
    <?php echo "<span class='red'>$message</span><br /><br />"; ?>
	<div align=center><center><table>
		<form action=index.php method=post>
   		<input type=hidden name='f' value='add_site'>
		<input type=hidden name='af' value='submitted'>
		<tr><td><b>URL:</b></td><td align ="right"></td><td><input type=text name=url size=60 value ="http://"></td></tr>
		<tr><td><b>Title:</b></td><td></td><td> <input type=text name=title size=60></td></tr>
		<tr><td><b>Short description:</b></td><td></td><td><textarea name=short_desc cols=45 rows=3 wrap="virtual"></textarea></td></tr>
        <?php
		if ($show_categories!=0) {
                 $sql = "SELECT * FROM categories ORDER BY category ASC";
                 $sql_result = mysql_query($sql);
                      if (mysql_num_rows($sql_result) < 1) {
	                        //there are no categories
                      } else {	
	                       echo "<tr><td><b>Select Category:</b></td><td></td><td><select name='category_id'><option value=''>No Category</option>";
	                         while ($info = mysql_fetch_array($sql_result)) {
	                              $category_id = $info['category_id'];
			                      $category = $info['category'];
		                       echo "<option value='$category_id'>$category</option>";
							   }
			             echo "</select></td></tr>";
					  }}
		?>
	
		<tr><td></td><td></td><td><input type=submit id="submit" value=Add></td></tr></form></table></center></div>
<?php }


if ($f==20) {
	global $mysql_table_prefix;
		$result = mysql_query("SELECT site_id, url, title, short_desc, indexdate from ".$mysql_table_prefix."sites where site_id=$site_id");
		echo mysql_error();
		$row=mysql_fetch_array($result);
		$url = replace_ampersand($row[url]);
		if ($row['indexdate']=='') {
			$indexstatus="<font color=\"red\">Not indexed</font>";
			$indexoption="<a href=\"index.php?f=index&url=$url\">Index</a>";
		} else {
			$site_id = $row['site_id'];
			$result2 = mysql_query("SELECT site_id from ".$mysql_table_prefix."pending where site_id =$site_id");
			echo mysql_error();			
			$row2=mysql_fetch_array($result2);
			if ($row2['site_id'] == $row['site_id']) {
				$indexstatus = "Unfinished";
				$indexoption="<a href=\"index.php?f=index&url=$url\">Continue indexing</a>";

			} else {
				$indexstatus = $row['indexdate'];
				$indexoption="<a href=\"index.php?f=index&url=$url&reindex=1\">Re-index</a>";
			}
		}
		if ($show_categories!=0) {
		//gather category names for site_id
			    global $mysql_table_prefix;
		       $cat_result = mysql_query("SELECT site_id, category_id from ".$mysql_table_prefix."site_category WHERE site_id='$site_id'");
		    echo mysql_error();
			if (mysql_num_rows($cat_result) > 0) {
			while ($cat_row=mysql_fetch_array($cat_result))	{
				$category_id = $cat_row['category_id'];
			}}
			$result_category_name = mysql_query("SELECT category from ".$mysql_table_prefix."categories WHERE category_id='$category_id'");
		    echo mysql_error();
			if (mysql_num_rows($result_category_name) > 0) {
			while ($cat_info=mysql_fetch_array($result_category_name))	{
				$category_name = $cat_info['category'];
			}}}
		?>
		<?php print $message;?>
			<br/>

		<center>
		<div style="width:775px;">
		<div style="float:left; margin-right:0px;">
		<div class="darkgrey">
		<table cellpadding="3" cellspacing="0">

			<table  cellpadding="5" cellspacing="1" width="620">
			  <tr >
				<td class="grey" valign="top" width="20%" align="left">URL:</td>
				<td class="white" align="left"><a href="<?php print  $row['url']; print "\">"; print $row['url'];?></a></td>
			  </tr>
			<tr>
				<td class="grey" valign="top" align="left">Title:</td>
				<td class="white" align="left"><b><?php print stripslashes($row['title']);?></b></td>
			</tr>
			  <tr>
				<td class="grey" valign="top" align="left">Description:</td>
				<td width="80%" class="white"  align="left"><?php print stripslashes($row['short_desc']);?></td>
			  </tr>
			  <tr>
				<td class="grey" valign="top" align="left">Last indexed:</td>
				<td class="white"  align="left"><?php print $indexstatus;?></td>
			  </tr>
              <?php if ($show_categories!=0) {?>
              <tr>
				<td class="grey" valign="top" align="left">Category:</td>
				<td class="white" align="left"><?php print $category_name;?></td>
			  </tr>
              <?php }?>
			</table>
		</div>
		</div>
		<div id= "vertmenu">
		<ul>
		 <li><a href=index.php?f=edit_site&site_id=<?php print  $row['site_id']?>>Edit</a></li>
		<li><?php print $indexoption?></li>
		<li><a href=index.php?f=browsePages&site_id=<?php print  $row['site_id']?>>Browse pages</a></li>
		<li><a href=index.php?f=5&site_id=<?php print  $row['site_id'];?> onclick="return confirm('Are you sure you want to delete? Index will be lost.')">Delete</a></li>
		<li><a href=index.php?f=sitestats&site_id=<?php print  $row['site_id'];?>>Stats</a></li>
        <li><a href=index.php?f=deletereindex&site_id=<?php print  $row['site_id'];?>>Delete &amp; re-index</a></li>
		</div>
		</ul>
		</div>
		</center>
		<div class="clear">
		</div>
		<br/>
	<?php 
	}
	
if ($f==index) {
	global $mysql_table_prefix;
		$check = "";
		$levelchecked = "checked";
		$spider_depth = 2;
		if ($url=="") {
			$url = "http://";
			$advurl = "";
		} else {
			$advurl = $url;
			$result = mysql_query("select spider_depth, required, disallowed, can_leave_domain from ".$mysql_table_prefix."sites " .
					"where url='$url'");
			echo mysql_error();
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_row($result);
				$spider_depth = $row[0];
				if ($spider_depth == -1 ) {
					$fullchecked = "checked";
					$spider_depth ="";
					$levelchecked = "";
				}
				$must = $row[1];
				$mustnot = $row[2];
				$canleave = $row[3];
			}			
		}

		?>
		<br/>
		<div id="indexoptions"><table>
		<form action="spider.php" method="post">
		<tr><td><b>Address:</b></td><td> <input type="text" name="url" size="48" value=<?php print "\"$url\"";?>></td></tr>
		<tr><td><b>Indexing options:</b></td><td>
		<input type="radio" name="soption" value="full" <?php print $fullchecked;?>> Full<br/>
		<input type="radio" name="soption" value="level" <?php print $levelchecked;?>>To depth: <input type="text" name="maxlevel" size="2" value="<?php print $spider_depth;?>"><br/>
		<?php if ($reindex==1) $check="checked"?>
		<input type="checkbox" name="reindex" value="1" <?php print $check;?>> Reindex<br/>
		</td></tr>
			<?php if ($canleave==1) {$checkcan="checked" ;} ?>
			<tr><td></td><td><input type="checkbox" name="domaincb" value="1" <?php print $checkcan;?>> Spider can leave domain <!--a href="javascript:;" onClick="window.open('hmm','newWindow','width=300,height=300,left=600,top=200,resizable');" >?</a--><br/></td></tr>
			<tr><td><b>URL must include:</b></td><td><textarea name=in cols=35 rows=2 wrap="virtual"><?php print $must;?></textarea></td></tr>
			<tr><td><b>URL must not include:</b></td><td><textarea name=out cols=35 rows=2 wrap="virtual"><?php print $mustnot;?></textarea></td></tr>
		

		<tr><td></td><td><input type="submit" id="submit" value="Start indexing"></td></tr>
		</form></table></div>
		<?php 
	}
	
if ($f==edit_site) {
	if ($af==submitted) {
		
	global $mysql_table_prefix;
			$short_desc = addslashes($short_desc);
			$title = addslashes($title);
			$compurl=parse_url($url);
			if ($compurl['path']=='')
				$url=$url."/";
			mysql_query("UPDATE ".$mysql_table_prefix."sites SET url='$url', title='$title', short_desc='$short_desc', spider_depth ='$depth', required='$required', disallowed='$disallowed', can_leave_domain='$domaincb', indexTime='$cron' WHERE site_id='$site_id'");
			echo mysql_error();
			if ($category_id!='') {
			mysql_query("UPDATE ".$mysql_table_prefix."site_category SET category_id='$category_id' WHERE site_id='$site_id'");
			echo mysql_error();
			}
			If (!mysql_error()) {
				$message = "<span class='red'><center><b>Site updated.</b></center></span>" ;
			} else {
				return mysql_error();
			}
		}
	global $mysql_table_prefix;
		$result = mysql_query("SELECT site_id, url, title, short_desc, spider_depth, required, disallowed, can_leave_domain, indexTime from ".$mysql_table_prefix."sites where site_id=$site_id");
		echo mysql_error();
		$row = mysql_fetch_array($result);
		$depth = $row['spider_depth'];
		$fullchecked = "";
		$depthchecked = "";		
		if ($depth == -1 ) {
			$fullchecked = "checked";
			$depth ="";
		} else {
			$depthchecked = "checked";
		}
		$leave_domain = $row['can_leave_domain'];
		if ($leave_domain == 1 ) {
			$domainchecked = "checked";
		} else {
			$domainchecked = "";
		}		
		?>
					<div class="header">Edit site</div>
                    <?php echo "<br />$message<br />"; ?>
			<br/><div align=center><center><table>
			<form action='index.php' method='post'>
			<input type=hidden name='f' value='edit_site' />
            <input type=hidden name='af' value='submitted' />
			<input type=hidden name='site_id' value=<?php print $site_id;?>>
			<tr><td><b>URL:</b></td><td align ="right"></td><td><input type=text name=url value=<?php print "\"".$row['url']."\""?> size=60></td></tr>
			<tr><td><b>Title:</b></td><td></td><td> <input type=text name=title value=<?php print  "\"".stripslashes($row['title'])."\""?> size=60></td></tr>
			<tr><td><b>Short description:</b></td><td></td><td><textarea name=short_desc cols=45 rows=3 wrap><?php print stripslashes($row['short_desc'])?></textarea></td></tr>
			<tr><td><b>Spidering options:</b></td><td></td><td><input type="radio" name="soption" value="full" <?php print $fullchecked;?>> Full<br/>
			<input type="radio" name="soption" value="level" <?php print $depthchecked;?>>To depth: <input type="text" name="depth" size="2" value="<?php print $depth;?>"><br/>
			<input type="checkbox" name="domaincb" value="1" <?php print $domainchecked;?>> Spider can leave domain
			</td></tr>			
			<tr><td><b>URLs must include:</b></td><td></td><td><textarea name=required cols=45 rows=2 wrap="virtual"><?php print $row['required'];?></textarea></td></tr>
			<tr><td><b>URLs must not include:</b></td><td></td><td><textarea name=disallowed cols=45 rows=2 wrap="virtual"><?php print $row['disallowed'];?></textarea></td></tr>
            </tr>			
			<tr><td><b>Cron Indexing:</b></td><td></td><td><input type="text" name="cron" size="1" value="<?php print $row['indexTime'];?>" /> 1 default to allow cron indexing, 0 none cron indexing</td></tr>
			<?php if ($show_categories!=0) {
				global $mysql_table_prefix;
		       $cat_result = mysql_query("SELECT site_id, category_id from ".$mysql_table_prefix."site_category WHERE site_id='$site_id'");
		    echo mysql_error();
			if (mysql_num_rows($cat_result) > 0) {
			while ($cat_row=mysql_fetch_array($cat_result))	{
				$category_id = $cat_row['category_id'];
			}}
			$result_category_name = mysql_query("SELECT category from ".$mysql_table_prefix."categories WHERE category_id='$category_id'");
		    echo mysql_error();
			if (mysql_num_rows($result_category_name) > 0) {
			while ($cat_info=mysql_fetch_array($result_category_name))	{
				$category_name = $cat_info['category'];
			}}
                 $sql = "SELECT * FROM categories ORDER BY category ASC";
                 $sql_result = mysql_query($sql);
                      if (mysql_num_rows($sql_result) < 1) {
	                        //there are no categories
                      } else {	
	                       echo "<tr><td><b>Category:</b></td><td></td><td>$category_name - <select name='category_id'><option value=''>Change Category</option>";
	                         while ($info = mysql_fetch_array($sql_result)) {
	                              $category_id = $info['category_id'];
			                      $category = $info['category'];
		                       echo "<option value='$category_id'>$category</option>";
							   }
			             echo "</select></td></tr>";
					  }}?>
			<tr><td></td><td></td><td><input type="submit"  id="submit"  value="Update"></td></tr></form></table></center></div>
		<?php 
		}
		
if ($f==browsePages) {
	if ($sf==22) {
	global $mysql_table_prefix;
		mysql_query("delete from ".$mysql_table_prefix."links where link_id=$link_id");
		echo mysql_error();
		for ($i=0;$i<=15; $i++) {
			$char = dechex($i);
			mysql_query("delete from ".$mysql_table_prefix."link_keyword$char where link_id=$link_id");
		}
		echo mysql_error();
		$message = "<span class='red'><br/><center><b>Page deleted</b></center></span>";
	}
	
	if (!isset($start))
				$start = 1;
			if (!isset($filter))
				$filter = "";
			if (!isset($per_page))
				$per_page = 10;
global $mysql_table_prefix;
		$result = mysql_query("select url from ".$mysql_table_prefix."sites where site_id=$site_id");
		echo mysql_error();
		$row = mysql_fetch_row($result);
		$url = $row[0];
		
		$query_add = "";
		if ($filter != "") {
			$query_add = "and url like '%$filter%'";
		}
		$linksQuery = "select count(*) from ".$mysql_table_prefix."links where site_id = $site_id $query_add";
		$result = mysql_query($linksQuery);
		echo mysql_error();
		$row = mysql_fetch_row($result);
		$numOfPages = $row[0]; 

		$result = mysql_query($linksQuery);
		echo mysql_error();
		$from = ($start-1) * 10;
		$to = min(($start)*10, $numOfPages);

		
		$linksQuery = "select link_id, url from ".$mysql_table_prefix."links where site_id = $site_id and url like '%$filter%' order by url limit $from, $per_page";
		$result = mysql_query($linksQuery);
		echo mysql_error();
		echo "$message";
		?>
		<br/>
		<center>
		<b>Pages of site <a href="index.php?f=20&site_id=<?php  print $site_id?>"><?php print $url;?></a></b><br/>
		<p>
		<form action="index.php" method="post">
		Urls per page: <input type="text" name="per_page" size="3" value="<?php print $per_page;?>"> 
		Url contains: <input type="text" name="filter" size="15" value="<?php print $filter;?>"> 
		<input type="submit" id="submit" value="Filter">
		<input type="hidden" name="start" value="1">
		<input type="hidden" name="site_id" value="<?php print $site_id?>">
		<input type="hidden" name="f" value="browsePages">
		</form>
		</p>
	<table width="600"><tr><td>
		<table cellspacing ="0" cellpadding="0" class="darkgrey" width ="100%"><tr><td>
		<table  cellpadding="3" cellspacing="1" width="100%">

		<?php 
		$class = "white";
		while ($row = mysql_fetch_array($result)) {
			if ($class =="white") 
				$class = "grey";
			else 
				$class = "white";
			print "<tr class=\"$class\"><td><a href=\"".$row['url']."\" target=\"_blank\">".$row['url']."</a></td><td width=\"8%\"> <a href=\"index.php?f=browsePages&link_id=".$row['link_id']."&sf=22&site_id=$site_id&start=1&filter=$filter&per_page=$per_page\">Delete</a></td></tr>";
		}

		print "</table></td></tr></table>";

		$pages = ceil($numOfPages / $per_page);
		$prev = $start - 1;
		$next = $start + 1;

		if ($pages > 0)
			print "<center>Pages: ";

		$links_to_next =10;
		$firstpage = $start - $links_to_next;
		if ($firstpage < 1) $firstpage = 1;
		$lastpage = $start + $links_to_next;
		if ($lastpage > $pages) $lastpage = $pages;
		
		for ($x=$firstpage; $x<=$lastpage; $x++)
			if ($x<>$start)	{
				print "<a href=index.php?f=browsePages&site_id=$site_id&start=$x&filter=$filter&per_page=$per_page>$x</a> ";
			} 	else
				print "<b>$x </b>";
		print"</td></tr></table></center>";

	}	
	
if ($f==sitestats) {
	global $mysql_table_prefix;
		$result = mysql_query("select url from ".$mysql_table_prefix."sites where site_id=$site_id");
		echo mysql_error();
		if ($row=mysql_fetch_array($result)) {
			$url=$row[0];

			$lastIndexQuery = "SELECT indexdate from ".$mysql_table_prefix."sites where site_id = $site_id";
			$sumSizeQuery = "select sum(length(fulltxt)) from ".$mysql_table_prefix."links where site_id = $site_id";
			$siteSizeQuery = "select sum(size) from ".$mysql_table_prefix."links where site_id = $site_id";
			$linksQuery = "select count(*) from ".$mysql_table_prefix."links where site_id = $site_id";

			$result = mysql_query($lastIndexQuery);
			echo mysql_error();
			if ($row=mysql_fetch_array($result)) {
				$stats['lastIndex']=$row[0];
			}

			$result = mysql_query($sumSizeQuery);
			echo mysql_error();
			if ($row=mysql_fetch_array($result)) {
				$stats['sumSize']=$row[0];
			}
			$result = mysql_query($linksQuery);
			echo mysql_error();
			if ($row=mysql_fetch_array($result)) {
				$stats['links']=$row[0];
			}

			for ($i=0;$i<=15; $i++) {
				$char = dechex($i);
				$result = mysql_query("select count(*) from ".$mysql_table_prefix."links, ".$mysql_table_prefix."link_keyword$char where ".$mysql_table_prefix."links.link_id=".$mysql_table_prefix."link_keyword$char.link_id and ".$mysql_table_prefix."links.site_id = $site_id");
				echo mysql_error();
				if ($row=mysql_fetch_array($result)) {
					$stats['index']+=$row[0];
				}
			}
			for ($i=0;$i<=15; $i++) {
				$char = dechex($i);
				$wordQuery = "select count(distinct keyword) from ".$mysql_table_prefix."keywords, ".$mysql_table_prefix."links, ".$mysql_table_prefix."link_keyword$char where ".$mysql_table_prefix."links.link_id=".$mysql_table_prefix."link_keyword$char.link_id and ".$mysql_table_prefix."links.site_id = $site_id and ".$mysql_table_prefix."keywords.keyword_id = ".$mysql_table_prefix."link_keyword$char.keyword_id";
				$result = mysql_query($wordQuery);
				echo mysql_error();
				if ($row=mysql_fetch_array($result)) {
					$stats['words']+=$row[0];
				}
			}
			
			$result = mysql_query($siteSizeQuery);
			echo mysql_error();
			if ($row=mysql_fetch_array($result)) {
				$stats['siteSize']=$row[0];
			}
			if ($stats['siteSize']=="")
				$stats['siteSize'] = 0;
			$stats['siteSize'] = number_format($stats['siteSize'], 2);
			print"<div class=\"header\">Site Stats</div>";
			print "<br/><div align=\"center\"><center><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td><table cellpadding=\"3\" cellspacing = \"1\"><tr  class=\"grey\"><td colspan=\"2\">";
			print "Statistics for site <a href=\"index.php?f=20&site_id=$site_id\">$url</a>";
			print "<tr class=\"white\"><td>Last indexed:</td><td align=\"center\"> ".$stats['lastIndex']."</td></tr>";
			print "<tr class=\"grey\"><td>Pages indexed:</td><td align=\"center\"> ".$stats['links']."</td></tr>";
			print "<tr class=\"white\"><td>Total index size:</td><td align=\"center\"> ".$stats['index']."</td></tr>";
			$sum = number_format($stats['sumSize']/1024, 2);
			print "<tr class=\"grey\"><td>Cached texts:</td><td align=\"center\"> ".$sum."kb</td></tr>";
			print "<tr class=\"white\"><td>Total number of keywords:</td><td align=\"center\"> ".$stats['words']."</td></tr>";
			print "<tr class=\"grey\"><td>Site size:</td><td align=\"center\"> ".$stats['siteSize']."kb</td></tr>";
			print "</table></td></tr></table></center></div>";
		}
	}

if ($f == deletereindex) {
	  
	  ?><div class="header">Delete &amp; Re-index site</div><?php
	  
	  //gather all old details from table
	  global $mysql_table_prefix;
		$result = mysql_query("SELECT site_id, url, title, short_desc, spider_depth, required, disallowed, can_leave_domain from ".$mysql_table_prefix."sites where site_id=$site_id");
		echo mysql_error();
		$row = mysql_fetch_array($result);
		$depth = $row['spider_depth'];
		$result2 = mysql_query("SELECT category_id from ".$mysql_table_prefix."site_category where site_id=$site_id");
		echo mysql_error();
		$row2 = mysql_fetch_array($result2);
	  
	  //store old details in session
	  $_SESSION['SESS_SITE_ID'] = $row['site_id'];
	  $_SESSION['SESS_SITE_URL'] = $row['url'];
	  $_SESSION['SESS_SITE_TITLE'] = $row['title'];
	  $_SESSION['SESS_SITE_SHORT_DESC'] = $row['short_desc'];
	  $_SESSION['SESS_SITE_SPIDER_DEPTH'] = $row['spider_depth'];
	  $_SESSION['SESS_SITE_REQUIRED'] = $row['required'];
	  $_SESSION['SESS_SITE_DISALLOWED'] = $row['disallowed'];
	  $_SESSION['SESS_SITE_CL'] = $row['can_leave_domain'];
	  $_SESSION['SESS_SITE_CATEGORY_ID'] = $row2['category_id'];
	  
	  $new_site_id = $_SESSION['SESS_SITE_ID'];
	  $new_site_url = $_SESSION['SESS_SITE_URL'];
	  $new_site_title = $_SESSION['SESS_SITE_TITLE'];
	  $new_site_short_desc = $_SESSION['SESS_SITE_SHORT_DESC'];
	  $new_site_spider_depth = $_SESSION['SESS_SITE_SPIDER_DEPTH'];
	  $new_site_required = $_SESSION['SESS_SITE_REQUIRED'];
	  $new_site_disallowed = $_SESSION['SESS_SITE_DISALLOWED'];
	  $new_site_can_leave_domain = $_SESSION['SESS_SITE_CL'];
	  $new_category_id = $_SESSION['SESS_SITE_CATEGORY_ID'];
	  
	  //delete old site
		global $mysql_table_prefix;
		mysql_query("delete from ".$mysql_table_prefix."sites where site_id=$site_id");
		echo mysql_error();
		mysql_query("delete from ".$mysql_table_prefix."site_category where site_id=$site_id");
		echo mysql_error();
		$query = "select link_id from ".$mysql_table_prefix."links where site_id=$site_id";
		$result = mysql_query($query);
		echo mysql_error();
		$todelete = array();
		while ($row=mysql_fetch_array($result)) {
			$todelete[]=$row['link_id'];
		}

		if (count($todelete)>0) {
			$todelete = implode(",", $todelete);
			for ($i=0;$i<=15; $i++) {
				$char = dechex($i);
				$query = "delete from ".$mysql_table_prefix."link_keyword$char where link_id in($todelete)";
				mysql_query($query);
				echo mysql_error();
			}
		}

		mysql_query("delete from ".$mysql_table_prefix."links where site_id=$site_id");
		echo mysql_error();
		mysql_query("delete from ".$mysql_table_prefix."pending where site_id=$site_id");
		echo mysql_error();

	  //re add old site
	  mysql_query("INSERT INTO ".$mysql_table_prefix."sites (site_id, url, title, short_desc, spider_depth, required, disallowed, can_leave_domain) VALUES ('$new_site_id', '$new_site_url', '$new_site_title', '$new_site_short_desc', '$new_site_spider_depth', '$new_site_required', '$new_site_disallowed', '$new_site_can_leave_domain')");
			echo mysql_error();
			$result = mysql_query("select site_id from ".$mysql_table_prefix."sites where url='$url'");
			echo mysql_error();
			$row = mysql_fetch_row($result);
			$site_id = $row[0];
			mysql_query("INSERT INTO ".$mysql_table_prefix."site_category (site_id, category_id) VALUES ('$new_site_id', '$new_category_id')");
			echo mysql_error();
	  
	  //unset sessions
	  unset($_SESSION['SESS_SITE_ID']);
	  unset($_SESSION['SESS_SITE_URL']);
	  unset($_SESSION['SESS_SITE_TITLE']);
	  unset($_SESSION['SESS_SITE_SHORT_DESC']);
	  unset($_SESSION['SESS_SITE_SPIDER_DEPTH']);
	  unset($_SESSION['SESS_SITE_REQUIRED']);
	  unset($_SESSION['SESS_SITE_DISALLOWED']);
	  unset($_SESSION['SESS_SITE_CL']);
	  unset($_SESSION['SESS_SITE_CATEGORY_ID']);
	  
	  
	  //show index form
	  
	  echo "<br /><br /><br /><br /><center>Site ready for indexing. <a href=index.php?f=index&url=$new_site_url>Continue</a> $site_id";
	  
  }
  
 if ($f == removeLink) {
		?>
		
        <div class="header">Remove a Link</div>
        <br />
		<?php
		if ($url !='') { 
         $sql = "INSERT INTO ".$mysql_table_prefix."removedurls (url) VALUES ('$url')";
        $result = mysql_query($sql);
        $query = "select link_id from ".$mysql_table_prefix."links where url='$url'";
		$result = mysql_query($query);
	if (mysql_numrows($result) > 0) { 
		echo mysql_error();
		$todelete = array();
		while ($row=mysql_fetch_array($result)) {
			$todelete[]=$row['link_id'];
		}
		

		if (count($todelete)>0) {
			$todelete = implode(",", $todelete);
			for ($i=0;$i<=15; $i++) {
				$char = dechex($i);
				$query = "delete from ".$mysql_table_prefix."link_keyword$char where link_id in($todelete)";
				mysql_query($query);
				echo mysql_error();
			}
		}

		mysql_query("delete from ".$mysql_table_prefix."links where link_id=$todelete");
		echo mysql_error();
		mysql_query("delete from ".$mysql_table_prefix."pending where site_id=$todelete");
		echo mysql_error();
		
		
		
		?>
		<div align=center>
        <b>Link Removed</b><br /><br />
    <form action="index.php" method="post">
    URL <input type="text" name="url" size="30" /><input type="hidden" name="f" value="removeLink" /><input type="submit" value="remove link" />
    </form>
    </div>
    <?php
	} else {
		?>
        <div align=center>
        <b>No Such Link</b><br /><br />
    <form action="index.php" method="post">
    URL <input type="text" name="url" size="30" /><input type="hidden" name="f" value="removeLink" /><input type="submit" value="remove link" />
    </form>
    </div>

<?php
	}
	
}  else {
	?>
    <div align=center>
    <form action="index.php" method="post">
    URL <input type="text" name="url" size="30" /><input type="hidden" name="f" value="removeLink" /><input type="submit" value="remove link" />
    </form>
    </div>
    <?php
	
}
	    
	} 
	
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