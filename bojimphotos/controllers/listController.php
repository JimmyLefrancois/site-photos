<?php

require __DIR__ . '../../../application/autoload.php';
require __DIR__ . '../../../vendor/autoload.php';

function getAllAlbums()
{
	$albumModel = new AlbumModel();
	$albums = $albumModel->getAll();
	return $albums;
}

function getAllCategories()
{
	$categoryModel = new CategoryModel();
	$categories = $categoryModel->getAll();
	return $categories;
}

function getAllCountries()
{
	$countryModel = new CountryModel();
	$countries = $countryModel->getAll();
	return $countries;
}

function getAllCities()
{
	$cityModel = new CityModel();
	$cities = $cityModel->getCitiesInfos();
	return $cities;
}

function getAllPhotos()
{
	$photoModel = new PhotoModel();
	$albums = $PhotoModel->getAll();
	return $albums;
}
