<?php

namespace SimpleMage\SimpleFavorites\Model\Favorites;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink;

class ProductCollectionFactory
{
    public const DEFAULT_PAGE_SIZE = 12;
    public const DEFAULT_CURRENT_PAGE = 1;
    public const DEFAULT_ORDER_ATTRIBUTE = 'favorite_created_at';
    public const DEFAULT_ORDER = 'desc';

    private CollectionFactory $collectionFactory;
    private Visibility $productVisibility;
    private UserContextInterface $userContext;
    private RequestInterface $request;

    public function __construct(
        CollectionFactory $collectionFactory,
        Visibility $productVisibility,
        UserContextInterface $userContext,
        RequestInterface $request
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->productVisibility = $productVisibility;
        $this->userContext = $userContext;
        $this->request = $request;
    }

    public function createFromRequest(): Collection
    {
        $collection = $this->createCollection();
        $pageSize = $this->getPageSizeFromRequest();
        $currentPage = $this->getCurrentPageFromRequest();
        $attributeOrder = $this->getAttributeOrderFromRequest();
        $order = $this->getOrderFromRequest();

        $collection->setPageSize($pageSize);
        $collection->setCurPage($currentPage);
        $collection->addOrder($attributeOrder, $order);
        return $collection->load();
    }

    private function createCollection(): Collection
    {
        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setVisibility($this->productVisibility->getVisibleInSiteIds());
        return $collection->joinField(...$this->getCreatedAtJoinParameters());
    }

    private function getCreatedAtJoinParameters(): array
    {
        return [
            'favorite_created_at',
            FavoriteLink::TABLE_NAME_FAVORITE,
            'created_at',
            'product_id = entity_id',
            ['customer_id' => $this->userContext->getUserId()]
        ];
    }

    private function getPageSizeFromRequest(): int
    {
        return $this->request->getParam('product_list_limit') ?: self::DEFAULT_PAGE_SIZE;
    }

    private function getCurrentPageFromRequest(): int
    {
        return $this->request->getParam('p') ?: self::DEFAULT_CURRENT_PAGE;
    }

    private function getAttributeOrderFromRequest(): string
    {
        return $this->request->getParam('product_list_order') ?: self::DEFAULT_ORDER_ATTRIBUTE;
    }

    private function getOrderFromRequest(): string
    {
        return $this->request->getParam('product_list_dir') ?: self::DEFAULT_ORDER;
    }
}
