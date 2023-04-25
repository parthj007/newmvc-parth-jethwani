<?php
class Block_Vendor_Address extends Block_Core_Template	
{
	
	function __construct()
	{
		parent::__construct();
		$vendorId = Ccc::getModel("Core_Request")->getParams('vendor_id');
		$address = Ccc::getModel('Vendor_Address')->load($vendorId,'vendor_address_id');
		$this->setData(['vendor_address'=>$address])->setTemplate('vendor/address.phtml');				
	}
}