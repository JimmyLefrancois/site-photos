<?php

	abstract class Container
	{
		public function getPdo()
		{
			static $pdo;
			$attr_utf8 = array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //
			$pdo = new PDO('mysql:host=127.0.0.1; dbname=jimmy', 'root', '', $attr_utf8);
			return $pdo;
		}
	}
