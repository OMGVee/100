<!DOCTYPE html>
<html>
<head>
    <title>100 sites in 100 or more days</title>
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
<header>
                <ul class="nav">
                        <li><a href="https://evervee.me/contact/" target="blank">contact</a></li>
                        <li><a href="https://github.com/OMGVee/100" target="blank">code</a></li>
                        <li><a href="https://evervee.me/challenges/hustles/100-sites-100-days-300-days-something/" target="blank">blog</a></li>
                        <li><a href="../">home</a></li>
                </ul>
</header>
<body>
<h1>Image Board (Pinterest Clone)</h1>
<form method='POST' action='vip.php'>
<p>Here are some images, and boards. Try 'pinning' some of the loose images to some boards...
by clicking on each image to view it separately, and pick a board to add it to.</p>
<p style="color:red">(cleanup every 5 minutes, data gets reset)</p>
<?php
include ".config.inc";


$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
}
//begin images
echo "<h3><u>IMAGES</u> (newest first)</h3>";
echo "<table border=0>";
$image_result = $mysqli->query("select * from $mysql_images_table order by id desc;");

if ($image_result->num_rows > 0) {
        //echo "<tr><td>id</td><td>title</td><td><strong># of views</strong></td></tr>";
    // output data of each row
    echo "<table border=0><tr>";
    while($row = $image_result->fetch_assoc()) {
    echo "<td>";
        $image_id = $row["id"];
        $image_title = $row["image_title"];
        $image_path = $row["image_path"];
	$image_desc = $row["image_description"];
	echo("<table border=0>
		<tr><td>$image_id</td><td><a href='./vip.php?id=$image_id'>$image_title</a></td></tr>
		<tr><td colspan=2><a href='./vip.php?id=$image_id'><img src='$image_path/$image_title' width=120 height=150></a></td></tr>
		<tr><td colspan=2>$image_desc</td></tr>
	      </table>");
    echo "</td>";
    }
    echo "</tr></table>";
} else {
    echo "<tr><td>no data</td></tr>";
}

echo "</table>";
//end images


//begin boards
echo "<h3><u><strong>BOARDS</strong></u> (no new pins in Inactive boards)</h3>";
$board_result = $mysqli->query("select * from $mysql_boards_table;");
echo "<table border=2>";
if ($board_result->num_rows > 0) {
        //echo "<tr><td>id</td><td>title</td><td><strong># of views</strong></td></tr>";
    // output data of each row
    while($boardrow = $board_result->fetch_assoc()) {
        $board_id = $boardrow["id"];
        $board_status = $boardrow["status"];
        $board_name = $boardrow["name"];
	$board_url = $boardrow["board_url"];
	$board_desc = $boardrow["board_description"];

	echo "<tr><td>";

	echo("<table border=1>
		<tr><td>$board_id</td><td><a href='$board_url$board_id'>$board_name</a></td><td> -$board_desc-</td><td>:$board_status:</td>");
//iterate over images of a board and put them in cells
// <td>a</td>
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
					echo ("<td><a href='./vip.php?id=$image_id'><img src='$image_path/$image_title' width=50 height=50></a></td>");
					
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




//end boards
?>

</form>
</body>
</html>
