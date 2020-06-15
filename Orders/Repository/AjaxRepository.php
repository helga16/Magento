<?php

namespace Alevel\Orders\Repository;

use Alevel\Orders\Api\Model\AjaxInterface;
use Alevel\Orders\Model\AjaxOrderFactory as ModelFactory;
use Alevel\Orders\Model\ResourceModel\AjaxOrder as ResourceModel;
use Alevel\Orders\Model\ResourceModel\AjaxOrder\Collection;
use Alevel\Orders\Model\ResourceModel\AjaxOrder\CollectionFactory as CollectionFactoryAjax;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AjaxRepository
 * @package Alevel\Orders\Repository
 */
class AjaxRepository
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
     * @var CollectionFactoryAjax
     */
    private $collectionFactoryAjax;

    /**
     * @var CollectionProcessorInterface
     */
    private $processor;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * AjaxRepository constructor.
     * @param ResourceModel $resource
     * @param ModelFactory $modelFactory
     * @param CollectionFactoryAjax $collectionFactoryAjax
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        ResourceModel $resource,
        ModelFactory $modelFactory,
        CollectionFactoryAjax $collectionFactoryAjax,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultFactory
    )
    {
        $this->resource                 = $resource;
        $this->modelFactory             = $modelFactory;
        $this->collectionFactoryAjax    = $collectionFactoryAjax;
        $this->processor                = $collectionProcessor;
        $this->searchResultFactory      = $searchResultFactory;
    }

    /**
     * @param int $id
     * @return AjaxInterface
     */
    public function getById(int $id): AjaxInterface
    {
        $order = $this->modelFactory->create();
        $this->resource->load($order, $id);
        if (empty($order->getId()))
        {
            throw new NoSuchEntityException(__("Order %1 not found", $id));
        }
        return $order;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getListAjax(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        /** @var Collection $collectionAjax */
        $collectionAjax = $this->collectionFactoryAjax->create();
        $this->processor->process($searchCriteria, $collectionAjax);
        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collectionAjax->getSize());
        $searchResult->setItems($collectionAjax->getItems());
        return $searchResult;
    }

    /**
     * @param AjaxInterface $order
     * @return AjaxInterface
     * @throws CouldNotSaveException
     */
    public function save(AjaxInterface $order): AjaxInterface
    {
        try {
            $this->resource->save($order);
        } catch (\Exception $e) {
            // added logger
            throw new CouldNotSaveException(__("Info could not save"));
        }
        return $order;
    }
}
