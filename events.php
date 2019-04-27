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

  <title>Events</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php") ?>

  <h2 class="about">Events</h2>
  <hr />
  <div class="row">
  <div class="ourevent border-right">
  <h2>Our Events</h2>
  </div>

  <div class="addevent">
  <h2>Add an event</h2>

  <form id="event-form" action="events.php" method="post">
    <ul>
      <li>
    <label>Title: </label>
    <input type="text" name="title">
      </li>
<li>
    <label>Date:</label>
    <input type="date" name="date">
</li>
<li>
    <label>Location:</label>
    <input type="text" name="location">
</li>
<li>
    <label>Description:</label>
     <textarea name="description" cols="50" rows="5" class="description-input" placeholder="Write a short description of the event."></textarea>
</li>
</ul>
    <button name="submit-event" type="submit" id="add-button">Add</button>
  </form>

  </div>
  </div>
</body>

</html>
