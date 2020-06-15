<?php

namespace Alevel\RandomNumber\Block;

use Alevel\RandomNumber\Provider\RandomInterface;
use Alevel\RandomNumber\Observer\NoteOrder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class RandomNumber extends Template
{
    /**
     * @var RandomInterface
     */
    private $provider;

    /**
     * RandomNumber constructor.
     * @param Context $context
     * @param RandomInterface $random
     * @param array $data
     */
    public function __construct(
        Context $context,
        RandomInterface $provider,
        array $data = []
    )
    {
        $this->provider = $provider;
        parent::__construct($context, $data);
    }

    /**
     * @return int
     */
    public function getRandomNumber()
    {
        return $this->provider->getNumber();
    }

    /**
     * @return mixed
     */
    public function showInfo()
    {
        return $this->provider->getValueForBlock();
    }
}
