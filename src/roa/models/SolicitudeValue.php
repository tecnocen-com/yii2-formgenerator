<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
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
    public function getLinks()
    {
        return $this->getSlugLinks();
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'sectionField',
            'section',
            'field',
            'solicitude',
        ];
    }
}
