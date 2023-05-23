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
	<form method='POST' action='linky.php'>
		<table>
			<tr>
				<td>Link</td>
				<td><textarea name="link" cols="128" rows="5" wrap="hard" placeholder="paste your long link here..."></textarea></td>
				<td rowspan="2">
					<table border="1">
						<tr><td>Latest shorties</td><td>Age</td><td>Num Redirects</td></tr>
<?php
include ".config.inc";

$mysqli = new mysqli('127.0.0.1', "$mysql_user", "$mysql_password", "$mysql_schema");
if ($mysqli->connect_errno) {
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
}

$result = $mysqli->query("select * from $mysql_table order by id desc limit 5;");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$sl = $row["shortlink"];
	$age = $row["date_created"];
	$nr = $row["num_redirects"];
	echo "<tr><td><a href=\"./redir.php?loc=$sl\">$sl</a></td><td>$age</td><td>$nr</td></tr>";
   }
} else {
    echo "<tr><td>0</td><td>results</td></tr>";
}
$mysqli->close();
?>
					</table>
				</td>
			</tr>
			<tr>
				<td>Expiry:</td>
				<td>
					<select>
						<option value="300" selected>5 min</option>
						<option value="3600">1 hour (j/k, not implemented)</option>
						<option value="86400">1 day (j/k, not implemented)</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" value="submit">
				</td>
			</tr>

		</table>
	</form>


<?php


?>


</body>
</html>
