<?php

require __DIR__ . '../../../application/autoload.php';
require __DIR__ . '../../../vendor/autoload.php';

$countryModel = new CountryModel();

if (isset($_POST['submit-country'])) {
	if (isset($_POST["name"])) $countryModel->name = $_POST["name"];
			else $countryModel->name = NULL;

	$date = new DateTime();
	$date = $date->format('c');

	$countryModel->date = $date;

	$check = $countryModel->checkIfExist($_POST["name"]);
	$check = (int) $check->count;

	if ($check > 0) $countryModel->countryExist = true;
		else $countryModel->countryExist = false;

	if ($countryModel->isValid()) {
		$countryModel->save();
		$confirmation = true;
		$_POST = array();
	} else {
		$errors = $countryModel->getErrors();
	}
}
