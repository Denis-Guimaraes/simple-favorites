<?php

namespace SimpleMage\SimpleFavorites\Test\Unit\Fake;

use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterface;

class SimpleFavoriteLink implements FavoriteLinkInterface
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getData($key)
    {
        return $this->data[$key];
    }

    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

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
}
