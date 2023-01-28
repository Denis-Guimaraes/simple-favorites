<?php
namespace SimpleMage\SimpleFavorites\Api;

use Magento\Catalog\Api\Data\ProductInterface;

/**
 * @api
 * @since 1.0.0
 */
interface CustomerFavoritesInterface
{
    /**
     * Get customer favorite product ids
     *
     * @api
     * @since 1.0.0
     * @return int[]
     */
    public function getProductIds(): array;
    /**
     * Get customer favorite products
     *
     * @api
     * @since 1.0.0
     * @return ProductInterface[]
     */
    public function getProducts(): ProductInterface;
    /**
     * Add product to customer favorites
     *
     * @api
     * @since 1.0.0
     * @param int $productId
     * @return void
     */
    public function addProduct(int $productId): void;
    /**
     * Remove product from customer favorites
     *
     * @api
     * @since 1.0.0
     * @param int $productId
     * @return void
     */
    public function removeProduct(int $productId): void;
}
