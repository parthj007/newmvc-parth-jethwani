<?php

class Block_Item_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Items');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('item_id',[
            'title' => 'Item Id'
        ]);
        $this->addColumn('Price',[
            'title' => 'Price'
        ]);
        $this->addColumn('Cost',[
            'title' => 'Cost'
        ]);

        $this->addColumn('Color',[
            'title' => 'Color'
        ]);

        $this->addColumn('Style',[
            'title' => 'Style'
        ]);
        $this->addColumn('Type',[
            'title' => 'Type'
        ]);
        $this->addColumn('Size',[
            'title' => 'Size'
        ]);

         $this->addColumn('status',[
            'title' => 'Status'
        ]);

        $this->addColumn('created_at',[
            'title' => 'Created At'
        ]);

        $this->addColumn('updated_at',[
            'title' => 'Updated At'
        ]);
        return parent::_prepareColumn();
    }

    protected function _prepareAction()
    {
        $this->addAction('edit',[
            'title' => 'EDIT',
            'method' => 'getEditUrl'
        ]);

        $this->addAction('delete',[
            'title' => 'DELETE',
            'method' => 'getDeleteUrl'
        ]);

        return parent::_prepareAction();
    }

    public function _prepareButtons()
    {
        $this->addButton('method_id',[
            'title'=>'Add New Item',
            'url'=>$this->getUrl('add')
        ]);

        return parent::_prepareButtons();
    }

    public function getCollection()
    {
        $item = Ccc::getModel('item');
        $sql = "SELECT `I`.*,
        Price.`value`as Price,Cost.`value` as Cost,Color.value as Color ,
        Style.`value` as Style,Type.`value` as Type,Size.`value` as Size
        from `item` I 
        LEFT JOIN `item_varchar` Price ON Price.`entity_id` = I.`item_id` AND Price.`attribute_id` = 58
        LEFT JOIN `item_varchar` Cost ON Cost.`entity_id` = I.`item_id` AND Cost.`attribute_id` = 59
        LEFT JOIN `item_varchar` Color ON Color.`entity_id` = I.`item_id` AND Color.`attribute_id` = 60
        LEFT JOIN `item_int` Style ON Style.`entity_id` = I.`item_id` AND Style.`attribute_id` = 61
        LEFT JOIN `item_int` Type ON Type.`entity_id` = I.`item_id` AND Type.`attribute_id` = 63
        LEFT JOIN `item_varchar` Size ON Size.`entity_id` = I.`item_id` AND Size.`attribute_id` = 65";
       $items =  $item->fetchAll($sql);
       return $items;
    }

}
