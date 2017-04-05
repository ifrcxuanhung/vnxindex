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
        
        <li><a href="categories.php" id="default">Categories</a></li>

		<li><a href="clean.php" id="selected">Clean tables</a></li>

		<li><a href="settings.php" id="default">Settings</a></li>

		<li><a href="statistics.php" id="default">Statistics</a></li>

		<li><a href="database.php" id="default">Database</a></li>

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



<?php

if ($f == 25) {



		global $mysql_table_prefix;

		$sql = "SELECT url FROM ".$mysql_table_prefix."removedurls";

		$results = mysql_query($sql);

		

		$del = 0;

		while ($info=mysql_fetch_array($results)) {

			$url=$info['url'];

		

		$query = "select link_id from ".$mysql_table_prefix."links where url='$url'";

		$result = mysql_query($query);

	if (mysql_numrows($result) > 0) { 

		echo mysql_error();

		$del++;

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

	    }

		

	}

		

		$message = "<span class='red'><center><b>URL'S removed, $del items deleted.</b></center></span>";

	    

	}

	

if ($f==26) {

	global $mysql_table_prefix;

	$query = "select link_id from ".$mysql_table_prefix."links where title='404 Not Found'";

		$result = mysql_query($query);

	$del = mysql_affected_rows();

	if (mysql_numrows($result) > 0) {

		

		echo mysql_error();

		while ($row=mysql_fetch_array($result)) {

			$todelete =$row['link_id'];

		mysql_query("delete from ".$mysql_table_prefix."links where link_id=$todelete");

		echo mysql_error();

		mysql_query("delete from ".$mysql_table_prefix."pending where site_id=$todelete");

		echo mysql_error();

		

	}

	}

	

	$message = "<span class='red'><center><b>404 URL'S removed, $del items deleted.</b></center></span>";

}



if ($f==17) {

	global $mysql_table_prefix;

		$result = mysql_query("delete from ".$mysql_table_prefix."temp where level >= 0");

		echo mysql_error();

		$del = mysql_affected_rows();

		

		$message = "<span class='red'><br/><center><b>Temp table cleared, $del items deleted.</b></center></span>";

	}

	

if ($f==23) {

	

	global $mysql_table_prefix;

		$result = mysql_query("delete from ".$mysql_table_prefix."query_log where time >= 0");

		echo mysql_error();

		$del = mysql_affected_rows();

		

		$message = "<span class='red'><br/><center><b>Search log cleared, $del items deleted.</b></center></span>";

	}

	

if ($f==27) {

	

	global $mysql_table_prefix;

		$result = mysql_query("delete from ".$mysql_table_prefix."query_log where query=''");

		echo mysql_error();

		$del = mysql_affected_rows();

		

		$message = "<span class='red'><br/><center><b>Search log cleared, $del items deleted.</b></center></span>";

	}	



if ($f==16) {

		global $mysql_table_prefix;

		$query = "select site_id from ".$mysql_table_prefix."sites";

		$result = mysql_query($query);

		echo mysql_error();

		$todelete = array();

		if (mysql_num_rows($result)>0) {

			while ($row=mysql_fetch_array($result)) {

				$todelete[]=$row['site_id'];

			}

			$todelete = implode(",", $todelete);

			$sql_end = " not in ($todelete)";

		}

		

		$result = mysql_query("select link_id from ".$mysql_table_prefix."links where site_id".$sql_end);

		echo mysql_error();

		$del = mysql_num_rows($result);

		while ($row=mysql_fetch_array($result)) {

			$link_id=$row[link_id];

			for ($i=0;$i<=15; $i++) {

				$char = dechex($i);

				mysql_query("delete from ".$mysql_table_prefix."link_keyword$char where link_id=$link_id");

				echo mysql_error();

			}

			mysql_query("delete from ".$mysql_table_prefix."links where link_id=$link_id");

			echo mysql_error();

		}



		$result = mysql_query("select link_id from ".$mysql_table_prefix."links where site_id is NULL");

		echo mysql_error();

		$del += mysql_num_rows($result);

		while ($row=mysql_fetch_array($result)) {

			$link_id=$row[link_id];

			for ($i=0;$i<=15; $i++) {

				$char = dechex($i);

				mysql_query("delete from ".$mysql_table_prefix."link_keyword$char where link_id=$link_id");

				echo mysql_error();

			}

			mysql_query("delete from ".$mysql_table_prefix."links where link_id=$link_id");

			echo mysql_error();

		}

		

		$message = "<span class='red'><br/><center><b>Links table cleaned, $del links deleted.</b></center></span>";

	}



if ($f==15) {

		global $mysql_table_prefix;

		$query = "select keyword_id, keyword from ".$mysql_table_prefix."keywords";

		$result = mysql_query($query);

		echo mysql_error();

		$del = 0;

		while ($row=mysql_fetch_array($result)) {

			$keyId=$row['keyword_id'];

			$keyword=$row['keyword'];

			$wordmd5 = substr(md5($keyword), 0, 1);

			$query = "select keyword_id from ".$mysql_table_prefix."link_keyword$wordmd5 where keyword_id = $keyId";

			$result2 = mysql_query($query);

			echo mysql_error();

			if (mysql_num_rows($result2) < 1) {

				mysql_query("delete from ".$mysql_table_prefix."keywords where keyword_id=$keyId");

				echo mysql_error();

				$del++;

			}

		}

		$message = "<span class='red'><br/><center><b>Keywords table cleaned, $del keywords deleted.</b></center></span>";

	}
if ($f == 28) {



		global $mysql_table_prefix;

		$sql = "SELECT url FROM ".$mysql_table_prefix."removedimgs";
		$result = mysql_query($sql);
		$del = 0; 
         while ($info=mysql_fetch_array($result)) {
              $url=$info['url'];
              $query = "delete from ".$mysql_table_prefix."imgs where imgUrl='$url'";
              mysql_query($query);
			  echo mysql_error();
			  $del++;

	    }		

		$message = "<span class='red'><center><b>IMG'S removed, $del items deleted.</b></center></span>";

	    

	}



global $mysql_table_prefix;

		$result = mysql_query("select count(*) from ".$mysql_table_prefix."query_log");

		echo mysql_error();

		if ($row=mysql_fetch_array($result)) {

			$log=$row[0];

		}

		$result = mysql_query("select count(*) from ".$mysql_table_prefix."temp");

		echo mysql_error();

		if ($row=mysql_fetch_array($result)) {

			$temp=$row[0];

		}



		echo "$message<br />";

		?>

		<br/><div align="center">

		<table cellspacing ="0" cellpadding="0" class="darkgrey"><tr><td align="left"><table cellpadding="3" cellspacing = "1"  width="100%"><tr class="grey"  ><td align="left"><a href="clean.php?f=15" id="small_button">Clean keywords</a> 

		 </td><td align="left"> Delete all keywords not associated with any link.</td></tr>

		<tr class="grey"  ><td align="left"><a href="clean.php?f=16" id="small_button">Clean links</a>

		</td><td align="left"> Delete all links not associated with any site.</td></tr>

		<tr class="grey"  ><td align="left"><a href="clean.php?f=17" id="small_button">Clear temp tables </a>

		</td><td align="left"> <?php print $temp;?> items in temporary table.</td></tr>

		<tr class="grey"  ><td align="left"><a href="clean.php?f=23" id="small_button">Clear search log </a> 

		</td><td align="left"><?php print $log;?> items in search log.

		</td></tr><tr class="grey"  ><td align="left"><a href="clean.php?f=25" id="small_button">Remove blocked urls</a> 

		</td><td align="left">Remove unwanted urls
        
        </td></tr><tr class="grey"  ><td align="left"><a href="clean.php?f=28" id="small_button">Remove blocked img's</a> 

		</td><td align="left">Remove unwanted img's

		</td></tr><tr class="grey"  ><td align="left"><a href="clean.php?f=26" id="small_button">Remove 404 urls</a> 

		</td><td align="left">Remove not found urls

		</td></tr><tr class="grey"  >
		<td align="left"><a href="clean.php?f=27" id="small_button">Clean empty searches</a> 

		</td><td align="left">Remove empty searchs in log

		</td></tr></table>		</td></tr></table></div>





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