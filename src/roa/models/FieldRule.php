<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\helpers\Url;
use yii\web\Linkable;

/**
 * ROA contract handling FieldRule records.
 *
 * @method void checkAccess(array $params)
 */
class FieldRule extends base\FieldRule implements Linkable
{
    use SlugTrait;

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
    protected function slugConfig()
    {
        return [
            'resourceName' => 'rule',
            'parentSlugRelation' => 'field',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        $selfLink = $this->getSelfLink();
        return $this->getSlugLinks() + [
            'properties' => $selfLink . '/property',
            'curies' => [
                'expand' => Url::to($selfLink, ['expand' => '{rel}']),
            ],
            'expand:properties' => 'properties',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['field', 'properties'];
    }
}
