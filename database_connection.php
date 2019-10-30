<?php
//database_connection.php

$connect = new PDO('mysql:host=192.206.45.26;dbname=testing2', 'rm', 'gamedb##321##');
session_start();

if(mysqli_connect_errno()){
echo mysqli_connect_error();
}

?>