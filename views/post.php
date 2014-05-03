<?php
if($post['type']){
	$question = $post['data'][0];
}
$comments = $post['comments'];
function showComments($comments, $level, $question){
	for ($i=0; $i < count($comments); $i++) {
		if ($comments[$i]['status'] == 1) {
		?>
			<div class="comment answer" data-id="<?= $comments[$i]['id']?>">
				<?php
		} else {
			?>
			<div class="comment" data-id="<?= $comments[$i]['id']?>">
			<?php
		}
				?>
				<div class="comment-info">
					<div class="comment-rating rate"><?= $comments[$i]['rating']?></div>
					<?php
					if(UserController::isAuthor($comments[$i]['id_user'])){
						$vote = 'auth';
					} else {
						$vote = 'up';
					}
					?>
					<div class="<?=$vote?> like"><div class="arrow">></div></div>
					<?php
					if(UserController::isAuthor($comments[$i]['id_user'])){
						$vote = 'auth';
					} else {
						$vote = 'down';
					}
					?>
					<div class="dislike <?=$vote?>"><div class="arrow"><</div></div>
					<div class="comment-author"><?= $comments[$i]['username']?></div>
					<div class="date"><?= PostController::smartDate($comments[$i]['datetime'])?></div>
					<?php
					if ($comments[$i]['status'] == 1) {
					?>
						<img class="answer_check" src="assets/green_check.png" alt="ответ">
					<?php
					}
					if ($level == 1 && UserController::isAuthor($question['id_user']) && !UserController::isAuthor($comments[$i]['id_user']) && $question['status'] == 0) {
					?>
					<div class="ans">Пометить как ответ</div>
					<?php
					}
					?>
				</div>
				<div class="comment-content">
					<?php
					if(!empty($comments[$i])){
						if($comments[$i]['content']){
							echo $comments[$i]['content'];
						}
					}
					?>
				</div>
				<?php if(UserController::getUser() !== null){ ?>
				<a href="" class="reply-comment" id=""> Ответить </a>
				<div class="reply-form">
					<form action="" class="comment-form" data-id="<?=$comments[$i]['id'];?>" novalidate>
						<textarea name="comment" id="" cols="30" rows="10" class="inp-comment" required></textarea>
						<input type="text" name="id_post" value="<?=$comments[$i]['id'];?>" hidden>
						<input type="submit" class="btn-reply" value="Отправить">
					</form>
					<form action=""></form>
				</div>
				<?php }?>
			</div>
			<div class="comments">
				<?php if(!empty($comments[$i])){showComments($comments[$i]['comments'], $level+1, $question);} ?>
			</div>
		<?php
	}
}
?>
<div class="single_post">
	<div class="question" data-id="<?=$question['id'];?>">
		<div class="score" data-id="<?=$question['id'];?>">
			<ul>
			 	<?php 
			 	if(UserController::isAuthor($question['id_user'])){
					$vote = 'auth';
				} else {
					$vote = 'up';
				}
				if ($question['inc'] !== null) {
					if($question['inc'] == 1){
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
			 	<li class="score_number rate single_post_rate"><?= $question['rating'];?></li>
				<?php 
				if(UserController::isAuthor($question['id_user'])){
					$vote = 'auth';
				} else {
					$vote = 'down';
				}
				if ($question['inc'] !== null) {
					if($question['inc'] == -1){
						?>
			 				<li class="<?=$vote?><?=$vote?> voted-down"><div class="arrow"><</div></li>
			 			<?php
					} else {
						?>
						<li class="<?=$vote?><?=$vote?>"><div class="arrow"><</div></li>
						<?php
					}
				} else {
						?>
						<li class="<?=$vote?><?=$vote?>"><div class="arrow"><</div></li>
						<?php
					}
				?>
			</ul>
		</div>
		<div class="question_content_full">
			<div class="question_title"><a href="#question"><?= $question['title'];?></a>
				<div class="question_info">Автор: <?=$question['author']?><span class="question_date"><?=PostController::smartDate($question['datetime'])?></span></div></div>
			<div class="question_desc_full"><?=$question['content'];?></div>
		</div>
	</div>
	<?php
	if(UserController::getUser() !== null){
	?>
	<div>
		<form action="" class="comment-form" novalidate>
			<textarea name="comment" id="comment" cols="30" rows="10" class="inp-comment" placeholder="Оставьте ваш ответ или мнение тут" required></textarea>
			<input type="text" name="id_post" value="<?=$question['id'];?>" hidden>
			<input type="submit" class="btn" value="Отправить">
		</form>
	</div>
	<?php
	}
	?>
	<div class="comments">
			<?php showComments($comments, 1, $question);?>
	</div>
</div>
