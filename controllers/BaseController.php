<?php

require_once(dirname(dirname(__FILE__))."/lib/RestHandler.php");
require_once(dirname(dirname(__FILE__))."/lib/DatabaseConnection.php");

class BaseController
{
	public function __construct()
	{
		$request = new RestHandler();
		$request->processRequest();
		$method = $request->getMethod();
		$data = $request->getData();
		$dbInstance = DatabaseConnection::getInstance();
		$connection = $dbInstance::$connection;
		$resultArray = array();
		switch ($method) {
			case 'get':
				$query_string = "SELECT * FROM books_db.books";
				if($data['id']){
					error_log("ID existed");
					$query_string = "SELECT * FROM books_db.books WHERE books_db.books.id = ".$data["id"];
				}

				error_log($query_string);
				if($result = $connection->query($query_string)){
					error_log("in result block");
					$tempArray = array();
			        while($row = $result->fetch_object()) {
			                $tempArray = $row;
			                array_push($resultArray, $tempArray);
			            }
			        echo json_encode($resultArray);
				}
				break;
			case 'put':
				break;
			case 'post':
				break;
			case 'delete':
				break;
			default:
				break;
		}
	}
}
?>