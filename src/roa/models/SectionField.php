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
            'resourceName' => 'field',
            'parentSlugRelation' => 'section',
        ];
    }
}
