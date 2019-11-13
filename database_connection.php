<?php
//database_connection.php

$connect = new PDO('mysql:host=localhost;dbname=testing2', 'root', '');
session_start();

if(mysqli_connect_errno()){
echo mysqli_connect_error();
}

?>