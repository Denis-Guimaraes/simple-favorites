<?php

namespace SimpleMage\SimpleFavorites\ViewModel\Favorite;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\App\RequestInterface;

class ProductList implements ArgumentInterface
{
    private CollectionFactory $collectionFactory;
    private Visibility $productVisibility;
    private Collection $productCollection;
    private RequestInterface $request;

    public function __construct(
        CollectionFactory $collectionFactory,
        Visibility $productVisibility,
        RequestInterface $request
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->productVisibility = $productVisibility;
        $this->request = $request;
    }

    public function getProductCollection(): Collection
    {
        if (!isset($this->productCollection)) {
            $this->loadProductCollection();
        }
        return $this->productCollection;
    }

    private function loadProductCollection(): void
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
        $this->productCollection = $collection;
    }
}
