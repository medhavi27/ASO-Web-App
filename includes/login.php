<?php
?>


  <?php
  foreach ($session_messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
  ?>

<form id="loginForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
<p class="signIn"><h3>Login to update members, events, and blogs!</h3>
      <label for="username">Username:</label>
      <input id="username" type="text" name="username" />
      <label for="password">Password:</label>
      <input id="password" type="password" name="password" />
      <button name="login" type="submit">Sign In</button>
</form>
