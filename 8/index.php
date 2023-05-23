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
<h3>Self sorting table of contents, based on number of views/interactions.</h3>
<h6>Persistent too... :P</h6>
<form method='POST' action='vip.php'>
<p>Try clicking on the links below and once there, refresh the page in your browser, and watch the Table of Contents self sort based on your repreated views</p>
<?php
include ".config.inc";


$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
}

echo "<table border=0>";
$result = $mysqli->query("select * from $mysql_table order by views desc;");

if ($result->num_rows > 0) {
        echo "<tr><td>id</td><td>title</td><td><strong># of views</strong></td></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $title = $row["title"];
        $content = $row["content"];
        $views = $row["views"];
        echo "<tr><td><a href=\"vip.php?item=$id\">$id</a></td><td>$title</td><td><strong>$views</strong></td></tr>";
   }
} else {
    echo "<tr><td>no data</td></tr>";
}

echo "</table>";


?>

</form>
</body>
</html>
