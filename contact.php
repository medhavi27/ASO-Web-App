<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="styles/all.css" rel="stylesheet" type="text/css" />

  <title>Contact</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php") ?>

  <div class="contact_background background">
    <h2 class="background_text">Contact</h2>
  </div>

  <h3 class="contact_title">Executive Board 2019</h3>

  <hr />

  <div class="positions">
    <div class="president">
      <h4>President</h4>
      <h5>Name</h5>
      <h5>Email</h5>
      <h5>Phone Number</h5>
    </div>

    <div class="vp_internal">
      <h4>VP Internal</h4>
      <h5>Name</h5>
      <h5>Email</h5>
      <h5>Phone Number</h5>
    </div>

    <div class="vp_external">
      <h4>VP External</h4>
      <h5>Name</h5>
      <h5>Email</h5>
      <h5>Phone Number</h5>
    </div>
  </div>

  <div class="positions">
    <div class="treasurer">
      <h4>Treasurer</h4>
      <h5>Name</h5>
      <h5>Email</h5>
      <h5>Phone Number</h5>
    </div>

    <div class="secretary">
      <h4>Secretary</h4>
      <h5>Name</h5>
      <h5>Email</h5>
      <h5>Phone Number</h5>
    </div>
  </div>
  <?php include("includes/footer.php") ?>
</body>

</html>
