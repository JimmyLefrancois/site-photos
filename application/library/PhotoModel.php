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
	 * @var Varchar aperture of PhotoModel
	 */
	public $aperture;

	/**
	 * @var Varchar focal_length of PhotoModel
	 */
	public $focal_length;

	/**
	 * @var Varchar exposure_time of PhotoModel
	 */
	public $exposure_time;

	/**
	 * @var Varchar iso of PhotoModel
	 */
	public $iso;

	/**
	 * @var Varchar path of PhotoModel
	 */
	public $path;

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
			'aperture',
			'focal_length',
			'exposure_time',
			'iso',
			'path',
			'date'
		);
	}

	public function getPhotosInfos()
	{
		$query = 'SELECT P.name, P.description, P.aperture, P.focal_length, P.exposure_time, P.iso, P.path, P.date, A.name AS album, CA.name AS category, CO.name AS country, CI.name AS city FROM `' . $this->table . '` P';
		$query .= ' INNER JOIN album A ON A.id = P.album_id';
		$query .= ' INNER JOIN category CA ON CA.id = P.category_id';
		$query .= ' LEFT JOIN country CO ON CO.id = P.country_id';
		$query .= ' LEFT JOIN city CI ON CI.id = P.city_id';

		$statement = $this->getPdo()->prepare($query);

		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

}
