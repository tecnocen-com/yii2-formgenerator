<?php

namespace tecnocen\formgenerator\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling Field records.
 */
class Solicitude extends \tecnocen\formgenerator\models\Solicitude
    implements Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected $formClass = Form::class;

    /**
     * @inheritdoc
     */
    protected $solicitudeValueClass = SolicitudeValue::class;

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'resourceName' => 'solicitude',
            'parentSlugRelation' => 'form',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return $this->getSlugLinks() + [
            'values' => $this->getSelfLink() . '/value',
        ];
    }
}
