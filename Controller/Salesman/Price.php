<?php

class Controller_Salesman_price extends Controller_Core_Action
{
    protected $listOfSalesman = null;
    protected $lists = null;
    protected $sname = null;
    protected $salesmanModel = null;

    protected $session = null;
    protected $salesmanPriceModel = null;

    public function setSession(Model_Core_Session $session)
    {
        $this->session = $session;
        return $this;
    }

    public function getSession()
    {
        if ($this->session) {
            return $this->session;
        }
        $session = new Model_Core_Session();
        $this->setSession($session);
        return $session;
    }


    public function setListOfSalesman($lists)
    {
        $this->listOfSalesman = $lists;
        return $this;
    }

    public function getListOfSalesman()
    {
        return $this->listOfSalesman;
    }

    public function setLists($lists)
    {
        $this->lists = $lists;
        return $this;
    }

    public function getLists()
    {
        return $this->lists;
    }

    public function setSname($sname)
    {
        $this->sname = $sname;
        return $this;
    }

    public function getSname()
    {
        return $this->sname;
    }

    public function setSalesmanModel(Model_Salesman $salesmanModel)
    {
        $this->salesmanModel = $salesmanModel;
        return $this;
    }

    public function getSalesmanModel()
    {
        if ($this->salesmanModel != null) {
            return $this->salesmanModel;
        }
        $model = new Model_Salesman();
        $this->setSalesmanModel($model);
        return $model;
    }

    public function setSalesmanPriceModel(Model_Salesman_Price $salesmanPriceModel)
    {
        $this->salesmanPriceModel = $salesmanPriceModel;
        return $this;
    }

    public function getSalesmanPriceModel()
    {
        if ($this->salesmanPriceModel != null) {
            return $this->salesmanPriceModel;
        }

        $model = new Model_Salesman_Price();
        $this->setSalesmanPriceModel($model);
        return $model;
    }


    public function gridAction()
    {
        try {
            $salesmanId = (int) $this->getRequest()->getParams('sid');
            if ($salesmanId == null and !$this->getSession()->has('sid')) {
                $this->getMessageModel()->addMessage("For accessing price list, Salesman id is not getting.", Model_Core_Message::NOTICE);
                $this->redirect("grid", "salesman", null, true);
                die();
            }

            if ($this->getRequest()->getParams('sid')) {
                $salesmanId = (int) $this->getRequest()->getParams('sid');
                $this->getSession()->set('sid', $salesmanId);
            } else {
                $salesmanId = $this->getSession()->get('sid');
            }

            $salesman = $this->getSalesmanModel()->load($salesmanId);
            $sName = $salesman['fname'];

            $sql = "SELECT p.product_id, p.name, p.sku, p.price, p.cost, 
        (SELECT salesman_price FROM salesman_price WHERE product_id = p.product_id AND salesman_id = '{$salesmanId}') AS salesman_price,
        (SELECT entity_id FROM salesman_price WHERE product_id = p.product_id AND salesman_id = '{$salesmanId}') AS entity_id
        FROM `product` p;";

            $lists = $this->getSalesmanPriceModel()->fetchAll($sql);

            $sql = "SELECT `salesman_id`,`fname` FROM `salesman`";
            $listOfSalesman = $this->getSalesmanModel()->fetchAll($sql);

            $this->setSname($sName);
            $this->setLists($lists);
            $this->setListOfSalesman($listOfSalesman);
            $this->getTemplate("salesman_price/grid.phtml");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }

    }



    public function updateAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request.", 1);
            }

            $priceData = $this->getRequest()->getPost();
            if (!$priceData) {
                throw new Exception("No data is posted.", 1);
            }

            $productIds = $priceData['salesman_price']['product_id'];
            $productPrices = $priceData['salesman_price']['price'];
            $arr = array_combine($productIds, $productPrices);

            $salesmanId = $this->getSession()->get('sid');

            foreach ($arr as $productId => $price) {
                $sql = "SELECT * FROM `salesman_price` WHERE `salesman_id`='$salesmanId' AND `product_id`='$productId'";
                $salesmanPriceData = $this->getSalesmanPriceModel()->fetchRow($sql);
                if ($salesmanPriceData) {
                    $entityId = $salesmanPriceData['entity_id'];
                    $salesmanPriceData = ["salesman_price" => $price];
                    $condition = ["entity_id" => $entityId];
                    $this->getSalesmanPriceModel()->update($salesmanPriceData, $condition);
                    $this->getMessageModel()->addMessage("Salesman Price updated successfully.");

                } else if ($price) {
                    $salesmanPriceData = [
                        "salesman_id" => $salesmanId,
                        "product_id" => $productId,
                        "salesman_price" => $price
                    ];
                    $this->getSalesmanPriceModel()->insert($salesmanPriceData);
                    $this->getMessageModel()->addMessage("New salesman Price inserted successfully.");
                }
            }
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }

        $this->redirect("grid");
    }

    public function filterAction()
    {
        try {
            $salesmanId = (int) $this->getRequest()->getPost('sid');
            if (!$salesmanId) {
                throw new Exception("Invalid Request.", 1);
            }

            $this->getSession()->set('sid', $salesmanId);
            $salesman = $this->getSalesmanModel()->load($salesmanId);
            if (!$salesman) {
                throw new Exception("Salesman data is not found.", 1);
            }

            $sName = $salesman['fname'];
            $sql = "SELECT p.product_id, p.name, p.sku, p.price, p.cost,
        (SELECT salesman_price FROM salesman_price WHERE product_id = p.product_id AND salesman_id = '{$salesmanId}') AS salesman_price,
        (SELECT entity_id FROM salesman_price WHERE product_id = p.product_id AND salesman_id = '{$salesmanId}') AS entity_id
        FROM `product` p;";

            $lists = $this->getSalesmanPriceModel()->fetchAll($sql);
            if (!$lists) {
                throw new Exception("Salesman product list is not found.", 1);
            }

            foreach ($lists as $list) {
                echo "<tr>
                            <td class='border border-gray-400 py-2 px-4'>" . $list['product_id'] . "</td>
                            <td class='border border-gray-400 py-2 px-4'>" . $list['name'] . "</td>
                            <td class='border border-gray-400 py-2 px-4'>" . $list['sku'] . "</td>
                            <td class='border border-gray-400 py-2 px-4'>" . $list['price'] . "</td>
                            <td class='border border-gray-400 py-2 px-4'>" . $list['cost'] . "</td>
                            <td class='border border-gray-400 py-2 px-4'>" . $sName . "</td>
                            <td class='border border-gray-400 py-2 px-4'>
                                <input type='hidden' name='salesman_price[product_id][]' value='" . $list['product_id'] . "'>
                                <input class='border border-gray-400 rounded-lg py-2 px-4' type='number'
                                    name='salesman_price[price][]' value='" . $list['salesman_price'] . "'>
                            </td>
                            <td class='border border-gray-400 py-2 px-4'>
                                <a href='Salesman_price.php?action=remove&eid=" . $list['entity_id'] . "'
                                    class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>";
                if ($list['entity_id'] != null):
                    echo "Remove Price";
                endif;
                echo "</a>
                            </td>
                        </tr>";
            }

        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }

    }

    public function removeAction()
    {
        try {
            $entityId = (int) $this->request->getParams('eid');
            if (!$entityId) {
                throw new Exception("Entity id is not found.", 1);
            }

            $condition = [$this->getSalesmanPriceModel()->getPrimaryKey() => $entityId];
            if (!$this->getSalesmanPriceModel()->delete($condition)) {
                throw new Exception("Unable to delete the saleman price.", 1);
            }

            $this->getMessageModel()->addMessage("Salesman price deleted successfully.");
            $this->redirect("grid");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }

    }

}


?>