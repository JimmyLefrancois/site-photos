<?php

require __DIR__ . '../../../application/autoload.php';
require __DIR__ . '../../../vendor/autoload.php';

$cityModel = new CityModel();
$countryModel = new CountryModel();
$countries = $countryModel->getAll();

if (isset($_POST['submit-city'])) {
	if (isset($_POST["name"])) $cityModel->name = $_POST["name"];
			else $cityModel->name = NULL;

	if (isset($_POST["country"]) && $_POST["country"] != "0") $cityModel->country_id = $_POST["country"];
			else $cityModel->country_id = NULL;

	$date = new DateTime();
	$date = $date->format('c');

	$cityModel->date = $date;

	$check = $cityModel->checkIfCityCountryExist($_POST["name"], $_POST["country"]);
	$check = (int) $check->count;

	if ($check > 0) $cityModel->cityExist = true;
		else $cityModel->cityExist = false;

	var_dump($check);

	if ($cityModel->isValid()) {
		$cityModel->save();
		$confirmation = true;
		$_POST = array();
	} else {
		$errors = $cityModel->getErrors();
	}
}
