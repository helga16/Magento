<?php


namespace Alevel\Orders\Controller\Show;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;


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
