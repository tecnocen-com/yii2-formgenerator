<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\helpers\Url;
use yii\web\Link;

/**
 * ROA contract handling Form records.
 *
 * @method void checkAccess(array $params)
 */
class DataType extends base\DataType implements
    Contract
{
    use ContractTrait {
        getLinks as getContractLinks;
    }

    /**
     * @inheritdoc
     */
    protected $fieldClass = Field::class;

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        $selfLink = $this->getSelfLink();

        return array_merge($this->getContractLinks(), [
            'curies' => [
                new Link([
                    'name' => 'embeddable',
                    'href' => Url::to($selfLink, ['expand' => '{rel}']),
                    'title' => 'Embeddable and not Nestable related resources.',
                ]),
            ],
            'embeddable:fields' => 'fields',
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig(): array
    {
        return ['resourceName' => 'data-type'];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['fields'];
    }
}
