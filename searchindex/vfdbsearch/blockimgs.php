<?php
$settings_dir = "../settings";
include "$settings_dir/db_admin.php";
$url=$_GET["q"];
$blockedsql = "INSERT INTO ".$mysql_table_prefix."removedimgs (url) VALUES ('$url')";
$blockedresult = mysql_query($blockedsql);
echo "<b>Banned</b>";

?>