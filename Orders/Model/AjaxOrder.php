<?php

namespace Alevel\Orders\Model;

use Alevel\Orders\Api\Model\AjaxInterface;
use Magento\Framework\Model\AbstractModel;
use Alevel\Orders\Model\ResourceModel\AjaxOrder as ResourceModels;

/**
 * Class AjaxOrder
 * @package Alevel\Orders\Model
 */
class AjaxOrder extends AbstractModel implements AjaxInterface
{

    /**
     *  Initialize resource model.
     */
    public function _construct()
    {
        $this->_init(ResourceModels::class);
    }

    /**
     * @return array|mixed|null
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * @param $name
     * @return mixed|void
     */
    public function setLabel($name)
    {
        $this->setData(self::LABEL, $name);
    }
}





