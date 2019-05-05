<!DOCTYPE html>
<?php
  /* Behance API */
  require_once('behance_api/src/Client.php');
  $apiKey = "ugCqRrCuAuHAD6gvDTmegYXLxO2lWVca";
  $client = new Behance\Client($apiKey);
  $data = [];

  require 'config/config.php';
  require 'shared/include.php';
?>

<html>
<head>
  <script>
    function clearForm() {
      document.getElementById("search-form").reset();
    }
    $(document).ready(function() {
      <?php $_SESSION['page_id'] = 0; ?>
      clearForm();
    });
  </script>

  <?php include 'shared/head.php'; ?>
  <link rel="stylesheet" type="text/css" href="assets/styles/main.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/media.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/scheme1.css">
  <link href="assets/color_picker/bootstrap-colorpicker-v3.1.1-dist/css/bootstrap-colorpicker.css" rel="stylesheet">
</head>
<body>

	<?php
		include 'shared/nav_landing.php';
	?>

  <div class="vertical-center center">

  	<div class="container search-bar">

      <div class="row">
  			<h3 class="col-12">Give me a word & color.</h3>
  		</div>

      <form id="search-form" action="pages/results.php?" method="GET">
        <div class="form-group row justify-space-between">
          <div class="col-1">
            <input type="text" class="form-control" id="color-id" name="color" value="#7384AE" readonly />
            <?php include 'assets/color_picker/color_picker_landing.js'; ?>
  				</div>
          <div class="space"></div>
  				<div class="col-9">
  					<input type="text" class="form-control input-field" id="keyword-id" name="keyword" placeholder="nature" />
  				</div>
    			<div class="col-1">
            <input type="image" name="submit" id="submit-id" alt="submit-search" src="assets/images/search_icon.svg" />
    			</div>
    		</div> <!-- .row -->
      </form> <!-- .form -->

  	</div> <!-- .container -->

  </div>

  <?php include 'shared/footer_landing.php'; ?>

</body>
</html>
