<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * ROA contract handling form Section records.
 *
 * @method void checkAccess(array $params)
 */
class SectionField extends base\SectionField implements Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected $sectionClass = Section::class;

    /**
     * @inheritdoc
     */
    protected $fieldClass = Field::class;

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

        return array_merge($this->getSlugLinks(), [
            'field' => $this->field->getSelfLink(),
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
            'embeddable:solicitudeValuesDetail' => 'solicitudeValuesDetail',
            'nestable:field' => 'field',
            'nestable:section' => 'section',
        ]);
    }
    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => 'field_id',
            'resourceName' => 'field',
            'parentSlugRelation' => 'section',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['field', 'section', 'solicitudeValuesDetail'];
    }
}
