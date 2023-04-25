<?php

class Model_Category extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Category_Collection');
        $this->setResourceClass('Model_Category_Resource');
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Category_Resource::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Category_Resource::STATUS_DEFAULT];
    }

    public function getParentCategories()
    {
        $sql = "SELECT `category_id`, `path` FROM `{$this->getResource()->getTableName()}`
                -- WHERE `parent_id`>0 
                ORDER BY `path` ASC";
        $categories = $this->getResource()->getAdapter()->fetchPairs($sql);
        return $categories;
    }

    public function preparePathCategories($parentForEdit = null)
    {
        if ($parentForEdit) {
            $idPath = $parentForEdit;

        } else {
            $idPath = $this->getParentCategories();
        }

        $sql = "SELECT `category_id`, `name` FROM `{$this->getResource()->getTableName()}` 
        ORDER BY `path` ASC";
        $idName = $this->getResource()->getAdapter()->fetchPairs($sql);

        $final = [];
        foreach ($idPath as $id => $path) {
            $pathIds = explode('=', $path);
            $pathName = [];
            foreach ($pathIds as $pathId) {
                $pathName[] = $idName[$pathId];
            }
            $final[$id] = implode(' > ', $pathName);
        }
        return $final;
    }

    public function updatePath()
    {
        if (!$this->getId()) {
            return false;
        }

        if ($this->updated_at == null) {
            $this->removeData('updated_at');
        }

        $parent = Ccc::getModel('category')->load($this->parent_id);
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

        $this->getResource()->getAdapter()->update($sql);
        return $this;
    }

    public function deleteWithChild()
    {
        $sql = "DELETE FROM `{$this->getResource()->getTableName()}`
                WHERE `path` LIKE '{$this->path}=%' OR `path` = '{$this->path}'";
        $this->getResource()->getAdapter()->delete($sql);
        return $this;
    }
}
?>