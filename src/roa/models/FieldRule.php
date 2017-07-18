<?php

namespace tecnocen\formgenerator\roa\models;

use yii\helpers\Url;
use yii\web\Link;
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
        $selfLink = $this->getSelfLink();
        return $this->getSlugLinks() + [
            'properties' => $selfLink . '/property',
            'curies' => [
                'expand' => new Link([
                    'href' => Url::to([$selfLink, 'expand' => '{rel}']),
                    'name' => 'expand',
                    'templated' => true,
                    'title' => 'expand values to embed at the resource.',
                ]),   
            ],
            'expand:properties' => 'properties',
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['id', 'class'];
    }
   

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['properties'];
    }
}
