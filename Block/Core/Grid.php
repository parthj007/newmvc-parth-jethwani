<?php
class Block_Core_Grid extends Block_Core_Template
{
    protected $_title = null;
    protected $_columns = [];
    protected $_actions = [];
    protected $_buttons = [];
    protected $_pager = null;

    public function getPager()
    {
        if($this->_pager){
            return $this->_pager;
        }
       $pager = new Model_Core_Pager();
       $rpp = Ccc::getModel("Core_Request")->getParams("rpp",10);
       $pager->setRecordPerPage($rpp);
       $this->setPager($pager);
       return $pager;
    }

    public function setPager(Model_Core_Pager $pager)
    {       
        $this->_pager = $pager;
        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('core/grid.phtml');
        $this->_prepareColumn();
        $this->_prepareAction();
        $this->_prepareButtons();
        $this->setTitle('Manage Grid');
    }

    public function setColumns(array $columns)
    {
        $this->_columns = $columns;
        return $this;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    public function addColumn($key, $value)
    {
        $this->_columns[$key] = $value;
        return $this;        
    }

    public function removeColumn($key)
    {
        unset($this->_columns[$key]);
        return $this;
    }

    public function getColumn($key)
    {
        if(array_key_exists($key, $this->_columns)){
            return $this->_columns[$key];
        }
        return null;
    }

    protected function _prepareColumn()
    {
        return $this;
    }

    public function setActions(array $actions)
    {
        $this->_actions = $actions;
        return $this;
    }

    public function getActions()
    {
        return $this->_actions;
    }

    public function addAction($key, $value)
    {
        $this->_actions[$key] = $value;
        return $this;        
    }

    public function removeAction($key)
    {
        unset($this->_actions[$key]);
        return $this;
    }

    public function getAction($key)
    {
        if(array_key_exists($key, $this->_actions)){
            return $this->_actions[$key];
        }
        return null;
    }

    protected function _prepareAction()
    {
        return $this;
    }

    public function getEditUrl($row, $key)
    {
        return $this->getUrl($key, null, ['id'=>$row->getId()], true);
    }

    public function getDeleteUrl($row, $key)
    {
        return $this->getUrl($key, null, ['id'=>$row->getId(),'page'=>$this->getPager()->getCurrentPage()], true);
    }

    public function getColumnValue($row, $key)
    {
        if($key == 'status'){
            return $row->getStatusText();
        }
        elseif($key =='gender'){
            return $row->getGenderText();
        }
        return $row->$key;
    }

    public function setButtons(array $buttons)
    {
        $this->_buttons = $buttons;
        return $this;
    }

    public function getButtons()
    {
        return $this->_buttons;
    }

    public function addButton($key, $value)
    {
        $this->_buttons[$key] = $value;
        return $this;        
    }

    public function removeButton($key)
    {
        unset($this->_buttons[$key]);
        return $this;
    }

    public function getButton($key)
    {
        if(array_key_exists($key, $this->_buttons)){
            return $this->_buttons[$key];
        }
        return null;
    }

    protected function _prepareButtons()
    {
        return $this;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }

   // public function getNumberOfRecords($model)
   //  {
   //      $sql = "SELECT count('$model->getId()') FROM `$model`";
   //      $totalRecords = $product->fetchRow($sql);
   //      $totalRecords = $totalRecords->getData("count('product_id')");
   //      return $totalRecords;
   //  }

   //  public function getCollection()
   //  {
   //      $model = Ccc::getModel($this->getResource()->getTableName());
   //      $pager = $this->getPager();
   //      $pager->setTotalRecords($this->getNumberOfRecords($model))->caculate();
   //      $start = $pager->getStartLimit();
   //      $rpp = $pager->getRecordPerPage();
   //      $table = $this->getResource()->getTableName();
   //      $primaryKey = $this->getResource()->getPrimaryKey();
   //      $sql = "SELECT * FROM `$table` ORDER BY '$primaryKey' LIMIT $start,$rpp";
   //      return $product->fetchAll($sql);
   //  }
}