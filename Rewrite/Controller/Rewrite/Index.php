<?php

namespace Alevel\Rewrite\Controller\Rewrite;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Controller\Account\Edit;
use Magento\Customer\Model\Session;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Alevel\Rewrite\Controller\Rewrite
 */
class Index extends Edit
{
    /**
     * Index constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param PageFactory $resultPageFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        CustomerRepositoryInterface $customerRepository,
        DataObjectHelper $dataObjectHelper
    )
    {
        parent::__construct($context, $customerSession, $resultPageFactory, $customerRepository, $dataObjectHelper);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        // logging to test override
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug('Block Override Test');
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $block = $resultPage->getLayout()->getBlock('customer_edit');
        if ($block) {
            $block->setRefererUrl($this->_redirect->getRefererUrl());
        }
        $data = $this->session->getCustomerFormData(true);
        $customerId = $this->session->getCustomerId();
        $customerDataObject = $this->customerRepository->getById($customerId);
        if (!empty($data)) {
            $this->dataObjectHelper->populateWithArray(
                $customerDataObject,
                $data,
                \Magento\Customer\Api\Data\CustomerInterface::class
            );
        }
        $this->session->setCustomerData($customerDataObject);
        $this->session->setChangePassword($this->getRequest()->getParam('changepass') == 1);
        $resultPage->getConfig()->getTitle()->set(__('Account Information'));
        return $resultPage;
    }
}

