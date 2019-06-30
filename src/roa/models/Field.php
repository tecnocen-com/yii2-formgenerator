<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\NotFoundHttpException;

/**
 * ROA contract handling Field records.
 *
 * @method void checkAccess(array $params)
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
    protected function slugBehaviorConfig(): array
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
            'rules' => $selfLink . '/rule',
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
            'embeddable:rules' => 'rules',
            'nestable:dataType' => 'dataType',
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
