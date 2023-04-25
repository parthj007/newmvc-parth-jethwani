<?php

class Model_Category_Row extends Model_Core_Table_Row
{
    protected $tableClass = 'Model_Category';

    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Category');
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Category::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getTable()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Category::STATUS_DEFAULT];
    }

    public function getParentCategories()
    {
        $sql = "SELECT `category_id`, `path` FROM `{$this->getTable()->getTableName()}`
                -- WHERE `parent_id`>0 
                ORDER BY `path` ASC";
        $categories = $this->getTable()->getAdapter()->fetchPairs($sql);
        return $categories;
    }

    public function updatePath()
    {
        if (!$this->getId()) {
            return false;
        }

        if ($this->updated_at == null) {
            $this->removeData('updated_at');
        }

        $parent = Ccc::getModel('category_row')->load($this->parent_id);
        $oldPath = $this->path;
        if (!$parent) {
            $this->path = $this->getId();
        } else {
            $this->path = $parent->path . '=' . $this->getId();
        }

        $this->save();
        $sql = "UPDATE `category` 
                SET `path` = REPLACE(`path`, '{$oldPath}=', '{$this->path}=')
                WHERE `path` LIKE '{$oldPath}=%'";

        $this->getTable()->getAdapter()->update($sql);
        return $this;
    }

    public function deleteWithChild()
    {
        $sql = "DELETE FROM `{$this->getTable()->getTableName()}`
                WHERE `path` LIKE '{$this->path}=%' OR `path` = '{$this->path}'";
        $this->getTable()->getAdapter()->delete($sql);
        return $this;
    }
}
?>