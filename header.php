<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap" rel="stylesheet">


</head>
<body>
    
    <header>

        <nav class="nav-header-main">
            <a class="header-logo" href= "index.php">
            <img class="logo" src = "img/MyLogo.png" alt="logo">
            </a>

            <ul>
            <li> <a href="index.php">Home</a> </li>
            <li> <a href="#">Link 2</a> </li> 
            <li> <a href="#">Link 3</a> </li>
            <li> <a href="#">Link 4</a> </li>
            </ul>


        <div class="header-login">

        <?php
        if (!isset($_SESSION['id'])) {
          echo '<form action="includes/login.inc.php" method="post">
            <input type="text" name="mailuid" placeholder="E-mail/Username">
            <input type="password" name="pwd" placeholder="Password">
            <button class="login" type="submit" name="login-submit">Login</button>
          </form>
          <a class="Signup" href="signup.php">Signup</a>';
        }
        else if (isset($_SESSION['id'])) {
          echo '<form action="includes/logout.inc.php" method="post">
            <button class= "logout" type="submit" name="login-submit">Logout</button>
          </form>';
        }
        ?>
            


            
        </div>
        </nav>
        
    </header>


</body>
</html>