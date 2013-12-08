<?php

class Config
{
	/* 
	Below are database connection configurations.
	Please define other configs in this file and create a static public function to access it.
	*/

	const DATABASE_CREDENTIALS = array(
										'host' => 'localhost:8889', // I am using port since I am using MAMP on OSX
										'name' => 'books_db',
										'user' => 'books_user',
										'password' => 'password01'
									  );

	public static function getDatabaseCredentials()
	{
		return self::DATABASE_CREDENTIALS;
	}
}

?>