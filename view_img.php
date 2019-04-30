<?php include("includes/init.php");
$idimg = $_GET['id'];
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

  <?php include("includes/header.php");

  $sqlforimgonly = "SELECT * from gal_images WHERE  id=:imgid";
$params = array(
    ':imgid' => $idimg
);

$resultforimg = exec_sql_query($db, $sqlforimgonly, $params);
if ($resultforimg) {
  $img = $resultforimg->fetchAll();
  $dispimg = $img[0];
  echo "<p class='caption'>".htmlspecialchars($dispimg["alt"])."</p>";
  echo "<img class='bigimg' src= 'uploads/images/about_gallery/about".htmlspecialchars($dispimg["id"]).".".htmlspecialchars($dispimg["ext"])."'>";
}






   ?>
