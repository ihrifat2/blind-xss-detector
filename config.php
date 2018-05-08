<?php

set_error_handler("databaseError",E_ALL);
function databaseError($errno, $errstr)
{
	echo "<center><p class='has-text-danger is-size-3'>No Database Connection.";
	die();
}

$host = "localhost";
$db = "bxss";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database");

?>