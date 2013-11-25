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
	public function getPictureID()
	{
		return $this->pictureID;
	}
	public function getThumbnail()
	{
		return 0;
	}
}
?>