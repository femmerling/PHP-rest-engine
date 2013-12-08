<?php

require_once('../config/Config.php');

final class DatabaseConnection
{
	public static $instance = null;
	public static $connection = null;

	public static function getInstance()
	{	
		if($this->instance === null){
			$this->instance = new Database();
		}
		return $this->instance;
	}

	private function __clone(){}

	private function __construct()
	{
		$dbConfig = Config.getDatabaseCredentials();
		$this->connection = mysqli_connect(
								$dbConfig['host'],
								$dbConfig['user'],
								$dbConfig['password'],
								$dbConfig['host']
							) or die(mysql_error());
	}
}

?>
