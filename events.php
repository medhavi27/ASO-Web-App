<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");

$messages = array();
if (isset($_POST["submit-sug"]) && is_user_logged_in()) {
  $submit_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $submit_desc = filter_input(INPUT_POST, 'description-sug', FILTER_SANITIZE_STRING);


  $sql = "INSERT INTO event_suggestions(title, description) VALUES (:title, :description)";
  $params = array(
    ':title' => $submit_title,
    ':description' => $submit_desc,

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
      <h2>Suggest events for ASO to plan!</h2>

        <form id="event-sug" action="events.php" method="post">
          <ul>
            <li>
              <label>Event Title: </label>
              <input type="text" name="title">
            </li>
            <li>
              <label>Description:</label>
              <textarea name="description-sug" cols="50" rows="5" class="description-input" placeholder="Write a short description of the event."></textarea>
            </li>
          </ul>
          <button name="submit-sug" type="submit" id="add-sug">Submit</button>
        </form>

    </div>
  </div>
  <?php include("includes/footer.php") ?>
</body>

</html>
