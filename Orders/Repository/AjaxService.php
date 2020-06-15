<?php

namespace Alevel\Orders\Repository;

use Alevel\Orders\Model\AjaxOrderFactory;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Alevel\Orders\Repository\AjaxRepository as AjaxRepository;

/**
 * Class AjaxService
 * @package Alevel\Orders\Repository
 */
class AjaxService
{
    /**
     * @var AjaxOrderFactory
     */
    private $customer;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $criteriaBuilderFactory;

    /**
     * @var \Alevel\Orders\Repository\AjaxRepository
     */
    private $orderRepository;

    /**
     * AjaxService constructor.
     * @param AjaxOrderFactory $customer
     * @param SearchCriteriaBuilderFactory $criteriaBuilderFactory
     * @param \Alevel\Orders\Repository\AjaxRepository $orderRepository
     */
    public function __construct(
        AjaxOrderFactory $customer,
        SearchCriteriaBuilderFactory $criteriaBuilderFactory,
        AjaxRepository $orderRepository
    ) {
        $this->customer = $customer;
        $this->criteriaBuilderFactory = $criteriaBuilderFactory;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $nameAjax
     * @return \Alevel\Orders\Model\AjaxOrder
     */
    public function prepareObjectCustomer($nameAjax)
    {
        $customerObject = $this->customer->create();
        $customerObject->setLabel($nameAjax);
        return $customerObject;
    }

    /**
     * @return array[]
     */
    public function prepareMessagesList()
    {
        /** @var SearchCriteriaBuilder $criteriaBuilder */
        $criteriaBuilder = $this->criteriaBuilderFactory->create();
        $criteria = $criteriaBuilder->create();
        $messages = $this->orderRepository->getListAjax($criteria)->getItems();
        $messagesItems = array_map(
            function ($message) {

                return [
                    'name' => $message->getLabel()
                ];
            }, $messages
        );

        return $messagesItems;
    }
}
