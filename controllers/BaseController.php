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
					$query_string = "SELECT * FROM books_db.books WHERE books_db.books.id = ".$data["id"];
				}
				if($result = $connection->query($query_string)){
					$tempArray = array();
			        while($row = $result->fetch_object()) {
			                $tempArray = $row;
			                array_push($resultArray, $tempArray);
			            }
			        $request->sendResponse(200,json_encode($resultArray));
				}
				break;
			case 'put':
				break;
			case 'post':
				break;
			case 'delete':
				if($data['id']){
					$query_string = "DELETE FROM books_db.books WHERE books_db.books.id = ".$data["id"];
					$connection->query($query_string);
					$request->sendResponse(204);
				}
				break;
			default:
				break;
		}
	}
}
?>