<?php
$title = "Login"; 
include 'header.php';
$msg = "";
extract($_POST);
if( isset($login) ) {

	if(trim($email) == "" ||
	   trim($password) == "") {

		$msg = "Please provide both email address and password";
	}
	else {
		$hash = sha1($password);
		
		$selectUserEmail = "SELECT * FROM User WHERE Email = ? AND Password = ?";
			$selectUserEmailStmt = mysqli_prepare($connection,  $selectUserEmail);	
			mysqli_stmt_bind_param($selectUserEmailStmt,'ss', $email, $hash);
			mysqli_stmt_execute($selectUserEmailStmt);
			mysqli_stmt_bind_result($selectUserEmailStmt, $UserId, $Email, $Name, $Password);
		
		while(mysqli_stmt_fetch($selectUserEmailStmt))
			{ 
			 $_SESSION['user'] = new User($UserId, $Name);
					//$query = "SELECT UserId, Name FROM user WHERE email = '".$email."' AND //password = '".sha1($password)."'";
		//$result = $connection->query($query) or die("error".mysql_errno().": ".$query);
		//echo $result->num_rows;
		//while( $row = $result->fetch_assoc() ) {

			//$_SESSION['user'] = new User($row['UserId'], $row['Name']);
			//var_dump($row);
			header('Location: myalbum.php');
			$connection->close();
			exit;
		}
	}
}
?>
<h2 class="loginHead">Welcome! Please login to MyAlbum</h2>
<h3 class="error"><?php echo $msg; ?></h3>
<form class="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<label for="email">Email:</label><input type="text" name="email">
<label for="password">Password:</label><input type="password" name="password">
<input type="submit" name="login" value="login">

</form>
<?php include 'footer.php'; ?>