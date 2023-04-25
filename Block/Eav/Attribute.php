<?php

class Block_Eav_Attribute extends Block_Core_Template
{

	function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute.phtml'); 
	}
	
	public function getAttributes()
	{
		$attribute = Ccc::getModel('eav_attribute');
		$sql = "SELECT * FROM `{$attribute->getResource()->getTableName()}`
            WHERE `entity_type_id` = '6'";
		return $attribute->fetchAll($sql);
	}

}