<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * ROA contract handling Form records.
 *
 * @method void checkAccess(array $params)
 */
class DataType extends base\DataType implements
    Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected $fieldClass = Field::class;

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        $selfLink = $this->getSelfLink();

        return array_merge($this->getSlugLinks(), [
            'curies' => [
                new Link([
                    'name' => 'embeddable',
                    'href' => Url::to($selfLink, ['expand' => '{rel}']),
                    'title' => 'Embeddable and not Nestable related resources.',
                ]),
            ],
            'embeddable:fields' => 'fields',
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return ['resourceName' => 'data-type'];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['fields'];
    }
}
