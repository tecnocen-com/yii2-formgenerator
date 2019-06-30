<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\helpers\Url;
use yii\web\Link;

/**
 * ROA contract handling Field records.
 *
 * @method void checkAccess(array $params)
 */
class Solicitude extends base\Solicitude implements Contract
{
    use ContractTrait {
        getLinks as getContractLinks;
    }

    /**
     * @inheritdoc
     */
    protected $formClass = Form::class;

    /**
     * @inheritdoc
     */
    protected $solicitudeValueClass = SolicitudeValue::class;

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        $selfLink = $this->getSelfLink();

        return array_merge($this->getContractLinks(), [
            'values' => $selfLink . '/value',
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
            'embeddable:values' => 'values',
            'nestable:form' => 'form',
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig(): array
    {
        return [
            'resourceName' => 'solicitude',
            'parentSlugRelation' => 'form',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['form', 'values'];
    }
}
