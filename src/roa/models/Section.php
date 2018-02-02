<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\web\Linkable;

/**
 * ROA contract handling form Section records.
 *
 * @method void checkAccess(array $params)
 */
class Section extends base\Section implements Linkable
{
    use SlugTrait;

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
    protected function slugConfig()
    {
        return [
            'resourceName' => 'section',
            'parentSlugRelation' => 'form',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return $this->getSlugLinks() + [
            'fields' => $this->getSelfLink() . '/field',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['form', 'sectionFields', 'fields'];
    }
}
