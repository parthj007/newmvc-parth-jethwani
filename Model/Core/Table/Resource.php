<?php

class Model_Core_Table_Resource
{
    protected $adapter = null;
    protected $primaryKey = null;
    protected $tableName = null;

    public function __construct()
    {

    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    protected function setAdapter(Model_Core_Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        if ($this->adapter != null) {
            return $this->adapter;
        }

        $adapter = new Model_Core_Adapter();
        $this->setAdapter($adapter);
        return $adapter;
    }




    // database methods




    public function fetchRow($query)
    {
        return $this->getAdapter()->fetchRow($query);
    }


    public function fetchAll($query)
    {
        return $this->getAdapter()->fetchAll($query);
    }


    public function insert($data)
    {

        $keys = array_keys($data);
        $values = array_values($data);

        $fieldNames = '`' . implode("`,`", $keys) . '`';
        $values = "'" . implode("','", $values) . "'";

        $sql = "INSERT INTO `{$this->getTableName()}` ({$fieldNames}) VALUES ({$values})";

        return $this->getAdapter()->insert($sql);
    }


    public function update($data, $condition)
    {

        $str = [];
        foreach ($data as $key => $val) {
            $str[] = "`{$key}`" . " = " . "'{$val}' ";
        }
        foreach ($condition as $key => $val) {
            $c[] = "`{$key}`" . " = " . "'{$val}' ";
        }
        $con = implode(" AND ", $c);
        $string = implode(",", $str);
        $sql = "UPDATE `{$this->getTableName()}` SET {$string} WHERE {$con}";
        return $this->getAdapter()->update($sql);
    }


    public function delete($id)
    {
        $sql = "DELETE FROM `{$this->getTableName()}` WHERE {$this->getPrimaryKey()} = '{$id}'";
        return $this->getAdapter()->delete($sql);
    }


    public function load($value, $col = null)
    {
        $col = (!$col) ? $this->getPrimaryKey() : $col;
        $sql = "SELECT * FROM `{$this->getTableName()}` WHERE `{$col}` = '{$value}'";
        return $this->getAdapter()->fetchRow($sql);
    }
}


?>