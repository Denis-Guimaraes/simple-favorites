<?php
namespace SimpleMage\SimpleFavorites\Api\Data;

/**
 * @api
 * @since 1.0.0
 */
interface FavoriteInterface
{
    public const KEY_CUSTOMER_ID = 'customer_id';
    public const KEY_PRODUCT_ID = 'product_id';
    public const KEY_CREATED_AT = 'created_at';

    /**
     * Get customer id
     *
     * @api
     * @since 1.0.0
     * @return int
     */
    public function getCustomerId(): int;
    /**
     * Get product id
     *
     * @api
     * @since 1.0.0
     * @return int
     */
    public function getProductId(): int;
    /**
     * Get created time
     *
     * @api
     * @since 1.0.0
     * @return string
     */
    public function getCreatedAt(): string;
}
