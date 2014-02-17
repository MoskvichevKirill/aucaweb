<?php
	require "DB/DBdriver.php";

	function createPost($post){
		global $db;
		$title = $post['title'];
		$content = $post['content'];
		$id_user = $_SESSION['user']['id'];
		$datetime = time();
		$rating = 0;
		$tags = $post['tags'];
		$status = false;
		if($post['id_post'] !== NULL){
			$id_post = $post['id_post'];
		} else {
			$id_post = NULL;
		}
		$query = "INSERT INTO post (title, content, id_user, datetime, rating, tags, status, id_post) 
							VALUES ('$title', '$content', '$id_user', '$datetime', '$rating', '$tags', '$id_post')";
		$result = $db->queryDB($query);
		if($result) {
			return array('type' => true, 'data' => $result[0]);
		} else {
			return array('type' => false, 'data' => NULL);
		}
	}


?>