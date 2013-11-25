<?php

/*
The file for the picture class
*/

class Picture
{

	private $pictureID;
	private $title;
	private $desc;
	private $fileName;

	public function __construct($pictureID, $title, $desc, $fileName)
	{
		$this->pictureID = $pictureID;
		$this->title = $title;
		$this->desc = $desc;
		$this->fileName = $fileName;
	}

	public function getTitle()
	{
		return $this->title;
	}
	public function getDescription()
	{
		return $this->desc;
	}
	public function getPictureID()
	{
		return $this->pictureID;
	}
	public function getThumbnail()
	{
		return "thumbnails/".$this->fileName;
	}
	public function getLargeImage()
	{
		return "images/".$this->fileName;
	}
}
?>