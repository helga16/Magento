<?php

namespace Alevel\RandomNumber\Repository;

use Alevel\RandomNumber\Api\Model\NoteInterface;
use Alevel\RandomNumber\Model\ResourceModel\Note as ResourceModel;
use Alevel\RandomNumber\Model\NoteFactory as ModelFactory;
use Alevel\RandomNumber\Model\ResourceModel\Note\Collection;
use Alevel\RandomNumber\Model\ResourceModel\Note\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;


/**
 * Class NoteRepository
 * @package Alevel\RandomNumber\Repository
 */
class NoteRepository
{
    /**
     * @var ResourceModel
     */
    private $resource;

    /**
     * @var ModelFactory
     */
    private $modelFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $processor;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * NoteRepository constructor.
     * @param ResourceModel $resource
     * @param ModelFactory $modeFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        ResourceModel $resource,
        ModelFactory $modeFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultFactory
    )
    {
        $this->resource = $resource;
        $this->modelFactory = $modeFactory;
        $this->collectionFactory = $collectionFactory;
        $this->processor = $collectionProcessor;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @param int $id
     * @return NoteInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): NoteInterface
    {
        $order = $this->modelFactory->create();
        $this->resource->load($order, $id);
        if (empty($order->getId())) {
            throw new NoSuchEntityException(__("Note %1 not found", $id));
        }
        return $order;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->processor->process($searchCriteria, $collection);
        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());
        return $searchResult;
    }

    /**
     * @param NoteInterface $order
     * @return NoteInterface
     * @throws CouldNotSaveException
     */
    public function save(NoteInterface $order): NoteInterface
    {
        try {
            $this->resource->save($order);
        } catch (\Exception $e) {
            // added logger
            throw new CouldNotSaveException(__("Order could not save"));
        }
        return $order;
    }

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param $sku
     * @param $qty
     * @return mixed
     */
    public function prepareObjectNote($id,$name,$email,$sku,$qty)
    {
        $customerObject = $this->modelFactory->create();
        $customerObject->setCustomerid($id);
        $customerObject->setName($name);
        $customerObject->setEmail($email);
        $customerObject->setSku($sku);
        $customerObject->setQty($qty);
        return $customerObject;
    }

    /**
     * @param NoteInterface $order
     * @return $this
     * @throws CouldNotDeleteException
     */
    public function delete(NoteInterface $order)
    {
        try {
            $this->resource->delete($order);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException("Order not delete");
        }
        return $this;
    }

    /**
     * @param int $id
     * @return $this
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id)
    {
        $order = $this->getById($id);
        $this->delete($order);
        return $this;
    }
}
