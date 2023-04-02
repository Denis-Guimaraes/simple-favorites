<?php

namespace SimpleMage\SimpleFavorites\Block\Favorite\ProductList;

use Magento\Catalog\Block\Product\ProductList\Toolbar as BaseToolbar;
use SimpleMage\SimpleFavorites\Model\Favorites\ProductCollectionFactory;

/**
 * @inheritDoc
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Toolbar extends BaseToolbar
{
    protected $_orderField = ProductCollectionFactory::DEFAULT_ORDER_ATTRIBUTE;
    protected $_direction = ProductCollectionFactory::DEFAULT_ORDER;

    public function getAvailableOrders()
    {
        $availableOrder = parent::getAvailableOrders();
        $this->_availableOrder = ['favorite_created_at' => 'Date added', ...$availableOrder];
        return $this->_availableOrder;
    }
}
