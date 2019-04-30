<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");

if (isset($_POST["submit-event"]) && is_user_logged_in()) {
  $submit_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $submit_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $submit_date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
  $submit_loc = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);

  $sql = "INSERT INTO events (title, description, date, location) VALUES (:title, :description, :date, :location)";
  $params = array(
    ':title' => $submit_title,
    ':description' => $submit_desc,
    ':date' => $submit_date,
    ':location' => $submit_loc,
  );

  $result = exec_sql_query($db, $sql, $params);
  $records = exec_sql_query($db, "SELECT * FROM events")->fetchAll(PDO::FETCH_ASSOC);


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

  <h2 class="about">Events</h2>
  <hr />


  <div class="row">

  <div class="ourevent border-right">
  <h2>Our Events</h2>
  <?php $records = exec_sql_query($db, "SELECT * FROM events")->fetchAll(PDO::FETCH_ASSOC);
   foreach($records as $record){

  echo  "<div class='events'>
  <h3>".htmlspecialchars($record["title"])."</h3>
  <p>".htmlspecialchars($record["description"])."'</p>
  <p>".htmlspecialchars($record["date"])."'</p>
  <p>".htmlspecialchars($record["location"])."'</p>
  </div>";
} ?>
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

</body>

</html>
