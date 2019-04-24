<!DOCTYPE html>
<?php
  require '../config/config.php';
  require '../shared/include.php';

  /* Behance API */
  require_once('../behance_api/src/Client.php');

  $apiKey = "ugCqRrCuAuHAD6gvDTmegYXLxO2lWVca";
  $client = new Behance\Client($apiKey);

  $keyword = '';
  $color = '';
  $color_hashed = '';

  if(validGetAttr('keyword')) {
    $keyword = $_GET['keyword'];
  }
  if(validGetAttr('color')) {
    $color_hashed = $_GET['color'];
    $color = str_replace('#', '', $color_hashed);
  }
  // echo 'Keyword: ' . $keyword . '<br>';
  // echo 'Color: ' . $color;

  $search_params = array(
    'q' => $keyword,
    'color_hex' => $color,
    'color_range' => 20,
    'sort' => 'appreciations'
  );
  $results = [];
  $results = $client->searchProjects($search_params);
?>

<html>
<head>
  <script>
    function setKeywordColor() {
      <?php if(isset($color_hashed) && !empty($color_hashed)) : ?>
        $('#keyword').css('color', '<?php echo $color_hashed ?>');
      <?php endif; ?>
    }
    function addToSearchHistory() {
      $.ajax({
          url: '../ajax/add_to_search_history.php',
          type: 'POST',
          data: {
            keyword: '<?php echo $keyword; ?>',
            color: '<?php echo $color_hashed; ?>'
          },
          success: function(data, status, xhr) {
            if(xhr.responseText) console.log(xhr.responseText);
            else console.log("Successfully added to search history.");
          },
          error: function(xhr, status, error) {
            console.log("Error adding to search history.");
          }
      });
    }
    $(document).ready(function() {
      <?php $_SESSION['page_id'] = 2; ?>
      setKeywordColor();
      <?php if($_SESSION['signed_in']) : ?>
        addToSearchHistory();
      <?php endif; ?>
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

  <h1 class="p-2" id="keyword"><?php echo $keyword; ?></h1>

  <div class="container-fluid" id="results-container">
    <div class="row" id="results-row">

      <?php if(!empty($results)) : ?>

        <?php foreach($results as $k => $value) : ?>
          <?php if(!empty($value->covers->{'404'}) && !empty($value->url) && !$value->mature_content) : ?>
            <div class="col col-6 col-md-4 col-lg-4 result-container">
              <div class="result-item">

                <a href="<?php echo $value->url; ?>" target="_blank">
                  <img src="<?php echo $value->covers->{'404'}; ?>">
                  <div class="overlay">
                    <p class="overlay-text"><?php echo $value->name; ?></p>
                    <form class="add-favorite-form" action="" method="POST">
                      <button type="submit" class="btn-favorite"><i class="fas fa-heart"></i></button>
                      <input type="hidden" name="proj_url" value="<?php echo $value->url; ?>" />
                      <input type="hidden" name="img_url" value="<?php echo $value->covers->{'404'}; ?>" />
                      <input type="hidden" name="name" value="<?php echo $value->name; ?>" />
                    </form>
                  </div>
                </a>

              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>

      <?php else : ?>
          <div>No results to show. :-(</div>
      <?php endif; ?>

		</div> <!-- .row -->
  </div> <!-- .container-fluid -->

  <script>
    $(".add-favorite-form").submit(function() {
      <?php if(!$_SESSION['signed_in']) : ?>
        alert("Must be signed in to add to favorites.");
        return false;
      <?php endif; ?>

      var values = {};
      $.each($(this).serializeArray(), function(i, field) {
          values[field.name] = field.value;
      });
      // console.log(values);

      $.ajax({
          url: '../ajax/add_to_favorites.php',
          type: 'POST',
          data: {
            img_url: values["img_url"],
            proj_url: values["proj_url"],
            name: values["name"]
          },
          success: function(data, status, xhr) {
            if(xhr.responseText) alert(xhr.responseText);
            else alert("Successfully added to favorites.");
          },
          error: function(xhr, status, error) {
            alert("Error adding to favorites.");
          }
      });
      return false;
    });
  </script>

</body>
</html>
