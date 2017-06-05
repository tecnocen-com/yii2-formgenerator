<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\roa\behaviors\Slug;

/**
 * Trait with contract methods for ROA
 *
 * @method string[] getSlugLinks()
 * @method string getSelfLink()
 */
trait SlugTrait
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors() + [
            'slug' => ['class' => Slug::class] + $this->slugConfig()
        ];
    }

    public function getLinks()
    {
        return $this->getSlugLinks();
    }

    /**
     * @return string[]
     */
    abstract protected function slugConfig();
}
