<?php
include ".config.inc";

$shortlink = $_REQUEST['id'];

$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
}

/* todo: some validation/sanitization of this input is a good idea */
$shortlink = htmlspecialchars($mysqli->real_escape_string($shortlink));

$result = $mysqli->query("select * from $mysql_table where shortlink='$shortlink'");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
   	echo $row["paste"];     
   }
} else {
    echo "0 results";
}
$mysqli->close();



?>
