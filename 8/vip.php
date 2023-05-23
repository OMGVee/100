<?php
include ".config.inc";


$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
	echo "Error: " . $mysqli->connect_error . "\n";
	exit;
}

$item = $_REQUEST['item'];
if (empty($item)) {
	echo "no item supplied... you rascal<br>";
	echo "Please go <a href=\"./index.php\">BACK</a> and just click on existing links, you don't have to input anything in this app";
	exit;
}
$item = htmlspecialchars($mysqli->real_escape_string($item));
if (!is_numeric($item)) { echo "somehow we didn't get a number... a team of highly trained monkeys has been dispatched to solve this issue, come back later"; die(); }


$result = $mysqli->query("select * from $mysql_table where id=$item;");
if (!$result) {
        echo $mysqli->error;
}

if ($result->num_rows > 0) {
	echo "<h3>you've requested to see item <strong>$item</strong></h3><hr/>";
	echo "<table border=1>";
        echo "<tr><td>id</td><td>title</td><td>content</td><td><strong># of views</strong></td></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $title = $row["title"];
        $content = $row["content"];
        $views = $row["views"];
        echo "<tr><td><a href=\"vip.php?item=$id\">$id</a></td><td>$title</td><td>$content</td><td><strong>$views</strong></td></tr>";
   }
	echo "</table>";
} else {
    echo "<tr><td>no data</td></tr>";
}

$result = $mysqli->query("update $mysql_table set views = views + 1 where id = '$item';");
if (!$result) {
        echo $mysqli->error;
}

$mysqli->close();

echo "<br><a href=\"./index.php\">BACK</a>";
$mysqli->close();
die();
?>
