<?php
include ".config.inc";


$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
	echo "Error: " . $mysqli->connect_error . "\n";
	exit;
}

$url = $_REQUEST['link'];
if (empty($url)) {
	echo "You supplied no text in the URL field.<br>";
	echo "Please go <a href=\"./index.php\">BACK</a> and type or paste something in the field and hit Submit";
	exit;
}
$url = htmlspecialchars($mysqli->real_escape_string($url));

$rand = substr(md5(microtime()),rand(0,26),5);

if ($mysqli->query("INSERT into $mysql_table (url, shortlink) VALUES ('$url','$rand')")) {
    printf("%d Row inserted.</br>", $mysqli->affected_rows);
}


echo "<hr>$url:<strong>". $shortlink ."</strong><hr>" ;



echo "Permalink is <a href=\"https://100.evervee.me/7/redir.php?loc=$rand\">https://100.evervee.me/7/redir.php?loc=$rand</a>";
echo "<br><a href=\"./index.php\">BACK</a>";
$mysqli->close();

?>
