<?php

/**
 * @author Jimmy
 */
class CityModel extends Model
{

	/**
	 * @var Integer Id of CityModel
	 */
	public $id;

	/**
	 * @var varchar name of CityModel
	 */
	public $name;

	/**
	 * @var varchar name of CityModel
	 */
	public $country_id;

	/**
	 * @var Datetime name of CityModel
	 */
	public $date;

	/**
	 * @var error cityExist of CityModel
	 */
	public $cityExist;

	/**
	 * @see Model::$table
	 */
	protected $table = 'city';

	/**
	 * @see UploadModel::validate()
	 */
	protected function validate()
	{
		if (empty($this->name)) $this->errors['name'] = "Vous devez saisir le nom de la nouvelle ville.";
		if (!$this->country_id) $this->errors['name'] = "Vous devez choisir le pays rattaché à cette ville.";
		if (isset($this->cityExist) && $this->cityExist) $this->errors['cityExist'] = "Ce pays a déjà été ajouté.";
	}

	protected function getColumns()
	{
		return array(
			'id',
			'name',
			'country_id',
			'date'
		);
	}

	public function checkIfCityCountryExist($name, $country)
	{
		$query = 'SELECT count(DISTINCT id) AS count FROM `' . $this->table . '`';

		$query .= ' WHERE name = :name';
		$query .= ' AND country_id = :country';

		$statement = $this->getPdo()->prepare($query);
		$statement->bindValue(':name', $name);
		$statement->bindValue(':country', $country);

		$statement->execute();
		return $statement->fetch(PDO::FETCH_OBJ);
	}
}
