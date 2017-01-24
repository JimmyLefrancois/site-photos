<?php

require __DIR__ . '../../../application/autoload.php';
require __DIR__ . '../../../vendor/autoload.php';

$albumModel = new AlbumModel();

if (isset($_POST['submit-album'])) {
	if (isset($_POST["name"])) $albumModel->name = $_POST["name"];
			else $albumModel->name = NULL;

	$date = new DateTime();
	$date = $date->format('c');

	$albumModel->date = $date;

	$check = $albumModel->checkIfExist($_POST["name"]);
	$check = (int) $check->count;

	if ($check > 0) $albumModel->albumExist = true;
		else $albumModel->albumExist = false;

	if ($albumModel->isValid()) {
		$albumModel->save();
		$confirmation = true;
		$_POST = array();
	} else {
		$errors = $albumModel->getErrors();
	}
}
