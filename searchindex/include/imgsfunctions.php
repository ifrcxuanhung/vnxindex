<?php

function getmicrotime(){
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
    }


function saveToLog ($query, $time, $rows) {
        global $mysql_table_prefix;
		$ip = $_SERVER['REMOTE_ADDR'];
    if ($results =="") {
        $results = 0;
    }
    $query =  "insert into ".$mysql_table_prefix."query_log (query, type, time, elapsed, results, ip) values ('$query', 'img', now(), '$time', '$rows', '$ip')";
	mysql_query($query);
                    
	echo mysql_error();
                        
}

$starttime = getmicrotime();
$get_sql = "SELECT * FROM imgs WHERE MATCH(alt) AGAINST ('$term')";
$t = mysql_query($get_sql);
   
 $a                = mysql_fetch_object($t); 
$total_items      = mysql_num_rows($t); 
$rows             = mysql_num_rows($t);
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

//query: 
$sql = "SELECT *, MATCH(alt) AGAINST ('$term') AS score
        FROM imgs WHERE MATCH(alt) AGAINST ('$term') ORDER BY ID DESC LIMIT $set_limit, $limit ";
$sql_result = mysql_query($sql);

if (mysql_num_rows($sql_result) < 1) {
	//there are no articles, so say so
	echo "<p><em>Sorry we found no results matching <strong>$term</strong></em></p>";
} else {	
	
	$endtime = getmicrotime() - $starttime;
    $time = round($endtime*100)/100;
    saveToLog(addslashes($query), (round($endtime*100)/100), $rows);
	$tl = $limit * $page;
	if ($tl > $rows) { $to = $rows; }else{$to=$limit*$page;}
	if ($page==1) {$from=1;}else{$from=$limit*$page-$limit+1;}
	$result = $sph_messages['Results'];
	$result = str_replace ('%from', $from, $result);
	$result = str_replace ('%to', $to, $result);
	$result = str_replace ('%all', $rows, $result);
	$matchword = $sph_messages["matches"];
	if ($total_results== 1) {
		$matchword= $sph_messages["match"];
	} else {
		$matchword= $sph_messages["matches"];
	}
	
	$result = str_replace ('%matchword', $matchword, $result);	 
	$result = str_replace ('%secs', $time, $result);
	echo $result;
	echo "<br /><br />";
	echo "<ul class='img'>";

while ($info = mysql_fetch_array($sql_result)) {
	         $src = $info['imgUrl'];
			 $width = $info['width'];
			 $height = $info['height'];
			 $alt = $info['alt'];
		
		//show articles
		echo "<li><img src='$src' class='mainimage' alt='$alt' /></li>";
		
		
}
echo "</ul>";

	
	
}
 
 ?>
