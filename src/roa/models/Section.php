<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\helpers\Url;
use yii\web\Link;

/**
 * ROA contract handling form Section records.
 *
 * @method void checkAccess(array $params)
 */
class Section extends base\Section implements Contract
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
    protected $sectionFieldClass = SectionField::class;

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
            'fields' => $selfLink . '/field',
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
            'embeddable:fields' => 'fields',
            'nestable:form' => 'form',
        ]);
    }
    
    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig(): array
    {
        return [
            'resourceName' => 'section',
            'parentSlugRelation' => 'form',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['form', 'fields'];
    }
}
