<?php

require_once(dirname(dirname(__FILE__))."/config/Config.php");

final class DatabaseConnection
{
	public static $instance = null;
	public static $connection = null;

	public static function getInstance()
	{	
		if(self::$instance === null){
			self::$instance = new DatabaseConnection();
		}
		return self::$instance;
	}

	private function __clone(){}

	private function __construct()
	{
		$dbConfig = Config::getDatabaseCredentials();
		self::$connection = mysqli_connect(
								$dbConfig['host'],
								$dbConfig['user'],
								$dbConfig['password'],
								$dbConfig['name']
							) or die(mysql_error());
	}
}

?>
