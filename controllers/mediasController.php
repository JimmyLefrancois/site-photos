<?php
	require __DIR__ . '/../application/autoload.php';
	require __DIR__ . '/../vendor/autoload.php';

	function uploadFile()
	{
		$file = $_FILES['media'];
		var_dump($file);
		exit;
	}


