<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * ROA contract handling Field records.
 *
 * @method void checkAccess(array $params)
 */
class SolicitudeValue extends base\SolicitudeValue implements Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected $sectionFieldClass = SectionField::class;

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
    protected $solicitudeClass = Solicitude::class;

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        $selfLink = $this->getSelfLink();

        return array_merge($this->getSlugLinks(), [
            'field' => $this->field->getSelfLink(),
            'section' => $this->section->getSelfLink(),
            'sectionField' => $this->sectionField->getSelfLink(),
            'curies' => [
                new Link([
                    'name' => 'nestable',
                    'href' => Url::to($selfLink, ['expand' => '{rel}']),
                    'title' => 'Embeddable and Nestable related resources.',
                ]),
            ],
            'nestable:field' => 'field',
            'nestable:section' => 'section',
            'nestable:sectionField' => 'sectionField',
            'nestable:solicitude' => 'solicitude',
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => ['section_id', 'field_id'],
            'resourceName' => 'value',
            'parentSlugRelation' => 'solicitude',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'field',
            'section',
            'sectionField',
            'solicitude',
        ];
    }
}
