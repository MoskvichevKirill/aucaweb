<?php
if($post['type']){
	$question = $post['data'][0];
}
$comments = $post['comments'];
function showComments($comments){
	for ($i=0; $i < count($comments); $i++) {
		?>
			<div class="comment" data-id="<?= $comments[$i]['id']?>">
				<div class="comment-info">
					<div class="comment-rating"><?= $comments[$i]['rating']?></div>
					<div class="like up"><div class="arrow">></div></div><div class="dislike down"><div class="arrow"><</div></div>
					<div class="comment-author"><?= $comments[$i]['username']?></div>
					<div class="date"><?= $comments[$i]['datetime']?></div>
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
					<form action="" class="comment-form" data-id="<?=$comments[$i]['id'];?>">
						<textarea name="comment" id="" cols="30" rows="10" class="inp-comment" required></textarea>
						<input type="text" name="id_post" value="<?=$comments[$i]['id'];?>" hidden>
						<input type="submit" class="btn-reply" value="Отправить">
					</form>
				</div>
				<?php }?>
			</div>
			<div class="comments">
				<?php if(!empty($comments[$i])){showComments($comments[$i]['comments']);} ?>
			</div>
		<?php
	}
}
?>
<div class="single_post">
	<div class="question" data-id="<?=$question['id'];?>">
		<div class="score">
			<ul>
			 	<li class="up"><div class="arrow">></div></li>
			 	<li class="score_number"><div><?=$question['rating'];?></div></li>
			 	<li class="down"><div class="arrow"><</div></li>
			</ul>
		</div>
		<div class="question_content">
			<div class="question_title"><a href="#question"><?= $question['title'];?></a></div>
			<div class="question_desc_full"><?=$question['content'];?></div>
		</div>
	</div>
	<?php
	if(UserController::getUser() !== null){
	?>
	<div>
		<form action="" class="comment-form">
			<textarea name="comment" id="" cols="30" rows="10" class="inp-comment" required></textarea>
			<input type="text" name="id_post" value="<?=$question['id'];?>" hidden>
			<input type="submit" class="btn" value="Отправить">
		</form>
	</div>
	<?php
	}
	?>
	<div class="comments">
			<?php showComments($comments);?>
	</div>
</div>
