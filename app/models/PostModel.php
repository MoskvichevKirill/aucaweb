<?php
	function createPost($post){
		global $db;
		$title = $post['title'];
		$content = $post['content'];
		$id_user = $post['id_user'];
		$rating = 0;
		$tags = $post['tags'];
		$id_post = $post['id_post'];
		$status = 0;
		if($id_post != null){
			$id_post = $post['id_post'];
			$query = "INSERT INTO post (title, content, id_user, datetime, rating, status, id_post)
								VALUES ('$title', '$content', '$id_user', NOW(), '$rating', $status, $id_post)";

		} else {
			$query = "INSERT INTO post (title, content, id_user, datetime, rating, status)
								VALUES ('$title', '$content', '$id_user', NOW(), '$rating', $status)";
		}
		$result = $db->queryDB($query, "insert");
		if($result && $id_post == null) {
			$insert_id = $db->getLastID();
			$res = insertTags($insert_id, $tags);
			if($res){
				return array('type' => true, 'data' => NULL);
			}
			else{
				return array('type' => false, 'data' => NULL);
			}
		} else if($result && $id_post != null){
			if($result){
				return array('type' => true, 'data' => NULL);
			}
			else{
				return array('type' => false, 'data' => NULL);
			}
		} else {
			return array('type' => false, 'data' => NULL);
		}
	}
	function insertTags($post_id, $tags){
		global $db;
		$res = false;
		for ($i=0; $i < count($tags); $i++) {
			$tag = $tags[$i];
			$query = "INSERT INTO tags (post_id, tag) 
								VALUES ('$post_id', '$tag')";
			$result = $db->queryDB($query, "insert");
			if(!$result){
				return false;
			}
		}
		return true;
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
		$query = "SELECT * FROM post WHERE id_post IS NULL LIMIT $limit";
		$result = $db->queryDB($query, "select");
		if($result){
			return array('type' => true, 'data' => $result);
		} else {
			return array('type' => false, 'data' => $result);
		}
	}
	function GetComments($id){
		global $db;
		$query = "SELECT `post`.`id`, `title`, `content`, `user`.`username`, `datetime`, `rating`
							FROM post 
							JOIN user
							ON `user`.`id` = `post`.`id_user`
							WHERE id_post = '$id'
							ORDER BY datetime DESC";
		$result = $db->queryDB($query, "select");
		if($result){
			for ($i=0; $i < count($result); $i++) {
					$res = GetComments($result[$i]['id']);
					$result[$i]['comments'] = $res;
			}
			return $result;
		} else {
			return $result;
		}
	}

	function GetPost($id){
		global $db;
		$query = "SELECT * FROM post WHERE id = '$id'";
		$result = $db->queryDB($query, "select");
		if($result){
			return array('type' => true, 'data' => $result);
		} else {
			return array('type' => false, 'data' => $result);
		}
	}

	function RatePost($id_post, $inc){
		global $db;
		// need to be fixed
		$id_user = $_SESSION['user']['id'];
		$q = "SELECT COUNT(*) as count, inc FROM rate WHERE id_post = '$id_post' and id_user = '$id_user'";
		$count = $db->queryDB($q, "select");
		$result = false;
		$entity_inc_value = null;
		if(intval($count[0]['count']) > 0){
			$entity_inc_value = $count[0]['inc'];
			if($entity_inc_value != $inc && $entity_inc_value != 0){
				$q = "UPDATE rate
							SET inc = '$inc'
							WHERE id_post = '$id_post' AND id_user = '$id_user'";
				$res = $db->queryDB($q, "update");
			} else {
				$res = false;
			}
		} else {
			$q = "INSERT INTO rate (id_post, id_user, inc)
						VALUES('$id_post', '$id_user', '$inc')";
			$res = $db->queryDB($q, "insert");
		}
		if($res){
			if($inc == 0 && $entity_inc_value == -1){
				$inc = 1;
			} else if($inc == 0 && $entity_inc_value == 1){
				$inc = -1;
			} else if($inc == -1 && $entity_inc_value == 1){
				$inc = -2;
			} else if($inc == 1 && $entity_inc_value == -1){
				$inc = 2;
			}
			$q = "UPDATE post
						SET rating = rating + '$inc'
						WHERE id = '$id_post'";
			$result = $db->queryDB($q, "update");
			if($result){
				return array('type' => true, 'data' => $result);
			} else {
				return array('type' => false, 'data' => $result);
			}
		} else {
			return array('type' => false, 'data' => $result);
		}
		
			
	}
?>
