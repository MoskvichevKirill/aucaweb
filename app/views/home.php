<div class="questions">
	<?php
	if($posts['type']){
		$questions = $posts['data'];
		for($i = 0; $i < count($questions); ++$i) {
			$question_id = $questions[$i]['id'];
			$question_title = $questions[$i]['title'];
			$question_desc = $questions[$i]['content'];
			$question_rating = $questions[$i]['rating'];
		?>
	<div class="question" data-id="<?=$question_id;?>">
		<div class="score" data-id="<?=$question_id;?>">
			<ul>
			 	<li class="up"><div class="arrow">></div></li>
			 	<li class="score_number"><div class="rate_num"><?= $question_rating;?></div></li>
			 	<li class="down"><div class="arrow"><</div></li>
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