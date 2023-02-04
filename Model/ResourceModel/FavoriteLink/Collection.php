<?php

namespace SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use SimpleMage\SimpleFavorites\Model\Data\FavoriteLink;
use SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink as FavoriteLinkResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(FavoriteLink::class, FavoriteLinkResource::class);
    }
}
