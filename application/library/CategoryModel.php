<?php

/**
 * @author Jimmy
 */
class CategoryModel extends Model
{

	/**
	 * @var Integer Id of share
	 */
	public $id;

	/**
	 * @var varchar name of share
	 */
	public $name;

	/**
	 * @see Model::$table
	 */
	protected $table = 'category';

	/**
	 * @see UploadModel::validate()
	 */
	protected function validate()
	{
	}

	protected function getColumns()
	{
		return array(
			'id',
			'name'
		);
	}

}
