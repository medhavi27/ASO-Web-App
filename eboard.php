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

    $sql = "INSERT INTO member_images(member_id, ext, name) VALUES(:member_id, :ext, :title );";
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


function print_event_record($record)
{
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["name"]); ?></td>
    <td><?php echo htmlspecialchars($record["title"]); ?></td>
    <td><?php echo htmlspecialchars($record["time"]); ?></td>

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
      <form id="deleteMember" action="eboard.php" method="GET">
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
    $sql1 = "SELECT members.name, events.title, events.time FROM members INNER JOIN members_and_events ON members_and_events.member_id = members.id INNER JOIN events on members_and_events.event_id = events.id;";
    $result = exec_sql_query($db, $sql1)->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
      ?>
      <h2> Information for Eboard members </h2>
      <p class="eboardinfo"> Members and Events Attended </p>
      <table class="eboardtable">
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
      <div>
        <p class="eboardinfo"> Add a member </p>
        <form id="addMember" action="eboard.php" method="post" enctype="multipart/form-data">
          <ul>
            <li><label for="headshot">Upload a headshot:</label>
              <input id="headshot" type="file" name="headshot"></li>

            <li><label for="name">Name:</label>
              <input id="name" type="text" name="name"></li>

            <li><label for="netid">Net ID:</label>
              <input id="netid" type="text" name="netid"></li>

            <li>Year: <select name="year">
                <option value="Freshman">Freshman</option>
                <option value="Sophomore">Sophomore</option>
                <option value="Junior">Junior</option>
                <option value="Senior">Senior</option>
              </select> </li>

            <li>Alumni? <select name="alumni">
                <option value=TRUE>TRUE</option>
                <option value=FALSE>FALSE</option>
              </select> </li>

            <li>Eboard? <select name="eboard">
                <option value=TRUE>TRUE</option>
                <option value=FALSE>FALSE</option>
              </select></li>

            <li><label for="major">Major:</label>
              <input id="major" type="text" name="major"></li>

            <li><label for="major">Minor (N/A if none):</label>
              <input id="minor" type="text" name="minor"></li>

            <li><label for="bio">Bio:</label>
              <input id="bio" type="text" name="bio"></li>

            <li><label for="phone">Phone Number:</label>
              <input id="phone" type="number" name="phone"></li>

            <li><button name="add" type="submit">Add Member</button></li>
          </ul>
        </form>
      </div>

      <div>
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
      </div>
      <div>
        <p class="eboardinfo"> Add a new blog post</p>
        <form id="uploadBlog" action="eboard.php" method="post">
          <ul>
            <li>
              <label for="add_blog">Title:</label>
              <input id="add_blog" type="text" name="add_blod">
            </li>
            <li>
              <label for="add_link">Link:</label>
              <input id="add_link" type="text" name="add_link">
            </li>
            <li>
              <label for="add_date">Date:</label>
              <input id="add_date" type="date" name="add_date">
            </li>
            <li>
              <label for="add_auth">Author:</label>
              <input id="add_auth" type="text" name="add_auth">
            </li>
            <li>
              <button name="addblog" id="addblog" type="submit">Add Blog</button>
            </li>
          </ul>
        </form>
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
