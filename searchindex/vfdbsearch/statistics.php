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

		<li><a href="clean.php" id="default">Clean tables</a></li>

		<li><a href="settings.php" id="default">Settings</a></li>

		<li><a href="statistics.php" id="selected">Statistics</a></li>

		<li><a href="database.php" id="default">Database</a></li>

		<li><a href="logout.php" id="default">Log out</a></li>

		</ul>

	</div>

	<div id="main">  

		<div id='submenu'>

        <!-- submenu links here -->

		 <ul>

		<li><a href="statistics.php?type=keywords">Top keywords</a></li>

		<li><a href="statistics.php?type=pages">Largest pages</a></li>

		<li><a href="statistics.php?type=top_searches">Most popular searches</a></li>

		<li><a href="statistics.php?type=log">Search log</a></li>

		<li><a href="statistics.php?type=spidering_log">Spidering logs</a></li>

		</ul>

          <!-- end submenu links -->

		</div>

        <div id="searchform"><form action="index.php" method="post">

        <input type="hidden" name="f" value="searchsite" /><input type="text" name="searchurl" size="25" /><input type="submit" value="Find site" /></form></div>

<!-- main bady functions here -->

<br /><br />

<?php

global $mysql_table_prefix, $log_dir;

if ($type == "") {

				$cachedSumQuery = "select sum(length(fulltxt)) from ".$mysql_table_prefix."links";

				$result=mysql_query("select sum(length(fulltxt)) from ".$mysql_table_prefix."links");

				echo mysql_error();

				if ($row=mysql_fetch_array($result)) {

					$cachedSumSize = $row[0];

				}

				$cachedSumSize = number_format($cachedSumSize / 1024, 2);



				$sitesSizeQuery = "select sum(size) from ".$mysql_table_prefix."links";

				$result=mysql_query("$sitesSizeQuery");

				echo mysql_error();

				if ($row=mysql_fetch_array($result)) {

					$sitesSize = $row[0];

				}

				$sitesSize = number_format($sitesSize, 2);



				$stats = getStatistics();

				print "<br/><div align=\"center\"><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td><table cellpadding=\"3\" cellspacing = \"1\"><tr  class=\"grey\"><td><b>Sites:</b></td><td align=\"center\">".$stats['sites']."</td></tr>";				

				print "<tr class=\"white\"><td><b>Links:</b></td><td align=\"center\"> ".$stats['links']."</td></tr>";

				print "<tr class=\"white\"><td><b>Images:</b></td><td align=\"center\"> ".$stats['imgUrl']."</td></tr>";

				print "<tr class=\"white\"><td><b>Keywords:</b></td><td align=\"center\"> ".$stats['keywords']."</td></tr>";

				print "<tr class=\"grey\"><td><b>Keyword-link realations:</b></td><td align=\"center\"> ".$stats['index']."</td></tr>";

				print "<tr class=\"white\"><td><b>Cached texts total:</b></td><td align=\"center\"> $cachedSumSize kb</td></tr>";

				print "<tr class=\"grey\"><td><b>Sites size total:</b></td><td align=\"center\"> $sitesSize kb</td></tr>";

				print "</table></td></tr></table></div>";

			}	



			if ($type=='keywords') {

				$class = "grey";

				print "<br/><div align=\"center\"><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td><table cellpadding=\"3\" cellspacing = \"1\"><tr  class=\"grey\"><td><b>Keyword</b></td><td><b>Occurrences</b></td></tr>";

				for ($i=0;$i<=15; $i++) {

					$char = dechex($i);

					$result=mysql_query("select keyword, count(".$mysql_table_prefix."link_keyword$char.keyword_id) as x from ".$mysql_table_prefix."keywords, ".$mysql_table_prefix."link_keyword$char where ".$mysql_table_prefix."keywords.keyword_id = ".$mysql_table_prefix."link_keyword$char.keyword_id group by keyword order by x desc limit 30");

					echo mysql_error();

					while (($row=mysql_fetch_row($result))) {

						$topwords[$row[0]] = $row[1];

					}

				}

				arsort($topwords);

				$count = 0;

				while ((list($word, $weight) = each($topwords)) && $count <= 30) {

					

					$count++;

					if ($class =="white") 

						$class = "grey";

					else 

						$class = "white";



					print "<tr class=\"$class\"><td align=\"left\">".$word."</td><td> ".$weight."</td></tr>\n";

		 		}			

				print "</table></td></tr></table></div>";

			}

			if ($type=='pages') {

				$class = "grey";

				?>

				<br/><div align="center">

				<table cellspacing ="0" cellpadding="0" class="darkgrey"><tr><td>

				<table cellpadding="2" cellspacing="1">

				  <tr class="grey"><td>

				   <b>Page</b></td>

				   <td><b>Text size</b></td></tr>

				<?php 

				$result=mysql_query("select ".$mysql_table_prefix."links.link_id, url, length(fulltxt)  as x from ".$mysql_table_prefix."links order by x desc limit 20");

				echo mysql_error();

				while ($row=mysql_fetch_row($result)) {

					if ($class =="white") 

						$class = "grey";

					else 

						$class = "white";

					$url = $row[1];

					$sum = number_format($row[2]/1024, 2);

					print "<tr class=\"$class\"><td align=\"left\"><a href=\"$url\">".$url."</td><td align= \"center\"> ".$sum."kb</td></tr>";

		 		}			

				print "</table></td></tr></table></div>";

			}



			if ($type=='top_searches') {

				$class = "grey";

				print "<br/><div align=\"center\"><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td><table cellpadding=\"3\" cellspacing = \"1\"><tr  class=\"grey\"><td><b>Query</b></td><td><b>Count</b></td><td><b> Average results</b></td><td><b>Last queried</b></td></tr>";

				$result=mysql_query("select query, count(*) as c, date_format(max(time), '%Y-%m-%d %H:%i:%s'), avg(results) from ".$mysql_table_prefix."query_log group by query order by c desc");

				echo mysql_error();

				while ($row=mysql_fetch_row($result)) {

					if ($class =="white") 

						$class = "grey";

					else 

						$class = "white";



					$word = $row[0];

					$times = $row[1];

					$date = $row[2];

					$avg = number_format($row[3], 1);

					print "<tr class=\"$class\"><td align=\"left\">".htmlentities($word)."</td><td align=\"center\"> ".$times."</td><td align=\"center\"> ".$avg."</td><td align=\"center\"> ".$date."</td></tr>";

		 		}			

				print "</table></td></tr></table></div>";

			}

			if ($type=='log') {

				

				//show home page content

	$get_sql = "SELECT * FROM query_log";

        $t = mysql_query($get_sql);

   

        $a                = mysql_fetch_object($t); 

        $total_items      = mysql_num_rows($t); 

        $limit            = $_GET['limit']; 

        $type             = $_GET['type']; 

        $page             = $_GET['page']; 



       //set default if: $limit is empty, non numerical, less than 10, greater than 50 

       if((!$limit)  || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50)) { 

       $limit = 30; //default 

     } 

      //set default if: $page is empty, non numerical, less than zero, greater than total available 

      if((!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $total_items)) { 

      $page = 1; //default 

   } 



        //calcuate total pages 

        $total_pages     = ceil($total_items / $limit); 

        $set_limit          = $page * $limit - ($limit);

		

				$class = "grey";

				

				print "<br/><div align=\"center\"><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td class=\"white\"><div class=\"left\"><br />Total Search Querys = <b>$total_items</b><br /><br /></div></td></tr><tr><td><table cellpadding=\"3\" cellspacing = \"1\"><tr  class=\"grey\"><td align=\"center\"><b>Query</b></td><td align=\"center\"><b>Type</b></td><td align=\"center\"><b>Results</b></td><td align=\"center\"><b>Queried at</b></td><td align=\"center\"><b>Time taken</b></td><td align=\"center\"><b>IP</b></td></tr>";

				$result=mysql_query("select query, type,  date_format(time, '%d-%m-%Y %H:%i:%s'), elapsed, results, ip from ".$mysql_table_prefix."query_log order by time desc LIMIT $set_limit, $limit");

				echo mysql_error();

				while ($row=mysql_fetch_row($result)) {

					if ($class =="white") 

						$class = "grey";

					else 

						$class = "white";



					$word = $row[0];

					$type = $row[1];

					$time = $row[2];

					$elapsed = $row[3];

					$results = $row[4];

					$ip = $row[5];

					print "<tr class=\"$class\"><td align=\"left\">".htmlentities($word)."</td><td align=\"center\">".$type."</td><td align=\"center\"> ".$results."</td><td align=\"center\"> ".$time."</td><td align=\"center\"> ".$elapsed."</td><td> ".$ip."</td></tr>";

		 		}			

				print "</table></td></tr></table></div>";

				

				

				echo "<div align='center'><br /><br />";

	//prev. page: 



$prev_page = $page - 1; 



if($prev_page >= 1) { 

  echo("&lt; &lt; <a href=statistics.php?type=log&limit=$limit&amp;page=$prev_page><b>Prev</b></a> "); 

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

  echo("  <a href=statistics.php?type=log&limit=$limit&amp;page=$a> $a </a> | "); 

     } 

} 



//next page: 



$next_page = $page + 1; 

if($next_page <= $total_pages) { 

   echo("<a href=statistics.php?type=log&limit=$limit&amp;page=$next_page><b>Next</b></a> &gt; &gt;"); 

} 

echo "</div>";

				

			}

	

			if ($type=='spidering_log') {

				if ($f == delete_log) {

					unlink($log_dir."/".$file);

				}

				$class = "grey";

				$files = get_dir_contents($log_dir);

				if (count($files)>0) {

					print "<br/><div align=\"center\"><table cellspacing =\"0\" cellpadding=\"0\" class=\"darkgrey\"><tr><td><table cellpadding=\"3\" cellspacing = \"1\"><tr  class=\"grey\"><td align=\"center\"><b>File</b></td><td align=\"center\"><b>Time</b></td><td align=\"center\"><b></b></td></tr>";



					for ($i=0; $i<count($files); $i++) {

						$file=$files[$i];

						$year = substr($file, 0,2);

						$month = substr($file, 2,2);

						$day = substr($file, 4,2);

						$hour = substr($file, 6,2);

						$minute = substr($file, 8,2);

						if ($class =="white") 

							$class = "grey";

						else 

							$class = "white";

						print "<tr class=\"$class\"><td align=\"left\"><a href='$log_dir/$file' tareget='_blank'>$file</a></td><td align=\"center\"> 20$year-$month-$day $hour:$minute</td><td align=\"center\"> <a href='?type=spidering_log&f=delete_log&file=$file' id='small_button'>Delete</a></td></tr>";

					}



					print "</table></td></tr></table></div>";

				} else {

					?>

					<br/><br/>

					<center><b>No saved logs.</b></center>

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