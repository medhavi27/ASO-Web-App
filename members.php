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
  <form id="filter_form" action="members.php" method="get">
    <label for="member">Filter by:</label>
    <select name="category">
      <option value="None">None</option>
      <?php $tags = exec_sql_query($db, "SELECT * FROM members_tags;")->fetchAll();
      foreach ($tags as $tag) { ?>
        <option value="<?php echo $tag['tag']; ?>"><?php echo $tag['tag']; ?></option><?php } ?>
    </select>
    <input type="text" name="search" />
    <button name="sort_tag" type="submit">Filter</button>
  </form>

  <?php
  if (isset($_GET['search']) && isset($_GET['category'])) {
    $do_search = TRUE;
    $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

    // check if the category exists in the tags array
    if (in_array($category, array_keys($tags))) {
      $search_field = $category;
    } else {
      array_push($messages, "Invalid category for search.");
      $do_search = FALSE;
    }
    // Get the search terms
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
    $search = trim($search);
  } else {
    // No search provided, so set the product to query to NULL
    $do_search = FALSE;
    $category = NULL;
    $search = NULL;
  } ?>

  <?php
  if ($do_search) {
    ?>
    <h3>Search Results</h3>
    <?php
    $sql = "SELECT * FROM members WHERE $search_field LIKE '%' || :search || '%'";
    $params = array(
      ":search" => $search
    );
    $result1 = exec_sql_query($db, $sql, $params);
    if ($result1) {
      $records = $result1->fetchAll();
      if (count($records) > 0) {
        foreach ($records as $record) {
          echo "<div class='member_bios'>
            <figure><img alt='image' class='members_image' src=\"uploads/headshots/" . $record["id"] . ".jpg" . "\">
            <figcaption>" .  $record['name'] . "</figcaption>
            <figcaption>" .  $record['year'] . "</figcaption></figure>
            <h4 class='mem_major'>" . $record['major']  . '/' . $record['minor'] . "</h4>
            <h4 class='mem_bio'>" . $record['bio'] . "</h4>
            </div>";
        }
        ?>
      <?php
    }
  } else {
    echo "<p>No members found.</p>";
  }
}
?>

  <h3>Meet the Eboard Members</h3>

  <div class="mem_categories">
    <h4>Name</h4>
    <h4>Major/Minor</h4>
    <h4>About</h4>
  </div>

  <hr />

  <div class="mem_info">
    <?php
    if (!isset($_GET['search']) && !isset($_GET['category'])) {
      $sql = "SELECT * FROM members WHERE eboard='TRUE'";
      $records = exec_sql_query($db, $sql)->fetchAll(PDO::FETCH_ASSOC);
      foreach ($records as $record) {
        echo "<div class='member_bios'>
                <figure><img alt='image' class='members_image' src=\"uploads/headshots/" . $record["id"] . ".jpg" . "\">
                <figcaption>" .  $record['name'] . "</figcaption>
                <figcaption>" .  $record['year'] . "</figcaption></figure>
                <h4 class='mem_major'>" . $record['major']  . '/' . $record['minor'] . "</h4>
                <h4 class='mem_bio'>" . $record['bio'] . "</h4>
                </div>";
      }
    }
    ?>
  </div>

  <h3>Meet the Members</h3>

  <div class="mem_categories">
    <h4>Name</h4>
    <h4>Major/Minor</h4>
    <h4>About</h4>
  </div>

  <hr />

  <div class="mem_info">
    <?php
    if (!isset($_GET['search']) && !isset($_GET['category'])) {
      $sql = "SELECT * FROM members WHERE eboard='FALSE'";
      $records = exec_sql_query($db, $sql)->fetchAll(PDO::FETCH_ASSOC);
      foreach ($records as $record) {
        echo "<div class='member_bios'>
                <figure><img alt='image' class='members_image' src=\"uploads/headshots/" . $record["id"] . ".jpg" . "\">
                <figcaption>" .  $record['name'] . "</figcaption>
                <figcaption>" .  $record['year'] . "</figcaption></figure>
                <h4 class='mem_major'>" . $record['major']  . '/' . $record['minor'] . "</h4>
                <h4 class='mem_bio'>" . $record['bio'] . "</h4>
                </div>";
      }
    }
    ?>

  </div>
  <?php include("includes/footer.php") ?>

</body>

</html>
