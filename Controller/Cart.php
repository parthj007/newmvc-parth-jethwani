<?php

class Controller_Cart extends Controller_Core_Action
{
    protected $cartModel = null;
    protected $cartItemModel = null;

    protected $productNames = array();
    protected $shippingMethods = null;
    protected $cartItems = null;
    protected $productModel = null;
    protected $shippingMethodModel = null;


    public function getProductNames()
    {
        return $this->productNames;
    }

    public function setProductNames(array $names)
    {
        $this->productNames = $names;
        return $this;
    }

    public function getCartItems()
    {
        return $this->cartItems;
    }

    public function setCartItems(array $items)
    {
        $this->cartItems = $items;
        return $this;
    }

    public function getShippingMethods()
    {
        return $this->shippingMethods;
    }

    public function setShippingMethods(array $shippingMethods)
    {
        $this->shippingMethods = $shippingMethods;
        return $this;
    }

    public function getProductModel()
    {
        if ($this->productModel) {
            return $this->productModel;
        }
        $model = new Model_Product();
        $this->setProductModel($model);
        return $model;
    }

    public function setProductModel(Model_Product $model)
    {
        $this->productModel = $model;
        return $this;
    }

    public function getShippingMethodModel()
    {
        if ($this->shippingMethodModel) {
            return $this->shippingMethodModel;
        }
        $model = new Model_Shipping_Method();
        $this->setShippingMethodModel($model);
        return $model;
    }

    public function setShippingMethodModel(Model_Shipping_Method $model)
    {
        $this->shippingMethodModel = $model;
        return $this;
    }
    public function getCartModel()
    {
        if ($this->cartModel) {
            return $this->cartModel;
        }
        $model = new Model_Cart();
        $this->setCartModel($model);
        return $model;
    }

    public function setCartModel(Model_Cart $model)
    {
        $this->cartModel = $model;
        return $this;
    }

    public function getCartItemModel()
    {
        if ($this->cartItemModel) {
            return $this->cartItemModel;
        }
        $model = new Model_Cart_Item();
        $this->setCartItemModel($model);
        return $model;
    }

    public function setCartItemModel(Model_Cart_Item $model)
    {
        $this->cartItemModel = $model;
        return $this;
    }

    public function gridAction()
    {
        $sql = "SELECT * FROM `{$this->getProductModel()->getTableName()}`";
        $productNames = $this->getProductModel()->fetchAll($sql);
        if (!$productNames) {
            throw new Exception("Products not found.", 1);
        }

        $sql = "SELECT * FROM `{$this->getShippingMethodModel()->getTableName()}`";
        $methods = $this->getShippingMethodModel()->fetchAll($sql);
        if (!$methods) {
            throw new Exception("Shipping Methods not found.", 1);
        }

        $sql = "SELECT * FROM `{$this->getCartItemModel()->getTableName()}`";
        $cartItems = $this->getCartItemModel()->fetchAll($sql);

        $this->setCartItems($cartItems);
        $this->setProductNames($productNames);
        $this->setShippingMethods($methods);
        $this->getTemplate("cart/grid.phtml");
    }

    public function insertProductAction()
    {
        if (!$this->getRequest()->isPost()) {
            throw new Exception("Invalid Request.", 1);
        }

        $product = $this->getRequest()->getPost('product');

        echo "<pre>";
        $productNames = $this->getRequest()->getPost('productNames');

        if (!$product) {
            throw new Exception("Product data is not posted.", 1);
        }

        $productArr = $this->getProductModel()->load($product['product_id']);

        $data = [
            "product_id" => $product['product_id'],
            "quantity" => $product['quantity'],
            "cost" => $productArr['cost'],
            "price" => $productArr['price']
        ];

        $this->getCartItemModel()->insert($data);
        $this->redirect($this->getUrlObj()->getUrl("grid"));
    }

    public function updateShipMethodAction()
    {
        echo "<pre>";
        print_r($this);
        $data = $this->getRequest()->getPost();
        print_r($data);
        echo "Shipping method action";
    }

    public function updateTaxAction()
    {
        echo "Update tax action";
    }

    public function deleteAction()
    {
        $itemId = (int) $this->getRequest()->getParams('item_id');
        if (!$itemId) {
            throw new Exception("Item id is not found.", 1);
        }

        $condition = [$this->getCartItemModel()->getPrimaryKey() => $itemId];
        $this->getCartItemModel()->delete($itemId);
        $this->redirect("grid");
    }
}

?>