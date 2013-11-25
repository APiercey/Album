<?php
include 'header.php';

define("ORIGINAL_IMAGE_DESTINATION", "./original"); 
define("IMAGE_DESTINATION", "./images"); 
define("IMAGE_MAX_WIDTH", 600);
define("IMAGE_MAX_HEIGHT", 400);
define("THUMB_DESTINATION", "./thumbnails");  
define("THUMB_MAX_WIDTH",60);
define("THUMB_MAX_HEIGHT",40);

$error = "";

$supportedImageTypes = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

include "functionResizeimage.php";

if (isset($_POST['btnUpload']) ) 
{
	if ($_FILES['txtUpload']['error'] == 0 && $_FILES['txtUpload']['error'] == 0)
	{
		$destination = ORIGINAL_IMAGE_DESTINATION;  	// define the path to a folder to save the file

		if (!file_exists($destination))
		{
			mkdir($destination);
		}
		
		$fileTempPath = $_FILES['txtUpload']['tmp_name'];
		$filePath = $destination."/".$_FILES['txtUpload']['name'];
		
		$pathInfo = pathinfo($filePath);
		$dir = $pathInfo['dirname'];
		$fileName = $pathInfo['filename'];
		$ext = $pathInfo['extension'];
		
		$i="";
		while (file_exists($filePath))
		{	
			$i++;
			$filePath = $dir."/".$fileName."_".$i.".".$ext;
		}
		if(move_uploaded_file($fileTempPath, $filePath)) {

			$description = mysqli_real_escape_string($connection, $_POST['Description']);
			$query = "INSERT INTO picture (OwnerID, FileName, Title, Description) VALUES (".$user->getUserID().", '".$_FILES['txtUpload']['name']."', '".$_POST['Title']."', '".$description."')";
			$connection->query($query) or die("error" . mysqli_errno($connection) . $query);
			$user->loadPictures();
		}
		
	}
	$imageDetails = getimagesize($filePath);
		
	if ($imageDetails && in_array($imageDetails[2], $supportedImageTypes))
	{
		resamplePicture($filePath, IMAGE_DESTINATION, IMAGE_MAX_WIDTH, IMAGE_MAX_HEIGHT);
		
		resamplePicture($filePath, THUMB_DESTINATION, THUMB_MAX_WIDTH, THUMB_MAX_HEIGHT);
	}
	elseif ($_FILES['txtUpload']['error'][$j]  == 1)
	{			
		echo "$fileName is too large<br/>";
	}
	elseif ($_FILES['txtUpload']['error'][$j]  == 4)
	{
		echo "No upload file specified<br/>"; 
	}
	else
	{
		echo "Error happened while uploading the file(s). Try again late<br/>"; 
	}
}

?>
<h3>Upload your Picture(accepted picture types: JPEG, GIF, PNG)</h3>
<form action='UploadImage.php' method='post' enctype="multipart/form-data">
  <table>
    		<tr>
				<td class='input' width="190" align="right"><label for="file">File To Upload</label> </td>
				<td width="144"> <input type="file" name="txtUpload" id="txtUpload"  size="40" /></td>
			</tr>
            <tr>
				<td class='input' width="190" align="right">Title</td>
                <td width="144"><input type = "text" name = "Title"  /></td>
                
			</tr>
            <tr>
				<td class='input'align="right">Description</td>
				<td><TEXTAREA name = "Description" ROWS=2 COLS=20></TEXTAREA></td>
			</tr>
			<tr>
				<td ><input type='submit' class='button' name='btnUpload' value='Upload' /></td>&nbsp;&nbsp;
					<td><input type='submit' class='button' name='btnDone' value='Done' /></td>
     </tr>
	</table>
	<br/>
</form>
<?php include 'footer.php'; ?>