<?php
class Block_Salesman_Address extends Block_Core_Template	
{
	
	function __construct()
	{
		parent::__construct();
		$salesmanId = Ccc::getModel("Core_Request")->getParams('salesman_id');
		$address = Ccc::getModel('Salesman_Address')->load($salesmanId,'salesman_address_id');
		$this->setData(['address'=>$address])->setTemplate('salesman/address.phtml');				
	}
}