<?php

/**
 * @author Jimmy
 */
class PhotoModel extends Model
{

	/**
	 * @var Integer id of PhotoModel
	 */
	public $id;

	/**
	 * @var varchar name of PhotoModel
	 */
	public $name;

	/**
	 * @var varchar description of PhotoModel
	 */
	public $description;

	/**
	 * @var Integer album_id of PhotoModel
	 */
	public $album_id;

	/**
	 * @var Integer category_id of PhotoModel
	 */
	public $category_id;

	/**
	 * @var Integer city_id of PhotoModel
	 */
	public $city_id;

	/**
	 * @var Integer country_id of PhotoModel
	 */
	public $country_id;

	/**
	 * @var Datetime of PhotoModel
	 */
	public $date;

	/**
	 * @var Bad file extension
	 */
	public $errorExtention;

	/**
	 * @see Model::$table
	 */
	protected $table = 'photo';

	/**
	 * @see UploadModel::validate()
	 */
	protected function validate()
	{
		if (isset($this->errorExtention) && $this->errorExtention) $this->errors['extention'] = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg';
	}

	protected function getColumns()
	{
		return array(
			'id',
			'name',
			'description',
			'album_id',
			'category_id',
			'city_id',
			'country_id',
			'date'
		);
	}

}
