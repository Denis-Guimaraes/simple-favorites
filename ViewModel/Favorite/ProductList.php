<?php

namespace SimpleMage\SimpleFavorites\ViewModel\Favorite;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use SimpleMage\SimpleFavorites\Model\Favorites\ProductCollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection;

class ProductList implements ArgumentInterface
{
    public const DEFAULT_VIEW_MODE = 'grid';
    private ProductCollectionFactory $productCollectionFactory;
    private RequestInterface $request;
    private Collection $productCollection;

    public function __construct(ProductCollectionFactory $productCollectionFactory, RequestInterface $request)
    {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->request = $request;
    }

    public function getProductCollection(): Collection
    {
        if (!isset($this->productCollection)) {
            $this->productCollection = $this->productCollectionFactory->createFromRequest();
        }
        return $this->productCollection;
    }

    public function getViewMode(): string
    {
        return $this->request->getParam('product_list_mode') ?: self::DEFAULT_VIEW_MODE;
    }

    public function getImageDisplayArea(): string
    {
        if ($this->getViewMode() === 'list') {
            return 'category_page_list';
        }
        return 'category_page_grid';
    }

    public function showDescription(): bool
    {
        if ($this->getViewMode() === 'list') {
            return true;
        }
        return false;
    }
}
