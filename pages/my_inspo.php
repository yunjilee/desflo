<!DOCTYPE html>
<?php
  require '../config/config.php';
  require '../shared/include.php';

  if(!$_SESSION['signed_in']) {
    $error = "Must be signed in to view this page";
  }
  else {
    $keyword = ""; // For nav_search.php

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
      echo $mysqli->connect_error;
      exit();
    }

    $sql_favorites = "SELECT * FROM favorites
  		WHERE user_id = '" . $_SESSION['user_id'] . "'
      ORDER BY favorite_id DESC;
  	";
  	$results_favorites = $mysqli->query($sql_favorites);
  	if(!$results_favorites) {
  		echo $mysqli->error;
  		exit();
  	}

    $sql_searches = "SELECT * FROM searches
  		WHERE user_id = '" . $_SESSION['user_id'] . "'
      ORDER BY search_id DESC;
  	";
    $results_searches = $mysqli->query($sql_searches);
  	if(!$results_searches) {
  		echo $mysqli->error;
  		exit();
  	}
  }
?>

<html>
<head>
  <script>
    function setSearchBarDefaults() {
      $(".keyword-id").val("");
      setColor('#7384AE');
    }
    $(document).ready(function() {
      <?php $_SESSION['page_id'] = 3; ?>
      setSearchBarDefaults();
    });
  </script>

  <?php include '../shared/head.php'; ?>
  <link rel="stylesheet" type="text/css" href="../assets/styles/main.css">
  <link rel="stylesheet" type="text/css" href="../assets/styles/media.css">
  <link rel="stylesheet" type="text/css" href="../assets/styles/scheme1.css">
  <link href="../assets/color_picker/bootstrap-colorpicker-v3.1.1-dist/css/bootstrap-colorpicker.css" rel="stylesheet">
</head>
<body>

	<?php
		include '../shared/nav_search.php';
	?>

  <h5 class="p-2 inspo-header">Search History</h5>
  <div id="keyword-container">
    <?php while($row = $results_searches->fetch_assoc()) : ?>
      <form action="results.php?" method="GET">
        <h1 class="inline float-left">
          <input type="submit" class="btn-keyword" style="color:<?php echo $row['color']; ?>" value="<?php echo ($row['keyword'] ?: '⁕') ?>" />
        </h1>
        <input type="hidden" name="keyword" value="<?php echo $row['keyword']; ?>" />
        <input type="hidden" name="color" value="<?php echo $row['color']; ?>" />
      </form>
  	<?php endwhile; ?>
  </div>
  <div class="clearfloat" />

  <h5 class="p-2 inspo-header margin-top">My Inspo Board</h5>
  <div class="container-fluid" id="favorites-container">
    <div class="row" id="results-row">
      <?php while($row = $results_favorites->fetch_assoc()) : ?>
        <div class="col col-6 col-md-4 col-lg-4 result-container">
          <div class="result-item">
            <a href="<?php echo $row["proj_url"]; ?>" target="_blank">
              <img src="<?php echo $row["img_url"]; ?>" />
              <div class="overlay">
                <p class="overlay-text"><?php echo $row["name"]; ?></p>
                <form class="delete-favorite-form" action="" method="POST">
                  <button type="submit" class="btn-favorite"><i class="fas fa-trash-alt"></i></button>
                  <input type="hidden" name="favorite_id" value="<?php echo $row["favorite_id"]; ?>" />
                </form>
              </div>
            </a>
          </div>
        </div>
    	<?php endwhile; ?>
		</div> <!-- .row -->
  </div> <!-- .container-fluid -->

  <script>
    $(".delete-favorite-form").submit(function() {
      var values = {};
      $.each($(this).serializeArray(), function(i, field) {
          values[field.name] = field.value;
      });

      $.ajax({
          url: '../ajax/delete_from_favorites.php',
          type: 'POST',
          data: {
            favorite_id: values["favorite_id"]
          },
          success: function(data, status, xhr) {
            if(xhr.responseText) alert(xhr.responseText);
            else {
              console.log("Successfully deleted from favorites.");
              $('#favorites-container').load('my_inspo.php #favorites-container');
            }
          },
          error: function(xhr, status, error) {
            alert("Error deleting from favorites.");
          }
      });
      return false;
    });
  </script>

</body>
</html>
