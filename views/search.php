<div class="questions">
	<?php
	if($posts['type']){
		$questions = $posts['data'];
		for($i = 0; $i < count($questions); ++$i) {
			$question_id = $questions[$i]['id'];
			$question_title = $questions[$i]['title'];
			$question_desc = $questions[$i]['content'];
			$question_rating = $questions[$i]['rating'];
			if(isset($questions[$i]['inc'])){
				$question_inc = $questions[$i]['inc'];
			} else {
				$question_inc = null;
			}
		?>
	<div class="question" data-id="<?=$question_id;?>">
		<div class="score" data-id="<?=$question_id;?>">
			<ul>
				<?php
				if ($question_inc !== null) {
					if($question_inc == 1){
						?>
			 				<li class="up voted-up"><div class="arrow">></div></li>
			 			<?php
					} else {
						?>
						<li class="up"><div class="arrow">></div></li>
						<?php
					}
				} else {
						?>
						<li class="up"><div class="arrow">></div></li>
						<?php
					}
				?>
			 	<li class="score_number rate"><?= $question_rating;?></li>
				<?php 
				if ($question_inc !== null) {
					if($question_inc == -1){
						?>
			 				<li class="down voted-down"><div class="arrow"><</div></li>
			 			<?php
					} else {
						?>
						<li class="down"><div class="arrow"><</div></li>
						<?php
					}
				} else {
						?>
						<li class="down"><div class="arrow"><</div></li>
						<?php
					}
				?>
			</ul>
		</div>
			<div class="question_content">
				<div class="question_title"><a href="/aucaweb/app/<?=$question_id?>"><?= $question_title;?></a></div>
				<div class="question_desc"><?= $question_desc;?></div>
		</div>
	</div>
	<?php
		}
	}
	?>
</div>