<?php 
include 'header.php';

$largePicture = null;

if( isset($_GET['pictureid']) ) {

	$largePicture = $user->getPicture($_GET['pictureid']);
}
else {
	$largePicture = $user->getPicture(1);
}

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
	
	<p>The extreme north of Greenland, Peary Land, is not
	covered by an ice sheet, because the air there is too
	dry to produce snow, which is essential in the production
	and maintenance of an ice sheet. If the Greenland ice 
	sheet were to melt away completely, the world's sea level
	would rise by more than 7 m (23 ft).

	In 2007 the existence of a new island was announced. Named
	"Uunartoq Qeqertaq" (English: Warming Island), this island
	has always been present off the coast of Greenland, but was
	covered by a glacier. This glacier was discovered in 2002
	to be shrinking rapidly, and by 2007 had completely melted
	away, leaving the exposed island. The island was named 
	Place of the Year by the Oxford Atlas of the World in 2007.
	Ben Keene, the atlas's editor, commented: "In the last 
	two or three decades, global warming has reduced the 
	size of glaciers throughout the Arctic and earlier 
	this year, news sources confirmed what climate scientists
	already knew: water, not rock, lay beneath this ice bridge 
	on the east coast of Greenland. More islets are likely to 
	appear as the sheet of frozen water covering the world's 
	largest island continues to melt".
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