<?php

include "header.php";


?>

<main> 

<div class="wrapper-main">

<section>

<h1> Signup </h1>
<?php

if(isset($_GET['error'])){
    if($_GET['error'] == "emptyfields"){
        echo '<p>Fill in all fields!</p>';
    } elseif ($_GET['error'] == "invaliduidmail"){
        echo '<p>Invalid Email!</p>';

    } elseif ($_GET['error'] == "invaliduid"){
        echo '<p>Invalid UserName!</p>';
    } elseif ($_GET['error'] == "passwordcheck"){
        echo '<p> Your Passwords do not match! </p>';
    } elseif ($_GET['error'] == "usertaken"){
        echo '<p>Username is already taken!</p>';
    }
}
elseif ($_GET['signup'] == "success"){
    echo '<p>Signup is a Success!</p>';

}

?>
<form action="includes/signup.inc.php" method="post">
    <input type="text" name="uid" placeholder="Username">
    <input type="text" name="mail" placeholder="E-mail">
    <input type="password" name="pwd" placeholder="Password">
    <input type="password" name="pwd-repeat" placeholder="Repeat password"> 
    <button class="submit" type="submit" name="signup-submit">Signup</button>
    </form>
</section>


</div>


</main>


<?php

include "footer.php";

?>