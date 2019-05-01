<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");

$messages = array();
if (isset($_POST["submit-event"]) && is_user_logged_in()) {
  $submit_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $submit_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $submit_date = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
  $submit_loc = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);

  $sql = "INSERT INTO events (title, description, time, location) VALUES (:title, :description, :time, :location)";
  $params = array(
    ':title' => $submit_title,
    ':description' => $submit_desc,
    ':time' => $submit_date,
    ':location' => $submit_loc,
  );

  $result = exec_sql_query($db, $sql, $params);
  // $records = exec_sql_query($db, "SELECT * FROM events")->fetchAll(PDO::FETCH_ASSOC);

}

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

  <div class="events_background">
    <h2 class="background_text">Events</h2>
  </div>
  <!-- <h2 class="about">Events</h2> -->
  <!-- <hr /> -->


  <div class="row-events">
    <div class="ourevent border-right">
      <h2>Our Events</h2>
      <?php $records = exec_sql_query($db, "SELECT * FROM events")->fetchAll(PDO::FETCH_ASSOC);
      foreach ($records as $record) {

        echo  "<div class='events'>
  <h3 class='eventhead'>" . htmlspecialchars($record["title"]) . "</h3>
  <p> Description: " . htmlspecialchars($record["description"]) . "</p>
  <p> Date: " . htmlspecialchars($record["time"]) . "</p>
  <p> Location: " . htmlspecialchars($record["location"]) . "</p>
  </div>";
      } ?>
    </div>

    <div class="addevent">
      <h2>Add an event</h2>
      <?php if (is_user_logged_in()) {
        ?>
        <form id="event-form" action="events.php" method="post">
          <ul>
            <li>
              <label>Title: </label>
              <input type="text" name="title">
            </li>
            <li>
              <label>Date:</label>
              <input type="date" name="time">
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
      <?php } else {
      include("includes/login.php");
    } ?>
    </div>
  </div>
  <?php include("includes/footer.php") ?>
</body>

</html>
