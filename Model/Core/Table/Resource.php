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

    public function insertUpdateOnDuplicate1($data,$uniqueColumns)
    {   
        $keys = array_keys($data);
        $values = array_values($data);
        // Ccc::log($keys,"query.log");

        $k = '`' . implode("`,`", $keys) . '`';
        $v = "'" . implode("','", $values) . "'";

        $updateValue = [];
        foreach ($uniqueColumns as $column) {
            $updateValue[$column] = $data[$column];
        }

        foreach ($updateValue as $key => $value) {
           $final[] = "`".$key."`= ".$value;
        }

        $result_string = null;
        foreach ($updateValue as $key => $value) {
            $result_string .= "`$key`='$value',";
        }

        $result_string = rtrim($result_string,",");

        $sql = "INSERT INTO `{$this->tableName}` ({$k}) VALUES ({$v}) ON DUPLICATE KEY UPDATE {$result_string}";
        Ccc::log($sql, 'query.log');
        $result = $this->getAdapter()->query($sql);
        return $result;

    }

     public function insertUpdateOnDuplicate($data, $uniqueColumns)
    {
        $keyString= '`'.implode('`,`', array_keys($data)).'`';
        $valueString= "'".implode("','", array_values($data))."'";

        $keys = array_keys($uniqueColumns);

        $keyValue = "";
        for ($i=0; $i < count($uniqueColumns); $i++) { 
            $keyValue .= "`".$keys[$i]."`="."'".$uniqueColumns[$keys[$i]]."',"; 
        }
        $keyValue = rtrim($keyValue,",");

        $sql = "INSERT INTO `{$this->getTableName()}` ({$keyString}) VALUES ({$valueString}) ON DUPLICATE KEY UPDATE $keyValue ";
        Ccc::log($sql,"query.log");
        return $this->getAdapter()->insert($sql);
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