<?php


$servername = "locahost:81";
$dBUsername = "root";
$dBPassword = "";
$dBName = "phploginsystem";

$conn = mysqli_connect($servername, $dBName, $dBPassword, $dBUsername);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}