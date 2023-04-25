<?php
class Block_Customer_Address extends Block_Core_Template	
{
	
	function __construct()
	{
		parent::__construct();
		$customerId = Ccc::getModel("Core_Request")->getParams('customer_id');
		$customer = Ccc::getModel('Customer')->load($customerId);
		$shippingAddress=$customer->getShippingAddress();
		$billingAddress=$customer->getBillingAddress();
		$this->setData(['billingAddress'=>$billingAddress,'shippingAddress'=>$shippingAddress])->setTemplate('customer/address.phtml');					
	}
}