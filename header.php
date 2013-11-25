<?php
include 'user.class.php';
include 'picture.class.php';
include 'connection.php';
include 'functions.php';

session_start();

$user = null;
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
			<?php 
			if( $user != null ) {

				echo '<li><a href="logout.php">Logout</a></li>';
			}
			else {

				echo '<li><a href="login.php">Login</a></li>';
				echo '<li><a href="registration.php">Register</a></li>';
			}
			?>
			<li><a href="myalbum.php">My Album</a></li>
			<li><a href="uploadimage.php">Upload Picture</a></li>
		</ul>
	</nav>
<?php 
if( isset($protected) ) {
	
	if($protected & $user == null) {
		echo "You must be logged in to view this page.";
		include 'footer.php';
		die();
	}
}
