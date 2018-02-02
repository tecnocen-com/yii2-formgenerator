<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\web\Linkable;
use yii\web\NotFoundHttpException;

/**
 * ROA contract handling Form records.
 * 
 * @method void checkAccess(array $params)
 */
class Form extends base\Form implements Linkable
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
        return [
            'resourceName' => 'form',
            'checkAccess' => function ($params) {
                if (isset($params['form_id'])
                    && $params['form_id'] != $this->id
                ) {
                    throw new NotFoundHttpException(
                        'Field doesnt contain the requested route.'
                    );
                }
            },
        ];
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
