<?php

/**
 * @author Jimmy
 */
class CountryModel extends Model
{

	/**
	 * @var Integer Id of CountryModel
	 */
	public $id;

	/**
	 * @var varchar name of CountryModel
	 */
	public $name;

	/**
	 * @var datetime date of CountryModel
	 */
	public $date;

	/**
	 * @var error countryExist of CountryModel
	 */
	public $countryExist;

	/**
	 * @see Model::$table
	 */
	protected $table = 'country';

	/**
	 * @see UploadModel::validate()
	 */
	protected function validate()
	{
		if (empty($this->name)) $this->errors['name'] = "Vous devez saisir le nom du nouveau pays.";
		if (isset($this->countryExist) && $this->countryExist) $this->errors['countryExist'] = "Ce pays a déjà été ajouté.";
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
