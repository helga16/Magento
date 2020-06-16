<?php

namespace Alevel\RandomNumber\Console\CustomCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;

/**
 * Class Mycommand
 * @package Alevel\RandomNumber\Console\CustomCommand
 */
class MyCommand extends Command
{
    /**
     * @var CollectionFactory
     */
    private $categoryCollectionFactory;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;
    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $criteriaBuilder;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * MyCommand constructor.
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param SearchResultsInterfaceFactory $searchResultsInterfaceFactory
     * @param CollectionFactory $categoryCollectionFactory
     * @param SearchCriteriaBuilder $criteriaBuilder
     * @param CollectionProcessorInterface $collectionProcessor
     * @param null $name
     */
    public function __construct(
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        SearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        CollectionFactory $categoryCollectionFactory,
        SearchCriteriaBuilder $criteriaBuilder,
        CollectionProcessorInterface $collectionProcessor,

        $name = null
    )
    {
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->searchResultFactory = $searchResultsInterfaceFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->criteriaBuilder =$criteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
        parent::__construct($name);
    }

    /**
     * set command options
     */
    protected function configure()
    {
        $this->setName('mySelfCommand');
        $this->setDescription('how works mySelfCommand');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */    public function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var Collection $collection
         */
        $collection = $this->categoryCollectionFactory->create();
        /** @var SearchCriteriaBuilder $criteriaBuilder */
        $criteria = $this->criteriaBuilder
            ->addFilter('entity_id', 2, 'gt')
            ->create();
        $this->collectionProcessor->process($criteria, $collection);
        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($criteria);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());
        $categories = $searchResult->getItems();
        //$arrCategory = range(3,40);
        //$items = $collection->addIdFilter($arrCategory)->getItems();
        $countColl = count($categories);
        $output->writeln($countColl);
        $output->writeln('my command works');
    }
}
