<?php
namespace SimpleMage\SimpleFavorites\Api;

use SimpleMage\SimpleFavorites\Api\Data\FavoriteInterface;

/**
 * @api
 * @since 1.0.0
 */
interface FavoriteRepositoryInterface
{
    /**
     * Get customer favorites
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @return FavoriteInterface[]
     */
    public function get(int $customerId): array;
    /**
     * Save favorite
     *
     * @api
     * @since 1.0.0
     * @param FavoriteInterface $favorite
     * @return FavoriteInterface
     */
    public function save(FavoriteInterface $favorite): FavoriteInterface;
    /**
     * Delete favorite
     *
     * @api
     * @since 1.0.0
     * @param FavoriteInterface $favorite
     * @return bool
     */
    public function delete(FavoriteInterface $favorite): bool;
    /**
     * Save favorite by customer ID and product ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @param int $productId
     * @return FavoriteInterface
     */
    public function saveByIds(int $customerId, int $productId): FavoriteInterface;
    /**
     * Delete favorite by customer ID and product ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @param int $productId
     * @return bool
     */
    public function deleteByIds(int $customerId, int $productId): bool;
}
