<?php


$servername = "locahost:81";
$dBUsername = "root";
$dBPassword = "";
$dBName = "phploginsystem";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}