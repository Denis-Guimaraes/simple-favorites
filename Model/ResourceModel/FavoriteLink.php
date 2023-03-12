<?php

namespace SimpleMage\SimpleFavorites\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class FavoriteLink extends AbstractDb
{
    public const TABLE_NAME_FAVORITE = 'simple_favorites';
    public const ID_FIELD_NAME = 'link_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME_FAVORITE, self::ID_FIELD_NAME);
    }

    public function getByIds(int $customerId, int $productId): ?int
    {
        $connection = $this->getConnection();
        $query = $connection->select()
            ->from(self::TABLE_NAME_FAVORITE, 'product_id')
            ->where('customer_id = ?', $customerId)
            ->where('product_id = ?', $productId);

        return $connection->fetchOne($query);
    }

    public function saveByIds(int $customerId, int $productId): int
    {
        $connection = $this->getConnection();
        $bind = [
            'customer_id' => $customerId,
            'product_id' => $productId
        ];

        return $connection->insert(self::TABLE_NAME_FAVORITE, $bind);
    }

    public function deleteByIds(int $customerId, int $productId): int
    {
        $connection = $this->getConnection();
        $where = [
            $connection->quoteInto('customer_id = ?', $customerId),
            $connection->quoteInto('product_id = ?', $productId),
        ];

        return $connection->delete(self::TABLE_NAME_FAVORITE, $where);
    }
}
