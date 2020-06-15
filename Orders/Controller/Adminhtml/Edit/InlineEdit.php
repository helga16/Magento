<?php

namespace Alevel\Orders\Controller\Adminhtml\Edit;

use Magento\Backend\App\Action;
use Alevel\Orders\Repository\AjaxRepository;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;

class InlineEdit extends Action
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var AjaxRepository
     */
    private $customerRepository;

    /**
     * InlineEdit constructor.
     * @param Context $context
     * @param AjaxRepository $customerRepository
     */
    public function __construct(
        Context $context,
        AjaxRepository $customerRepository
    ){
        parent::__construct($context);
        $this->context= $context;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax'))
        {
            $postItems = $this->getRequest()->getParam('items', []);
            $messages[] = __('Successfully save.');
            if (!count($postItems))
            {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    /** @var \Alevel\Orders\Model\AjaxOrder $model */
                    $model = $this->customerRepository->getById($entityId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$entityId]));
                        $this->customerRepository->save($model);
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }

        }
        return $resultJson->setData(
            [
            'messages' => $messages,
            'error' => $error
        ]
        );
    }
}
