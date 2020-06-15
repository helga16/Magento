<?php

namespace Alevel\RandomNumber\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Alevel\RandomNumber\Controller\Index
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
