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
	
	public function loadPictures()
	{
		$this->pictures = array();
		$conn = mysqli_connect('localhost', 'PHPSCRIPT', '1234', 'Album');

		if($conn) {
			
			$query = "SELECT * FROM picture WHERE ownerid = '" . $this->userID . "'";

			$result = $conn->query($query) or die("error" . mysqli_errno($conn));
			
			while( $row = $result->fetch_assoc() ) {

				$this->pictures[] = new Picture($row["PictureId"], $row["Title"], $row["Description"], $row["FileName"]);
			}
		}

		$conn->close();
	}
	public function getPictures($index, $amount)
	{
		$smallPicturesList = array();

		if($index < 0) {

			$index = 0;
		}

		for ($i = $index; ($i < ($index + $amount) && $i < count($this->pictures)); $i++) { 
			
			$smallPicturesList[] = $this->pictures[$i];
		}

		return $smallPicturesList;
	}
	public function getPicture($pictureID) 
	{ 
		$result = false; 
		if( isset($this->pictures[0]) )
		{
			if($pictureID == "first") {
				$result = $this->pictures[0];
			}
			else {

				foreach ($this->pictures as $picture) { 

					if($picture->getPictureID() == $pictureID) { 

						$result = $picture; 
						break; 
					} 
				} 
			}
		}

		return $result; 
	}

	public function numOfPictures()
	{
		return count($this->pictures);
	}
}