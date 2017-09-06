<!DOCTYPE html>
<html>
<head>
    <title>100 sites in 100 or more days</title>
    <link rel="icon" href="../star.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&amp;subset=latin-ext" rel="stylesheet">
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
<section class="top">
<h1>Day 2: made this navigation menu consistent across days</h1>
<hr>
Created this boilerplate code that I can then include in each day's project, on top<br>
so at least there's _some_ sort of consistency :)<br>
<hr>
but since I haven't done much else, I thought of displaying your computer's IP Address:<br><b><span style="color:red">
<?php
echo $_SERVER["REMOTE_ADDR"];
?>
</b>
</span>

<hr>

Here's what else a website might find out from your browser:<br>
- the User Agent string. Basically - <i><u>what browser</u></i> you're using:<br>
<span style="color:blue">
<?php
//print_r($_SERVER);
echo $_SERVER["HTTP_USER_AGENT"]; 
?>
</span>
</section>
<br><br>
if you don't believe me, then double check with <a href="https://icanhazip.com/">the nice folks at ICanHazIP.com</a>
