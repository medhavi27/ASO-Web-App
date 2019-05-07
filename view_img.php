<?php include("includes/init.php");
$idimg = $_GET['id'];

///delete image
if (isset($_GET['deleteImg'])) {
  $get_value = $_GET['deleteImg'];
  $getid = explode("#", $get_value);


  $img_id = $getid[1];

  $sql = "DELETE FROM gal_images WHERE id=:imgid;";
  $params = array(
    ':imgid' => $img_id
  );
  $sqlforimgdel = "SELECT * from gal_images WHERE id=:imgid";
  $paramsdel = array(
    ':imgid' => $img_id
  );
  $res = exec_sql_query($db, $sqlforimgdel, $paramsdel)->fetchAll(PDO::FETCH_ASSOC);
  if ($res) {
    $acc = $res[0];
    $unlinked = unlink("uploads/images/about_gallery/about" . $acc['id'] . "." . $acc['ext']);
  }
  $resultdel = exec_sql_query($db, $sql, $params);


  if ($resultdel) {
    $paramsdelete = array(
      ':imageid' => $idimg
    );
    $sql122 = "SELECT * FROM gal_images WHERE id=:imageid";

    $check_empty = exec_sql_query($db, $sql122, $paramsdelete)->fetchAll(PDO::FETCH_ASSOC);
    if (empty($check_empty)) {
      header('Location: index.php');
    }
  }
}

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
    echo "<p class='caption'>" . htmlspecialchars($dispimg["alt"]) . "</p>";
    echo "<img class='bigimg' src= 'uploads/images/about_gallery/about" . htmlspecialchars($dispimg["id"]) . "." . htmlspecialchars($dispimg["ext"]) . "' alt='" . $dispimg["alt"] . "'>";
    if (is_user_logged_in()) {
      echo
        "<form class='deleteImg' action='view_img.php' method='GET'>
        <input type='submit' id='delimg' name='deleteImg' value='Delete Img #" . htmlspecialchars($dispimg['id']) . "'></form>";
    }
  }



  ?>
  <?php include("includes/footer.php");
  ?>

</body>

</html>
