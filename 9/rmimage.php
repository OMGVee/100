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
<?php
include ".config.inc";
$debug=1;

$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
	echo "Error: " . $mysqli->connect_error . "\n";
	exit;
}

$image_id = $_REQUEST['image_id'];
$board_id = $_REQUEST['board_id'];
if (empty($image_id) || empty($board_id)) {
	echo "got incomplete information, can't save!";
	echo "Please go <a href=\"./vbp.php\">BACK</a>";
	exit;
}
$image_id = htmlspecialchars($mysqli->real_escape_string($image_id));
$board_id = htmlspecialchars($mysqli->real_escape_string($board_id));
if (!is_numeric($image_id) || !is_numeric($board_id)) { echo "somehow we didn't get a number... a team of highly trained monkeys has been dispatched to solve this issue, come back later"; die(); }


if ($debug==1) {
	echo "image_id:$image_id<br>board_id:$board_id<br>";
}

$assoc_result = $mysqli->query("delete from $mysql_assoc_table where image_id=$image_id and board_id=$board_id;");
if (!$assoc_result) {
        echo $mysqli->error;
}
			echo "done removing image_id: $image_id from board_id: $board_id.<br>";
		echo "<hr><a href='./vbp.php?id=$board_id'>REFRESH</a>";



echo ("<table style='border:1px solid black;margin-left:auto;margin-right:auto;'><tr>");
$mysqli->close();
die();
?>
</body>
</html>
