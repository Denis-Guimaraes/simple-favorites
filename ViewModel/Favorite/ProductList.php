<?php

namespace SimpleMage\SimpleFavorites\ViewModel\Favorite;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink;

class ProductList implements ArgumentInterface
{
    private const DEFAULT_PAGE_SIZE = 12;
    private CollectionFactory $collectionFactory;
    private Visibility $productVisibility;
    private Collection $productCollection;
    private Session $customerSession;
    private RequestInterface $request;

    public function __construct(
        CollectionFactory $collectionFactory,
        Visibility $productVisibility,
        Session $customerSession,
        RequestInterface $request
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->productVisibility = $productVisibility;
        $this->customerSession = $customerSession;
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
        $this->productCollection = $this->collectionFactory->create();
        $this->productCollection->addAttributeToSelect('*');
        $this->productCollection->setVisibility($this->productVisibility->getVisibleInSiteIds());
        $this->productCollection->joinField(...$this->getCreatedAtJoinParameters());
        $this->productCollection->addOrder('favorite_created_at', 'DESC');
        $this->productCollection->setPageSize($this->getPageSize());
        $this->productCollection->setCurPage($this->getCurrentPage());
        $this->productCollection->load();
    }

    private function getCreatedAtJoinParameters(): array
    {
        return [
            'favorite_created_at',
            FavoriteLink::TABLE_NAME_FAVORITE,
            'created_at',
            'product_id = entity_id',
            ['customer_id' => $this->customerSession->getCustomerId()]
        ];
    }

    private function getPageSize(): int
    {
        return $this->request->getParam('product_list_limit') ?: self::DEFAULT_PAGE_SIZE;
    }

    private function getCurrentPage(): int
    {
        return $this->request->getParam('p') ?: 1;
    }
}
