<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\web\NotFoundHttpException;

/**
 * ROA contract handling Field records.
 */
class Field extends base\Field implements Contract
{
    use ContractTrait {
        getLinks as getContractLinks;
    }

    /**
     * @inheritdoc
     */
    protected $dataTypeClass = DataType::class;

    /**
     * @inheritdoc
     */
    protected $ruleClass = FieldRule::class;

    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig()
    {
        return [
            'resourceName' => 'field',
            'checkAccess' => function ($params) {
                if (isset($params['field_id'])
                    && $params['field_id'] != $this->id
                ) {
                    throw new NotFoundHttpException(
                        'Field doesnt contain the requested route.'
                    );
                }
            },
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return array_merge($this->getContractLinks(), [
            'rules' => $this->getSelfLink(). '/rule',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['dataType', 'rules'];
    }
}
