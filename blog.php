<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");

///takes in a url and returns what website it's coming from
function getsource($inp)
{
  $substr = explode(".", $inp);
  $res = $substr[1];
  return ucfirst($res);
}
// delete blog
if (isset($_GET['deleteBlog'])) {
  $getid = explode("#", $_GET['deleteBlog']);

  $blog_id = $getid[1];
  $sql = "DELETE FROM blogs WHERE id=:id";
  $params = array(
    ':id' => $blog_id
  );
  $resultdel = exec_sql_query($db, $sql, $params);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="styles/all.css" rel="stylesheet" type="text/css" />

  <title>Blog</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php") ?>

  <div class="blog_background">
    <h2 class="background_text">Learn More</h2>
  </div>

  <div class="row">
    <?php $records = exec_sql_query($db, "SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {

      echo  "<div class='post'><h3 class='posth3'><a href='" . htmlspecialchars($record['link']) . "'>" . htmlspecialchars($record["title"]) . "</a></h3>";
      echo "<ul><li> Source: <a href='" . htmlspecialchars($record['link']) . "'>" . htmlspecialchars(getsource($record["link"])) . "</a></li>
      <li> Author: " . htmlspecialchars($record["author"]) . "</li>
      <li> Date: " . htmlspecialchars($record["date"]) . "</li>
      ";
      if (is_user_logged_in()) {
        echo
          "<li><form class='deleteBlog' action='blog.php' method='GET'>
          <input type='submit' name='deleteBlog' value='Delete Blog #" . htmlspecialchars($record['id']) . "'></form></li></ul></div>";
      } else {
        echo "</ul></div>";
      }
    } ?>

  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
