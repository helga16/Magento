<?php

namespace Alevel\RandomNumber\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Alevel\RandomNumber\Repository\NoteRepository;

/**
 * Class NoteOrder
 * @package Alevel\RandomNumber\Observer
 */
class NoteOrder implements ObserverInterface
{
    /**
     * @var NoteRepository
     */
    private $repository;

    /**
     * NoteOrder constructor.
     * @param NoteRepository $repository
     */
    public function __construct(
        NoteRepository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(Observer $observer)
    {
        $item = $observer->getEvent()->getData('quote');
        $email = $item->getCustomerEmail();
        $customerLastName = $item->getCustomer()->getLastname();
        $customerId = $item->getCustomer()->getId();
        $arrItems = $item->getAllItems();
        foreach ($arrItems as $val) {
            $prodSku = $val->getProduct()->getSku();
            $prodQty = $val->getProduct()->getQty();
        }
        $saveNote = $this->repository->prepareObjectNote($customerId,$customerLastName,$email,$prodSku,$prodQty);
        $this->repository->save($saveNote);
    }
}
