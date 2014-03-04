<?php include "header.php"; ?>
<div class="main">
	<div class="container">
		<?php
			ContentController::$action();
		?>
	</div>
</div>
<?php include "footer.php"; ?>
<?php include "widgets.php"; ?>