<?php
  require "header.php";
?>

    <main>
        
          
          <?php
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged out!</p>';
          }
          else if (isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged in!</p>';
          }
          ?>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
