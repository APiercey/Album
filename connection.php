<?php
//making use of CONSTANTS
define("DB_SERVER","localhost" );
define("DB_USER","PHPSCRIPT" );
define("DB_PASS","1234" );
define("DB_NAME", "Album");
//global $connection;

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

//test if connection occured.
if(mysqli_connect_errno()){
	die("Database connection failed: " . mysqli_connect_error() . 
	"(" . mysqli_connect_errno() . ")");}
?>