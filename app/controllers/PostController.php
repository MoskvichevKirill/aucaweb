<?php
	require "models/PostModel.php";
	class PostController{

		function addPost(){
			if(UserController::getUser() != null){
				$post = array();
				$post['id_user'] = UserController::getUser()['id'];
				$post['title'] = strip_tags(stripslashes(mysql_real_escape_string($_POST['title'])));
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
				$response = array("success" => false, "message" => "Не авторизированный пользователь" ,"data" => NULL);
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

		function getPosts($page = 1){
			$result = GetPosts($page);
			// $result = GetComments($page);
			if($result['type']){
				// $response = array("success" => true, "message" => "Got 30 posts!" ,"data" => $result['data']);
				return $result;
			} else {
				// $response = array("success" => true, "message" => "Something is wrong" ,"data" => NULL);
			}
		}
		function getPost($id){
			$post = GetPost($id);
			if($post['type']){
				$result = GetComments($id);
				if($result){
					$post['comments'] = $result;
					return $post;
				} else {
					$post['comments'] = [];
					return $post;
				}
			} else {
				 header( 'Location: http://localhost:8080/aucaweb/app/e404' );
			}
		}
		function ratePost(){
			$id_post = $_POST['id_post'];
			$inc = $_POST['inc'];
			$rate = RatePost($id_post, $inc);
			if($rate['type']){
				$response = array("success" => true, "message" => "Post was rated" ,"data" => $rate['data']);
			}else {
				$response = array("success" => false, "message" => "Post was not rated" ,"data" => $rate['data']);
			}
			echo json_encode($response);
		}
		function setAnswer(){
			$id_post = $_POST['id_post'];
			$id_ans = $_POST['id_ans'];
			$result = SetAnswers($id_post, $id_ans);
			if($result['type']){
				$response = array("success" => true, "message" => "Ответ получен!" ,"data" => null);
			} else {
				$response = array("success" => false, "message" => "Ошибка!" ,"data" => null);
			}
			echo json_encode($response);
		}
		function smartDate($date){
			$minute = 60;
			$hour = 60 * $minute;
			$day = $hour * 24;
			$week = $day * 7;
			$year = $day * 365;
			$timestp = strtotime($date);
			$now = strtotime(date("Y-m-d H:i:s"));
			$left = $now - $timestp;
			if($left >= $year){
				echo round($left / $year).' л. ';
				echo "назад";
			} else if ($left >= $week){
				echo round($left / $week).' н. ';
				echo "назад";
			} else if($left >= $day){
				echo round($left / $day).' д. ';
				echo "назад";
			} else if($left >= $hour) {
				echo round($left / $hour).' ч. ';
				echo "назад";
		  } else if($left >= $minute) {
				echo 'только что';
				$left = 0;
			} else {
				echo 'только что';
			}
			
		}
	}

?>
