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

  <title>Members</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php") ?>

  <div class="members_background">
    <h2 class="background_text">Members</h2>
  </div>

  <?php if (is_user_logged_in()) {  ?>


  <?php } else {
  ?>
    <h2 class="membersTitle">To update this page, E-board members must be logged in.</h2>
  <?php } ?>


  <!-- Filter form that allows user to view members for specific a specific filter, or just view
    all members in the gallery -->
  <form id="filter_form" action="members.php" method="post">
<label for="member">Filter</label>
    <input name="member_search" id="member_search">
    By:

    <select name="filter">
      <option value="None">None</option>
      <?php $tags = exec_sql_query($db, "SELECT * FROM members_tags;")->fetchAll();
      foreach ($tags as $tag) { ?>
        <option value="<?php echo $tag['tag']; ?>"><?php echo $tag['tag']; ?></option><?php } ?>
    </select>

    <button name="sort_tag" type="submit">Filter</button>
  </form>

  <h3>Meet the Members</h3>

  <div class="mem_categories">
    <h4>Name</h4>
    <h4>Major/Minor</h4>
    <h4>About</h4>
  </div>

  <hr />

  <div class="mem_info">
    <?php
    if (isset($_POST["sort_tag"]) && ($_POST['filter'] != "None")) {
      $tag_filtered = $_POST['filter'];
      // Still need to implement
    } else {
      $sql = "SELECT * FROM members";
      $records = exec_sql_query($db, $sql)->fetchAll(PDO::FETCH_ASSOC);
      foreach ($records as $record) {
        echo "<div class='member_bios'>
                <figure><a href=\"view_member.php?image_id=" . $record["id"] . "\"><img alt='image' class='members_image' src=\"uploads/headshots/" . $record["id"] . ".jpg" . "\"></a>
                <figcaption>" .  $record['year'] . "</figcaption></figure>
                <h4 class='mem_major'>" . $record['major']  . "</h4>
                <h4 class='mem_bio'>" . $record['bio'] . "</h4>
                </div>";
      }
    }
    ?>

  </div>

</body>

</html>
