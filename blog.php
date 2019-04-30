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

  <title>Blog</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php") ?>
  <h2 class="about">Learn more about ASO at Cornell</h2>
<hr>
<div class="row">
<?php $records = exec_sql_query($db, "SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);
foreach($records as $record){

  echo  "<div class='post'><h3>".htmlspecialchars($record["title"])."</h3><p>".htmlspecialchars($record["link"])."'</p></div>";
} ?>

  </div>

</div>

</body>

</html>
