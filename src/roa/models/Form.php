<?php

namespace tecnocen\formgenerator\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling Form records.
 */
class Form extends \tecnocen\formgenerator\models\Form
    implements Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected $sectionClass = Section::class;

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return ['resourceName' => 'form'];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return $this->getSlugLinks() + [
            'sections' => $this->getSelfLink() . '/section',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['sections'];
    }
}
