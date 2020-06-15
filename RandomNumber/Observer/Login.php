<?php

namespace Alevel\RandomNumber\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Login
 * @package Alevel\RandomNumber\Observer
 */
class Login implements ObserverInterface
{
    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
       $event = $observer->getEvent();
    }
}
