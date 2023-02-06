<?php

namespace SimpleMage\SimpleFavorites\Model;

use SimpleMage\SimpleFavorites\Api\CustomerFavoritesInterface;
use SimpleMage\SimpleFavorites\Api\CustomerFavoritesInterfaceFactory;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterfaceFactory;
use SimpleMage\SimpleFavorites\Api\FavoriteLinkManagementInterface;
use SimpleMage\SimpleFavorites\Api\FavoriteLinkRepositoryInterface;

class FavoriteLinkManagement implements FavoriteLinkManagementInterface
{
    private FavoriteLinkRepositoryInterface $favoriteLinkRepository;
    private CustomerFavoritesInterfaceFactory $customerFavoritesFactory;
    private FavoriteLinkInterfaceFactory $favoriteLinkFactory;

    public function __construct(
        FavoriteLinkRepositoryInterface $favoriteLinkRepository,
        CustomerFavoritesInterfaceFactory $customerFavoritesFactory,
        FavoriteLinkInterfaceFactory $favoriteLinkFactory
    ) {
        $this->favoriteLinkRepository = $favoriteLinkRepository;
        $this->customerFavoritesFactory = $customerFavoritesFactory;
        $this->favoriteLinkFactory = $favoriteLinkFactory;
    }

    public function getCustomerFavorites(int $customerId): CustomerFavoritesInterface
    {
        $customerFavoriteLinks = $this->favoriteLinkRepository->getListByCustomerId($customerId);
        return $this->customerFavoritesFactory->create(['favoriteLinks' => $customerFavoriteLinks]);
    }

    public function addByIds(int $customerId, int $productId): void
    {
        $favoriteLink = $this->favoriteLinkFactory->create();
        $favoriteLink->setCustomerId($customerId)->setProductId($productId);
        $this->favoriteLinkRepository->save($favoriteLink);
    }

    public function removeByIds(int $customerId, int $productId): void
    {
        $favoriteLink = $this->favoriteLinkFactory->create();
        $favoriteLink->setCustomerId($customerId)->setProductId($productId);
        $this->favoriteLinkRepository->delete($favoriteLink);
    }
}
