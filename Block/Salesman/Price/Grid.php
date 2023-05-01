<?php
/**
 * 
 */
class Block_Salesman_Price_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/price/grid.phtml');
	}

	public function getSalesmen()
	{
		$sql = "SELECT * FROM `salesman` ORDER BY `fname` ASC";
		return Ccc::getModel('salesman')->fetchAll($sql);
	}


     public function getNumberOfRecords()
    {
       $sql = "SELECT COUNT(`salesman_id`) FROM `salesman` ORDER BY `salesman_id` DESC";
       $total = Ccc::getModel('Core_Adapter')->fetchOne($sql);
       return $total;
    }


	public function getCollection()
	{
	
	    $pager=Ccc::getModel("Core_Pager");
	    $pager->setTotalRecords($this->getNumberOfRecords())->caculate();

		$salesmanId = $this->getData('salesmanId');

		$salesman = Ccc::getModel('salesman')->load($salesmanId);

		$start = $pager->getStartLimit();
        $rpp = $pager->getRecordPerPage();

		$join_query = "SELECT SP.entity_id,P.product_id,P.name, P.sku, P.cost, P.name, SP.salesman_price 
			FROM `product` P 
			LEFT JOIN `salesman_price` SP 
			ON P.product_id = SP.product_id AND SP.salesman_id = '{$salesmanId}' 
			ORDER BY SP.entity_id  DESC
			LIMIT $start,$rpp";
		$salesman_prices = Ccc::getModel('Salesman_Price')->fetchAll($join_query);
		return ['salesman_prices'=>$salesman_prices,'salesman'=>$salesman];
	}
}
