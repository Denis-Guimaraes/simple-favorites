<?php

namespace SimpleMage\SimpleFavorites\Test\Unit\Fake;

use SimpleMage\SimpleFavorites\Api\FavoriteLinkRepositoryInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkSearchResultsInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use SimpleMage\SimpleFavorites\Model\FavoriteLinkSearchResults;

class InMemoryFavoriteLinkRepository implements FavoriteLinkRepositoryInterface
{
    private array $favoriteLinks = [];

    public function getListByCustomerId(int $customerId): array
    {
        $customerFavoriteLinks = array_filter(
            $this->favoriteLinks,
            fn($favorite) => $favorite->getCustomerId() === $customerId
        );
        return $customerFavoriteLinks;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): FavoriteLinkSearchResultsInterface
    {
        $searchResults = new FavoriteLinkSearchResults();
        $searchResults->setItems($this->favoriteLinks);
        $searchResults->setSearchCriteria($searchCriteria);
        return $searchResults;
    }

    public function save(FavoriteLinkInterface $favoriteLink): FavoriteLinkInterface
    {
        $this->favoriteLinks[$this->getKey($favoriteLink)] = $favoriteLink;
        return $favoriteLink;
    }

    public function delete(FavoriteLinkInterface $favoriteLink): bool
    {
        unset($this->favoriteLinks[$this->getKey($favoriteLink)]);
        return true;
    }

    private function getKey(FavoriteLinkInterface $favoriteLink): string
    {
        return sprintf("%d_%d", $favoriteLink->getCustomerId(), $favoriteLink->getProductId());
    }
}
