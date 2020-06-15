<?php

namespace Alevel\Rewrite\Plugin\Provider;

use Alevel\RandomNumber\Provider\RandomNumberProvider as Component;

/**
 * Class RandomNumberProviderPlugin
 * @package Alevel\Rewrite\Plugin\Provider
 */
class RandomNumberProviderPlugin
{
    /**
     * @param Component $subject
     */
    public function beforeGetNumber (
        Component $subject
    )
    {
        echo '<p>this text appears if beforePlugin works</p><br>';
    }

    /**
     * @param Component $subject
     * @param $result
     * @return int
     */
    public function afterGetNumber (
        Component $subject,
        $result
    )
    {
       echo $result.'<br><p>new result after plugin:</p>';
       $result = 200;
       return $result;
    }
}
