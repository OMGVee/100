<?php
//this is the script called by a cronjob every minute
// here's how the cronjob should look like:
// */1 * * * * cd /path/to/directory/where/cleanup/script/and/.config.inc/exist; php cleanup.php >> cleanup.log
include ".config.inc";
$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
}
$result = $mysqli->query("delete from $mysql_table where date_created < (now() - interval 5 minute);");
if ( !$result ) die('Database Error: '.$mysqli->error);
print_r($result);

$mysqli->close();
?>
