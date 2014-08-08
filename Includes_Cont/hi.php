<?php
session_start();
$_SESSION['hi']='hi';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>USIS</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css">
</head>

<body>

gggg</body>
<?php

echo($_SESSION['hi']);
?>