<?php

namespace Alevel\Orders\Block;

use Magento\Framework\View\Element\Template;

class OrderBlock extends Template
{

    /**
     * @return false|string
     */
    public function getJsLayout()
    {
        $result = json_decode(parent::getJsLayout(),true);
        $result['components']['alevel-component']['textContainer'] = '#divMy';
        return json_encode($result);
    }
}
