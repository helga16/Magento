<?php

namespace Alevel\Orders\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class AjaxOrder
 * @package Alevel\Orders\Model\ResourceModel
 */
class AjaxOrder extends AbstractDb
{
    /**
     * Standard resource model initialization.
     */
    public function _construct()
    {
        $this->_init("ajax_order",'id');
    }

}

