<nav class="container-fluid p-2">

	<div class="row nav-search-row">
		<div class="col-6 d-flex justify-content-start align-items-center">

				<h5><a class="p-2 logo" href="../index.php">DESFLO</a></h5>

				<div class="mini-search-bar-1">
		      <form class="search-form" action="results.php?" method="GET">
		        <div class="form-group row justify-space-between">
		          <div class="col-1">
		            <input type="text" class="form-control mini-color" name="color" readonly />
		            <?php include '../assets/color_picker/color_picker_nav.js'; ?>
		  				</div>
							<div class="mini-space"></div>
		  				<div class="col-9">
		  					<input type="text" class="form-control mini-input-field keyword-id" name="keyword" value="<?php echo $keyword; ?>" placeholder="nature" />
		  				</div>
		    			<div class="col-1">
		            <input type="image" name="submit" class="mini-submit" alt="submit-search" src="../assets/images/search_icon.svg" />
		    			</div>
		    		</div> <!-- .row -->
		      </form> <!-- .form -->
		  	</div> <!-- .container -->

		</div>
		<div class="col-6 d-flex justify-content-end align-items-center">

			<?php if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']): ?>

				<a class="p-2 text-right extra-bold sub-text" href="../user/signin.php">Sign In</a>

			<?php else: ?>

				<?php if($_SESSION['page_id'] != 3) : ?>
					<a class="p-2" href="my_inspo.php">My Inspo</a>
				<?php else : ?>
					<a class="p-2" href="../user/update_info.php">Update Info</a>
				<?php endif; ?>
				<a class="p-2" href="../user/signout.php">Sign Out</a>

			<?php endif; ?>

		</div>
	</div>

	<div class="row nav-search-row">
		<div class="col-12 d-flex justify-content-start align-items-center">
			<div class="mini-search-bar-2">
				<form class="search-form" action="results.php?" method="GET">
					<div class="form-group row justify-space-between">
						<div class="col-1">
							<input type="text" class="form-control mini-color" name="color" readonly />
							<?php include '../assets/color_picker/color_picker_nav.js'; ?>
						</div>
						<div class="mini-space"></div>
						<div class="col-9">
							<input type="text" class="form-control mini-input-field keyword-id" name="keyword" value="<?php echo $keyword; ?>" placeholder="nature" />
						</div>
						<div class="col-1">
							<input type="image" name="submit" class="mini-submit" alt="submit-search" src="../assets/images/search_icon.svg" />
						</div>
					</div> <!-- .row -->
				</form> <!-- .form -->
			</div> <!-- .container -->
		</div>
	</div>

</nav>
