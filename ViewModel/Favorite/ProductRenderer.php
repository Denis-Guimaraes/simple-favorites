<?php

namespace SimpleMage\SimpleFavorites\ViewModel\Favorite;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Block\Product\ImageFactory;
use Magento\Catalog\Helper\Output;
use Magento\Framework\View\LayoutInterface;
use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render;

class ProductRenderer implements ArgumentInterface
{
    private ImageFactory $imageFactory;
    private Output $outputHelper;
    private LayoutInterface $layout;

    public function __construct(
        ImageFactory $imageFactory,
        Output $outputHelper,
        LayoutInterface $layout
    ) {
        $this->imageFactory = $imageFactory;
        $this->outputHelper = $outputHelper;
        $this->layout = $layout;
    }

    public function renderImage(ProductInterface $product, string $imageId, array $attributes = []): string
    {
        return $this->imageFactory->create($product, $imageId, $attributes)->toHtml();
    }

    public function renderName(ProductInterface $product): string
    {
        return $this->outputHelper->productAttribute($product, $product->getName(), 'name');
    }

    public function renderPrice(ProductInterface $product): string
    {
        $priceRender = $this->layout->getBlock('product.price.render.default')->setData('is_product_list', true);
        if (!$priceRender) {
            return '';
        }

        return $priceRender->render(
            FinalPrice::PRICE_CODE,
            $product,
            [
                'include_container' => true,
                'display_minimal_price' => true,
                'zone' => Render::ZONE_ITEM_LIST,
                'list_category_page' => true
            ]
        );
    }
}
