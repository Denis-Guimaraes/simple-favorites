<?php

namespace SimpleMage\SimpleFavorites\Api;

interface CustomerFavoritesInterface
{
    /**
     * Get product ids
     *
     * @api
     * @since 1.0.0
     * @return int[]
     */
    public function getProductIds(): array;
}
