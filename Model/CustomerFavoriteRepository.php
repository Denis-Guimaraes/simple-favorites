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

    public function getByIds(int $customerId, int $productId): int
    {
        return $this->favoriteLinkResource->getByIds($customerId, $productId);
    }

    public function saveByIds(int $customerId, int $productId): bool
    {
        if ($this->exist($customerId, $productId)) {
            return true;
        }

        try {
            $this->favoriteLinkResource->saveByIds($customerId, $productId);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save favorite.'), $e);
        }
        return true;
    }

    public function deleteByIds(int $customerId, int $productId): bool
    {
        if (!$this->exist($customerId, $productId)) {
            return true;
        }

        try {
            $this->favoriteLinkResource->deleteByIds($customerId, $productId);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete favorite.'), $e);
        }
        return true;
    }

    private function exist(int $customerId, int $productId): bool
    {
        return !empty($this->getByIds($customerId, $productId));
    }
}
