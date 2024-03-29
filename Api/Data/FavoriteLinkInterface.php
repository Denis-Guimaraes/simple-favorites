<?php
namespace SimpleMage\SimpleFavorites\Api\Data;

/**
 * @api
 * @since 1.0.0
 */
interface FavoriteLinkInterface
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
    /**
     * Set customer id
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @return FavoriteLinkInterface
     */
    public function setCustomerId(int $customerId): self;
    /**
     * Set product id
     *
     * @api
     * @since 1.0.0
     * @param int $productId
     * @return FavoriteLinkInterface
     */
    public function setProductId(int $productId): self;
    /**
     * Set created time
     *
     * @api
     * @since 1.0.0
     * @param string $createdAt
     * @return FavoriteLinkInterface
     */
    public function setCreatedAt(string $createdAt): self;
}
