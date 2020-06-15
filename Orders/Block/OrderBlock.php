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
        $result['components']['alevel-component']['inputValue'] = '#inputValue';
        $result['components']['alevel-component']['textContainer'] = '#textContainer';
        return json_encode($result);
    }
}
