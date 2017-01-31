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
if (isset($_POST['number'])) {
	$number = (int) $_POST['number'];
	if ($number == 0) $errors['number'] = 'Mauvais format.';
} else {
	$number = null;
}

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

	$date = new DateTime();
	$date = $date->format('c');

	for ($i=0; $i < $countMedia; $i++) {
		$modelPhoto = new PhotoModel();
		$modelPhoto->date = $date;

		if (isset($_POST["album"][$i]) && $_POST["album"][$i] != "0") $modelPhoto->album_id = $_POST["album"][$i];
			else $modelPhoto->album_id = NULL;

		if (isset($_POST["category"][$i]) && $_POST["category"][$i] != "0") $modelPhoto->category_id = $_POST["category"][$i];
			else $modelPhoto->category_id = NULL;

		if (isset($_POST["country"][$i]) && $_POST["country"][$i] != "0") $modelPhoto->country_id = $_POST["country"][$i];
			else $modelPhoto->country_id = NULL;

		if (isset($_POST["city"][$i]) && $_POST["city"][$i] != "0") $modelPhoto->city_id = $_POST["city"][$i];
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

		if (isset($errorExtention) && $errorExtention) $modelPhoto->errorExtention = true;

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

				$image = $_FILES['photos']['tmp_name'][$index];

				$exif = exif_read_data($image, NULL, true, true);
				if(isset($exif['EXIF']['FNumber'])) $aperture = $exif['EXIF']['FNumber'];
					else $aperture = NULL;
				if(isset($exif['EXIF']['FocalLengthIn35mmFilm'])) $focal_length = $exif['EXIF']['FocalLengthIn35mmFilm'];
					else $focal_length = NULL;
				if(isset($exif['EXIF']['ExposureTime'])) $exposure_time = $exif['EXIF']['ExposureTime'];
					else $exposure_time = NULL;
				if(isset($exif['EXIF']['ISOSpeedRatings'])) $iso = $exif['EXIF']['ISOSpeedRatings'];
					else $iso = NULL;

				if ($aperture) $media->aperture = $aperture;
					else $media->aperture = NULL;
				if ($focal_length) $media->focal_length = $focal_length;
					else $media->focal_length = NULL;
				if ($exposure_time) $media->exposure_time = $exposure_time;
					else $media->exposure_time = NULL;
				if ($iso) $media->iso = $iso;
					else $media->iso = NULL;

				$media->path = $filename[$index];

				move_uploaded_file($image, $folder . $filename[$index]);

				$realpath = realpath($folder . $filename[$index]);

				/*$imagick = new Imagick($realpath);
				$profiles = $imagick->getImageProfiles("icc", true);
				$imagick->setCompression(imagick::COMPRESSION_JPEG);
				$imagick->setCompressionQuality(100);
				$imagick->stripImage();
				if(!empty($profiles))
					$imagick->profileImage("icc", $profiles['icc']);
				$imagick->writeImage($realpath);*/

				// $profiles = $img->getImageProfiles("icc", true);
				// $image->stripImage();
				// if(!empty($profiles))
				// 	$img->profileImage("icc", $profiles['icc']);

				// move_uploaded_file($image, $folder . $filename[$index]);
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
