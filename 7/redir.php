<?php
include ".config.inc";
$loc = htmlspecialchars($_REQUEST['loc']);
if (empty($loc)) {
	echo "You supplied no text in the URL field : (loc).<br>";
        echo "Please go <a href=\"./index.php\">BACK</a> and type or paste something in the field and hit Submit";
        exit;
}
$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
}

$result = $mysqli->query("select * from $mysql_table where shortlink = \"$loc\";");

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$url = $row["url"];
   }
} else {
    echo "this shortlink contains no URL";
}

$result = $mysqli->query("update $mysql_table set num_redirects = num_redirects + 1 where shortlink = '$loc';");
if (!$result) {
	echo $mysqli->error;
}
header("Location:$url");

$mysqli->close();
die();
?>
