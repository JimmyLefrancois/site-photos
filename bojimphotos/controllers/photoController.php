<?php

require __DIR__ . '../../../application/autoload.php';
require __DIR__ . '../../../vendor/autoload.php';

$number = 2;

$albumModel = new AlbumModel();
$albums = $albumModel->getAll();

$categoryModel = new CategoryModel();
$categories = $categoryModel->getAll();

$countryModel = new CountryModel();
$countries = $countryModel->getAll();

$cityModel = new CityModel();
$cities = $cityModel->getAll();

// A DECOMMENTER UNE FOIS L INTE OK
// if (isset($_POST['number'])) {
// 	$number = (int) $_POST['number'];
// 	if ($number == 0) $errors['number'] = 'Mauvais format.';
// } else {
// 	$number = null;
// }

if (isset($_POST['submit-post'])) {

	// REPERTOIRE D UPLOAD POUR LES PHOTOS
	$folder = '../../../uploads/photos/';
	$files = $_FILES['photos'];

	// EXT AUTORISEES
	$extensions = array('.png', '.gif', '.jpg', '.jpeg', 'JPG', 'JPEG', 'PNG', 'GIF', 'pdf');

	// ON INITIALISE UN COMPTEUR DE PHOTO
	$countMedia = 0;

	// DEUX TABLEAUX D ETAT SUCCESS ERROR ETC
	$state = [];
	$errorState = [];

	// TABLEAU DE MEDIAS
	$medias = [];

	// POUR CHAQUE INPUT FILE ON CHECK SI ON TROUVE UN NUM, SI OUI ON INCREMENT $countmedia
	foreach ($files['name'] as $file) {
		if ($file != "") $countMedia++;
	}

	// ON STOCK LE NB REEL DE PHOTOS ENVOYEES
	$count = count($files['name']);

	for ($i=0; $i < $countMedia; $i++) {
		$modelPhoto = new PhotoModel();

		if (isset($_POST["album"]) && $_POST["album"] != "0") $modelPhoto->album_id = $_POST["album"];
			else $modelPhoto->album_id = NULL;

		if (isset($_POST["category"]) && $_POST["category"] != "0") $modelPhoto->category_id = $_POST["category"];
			else $modelPhoto->category_id = NULL;

		if (isset($_POST["country"]) && $_POST["country"] != "0") $modelPhoto->country_id = $_POST["country"];
			else $modelPhoto->country_id = NULL;

		if (isset($_POST["city"]) && $_POST["city"] != "0") $modelPhoto->city_id = $_POST["city"];
			else $modelPhoto->city_id = NULL;

		if (isset($_POST["name"][$i]) && $_POST["name"][$i] != "0") $modelPhoto->name = $_POST["name"][$i];
			else $modelPhoto->name = NULL;

		if (isset($_POST["description"][$i]) && $_POST["description"][$i] != "0") $modelPhoto->description = $_POST["description"][$i];
			else $modelPhoto->description = NULL;

		$filename[$i] = $_FILES['photos']['name'][$i];
		$filename[$i] = setFilename($filename[$i]);
		$extension = strrchr($_FILES['photos']['name'][$i], '.');

		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			$errorExtention = true;
		}

		if ($errorExtention) $modelPhoto->errorExtention = true;

		if ($modelPhoto->isValid()) {
			$medias[$i] = $modelPhoto;
		} else {
			$errorState[$i]['errorMedia'] = true;
			$mediaErrors = $modelPhoto->getErrors();
			$confirmation = false;
		}
	}

	if (!in_array(true, $errorState)) {

		if (!empty($medias)) {
			foreach ($medias as $index => $media) {
				move_uploaded_file($_FILES['photos']['tmp_name'][$index], $folder . $filename[$index]);
				var_dump($media);
				$media->save();
			}
		}

		$confirmation = true;
		$_POST = array();
	} else {
		$confirmation = false;
	}

}

function setFilename($filename)
{
	$rand = substr(md5(microtime()),rand(0,26),10);
	$filenameProcess = strtr($filename, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüùýÿ _°¨^$£%*µ;:/!§+=', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuuyy-----------------');
	$filename = $rand . "_" . preg_replace('/([^.a-z0-9]+)/i', '-', $filenameProcess);
	return $filename;
}



/*
$folder = 'uploads/';
$files = $_FILES['photos'];

$extensions = array('.png', '.gif', '.jpg', '.jpeg', 'JPG', 'JPEG', 'PNG', 'GIF', 'pdf');

$countMedia = 0;
$state = [];
$errorState = [];
$medias = [];

// var_dump('test');

foreach ($files['name'] as $file) {
	if ($file != "") $countMedia++;
}

//$count = count($files['name']);

for ($i=0; $i < $countMedia; $i++) {
	$modelMedia = new MediaModel();
	$filename[$i] = $_FILES['photos']['name'][$i];
	$filename[$i] = setFilename($filename[$i]);
	$extension = strrchr($_FILES['photos']['name'][$i], '.');
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		$errorExtention = true;
	}

	$modelMedia->path = $filename[$i];

	if ($errorExtention) $modelMedia->errorExtention = true;

	if ($modelMedia->isValid()) {
		$medias[$i] = $modelMedia;
		// if(move_uploaded_file($_FILES['photos']['tmp_name'][$i], $folder . $filename)) {
		//  $state[$i]['upload'] = true;
		//  $modelMedia->save();
		// } else {
		//  $state[$i]['upload'] = false;
		// }
		// $confirmation = true;
	} else {
		$errorState[$i]['errorMedia'] = true;
		$mediaErrors = $modelMedia->getErrors();
		// $confirmation = false;
	}
}

if (!in_array(true, $errorState)) {
	//var_dump('OK');
	$modelShare->save();
	$shareID = $modelShare->id;

	if (!empty($medias)) {
		foreach ($medias as $index => $media) {
			//var_dump($_FILES['photos']['tmp_name'][$index]);
			move_uploaded_file($_FILES['photos']['tmp_name'][$index], $folder . $filename[$index]);
			$media->share_id = $shareID;
			//var_dump($media);
			$media->save();
		}
	}
	$confirmation = true;
	$mailUser->sendMail();
	$mailDig->sendMail();
	$_POST = array();
} else {
	//var_dump('PAS OK');
	$confirmation = false;
}
*/
