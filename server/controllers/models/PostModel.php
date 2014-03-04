<?php

	function createPost($post){
		global $db;
		$title = $post['title'];
		$content = $post['content'];
		$id_user = $post['id_user'];
		$datetime = time();
		$rating = 0;
		$tags = $post['tags'];
		$id_post = $post['id_post'];
		$status = 0;
		if($id_post != null){
			$id_post = $post['id_post'];
			$query = "INSERT INTO post (title, content, id_user, datetime, rating, tags, status, id_post)
								VALUES ('$title', '$content', '$id_user', '$datetime', '$rating', '$tags', $status, $id_post)";

		} else {
			$query = "INSERT INTO post (title, content, id_user, datetime, rating, tags, status)
								VALUES ('$title', '$content', '$id_user', '$datetime', '$rating', '$tags', $status)";
		}
		$result = $db->queryDB($query, "insert");
		if($result) {
			return array('type' => true, 'data' => NULL);
		} else {
			return array('type' => false, 'data' => NULL);
		}
	}
	function deletePost($postID){
		global $db;
		$id_user = $_SESSION['user']['id'];
		$query = "DELETE FROM post WHERE id_user = '$id_user' and id = '$id'";
		$result = $db->queryDB($query, "delete");
		if($result){
			return array('type' => true, 'data' => NULL);
		} else {
			return array('type' => false, 'data' => NULL);
		}
	}
	function GetPosts($page){
		global $db;
		$limit = 30 * $page;
		$query = "SELECT * FROM post WHERE id_post IS NULL LIMIT '$limit'";
		$result = $db->queryDB($query, "select");
		if($result){
			return array('type' => true, 'data' => $result);
		} else {
			return array('type' => false, 'data' => NULL);
		}
	}


?>