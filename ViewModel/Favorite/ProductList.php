<?php

namespace SimpleMage\SimpleFavorites\ViewModel\Favorite;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Product\Visibility;

class ProductList implements ArgumentInterface
{
    private CollectionFactory $collectionFactory;
    private Visibility $productVisibility;

    public function __construct(CollectionFactory $collectionFactory, Visibility $productVisibility)
    {
        $this->collectionFactory = $collectionFactory;
        $this->productVisibility = $productVisibility;
    }

    public function getProducts(): array
    {
        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setVisibility($this->productVisibility->getVisibleInSiteIds());
        $collection->joinField(
            'favorite_created_at',
            $collection->getTable('simple_favorites'),
            'created_at',
            'product_id = entity_id',
            ['customer_id' => 2]
        );
        $collection->addOrder('favorite_created_at', 'ASC');
        $collection->load();
        return $collection->getItems();
    }
}
