<?php

namespace SimpleMage\SimpleFavorites\Model;

use SimpleMage\SimpleFavorites\Api\FavoriteLinkRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink\CollectionFactory;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkSearchResultsInterfaceFactory;
use SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink as FavoriteLinkResource;
use Magento\Framework\Api\SearchCriteriaInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterface;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkSearchResultsInterface;

class FavoriteLinkRepository implements FavoriteLinkRepositoryInterface
{
    private CollectionProcessorInterface $collectionProcessor;
    private CollectionFactory $favoriteLinkCollectionFactory;
    private FavoriteLinkSearchResultsInterfaceFactory $favoriteLinkSearchResultsFactory;
    private FavoriteLinkResource $favoriteLinkResource;

    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $favoriteLinkCollectionFactory,
        FavoriteLinkSearchResultsInterfaceFactory $favoriteLinkSearchResultsFactory,
        FavoriteLinkResource $favoriteLinkResource
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->favoriteLinkCollectionFactory = $favoriteLinkCollectionFactory;
        $this->favoriteLinkSearchResultsFactory = $favoriteLinkSearchResultsFactory;
        $this->favoriteLinkResource = $favoriteLinkResource;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): FavoriteLinkSearchResultsInterface
    {
        $collection = $this->favoriteLinkCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->favoriteLinkSearchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);
        return $searchResult;
    }

    public function save(FavoriteLinkInterface $favoriteLink): FavoriteLinkInterface
    {
        $this->favoriteLinkResource->save($favoriteLink);
        return $favoriteLink;
    }

    public function delete(FavoriteLinkInterface $favoriteLink): bool
    {
        $this->favoriteLinkResource->delete($favoriteLink);
        return true;
    }
}
