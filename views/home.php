<div class="questions">
	<?php
	if($posts['type']){
		$questions = $posts['data'];
		for($i = 0; $i < count($questions); ++$i) {
			$question_id = $questions[$i]['id'];
			$question_title = $questions[$i]['title'];
			$question_desc = $questions[$i]['content'];
			$question_rating = $questions[$i]['rating'];
			$question_user = $questions[$i]['id_user'];
			$question_date = $questions[$i]['datetime'];
			$question_status = $questions[$i]['status'];
			$question_author = $questions[$i]['author'];
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
				if(UserController::isAuthor($question_user)){
					$vote = 'auth';
				} else {
					$vote = 'up';
				}
				if ($question_inc !== null) {
					if($question_inc == 1){ // NEED TO CHANGE <li> to form inputs
						?>
			 				<li class="<?=$vote?> voted-up"><div class="arrow">></div></li>
			 			<?php
					} else {
						?>
						<li class="<?=$vote?>"><div class="arrow">></div></li>
						<?php
					}
				} else {
						?>
						<li class="<?=$vote?>"><div class="arrow">></div></li>
						<?php
					}
				?>
			 	<li class="score_number rate"><?= $question_rating;?></li>
				<?php 
				if(UserController::isAuthor($question_user)){
					$vote = 'auth';
				} else {
					$vote = 'down';
				}
				if ($question_inc !== null) {
					if($question_inc == -1){
						?>
			 				<li class="<?=$vote?> voted-down"><div class="arrow"><</div></li>
			 			<?php
					} else {
						?>
						<li class="<?=$vote?>"><div class="arrow"><</div></li>
						<?php
					}
				} else {
						?>
						<li class="<?=$vote?>"><div class="arrow"><</div></li>
						<?php
					}
				?>
			</ul>
		</div>
					<?php
						if ($question_status == 1) {
							?>
							<img class="answer_check" src="assets/green_check.png" alt="ответ">
							<?php
						}
					?>
			<div class="question_content">
				<div class="question_title"><a href="/qna/<?=$question_id?>"><?= $question_title;?></a>
				<div class="question_info">Автор: <?=$question_author?><span class="question_date"><?=PostController::smartDate($question_date)?></span></div>
				</div>
				<div class="question_desc"><?= $question_desc;?></div>
		</div>
	</div>
	<?php
		}
	}
	?>
</div>