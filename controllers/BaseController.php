<?php

require_once(dirname(dirname(__FILE__))."/lib/RestHandler.php");
require_once(dirname(dirname(__FILE__))."/lib/DatabaseConnection.php");

class BaseController
{
	public function __construct()
	{
		$handler = new RestHandler();
		$request = $handler->processRequest();
		$method = $request->getMethod();
		$data = $request->getData();
		error_log("jreng jreng");
		error_log($data);
		$dbInstance = DatabaseConnection::getInstance();
		$resultArray = array();
		switch ($method) {
			case 'get':
				$query;
				if($data && isset($data["id"])){
					$query = "SELECT * FROM books_db.books WHERE books.id == ".$data["id"];
				}else{
					$query = "SELECT * FROM books_db.books";
				}
				if ($result = mysql_query("SELECT * FROM phase1")) {
			        $tempArray = array();
			        while($row = $result->fetch_object()) {
			                $tempArray = $row;
			                array_push($resultArray, $tempArray);
			            }
			        echo json_encode($resultArray);
			    }else{
			    	echo "uhuy";
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