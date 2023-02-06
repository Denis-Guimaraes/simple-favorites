<?php

namespace SimpleMage\SimpleFavorites\Api;

interface FavoriteLinkManagementInterface
{
    /**
     * Get customer favorites
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @return CustomerFavoritesInterface
     */
    public function getCustomerFavorites(int $customerId): CustomerFavoritesInterface;
    /**
     * Add favorite
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @param int $productId
     * @return void
     */
    public function addByIds(int $customerId, int $productId): void;
    /**
     * Remove favorite
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @param int $productId
     * @return void
     */
    public function removeByIds(int $customerId, int $productId): void;
}
