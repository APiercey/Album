<?php
function mysql_prep($string){
	global $connection;
	
	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
	}

function validateEmail($email)
{
	$validEmailExpr = "^[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*" .
"@[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*$^";

  if ($email == "")
  {
		return "Email can not be blank";
  }		
  elseif($email !== "" and !preg_match($validEmailExpr, $email))
  {
    return  "The email address must be in the name@domain format.";
  }
  elseif($email !== "" and strlen($email) > 50)
  {
   return  "The email address can be no longer than 50 characters.";
  }
  elseif ($email !== "" and !(getmxrr(substr(strstr($email, '@'), 1), $temp)) ||
  checkdnsrr(gethostbyname(substr(strstr($email, '@'), 1)),"ANY"))
  {
       return "The domain does not exist."; 
  }
  else
  {
		return "";
  }
}


function validateName($name)
{
	if ($name == "")
	{
		return "Name can not be blank";
	}
	else
	{
		return "";
	}
}

function validatePassword($password)
{
	$upperCaseRegex = "/[A-Z]/";
	$lowerCaseRegex = "/[a-z]/";
	$numericRegex = "/[0-9]/";
	$nonAlphnumericRegex = "/\W|_/";
	
	if ($password == "")
	{
		return "Password can not be blank";
	}
	elseif (strlen($password) < 6)
	{
		return "Need at least 6 characters long";
	}
	elseif(!preg_match($upperCaseRegex, $password))
	{
		return "Need at least one upper case letter";
	}
	elseif(!preg_match($lowerCaseRegex, $password))
	{
		return "Need at least one lower case letter";
	}
	elseif(!preg_match($numericRegex, $password))
	{
		return "Need at least one numeric character";
	}
	elseif(!preg_match($nonAlphnumericRegex, $password))
	{
		return "Need at least one non-alphanumeric character";
	}
	else
	{
		return "";
	}
}
function validatePassword2($password, $password2)
{
	if ($password2 == "")
	{
		return "Re-Enter Password can not be blank.";
	}
	elseif ($password != $password2)
	{
		return "Passwords do not match.";
	}
	else
	{
		return "";
	}
}
?>