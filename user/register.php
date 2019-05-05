<!DOCTYPE html>
<?php
  require '../config/config.php';
  require '../shared/include.php';
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
  			<h3 class="col-12 text-center">Welcome :-)</h3>
  		</div>

      <form action="register_confirmation.php" method="POST">

        <div class="form-group row">
  				<div class="col-12">
  					<input type="text" class="form-control input-field" id="fname-id" name="fname" placeholder="first name" />
  				</div>
    		</div> <!-- .row -->
        <div class="form-group row">
  				<div class="col-12">
  					<input type="text" class="form-control input-field" id="email-id" name="email" placeholder="email" />
  				</div>
    		</div> <!-- .row -->
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
  					<button type="submit" class="btn dark-button">Register</button>
  					<div class="p-2 inline sub-text"> or <a href="signin.php">Sign In</a></div>
  				</div>
  			</div> <!-- .form-group -->

      </form> <!-- .form -->
  	</div> <!-- .container -->
  </div>

  <?php include '../shared/footer.php'; ?>

  <script>
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#fname-id').value.trim().length == 0 ) {
				document.querySelector('#fname-id').classList.add('is-invalid');
			} else {
				document.querySelector('#fname-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#email-id').value.trim().length == 0 ) {
				document.querySelector('#email-id').classList.add('is-invalid');
			} else {
				document.querySelector('#email-id').classList.remove('is-invalid');
			}

      if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>

</body>
</html>
