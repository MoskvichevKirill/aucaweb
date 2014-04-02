<?php
if($post['type']){
	$question = $post['data'][0];
}
$comments = $post['comments'];
function showComments($comments){
	for ($i=0; $i < count($comments); $i++) { 
		?>
		<!-- <div class="score">
			<ul>
			 	<li class="up"><div class="arrow">></div></li>
			 	<li class="score_number"><div></div></li>
			 	<li class="down"><div class="arrow"><</div></li>
			</ul>
		</div> -->
		<div >
			<div>
				<?php
				if(!empty($comments[$i])){ 
					echo $comments[$i]['content'];
				}
				?>
			</div>
			<div class="comments">
				<?php if(!empty($comments[$i])){showComments($comments[$i]['comments']);} ?>
			</div>
		</div>
		<?php
	}
}
?>
<div class="single_post">
	<div class="question">
		<div class="score">
			<ul>
			 	<li class="up"><div class="arrow">></div></li>
			 	<li class="score_number"><div><?= $question['rating'];?></div></li>
			 	<li class="down"><div class="arrow"><</div></li>
			</ul>
		</div>
		<div class="question_content">
			<div class="question_title"><a href="#question"><?= $question['title'];?></a></div>
			<div class="question_desc"><?= $question['content'];?></div>
		</div>
	</div>
	<div class="comments">
		<div class="comment">
			
				<?php showComments($comments);?>
		</div>
	</div>
</div>