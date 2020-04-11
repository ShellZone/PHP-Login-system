<?php

// Check if they got here via the login button

if(isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    // grabbing uid and pwd from form and giving them a variable
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];
// Checks for empty fields

if(empty($mailuid) || empty($password)){
    header("Location: ../index.php?error=emptyfields");
    exit();
//check DB username or email
} else{
    $sql = "SELECT * FROM users WHERE uidUsers=?; ";
    //initialize connection 
    $stmt = mysqli_stmt_init($conn);
    //create statement by running it in DB 
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();

    }
}

}else{
    header("Location: ../index.php");
    exit();

}