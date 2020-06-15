<?php

namespace Alevel\RandomNumber\Provider;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Alevel\RandomNumber\Provider\RandomInterface;

/**
 * Class RandomNumberProvider
 * @package Alevel\RandomNumber\Provider
 */
class RandomNumberProvider implements RandomInterface
{

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * RandomNumberProvider constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return mt_rand(1,10000);
    }

    public function getValueForBlock(): string
    {
        $enable = $this->scopeConfig->getValue (
        self::CONFIG_PATH_ENABLE,
        ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
        if ($enable)
        {
            $html = 'all works';
        } else {
            $html = 'doesnot works';
        }
        return $html;
    }
}
