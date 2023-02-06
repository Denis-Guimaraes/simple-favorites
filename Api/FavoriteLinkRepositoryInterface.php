<?php
namespace SimpleMage\SimpleFavorites\Api;

use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkSearchResultsInterface;

/**
 * @api
 * @since 1.0.0
 */
interface FavoriteLinkRepositoryInterface
{
    /**
     * Get favorite list by customer ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @return FavoriteLinkInterface[]
     */
    public function getListByCustomerId(int $customerId): array;
    /**
     * Get favorite list
     *
     * @api
     * @since 1.0.0
     * @param SearchCriteriaInterface $searchCriteria
     * @return FavoriteLinkSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): FavoriteLinkSearchResultsInterface;
    /**
     * Save favorite
     *
     * @api
     * @since 1.0.0
     * @param FavoriteLinkInterface $favoriteLink
     * @return FavoriteLinkInterface
     */
    public function save(FavoriteLinkInterface $favoriteLink): FavoriteLinkInterface;
    /**
     * Delete favorite
     *
     * @api
     * @since 1.0.0
     * @param FavoriteLinkInterface $favoriteLink
     * @return bool
     */
    public function delete(FavoriteLinkInterface $favoriteLink): bool;
}
