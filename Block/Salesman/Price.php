<?php
class Block_Salesman_Price extends Block_Core_Template	
{
	
	function __construct()
	{
		parent::__construct();
		$this->getCollection();
		$this->setTemplate('salesman_price/grid.phtml');
	}
	public function getCollection()
	{
		$salesmanId = Ccc::getModel("Core_Request")->getParams('salesman_id');
		$query = 'SELECT * FROM `salesman` WHERE 1';
		$salesmen = Ccc::getModel('Salesman_Price')->fetchAll($query);
			$join_query = 'SELECT SP.entity_id, SP.salesman_price, P.sku_id, P.cost, P.price, P.product_id FROM `product` P LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = '.$salesmanId.'';
			$salesman_prices = Ccc::getModel('Salesman_Price')->fetchAll($join_query);
			$this->setData(['salesman'=>$salesmen,'salesman_prices'=>$salesman_prices]);
			return $this;

	}
}