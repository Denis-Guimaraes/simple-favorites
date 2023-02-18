<?php

namespace SimpleMage\SimpleFavorites\Model;

use SimpleMage\SimpleFavorites\Api\CustomerFavoriteRepositoryInterface;
use SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink as FavoriteLinkResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class CustomerFavoriteRepository implements CustomerFavoriteRepositoryInterface
{
    private FavoriteLinkResource $favoriteLinkResource;

    public function __construct(FavoriteLinkResource $favoriteLinkResource)
    {
        $this->favoriteLinkResource = $favoriteLinkResource;
    }

    public function getByIdAsc(int $customerId): array
    {
        $productIds = $this->favoriteLinkResource->getByCustomerId($customerId, 'asc');
        return array_map(fn($productId) => (int) $productId, $productIds);
    }

    public function getByIdDesc(int $customerId): array
    {
        $productIds = $this->favoriteLinkResource->getByCustomerId($customerId, 'desc');
        return array_map(fn($productId) => (int) $productId, $productIds);
    }

    public function saveByIds(int $customerId, int $productId): bool
    {
        try {
            $this->favoriteLinkResource->saveByIds($customerId, $productId);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save favorite.'), $e);
        }
        return true;
    }

    public function deleteByIds(int $customerId, int $productId): bool
    {
        try {
            $this->favoriteLinkResource->deleteByIds($customerId, $productId);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete favorite.'), $e);
        }
        return true;
    }
}
