<?php
namespace SimpleMage\SimpleFavorites\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * @api
 * @since 1.0.0
 */
interface CustomerFavoriteRepositoryInterface
{
    /**
     * Get by customer ID and product ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @param int $productId
     * @return int
     */
    public function getByIds(int $customerId, int $productId): int;
    /**
     * Save by customer ID and product ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @param int $productId
     * @return bool
     * @throws CouldNotSaveException
     */
    public function saveByIds(int $customerId, int $productId): bool;
    /**
     * Delete by customer ID and product ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @param int $productId
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteByIds(int $customerId, int $productId): bool;
}
