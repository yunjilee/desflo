<!DOCTYPE html>
<?php
  require '../config/config.php';
  require '../shared/include.php';

  if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
		$error = "Please sign in to access page.";
    $fname = "";
    $email = "";
	}
	else {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
      echo $mysqli->connect_error;
      exit();
    }

    $sql = "SELECT * FROM users
            WHERE user_id = '" . $_SESSION['user_id'] . "';";
		$results = $mysqli->query($sql);
		if ( $results == false ) {
			echo $mysqli->error;
			exit();
		}
    $user_info = $results->fetch_assoc();
    $fname = $user_info['fname'];
    $email = $user_info['email'];
    $password = trim($user_info['password']);

    if(isset($_POST['old-password']) && isset($_POST['fname'])
      && isset($_POST['email']) && isset($_POST['new-password'])) {
      if(empty($_POST['old-password'])) {
        $error = "Please enter your password.";
      }
      else if(empty($_POST['fname']) || empty($_POST['email'])) {
        $error = "Name & email cannot be blank.";
      }
      else {
        if(password_verify($_POST['old-password'], $password)) {

          if(validPostAttr('fname')) {
            $fname = ucfirst($_POST['fname']);
          }
          if(validPostAttr('email')) {
            $email = $_POST['email'];
          }
          if(validPostAttr('new-password')) {
            $password = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
          }

          $update_sql = "UPDATE users
      			SET
      				fname = '" . $fname . "',
      				email = '" . $email . "',
      				password = '" . $password . "'
      			WHERE user_id = " . $_SESSION['user_id'] . ";";

          $update_results = $mysqli->query($update_sql);
      		if ( !$update_results ) {
      			echo $mysqli->error;
      			exit();
      		}
          else {
            $_SESSION['fname'] = $fname;
            $_SESSION['email'] = $email;

            $success = "Info updated successfully!";
          }
        }
        else {
          $error = "Incorrect password.";
        }
      }
    }
    $mysqli->close();
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
  	<div class="container signin-container" id="update-container">
      <div class="row">
  			<h3 class="col-12 text-center">Update your...</h3>
  		</div>

      <form action="update_info.php" method="POST">

        <?php if (isset($error) && !empty($error)): ?>
          <div class="row">
    				<div class="font-italic text-danger col-12">
    					<?php echo $error; ?>
    				</div>
    			</div> <!-- .row -->
        <?php endif; ?>
        <?php if (isset($success) && !empty($success)): ?>
          <div class="row">
    				<div class="font-italic text-success col-12">
    					<?php echo $success; ?>
    				</div>
    			</div> <!-- .row -->
        <?php endif; ?>

        <div class="form-group row align-items-center">
          <div class="col-sm-12 col-md-3 sub-text">
    				<h5>Name:</h5>
  				</div>
          <div class="col-sm-12 col-md-9">
  					<input type="text" class="form-control input-field" id="fname-id" name="fname" value="<?php echo $fname;?>" />
  				</div>
    		</div> <!-- .row -->
        <div class="form-group row align-items-center">
          <div class="col-sm-12 col-md-3 sub-text">
    				<h5>Email:</h5>
  				</div>
          <div class="col-sm-12 col-md-9">
  					<input type="text" class="form-control input-field" id="email-id" name="email" value="<?php echo $email;?>" />
  				</div>
    		</div> <!-- .row -->
        <div class="form-group row align-items-center">
          <div class="col-sm-12 col-md-3 sub-text">
    				<h5>Password:</h5>
  				</div>
          <div class="col-sm-12 col-md-9">
  					<input type="password" class="form-control input-field" id="new-password-id" name="new-password" placeholder="new password" />
  				</div>
    		</div> <!-- .row -->
        <div class="form-group row">
          <div class="col-12">
    				Enter old password to make changes:
  				</div>
          <div class="col-12">
  					<input type="password" class="form-control input-field" id="old-password-id" name="old-password" placeholder="old password" />
  				</div>
    		</div> <!-- .row -->

  			<div class="form-group row justify-center">
  				<div class="col-12 btn-bar">
  					<button type="submit" class="btn dark-button">Update</button>
  					<div class="p-2 inline sub-text"> or <a href="../pages/my_inspo.php">Cancel</a></div>
  				</div>
  			</div> <!-- .form-group -->

      </form> <!-- .form -->
  	</div> <!-- .container -->
  </div>
  <?php include '../shared/footer.php'; ?>
</body>
</html>
