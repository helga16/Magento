<?php

namespace Alevel\Orders\Controller\Adminhtml\Users;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Alevel\Orders\Controller\Adminhtml\Users
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $page =  $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->setActiveMenu('Alevel_Orders::alevel_orders');
        $page->getConfig()->getTitle()->prepend(__('Alevel_Orders'));
        return $page;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Alevel_Orders::users_list_access');
    }
}
