<?php
// INCLUDE ON EVERY TOP-LEVEL PAGE!
function getsource($inp)
{
  $substr = explode(".", $inp);
  $res = $substr[1];
  return ucfirst($res);
}



include("includes/init.php");
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

  <!-- <h2 class="about">Learn more about ASO at Cornell and Armenia</h2>
  <hr> -->
  <div class="row">
    <?php $records = exec_sql_query($db, "SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {

      echo  "<div class='post'><h3 class='posth3'><a href='" . htmlspecialchars($record['link']) . "'>" . htmlspecialchars($record["title"]) . "</a></h3>";
      echo "<ul><li> Source: <a href='" . htmlspecialchars($record['link']) . "'>" . htmlspecialchars(getsource($record["link"])) . "</a></li>
      <li> Author: " . htmlspecialchars($record["author"]) . "</li>
      <li> Date: " . htmlspecialchars($record["date"]) . "</li>
      <ul></div>";
    } ?>

  </div>

  </div>
  <?php include("includes/footer.php"); ?>
</body>

</html>
