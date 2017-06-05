<?php

namespace tecnocen\formgenerator\roa\models;

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
        return $this->getSlugLinks() + [
            'properties' => $this->getSelfLink() . '/property',
        ];
    }
}
