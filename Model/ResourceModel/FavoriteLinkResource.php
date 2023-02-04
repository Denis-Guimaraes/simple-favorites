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
}
