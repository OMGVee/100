<head>
<link rel="icon" href="../star.png">
    <link rel="stylesheet" href="../style.css"> 
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css?family=Merriweather&amp;subset=latin-ext" rel="stylesheet"> 
<!-- Chrome, Firefox OS and Opera --> 
<meta name="theme-color" content="#ff6600"> 
<!-- Windows Phone --> 
<meta name="msapplication-navbutton-color" content="#ff6600"> 
<!-- iOS Safari --> 
<meta name="apple-mobile-web-app-capable" content="yes"> 
<meta name="apple-mobile-web-app-status-bar-style" content="translucent-black">

</head>
<body>
<form method=POST action='imagetoboard.php'>
<?php
include ".config.inc";


$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
	echo "Error: " . $mysqli->connect_error . "\n";
	exit;
}

$image_id = $_REQUEST['id'];
if (empty($image_id)) {
	echo "no item supplied... you rascal<br>";
	echo "Please go <a href=\"./index.php\">BACK</a> and just click on existing links, you don't have to input anything in this app";
	exit;
}
$image_id = htmlspecialchars($mysqli->real_escape_string($image_id));
if (!is_numeric($image_id)) { echo "somehow we didn't get a number... a team of highly trained monkeys has been dispatched to solve this issue, come back later"; die(); }


$image_result = $mysqli->query("select * from $mysql_images_table where id=$image_id;");
if (!$image_result) {
        echo $mysqli->error;
}
echo ("<table style='border:1px solid black;margin-left:auto;margin-right:auto;'><tr>");
if ($image_result->num_rows > 0) {
    // output data of each row
    while($image_row = $image_result->fetch_assoc()) {
        $image_title = $image_row["image_title"];
        $image_path = $image_row["image_path"];
        $image_description = $image_row["image_description"];
	echo ("<tr><td colspan=3><strong>$image_title</strong> - $image_description</td></tr>");
	echo ("<tr><td colspan=3><img src='$image_path/$image_title' width=640 height=480></td>");
	//dropdown with all boards to pin this image on; we have $image_id in this block/loop
	echo ("<tr><td>Boards:</td><td>");
	$boards_result = $mysqli->query("select * from $mysql_boards_table;");
	if (!$boards_result) {
		echo $mysqli->error;
	}
	if ($boards_result->num_rows > 0) {
		echo("<select name='board_id'>");
		while ($board_row = $boards_result->fetch_assoc()) {
			$board_id = $board_row["id"];
			$board_name = $board_row["name"];
			$board_description = $board_row["board_description"];
			$board_status = $board_row["status"];
			$board_url = $board_row["board_url"];
		echo("<option value='$board_id'>$board_name</option>");
		}
		//put the relevant info as hidden fields to the next page
		echo("<input type='hidden' name='image_id' value='$image_id'>");
		echo("</select></td><td><input type=submit name=submit value='Pin to board!'");
	} else {
		echo "no board data";
	}
   }
} else {
    echo "no image data";
}
echo("</tr></table>");

echo "<br><a href=\"./index.php\">BACK</a>";
$mysqli->close();
die();
?>
</form>
</body>
</html>
