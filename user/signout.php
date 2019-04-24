<!DOCTYPE html>
<?php
	session_start();
	session_destroy(); // Clear SESSION
?>

<html>
<head>
  <?php include '../shared/head.php'; ?>
  <link rel="stylesheet" type="text/css" href="../assets/styles/main.css">
  <link rel="stylesheet" type="text/css" href="../assets/styles/media.css">
  <link rel="stylesheet" type="text/css" href="../assets/styles/scheme2.css">
  <link href="../assets/color_picker/bootstrap-colorpicker-v3.1.1-dist/css/bootstrap-colorpicker.css" rel="stylesheet">
</head>
<body>
	<?php
    include '../shared/nav_signin.php';
	?>
  <div class="vertical-center-lower center">
  	<div class="container" id="signout-container">
      <div class="row">
        <div class="col-12 text-center">
          <h3>You are now signed out.</h3>
          <form class="inline" action="../index.php">
            <input type="submit" class="btn light-button" value="Search" />
          </form>
            <div class="inline sub-text">or</div>
          <form class="inline" action="signin.php">
            <input type="submit" class="btn light-button" value="Sign Back In" />
          </form>
        </div> <!-- .col -->
  		</div>

  	</div> <!-- .container -->
  </div>

  <?php include '../shared/footer.php'; ?>

</body>
</html>
