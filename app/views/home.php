<div class="questions">
	<?php
	if($posts['type']){
		$questions = $posts['data'];
		for($i = 0; $i < count($questions); ++$i) {
			$question_title = $questions[$i]['title'];
			$question_desc = $questions[$i]['content'];
			$question_rating = $questions[$i]['rating'];
		?>
	<div class="question">
		<div class="score">
			<ul>
			 	<li class="up"><div class="arrow">></div></li>
			 	<li class="score_number"><div><?= $question_rating;?></div></li>
			 	<li class="down"><div class="arrow"><</div></li>
			</ul>
		</div>
			<div class="question_content">
				<div class="question_title"><a href="#question"><?= $question_title;?></a></div>
				<div class="question_desc"><?= $question_desc;?></div>
		</div>
	</div>
	<?php
		}
	}
	?>
</div>