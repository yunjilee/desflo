<?php
  require '../config/config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

  $sql = "INSERT INTO searches(user_id, keyword, color)
          VALUES('" . $_SESSION['user_id'] . "', '" . $_POST['keyword'] . "', '"
            . $_POST['color'] . "');";

	$results = $mysqli->query($sql);
	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
?>
