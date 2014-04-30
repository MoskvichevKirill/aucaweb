<?php include "header.php"; ?>
<div class="main">
	<div class="container">
		<?php
			if(count($params) != 0){
				ContentController::$action($params['id']);
			} else {
				ContentController::$action();
			}
		?>
	</div>
</div>
<?php include "footer.php"; ?>
<?php include "widgets.php"; ?>