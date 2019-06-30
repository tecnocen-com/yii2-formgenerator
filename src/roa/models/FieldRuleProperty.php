<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\NotFoundHttpException;

/**
 * ROA contract handling FieldRule records.
 *
 * @method void checkAccess(array $params)
 */
class FieldRuleProperty extends base\FieldRuleProperty implements Contract
{
    use ContractTrait {
        getLinks as getContractLinks;
    }

    /**
     * @inheritdoc
     */
    protected $ruleClass = FieldRule::class;

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
                    'name' => 'nestable',
                    'href' => Url::to($selfLink, ['expand' => '{rel}']),
                    'title' => 'Embeddable and Nestable related resources.',
                ]),
            ],
            'nestable:rule' => 'rule',
        ]);
    }

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
