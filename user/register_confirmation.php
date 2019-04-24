<!DOCTYPE html>
<?php
  require '../config/config.php';
  require '../shared/include.php';

  if(!validPostAttr('fname') || !validPostAttr('email')
    || !validPostAttr('username') || !validPostAttr('password')) {
    $error = "Please fill out all required fields.";
  }
  else {
  	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  	if($mysqli->connect_errno) {
  		echo $mysqli->connect_error;
  		exit();
  	}

  	// Check if username/email (unique) already registered
  	$sql_registered = "SELECT * FROM users
  		WHERE username = '" . $_POST['username'] . "' OR email = '" . $_POST['email'] . "';
  	";
  	$results_registered = $mysqli->query($sql_registered);
  	if(!$results_registered) {
  		echo $mysqli->error;
  		exit();
  	}

  	if($results_registered->num_rows > 0) {
  		$error = "Username or email is already registered.";
  	}
  	// If not registered, add user to database
  	else {
  		$hashedPW = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $fname = ucfirst($_POST['fname']); // Capitalize

  		$sql = "INSERT INTO users(fname, email, username, password)
  						VALUES('" . $fname . "', '" . $_POST['email'] . "', '"
                . $_POST['username'] . "', '" . $hashedPW . "');";

      // SQL blocks duplicate entries for unique fields
  		$results = $mysqli->query($sql);
  		if(!$results) {
  			echo $mysqli->error;
  			exit();
  		}
      // Automatically sign user in
      else {
        $_SESSION['signed_in'] = true;
        $_SESSION['user_id'] = $mysqli->insert_id;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['fname'] = ucfirst($_POST['fname']);
        $_SESSION['email'] = $_POST['email'];
      }
  	}

  	$mysqli->close();
  }
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
  	<div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <?php if ( isset($error) && !empty($error) ) : ?>
            <h3>There was an error :-(</h3>
            <div class="text-danger"><?php echo $error; ?></div>
            <form action="register.php">
              <input type="submit" class="btn light-button" value="Try Again?" />
            </form>
          <?php else : ?>
            <h3>Welcome to Desflo, <?php echo $fname; ?>!</h3>
            <form action="../index.php">
              <input type="submit" class="btn light-button" value="Get Started" />
            </form>
          <?php endif; ?>
        </div> <!-- .col -->
  		</div>

  	</div> <!-- .container -->
  </div>

  <?php include '../shared/footer.php'; ?>

</body>
</html>
