<?php
	include 'header.php';

	extract($_POST);
	
	$valid = false;
	$emailErrorMsg = '';
	$nameErrorMsg = '';
	$passwordErrorMsg = '';
	$rePasswordErrorMsg = '';
	
	if(isset($btnRegister))
	{
		$emailErrorMsg = validateEmail(trim($txtEmail)); 
		if($emailErrorMsg != "")
		{
			$valid = true;
		}
		$nameErrorMsg = validateName(trim($txtName));
		if($nameErrorMsg != "")
		{
			$valid = true;
		}
		$passwordErrorMsg = validatePassword(trim($txtPassword));
		if($passwordErrorMsg != "")
		{
			$valid = true;
		}
		$rePasswordErrorMsg = validatePassword2($txtrepassword, $txtPassword);
		if( $rePasswordErrorMsg != "" )
		{
			$valid = true;
		}
		
		if (!$valid)
		{
			
			$hash = sha1($txtPassword);
			$insertUser = "INSERT INTO User (Email, Name, Password) VALUES('$txtEmail', '$txtName', '$hash')";
								
			if (mysqli_query($connection, $insertUser))
			{
				
				$result = mysqli_query($connection, "SELECT * FROM User WHERE Email = '$txtEmail' AND Password = '$hash'") or die(mysql_error());
				
				while($row = mysqli_fetch_assoc($result)) {

					$_SESSION['user'] = new User($row['UserId'], $row['Name']);
				}

				if(isset($_SESSION['user'])) {
					header("Location: myalbum.php");
					mysqli_close($connection);
					exit();	
				}
							
			}
			else
			{
				echo "That username has already been taken.";
			}
		}
	}
	if(isset($txtEmail))
	{
		$email  = $txtEmail;
	}
	else
	{
		$email = '';
	}
	if(isset($txtName))
	{
		$name  = $txtName;
	}
	else
	{
		$name = '';
	}
	if(isset($txtPassword))
	{
		$password  = $txtPassword;
	}
	else
	{
		$password = '';
	}
	if(isset($txtrepassword))
	{
		$repassword  = $txtrepassword;
	}
	else
	{
		$repassword = '';
	}
	
	
	
?>

<h3>To start, please enter the required registration data</h3>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table width="486">
    <tr>
      <th><label for="txtEmail"  >Email :</label></th>
      <td><input type="text" name="txtEmail" id="txtEmail" value="<?php echo $email ?>" /></td>
      <td style='color:Red'><?php echo $emailErrorMsg; ?></td>
    </tr>
    <tr>
      <th><label for="txtName" align="left">Name :</label></th>
     <td><input type="text" name="txtName" id="txtName" value="<?php echo $name ?>" /></td>
     <td style='color:Red'><?php echo $nameErrorMsg; ?></td>
    </tr>
     <tr>
      <th><label for="txtPassword" align="right">Create Password :</label></th>
     <td><input type="password" name="txtPassword" id="txtPassword"  value="<?php echo $password ?>"/></td>
     <td style='color:Red'><?php echo $passwordErrorMsg; ?></td>
    </tr>
    <tr>
      <th><label for="txtrepassword" align="right">Re-enter Password :</label></th>
      <td><input type="password" name="txtrepassword" id="txtrepassword" value="<?php echo $repassword ?>" /></td>
      <td style='color:Red'><?php echo $rePasswordErrorMsg; ?></td>
     </tr>
    <tr>
      <td> <input type="submit" name="btnRegister" id="btnRegister" value="Register" /></td>
      <td><input type="reset" name="btnReset" id="btnReset" value="Reset" /></td>
    </tr>
  </table>
</form>

<?php include 'footer.php'; ?>