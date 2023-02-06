<?php

namespace SimpleMage\SimpleFavorites\Model;

use SimpleMage\SimpleFavorites\Api\CustomerFavoritesInterface;

class CustomerFavorites implements CustomerFavoritesInterface
{
    private array $favoriteLinks = [];

    public function __construct(array $favoriteLinks)
    {
        $this->favoriteLinks = $favoriteLinks;
    }

    public function getProductIds(): array
    {
        return array_map(fn($link) => $link->getProductId(), $this->favoriteLinks);
    }
}
