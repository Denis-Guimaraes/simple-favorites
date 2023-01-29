<?php
namespace SimpleMage\SimpleFavorites\Api;

use SimpleMage\SimpleFavorites\Api\Data\FavoriteInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteSearchResultsInterface;

/**
 * @api
 * @since 1.0.0
 */
interface FavoriteRepositoryInterface
{
    /**
     * Get customer favorite list
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @return FavoriteSearchResultsInterface
     */
    public function getListByCustomerId(int $customerId): FavoriteSearchResultsInterface;
    /**
     * Get favorite list
     *
     * @api
     * @since 1.0.0
     * @param SearchCriteriaInterface $searchCriteria
     * @return FavoriteSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): FavoriteSearchResultsInterface;
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
     * Save favorite
     *
     * @api
     * @since 1.0.0
     * @param FavoriteInterface $favorite
     * @return FavoriteInterface
     */
    public function save(FavoriteInterface $favorite): FavoriteInterface;
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
