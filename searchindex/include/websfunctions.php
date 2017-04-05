<?php

function getmicrotime() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}

function saveToLog($query, $elapsed, $results) {
    global $mysql_table_prefix;
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($results == "") {
        $results = 0;
    }
    $query = "insert into " . $mysql_table_prefix . "query_log (query, time, elapsed, results, ip) values ('$query', now(), '$elapsed', '$results', '$ip')";
    mysql_query($query);

    echo mysql_error();
}

switch ($search) {
    case 1:
        if (!isset($results)) {
            $results = "";
        }

        $search_results = get_search_results($query, $start, $category, $type, $results, $domain);
        ?>

        <br/>
        <?php
        extract($search_results);
        ?>


        <?php if ($search_results['total_results'] == 0) { ?>

            <?php
            $msg = str_replace('%query', $ent_query, $sph_messages["noMatch"]);
            echo $msg;
            if ($category != '') {
                $sql = "SELECT * FROM categories WHERE category_id='$category'";
                $sql_result = mysql_query($sql);
                if (mysql_num_rows($sql_result) < 1) {
                    //there are no categories
                } else {
                    while ($info = mysql_fetch_array($sql_result)) {
                        $category = $info['category'];
                    }
                    echo " in category $category,";
                }
            }
            ?>

        <?php } ?>	

        <?php if ($search_results['did_you_mean']) { ?>

            <?php echo $sph_messages['DidYouMean']; ?>: <a href="<?php print 'index?query=' . quote_replace(addmarks($search_results['did_you_mean'])) . '&search=1' ?>"><?php print $search_results['did_you_mean_b']; ?></a>?

        <?php } ?>

        <?php if ($total_results != 0 && $from <= $to) { ?>

            <?php
            $result = $sph_messages['Results'];
            $result = str_replace('%from', $from, $result);
            $result = str_replace('%to', $to, $result);
            $result = str_replace('%all', $total_results, $result);
            $matchword = $sph_messages["matches"];
            if ($total_results == 1) {
                $matchword = $sph_messages["match"];
            } else {
                $matchword = $sph_messages["matches"];
            }

            $result = str_replace('%matchword', $matchword, $result);
            $result = str_replace('%secs', $time, $result);
            echo $result;
            echo "<br /><br />";
            ?>

        <?php } ?>


        <?php if (isset($qry_results)) {
            ?>



            <!-- results listing -->

            <?php
            foreach ($qry_results as $_key => $_row) {
                $last_domain = $domain_name;
                extract($_row);
                if ($show_query_scores == 0) {
                    $weight = '';
                } else {
                    $weight = "[$weight%]";
                }
                ?>
                <?php if ($domain_name == $last_domain && $merge_site_results == 1 && $domain == "") { ?>

                <?php } ?>
                <a href="<?php print $url ?>" class="title" target="_blank">	<?php print ($title ? $title : $sph_messages['Untitled']) ?></a><br/>
                <?php print $fulltxt ?>
                <?php //echo "$url2".' - '. $page_size ?><br />

                <?php if ($domain_name == $last_domain && $merge_site_results == 1 && $domain == "") { ?>
                    <a href="<?php print 'index?query=' . quote_replace(addmarks($query)) . '&amp;search=1&amp;results=' . $results_per_page . '&amp;domain=' . $domain_name ?>">More results from <?php print $domain_name ?></a><br />

                <?php } ?>
                <br/>
            <?php } ?>

        <?php } ?>
        <br /><br />
        <!-- links to other result pages-->
        <?php
        if (isset($other_pages)) {
            if ($adv == 1) {
                $adv_qry = "&adv=1";
            }
            if ($type != "") {
                $type_qry = "&type=$type";
            }
            ?>
            <center>
                <?php print $sph_messages["Result page"] ?>:
                <?php if ($start > 1) { ?>

                    <a href="<?php print 'index?query=' . quote_replace(addmarks($query)) . '&amp;start=' . $prev . '&amp;search=1&amp;results=' . $results_per_page . $type_qry . $adv_qry . '&amp;domain=' . $domain ?>"><?php print $sph_messages['Previous'] ?></a>
                <?php } ?>	

                <?php
                foreach ($other_pages as $page_num) {
                    if ($page_num != $start) {
                        ?>
                        <a href="<?php print 'index?query=' . quote_replace(addmarks($query)) . '&amp;start=' . $page_num . '&amp;search=1&amp;results=' . $results_per_page . $type_qry . $adv_qry . '&amp;domain=' . $domain ?>"><?php print $page_num ?></a>
                    <?php } else { ?>	
                        <b><?php print $page_num ?></b>
                    <?php } ?>	
                <?php } ?>

                <?php if ($next <= $pages) { ?>	
                    <a href="<?php print 'index?query=' . quote_replace(addmarks($query)) . '&amp;start=' . $next . '&amp;search=1&amp;results=' . $results_per_page . $type_qry . $adv_qry . '&amp;domain=' . $domain ?>"><?php print $sph_messages['Next'] ?></a>
                <?php } ?>


            </center><br /><br />


            <?php
        }


        break;
    default:
        echo 'vo';
}
if (!isset($total_results)) {
    $total_results = 0;
}
if ($total_results != 0) {
    if (get_magic_quotes_gpc() == 1) {
        $_GET['query'] = stripslashes($_GET['query']);
    }


    $_GET['query'] = addslashes($_GET['query']);

    /*
      if search string too small, do not search for keywords/phrases
     */
    if (strlen($_GET['query']) < 3) {
        $suggest_phrases = false;
        $suggest_keywords = false;
    }

    /*
      check if search string is phrase
     */
    if (!strpos($_GET['query'], ' ')) {
        $suggest_phrases = false;
    }


    /*
      searches from saved queries (query_log table)
     */

    if ($suggest_history && $_GET['query'] != '"') {
        $result = mysql_query($sql = "
	SELECT 	query as keyword, max(results) as results
	FROM {$mysql_table_prefix}query_log 
	WHERE results > 0 AND (query LIKE '{$_GET['query']}%' OR query LIKE '\"{$_GET['query']}%') 
	GROUP BY query ORDER BY results DESC
	LIMIT $suggest_rows
	");
        if ($result && mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result)) {
                $values[$row['keyword']] = $row['results'];
            }
        }
    }

    /*
      phrase search
      !! LOCATE: in MySQL 3.23 this function is case sensitive, while in 4.0 it's only case-sensitive if either argument is a binary string
     */

    if ($suggest_phrases) {
        $_GET['query'] = strtolower(str_replace('"', '', $_GET['query']));
        $_words = substr_count($_GET['query'], ' ') + 1;

        $result = mysql_query($sql = "
	SELECT count(link_id) as results, SUBSTRING_INDEX(SUBSTRING(fulltxt,LOCATE('{$_GET['query']}',LOWER(fulltxt))), ' ', '$_words') as keyword FROM {$mysql_table_prefix}links where fulltxt like '%{$_GET['query']}%' 
	GROUP BY SUBSTRING_INDEX( SUBSTRING( fulltxt, LOCATE( '{$_GET['query']}', LOWER(fulltxt) ) ) , ' ', '$_words' ) LIMIT $suggest_rows
	");
        if ($result && mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result)) {
                //$row['keyword'] = preg_replace("/[^\s\w]/ims",'',$row['keyword']);//array('.',',','?')$row['keyword']);
                $values[$row['keyword']] = $row['results'];
            }
        }
    }

    /*
      keyword search
     */ elseif ($suggest_keywords) {
        for ($i = 0; $i <= 15; $i++) {
            $char = dechex($i);
            $result = mysql_query($sql = "
		SELECT keyword, count(keyword) as results 
		FROM {$mysql_table_prefix}keywords INNER JOIN {$mysql_table_prefix}link_keyword$char USING (keyword_id) 
		WHERE keyword LIKE '{$_GET['query']}%'  
		GROUP BY keyword 
		ORDER BY results desc
		LIMIT $suggest_rows
		");
            if ($result && mysql_num_rows($result)) {
                while ($row = mysql_fetch_array($result)) {
                    $values[$row['keyword']] = $row['results'];
                }
            }
        }
		if (is_array($values)) {
			arsort($values);
		}
        //$values = array_slice($values, 0, $suggest_rows);
    }

    if (is_array($values)) {
        arsort($values);
        if (is_array($values))
            foreach ($values as $_key => $_val) {
                $js_array[] = '<a href="index?query=' . str_replace('"', '\"', $_key) . '&amp;search=1">' . str_replace('"', '\"', $_key) . '</a><br />';
            }

        echo "Related Searches: <br /><br />";
        echo implode(" ", $js_array);
    }
}
?>

