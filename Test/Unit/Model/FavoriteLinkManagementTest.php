<?php

namespace SimpleMage\SimpleFavorites\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use SimpleMage\SimpleFavorites\Api\CustomerFavoritesInterface;
use SimpleMage\SimpleFavorites\Model\FavoriteLinkManagement;
use SimpleMage\SimpleFavorites\Test\Unit\Fake\InMemoryFavoriteLinkRepository;
use SimpleMage\SimpleFavorites\Api\CustomerFavoritesInterfaceFactory;
use SimpleMage\SimpleFavorites\Model\CustomerFavorites;
use SimpleMage\SimpleFavorites\Api\Data\FavoriteLinkInterfaceFactory;
use SimpleMage\SimpleFavorites\Test\Unit\Fake\SimpleFavoriteLink;

class FavoriteLinkManagementTest extends TestCase
{
    private FavoriteLinkManagement $favoriteLinkManagement;

    protected function setUp(): void
    {
        $inMemoryFavoriteLinkRepository = new InMemoryFavoriteLinkRepository();
        $mockCustomerFavoritesFactory = $this->createMockCustomerFavoritesFactory();
        $mockFavoriteLinkFactory = $this->createMockFavoriteLinkFactory();
        $this->favoriteLinkManagement = new FavoriteLinkManagement(
            $inMemoryFavoriteLinkRepository,
            $mockCustomerFavoritesFactory,
            $mockFavoriteLinkFactory
        );
    }

    public function testGetCustomerFavorites(): void
    {
        $customerFavorites = $this->favoriteLinkManagement->getCustomerFavorites(1);
        $this->assertInstanceOf(CustomerFavoritesInterface::class, $customerFavorites);
    }

    public function testAddByIdsAndCustomerFavoritesHasOneFavorite(): void
    {
        $this->favoriteLinkManagement->addByIds(1, 1);
        $customerFavorites = $this->favoriteLinkManagement->getCustomerFavorites(1);
        $this->assertCount(1, $customerFavorites->getProductIds());
    }

    public function testRemoveByIdsAndCustomerFavoritesIsEmpty(): void
    {
        $this->favoriteLinkManagement->addByIds(1, 1);
        $this->favoriteLinkManagement->removeByIds(1, 1);
        $customerFavorites = $this->favoriteLinkManagement->getCustomerFavorites(1);
        $this->assertEmpty($customerFavorites->getProductIds());
    }

    private function createMockCustomerFavoritesFactory(): CustomerFavoritesInterfaceFactory
    {
        $mockCustomerFavoritesFactory = $this->getMockBuilder(CustomerFavoritesInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockCustomerFavoritesFactory->method('create')
            ->will($this->returnCallback([$this, 'createCustomerFavorites']));
        return $mockCustomerFavoritesFactory;
    }

    public function createCustomerFavorites()
    {
        $args = func_get_args();
        return new CustomerFavorites(...$args[0]);
    }

    private function createMockFavoriteLinkFactory(): FavoriteLinkInterfaceFactory
    {
        $mockfavoriteLinkFactory = $this->getMockBuilder(FavoriteLinkInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockfavoriteLinkFactory->method('create')
            ->will($this->returnCallback([$this, 'createFavoriteLink']));
        return $mockfavoriteLinkFactory;
    }

    public function createFavoriteLink()
    {
        $args = func_get_args();
        return new SimpleFavoriteLink(...$args[0]);
    }
}
