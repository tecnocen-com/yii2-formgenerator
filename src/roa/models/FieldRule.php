<?php

namespace tecnocen\formgenerator\roa\models;

use yii\helpers\Url;
use yii\web\Linkable;

/**
 * ROA contract handling FieldRule records.
 */
class FieldRule extends \tecnocen\formgenerator\models\FieldRule
    implements Linkable
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
            'checkAccess' => function ($params) {
                if (isset($params['field_id'])
                    && $params['field_id'] != $this->field_id
                ) {
                    throw new NotFoundHttpException(
                        'Rule not associated to the field.'
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
