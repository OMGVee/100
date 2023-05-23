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
$debug=0;

$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
	echo "Error: " . $mysqli->connect_error . "\n";
	exit;
}

$image_id = $_REQUEST['image_id'];
$board_id = $_REQUEST['board_id'];
if (empty($image_id) || empty($board_id)) {
	echo "got incomplete information, can't save!";
	echo "Please go <a href=\"./vip.php\">BACK</a>";
	exit;
}
$image_id = htmlspecialchars($mysqli->real_escape_string($image_id));
$board_id = htmlspecialchars($mysqli->real_escape_string($board_id));
if (!is_numeric($image_id) || !is_numeric($board_id)) { echo "somehow we didn't get a number... a team of highly trained monkeys has been dispatched to solve this issue, come back later"; die(); }


if ($debug==1) {
	echo "image_id:$image_id<br>board_id:$board_id<br>";
}

//check if the image is already associated with the board, and if so, just print "it's already there", and redirect
$assoc_result = $mysqli->query("select * from $mysql_assoc_table where image_id=$image_id and board_id=$board_id;");
if (!$assoc_result) {
        echo $mysqli->error;
}

if ($debug==1) {
	var_dump($assoc_result);
	echo "<hr>". gettype($assoc_result) . "<hr>";
	echo "<hr>". var_dump($assoc_result) . "<hr>";
	echo "<hr>". print_r($assoc_result) . "<hr>";
}


while ($assoc_row = $assoc_result->fetch_assoc()) {
	$assoc_id=$assoc_row["id"]; 
	if ($debug==1) {
		echo "<hr>assoc_id:$assoc_id<hr>";
	}
}
	if (!is_null($assoc_id)) {
		//echo "assoc_id is NOT null";//sleep5, redirect to homepage to pick another image or board
		echo("The image id:<strong>$image_id</strong> that you are trying to associate with board id:<strong>$board_id</strong> is already on that board");
		echo "<hr><a href='./index.php'>HOME</a>";
	} else {
		//echo " # assoc_id is null";//add new association to db, print it out, redirect to homepage
		$active_board = $mysqli->query("select * from $mysql_boards_table where id=$board_id");
		if (!$active_board) { echo $mysqli->error; }
		while ($board_row=$active_board->fetch_assoc()) {
			$board_status=$board_row["status"];
		}
		if ($board_status=='active') {
		$new_assoc = $mysqli->query("insert into $mysql_assoc_table (board_id,image_id) values ($board_id,$image_id);");
		if (!$new_assoc) { echo $mysqli->error; }
		echo "done associating image_id: $image_id with board_id: $board_id.<br>";
		echo "<hr><a href='./index.php'>HOME</a>";
		} else {
			echo "the board you selected is marked 'inactive', and as such no new images will be added to it";
			echo "<hr><a href='./index.php'>HOME</a>";
		}

	}


echo ("<table style='border:1px solid black;margin-left:auto;margin-right:auto;'><tr>");
$mysqli->close();
die();
?>
</body>
</html>
