<?php

namespace Alevel\RandomNumber\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Note
 * @package Alevel\RandomNumber\Model\ResourceModel
 */
class Note extends AbstractDb
{
    /**
     * initialize ResourceModel
     */
    protected function _construct()
    {
        $this->_init('note_orders','id');
    }
}
