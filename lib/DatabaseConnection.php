<?php

require_once('../config/Config.php');

final class DatabaseConnection
{
	public static $instance = null;
	private static $conection = null;

	public static function Instance()
	{	
		if($this->instance === null){
			$this->instance = new Database();
		}
		return $this->instance;
	}

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
