<?php 
$protected = true;
include 'header.php';

$largePicture = null;

if( isset($_GET['pictureid']) ) {

	$largePicture = $user->getPicture($_GET['pictureid']);
}
else {
	$largePicture = $user->getPicture(1);
}
var_dump($largePicture);
?>
<div class="albumHead">
	<h2><?php echo $user->getName(); ?>'s Album</h2>
	<h3>The Grand Canyon Aerial View</h3>
</div>
<div class="imageInfo">
	<?php 
	if($largePicture) {

		echo "<img src='".$largePicture->getLargeImage()."' alt='".$largePicture->getTitle()."' title='".$largePicture->getTitle()."'>";
	}
	else {

		echo "<h3 class='error'>You have not uploaded any pictures yet!</h3>";
	}
	?>
	
	<p>
    <?php
	if($largePicture) {
		$largePicture->getDescription();
	}
	?>
</p>
</div>
<div class="thumbnails">
	<?php 
		$pictures = $user->getPictures(0, 7);
		foreach ($pictures as $picture) {

			echo "<a href='myalbum.php?pictureid=".$picture->getPictureID()."'><img src='".$picture->getThumbnail()."' alt='".$picture->getTitle()."' title='".$picture->getTitle()."'></a>";
		}
	?>

</div>
<div class="thumbnailsFooter">
	<span class="prev"><a href="myalbum.php?action=prev" title="Previous thumbnails">&#60; Prev</a></span>
	<span class="thumbnailInfo">Displaying 1 to 7 of 21 thumbnails</span>
	<span class="next"><a href="myalbum.php?action=next" title="Next thumbnails">Next &#62; </a></span>
</div>
<?php include 'footer.php'; ?>