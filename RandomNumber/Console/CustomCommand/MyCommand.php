<?php

namespace Alevel\RandomNumber\Console\CustomCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

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
     * MyCommand constructor.
     * @param CollectionFactory $categoryCollectionFactory
     * @param null $name
     */
    public function __construct(
        CollectionFactory $categoryCollectionFactory,
        $name = null
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
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
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $collection = $this->categoryCollectionFactory->create();
        /**
         * exclude categories with id=1, id=2;
         */
        $arrCategory = range(3,40);
        $items = $collection->addIdFilter($arrCategory)->getItems();
        $countColl = count($items);
        $output->writeln($countColl);
        $output->writeln('my command works');
        $fs = new Filesystem();
        if ($fs->exists('generated')) {
            $fs->remove(['generated/code']);
            $output->writeln('clear generated');
        } else {
            $output->writeln('cant clear');
        }
    }
}
