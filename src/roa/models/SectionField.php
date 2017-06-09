<?php

namespace tecnocen\formgenerator\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling form Section records.
 */
class SectionField extends \tecnocen\formgenerator\models\SectionField
    implements Linkable
{
    use SlugTrait;

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
    public function getLinks()
    {
        return $this->getSlugLinks() + ['field' => $this->field->getSelfLink()];
    }
}
