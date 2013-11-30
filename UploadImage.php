<?php
include 'user.class.php';
include 'picture.class.php';
include 'connection.php';
include 'functions.php';

session_start();

$user = null;
if(isset($_SESSION['user'])) {

	$user = $_SESSION['user'];	
}
if($user == null) {

	echo "You must be logged in to view this page.";
	include 'footer.php';
	die();
}

define("ORIGINAL_IMAGE_DESTINATION", "./original/"); 
define("IMAGE_DESTINATION", "./images/"); 
define("THUMB_DESTINATION", "./thumbnails/");

$supportedImageTypes = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

$msg = "";

if (isset($_POST['btnUpload']) ) 
{
	if( !$_FILES['txtUpload']['error'] > 0 ) {

		if( $_FILES['txtUpload']['type'] == "image/gif"
		 || $_FILES['txtUpload']['type'] == "image/png" 
		 || $_FILES['txtUpload']['type'] == "image/jpeg" ) {

			if( $_FILES['txtUpload']['size'] < 2000000 ) {

				$imageNameInfo = explode('.', $_FILES['txtUpload']['name']);
				$newName = $_FILES['txtUpload']['name'];
				$i = 0;
				while( file_exists( IMAGE_DESTINATION.$newName ) ) {
				
					$newName = $imageNameInfo[0].'_'.$i.$newName[1];
				} 

				if(	move_uploaded_file( $_FILES['txtUpload']['tmp_name'], IMAGE_DESTINATION.$newName)) {

					$msg = $_FILES['txtUpload']['name']." uploaded successfully!";
					formatImage(IMAGE_DESTINATION.$_FILES['txtUpload']['name']);
					createThumbnail(IMAGE_DESTINATION.$_FILES['txtUpload']['name'],
									THUMB_DESTINATION.$_FILES['txtUpload']['name']);

					$description = mysqli_real_escape_string($connection, $_POST['Description']);
					$query = "INSERT INTO picture (OwnerID, FileName, Title, Description) VALUES (".$user->getUserID().", '".$_FILES['txtUpload']['name']."', '".$_POST['Title']."', '".$description."')";
					$connection->query($query) or die("error" . mysqli_errno($connection) . $query);
					
				} else {
					$msg = "Unknown error uploading ".$_FILES['txtUpload']['name'];
				}
			} else {
				$msg = "Error uploading ".$_FILES['txtUpload']['name'].": you
				can only upload files that are smaller than 20mb.";
			}
		} else { 
			$msg = "Error uploading ".$_FILES['txtUpload']['name'].": you 
			can only upload images of the file types: GIF,PNG JPEG."; 
		}
	} else {
		$msg = "Error: no file selected";
	}
}

?>
<h3>Upload your Picture(accepted picture types: JPEG, GIF, PNG)</h3>
<?php if($msg != "") echo "<h3>$msg</h3>"; ?>
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
			<td></td>
			<td><input type='submit' name='btnUpload' value='Upload' /><input type='submit' name='btnDone' value='Done' onclick='uploadFinish()'/></td>
		</tr>
	</table>
</form>
<script type="text/javascript">
	function uploadFinish()
	{
		opener.location="MyAlbum.php";
		close();
	}
</script>