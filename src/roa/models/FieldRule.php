<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\helpers\Url;
use yii\web\Link;

/**
 * ROA contract handling FieldRule records.
 */
class FieldRule extends base\FieldRule implements Contract
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

    protected $propertyClass = FieldRuleProperty::class;

    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig(): array
    {
        return [
            'resourceName' => 'rule',
            'parentSlugRelation' => 'field',
            'checkAccess' => function ($params) {
                if (isset($params['rule_id'])
                    && $params['rule_id'] != $this->id
                ) {
                    throw new NotFoundHttpException(
                        'Field Rule doesnt contain the requested route.'
                    );
                }
            }
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        $selfLink = $this->getSelfLink();

        return array_merge($this->getContractLinks(), [
            'properties' => $selfLink . '/property',
            'curies' => [
                new Link([
                    'name' => 'embeddable',
                    'href' => Url::to($selfLink, ['expand' => '{rel}']),
                    'title' => 'Embeddable and not Nestable related resources.',
                ]),
                new Link([
                    'name' => 'nestable',
                    'href' => Url::to($selfLink, ['expand' => '{rel}']),
                    'title' => 'Embeddable and Nestable related resources.',
                ]),
            ],
            'embeddable:properties' => 'properties',
            'nestable:field' => 'field',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['field', 'properties'];
    }
}
