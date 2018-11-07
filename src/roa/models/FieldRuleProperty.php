<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;

/**
 * ROA contract handling FieldRuleProperty records.
 */
class FieldRuleProperty extends base\FieldRuleProperty implements Contract
{
    use ContractTrait;

    /**
     * @inheritdoc
     */
    protected $ruleClass = FieldRule::class;

    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig(): array
    {
        return [
            'idAttribute' => 'property',
            'resourceName' => 'property',
            'parentSlugRelation' => 'rule',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['rule'];
    }
}
