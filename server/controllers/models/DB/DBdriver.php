<?php


	class DB{
		
		protected static $_mysqli;

		protected static $_query;

		protected static $_instance;

		function __construct($host, $username, $password, $db, $port=NULL){
			if($port === NULL){
				$port = ini_get('mysqli.default_port');
			} 
			$this->_mysqli = new mysqli($host, $username, $password, $db, $port)
				or die("unable to establish mysqli connection");

			$this->_mysqli->set_charset('utf-8');

			self::$_instance = $this;
		}
		
		public function getInstance(){
			return self::$_instance;
		}

		public function queryDB($query, $type){
			$result = $this->_mysqli->query($query);
			if($result && ($type == "select" || $type == "update")){
				$response = array();
				while($row = $result->fetch_assoc()){
					array_push($response, $row);
				}
				$result->close();
				return $response;
			}
			else if($result && $type == "insert"){
				return true;
			}
			else{
				return false;
			}
		}
	}


?>