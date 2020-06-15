<?php

namespace Alevel\RandomNumber\Provider;

interface RandomInterface
{
    const CONFIG_PATH = 'alevel/field_masks/default';
    const CONFIG_PATH_ENABLE = 'alevel/field_masks/enable';

    /**
     * @return int
     */
    public function getNumber() : int;
}
