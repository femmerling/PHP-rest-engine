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
				$queryString = "SELECT * FROM books_db.books";
				if($data['id']){
					$queryString = "SELECT * FROM books_db.books WHERE books_db.books.id = ".$data["id"];
				}
				if($result = $connection->query($queryString)){
					$tempArray = array();
			        while($row = $result->fetch_object()) {
			                $tempArray = $row;
			                array_push($resultArray, $tempArray);
			            }
			        $request->sendResponse(200,json_encode($resultArray));
				}
				break;
			case 'put':
				// TODO: build this
				break;
			case 'post':
				$data_length = count($data);
				$index = 0;
				$queryString = "INSERT INTO books_db.books VALUES(NULL,";

				foreach ($data as $key => $value) {
					$queryString .= "\"".$value."\"";
					if($index < $data_length-1){
						$queryString .= ", ";
					}
					$index++;
				}
				$queryString .= ")";
				$connection->query($queryString);
				$fetchString = "SELECT * FROM books_db.books";
				if($result = $connection->query($fetchString)){
					$tempArray = array();
			        while($row = $result->fetch_object()) {
			                $tempArray = $row;
			                array_push($resultArray, $tempArray);
			            }
			        $request->sendResponse(200,json_encode(end($resultArray)));
				}
				break;
			case 'delete':
				if($data['id']){
					$queryString = "DELETE FROM books_db.books WHERE books_db.books.id = ".$data["id"];
					$connection->query($queryString);
					$request->sendResponse(204);
				}
				break;
			default:
				break;
		}
	}
}
?>