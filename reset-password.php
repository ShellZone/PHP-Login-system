<?php

require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Reset your password</h1>
        <p>An e-mail will be sent to you with instructions on how to reset your password.</p>
        <form action="includes/reset-request.inc.php" method="post"></form>
          <input type="text" name="email" placeholder="Enter your E-mail">
          <button type="submit" name="Reset Request Submit"></button>
        </section>
      </div>
    </main>

<?php

  require "footer.php";
?>
