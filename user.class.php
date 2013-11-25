<?php

/*
This is the file for the user class

*/
class User 
{

	private $userID;
	private $name;
	private $pictures;

	function __construct($userID, $name)
	{
		$this->userID = $userID;
		$this->name = $name;
		$this->pictures = array();

		$this->loadPictures();
	}

	public function getName()
	{
		return $this->name;
	}
	public function getUserID()
	{
		return $this->userID;
	}
	public function getPictures($index, $amount)
	{
		$smallPicturesList = array();

		if($index < 0) {

			$index = 0;
		}

		for ($i = $index; $i < $amount; $i++) { 
			
			if($index + $amount > count($this->pictures)) {
				break;
			}

			$smallPicturesList[] = $this->pictures[$index];
		}

		return $smallPicturesList;
	}
	public function loadPictures()
	{
		$conn = mysqli_connect('localhost', 'PHPSCRIPT', '1234', 'Album');

		if($conn) {
			
			$query = "SELECT * FROM picture WHERE ownerid = '" . $this->userID . "'";

			$result = $conn->query($query) or die("error" . mysqli_errno($conn));
			
			while( $row = $result->fetch_assoc() ) {

				$this->pictures[] = new Picture($row["pictureID"], $row["title"], $row["desc"], $row["fileName"]);
			}
		}

		$conn->close();
	}
}