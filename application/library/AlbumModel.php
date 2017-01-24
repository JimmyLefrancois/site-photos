<?php

/**
 * @author Jimmy
 */
class AlbumModel extends Model
{

	/**
	 * @var Integer Id of AlbumModel
	 */
	public $id;

	/**
	 * @var varchar name of AlbumModel
	 */
	public $name;

	/**
	 * @var datetime date of AlbumModel
	 */
	public $date;

	/**
	 * @var bool albumExist of AlbumModel
	 */
	public $albumExist;

	/**
	 * @see Model::$table
	 */
	protected $table = 'album';

	/**
	 * @see UploadModel::validate()
	 */
	protected function validate()
	{
		if (empty($this->name)) $this->errors['name'] = "Vous devez saisir le nom du nouvel album.";
		if (isset($this->albumExist) && $this->albumExist) $this->errors['albumExist'] = "Un album avec le même nom existe déjà.";
	}

	protected function getColumns()
	{
		return array(
			'id',
			'name',
			'date'
		);
	}

}
