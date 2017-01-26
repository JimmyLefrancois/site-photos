<?php

	abstract class Container
	{
		public function getPdo()
		{
			static $pdo;
			$attr_utf8 = array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //
			$pdo = new PDO('mysql:host=localhost; dbname=jimmy', 'jimmy', '', $attr_utf8);
			return $pdo;
		}
	}
