<?php

require_once('constants.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


if($conn->connect_error)
{
	die('connection failed:' .$conn->connect->error);

}



?>