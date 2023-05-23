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
<form method=POST action='rmimage.php'>
<?php
include ".config.inc";

$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
	echo "Error: " . $mysqli->connect_error . "\n";
	exit;
}

$board_id = $_REQUEST['id'];
if (empty($board_id)) {
	echo "no item supplied... you rascal<br>";
	echo "Please go <a href=\"./index.php\">BACK</a> and just click on existing links, you don't have to input anything in this app";
	exit;
}
$board_id = htmlspecialchars($mysqli->real_escape_string($board_id));
if (!is_numeric($board_id)) { echo "somehow we didn't get a number... a team of highly trained monkeys has been dispatched to solve this issue, come back later"; die(); }

echo "<input type=hidden name=board_id value=$board_id>";

$board_result = $mysqli->query("select * from $mysql_boards_table where id=$board_id;");
echo "<table border=2 style='margin-left:auto; margin-right:auto;'>";
if ($board_result->num_rows > 0) {
    while($boardrow = $board_result->fetch_assoc()) {
        $board_id = $boardrow["id"];
        $board_status = $boardrow["status"];
        $board_name = $boardrow["name"];
        $board_url = $boardrow["board_url"];
        $board_desc = $boardrow["board_description"];
        echo "<tr><td>";
        echo("<table border=1 style='margin-left:auto;margin-right:auto;'>
                <tr><th>$board_id</th><th><a href='$board_url$board_id'>$board_name</a></th><th style='font-size:32px;'><strong><u>$board_desc</u></strong></th><th>status:$board_status</th>");
        $boardimages_result = $mysqli->query("select * from $mysql_assoc_table where board_id=$board_id;");
        //var_dump($boardimages_result);
        if ($boardimages_result->num_rows > 0) {
                while ($imgsrow = $boardimages_result->fetch_assoc()) {
                        $image_id=$imgsrow["image_id"];
                        //echo "imageID:" . $image_id;
                        //go to images table and grab the path and the name, to be able to compose an <img src> out of those to display the images in cells
                        $tinyimages_result = $mysqli->query("select * from $mysql_images_table where id=$image_id;");
                        if ($tinyimages_result->num_rows > 0) { 
                                while ($imgrow = $tinyimages_result->fetch_assoc()) {
                                        $image_path=$imgrow["image_path"];
                                        $image_title=$imgrow["image_title"];
                                        echo ("<tr><td colspan=3 align=center><a href='./vip.php?id=$image_id'><img src='$image_path/$image_title' width=200 height=200></a></td>");
					echo "<input type=hidden name=image_id value=$image_id>";
					echo "<td><input type=submit name=submit value='UnPin!'</td>";
					echo "</tr>";
                                }
                        }
                }
        }
        echo("</tr>
              </table>");
    }
} else {
    echo "no data>";
}


echo("</tr></table></form>");

echo "<br><a href=\"./index.php\">BACK</a>";
$mysqli->close();
die();
?>
</form>
</body>
</html>
