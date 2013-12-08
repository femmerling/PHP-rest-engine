<?php

class Config
{
	/* 
	Below are database connection configurations.
	Please define other configs in this file and create a static public function to access it.
	*/

	private static $db_credentials = array(
									'host' => 'localhost',
									'name' => 'books_db',
									'user' => 'books_user',
									'password' => 'password01'
							  );
	public static function getDatabaseCredentials()
	{
		return self::$db_credentials;
	}
}

?>