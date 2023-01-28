<?php
namespace SimpleMage\SimpleFavorites\Api;

use SimpleMage\SimpleFavorites\Api\CustomerFavoritesInterface;
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
     * @return CustomerFavoritesInterface
     */
    public function get(int $customerId): CustomerFavoritesInterface;
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
}
