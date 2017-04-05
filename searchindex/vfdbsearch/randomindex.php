<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"

 "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<meta name="Content-Script-Type" content="text/javascript">

<meta name="Content-Style-Type" content="text/css">

<title>Random Indexer</title>

<script type="text/javascript"><!--

function showData(id,str)

{

if (str=="")

  {

  document.getElementById(id).innerHTML="";

  return;

  }

if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById(id).innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET","blockdata.php?q="+str,true);

xmlhttp.send();

}

//--></script>

<script type="text/javascript"><!--

function showData2(id,str)

{

if (str=="")

  {

  document.getElementById(id).innerHTML="";

  return;

  }

if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById(id).innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET","blockimgs.php?q="+str,true);

xmlhttp.send();

}

//--></script>

</head>

<body>

<?php 

	set_time_limit (0);

	$include_dir = "../include";

	include "auth.php";

	require_once ("$include_dir/commonfuncs.php");

	$all = 0; 

	extract (getHttpVars());

	$settings_dir =  "../settings";

	require_once ("$settings_dir/conf.php");



	include "messages.php";

	include "spiderfuncs.php";

	error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);

	

	

	$delay_time = 0;



	

	$command_line = 0;

	

if ($keep_log) {

		if ($log_format=="html") {

			$log_file =  $log_dir."/".Date("ymdHi").".html";

		} else {

			$log_file =  $log_dir."/".Date("ymdHi").".log";

		}

		

		if (!$log_handle = fopen($log_file, 'w')) {

			die ("Logging option is set, but cannot open file for logging.");

		}

	}	

	

function index_random() {

		global $mysql_table_prefix;

		$result=mysql_query("select url, spider_depth, required, disallowed, can_leave_domain from ".$mysql_table_prefix."sites ORDER BY RAND() LIMIT 1");

		echo mysql_error();

    	while ($row=mysql_fetch_row($result)) {

    		$url = $row[0];

			$_SESSION['indexedurl'] = $row[0];

	   		$depth = $row[1];

    		$include = $row[2];

    		$not_include = $row[3];

    		$can_leave_domain = $row[4];

    		if ($can_leave_domain=='') {

    			$can_leave_domain=0;

    		}

    		if ($depth == -1) {

    			$soption = 'full';

    		} else {

    			$soption = 'level';

    		}

			index_site($url, 1, $depth, $soption, $include, $not_include, $can_leave_domain);

		}

	}



function index_site($url, $reindex, $maxlevel, $soption, $url_inc, $url_not_inc, $can_leave_domain) {

		global $mysql_table_prefix, $command_line, $mainurl,  $tmp_urls, $domain_arr, $all_keywords;

		if (!isset($all_keywords)) {

			$result = mysql_query("select keyword_ID, keyword from ".$mysql_table_prefix."keywords");

			echo mysql_error();

			while($row=mysql_fetch_array($result)) {

				$all_keywords[addslashes($row[1])] = $row[0];

			}

		}

		$compurl = parse_url($url);

		if ($compurl['path'] == '')

			$url = $url . "/";

	

		$t = microtime();

		$a =  getenv("REMOTE_ADDR");

		$sessid = md5 ($t.$a);

	

	

		$urlparts = parse_url($url);

	

		$domain = $urlparts['host'];

		if (isset($urlparts['port'])) {

			$port = (int)$urlparts['port'];

		}else {

			$port = 80;

		}



		

	

		$result = mysql_query("select site_id from ".$mysql_table_prefix."sites where url='$url'");

		echo mysql_error();

		$row = mysql_fetch_row($result);

		$site_id = $row[0];

		

		if ($site_id != "" && $reindex == 1) {

			mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$url', 0, '$sessid')");

			echo mysql_error();

			$result = mysql_query("select url, level from ".$mysql_table_prefix."links where site_id = $site_id");

			while ($row = mysql_fetch_array($result)) {

				$site_link = $row['url'];

				$link_level = $row['level'];

				if ($site_link != $url) {

					mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$site_link', $link_level, '$sessid')");

				}

			}

			

			$qry = "update ".$mysql_table_prefix."sites set indexdate=now(), spider_depth = $maxlevel, required = '$url_inc'," .

					"disallowed = '$url_not_inc', can_leave_domain=$can_leave_domain where site_id=$site_id";

			mysql_query ($qry);

			echo mysql_error();

		} else if ($site_id == '') {

			mysql_query ("insert into ".$mysql_table_prefix."sites (url, indexdate, spider_depth, required, disallowed, can_leave_domain) " .

					"values ('$url', now(), $maxlevel, '$url_inc', '$url_not_inc', $can_leave_domain)");

			echo mysql_error();

			$result = mysql_query("select site_ID from ".$mysql_table_prefix."sites where url='$url'");

			$row = mysql_fetch_row($result);

			$site_id = $row[0];

		} else {

			mysql_query ("update ".$mysql_table_prefix."sites set indexdate=now(), spider_depth = $maxlevel, required = '$url_inc'," .

					"disallowed = '$url_not_inc', can_leave_domain=$can_leave_domain where site_id=$site_id");

			echo mysql_error();

		}

	

	

		$result = mysql_query("select site_id, temp_id, level, count, num from ".$mysql_table_prefix."pending where site_id='$site_id'");

		echo mysql_error();

		$row = mysql_fetch_row($result);

		$pending = $row[0];

		$level = 0;

		$domain_arr = get_domains();

		if ($pending == '') {

			mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$url', 0, '$sessid')");

			echo mysql_error();

		} else if ($pending != '') {

			printStandardReport('continueSuspended',$command_line);

			mysql_query("select temp_id, level, count from ".$mysql_table_prefix."pending where site_id='$site_id'");

			echo mysql_error();

			$sessid = $row[1];

			$level = $row[2];

			$pend_count = $row[3] + 1;

			$num = $row[4];

			$pending = 1;

			$tmp_urls = get_temp_urls($sessid);

		}

	

		if ($reindex != 1) {

			mysql_query ("insert into ".$mysql_table_prefix."pending (site_id, temp_id, level, count) values ('$site_id', '$sessid', '0', '0')");

			echo mysql_error();

		}

	

	

		$time = time();

	

	

		$omit = check_robot_txt($url);

	

		printHeader ($omit, $url, $command_line);

	

	

		$mainurl = $url;

		$num = 0;

	

		while (($level <= $maxlevel && $soption == 'level') || ($soption == 'full')) {

			if ($pending == 1) {

				$count = $pend_count;

				$pending = 0;

			} else

				$count = 0;

	

			$links = array();

	

			$result = mysql_query("select distinct link from ".$mysql_table_prefix."temp where level=$level && id='$sessid' order by link");

			echo mysql_error();

			$rows = mysql_num_rows($result);

	

			if ($rows == 0) {

				break;

			}

	

			$i = 0;

	

			while ($row = mysql_fetch_array($result)) {

				$links[] = $row['link'];

			}

	

			reset ($links);

	

	

			while ($count < count($links)) {

				$num++;

				$thislink = $links[$count];

				$urlparts = parse_url($thislink);

				reset ($omit);

				$forbidden = 0;

				foreach ($omit as $omiturl) {

					$omiturl = trim($omiturl);

	

					$omiturl_parts = parse_url($omiturl);

					if ($omiturl_parts['scheme'] == '') {

						$check_omit = $urlparts['host'] . $omiturl;

					} else {

						$check_omit = $omiturl;

					}

	

					if (strpos($thislink, $check_omit)) {

						printRobotsReport($num, $thislink, $command_line);

						check_for_removal($thislink); 

						$forbidden = 1;

						break;

					}

				}

				

				if (!check_include($thislink, $url_inc, $url_not_inc )) {

					printUrlStringReport($num, $thislink, $command_line);

					check_for_removal($thislink); 

					$forbidden = 1;

				} 

	

				if ($forbidden == 0) {

					?>

                    <table width="100%">

                    <tr>

                    <td width="70%">

                    <?php

					printRetrieving($num, $thislink, $command_line);

					?>

                    </td>

                    <td>

                    <table width="200" border="1">

                    <tr>

                    <td width="100"><a href="javascript:showData('<?php echo "$url$num"; ?>','<?php echo "$thislink"; ?>')">Block</a></td>

                    <td>

                    <div id='<?php echo "$url$num"; ?>'>

                    <?php

					$blockedqry = "SELECT url FROM ".$mysql_table_prefix."removedurls WHERE url='$thislink'";

                    $blockedres = mysql_query($blockedqry);

					$rows = mysql_num_rows($blockedres);

					if ($rows == 1) {

					echo "<b>Blocked</b>";	

					}

					?>

                    </div></td>

                    </tr>

                    </table>

                    </td>

                    </tr>

                    <tr>

                    <td colspan="2">

                    <?php

					$query = "select md5sum, indexdate from ".$mysql_table_prefix."links where url='$thislink'";

					$result = mysql_query($query);

					echo mysql_error();

					$rows = mysql_num_rows($result);

					if ($rows == 0) {

						index_url($thislink, $level+1, $site_id, '',  $domain, '', $sessid, $can_leave_domain, $reindex);



						mysql_query("update ".$mysql_table_prefix."pending set level = $level, count=$count, num=$num where site_id=$site_id");

						echo mysql_error();

					}else if ($rows <> 0 && $reindex == 1) {

						$row = mysql_fetch_array($result);

						$md5sum = $row['md5sum'];

						$indexdate = $row['indexdate'];

						index_url($thislink, $level+1, $site_id, $md5sum,  $domain, $indexdate, $sessid, $can_leave_domain, $reindex);

						mysql_query("update ".$mysql_table_prefix."pending set level = $level, count=$count, num=$num where site_id=$site_id");

						echo mysql_error();

					}else {

						printStandardReport('inDatabase',$command_line);

					}

					?>

                    </td>

                    </tr>

                    <tr>

                    <td colspan="2">

                    Checking url for images:<br /><br />

                    <?php

                    include_once('simple_html_dom.php');

                    $target_url = "$thislink";

                    $html = new simple_html_dom();

                    $html->load_file($target_url);

					$imgnum = 0;

                    foreach($html->find('img') as $img)

                    {

                    $src = $img->src;

                    $width = $img->width;

                    $height = $img->height;

                    $alt = $img->alt;

					$imgnum = $imgnum;

					$imgnum++;

					

					//gather if img is full url

					

					$str = substr($src, 0, 5);

					

					if (($str =='http:') && ($width !='') && ($height!='') && ($alt!=''))  {

					//img is full url so continue

					

					//check img is big enough

					if ($width >30) {

						

						//check if img is currently indexed

						$qry = "SELECT * FROM imgs WHERE imgUrl='$src' AND alt='$alt'";

                        $qryres = mysql_query($qry);

					    $imgrows = mysql_num_rows($qryres);

					    if ($imgrows != 1) {

					

					

					?>

					<table width="100%" cellpadding="5" cellspacing="5" border="1">

<tr>

<td width="60%">

<?php 

echo "$img";

?>

</td>

<td valign="top">

<?php echo "<br />$src<br />Width-$width<br />H-$height<br />Alt=$alt<br />$Img Number $imgnum<br />Indexed $indexedimg<br /><br />"; ?>

<table width="200" border="1">

                    <tr>

                    <td width="100"><a href="javascript:showData2('<?php echo "$src$imgnum"; ?>','<?php echo "$src"; ?>')">Ban img</a></td>

                    <td>

                    <div id='<?php echo "$src$imgnum"; ?>'>

                    <?php

					$blockedqry = "SELECT url FROM ".$mysql_table_prefix."removedimgs WHERE url='$src'";

                    $blockedres = mysql_query($blockedqry);

					$rows = mysql_num_rows($blockedres);

					if ($rows == 1) {

					echo "<b>Banned</b>";	

					}

					?>

  

                    </div>

 <?php

 if ($rows !=1) {

	 //we need to add img

	 $sql = "INSERT INTO imgs (imgUrl,width,height,alt) VALUES ('$src', '$width', '$height','$alt')";

	 $result = mysql_query($sql);

	 

 }

 

 ?>                   

</td>

</tr>

</table>

</td>

</tr>

</table>



<?php 

						}}}//close if url is not http:



}//close for each img

				 ?>

                    </td>

                    </tr>

                    </table>

                    <br /><br /><hr /><br />

                    <?php



				}

				$count++;

			}

			$level++;

		}

	

		mysql_query ("delete from ".$mysql_table_prefix."temp where id = '$sessid'");

		echo mysql_error();

		mysql_query ("delete from ".$mysql_table_prefix."pending where site_id = '$site_id'");

		echo mysql_error();

		

		$tmp_urls = Array();

		

		printStandardReport('completed',$command_line);

	



	}

function get_domains () {

		global $mysql_table_prefix;

		$result = mysql_query("select domain_id, domain from ".$mysql_table_prefix."domains");

		echo mysql_error();

		$domains = Array();

    	while ($row=mysql_fetch_row($result)) {

			$domains[$row[1]] = $row[0];

		}

		return $domains;

			

	}

	

function index_url($url, $level, $site_id, $md5sum, $domain, $indexdate, $sessid, $can_leave_domain, $reindex) {

		global $entities, $min_delay;

		global $command_line;

		global $min_words_per_page;

		global $supdomain;

		global $mysql_table_prefix, $user_agent, $tmp_urls, $delay_time, $domain_arr;

		$needsReindex = 1;

		$deletable = 0;



		$url_status = url_status($url);

		$thislevel = $level - 1;



		if (strstr($url_status['state'], "Relocation")) {

			$url = preg_replace("/ /", "", url_purify($url_status['path'], $url, $can_leave_domain));



			if ($url <> '') {

				$result = mysql_query("select link from ".$mysql_table_prefix."temp where link='$url' && id = '$sessid'");

				echo mysql_error();

				$rows = mysql_numrows($result);

				if ($rows == 0) {

					mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$url', '$level', '$sessid')");

					echo mysql_error();

				}

			}



			$url_status['state'] == "redirected";

		}



		/*

		if ($indexdate <> '' && $url_status['date'] <> '') {

			if ($indexdate > $url_status['date']) {

				$url_status['state'] = "Date checked. Page contents not changed";

				$needsReindex = 0;

			}

		}*/

		ini_set("user_agent", $user_agent);

		if ($url_status['state'] == 'ok') {

			$OKtoIndex = 1;

			$file_read_error = 0;

			

			if (time() - $delay_time < $min_delay) {

				sleep ($min_delay- (time() - $delay_time));

			}

			$delay_time = time();

			if (!fst_lt_snd(phpversion(), "4.3.0")) {

				$file = file_get_contents($url);

				if ($file === FALSE) {

					$file_read_error = 1;

				}

			} else {

				$fl = @fopen($url, "r");

				if ($fl) {

					while ($buffer = @fgets($fl, 4096)) {

						$file .= $buffer;

					}

				} else {

					$file_read_error = 1;

				}



				fclose ($fl);

			}

			if ($file_read_error) {

				$contents = getFileContents($url);

				$file = $contents['file'];

			}

			



			$pageSize = number_format(strlen($file)/1024, 2, ".", "");

			printPageSizeReport($pageSize);

			global $max_page_size;

			 //check page file size to index

			if ($pageSize > $max_page_size) {

				printStandardReport('fileSize',$command_line);

				$OKtoIndex = 0;

				$fileSizeIndex = 1;

			}



			if ($url_status['content'] != 'text') {

				$file = extract_text($file, $url_status['content']);

			}



			if ($fileSizeIndex == 1) { printStandardReport('retrieving', $command_line); } else { printStandardReport('starting', $command_line); }

		



			$newmd5sum = md5($file);

			

            

			

			if ($md5sum == $newmd5sum) {

				printStandardReport('md5notChanged',$command_line);

				$OKtoIndex = 0;

			} else if (isDuplicateMD5($newmd5sum)) {

				$OKtoIndex = 0;

				printStandardReport('duplicate',$command_line);

			}

			

			

            if ($fileSizeIndex == 1) {

					$links = get_links($file, $url, $can_leave_domain, $data['base']);

					$links = distinct_array($links);

					$all_links = count($links);

					$numoflinks = 0;

					//if there are any, add to the temp table, but only if there isnt such url already

					if (is_array($links)) {

						reset ($links);



						while ($thislink = each($links)) {

							if ($tmp_urls[$thislink[1]] != 1) {

								$tmp_urls[$thislink[1]] = 1;

								$numoflinks++;

								mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$thislink[1]', '$level', '$sessid')");

								echo mysql_error();

							}

						}

					}

				} 

				

			if (($md5sum != $newmd5sum || $reindex ==1) && $OKtoIndex == 1) {

				$urlparts = parse_url($url);

				$newdomain = $urlparts['host'];

				$type = 0;

				

		/*		if ($newdomain <> $domain)

					$domainChanged = 1;



				if ($domaincb==1) {

					$start = strlen($newdomain) - strlen($supdomain);

					if (substr($newdomain, $start) == $supdomain) {

						$domainChanged = 0;

					}

				}*/



				// remove link to css file

				//get all links from file

				$data = clean_file($file, $url, $url_status['content']);



				if ($data['noindex'] == 1) {

					$OKtoIndex = 0;

					$deletable = 1;

					printStandardReport('metaNoindex',$command_line);

				}

	



				$wordarray = unique_array(explode(" ", $data['content']));

	

				if ($data['nofollow'] != 1) {

// If available, extract links from sitemap.xml otherwise search for links in HTML

$url2 = remove_sessid(convert_url($url)); // here we don't need all that

// get folder where sitemap should be and if exists, cut existing filename and suffix

$url2 = substr($url2,0,(strrpos($url2,"/"))); // (to be modified for backslash folder separation)

$input_file = "$url2/sitemap.xml"; // create path to sitemap



$map =strpos((implode(array_keys($tmp_urls))),"sitemap.xml");

if ($map === FALSE) { // if we don't know already sitemap.xml for this index

if ($handle = fopen($input_file, "r")) { // happy times, we found a new sitemap

$links = get_sitemap ($input_file); // now extract links from sitemap.xml



if ($links =='') { // there was a non-compatible sitemap, we have to search for links in HTML code - grrhhh !

$links = get_links($file, $url, $can_leave_domain, $data['base']);

}

} else { // there was no sitemap, we have to search for links in HTML code - grrhhh !

$links = get_links($file, $url, $can_leave_domain, $data['base']);

}



$links = distinct_array($links); // Removes duplicate elements from an array

$all_links = count($links);

$numoflinks = 0;

//if there are any, add to the temp table, but only if there isnt such url already

if (is_array($links)) {

reset ($links);



while ($thislink = each($links)) {

if ($tmp_urls[$thislink[1]] != 1) {

$tmp_urls[$thislink[1]] = 1;

$numoflinks++;

mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$thislink[1]', '$level', '$sessid')");

echo mysql_error();

}

}

}

}

} else {  printStandardReport('noFollow',$command_line);

				}

				

				if ($OKtoIndex == 1) {

					

					$title = $data['title'];

					$host = $data['host'];

					$path = $data['path'];

					$fulltxt = $data['fulltext'];

					$desc = substr($data['description'], 0,254);

					$url_parts = parse_url($url);

					$domain_for_db = $url_parts['host'];



					if (isset($domain_arr[$domain_for_db])) {

						$dom_id = $domain_arr[$domain_for_db];

					} else {

						mysql_query("insert into ".$mysql_table_prefix."domains (domain) values ('$domain_for_db')");

						$dom_id = mysql_insert_id();

						$domain_arr[$domain_for_db] = $dom_id;

					}



					$wordarray = calc_weights ($wordarray, $title, $host, $path, $data['keywords']);



					//if there are words to index, add the link to the database, get its id, and add the word + their relation

					if (is_array($wordarray) && count($wordarray) > $min_words_per_page) {

						if ($md5sum == '') {

							mysql_query ("insert into ".$mysql_table_prefix."links (site_id, url, title, description, fulltxt, indexdate, size, md5sum, level) values ('$site_id', '$url', '$title', '$desc', '$fulltxt', curdate(), '$pageSize', '$newmd5sum', $thislevel)");

							echo mysql_error();

							$result = mysql_query("select link_id from ".$mysql_table_prefix."links where url='$url'");

							echo mysql_error();

							$row = mysql_fetch_row($result);

							$link_id = $row[0];



							save_keywords($wordarray, $link_id, $dom_id);

							

							printStandardReport('indexed', $command_line);

						}else if (($md5sum <> '') && ($md5sum <> $newmd5sum)) { //if page has changed, start updating



							$result = mysql_query("select link_id from ".$mysql_table_prefix."links where url='$url'");

							echo mysql_error();

							$row = mysql_fetch_row($result);

							$link_id = $row[0];

							for ($i=0;$i<=15; $i++) {

								$char = dechex($i);

								mysql_query ("delete from ".$mysql_table_prefix."link_keyword$char where link_id=$link_id");

								echo mysql_error();

							}

							save_keywords($wordarray, $link_id, $dom_id);

							$query = "update ".$mysql_table_prefix."links set title='$title', description ='$desc', fulltxt = '$fulltxt', indexdate=now(), size = '$pageSize', md5sum='$newmd5sum', level=$thislevel where link_id=$link_id";



							mysql_query($query);

							echo mysql_error();

							printStandardReport('re-indexed', $command_line);

						}

					}else {

						printStandardReport('minWords', $command_line);



					}

				}

			}

		} else {

			$deletable = 1;

			printUrlStatus($url_status['state'], $command_line);



		}

		if ($reindex ==1 && $deletable == 1) {

			check_for_removal($url); 

		} else if ($reindex == 1) {

			

		}

		if (!isset($all_links)) {

			$all_links = 0;

		}

		if (!isset($numoflinks)) {

			$numoflinks = 0;

		}

		printLinksReport($numoflinks, $all_links, $command_line);

		

	}

	



function get_temp_urls ($sessid) {

		global $mysql_table_prefix;

		$result = mysql_query("select link from ".$mysql_table_prefix."temp where id='$sessid'");

		echo mysql_error();

		$tmp_urls = Array();

    	while ($row=mysql_fetch_row($result)) {

			$tmp_urls[$row[0]] = 1;

		}

		return $tmp_urls;

			

	}

	

	

//start while loop



$num = 0; //set num to 1

while($num <=3) { 

        

   

//start of indexing



//call indexing function

index_random();



//clean temp tables

echo "<br /><br />Cleaning temp tables";

global $mysql_table_prefix;

		$result = mysql_query("delete from ".$mysql_table_prefix."temp where level >= 0");

		echo mysql_error();

		$del = mysql_affected_rows();

		

		echo "<br /><br /><span class='red'>Temp table cleared, $del items deleted.</span>";

//rest

sleep(60);

//clean 404 not found urls

echo "<br /><br />Removing 404 not found url's";

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

	

 

	echo "<br /><br /><span class='red'>404 URL'S removed, $del items deleted.</span>";

//rest

sleep(60);

//clean blocked urls

echo "<br /><br />Removing blocked url's";

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

		

		echo "<br /><br /><span class='red'>Blocked URL'S removed, $del items deleted.</span>";





sleep(60);

//clean blocked urls

echo "<br /><br />Removing blocked imgs";

        global $mysql_table_prefix;

		$sql = "SELECT url FROM ".$mysql_table_prefix."removedimgs";

		$results = mysql_query($sql);

		

		$del = 0;

		while ($info=mysql_fetch_array($results)) {

			$url=$info['url'];

		

		$query = "select ID from ".$mysql_table_prefix."imgs where url='$url'";

		$result = mysql_query($query);

	if (mysql_numrows($result) > 0) { 

		echo mysql_error();

		$del++;

		$todelete = array();

		while ($row=mysql_fetch_array($result)) {

			$todelete[]=$row['ID'];

		}



		mysql_query("delete from ".$mysql_table_prefix."imgs where ID=$todelete");

		echo mysql_error();

	    }

		

	}

		

		echo "<br /><br /><span class='red'>Blocked IMGS removed, $del items deleted.</span>";

	  

	    

//rest

sleep(60);

//call email function

echo "<br /><br />Genarating email log";

if ($email_log) {

	$indexed = $_SESSION['indexedurl'];

		$log_report = "";

		if ($log_handle) {

			$log_report = "Log saved into $log_file";

		}

		mail($admin_email, "Sphider Pro indexing report", "Sphider Pro has finished indexing $indexed at ".date("y-m-d H:i:s").". ".$log_report);

		

		unset($_SESSION['indexedurl']);

	}

//rest

sleep(60);

//rest server

echo "<br /><br />Server resting<br /><br />";

//rest

sleep(180);



$num++;  // increase number

 }//end while array

 

 echo "<br /><br /> Random indexing has finished  [Back to <a href=\"index.php\">Home</a>]";

 

mysql_close($link);

 











	if ( $log_handle) {

		fclose($log_handle);

	}	



?>

</body>

</html>