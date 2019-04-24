<?php
  require '../config/config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

  $sql = "INSERT INTO favorites(user_id, img_url, proj_url, name)
          VALUES('" . $_SESSION['user_id'] . "', '" . $_POST['img_url'] . "', '"
            . $_POST['proj_url'] . "', '" . $_POST['name'] . "');";

	$results = $mysqli->query($sql);
	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
?>
