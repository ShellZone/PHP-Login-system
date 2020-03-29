<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    

</head>
<body>
    
    <header>

        <nav class="nav-header-main">
            <a class="header-logo" href= "#">
            <img class="logo" src = "img/MyLogo.png" alt="logo">
            </a>

            <ul>
            <li> <a href="index.php">Home</a> </li>
            <li> <a href="#">Link 2</a> </li>
            <li> <a href="#">Link 3</a> </li>
            <li> <a href="#">Link 4</a> </li>
            </ul>


        <div class="header-login">
            <form action="includes/login.inc.php" method="post">
            <input type="text" name="mailuid" placeholder="UserName/E-mail..." >
            <input type="password" name="pwd" placeholder="Password..." >
            <button type="submit" name="login-submit">Login</button>
            </form>
            <a href="signup.php">Signup</a>


            <form action="includes/logout.inc.php" method="post">
             <button type="submit" name="logout-submit">Logout</button>
            
            </form>
        </div>
        </nav>
        
    </header>


</body>
</html>