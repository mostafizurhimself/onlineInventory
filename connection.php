<?php
$servername = "192.206.45.26";
$username = "rm";
$password = "gamedb##321##";
$dbname = "testing2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
//echo "Connected successfully";
?>