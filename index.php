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

  <?php include("includes/header.php") ?>

  <div class="background">
    <h2 class="background_text">About</h2>
  </div>

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
  <h2 class="pres_text"><span class="pres_message">A Message From Our</span><span class="pres"> President</span></h2>
  <p class="message">
    &#8220;P/Barev and welcome to the Armenian Student Organization at Cornell University, your Big Red (Blue, and Orange) home away from տուն! I first became involved in the ASO on campus as a first-year undergraduate student, and quickly found comfort in this small, yet welcoming Cornellian Armenian community over the years, and I hope you will too! Join us for monthly meetings over Armenian coffee, BBQs at Stewart Park, weekly Armenian language and culture lessons, outings to NYC, and our many other events throughout the semester with fellow undergraduate and graduate students, professors and faculty, and local community members. We are a cultural student organization, with a focus on curating social, educational, and professional events and connections for the Cornell and Ithaca community at large. The ASO is open to all that are interested in learning more about Armenian culture!&#8221;
  </p>

  <hr />

  <div class='first_row'>
    <?php
    $records = exec_sql_query($db, "SELECT * FROM gal_images")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
      /* -- source: original content, Armenian Students Organization at Cornell-- */
      echo  "<a href='view_img.php?" . http_build_query(array('id' => $record['id'])) . "'> <img class='about_image' src= 'uploads/images/about_gallery/about" . htmlspecialchars($record["id"]) . "." . htmlspecialchars($record["ext"]) . "' alt = '" . htmlspecialchars($record["alt"]) . "'></a>" . PHP_EOL;
    }
    ?>



  </div>

  <?php include("includes/footer.php") ?>

</body>

</html>
