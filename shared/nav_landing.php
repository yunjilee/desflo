<nav class="container-fluid p-2" id="landing-container">
	<div class="row">
		<div class="col-6 d-flex justify-content-start">
				<div class="p-2 header-overlay extra-bold">GET<br>INSPIRED</div>
		</div>
		<div class="col-6 d-flex justify-content-end">

			<?php if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']): ?>

				<a class="p-2 text-right extra-bold sub-text" href="user/signin.php">Sign In</a>

			<?php else: ?>

				<a class="p-2" href="pages/my_inspo.php">My Inspo</a>
				<a class="p-2" href="user/signout.php">Sign Out</a>

			<?php endif; ?>

		</div>
	</div>
</nav>
