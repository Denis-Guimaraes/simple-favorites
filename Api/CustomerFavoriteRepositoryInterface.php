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
     * Get customer favorites order asc by customer ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @return int[] $productIds
     */
    public function getByIdAsc(int $customerId): array;

    /**
     * Get customer favorites order desc by customer ID
     *
     * @api
     * @since 1.0.0
     * @param int $customerId
     * @return int[] $productIds
     */
    public function getByIdDesc(int $customerId): array;
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
