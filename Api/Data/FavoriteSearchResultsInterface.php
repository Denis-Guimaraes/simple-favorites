<?php
namespace SimpleMage\SimpleFavorites\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteInterface;

/**
 * @api
 * @since 1.0.0
 */
interface FavoriteSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get favorite list
     *
     * @api
     * @since 1.0.0
     * @return FavoriteInterface[]
     */
    public function getItems(): array;
    /**
     * Set favorite list
     *
     * @api
     * @since 1.0.0
     * @param FavoriteInterface[] $items
     * @return FavoriteSearchResultsInterface
     */
    public function setItems(array $items): self;
}
