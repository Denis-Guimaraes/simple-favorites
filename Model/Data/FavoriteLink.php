<?php

namespace SimpleMage\SimpleFavorites\Model\Data;

use Magento\Framework\Model\AbstractExtensibleModel;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterface;
use SimpleMage\SimpleFavorites\Model\ResourceModel\FavoriteLink as FavoriteLinkResource;

class FavoriteLink extends AbstractExtensibleModel implements FavoriteLinkInterface
{
    public function getCustomerId(): int
    {
        return $this->getData(self::KEY_CUSTOMER_ID);
    }

    public function getProductId(): int
    {
        return $this->getData(self::KEY_PRODUCT_ID);
    }

    public function getCreatedAt(): string
    {
        return $this->getData(self::KEY_CREATED_AT);
    }

    public function setCustomerId(int $customerId): FavoriteLinkInterface
    {
        $this->setData(self::KEY_CUSTOMER_ID, $customerId);
        return $this;
    }

    public function setProductId(int $productId): FavoriteLinkInterface
    {
        $this->setData(self::KEY_PRODUCT_ID, $productId);
        return $this;
    }

    public function setCreatedAt(string $createdAt): FavoriteLinkInterface
    {
        $this->setData(self::KEY_CREATED_AT, $createdAt);
        return $this;
    }

    protected function _construct()
    {
        $this->_init(FavoriteLinkResource::class);
    }
}
