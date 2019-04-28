<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");

$messages = array();
if ( isset($_POST["upload"]) && is_user_logged_in() ) {
    $upload_info = $_FILES["add_img"];
    $upload_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    if ( $upload_info['error'] == UPLOAD_ERR_OK ) {
        $upload_link = basename($upload_info["name"]);
        $upload_ext = strtolower(pathinfo($upload_link, PATHINFO_EXTENSION));
        $input_link = $upload_link.".".$upload_ext;
        $alt = "ASO Image";
        var_dump($upload_ext);
        $sql = "INSERT INTO gal_images(filename, ext, alt) VALUES(:title, :ext, :alt );";
        $params = array(
            ':title' => $upload_title,
            ':ext' => $upload_ext,
            ':alt' => $alt
          );
          $result = exec_sql_query($db, $sql, $params);
          if ($result) {
            $file_id = $db->lastInsertId('id');
            $id_filename = "uploads/images/about_gallery/about".$file_id.".".$upload_ext;
            move_uploaded_file($upload_info['tmp_name'],$id_filename);
            }
            else {
              array_push($messages, "Couldn't upload image");
            }
          }
}

function print_event_record($record) {
          ?>
        <tr>
            <td><?php echo htmlspecialchars($record["name"]); ?></td>
            <td><?php echo htmlspecialchars($record["title"]); ?></td>
            <td><?php echo htmlspecialchars($record["time"]); ?></td>

        </tr>
<?php
      }
function print_member_record($record) {
    ?>
    <tr>
    <td><?php echo htmlspecialchars($record["name"]); ?></td>
    <td><?php echo htmlspecialchars($record["netid"]); ?></td>
    <td><?php echo htmlspecialchars($record["year"]); ?></td>
    <td><?php echo htmlspecialchars($record["alumni"]); ?></td>
    <td><?php echo htmlspecialchars($record["eboard"]); ?></td>
    <td><?php echo htmlspecialchars($record["major"]); ?></td>
    <td><?php echo htmlspecialchars($record["minor"]); ?></td>
    <td><?php echo htmlspecialchars($record["phonenumber"]); ?></td>




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
    $sql1 = "SELECT members.name, events.title, events.time FROM members INNER JOIN members_and_events ON members_and_events.member_id = members.id INNER JOIN events on members_and_events.event_id = events.id;";
    $result = exec_sql_query($db, $sql1)->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
      ?>
      <h2> Information for Eboard members </h2>
      <p class="eboardinfo"> Members and Events Attended </p>
      <table class = "eboardtable">
            <tr>
                <th>Member</th>
                <th>Event</th>
                <th>Date </th>
            </tr>
            <?php
            foreach ($result as $record) {
            print_event_record($record);
    }
    ?>
  </table>

  <p class="eboardinfo"> Information about all members </p>
  <?php
  }
    //to view all member Information

   $sql2 = "SELECT * from members;";
   $allresult = exec_sql_query($db, $sql2)->fetchAll(PDO::FETCH_ASSOC);
   if ($allresult) {
     ?>
     <table class = "eventstable">
           <tr>
               <th>Member</th>
               <th>NetID</th>
               <th>Year </th>
               <th>Alumni </th>
               <th>Eboard</th>
               <th>Major</th>
               <th>Minor</th>
               <th>Phone Number</th>

           </tr>
     <?php
     foreach ($allresult as $allrecord) {
     print_member_record($allrecord);
}


    ?>
       </table>

       <?php
       }
    ?>
     <p class="eboardinfo"> Add a new gallery image </p>

    <form id="uploadImage" action="eboard.php" method="post" enctype="multipart/form-data">
<ul>

<li>
<label for="add_img">Choose an Image:</label>
<input id="add_img" type="file" name="add_img">
</li>
<li>
<label for="img_name">Title:</label>
<input id="img_name" type="text" name="title">
</li>
<!-- <li>
<label for="img_source">Provide a source:</label>
<input id="img_source" type="text" name="img_source">
</li> -->
<li>
<button name="upload" type="submit">Upload File</button>
</li>
</ul>
</form>

<?php
}
else {
  include("includes/login.php");
}
  ?>



</body>

</html>
