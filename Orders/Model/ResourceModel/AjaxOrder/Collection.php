<?php


namespace Alevel\Orders\Model\ResourceModel\AjaxOrder;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Alevel\Orders\Model\AjaxOrder as Model;
use Alevel\Orders\Model\ResourceModel\AjaxOrder as ResourceModel;

/**
 * Class Collection
 * @package Alevel\Orders\Model\ResourceModel\AjaxOrder
 */
class Collection extends AbstractCollection
{

    /**
     * Standard resource collection initialization.
     * Initialize model and resource model.
     */
    public function _construct()
    {
       $this->_init(Model::class,ResourceModel::class);
    }
}
