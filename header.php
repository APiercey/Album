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
	<link rel="stylesheet" href="css/style.css">
	<meta charset="UTF-8">
	<title><?php if( isset($title) ) echo trim($title)." - MyAlbum Application"; else echo "MyAlbum Application"; ?></title>
	<script type="text/javascript">

		function popup()
		{
			window.open("UploadImage.php", "UploadImage", "status=0,location=0,menubar=0,toolbar=0,resizable=0,scrollbars=0,width=680,height=400");
	        return false;
		}
	</script>
</head>
<body>

	<header>
		<div class="title">MyA<span class="kern">l</span><span class="nokern">b</span>um</div>
		<nav>
			<ul>
				<?php
				if( $user != null ) {

					echo '<li><a href="logout.php">Logout</a></li>';
					echo '<li><a href="myalbum.php">My Album</a></li>';
					echo '<li><a href="#" onclick="popup()">Upload Picture</a></li>';
				}
				else {

					echo '<li><a href="login.php">Login</a></li>';
					echo '<li><a href="registration.php">Register</a></li>';
				}
				?>
			</ul>
		</nav>
	</header>
	<div class="wrapper">
	
<?php 
if( isset($protected) ) {
	
	if($protected & $user == null) {
		echo "You must be logged in to view this page.";
		include 'footer.php';
		die();
	}
}
