<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
function print_record($record) {
          ?>
        <tr>
            <td><?php echo htmlspecialchars($record["name"]); ?></td>
            <td><?php echo htmlspecialchars($record["title"]); ?></td>
            <td><?php echo htmlspecialchars($record["time"]); ?></td>

        </tr>
<?php
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="styles/all.css" rel="stylesheet" type="text/css" />

  <title>Eboard Only</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php"); ?>
  <?php if (is_user_logged_in()) {
    ///to view events that members attended
    $sql = "SELECT members.name, events.title, events.time FROM members INNER JOIN members_and_events ON members_and_events.member_id = members.id INNER JOIN events on members_and_events.event_id = events.id;";
    $result = exec_sql_query($db, $sql)->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
      ?>
      <h2> Information for Eboard members </h2>
      <p class="eboardinfo"> Members and Events Attended </p>
      <table id = "eventstable">
            <tr>
                <th>Member</th>
                <th>Event</th>
                <th>Date </th>
            </tr>

            <?php
            foreach ($result as $record) {
            print_record($record);
    }
    ?>
       </table>
       <?php


}
  }
else {
  include("includes/login.php");
}
  ?>



</body>

</html>
