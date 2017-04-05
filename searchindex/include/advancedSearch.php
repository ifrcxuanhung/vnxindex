<?php
//include database conection
require_once('settings/db_search.php');
?>
<input type="radio" name="type" value="phrase"> Phrase Search 
<?php 
if ($show_categories!=0) {
$sql = "SELECT * FROM categories ORDER BY category ASC";
$sql_result = mysql_query($sql);

if (mysql_num_rows($sql_result) < 1) {
	//there are no articles, so say so
	
} else {	
	echo " - Or In Category <select name='category'><option value=''>All Categories</option>";
	while ($info = mysql_fetch_array($sql_result)) {
	         $category_id = $info['category_id'];
			 $category = $info['category'];
			 
			echo "<option value='$category_id'>$category</option>";
		   
	}
			echo "</select>";
}}
