<?php
namespace SimpleMage\SimpleFavorites\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterface;

/**
 * @api
 * @since 1.0.0
 */
interface FavoriteLinkSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get favorite list
     *
     * @api
     * @since 1.0.0
     * @return FavoriteLinkInterface[]
     */
    public function getItems();
    /**
     * Set favorite list
     *
     * @api
     * @since 1.0.0
     * @param FavoriteLinkInterface[] $items
     * @return FavoriteLinkSearchResultsInterface
     */
    public function setItems(array $items);
}
