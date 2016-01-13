<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'savsign';

$link = mysqli_connect($host, $user, $password, $database);

if (!$link) {
	echo "Failed to connect to database. contact the administrator";
}
?>