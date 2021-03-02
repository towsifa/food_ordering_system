<?php
$serverName = 'localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'oros';
$conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

if(!$conn){
  die("Connection Faliure: ".mysqli_connect_error);
}
