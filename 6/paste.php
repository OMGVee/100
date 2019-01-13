<?php
include ".config.inc";


$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
	echo "Error: " . $mysqli->connect_error . "\n";
	exit;
}

$paste = $_REQUEST['pasteContent'];
if (empty($paste)) {
	echo "You supplied no text in the paste field.<br>";
	echo "Please go <a href=\"./index.php\">BACK</a> and type or paste something in the field and hit Submit";
	exit;
}
$paste = htmlspecialchars($mysqli->real_escape_string($paste));

$rand = substr(md5(microtime()),rand(0,26),5);

if ($mysqli->query("INSERT into $mysql_table (paste, shortlink) VALUES ('$paste','$rand')")) {
    printf("%d Row inserted.</br>", $mysqli->affected_rows);
}


echo "<hr><strong>". $paste ."</strong><hr>" ;



echo "Permalink is <a href=\"https://100.evervee.me/6/pasteviewer.php?id=$rand\">https://100.evervee.me/6/pasteviewer.php?id=$rand</a>";
echo "<br><a href=\"./index.php\">BACK</a>";
$mysqli->close();

?>
