<?php

	abstract class Model extends Validation
	{

		public $id;

		/**
		 * @var string The table name.
		 */
		protected $table;

		/**
		 * Le constructeur, $vente = new venteModel() créé un nouvel objet tandis que
		 * $vente = new venteModel(5) créé un objet à partir de la vente ayant l'ID 5.
		 */
		public function __construct($id = null)
		{
			if ($id === null) {
				return;
			}

			$query = 'SELECT * FROM `' . $this->table . '` WHERE `id` = :id';
			$statement = $this->getPdo()->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_INTO, $this);
			$statement->fetch(PDO::FETCH_INTO);
		}

		/**
		 * Retourne toutes les données concernant votre modèle.
		 */
		public function getAll($offset = 0, $limit = 0)
		{
			$query = 'SELECT * FROM `' . $this->table . '`';

			if ($limit > 0) {
				$query .= ' LIMIT ' . $limit;
			}

			if ($offset > 0) {
				$query .= ' OFFSET ' . $offset;
			}

			$statement = $this->getPdo()->query($query);
			return $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));
		}

		public function checkIfExist($name)
		{
			$query = 'SELECT count(DISTINCT id) AS count FROM `' . $this->table . '`';

			$query .= ' WHERE name = :name';

			$statement = $this->getPdo()->prepare($query);
			$statement->bindValue(':name', $name);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_OBJ);
		}

		/**
		 * Retourne toutes les offres actives.
		 */
		public function getAllActive($offset = 0, $limit = 0)
		{
			$query = 'SELECT * FROM `' . $this->table . '`';

			$query .= ' WHERE active = 1';

			if ($limit > 0) {
				$query .= ' LIMIT ' . $limit;
			}

			if ($offset > 0) {
				$query .= ' OFFSET ' . $offset;
			}

			$statement = $this->getPdo()->query($query);
			return $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));
		}

		/**
		 * Retourne les agences des utilisateurs, order par nom de l'agence
		 */
		public function getAllOrder($offset = 0, $limit = 0)
		{
			$query = 'SELECT * FROM `' . $this->table . '`';
			$query .= ' ORDER BY NOM ';

			if ($limit > 0) {
				$query .= ' LIMIT ' . $limit;
			}

			if ($offset > 0) {
				$query .= ' OFFSET ' . $offset;
			}

			$statement = $this->getPdo()->query($query);
			return $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));
		}

		/**
		 * Compte le nombre de données total de votre modèle
		 */
		public function countAll($offset = 0, $limit = 0)
		{
			$query = 'SELECT count(*) as total FROM `' . $this->table ;

			$statement = $this->getPdo()->prepare($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_OBJ)->total;
		}

		public function getAllOne($offset = 0, $limit = 0)
		{
			$query = 'SELECT `' . $this->table . '` FROM `' . $this->table . '`';

			if ($limit > 0) {
				$query .= ' LIMIT ' . $limit;
			}

			if ($offset > 0) {
				$query .= ' OFFSET ' . $offset;
			}

			$statement = $this->getPdo()->query($query);
			return $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));
		}

		/**
		 * Retourne un objet avec un ID précis
		 */
		public function get($id)
		{
			$query = 'SELECT * FROM `' . $this->table . '` WHERE `id` = :id';

			$statement = $this->getPdo()->prepare($query);
			$statement->bindValue(':id', $id);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_OBJ);
		}

		/**
		 * Retourne le dernier objet
		 */
		public function getLast()
		{
			$query = 'SELECT * FROM `' . $this->table . '` WHERE `id` = ( SELECT max(id) FROM `' . $this->table . '` )';

			$statement = $this->getPdo()->prepare($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_OBJ);
		}

		/**
		 * Supprime toute les données
		 */
		public function deleteAll()
		{
			$this->getPdo()->query('DELETE FROM `' . $this->table . '`');
		}

		public function isLoaded()
		{
			return $this->id !== null;
		}

		// Persiste les données une fois validée
		public function save()
		{
			$connection = $this->getPdo();
			if ($this->isLoaded()) {
				$query = 'UPDATE `' . $this->table . '` SET';
				$values = array();

				foreach ($this->getColumns() as $column) {
					$values[] = ' `' . $column . '` = :' . $column;
				}

				$query .= implode(',', $values) . ' WHERE `id` = :id';
			} else {
				$query   = 'INSERT INTO `' . $this->table . '` (';
				$columns = array();

				foreach ($this->getColumns() as $column) {
					$columns[] = '`' . $column . '`';
				}

				$query .= implode(',', $columns) . ') VALUES (';
				$values = array();

				foreach ($this->getColumns() as $column) {
					$values[] = ':' . $column;
				}

				$query .= implode(',', $values) . ')';
			}

			$statement = $connection->prepare($query);

			foreach ($this->getColumns() as $column) {
				$statement->bindValue(':' . $column, $this->$column);
			}

			if ($this->isLoaded()) {
				$statement->bindValue(':id', $this->id);
			}

			$statement->execute();

			if (!$this->isLoaded()) {
				$this->id = $connection->lastInsertId();
			}
		}

		public function getLastId()
		{
			$this->id = $this->getPdo()->lastInsertId();
			return $this->id;
		}

		/**
		 * Supprime un objet avec un ID précis
		 */
		public function delete()
		{
			$query = 'DELETE FROM `' . $this->table . '` WHERE `id` = :id';
			$statement = $this->getPdo()->prepare($query);
			$statement->bindValue(':id', $this->id);
			$statement->execute();

			unset($this->id);

			foreach ($this->getColumns() as $column) {
				unset($this->$column);
			}
		}

		abstract protected function getColumns();
	}
