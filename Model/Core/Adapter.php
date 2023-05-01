<?php
class Model_Core_Adapter
{
	public $config = [
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'newmvc-parth-jethwani'
	];

	public $connect = null;

	public function connect()
	{
		if ($this->connect != null) {
			return $this->connect;
		}

		$connect = mysqli_connect(
			$this->config['host'],
			$this->config['username'],
			$this->config['password'],
			$this->config['dbname'],
		);

		$this->connect = $connect;
		return $connect;

	}

	public function fetchRow($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		return $result->fetch_assoc();
	}

	public function fetchAll($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function fetchPairs($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		$data = $result->fetch_all();
		$column1 = array_column($data, '0');
		$column2 = array_column($data, '1');
		if (!$column2) {
			$column2 = array_fill(0, count($column1), null);
		}

		return array_combine($column1, $column2);
	}

	public function fetchOne($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		Ccc::log($result);

		$row = $result->fetch_array();	
		if($row){
			return (array_key_exists(0, $row) ? $row[0] : null);
		}
		return null;
	}

	public function insert($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		return mysqli_insert_id($connect);
	}

	public function delete($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		return true;
	}

	public function update($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		return true;
	}

	public function query($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect, $query);
		if (!$result) {
			return false;
		}
		return true;
	}

}

?>