<?php

class Model_Core_Table
{
	protected $data = [];
	protected $resourceClass = 'Model_Core_Table_Resource';
	protected $resource = null;
	protected $collectionClass = 'Model_Core_Table_Collection';
	protected $collection = null;

	function __construct()
	{
	}

	public function setId($id)
	{
		$this->data[$this->getResource()->getPrimaryKey()] = (int) $id;
		return $this;
	}

	public function getId()
	{
		$primaryKey = $this->getResource()->getPrimaryKey();
		return (int) $this->$primaryKey;
	}

	public function __set($key, $value)
	{
		$data[$key] = $value;
		$this->data = array_merge($this->data, $data);
	}

	public function __get($key)
	{
		return (!array_key_exists($key, $this->data)) ? null : $this->data[$key];
	}

	public function __unset($key)
	{
		if (array_key_exists($key, $this->data)) {
			unset($this->data[$key]);
		}
	}

	// data operations
	public function setData(array $data)
	{
		$this->data = array_merge($this->data, $data);
		return $this;
	}

	public function getData($key = null)
	{
		return (!$key) ? $this->data : $this->data[$key];
	}

	public function addData($key, $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key = null)
	{
		if ($key == null) {
			$this->data = [];
		}

		if (array_key_exists($key, $this->data)) {
			unset($this->data[$key]);
		}
		return $this;
	}

	public function setResourceClass($resourceClass)
	{
		$this->resourceClass = $resourceClass;
		return $this;
	}

	public function getResourceClass()
	{
		return $this->resourceClass;
	}

	public function setCollectionClass($collectionClass)
	{
		$this->collectionClass = $collectionClass;
		return $this;
	}

	public function getCollectionClass()
	{
		return $this->collectionClass;
	}

	public function setCollection($collection)
	{
		$this->collection = $collection;
		return $this;
	}

	public function getCollection()
	{
		$collection = $this->getCollectionClass();
		if ($this->collection) {
			return $this->collection;
		}

		// $collection = new($this->getCollectionClass())();
		$collection = new $collection();
		$this->setCollection($collection);
		return $collection;
	}


	// setter getter of table 
	public function setResource($resource)
	{
		$this->resource = $resource;
		return $this;
	}

	public function getResource()
	{
		$resource = $this->getResourceClass();
		if ($this->resource) {
			return $this->resource;
		}

		// $resource = new($this->getResourceClass())();
		$resource = new $resource();
		$this->setResource($resource);
		return $resource;
	}


	// crud row operations
	public function fetchRow(string $sql)
	{
		$result = $this->getResource()->fetchRow($sql);
		if ($result) {
			$this->data = $result;
			return $this;
		}
		return false;
	}

	public function fetchAll(string $sql)
	{
		$result = $this->getResource()->fetchAll($sql);
		if (!$result) {
			return false;
		}
		foreach ($result as &$row) {
			$row = (new $this)->setData($row)
				->setResource($this->getResource())
				->setCollection($this->getCollection());
		}
		return $this->getCollection()->setData($result);
	}

	public function Save()
	{
		if ($id = $this->getId()) {
			$condition = [$this->getResource()->getPrimaryKey() => $id];
			$result = $this->getResource()->update($this->data, $condition);
			if ($result) {
				return $this->load($id);
			}
			return false;

		} else {
			$insertId = $this->getResource()->insert($this->data);
			if ($insertId) {
				return $this->load($insertId);
			}
			return false;
		}
	}

	public function delete()
	{
		$id = $this->getData($this->getResource()->getPrimaryKey());
		if (!$id) {
			return false;
		}
		$this->getResource()->delete($id);
		return $this;
	}


	public function load($value, $column = null)
	{
		$column = (!$column) ? $this->getResource()->getPrimaryKey() : $column;
		$sql = "SELECT * FROM `{$this->getResource()->getTableName()}` WHERE `{$column}` = '{$value}'";
		$result = $this->getResource()->fetchRow($sql);
		if ($result) {
			$this->data = $result;
			return $this;
		}
		return false;
	}
}

?>