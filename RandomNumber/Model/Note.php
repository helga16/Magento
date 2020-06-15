<?php

namespace Alevel\RandomNumber\Model;

use Alevel\RandomNumber\Api\Model\NoteInterface;
use Magento\Framework\Model\AbstractModel;
use Alevel\RandomNumber\Model\ResourceModel\Note as ResourceModel;

/**
 * Class Note
 * @package Alevel\RandomNumber\Model
 */
class Note extends AbstractModel implements NoteInterface
{
    /**
     * standart initialize of Model
     */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
