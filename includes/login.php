<?php
?>


  <?php
  foreach ($session_messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
  ?>

<form id="loginForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
<h2>LOGIN</h2>
<p class="signIn"><h3>You must be an eboard member to update members, events, and blogs!</h3>
      <label for="username">Username:</label>
      <input id="username" type="text" name="username" />
      <label for="password">Password:</label>
      <input id="password" type="password" name="password" />
      <button name="login" type="submit">Sign In</button>
</form>
