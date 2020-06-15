<?php

namespace Alevel\Rewrite\Block\Product\View;

use Magento\Catalog\Block\Product\View\Description;

/**
 * Class DescriptionRewrite
 * @package Alevel\Rewrite\Block\Product\View
 */
class DescriptionRewrite extends Description
{
    /**
     * DescriptionRewrite constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, array $data = [])
    {
        parent::__construct($context, $registry, $data);
    }
}
