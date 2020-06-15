<?php

namespace Alevel\RandomNumber\Controller\Adminhtml\Cart;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;

/**
 * Class Index
 * @package Alevel\RandomNumber\Controller\Adminhtml\Cart
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $page=$this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->setActiveMenu('Alevel_RandomNumber::child1');
        $page->getConfig()->getTitle()->prepend(__('Observer Grid'));
        return $page;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Alevel_RandomNumber::child1');
    }
}

