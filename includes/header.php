<header>
  <h1 class="title">Armenian Student Organization <span>at Cornell</span></h1>
  <nav class="navBar">
    <ul>
      <li class="home"><a href="index.php">About</a></li>
      <li class="members"><a href="members.php">Members</a></li>
      <li class="events_page"><a href="events.php">Events</a></li>
      <li class="learn_more"><a href="blog.php">Learn More</a></li>
      <li class="contact"><a href="contact.php">Contact</a></li>
      <li class="eboard"><a href="eboard.php">Eboard</a></li>
      <?php
      // Log Out link
      if (is_user_logged_in()) {
        // Add a logout query string parameter
        $logout_url = htmlspecialchars($_SERVER['PHP_SELF']) . '?' . http_build_query(array('logout' => ''));

        echo '<li id="nav-last"><a href="' . $logout_url . '">Sign Out ' . htmlspecialchars($current_user['username']) . '</a></li>';
      }
      ?>
    </ul>
  </nav>
</header>
