<?php
include 'user.class.php';
include 'picture.class.php';
include 'connection.php';
include 'functions.php';
session_start();

if( isset($_SESSION['user'])) {
	$user = $_SESSION['user'];	
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<nav>
		<ul>
			<li><a href="">login</a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
		</ul>
	</nav>