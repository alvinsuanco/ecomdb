<?php 

$host = 'db4free.net';
$username = 'alvinecomdb';
$password = 'Vynvhokz@24';
$dbname = 'alvinecom_db';


$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
	die('connection failed: ' . mysqli_error($conn));
}

// echo 'connected succesfully';

 ?>