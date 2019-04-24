<!DOCTYPE html>
<?php
  require '../config/config.php';
  require '../shared/include.php';

  if(isset($_POST['username']) && isset($_POST['password'])) {
    if(empty($_POST['username']) || empty($_POST['password'])) {
      $error = "Please enter your username & password.";
    }
    else {
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

      $sql = "SELECT * FROM users
              WHERE username = '" . $_POST['username'] . "';";

      $results = $mysqli->query($sql);
			if(!$results) {
				echo $mysqli->error;
				exit();
			}

      if($results->num_rows > 0) {
        $row = $results->fetch_assoc();
        $dbPassword = trim($row['password']);
        if(password_verify($_POST['password'], $dbPassword)) {
          $_SESSION['signed_in'] = true;
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['fname'] = ucfirst($row['fname']);
          $_SESSION['email'] = $row['email'];

          header('Location: ../index.php'); // Redirect
        }
        else {
          $error = "Incorrect password.";
        }
      }
      else {
        $error = "Incorrect username.";
      }
    }
  }
?>

<html>
<head>
  <script>
    $(document).ready(function() {
      <?php $_SESSION['page_id'] = 1; ?>
    });
  </script>
  
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
  	<div class="container signin-container">
      <div class="row">
  			<h3 class="col-12 text-center">Hello :-)</h3>
  		</div>

      <form action="signin.php" method="POST">

        <?php if (isset($error) && !empty($error)): ?>
          <div class="row">
    				<div class="font-italic text-danger col-12">
    					<?php echo $error; ?>
    				</div>
    			</div> <!-- .row -->
        <?php endif; ?>

        <div class="form-group row">
  				<div class="col-12">
  					<input type="text" class="form-control input-field" id="username-id" name="username" placeholder="username" />
  				</div>
    		</div> <!-- .row -->
        <div class="form-group row">
          <div class="col-12">
  					<input type="password" class="form-control input-field" id="password-id" name="password" placeholder="password" />
  				</div>
    		</div> <!-- .row -->

  			<div class="form-group row justify-center">
  				<div class="col-12 btn-bar">
  					<button type="submit" class="btn dark-button">Sign In</button>
  					<div class="p-2 inline sub-text"> or <a href="register.php">Register</a></div>
  				</div>
  			</div> <!-- .form-group -->

      </form> <!-- .form -->
  	</div> <!-- .container -->
  </div>
  <?php include '../shared/footer.php'; ?>
</body>
</html>
