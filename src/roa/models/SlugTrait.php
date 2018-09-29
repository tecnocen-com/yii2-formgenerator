<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\roa\behaviors\Slug;
use tecnocen\roa\behaviors\Curies;

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
            'slug' => ['class' => Slug::class] + $this->slugConfig(),
            'curies' => Curies::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return $this->getBehavior('slug')->getSlugLinks()
            + $this->getBehavior('curies')->getCuriesLinks();
    }

    /**
     * @return string[]
     */
    abstract protected function slugConfig();
}
