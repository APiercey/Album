<?php
define("THUMBNAIL_WIDTH", 60);
define("THUMBNAIL_HEIGHT", 40);
define("IMAGE_WIDTH", 600);
define("IMAGE_HEIGHT", 400);

function formatImage($filePath) {
	$sourceImage = null;
	
	$destinationImage = imagecreatetruecolor(
							IMAGE_WIDTH, 
							IMAGE_HEIGHT        
						);
	echo $filePath;
	if(preg_match("/[.][j][p][g]/", $filePath))		$sourceImage = imagecreatefromjpeg($filePath);
	elseif(preg_match("/[.][p][n][g]/", $filePath))	$sourceImage = imagecreatefrompng($filePath);
	elseif(preg_match("/[.][g][i][f]/", $filePath))	$sourceImage = imagecreatefromgif($filePath);

	$sourceImageInfo = getimagesize($filePath);
	$newWidth = IMAGE_WIDTH;
	$newHeight = IMAGE_HEIGHT;

	if($sourceImageInfo[0] > IMAGE_WIDTH || $sourceImageInfo[1] > IMAGE_HEIGHT) {
		if($sourceImageInfo[0] > $sourceImageInfo[1]) {
			$newHeight = $sourceImageInfo[1] * (IMAGE_WIDTH / $sourceImageInfo[0]);
		}
		else {
			$newWidth = $sourceImageInfo[1] * (IMAGE_HEIGHT / $sourceImageInfo[2]);
		}
	}

	$destinationImage = imagecreatetruecolor($newWidth, $newHeight);
	if( imagecopyresized(
			$destinationImage,
			$sourceImage, 
			0, 0, 
			0, 0, 
			$newWidth, $newHeight, 
			$sourceImageInfo[0], $sourceImageInfo[1]
		)
	) {
		$tempImage = imagecreatetruecolor(IMAGE_WIDTH, IMAGE_HEIGHT);
		if( imagecopyresampled(
				$tempImage, $destinationImage,
				0, 0, 
				(($newWidth - IMAGE_WIDTH) / 2), (($newHeight - IMAGE_HEIGHT) / 2), 
				IMAGE_WIDTH, IMAGE_HEIGHT, 
				IMAGE_WIDTH, IMAGE_HEIGHT)
		) {
			if($sourceImageInfo[2] == IMAGETYPE_JPEG) 	imagejpeg($tempImage, $filePath, 100);
			elseif($sourceImageInfo[2] == IMAGETYPE_PNG) imagepng($tempImage, $filePath);
			elseif($sourceImageInfo[2] == IMAGETYPE_GIF) imagegif($tempImage, $filePath);
		}
		
	}	
}
function createThumbnail($sourcePath, $destPath) {

	$thumbnail = imagecreatetruecolor(THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);

	$sourceImage = null;
	if(preg_match("/[.][j][p][g]/", $sourcePath))		$sourceImage = imagecreatefromjpeg($sourcePath);
	elseif(preg_match("/[.][p][n][g]/", $sourcePath))	$sourceImage = imagecreatefrompng($sourcePath);
	elseif(preg_match("/[.][g][i][f]/", $sourcePath))	$sourceImage = imagecreatefromgif($sourcePath);

	imagecopyresized(
		$thumbnail, $sourceImage, 
		0, 0, 
		0, 0, 
		THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT, 
		IMAGE_WIDTH, IMAGE_HEIGHT);

	if(preg_match("/[.][j][p][g]/", $sourcePath))		imagejpeg($thumbnail, $destPath, 100);
	elseif(preg_match("/[.][p][n][g]/", $sourcePath))	imagepng($thumbnail, $destPath);
	elseif(preg_match("/[.][g][i][f]/", $sourcePath))	imagegif($thumbnail, $destPath);
}
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