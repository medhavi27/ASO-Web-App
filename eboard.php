<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");

$messages = array();
if (isset($_POST["upload"]) && is_user_logged_in()) {
  $upload_last = $db->lastInsertId('id');
  $upload_imgname = $upload_last + 1;
  $upload_info = $_FILES["add_img"];
  $upload_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_link = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_link, PATHINFO_EXTENSION));
    $input_link = $upload_link . "." . $upload_ext;
    $alt = "ASO Image";
    $sql = "INSERT INTO gal_images(filename, ext, alt) VALUES(:title, :ext, :alt );";
    $params = array(
      ':title' => $upload_imgname,
      ':ext' => $upload_ext,
      ':alt' => $upload_title
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      $file_id = $db->lastInsertId('id');
      $id_filename = "uploads/images/about_gallery/about" . $file_id . "." . $upload_ext;
      move_uploaded_file($upload_info['tmp_name'], $id_filename);
    } else {
      array_push($messages, "Couldn't upload image");
    }
  }
}

if (isset($_POST["add"]) && is_user_logged_in()) {
  $upload_head = $_FILES["headshot"];
  $upload_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $upload_net = filter_input(INPUT_POST, 'netid', FILTER_SANITIZE_STRING);
  $upload_year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
  $upload_alumni = filter_input(INPUT_POST, 'alumni', FILTER_SANITIZE_STRING);
  $upload_eboard = filter_input(INPUT_POST, 'eboard', FILTER_SANITIZE_STRING);
  $upload_major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING);
  $upload_minor = filter_input(INPUT_POST, 'minor', FILTER_SANITIZE_STRING);
  $upload_bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
  $upload_phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
  if ($upload_name != NULL && $upload_net != NULL && $upload_year != NULL && $upload_major != NULL) {


    $sql = "INSERT INTO members (name,netid,year,alumni,eboard,major,minor,bio,phonenumber) VALUES (:name, :netid, :year, :alumni, :eboard, :major,:minor,:bio,:phone)";
    $params = array(
      ':name' => $upload_name,
      ':netid' => $upload_net,
      ':year' => $upload_year,
      ':alumni' => $upload_alumni,
      ':eboard' => $upload_eboard,
      ':major' => $upload_major,
      ':minor' => $upload_minor,
      ':bio' => $upload_bio,
      ':phone' => $upload_phone,
    );

    $result = exec_sql_query($db, $sql, $params);
    $records = exec_sql_query($db, "SELECT * FROM members WHERE name ='$upload_name'")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($records as $record) {
      $new_memid = $record['id'];
      $new_memname = $record['name'];
    }

    //add member
    if ($upload_head['error'] == UPLOAD_ERR_OK) {
      $upload_link = basename($upload_head["name"]);
      $upload_ext = strtolower(pathinfo($upload_link, PATHINFO_EXTENSION));
      $input_link = $upload_link . "." . $upload_ext;
      $alt = "ASO Image";

      $sql = "INSERT INTO member_images(member_id, ext, membername) VALUES(:member_id, :ext, :title );";
      $params = array(
        ':member_id' => $new_memid,
        ':ext' => $upload_ext,
        ':title' => $new_memname
      );

      $result2 = exec_sql_query($db, $sql, $params);
      if ($result2) {

        $file_id = $db->lastInsertId('id');
        $id_filename = "uploads/headshots/" . $file_id . "." . $upload_ext;
        move_uploaded_file($upload_head['tmp_name'], $id_filename);
      } else {
        array_push($messages, "Couldn't upload headshot");
      }
    }
  } else {
    array_push($messages, "Couldn't add member");
  }
}
////add blog post
if (isset($_POST["addblog"]) && is_user_logged_in()) {
  $upload_blog = filter_input(INPUT_POST, 'add_blog', FILTER_SANITIZE_STRING);
  $upload_link = filter_input(INPUT_POST, 'add_link', FILTER_SANITIZE_STRING);
  $upload_date = filter_input(INPUT_POST, 'add_date', FILTER_SANITIZE_STRING);
  $upload_auth = filter_input(INPUT_POST, 'add_auth', FILTER_SANITIZE_STRING);
  if ($upload_blog != NULL && $upload_link != NULL && $upload_date != NULL && $upload_auth != NULL) {
    $sqlblog = "INSERT INTO blogs(title,link, date, author) VALUES(:title, :link, :date, :auth );";
    $paramsblog = array(
      ':title' => $upload_blog,
      ':link' => $upload_link,
      ':date' => $upload_date,
      ':auth' => $upload_auth
    );
    $resultblog = exec_sql_query($db, $sqlblog, $paramsblog);
  }
}


// delete member
if (isset($_GET['foo'])) {
  $mem_net = $_GET['foo'];
  $records = exec_sql_query($db, "SELECT * FROM members WHERE netid='$mem_net'")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($records as $record) {
    $new_memid = $record['id'];
  }
  $sql = "DELETE FROM members WHERE id=:id";
  $params = array(
    ':id' => $new_memid,
  );
  $result = exec_sql_query($db, $sql, $params);

  $recs = exec_sql_query($db, "SELECT * FROM member_images WHERE member_id='$new_memid'")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($recs as $rec) {
    $new_imgid = $rec['id'];
    $image_file_ext = $rec['ext'];
  }

  $sql = "DELETE FROM member_images WHERE id=:id";
  $params = array(
    ':id' => $new_imgid,
  );

  $result2 = exec_sql_query($db, $sql, $params);
  unlink("uploads/headshots/" . $new_imgid . "." . $image_file_ext);

  if ($result2) {
    array_push($messages, "Image File Successfully Deleted");
  } else {
    array_push($messages, "Failed to Delete Image File");
  }
}

///add an event
if (isset($_POST["submit-event"]) && is_user_logged_in()) {
  $submit_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $submit_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $submit_date = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
  $submit_loc = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
  if ($submit_title != NULL && $submit_desc != NULL && $submit_date != NULL && $submit_loc != NULL) {
    $sql = "INSERT INTO events (title, description, time, location) VALUES (:title, :description, :time, :location)";
    $params = array(
      ':title' => $submit_title,
      ':description' => $submit_desc,
      ':time' => $submit_date,
      ':location' => $submit_loc,
    );

    $resevent = exec_sql_query($db, $sql, $params);
  }
}

function print_event_record($record)
{
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["title"]); ?></td>
    <td><?php echo htmlspecialchars($record["description"]); ?></td>

  </tr>
<?php
}
function print_member_record($record)
{
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
    <td>
      <form class="deleteMember" action="eboard.php" method="GET">
        <input type='submit' name='foo' value=<?php echo htmlspecialchars($record["netid"]) ?>></form>
    </td>



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

  <div class="eboard_background">
    <h2 class="background_text">E-board</h2>
  </div>

  <?php if (is_user_logged_in()) {
    ///to view events that members attended
    $sql1 = "SELECT * from event_suggestions;";
    $result = exec_sql_query($db, $sql1)->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
      ?>
      <h2> Information for Eboard members </h2>
      <p class="eboardinfo"> Event Suggestions </p>
      <table class="eboardtable">
        <tr>
          <th>Event</th>
          <th>Description</th>
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
      <table class="eventstable">
        <tr>
          <th>Member</th>
          <th>NetID</th>
          <th>Year </th>
          <th>Alumni </th>
          <th>Eboard</th>
          <th>Major</th>
          <th>Minor</th>
          <th>Phone Number</th>
          <th>Remove?</th>

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

    <div class="eboard_forms">
      <div class="row_one_forms">
        <div class="forms">
          <form id="addMember" action="eboard.php" method="post" enctype="multipart/form-data">
            <fieldset>
              <legend>Add New Member</legend>
              <ul>
                <li><label for="headshot">Upload a headshot:</label>
                  <input id="headshot" type="file" name="headshot"></li>

                <li><label for="name">Name:</label>
                  <input id="name" type="text" name="name" required></li>

                <li><label for="netid">Net ID:</label>
                  <input id="netid" type="text" name="netid" required></li>

                <li>Year: <select name="year">
                    <option value="Freshman">Freshman</option>
                    <option value="Sophomore">Sophomore</option>
                    <option value="Junior">Junior</option>
                    <option value="Senior">Senior</option>
                    <option value="Grad">Grad Student</option>

                  </select> </li>

                <li>Alumni? <select name="alumni">
                    <option value=TRUE>TRUE</option>
                    <option value=FALSE>FALSE</option>
                  </select> </li>

                <li>Eboard? <select name="eboard">
                    <option value=TRUE>TRUE</option>
                    <option value=FALSE>FALSE</option>
                  </select></li>

                <li><label for="major">Major/Department:</label>
                  <input id="major" type="text" name="major" required></li>

                <li><label for="major">Minor:</label>
                  <input id="minor" type="text" name="minor"></li>

                <li><label for="bio">Bio:</label>
                  <input id="bio" type="text" name="bio"></li>

                <li><label for="phone">Phone Number:</label>
                  <input id="phone" type="number" name="phone"></li>

                <li class="add_mem_btn"><button name="add" type="submit">Add Member</button></li>
              </ul>
            </fieldset>
          </form>
        </div>

        <div class="forms">
          <form id="event-form" action="eboard.php" method="post">
            <fieldset>
              <legend>Add New Event</legend>
              <ul>
                <li>
                  <label>Title: </label>
                  <input type="text" name="title" required>
                </li>
                <li>
                  <label>Date and Time:</label>
                  <input type="datetime-local" name="time" required>
                </li>
                <li>
                  <label>Location:</label>
                  <input type="text" name="location" required>
                </li>
                <li>
                  <label class="event_descr">Description:</label>
                  <textarea name="description" cols="25" rows="5" class="description-input" placeholder="Write a short description of the event." required></textarea>
                </li>
                <li>
                  <button name="submit-event" type="submit" id="eventadd">Add Event</button>
                </li>
              </ul>
            </fieldset>
          </form>
        </div>
      </div>

      <div class="row_two_forms">
        <div class="forms">
          <form id="uploadBlog" action="eboard.php" method="post">
            <fieldset>
              <legend>Add New Blog Post</legend>
              <ul>
                <li>
                  <label for="add_blog">Title:</label>
                  <input id="add_blog" type="text" name="add_blog" required>
                </li>
                <li>
                  <label for="add_link">Link:</label>
                  <input id="add_link" type="text" name="add_link" required>
                </li>
                <li>
                  <label for="add_date">Date:</label>
                  <input id="add_date" type="date" name="add_date" required>
                </li>
                <li>
                  <label for="add_auth">Author:</label>
                  <input id="add_auth" type="text" name="add_auth" required>
                </li>
                <li>
                  <button name="addblog" id="addblog" type="submit">Add Blog</button>
                </li>
              </ul>
            </fieldset>
          </form>
        </div>

        <div class="forms">
          <form id="uploadImage" action="eboard.php" method="post" enctype="multipart/form-data">
            <fieldset>
              <legend>Add New Gallery Image</legend>
              <ul>

                <li>
                  <label for="add_img">Choose an Image:</label>
                  <input id="add_img" type="file" name="add_img">
                </li>
                <li>
                  <label for="img_name">Title:</label>
                  <input id="img_name" type="text" name="title">
                </li>
                <li>
                  <button name="upload" type="submit">Upload File</button>
                </li>
              </ul>
            </fieldset>
          </form>
        </div>
      </div>
    </div>

  <?php
} else {
  include("includes/login.php");
}
?>
  <?php include("includes/footer.php") ?>
</body>

</html>
