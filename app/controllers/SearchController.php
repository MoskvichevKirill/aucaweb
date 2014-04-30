<?php
	class SearchController{
		function search_split_terms($terms){

			$terms = preg_replace("/\"(.*?)\"/e", "search_transform_term('\$1')", $terms);
			$terms = preg_split("/\s+|,/", $terms);

			$out = array();

			foreach($terms as $term){

				$term = preg_replace("/\{WHITESPACE-([0-9]+)\}/e", "chr(\$1)", $term);
				$term = preg_replace("/\{COMMA\}/", ",", $term);

				$out[] = $term;
			}

			return $out;
		}

		function search_transform_term($term){
			$term = preg_replace("/(\s)/e", "'{WHITESPACE-'.ord('\$1').'}'", $term);
			$term = preg_replace("/,/", "{COMMA}", $term);
			return $term;
		}

		function search_escape_rlike($string){
			return preg_replace("/([.\[\]*^\$])/", '\\\$1', $string);
		}

		function search_db_escape_terms($terms){
			$out = array();
			foreach($terms as $term){
				$out[] = '[[:<:]]'.AddSlashes(SearchController::search_escape_rlike($term)).'[[:>:]]';
			}
			return $out;
		}

		function search($terms){
			global $db;

			$terms = SearchController::search_split_terms($terms);
			$terms_db = SearchController::search_db_escape_terms($terms);
			$terms_rx = SearchController::search_rx_escape_terms($terms);

			$parts = array();
			foreach($terms_db as $term_db){
				$parts[] = "post.title RLIKE '$term_db' OR post.content RLIKE '$term_db'";
			}
			$parts = implode(' AND ', $parts);

			$sql = "SELECT * FROM post WHERE $parts and id_post = null";

			$result = $db->queryDB($sql, "select");

			return array('type' => true, 'data' => $result, 'question' => $terms);
		}

		function search_rx_escape_terms($terms){
			$out = array();
			foreach($terms as $term){
				$out[] = '\b'.preg_quote($term, '/').'\b';
			}
			return $out;
		}

		function search_sort_results($a, $b){

			$ax = $a[score];
			$bx = $b[score];

			if ($ax == $bx){ return 0; }
			return ($ax > $bx) ? -1 : 1;
		}

		function search_html_escape_terms($terms){
			$out = array();

			foreach($terms as $term){
				if (preg_match("/\s|,/", $term)){
					$out[] = '"'.HtmlSpecialChars($term).'"';
				}else{
					$out[] = HtmlSpecialChars($term);
				}
			}

			return $out;
		}

		function search_pretty_terms($terms_html){

			if (count($terms_html) == 1){
				return array_pop($terms_html);
			}

			$last = array_pop($terms_html);

			return implode(', ', $terms_html)." and $last";
		}


	#
	# do the search here...
	#
	// $term_list = search_pretty_terms(search_html_escape_terms(search_split_terms($HTTP_GET_VARS[q])));
	}

?>