<?php
  require '../config/config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

  $sql = "DELETE FROM favorites
          WHERE favorite_id = " . $_POST['favorite_id'] . ";";

	$results = $mysqli->query($sql);
	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
?>
