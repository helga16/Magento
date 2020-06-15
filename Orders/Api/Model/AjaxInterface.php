<?php

namespace Alevel\Orders\Api\Model;

interface AjaxInterface
{
    const TABLE_NAME                = 'ajax_order';
    const ID_FIELD                  = 'id';
    const LABEL                     = 'label';

    /**
     * @return mixed
     */
    public function getLabel();
}
