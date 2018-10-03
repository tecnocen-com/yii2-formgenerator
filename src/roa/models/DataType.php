<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;

/**
 * ROA contract handling DataType records.
 */
class DataType extends base\DataType implements Contract
{
    use ContractTrait;

    /**
     * @inheritdoc
     */
    protected $fieldClass = Field::class;

    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig()
    {
        return [
            'resourceName' => 'data-type',
            'idAttribute' => 'name',
        ];
    }
}
