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

  <title>About</title>
</head>

<body>

  <!-- TODO: This should be your main page for your site. -->
  <?php include("includes/header.php") ?>

  <div class="background">
    <h2 class="background_text">About</h2>
  </div>

  <!-- <hr /> -->
  <h2>Overview</h2>
  <p class="overview">
    The Armenian Student Organization fosters community among those of
    Armenian ethnicity and/or those with any interest in Armenian culture and
    history on Cornell's campus and across Ithaca at large. Throughout the school
    year, we organize many social potlucks, BBQs, and backgammon tournaments, as
    well as educational activities such as free Armenian language lessons, guest
    speakers, and workshops. The ASO is also a great resource to connect interested
    individuals with networking and/or internship opportunities in the Diaspora and
    Armenia. Finally, we seek to promote intersectionality and build connections
    with other student groups on campus.
  </p>

  <hr />

  <h2 class="pres_text">A Message From Our PRESIDENT</h2>

  <hr />

  <div class='first_row'>
    <?php
    $records = exec_sql_query($db, "SELECT * FROM gal_images")->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record){

          echo  "<img class='about_image' src= 'uploads/images/about_gallery/about".htmlspecialchars($record["id"]).".".htmlspecialchars($record["ext"])."' alt = '".htmlspecialchars($record["alt"])."'>";
        }
        ?>
    <!-- <img class="about_image" src="uploads/images/about1.jpg">
    <img class="about_image" src="uploads/images/about2.jpg">
    <img class="about_image" src="uploads/images/about3.jpg">
    <img class="about_image" src="uploads/images/about4.jpg">
  </div>

  <div class="second_row">
    <img class="about_image" src="uploads/images/about5.jpg">
    <img class="about_image" src="uploads/images/about6.jpg">
    <img class="about_image" src="uploads/images/about7.jpg">
    <img class="about_image" src="uploads/images/about8.jpg">
  </div>

  <div class="third_row">
    <img class="about_image" src="uploads/images/about9.jpg">
    <img class="about_image" src="uploads/images/about10.jpg">
    <img class="about_image" src="uploads/images/about11.jpg">
    <img class="about_image" src="uploads/images/about12.jpg"> -->
  </div>
</body>

</html>
