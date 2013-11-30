<?php 
$protected = true;
include 'header.php';

$user->loadPictures();
$largePicture = null;

if( isset($_GET['pictureid']) ) {

	$largePicture = $user->getPicture($_GET['pictureid']);
	
}

if($largePicture == null || $largePicture == false) {

	$largePicture = $user->getPicture("first");
}

?>

<div class="albumHead">
	<h2><?php echo $user->getName(); ?>'s Album</h2>
	<h3><?php if($largePicture) echo $largePicture->getTitle(); ?></h3>
</div>
<div class="imageInfo">
	<?php 
	if($largePicture) {

		echo "<img src='".$largePicture->getLargeImage()."' alt='".$largePicture->getTitle()."' title='".$largePicture->getTitle()."'>";
	}
	else {

		echo "<h3 class='error'>You have not uploaded any pictures yet or that picture doesn't exist!</h3>";
	}
	?>
	
	<p>
    <?php
	if($largePicture) {
		
		echo $largePicture->getDescription();
	}
	?>
</p>
</div>

<div class="thumbnails">
	<?php 
		$index = 0;
		$amount = 7;
		if( isset($_GET['index']) ) {

			$index = $_GET['index'];
		}
		$pictures = $user->getPictures($index, $amount);
		foreach ($pictures as $picture) {

			echo "<a href='myalbum.php?pictureid=".$picture->getPictureID()."&index=".$index."'><img src='".$picture->getThumbnail()."' alt='".$picture->getTitle()."' title='".$picture->getTitle()."'></a>";
		}
	?>
	<div class="thumbnailsFooter">
		<?php
		$getVars = "";
		if ( isset($_GET['pictureid']) ) {
			$getVars .= "&pictureid=".$_GET['pictureid'];
		}
		?>
		<?php
		if($index > 0) {

			echo '<span class="prev"><a href="myalbum.php?index='.($index - $amount).$getVars.'" title="Previous thumbnails">&#60; Prev</a></span>';
		}
		?>
		
		
		<?php 
		if($index + $amount <= $user->numOfPictures()) {

			echo '<span class="next"><a href="myalbum.php?index='.($index + $amount).$getVars.'" title="Next thumbnails">Next &#62; </a></span>';
		}
		?>
		<span class="thumbnailInfo"><?php echo "Displaying ".($index + 1)." to ".($index + count($pictures))." of ".$user->numOfPictures()." total thumbnails."; ?></span>
	</div>
</div>
<?php include 'footer.php'; ?>