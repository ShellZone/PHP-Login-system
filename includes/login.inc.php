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
    else {
        mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
        mysqli_stmt_execute($stmt);
        //result is equal to DB result and if its empty
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            // Hashes then checks the password
            $pwdCheck = password_verify($password, $row['pwdUsers']);
            if($pwdCheck == false){
                header("Location: ../index.php?error=wrongpwd");
                exit();
            } elseif($pwdCheck == true){
                //start session to create a session variable

                session_start();
                $_SESSION['userId'] = $row['idUsers'];
                $_SESSION['userUid'] = $row['uidUsers'];

                header("Location: ../index.php?login=sucess");
                exit();

                
            }else{
                header("Location: ../index.php?error=wrongpwd");
                exit();
            }

        }
        else {
            header("Location: ../index.php?error=nouser");
            exit();
        }
    }
  }
}