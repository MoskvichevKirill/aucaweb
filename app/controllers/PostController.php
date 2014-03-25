<?php
	require "models/PostModel.php";
	class PostController{

		function addPost(){
			if($_SESSION['user'] !== NULL){
				$post = array();
				$post['id_user'] = $_SESSION['user']['id'];
				$post['title'] = $_POST['title'];
				$post['content'] = $_POST['content'];
				$post['tags'] = explode(',', $_POST['tags']); // Need to sql escape and parse to array
				$post['datetime'] = time();
				$post['rating'] = 0;
				if($_POST['id_post'] !== null){
					$post['id_post'] = $_POST['id_post'];
				}
				$result = createPost($post);
				if($result['type']){
					$response = array("success" => true, "message" => "Пост успешно создан" ,"data" => NULL);
				} else {
					$response = array("success" => false, "message" => "Не удалось создать пост" ,"data" => NULL);
				}
			}	else {
				$response = array("success" => fail, "message" => "Не авторизированный пользователь" ,"data" => NULL);
			}
			echo json_encode($response);
		}

		function deletePost($postID){
			$result = deletePost($postID);
			if($result['type']){
				$response = array("success" => true, "message" => "Post was deleted" ,"data" => NULL);
			} else {
				$response = array("success" => false, "message" => "Failed to delete post" ,"data" => NULL);
			}
			echo json_encode($response);
		}

		function updatePost(){

		}

		function commentPost(){

		}

		function ratePost(){
		}

		function getPosts($page = 1){
			$result = GetPosts($page);
			if($result['type']){
				$response = array("success" => true, "message" => "Got 30 posts!" ,"data" => $result['data']);
			} else {
				$response = array("success" => true, "message" => "Something is wrong" ,"data" => NULL);
			}
			return $result;
		}
	}

?>