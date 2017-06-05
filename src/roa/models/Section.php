<?php

namespace tecnocen\formgenerator\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling form Section records.
 */
class Section extends \tecnocen\formgenerator\models\Section
    implements Linkable
{
    use SlugTrait;

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
}
